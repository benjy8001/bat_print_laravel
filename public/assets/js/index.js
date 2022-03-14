
$(function () {
	$("#loginForm").validate({
		errorElement : 'div',
		errorPlacement: function(error, element) {
			var placement = $(element).data('error');
			if (placement) {
				$(placement).append(error)
			} else {
				error.insertAfter(element);
			}
		}
	});
});


function redimensionnement()
{
	var image_width = 1900;
	var image_height = 1200;
	/*
	var $image = $('img.bg');
	var image_width = $image.width();
	var image_height = $image.height();
	*/
	var over = image_width / image_height;
	var under = image_height / image_width;

	var body_width = $(window).width();
	var body_height = $(window).height();

	if (body_width / body_height >= over)
	{
		$('img.img-fond').css(
		{
			'position': 'fixed',
			'z-index': '-1',
			'width': body_width+15 + 'px',
			'height': Math.ceil(under * body_width) + 'px',
			'left': '0px',
			'top': Math.abs((under * body_width) - body_height) / -2 + 'px'
		});
	}
	else
	{
		$('img.img-fond').css(
		{
			'position': 'fixed',
			'z-index': '-1',
			'width': Math.ceil(over * body_height) + 'px',
			'height': body_height + 'px',
			'top': '0px',
			'left': Math.abs((over * body_height) - body_width) / -2 + 'px'
		});
	}

	if(isNaN(over) || over == 0 || under == 0)
	{
		setTimeout("redimensionnement()", 5);
	}
}



//Quand le DOM est pret, on masque le spinner de chargement
$(document).ready(function() {
	redimensionnement();
	$('#login-page').css(
	{
		'background': '#000',
		'padding': '5px',
		'border-radius': '2px'
	});
});

$(window).resize(function()
{
	redimensionnement();
});
