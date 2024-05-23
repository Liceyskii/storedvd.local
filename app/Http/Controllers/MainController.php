<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\PromoCode;
use App\Models\Order;

class MainController extends Controller
{

    // pages

    public function index(Request $request) {

        $movies = Movie::orderByDesc('release_year')->get();

        if ($request->has('sort')) {
            $sort = $request->get('sort');
            $up = $request->get('up');
            if ($sort == 'price') {
                if ($up == 1) {
                    $movies = $movies->sortBy('price');
                } else {
                    $movies = $movies->sortByDesc('price');
                }
            } elseif ($sort == 'title') {
                if ($up == 1) {
                    $movies = $movies->sortBy('title');
                } else {
                    $movies = $movies->sortByDesc('title');
                }
            }
        }

        if ($request->movieId) {
            $movieId = $request->input('movieId');
            $moviePrice = $request->input('moviePrice');
        
            // Добавление в сессию
            $cart = session()->get('cart', []);
            $cart[] = $movieId; // Просто добавляем movieId в массив
            session()->put('cart', $cart);
        
            // Обновление общей суммы в корзине
            $total = session()->get('total', 0);
            $total += $moviePrice;
            session()->put('total', $total);

            return redirect()->back();
        }
    
        return view('index', ['movies' => $movies]);
    }

    public function movieView(Request $request) {
        $movie = Movie::where('id', $request['id'])->first();
        $genre = Genre::where('id', $movie->genre_id)->first();
        $movies = Movie::where('id', '!=', $movie->id)->where('genre_id', $movie->genre_id)->limit(5)->get();
        return view('movie', ['movie' => $movie, 'genre' => $genre, 'movies' => $movies]);
    }

    public function delivery() {
        return view('delivery');
    }

    public function contacts() {
        return view('contacts');
    }

    public function sortByGenre(Request $request) {
        $movies = Movie::where('genre_id', $request->id)->orderByDesc('release_year')->get();

        if ($request->has('sort')) {
            $sort = $request->get('sort');
            $up = $request->get('up');
            if ($sort == 'price') {
                if ($up == 1) {
                    $movies = $movies->sortBy('price');
                } else {
                    $movies = $movies->sortByDesc('price');
                }
            } elseif ($sort == 'title') {
                if ($up == 1) {
                    $movies = $movies->sortBy('title');
                } else {
                    $movies = $movies->sortByDesc('title');
                }
            }
        }

        $genre = Genre::where('id', $request->id)->first();
        return view('genre', ['movies' => $movies, 'genre' => $genre]);
    }

    public function search(Request $request) {
        if (!$request['search']) {
            return redirect('index');
        } else {
            $validated = $request->validate([
                'search' => 'required|string|min:3|max:200',
            ]);
            $search_request = $validated['search'];
            $movies = Movie::where('title', 'LIKE', "%$search_request%")->get();
            return view('search', ['movies' => $movies, 'search_request' => $search_request]);
        }
    }



    // Order

    public function cart() {
        $movies = Movie::orderByDesc('release_year')->get();
        return view('cart', ['movies' => $movies]);
    }

    public function deletePosition(Request $request, $id) {
        $cart = session('cart', []);
        $cleanedCart = [];
        $i = 0;
        foreach ($cart as $c) {
            if ($c != $id) {$cleanedCart[] = $c;} else $i++;
        }
        session()->forget('cart');
        session()->put('cart', $cleanedCart);

        $cart = session('cart', []);
        $price = Movie::where('id', $id)->first();
        $total = 0;
        foreach ($cart as $c) {
            $movie = Movie::where('id', $c)->first();
            $total += $movie->price;
        }
        session()->forget('total');
        session()->put('total', $total);

        return redirect('cart');
    }

    public function updateCart(Request $request)
    {
        $cart = session('cart', []);
        $total = 0;

        $movies = Movie::orderByDesc('release_year')->get();

        foreach($movies as $m) {
            if ($request['count_'.$m->id]) {
                $count = $request['count_'.$m->id];
                $cart = array_diff($cart, [$m->id]);
                for ($i = 0; $i < $count; $i++) $cart[] = $m->id;
            }
        }

        foreach ($cart as $c) {
            $movie = Movie::where('id', $c)->first();
            $total += $movie->price;
        }

        if ($request['discount']) {
            $code = PromoCode::where('code', $request['discount'])->first();
            $total = $total - ($total * $code->procent_discount / 100);
        }


        session()->forget('total');
        session()->forget('cart');
        session()->put('cart', $cart);
        session()->put('total', $total);

        // // Перенаправляем на страницу корзины
        return redirect()->route('cart');
    }

    public function order() {
        if (session('total') == 0) {
            return redirect()->route('index');
        } else {
            return view('order');
        }
    }

    public function addOrder(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'delivery' => 'required|in:0,1',
            'address' => 'required_if:delivery,==,0|max:255',
            'g-recaptcha-response' => 'recaptcha'
        ], [
            'name.required' => 'Пожалуйста, введите ваше имя.',
            'name.max' => 'Имя не должно превышать 255 символов.',
            'phone.required' => 'Пожалуйста, введите ваш номер телефона.',
            'phone.max' => 'Пожалуйста, введите ваш номер телефона.',
            'email.required' => 'Пожалуйста, введите email-адресс.',
            'email.email' => 'Пожалуйста, введите действительный email-адресс.',
            'email.max' => 'Пожалуйста, введите действительный email-адресс.',
            'delivery.required' => 'Пожалуйста, выберите способ доставки.',
            'address.required' => 'Пожалуйста, введите адресс доставки.',
            'g-recaptcha-response' => 'Вы не прошли проверку "Я не робот".',
            // ...
        ]);

        if ($validator->fails()) {
            return redirect()->route('order')
                ->withErrors($validator)
                ->withInput(); // Передает старые значения в форму
        }

        $order = new Order;

        $order->name = $request->input('name');
        $order->phone = $request->input('phone');
        $order->email = $request->input('email');
        if ($request->input('delivery') != 1) {
            $order->address = $request->input('address');
        } else $order->address = 'Самовывоз';
        $order->notice = $request->input('notice');
        $movies = [];
        foreach (session('cart') as $item) {
            $movie = Movie::where('id', $item)->first();
            $movies[] = $movie->title;
        }
        $order->products = implode(', ', $movies);
        $order->price = session('total');

        $order->save();

        session()->forget('cart');
        session()->forget('total');

        return redirect()->route('success');
    }

    public function orderSuccess() {
        return view('success');
    }

}
