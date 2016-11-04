<?php get_header();?>
<main>
	<div class="container clearfix">
		<?php get_sidebar(); ?>
		<div class="content">
			<?php
				if(have_posts()):
				while(have_posts()):
					the_post();
			?>	
			<span class="content-title">
				<?php the_title(); ?>
			</span>
			<div class="content-text">
				<?php the_content(); ?>
			</div>
			<?php 
				endwhile;
				endif;
			 ?>
		</div>
	</div>
</main> 
<?php get_footer(); ?>