<?php get_header();?>
<main>
<?php 
	if(have_posts()):
	while(have_posts()):
		the_post();
	endwhile;
	endif;
?>
	<!-- CATEGORIES -->
	<div class="categories_container clearfix">
		<div class="categories">
			<span class="categories-title">
				Основные направления металлопродукции
			</span>
			<div class="categories-items">
				<a href="category.html" class="categories-items-element">
					<span class="categories-items-element-pic">
					<span class="categories-items-element-text">Сортовый прокат</span>
				</a>
				<a href="#" class="categories-items-element">
					<span class="categories-items-element-pic">
					<span class="categories-items-element-text">Листовой прокат</span>
				</a>
				<a href="#" class="categories-items-element">
					<span class="categories-items-element-pic">
					<span class="categories-items-element-text">Трубы</span>
				</a>
				<a href="#" class="categories-items-element">
					<span class="categories-items-element-pic">
					<span class="categories-items-element-text">Профнастил</span>
				</a>
				<a href="#" class="categories-items-element">
					<span class="categories-items-element-pic">
					<span class="categories-items-element-text">Сэндвич панели</span>
				</a>
				<a href="#" class="categories-items-element">
					<span class="categories-items-element-pic">
					<span class="categories-items-element-text">Сетка</span>
				</a>
				<a href="#" class="categories-items-element">
					<span class="categories-items-element-pic">
					<span class="categories-items-element-text">Метизы и метсырье</span>
				</a>
				<a href="#" class="categories-items-element">
					<span class="categories-items-element-pic">
					<span class="categories-items-element-text">Нержавеющий прокат</span>
				</a>
				<a href="#" class="categories-items-element">
					<span class="categories-items-element-pic">
					<span class="categories-items-element-text">Трубопроводная арматура</span>
				</a>
				<a href="#" class="categories-items-element">
					<span class="categories-items-element-pic">
					<span class="categories-items-element-text">Другое</span>
				</a>
			</div>
		</div>
	</div>
	<!-- END OF CATEGORIES -->
	
	<div class="container">
		
		<?php get_sidebar(); ?>
	</div>
	123
</main> 
<?php get_footer(); ?>