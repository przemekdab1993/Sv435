function show_login()
{
	$('.black_back').show();
}

$(function(){
	$('#log_set').on('click', function(){
		show_login();
	});
});