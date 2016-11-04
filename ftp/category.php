<?php /* Template Name: Category-Product */ ?>
<?php get_header();?>
<main>
	<div class="container clearfix">
		<?php get_sidebar(); ?>
		<!-- CATEGORY -->
		<div class="category-container clearfix">
			<div class="category">
				<span class="category-title">
						<?php single_cat_title();?>
				</span>
				<div class="category-elements">
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
				?>
				</div>
			</div>
		</div>
		<!-- END OF CATEGORY -->
	</div>
</main> 
<?php get_footer(); ?>