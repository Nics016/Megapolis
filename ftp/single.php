<?php get_header();?>
<main>
	<div class="container clearfix">
		<?php get_sidebar(); ?>
		<!-- TABLE -->
		<div class="table-container clearfix">
			<div class="table">
				<?php 
					if(have_posts()):
					while(have_posts()):
						the_post();
				?>	
				<span class="table-title">
					<?php the_title(); ?>
				</span>
				<div class="table-text">
					<table class="table-text-elements">
						<?php the_content(); ?>
					</table>
				</div>
				<?php 
					endwhile;
					endif; 
				?>
			</div>
		</div>
		<!-- END OF TABLE -->
	</div>
</main> 
<?php get_footer(); ?>