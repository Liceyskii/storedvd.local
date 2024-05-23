<td>
    <div class="intro_product">
        <p class="img">
            <img src="images/products/{{ $movie->cover }}" alt="{{ $movie->title }}" />
        </p>
        <p class="title">
            <a href="/movie/{{ $movie->id }}">{{ $movie->title }}</a>
        </p>
        <p class="price">{{ $movie->price }} руб.</p>
        <form action="/" method="POST">
            @csrf
            <input type="hidden" name="movieId" value="{{ $movie->id }}">
            <input type="hidden" name="moviePrice" value="{{ $movie->price }}">
            <button type="submit" class="link_cart" style="border: none; cursor: pointer;"></button>
        </form>
    </div>
</td>