<?php get_header();?>
<main>
	<div class="container">
		<?php get_sidebar(); ?>
		<?php 
			if(have_posts()):
			while(have_posts()):
				the_post();
		?>	
		<div class="category-container clearfix">
			<?php the_title(); ?>
			<?php the_title(); ?>
		</div>

		<?php 
			endwhile;
			endif; 
		?>
	</div>
	123
</main> 
<?php get_footer(); ?>