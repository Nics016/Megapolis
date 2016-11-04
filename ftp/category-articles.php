<?php /* Template Name: Category-Product */ ?>
<?php get_header();?>
<main>
	<div class="container clearfix">
		<?php get_sidebar(); ?>
		<!-- CONTENT -->
		<div class="content clearfix">
			<div class="articles">
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
		</div>
		<!-- END OF CONTENT -->
	</div>
</main> 
<?php get_footer(); ?>