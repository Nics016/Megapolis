// чтобы не потерялись после окончания работы функции
	var multi = 1;
	var dimen = "1";

// инициализация
function init_range_car(multiplier, dimension){
	multi = multiplier;
	dimen = dimension;
	// id ползунка
	var range_car_id = "#range_car_id";

	// рассчет начального значения
	position_changed($(range_car_id).val());

	// назначаем функцию при изменении положения бегунка
	$(range_car_id).bind("input change", function(){
		position_changed($(this).val());
	})
}

function position_changed(val){
	$("#range_car_text_id").text(val + " " + dimen + " = " + val * multi + " Руб");
}