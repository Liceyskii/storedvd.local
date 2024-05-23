<x-main-layout>
    <x-slot name="title">Корзина</x-slot>
    <x-slot name="right">
    <div id="cart">
        <h2>Корзина</h2>
        <form name="cart" action="#" method="post">
            @csrf
            <table>
                <tr>
                    <td colspan="8" id="cart_top"></td>
                </tr>
                <tr>
                    <td class="cart_left"></td>
                    <td colspan="2">Товар</td>
                    <td>Цена за 1 шт.</td>
                    <td>Количество</td>
                    <td>Стоимость</td>
                    <td></td>
                    <td class="cart_right"></td>
                </tr>
                <tr>
                    <td class="cart_left"></td>
                    <td colspan="6">
                        <hr />
                    </td>
                    <td class="cart_right"></td>
                </tr>

                <?php
                    $Ids = [];
                ?>
                @foreach(session('cart', []) as $movieId)
                    @if ($movie = $movies->where('id', $movieId)->first())
                        @if (!in_array($movieId, $Ids))
                        <?php
                            $Ids[] += $movieId;
                            $positionPrice = isset($_POST['count_' . $movie->id]) 
                                ? (int) $_POST['count_' . $movie->id] * $movie->price 
                                : $movie->price * array_count_values(session('cart', []))[$movie->id];
                        ?>
                        <tr class="cart_row">
                            <td class="cart_left"></td>
                            <td class="img">
                                <img src="images/products/{{ $movie->cover }}" alt="{{ $movie->title }}" />
                            </td>
                            <td class="title">{{ $movie->title }}</td>
                            <td>{{ $movie->price }}</td>
                            <td>
                                <table class="count">
                                    <tr>
                                        <td>
                                            <input type="text" name="count_{{ $movie->id }}" value="{{ array_count_values(session('cart', []))[$movie->id] }}" />
                                        </td>
                                        <td>шт.</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="bold">{{ $positionPrice }} руб.</td>
                            <td>
                                <a href="{{ route('cart') }}/delete/{{ $movieId }}" class="link_delete">x удалить</a>
                            </td>
                            <td class="cart_right"></td>
                        </tr>
                        @endif
                    @endif
                @endforeach


                
                <tr id="discount">
                    <td class="cart_left"></td>
                    <td colspan="6">
                        <form name="discount" action="cart.html" method="post">
                            <table>
                                <tr>
                                    <td>Введите номер купона со скидкой<br /><span>(если есть)</span></td>
                                    <td>
                                        <input type="text" name="discount" value="" />
                                    </td>
                                    <td>
                                        <input type="image" src="images/cart_discount.png" alt="Получить скидку" onmouseover="this.src='images/cart_discount_active.png'" onmouseout="this.src='images/cart_discount.png'" />
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </td>
                    <td class="cart_right"></td>
                </tr>
                <tr id="summa">
                    <td class="cart_left"></td>
                    <td colspan="6">
                        <p>Итого : <span>{{ session('total') }} руб.</span></p>
                    </td>
                    <td class="cart_right"></td>
                </tr>
                <tr>
                    <td class="cart_left"></td>
                    <td colspan="2">
                        <div class="left">
                            <input type="image" src="images/cart_recalc.png" alt="Пересчитать" onmouseover="this.src='images/cart_recalc_active.png'" onmouseout="this.src='images/cart_recalc.png'" />
                        </div>
                    </td>
                    <td colspan="4">
                        <div class="right">
                            <input type="hidden" name="func" value="cart" />
                            <a href="{{ route('order') }}">
                                <img src="images/cart_order.png" alt="Оформить заказ" onmouseover="this.src='images/cart_order_active.png'" onmouseout="this.src='images/cart_order.png'" />
                            </a>
                        </div>
                    </td>
                    <td class="cart_right"></td>
                </tr>
                <tr>
                    <td colspan="8" id="cart_bottom"></td>
                </tr>
            </table>
        </form>
    </div>
    </x-slot>
</x-main-layout>