/**
 * Child Theme script file.
 *
 * @package twentysixteen-child
 * @since 1.0.1
 */
( function( $ ) {
    $( document ).ready( function($) {
	var offset = 220;
	var duration = 500;
	$(window).scroll(function() {
	if ($(this).scrollTop() > offset) {
		$('.back-to-top').fadeIn(duration);
	} else {
		$('.back-to-top').fadeOut(duration);
		}
	});
	
	$('.back-to-top').click(function(event) {
	event.preventDefault();
	$('html, body').animate({scrollTop: 0}, duration);
	return false;
	});
});
})( jQuery );