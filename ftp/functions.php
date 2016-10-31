<?php

add_filter('show_admin_bar', '__return_false'); //скроем на время админ бар сверху

//подключаем стили
function _s_styles()
{
	wp_register_style('main', get_template_directory_uri(). '/css/style.css');
	wp_enqueue_style('main', get_template_directory_uri(). '/css/style.css');
	wp_register_style('main_categories', get_template_directory_uri(). '/css/categories.css');
	wp_enqueue_style('main_categories', get_template_directory_uri(). '/css/categories.css');

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
