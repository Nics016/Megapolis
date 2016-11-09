<?php get_header();?>

<main>
		<script>
			$(document).ready(function(){
				set_tabs_click_events();
			});
		</script>
	<!-- GETTING TERMS OF PRODUCTS -->
	<?php 
		$terms = get_children_terms(19);
		// getting variables of theme
		$var_categories_title = get_theme_mod('input_categories_title', 'Основные направления металлопродукции'); 
	?>
	<!-- END OF GETTING TERMS -->

	<!-- CATEGORIES -->
	<div class="categories_container clearfix">
		<div class="categories">
			<span class="categories-title">
				<?= $var_categories_title; ?>
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
			<?php 
				if(have_posts()):
				while(have_posts()):
					the_post();
					the_content();
				endwhile;
				endif;
			?>
		</div>
		<!-- END OF CONTENT -->
	</div>
</main> 
<?php get_footer(); ?>