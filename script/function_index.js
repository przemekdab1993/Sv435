// script dla register.php

// funkcja wyświetlająca ukryty panelu logowania
function show_login() 
{
	if($('.red_error').text().length <= 10)
	{
		// wyświetlanie  panelu z animacją jeśli jest to pierwsza próba logowania
		$('.black_back').show();
		$('.form_login_container').animate({top: '80px'}, 800);
	}
	else
	{
		// wyświetlanie bez animacji jeśli nastąpiło ponowne załadowanie strony z powodu niepowodzania logowania
		$('.black_back').show();
		$('.form_login_container').animate({top: '80px'}, 0);
	}
}

// skrypt wykonywany po załadowani zasobów strony
$(function(){
	// reakcja na kliknięcie przycisku do panelu logowania
	$('#log_set').on('click', function(){
		show_login();
	});
	
	// zamykanie kliknięciem wyświetlanego komunikat
	$('.alert').on('click', function() {
		$('.alert_container').animate({opacity: '0.2'}, 1000, function(){ $('.alert').fadeOut(400);});
	});
	
	// zamykanie panelu logowani oraz wyczyszczenie go z błędów logowania
	$('#exit').on('click', function(e) {
		e.preventDefault();
		$('.form_login_container').animate({top: '-400px'}, 2000, function(){ $('.black_back').fadeOut(400); 
																				$('.red_error').text('');
																				$('input').not('[type=submit]').removeClass('red_input').val('');
																				});
	});
	
	// dodawanie klasy red_error(malowanie na czerwono) do input'ów jeżeli przesłano komunikat błędu logowania 
	if($('.red_error').text().length > 10)
	{
		$('input').not('[type=submit]').addClass('red_input');
	}
	
	// zablokowanie przycisku submit(logowania) jeżeli nie zostanie wypełniony input loginu
	$('input[type=submit]').on('click', function(e) {
		if($('input').not('[type=submit]').val() == '')
		{
			e.preventDefault();
		}
	});
});