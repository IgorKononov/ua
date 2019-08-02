/* Russian (UTF-8) initialisation for the jQuery UI date picker plugin. */
/* Written by Andrew Stromnov (stromnov@gmail.com). */
///wa-content/js/jquery-ui/i18n
jQuery(function($){
	$.datepicker.regional['uk'] = {
		closeText: 'Закрити',
		prevText: '&#x3c;Назад',
		nextText: 'Далі&#x3e;',
		currentText: 'Сьогодні',
		monthNames: ['Січень','Лютий','Березень','Квітень','Травень','Червень',
		'Липень','Серпень','Вересень','Жовтень','Листопад','Грудень'],
		monthNamesShort: ['Січ','Лют','Бер','Квіт','Трав','Черв',
		'Лип','Серп','Вер','Жовт','Лист','Груд'],
		dayNames: ['неділя','понеділок','вівторок','середа','четвер','пятниця','субота'],
		dayNamesShort: ['нед','пнд','втр','срд','чтв','птн','сбт'],
		dayNamesMin: ['Нд','Пн','Вт','Ср','Чт','Пт','Сб'],
		weekHeader: 'Тжд',
		dateFormat: 'dd.mm.yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['uk']);
});