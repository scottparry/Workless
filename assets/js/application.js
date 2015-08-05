(function($) {
    "use strict";
	
	// sidebar toggle
	$( "a.aside-open" ).on( "click", function(e) {
		e.preventDefault();
		
		$( "html, body" ).animate({ scrollTop: 0 }, 0);
		$( "#main, #aside" ).toggleClass( "toggled" );
		$( "a.aside-open i" ).toggleClass( "icon-close" );
	});
	
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

	// prettyprint
	$('pre').addClass('prettyprint');

})(jQuery);