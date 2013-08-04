jQuery(document).ready(function($) {

	// Pretty Photo
	$("a[class^='prettyPhoto']").prettyPhoto();

	// Tipsy
	$('.tooltip').tipsy({
		gravity: $.fn.tipsy.autoNS,
		fade: true,
		html: true
	});

	$('.tooltip-s').tipsy({
		gravity: 's',
		fade: true,
		html: true
	});

	$('.tooltip-e').tipsy({
		gravity: 'e',
		fade: true,
		html: true
	});

	$('.tooltip-w').tipsy({
		gravity: 'w',
		fade: true,
		html: true
	});

	// Scroll
	jQuery.localScroll();

	// Prettyprint
	$('pre').addClass('prettyprint linenums');

	// Uniform
	$("select, input:checkbox, input:radio, input:file").uniform();
	
});
