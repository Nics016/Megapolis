<?php /* Template Name: Category-Product */ ?>
<?php get_header();?>
<main>
	<div class="container clearfix">
		<?php get_sidebar(); ?>
		<div class="content">
			<?php
	    		$parent_cat_name = Get_Cat_Ancestor_Name($cat);
	    	?>

			<?php
				if ($parent_cat_name == "Products"){
			 ?>
			<!-- OUTPUT FOR PRODUCTS -->
			<!-- CATEGORY -->
			<div class="category-container clearfix">
				<div class="category">
					<span class="category-title">
							<?php single_cat_title();?>
					</span>
					<div class="category-elements clearfix">
					<!-- Если у категории есть подкатегории, выводим их: -->
					<?php if (category_has_children()) { 
						$terms = get_children_terms($cat);
						if (!empty($terms) && !is_wp_error($terms) ){
						foreach ($terms as $term) {
							// выводим только первых детей категории:
							$category = get_category($term->term_taxonomy_id);
							$Parent_ID = $category->category_parent;
							if ($Parent_ID == $cat)
							{
								// вырезаем url thumbnail категории
								$img = get_term_thumbnail( $term->term_taxonomy_id, $size = 'category-thumb', $attr = '' );
								$sImageUrl = getImageUrl($img."<br>");
								// получаем url категории:
								$cat_url = '/category' . $taxonomy . '/' . $term->slug;
					?>
							<a href="<?php echo $cat_url; ?>" class="category-elements-item">
									<span class="category-elements-item-pic" 
												style="background-image: url('<?php echo $sImageUrl; ?>');"></span>
									<span class="category-elements-item-text">
										<?php echo $term->name; ?>
									</span>
								</a>
					<?php
							}	
						}
					}
					?>

					<!-- Иначе, если нет подкатегорий, выводим записи: -->
					<?php } else { ?>
						<?php 
							if(have_posts()):
							while(have_posts()):
								the_post();
						?>	
							<a href="<?php the_permalink(); ?>" class="category-elements-item">
								<span class="category-elements-item-pic" 
											style="background-image: url('<?php the_post_thumbnail_url(array(200, 200)); ?>');"></span>
								<span class="category-elements-item-text">
									<?php the_title(); ?>
								</span>
							</a>
					<?php 
							endwhile;
							endif; 
						}
					?>
					</div>
				</div>
			</div>

			<?php } else { ?>
			<!-- OUTPUT FOR NON-PRODUCTS CATEGORIES -->
			<div class="articles">
					<span class="category-title">
						<?php single_cat_title();?>
					</span>
					<?php 
						if(have_posts()):
						while(have_posts()):
						the_post(); 
					?>
					<div class="articles-element clearfix">
						<a href="<?php the_permalink(); ?>" class="articles-element-thumbnail" style="background-image: url('<?php the_post_thumbnail_url(array(200, 200)); ?>');"></a>
						<div class="articles-element-info">
							<a href="<?php the_permalink(); ?>" class="articles-element-info-title">
							<?php the_title(); ?>
							</a>
							<span class="articles-element-info-date">
								<?php the_date(); ?>
							</span>
							<span class="articles-element-info-text">
								<?php the_excerpt(); ?>
							</span>
							<a href="<?php the_permalink(); ?>" class="articles-element-info-readnext">Читать далее</a>
						</div>
					</div>
					<?php
						endwhile;
					endif;
					?>
				</div>
			<!-- END OF CATEGORY -->
			<?php } ?>
		</div>
	</div>
</main> 
<?php get_footer(); ?>