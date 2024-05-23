<x-main-layout>
    <x-slot name="title">Страница не найдена - 404</x-slot>
    <x-slot name="right">
        <div style="text-align: center;">
            <br>
            <h4>К сожалению, запрошенная страница не существует</h4>
            <br>
            <a href="{{ route('index') }}">Вернуться на главную</a>
        </div>
    </x-slot>
</x-main-layout>