function show_login()
{
	if($('.red_error').text().length <= 10)
	{
		$('.black_back').show();
		$('.form_login_container').animate({top: '80px'}, 800);
	}
	else
	{
		$('.black_back').show();
		$('.form_login_container').animate({top: '80px'}, 0);
	}
}

$(function(){
	$('#log_set').on('click', function(){
		show_login();
	});
	
	$('.alert').on('click', function() {
		$('.alert_container').animate({opacity: '0.2'}, 1000, function(){ $('.alert').fadeOut(400);});
	});
	
	$('#exit').on('click', function(e) {
		e.preventDefault();
		$('.form_login_container').animate({top: '-400px'}, 2000, function(){ $('.black_back').fadeOut(400); 
																				$('.red_error').text('');
																				$('input').not('[type=submit]').removeClass('red_input').val('');
																				});
	});
	if($('.red_error').text().length > 10)
	{
		$('input').not('[type=submit]').addClass('red_input');
	}
	$('input[type=submit]').on('click', function(e) {
		if($('input').not('[type=submit]').val() == '')
		{
			e.preventDefault();
		}
	});
});