<?php
	session_start();

	//расскоментировать для очистки корзины
	// if ( isset($_SESSION['cart']) )
	// 	$_SESSION['cart'] = [];

	//перменная о количестве товаро
	$count = 0;

	//перменная о всей сумме
	$total_sum = 0;

	//переменна для фронтеда
	$json_arr = [];
	$json = '';

	//возьмем данные с корзины
	if ( isset($_SESSION['cart']) && !empty($_SESSION['cart']))
	{
		global $wpdb;
		$count = count($_SESSION['cart']);

		//переберем все значения массива и узнаем цену
		for ( $i = 0; $i < count($_SESSION['cart']); $i++ )
		{
			//для удобства запишем перменные
			$tovar_id = $_SESSION['cart'][$i][0];
			$num = $_SESSION['cart'][$i][1];
			$price = $_SESSION['cart'][$i][2];

			//чтобы перемножать
			settype($num, 'integer');
			settype($price, 'integer');

			//для json
			settype($tovar_id, 'integer');

			$total_sum += $num * $price;

			//занесем все данные в json массив
			$json_arr[] = [$tovar_id, $num, $price];

		}

	}

	if ( is_page('cart') )
	{
		global $total;
		$total = $total_sum;
	}

	//формируем json
	if ( !empty($json_arr) )
		$json = json_encode($json_arr);


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Мегаполис</title>
	<?php wp_head(); ?>

	<script>
		
		var ajaxUrl = '<?= site_url() ?>/wp-admin/admin-ajax.php';

		//массив, где будут хранится данные о товарах в корзине
		// в нем буду еще массивы, в кторых первый элемент это айди, второй элемент количество товаров, третий его цена
		var cart = [];

		//запишем json
		<?php if ( $json != '' ): ?>

		cart = JSON.parse('<?= $json ?>');

		<?php endif; ?>

	</script>
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
				<a href="/cart/" class="main-header-cart-pic">
				</a>
				<a class="main-header-cart-inyourcart" href="/cart/">
					<span class="main-header-cart-inyourcart-text">
						В Вашей корзине
					</span>
					<span class="main-header-cart-inyourcart-items">
						товаров: <span class="main-header-cart-inyourcart-itemsNum" data-type="tovars-num" id="itemsNum">
									<?= $count ?>
								</span> 
					</span>
					<span class="main-header-cart-inyourcart-items">
						на сумму: 
						<span class="main-header-cart-inyourcart-itemsNum" id="itemsSum">
							<span data-type="tovars-sum">
								<?= $total_sum ?>
							</span>
							руб. 
						</span>
					</span>
				</a>
			</div>
		</div>
		<!-- END OF CONTACT INFORMATION -->
		<div id="top-nav" class="clearfix">
			<!-- TOP MENU -->
      <?php
    		if ( function_exists( 'wp_nav_menu' ) )
        wp_nav_menu( 
	        array( 
	        'theme_location' => 'top-menu',
	        'fallback_cb'=> 'top_menu',
	        'container' => 'ul',
	        'menu_id' => 'top-nav-list',
	        'menu_class' => 'nav') 
				);
    		else custom_menu();
			?>
			<!-- END OF TOP MENU -->
			<!-- MENU IN LEFT SIDEBAR -->
			<!-- <?php
    		if ( function_exists( 'wp_nav_menu' ) )
        wp_nav_menu( 
	        array( 
	        'theme_location' => 'left-menu',
	        'fallback_cb'=> 'left_menu',
	        'container' => 'ul',
	        'menu_id' => 'left-nav-list',
	        'menu_class' => '') 
				);
    		else custom_menu();
			?> -->
			<!-- END OF MENU IN LEFT SIDEBAR -->
		</div>
	<hr class="shadowHr">
	</header>
	<!-- END OF HEADER -->