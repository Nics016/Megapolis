<!-- GETTING THEME OPTIONS VARIABLE -->
<?php 
	$var_email1 = get_theme_mod('input_email1', 'info@megapolis-mck.ru'); 
?>
<!-- END OF GETTING THEME OPTIONS VARIABLE -->
	<footer>
		<div class="container clearfix">
			<?php $terms = get_children_terms(19); ?>

			<!-- FOOTER-CATEGORIES -->
			<div class="footer-categories">
				<span class="footer-categories-title">
					Категории
				</span>
				<hr class="footer-categories-hr">
				<ul id="footer-categories-menu">
				<?php 
					if (!empty($terms) && !is_wp_error($terms) ){
						foreach ($terms as $term) {
							// выводим только первых детей категории:
							$category = get_category($term->term_taxonomy_id);
							$Parent_ID = $category->category_parent;
							if ($Parent_ID == 19)
							{
				?>
					<li>
						<a href="<?php echo('/category' . $taxonomy . '/' . $term->slug);?>"> <?php echo $term->name; ?> </a>
					</li>
				<?php
							}
						}
					}
				?>
				</ul>
			</div>
			<div class="footer-info">
				<span class="footer-info-title">
					Информация
				</span>
				<hr class="footer-categories-hr">
				<div class="footer-info-links">
					<a href="http://megapolis-mck.ru/about/">О компании</a>
					<a href="http://megapolis-mck.ru/dostavka/">Оплата и доставка</a>
					<a href="http://megapolis-mck.ru/contacts/">Контакты</a>
				</div>
			</div>
			<div class="footer-shopinfo">
				<span class="footer-shopinfo-title">
					Информация о магазине
				</span>
				<hr class="footer-categories-hr">
				<div class="footer-shopinfo-text">
					<span>ООО «Мегаполис» <br><br>
					ОГРН : 1137746456517<br> 
					ИНН: 7718934553<br>
					КПП: 771801001<br>
					РС: 40702810300000005908<br><br></span>
					<i class="fa fa-envelope" aria-hidden="true"></i>
					<span class="footer-shopinfo-text-email">E-mail: <?= $var_email1 ?></span>
				</div>
			</div>
		</div>
	</footer>

	<input type="hidden" id="csrf" name="csrf" value="<?= csrf() ?>">

	<div id="add-cart-modal"></div>
</div>
</body>
</html>