<x-main-layout>
    <x-slot name="title">Поиск {{ $search_request }}</x-slot>
    <x-slot name="right">
    <div id="search_result">
        <h2>Результаты поиска: {{ $search_request }}</h2>
        <br>
        <table>
            <tr>
                <td rowspan="2">
                    <div class="header">
                        <h3>Поиск</h3>
                    </div>
                </td>
                <td class="section_bg"></td>
                <td class="section_right"></td>
            </tr>
        </table>		
        <table class="products">
            @if (!count($movies))
                <br>
                <h4>По вашему запросу ничего не найдено</h4>
                <br>
                <a href="{{ route('index') }}">Вернуться на главную</a>
            @else
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
            @endif
        </table>
    </div>
    </x-slot>
</x-main-layout>