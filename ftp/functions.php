<?php

add_filter('show_admin_bar', '__return_false'); //скроем на время админ бар сверху

//подключаем стили
function _s_styles()
{
	wp_register_style('main', get_template_directory_uri(). '/css/style.css');
	wp_enqueue_style('main', get_template_directory_uri(). '/css/style.css');
	wp_register_style('main_categories', get_template_directory_uri(). '/css/categories.css');
	wp_enqueue_style('main_categories', get_template_directory_uri(). '/css/categories.css');
	wp_register_style('category', get_template_directory_uri(). '/css/category.css');
	wp_enqueue_style('category', get_template_directory_uri(). '/css/category.css');
	wp_register_style('table', get_template_directory_uri(). '/css/table.css');
	wp_enqueue_style('table', get_template_directory_uri(). '/css/table.css');
	wp_register_style('footer', get_template_directory_uri(). '/css/footer.css');
	wp_enqueue_style('footer', get_template_directory_uri(). '/css/footer.css');

	wp_register_style('fontawesome', get_template_directory_uri(). '/font-awesome/css/font-awesome.min.css');
	wp_enqueue_style('fontawesome', get_template_directory_uri(). '/font-awesome/css/font-awesome.min.css');
}

add_action('wp_enqueue_scripts', '_s_styles');

//подключаю скрипты

function _s_scripts()
{
	//своя библиотека jquery, не вордпрессовска
	wp_deregister_script('jquery');
	wp_register_script('jquery',  get_template_directory_uri(). '/js/jquery.js');
	wp_enqueue_script('jquery');
}

add_action('wp_enqueue_scripts', '_s_scripts');

//регистрация меню
if ( function_exists( 'register_nav_menus' ) )
{
	register_nav_menus(
		array(
			'top-menu'=>__('Top Menu'),
			'left-menu'=>__('Left Menu')
		)
	);
}

function custom_menu(){
	echo '<ul>';
	wp_list_pages('title_li=&');
	echo '</ul>';
}

// Регистрация сайдбаров
function register_wp_sidebars() {
	/* В левая боковой колонке - первый сайдбар */
	register_sidebar(
		array(
			'id' => 'left_sideb', // уникальный id
			'name' => 'Левый сайдбар', // название сайдбара
			'description' => 'Перетащите сюда виджеты, чтобы добавить их в сайдбар.', // описание
			'before_widget' => '<div class="">', // по умолчанию виджеты выводятся <li>-списком
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">', // по умолчанию заголовки виджетов в <h2>
			'after_title' => '</h3>'
		)
	);
	// register_sidebar(...
}
add_action( 'widgets_init', 'register_wp_sidebars' );

// Добавление кнопки добавления миниатюры
add_theme_support( 'post-thumbnails' );

// Функции обработки категорий
	// функция для вырезания src картинки из img
	function getImageUrl($img){
		$iImgPos = strpos($img,"src=") + 5;
		$sSrcStart = substr($img, $iImgPos);
		$iQuotePos = strpos($sSrcStart, '"');
		$answ = substr($sSrcStart, 0, $iQuotePos); 
		return $answ;
	}
		
	// загружаем список категорий в массив $terms
	// чтобы позже получить их thumbnails
	function get_all_terms(){
		$taxonomy = 'category';
	    $args = array(
	        'orderby'           => 'id', 
	        'order'             => 'ASC',
	        'hide_empty'        => false, 
	        'exclude'           => array(1), 
	        'exclude_tree'      => array(), 
	        'include'           => array(),
	        'number'            => '', 
	        'fields'            => 'all', 
	        'slug'              => '',
	        'parent'            => '',
	        'hierarchical'      => true, 
	        'child_of'          => 0,
	        'childless'         => false,
	        'get'               => '', 
	        'name__like'        => '',
	        'description__like' => '',
	        'pad_counts'        => false, 
	        'offset'            => '', 
	        'search'            => '', 
	        'cache_domain'      => 'core',
	    );
	    $terms = get_terms($taxonomy, $args);
	    return $terms;
	}
