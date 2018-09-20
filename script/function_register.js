// script dla strony register.php

// skrypt wykonywany po załadowani zasobów strony
$(function(){
	// dodawanie klasy red_error(malowanie na czerwono) do input'ów jeżeli przesłano komunikat błędu logowania
	$('.red_error').each(function() {
		if($(this).text().length != 10)
		{
			$(this).prev().prev().addClass('red_input');
		}
	});
	
	// zablokowanie przycisku submit(logowania) jeżeli nie zostanie wypełniony input loginu
	$('input[type=submit]').on('click', function(e) {
		if($('input').not('[type=submit]').val() == '')
		{
			e.preventDefault();
		}
	});
	
	// w przypadku zmiany wartości inputa następuje usunięcie komunikatu o błędzie wprowadzanych danych oraz usunięcie klasy red_input(czerwony) temu inputowi
	$('input').not('[type=submit]').on('change', function(){
		$(this).removeClass('red_input');
		$(this).next().next().text('');
	});
});