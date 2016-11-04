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
	wp_register_style('category-articles', get_template_directory_uri(). '/css/category-articles.css');
	wp_enqueue_style('category-articles', get_template_directory_uri(). '/css/category-articles');

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
			'before_widget' => '<div id="%1$s" class="">', // по умолчанию виджеты выводятся <li>-списком
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">', // по умолчанию заголовки виджетов в <h2>
			'after_title' => '</h3>'
		)
	);
	// register_sidebar(...
}
add_action( 'widgets_init', 'register_wp_sidebars' );

// Добавление кнопки добавления миниатюры поста
add_theme_support( 'post-thumbnails' );



// --- CUSTOM FUNCTIONS ---
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
	function get_children_terms($parent_id){
		$taxonomy = 'category';
	    $args = array(
	        'orderby'           => 'id', 
	        'order'             => 'ASC',
	        'hide_empty'        => false, 
	        'exclude'           => array(), 
	        'exclude_tree'      => array(), 
	        'include'           => array(),
	        'number'            => '', 
	        'fields'            => 'all', 
	        'slug'              => '',
	        'parent'            => '',
	        'hierarchical'      => true, 
	        'child_of'          => $parent_id,
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

// вывод названия категории, которая является самым высшим предком
// данной категории, не доходя до нулевой
function Get_Cat_Ancestor_Name($cat_ID)
{	
	$cur_Parent_ID = -1;
	$cur_Category = -1;
	$cur_Cat_ID = $cat_ID;

	// пока $cur_Parent_ID != 0, идем вверх по дереву категорий
	do {
		$cur_Category = get_category($cur_Cat_ID);
		$cur_Parent_ID = $cur_Category->category_parent;
		if ($cur_Parent_ID != 0)
		{
			$cur_Cat_ID = $cur_Parent_ID;
		}
	} while ($cur_Parent_ID != 0);

	// наконец, возвращаем название категории предка
	$answ = get_cat_name($cur_Cat_ID);
	return $answ;
}

// определяет, есть ли у текущей категории дети
function category_has_children() {
	global $wpdb;   
	$term = get_queried_object();
	$category_children_check = $wpdb->get_results(" SELECT * FROM wp_term_taxonomy WHERE parent = '$term->term_id' ");
    if ($category_children_check) {
        return true;
    } else {
       return false;
    }
}  


//класс для вывода таблиц

class productTableModel
{


	public function is_table($table_id)
	{	
		global $wpdb;
		$query = "SELECT ID FROM tovars_tables WHERE ID = $table_id";
		$result = $wpdb->get_results($query, 'ARRAY_A');

		if ( !empty($result) )
			return true;
		else
			return false;
	}

	public function get_table_data($table_id)
	{
		global $wpdb;
		$query = "SELECT name, price, attributes FROM tovars_tables WHERE ID = $table_id";
		$result = $wpdb->get_results($query, 'ARRAY_A');

		//для удобства
		$result = $result[0];
		return $result;
	}

	//метод для вывода товаров
	public function get_tovars( $table_id )
	{
		global $wpdb;
		$query = "SELECT tovars_ids FROM tovars_tables WHERE ID = $table_id";
		$tovars_ids = $wpdb->get_results($query, 'ARRAY_A');

		//проверм, есть ли такая таблицы
		if ( $tovars_ids != NULL )
		{
			
			//берем товары по их id
			$tovars_ids = unserialize($tovars_ids[0]['tovars_ids']);

			// цикле сформируем запрос
			$query = "SELECT * FROM tovars WHERE ";
			for ( $i = 0; $i < count($tovars_ids); $i++ ){

				$ID = $tovars_ids[$i];
				$query .= ( $i == 0 ) ? "ID = $ID" : " OR ID = $ID";

			}

			$tovars = $wpdb->get_results($query, 'ARRAY_A');
			return $tovars;

		}
		else
			return false;
	}

	public function view_table($table_data, $tovars)
	{
		//ся грязь происходит в шаблоне
		require('templates/table_view_template.php');
	}
}

// --- END OF CUSTOM FUNCTIONS ---

