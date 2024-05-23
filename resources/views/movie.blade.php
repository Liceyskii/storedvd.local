<x-main-layout>
    <x-slot name="title">{{ $movie->title }}</x-slot>
    <x-slot name="right">
        <table id="hornav">
            <tr>
                <td>
                    <a href="{{route('index')}}">Главная</a>
                </td>
                <td>
                    <img src="/images/hornav_arrow.png" alt="" />
                </td>
                <td>
                    <a href="/genre?id={{ $genre->id }}">{{ $genre->title }}</a>
                </td>
                <td>
                    <img src="/images/hornav_arrow.png" alt="" />
                </td>
                <td>{{ $movie->title }}</td>
            </tr>
        </table>
        <table id="product">
            <tr>
                <td class="product_img">
                    <img src="/images/products/{{ $movie->cover }}" alt="Кто я?" />
                </td>
                <td class="product_desc">
                    <p>Название: <span class="title">{{ $movie->title }}</span></p>
                    <p>Год выхода: <span>{{ $movie->release_year }}</span></p>
                    <p>Жанр: <span>{{ $genre->title }}</span></p>
                    <p>Страна-производитель: <span>{{ $movie->country }}</span></p>
                    <p>Режиссёр: <span>{{ $movie->director }}</span></p>
                    <p>Продолжительность: <span>{{ $movie->duration }}</span></p>
                    <p>В ролях: <span>{{ $movie->actors }}</span></p>
                    <table>
                        <tr>
                            <td>
                                <p class="price">{{ $movie->price }} руб.</p>
                            </td>
                            <td>
                                <p>
                                    <form action="/" method="POST">
                                        @csrf
                                        <input type="hidden" name="movieId" value="{{ $movie->id }}">
                                        <input type="hidden" name="moviePrice" value="{{ $movie->price }}">
                                        <button type="submit" class="link_cart" style="border: none; cursor: pointer;"></button>
                                    </form>
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p class="desc_title">Описание:</p>
                    <p class="desc">{!! $movie->description !!}</p>
                </td>
            </tr>
        </table>
        @if ($movies->isNotEmpty())
            <div id="others">
                <h3>С этим товаром также заказывают:</h3><br>
                <table class="products">
                    <tr>
                        @foreach ($movies as $m)
                            <td>
                                <div class="intro_product">
                                    <p class="img">
                                        <img src="/images/products/{{ $m->cover }}" alt="{{ $m->title }}" />
                                    </p>
                                    <p class="title">
                                        <a href="/movie/{{ $m->id }}">{{ $m->title }}</a>
                                    </p>
                                    <p class="price">{{ $m->price }} руб.</p>
                                    <p>
                                        <form action="/" method="POST">
                                            @csrf
                                            <input type="hidden" name="movieId" value="{{ $m->id }}">
                                            <input type="hidden" name="moviePrice" value="{{ $m->price }}">
                                            <button type="submit" class="link_cart" style="border: none; cursor: pointer;"></button>
                                        </form>
                                    </p>
                                </div>
                            </td>
                        @endforeach               
                    </tr>
                </table>
            </div>
        @endif	
    </x-slot>
</x-main-layout>