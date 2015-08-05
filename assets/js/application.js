(function($) {
    "use strict";

    // instantiate scrollreveal
    var config = {
        after: '0.02s',
        enter: 'bottom',
        move: '50px',
        over: '0.5s',
        easing: 'ease-in-out',
        viewportFactor: 0.40,
        reset: true,
        init: true
    };
    window.scrollReveal = new scrollReveal( config );

	// Responsive menu
  	$(".open").pageslide();

	// Prettyprint
	$('pre').addClass('prettyprint');

})(jQuery);