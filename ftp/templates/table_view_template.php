<?php
	/* 
	Тут вся грязь по выводу таблицы, инпуты нахуй не нужны
	из всех дата аттрибутов мне нужно, чтобы ты веыл один - это айди товара, по коду я тебе оставлю коммент
	там где название колонки дейстивие - туда вставь кнопку купить, и чтобы у этой кнопки был дата аттрибут
	data-event="buy" или что то типо такого, на твое усмотрение

	в page-main тоже все окмменты написал
	класс, откуда я беру данные в функцих, его не изменяй

	после этой строчки в page-main оже написать echo "</br>";
	чтобы между таблицами был отступ, idшнки таблицы помнишь где
	$Model->view_table($table_data, $tovars);

	Да прибудет с тобой Сила, мой падаван!

	*/

	
	$table_price = $table_data['price']; // переменная наименовании цены типо "за метр" и тд
	$table_attrs = unserialize($table_data['attributes']); // а тут имена аттрибутов таблицы
?> 
<table id="table" class="table-text-elements" name="<?= $table_data['name']; ?>">
	<tbody id="table-tbody">
	<tr>
		<th data-pos="image"></th>
		<th data-pos="name">Название</th>
		<th data-pos="description">Описание</th>
		
		<?php for ( $i = 0; $i < count($table_attrs); $i++ ): ?>
			<!-- 
			вот тут как раз и используется $table_attrs
			надеюсь, ты помнишь, что мне дата аттрибуты и лишние классы не нужны 
			-->
			<th data-pos="<?= $i ?>"><?= $table_attrs[$i] ?></th>	
		<?php endfor; ?>

		<th data-pos="price">Цена <span><?= $table_price //наименование цены, вставляй, как хочешь?></span></th>
		<th>Количество</th>
		<th>Сумма</th>
		<th data-pos="action"></th>

	</tr>
	

	<?php 
	for ( $i = 0; $i < count($tovars); $i++ ): 
		/*
		Тут я беру все данные о товаре
		description, name, image_link, price - соответсвенно описание, имя, ссылка на картинку и цена товара
		описание и ммя - рандомный текст
		ссылка на картинку вотки в тег img, щагрузи в вп картинку, выведи для пробы
		цена - бд выводить только цифры, выведи цену и прилепи span с купюрой например руб. или р. или эмблема рубля
		*/
		$tovar = $tovars[$i]; //тут я сохраняю ассоциативный массив текущей итерации
		$attrs = unserialize($tovar['attributes']); // тут массив аттрибутов они должны выводится строго по порядку
	?>

	<!-- data-tovar-id оставь, по нему буду считывать айди товара, больше дата аттрибутов не нужно -->
	<tr data-tovar-id="<?= $tovar['ID'] ?>">
		<td>
			<?php $img_url = $tovar['image_link']; // url картинки товара?>
			<img class="table-text-elements-pic" src="<?php echo $img_url; ?>">
		</td>

		<td>
			<?= $tovar['name'] //вывожу имя ?>
		</td>

		<td>
			<?= $tovar['description'] //вывожу описание?>
		</td>

		<!--
		цикд перебора аттрибутов товара (кнопка "добавить ячейку" в админку)
		ВЫВОД СТРОГО ПО ПОРЯДКУ дата аттрибуты мне нуны, напонмю, на всякий
		-->
		<?php for( $x = 0; $x < count($attrs); $x++ ): ?> 
			<td>
				<span data-table-attr="<?= $x ?>"><?= $attrs[$x] //значение аттрибута?></span>
			</td>
		<?php endfor; ?>

		<td>
			<!--
			тут вывод цены, помни про span с именем валюты
			дата аттрибуты тоже не нужны
			-->
			<span><?= $tovar['price'] ?> руб.</span>
		</td>
		<!-- количество товара -->
		<td><input type="number" class="table-text-elements-num" value="1" min="1" max="10000" step="1"></td>
		<!-- сумма -->
		<td> 0 руб.</td>

		<td>
			<!--
			тут организуй кнопку купить
			-->
			<a href="#" class="table-text-elements-cart">
				В корзину
			</a>
		</td>
	</tr>
	
	<?php endfor; ?>

	</tbody>
</table>