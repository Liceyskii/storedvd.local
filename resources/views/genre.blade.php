<x-main-layout>
    <x-slot name="title">{{ $genre->title }}</x-slot>
    <x-slot name="right">
    <table>
        <tr>
            <td rowspan="2">
                <div class="header">
                    <h3>{{ $genre->title }}</h3>
                </div>
            </td>
            <td class="section_bg"></td>
            <td class="section_right"></td>
        </tr>
        <tr>
            <td colspan="2">
                <table class="sort">
                    <tr>
                        <td>Сортировать по:</td>
                        <td>цене (<a href="{{ route('genre') }}?id={{ $genre->id }}&amp;sort=price&amp;up=1">возр.</a> | <a href="{{ route('genre') }}?id={{ $genre->id }}&amp;sort=price&amp;up=0">убыв.</a>)
                        <td>названию (<a href="{{ route('genre') }}?id={{ $genre->id }}&amp;sort=title&amp;up=1">возр.</a> | <a href="{{ route('genre') }}?id={{ $genre->id }}&amp;sort=title&amp;up=0">убыв.</a>)
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table class="products">
        <tr>

        <?php $i = 0; ?>

        @foreach($movies as $movie)

            @if ($i % 4 == 0 && $i != 0)
                </tr>
                <tr>
            @endif

            @include('products')

            <?php $i++; ?>

        @endforeach
        </tr>
    </table>
    </x-slot>
</x-main-layout>