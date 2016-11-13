// --- VAR ---
// если что-то из этого false, то форма не отправится
var validation = {
	"customer_name_id": false,
	"customer_email_id": false,
	"customer_phone_id": false
}

// классы для отображения ошибки
var keyupAlertСlass = "contactForm-info-error-show";
var submitAlertClass = "contactForm-info-field-redAlert";

// паттерны для валидации
var validationPatterns = {
	"customer_name_id": new RegExp(/^[а-яА-ЯёЁa-zA-Z ]+$/),
	"customer_email_id": new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/),
	"customer_phone_id": new RegExp(/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/)
}
// --- END OF VAR ---

// функция для инициализации валидации формы
function init_cart_form_validation(){
	// присваиваем функцию при нажатии клавиши в инпуте
	bind_inputs_keyUp();

	// функция при попытке отправить форму
	bind_submit_click();
}

// присваивает событие по нажатии на клавишу для проверки инпутов по паттерну
function bind_inputs_keyUp(){
	$(".contactForm-info-field").each(function ( i ){
		$(this).bind("keyup", function(){
			on_keyUp($(this).attr('id')); 
		});
	});
} 

// присваивает событие при нажатии на кнопку "Отправить"
function bind_submit_click(){
	$("form").bind("submit", function(event){
		sumbit_check(event);
	});
}

// функция, срабатывающая при нажатии на клавишу в определенном инпуте
function on_keyUp(id){
	// получаем текст текущего инпута по его id
	var inputText = $("#"+id).val();
	// берем паттерн из массива паттернов по id
	var pattern = validationPatterns[id];

	// делаем тест
	var testResult = pattern.test(inputText);

	// записываем результаты теста в объект validation
	validation[id] = testResult;

	// если есть ошибка, показываем
	display_validation_result(id);
} 

// отображает ошибку при наборе в текущем инпуте
function display_validation_result(id){
	// id элемента с текстом ошибки
	var errorId = "#" + id + "_error";

	// показываем ошибку
	if (!validation[id]){
		$(errorId).addClass(keyupAlertСlass);
	}
	// скрываем ошибку
	else{
		$(errorId).removeClass(keyupAlertСlass);
		$("#"+id).removeClass(submitAlertClass);
	}
}

// проверяет, соблюдены ли все условия, перед отправкой формы
// если нет, отправка формы предотвращается
function sumbit_check(event){
	var preventSend = false;
	// проходимся по значениям validaion. если что-то false, 
	// предотвращаем отправку и подсвечиваем красным
	for (x in validation){
		var curId = "#" + x;
		if (!validation[x]){
			$(curId).addClass(submitAlertClass);
			preventSend = true;
		}
		else{
			$(curId).removeClass(submitAlertClass);
		}
	}

	if (preventSend){
		event.preventDefault();
	}
}