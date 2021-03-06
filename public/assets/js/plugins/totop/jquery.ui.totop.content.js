/*
|--------------------------------------------------------------------------
| UItoTop jQuery Plugin 1.2 by Matt Varone
| http://www.mattvarone.com/web-design/uitotop-jquery-plugin/
|--------------------------------------------------------------------------
*/
(function($){
	$.fn.UItoTop = function(options) {

		var defaults = {
			text: 'To Top',
			min: 200,
			inDelay:600,
			outDelay:400,
			containerID: 'toTop',
			containerHoverID: 'toTopHover',
			scrollSpeed: 1200,
			easingType: 'linear'
		},
		settings = $.extend(defaults, options),
		containerIDhash = '#' + settings.containerID,
		containerHoverIDHash = '#'+settings.containerHoverID;

		$('#content').append('<a href="#" id="'+settings.containerID+'">'+settings.text+'</a>');
		$(containerIDhash).hide().on('click.UItoTop',function(){
			$('#content').animate({scrollTop:0}, settings.scrollSpeed, settings.easingType);
			$('#'+settings.containerHoverID, this).stop().animate({'opacity': 0 }, settings.inDelay, settings.easingType);
			return false;
		})
		.prepend('<span id="'+settings.containerHoverID+'"></span>')
		.hover(function() {
			$(containerHoverIDHash, this).stop().animate({
				'opacity': 1
			}, 600, 'linear');
		}, function() {
			$(containerHoverIDHash, this).stop().animate({
				'opacity': 0
			}, 700, 'linear');
		});

		$('#content').scroll(function() {
			var sd = $('#content').scrollTop();
			if(typeof document.body.style.maxHeight === "undefined") {
				$(containerIDhash).css({
					'position': 'absolute',
					'top': sd + $('#content').height() - 150
				});
			}
			if ( sd > settings.min )
				$(containerIDhash).fadeIn(settings.inDelay);
			else
				$(containerIDhash).fadeOut(settings.Outdelay);
		});
	};
})(jQuery);