function show_login()
{
	$('.backgrand_alert').show();
}

$(function(){
	$('#log_set').on('click', function(){
		show_login();
	});
});