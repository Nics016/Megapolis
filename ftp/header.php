<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Мегаполис</title>
	<?php wp_head(); ?>
</head>
<body>
<div id="main-wrap">
	<!-- HEADER -->
	<header id="main-header">
		<!-- CONTACT INFORMATION -->
		<div class="container clearfix">
			<div class="main-header-logo">
				<a href="<?= site_url() ?>" class="main-header-logo-pic"></a>
			</div>
			<div class="main-header-phone">
				<a href="tel:8-495-215-1585" class="main-header-phone-text">
					8 (495) 215-1585
				</a>
				<i class="fa fa-phone" aria-hidden="true"></i>
				<span class="main-header-phone-subtext">
					Общий многоканальный телефон
				</span>
			</div>
			<div class="main-header-address">
				<i class="fa fa-location-arrow" aria-hidden="true"></i>
				<span class="main-header-address-text">
					 г. Москва, ул. Шаболовка, <br>д. 34, стр. 3
				</span>
				<span class="main-header-address-subtext">
					
				</span>
			</div>
			<div class="main-header-cart clearfix">
				<a href="#" class="main-header-cart-pic">
				</a>
				<a class="main-header-cart-inyourcart" href="#">
					<span class="main-header-cart-inyourcart-text">
						В Вашей корзине
					</span>
					<span class="main-header-cart-inyourcart-items">
						товаров: <span class="main-header-cart-inyourcart-itemsNum" id="itemsNum">0</span> 
					</span>
					<span class="main-header-cart-inyourcart-items">
						на сумму: <span class="main-header-cart-inyourcart-itemsNum" id="itemsSum">0 руб.</span> 
					</span>
				</a>
			</div>
		</div>
		<!-- END OF CONTACT INFORMATION -->
		<div id="top-nav" class="clearfix">
			<!-- <ul id="top-nav-list">
				<li><a href="#">Главная</a></li>
				<li><a href="#">Новости</a></li>
				<li><a href="#">О компании</a></li>
				<li><a href="#">Оплата и доставка</a></li>
				<li><a href="#">Статьи</a></li>
				<li><a href="#">Контакты</a></li>
				<li><a href="#">Прайс</a></li>
			</ul> -->
	        <?php
		    		if ( function_exists( 'wp_nav_menu' ) )
		        wp_nav_menu( 
			        array( 
			        'theme_location' => 'top-menu',
			        'fallback_cb'=> 'top_menu',
			        'container' => 'ul',
			        'menu_id' => 'top-nav-list',
			        'menu_class' => '') 
						);
		    		else custom_menu();
					?>
		</div>
	<hr class="shadowHr">
	</header>
	<!-- END OF HEADER -->