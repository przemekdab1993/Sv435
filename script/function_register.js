$(function(){
	$('.red_error').each(function() {
		if($(this).text().length != 10)
		{
			$(this).prev().prev().addClass('red_input');
		}
	});
	$('input[type=submit]').on('click', function(e) {
		if($('input').not('[type=submit]').val() == '')
		{
			e.preventDefault();
		}
	});
	$('input').not('[type=submit]').on('change', function(){
		$(this).removeClass('red_input');
		$(this).next().next().text('');
	});
});