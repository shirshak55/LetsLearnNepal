(function( $, window, document, undefined ){
var ww = document.body.clientWidth;
$(document).ready(function() {
	$(".toggleMenu").click(function(e) {
		e.preventDefault();
		$(".menu").toggle();
	});
	$(".menu li a").each(function() {
		if ($(this).next().length > 0) {
			$(this).addClass("parent");
		};
	})
	adjustMenu();
});
function adjustMenu() {
	if (ww < 800) {
		$(".toggleMenu").css("display", "inline-block");
		$(".menu").hide();
		$(".menu li a.parent").click(function(e) {
			e.preventDefault();
		 	$(this).parent("li").toggleClass('hover');
		});
	} else {
		$(".toggleMenu").css("display", "none");
		$(".menu li").hover(function() {
		 		$(this).addClass('hover');
			}, function() {
				$(this).removeClass('hover');
		});
	}
}
$(window).bind('resize orientationchange', function() {
	ww = document.body.clientWidth;
	adjustMenu();
});
})( jQuery, window, document );