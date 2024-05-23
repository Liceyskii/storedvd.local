<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>{{ $title }}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="Интернет-магазин по продаже DVD-дисков." />
	<meta name="keywords" content="интернет магазин, интернет магазин dvd, интернет магазин dvd диски" />
	<link rel="stylesheet" href="/styles/main.css" type="text/css" />
	<script type="text/javascript" src="/js/functions.js"></script>
	<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	{!! htmlScriptTagJsApi() !!}
</head>
<body>
	<div id="container">
		<div id="header">
			<img src="/images/header.png" alt="Шапка" />
			<div>
				<p class="red">8-800-123-45-67</p>
				<p class="blue">Время работы с 09:00 до 21:00<br />без перерыва и выходных</p>
			</div>
			<div class="cart">
				<p class="cart_title">Корзина</p>
				<p class="blue">Текущий заказ</p>
				<p>В корзине <span>{{ count(session('cart', [])) }}</span> товаров<br />на сумму <span>{{ session('total', 0) }}</span> руб.</p>
				<a href="{{ route('cart') }}">Перейти в корзину</a>
			</div>
		</div>
		<div id="topmenu">
			<ul>
				<li>
					<a href="{{ route('index') }}">ГЛАВНАЯ</a>
				</li>
				<li>
					<img src="/images/topmenu_border.png" alt="" />
				</li>
				<li>
					<a href="{{ route('delivery') }}">ОПЛАТА И ДОСТАВКА</a>
				</li>
				<li>
					<img src="/images/topmenu_border.png" alt="" />
				</li>
				<li>
					<a href="{{ route('contacts') }}">КОНТАКТЫ</a>
				</li>
			</ul>
			<div id="search">
				<form name="search" action="/search" method="get">
					<table>
						<tr>
							<td class="input_left"></td>
							<td>
								<input type="text" name="search" value="поиск" onfocus="if(this.value == 'поиск') this.value=''" onblur="if(this.value == '') this.value='поиск'" />
							</td>
							<td class="input_right"></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		<div id="content">
			<div id="left">
				<div id="menu">
					<div class="header">
						<h3>Разделы</h3>
					</div>
					<div id="items">
                        @foreach($genres as $g)
                            <p >
								<a href="/genre?id={{ $g->id }}">{{ $g->title }}</a>
							</p>
                        @endforeach
                    </div>
					<div class="bottom"></div>
				</div>
			</div>
			<div id="right">
                {{ $right }}			
            </div>
			<div class="clear"></div>
			<div id="footer">
				<div id="pm">
					<table>
						<tr>
							<td>Способы оплаты:</td>
							<td>
								<img src="/images/pm.png" alt="Способы оплаты" />
							</td>
						</tr>
					</table>
				</div>
				<div id="copy">
					<p>Copyright &copy; Site.ru. Все права защищены.</p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>