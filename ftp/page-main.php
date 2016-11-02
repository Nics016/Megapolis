<?php get_header();?>
<main>
<?php 
	if(have_posts()):
	while(have_posts()):
		the_post();
	endwhile;
	endif;
?>
	<!-- GETTING TERMS -->
	<?php 
		$terms = get_all_terms();
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
							// вырезаем url thumbnail категории
							$img = get_term_thumbnail( $term->term_taxonomy_id, $size = 'category-thumb', $attr = '' );
							$sImageUrl = getImageUrl($img."<br>");
				?>
				<a href="<?php echo('/category' . $taxonomy . '/' . $term->slug);?>" class="categories-items-element">
					<span class="categories-items-element-pic" style="background-image: url('<?php echo $sImageUrl; ?>');">
					<span class="categories-items-element-text">
						<?php echo $term->name; ?>
					</span>
				</a>
				<?php
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
			123
		</div>
		<!-- END OF CONTENT -->
	</div>
</main> 
<?php get_footer(); ?>