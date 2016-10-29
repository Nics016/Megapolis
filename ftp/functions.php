<?php

add_filter('show_admin_bar', '__return_false'); //скроем на время админ бар сверху

//подключаем стили
function _s_styles()
{
	wp_register_style('main', get_template_directory_uri(). '/css/style.css');
	wp_enqueue_style('main', get_template_directory_uri(). '/css/style.css');

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
		)
	);
}

function top_menu(){
	echo '<ul>';
	wp_list_pages('title_li=&');
	echo '</ul>';
}