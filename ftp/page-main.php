<?php get_header();?>
<main>
<?php 
	if(have_posts()):
	while(have_posts()):
		the_post();
		the_content();
	endwhile;
	endif;
?>
	<!-- GETTING TERMS OF PRODUCTS -->
	<?php 
		$terms = get_children_terms(19);
	?>
	<!-- END OF GETTING TERMS -->

	<!-- CATEGORIES -->
	<div class="categories_container clearfix">
		<div class="categories">
			<span class="categories-title">
				Основные направления металлопродукции
			</span>
			<div class="categories-items clearfix">
				<?php 
					if (!empty($terms) && !is_wp_error($terms) ){
						foreach ($terms as $term) {
							// выводим только первых детей категории:
							$category = get_category($term->term_taxonomy_id);
							$Parent_ID = $category->category_parent;
							if ($Parent_ID == 19)
							{
							// вырезаем url thumbnail категории
							$img = get_term_thumbnail( $term->term_taxonomy_id, $size = 'category-thumb', $attr = '' );
							$sImageUrl = getImageUrl($img."<br>");
				?>
				<a href="<?php echo('/category' . $taxonomy . '/' . $term->slug);?>" class="categories-items-element">
					<span class="categories-items-element-pic" style="background-image: url('<?php echo $sImageUrl; ?>');">
					<span class="categories-items-element-text">
						<?php echo $term->name;?>
					</span>
				</a>
				<?php
						}
						}
					}
				?>
			</div>
		</div>
	</div>
	<!-- END OF CATEGORIES -->
	
	<div class="container clearfix">
		<?php get_sidebar(); ?>
		<!-- CONTENT -->
		<div class="content">
			

		<!--Выведем таблицы из мета поля -->
		<?php

		//получаем значения из мета поля
		$meta_values = get_post_meta( $post->ID, 'product_tables_ids', true );

		//првоерим значение мета данных, если все ок, продолжаем фанится
		if ( $meta_values != '' )
		{
			global $wpdb; //объявим сразу

			// переведем айдишники мета данных в массив
			$table_arr = explode(',', $meta_values);

			//для каждого элемента выведем талицу
			for ( $i_main = 0; $i_main < count($table_arr); $i_main++ )
			{

				$table_id = $table_arr[$i_main];

				//лежит в функциях
				$Model = new productTableModel(); 

				//проверим наличие таблицы
				$is_table = $Model->is_table($table_id);

				//если все ок, и таблица найдена, то получаем данные
				if ( $is_table )
				{	
					//данные таблицы из бд
					$table_data = $Model->get_table_data($table_id);

					//а тут уже данные о товарах из бд
					$tovars = $Model->get_tovars($table_id);

					// вьюха таблицы
					$Model->view_table($table_data, $tovars);
				}

			}

		}

		?>

		</div>
		<!-- END OF CONTENT -->
	</div>
</main> 
<?php get_footer(); ?>