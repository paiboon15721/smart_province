$(document).ready(function() {
	$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({
		animation_speed : 'fast',
		slideshow : 3000,
		hideflash : true,
		autoplay_slideshow : false,
		social_tools : false
	});
});