jQuery(document).ready(function($){

	//по изменению количества товара сделаем измения суммы
	var tovarNum = $('input[data-type="tovar-num"]');
	tovarNum.bind('change', function(){

		//возьмем ЧИСЛЕННОЕ значение
		var value = +$(this).val();
		
		//проверим, не отрицательное ли оно
		if ( value >= 0 )
		{
			//берем значение сцммы товара
			var parent = $(this).closest('tr');
			var price = +parent.children('td').children('span[data-type="tovar-price"]').html();

			//увеличиваем общую сумму
			var sum = price * value;
			parent.children('td').children('span[data-type="tovar-sum"]').text(sum);
		}

	});

	
	//событие на добавление в корзину
	var addCart = $('a[data-type="add-cart"]');
	addCart.bind('click', function(event){

		event.preventDefault();

		//возьмем все нужные данные
		var parent = $(this).closest('tr');
		var tovarId = +parent.attr('data-tovar-id');
		var num = +parent.children('td').children('input[data-type="tovar-num"]').val();
		var price = +parent.children('td').children('span[data-type="tovar-price"]').html();

		//переменная, которая указывает, есть ли в массиве данный айди товара
		var hasTovar = false;

		//переберем массив, все узнаем
		for ( var i = 0; i < cart.length; i++ )
		{

			//проверим, есть ли такой товар у нас
			if ( cart[i][0] == tovarId )
			{
				//если да, то изменим его количество и изменим переменную hasTovar
				cart[i][1] = num;
				hasTovar = true;
			}

		}

		//если товара нет в массиве, то создадим
		if ( !hasTovar )
		{
			var tovarArr = [ tovarId, num, price ];
			cart.push(tovarArr);
		}

		//теперь изменим в корзине колифчество товаров и обущу сумму

		//сколько всего товаров
		var count = cart.length;

		//подсчитаем цену
		var totalSum = 0;
		for ( var i = 0; i < cart.length; i++ )
		{
			totalSum += cart[i][1] * cart[i][2];
		}

		//изменим вывод в корзине
		$('#main-header span[data-type="tovars-num"]').text(count);
		$('#main-header span[data-type="tovars-sum"]').text(totalSum);

		//возьмем csrf
		var csrf = $('#csrf').val();

		// формируем данные для аякса
		var data = 'action=add_cart' + '&tovar_id=' + tovarId
					+ '&num=' + num + '&csrf=' + csrf;

		//делаем аякс запрос
		$.ajax({
			url: ajaxUrl,
			type: 'POST',
			data: data,
		});


	});

});