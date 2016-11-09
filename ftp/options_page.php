<?php 
// регистрация настроек
add_action('customize_register', function($customizer){
    $customizer->add_section(
        'section_main_page',
        array(
            'title' => 'Настройки темы: главная страница',
            'description' => 'Главная страница',
            'priority' => 1,
        )
    );

    $customizer->add_section(
        'section_dostavka_page',
        array(
            'title' => 'Настройки темы: бегунок',
            'description' => 'Бегунок расчета стоимости доставки',
            'priority' => 1,
        )
    );

    init_main_page_inputs($customizer);
    init_dostavka_page_inputs($customizer);
});

function init_main_page_inputs($customizer){
	 // телефон
	$customizer->add_setting(
    'input_phone',
    array('default' => '8-495-777-44-55')
	);
	// контрол телефона
	$customizer->add_control(
    'input_phone',
    array(
        'label' => 'Номер телефона',
        'section' => 'section_main_page',
        'type' => 'text',
    )
	);

	// подпись под телефоном
	$customizer->add_setting(
    'input_phone_subtext',
    array('default' => 'Общий многоканальный телефон')
	);
	// контрол
	$customizer->add_control(
    'input_phone_subtext',
    array(
        'label' => 'Подпись под номером',
        'section' => 'section_main_page',
        'type' => 'text',
    )
	);

	// адрес
	$customizer->add_setting(
    'input_address',
    array('default' => 'г. Москва, пр-т Вернадского 62, стр 3')
	);
	// контрол
	$customizer->add_control(
    'input_address',
    array(
        'label' => 'Адрес',
        'section' => 'section_main_page',
        'type' => 'text',
    )
	);

	// текст до категорий
	$customizer->add_setting(
    'input_categories_title',
    array('default' => 'Основные направления металлопродукции')
	);
	// контрол
	$customizer->add_control(
    'input_categories_title',
    array(
        'label' => 'Заголовок категорий',
        'section' => 'section_main_page',
        'type' => 'text',
    )
	);
}

function init_dostavka_page_inputs($customizer){
	// min
	$customizer->add_setting(
    'input_min',
    array('default' => '1')
	);
	// контрол
	$customizer->add_control(
    'input_min',
    array(
        'label' => 'Минимальное значение деления',
        'section' => 'section_dostavka_page',
        'type' => 'text',
    )
	);

	// max
	$customizer->add_setting(
    'input_max',
    array('default' => '20')
	);
	// контрол
	$customizer->add_control(
    'input_max',
    array(
        'label' => 'Максимальное значение деления',
        'section' => 'section_dostavka_page',
        'type' => 'text',
    )
	);

	// step
	$customizer->add_setting(
    'input_step',
    array('default' => '1')
	);
	// контрол
	$customizer->add_control(
    'input_step',
    array(
        'label' => 'Делений за шаг',
        'section' => 'section_dostavka_page',
        'type' => 'text',
    )
	);

	// multiplier in Rubles
	$customizer->add_setting(
    'input_multiplier',
    array('default' => '133')
	);
	// контрол
	$customizer->add_control(
    'input_multiplier',
    array(
        'label' => 'Множитель в рублях',
        'section' => 'section_dostavka_page',
        'type' => 'text',
    )
	);

	// distance dimension (KM)
	$customizer->add_setting(
    'input_dimension',
    array('default' => 'КМ')
	);
	// контрол
	$customizer->add_control(
    'input_dimension',
    array(
        'label' => 'Дистанция измеряется в',
        'section' => 'section_dostavka_page',
        'type' => 'text',
    )
	);
}

?>