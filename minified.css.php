<?php 
header('Content-type: text/css');
ob_start("compress");

	function compress($buffer) {
		/* remove comments */
    	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
    		
    	/* remove tabs, spaces, newlines, etc. */
    	$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
    		
    	return $buffer;
	}

  	/* css files for compression */
  	include('assets/css/plugins.css');
  	include('assets/css/workless.css');
  	include('assets/css/typography.css');
  	include('assets/css/forms.css');
  	include('assets/css/tables.css');
  	include('assets/css/buttons.css');
  	include('assets/css/alerts.css');
 	include('assets/css/tabs.css');
  	include('assets/css/pagination.css');
  	include('assets/css/breadcrumbs.css');
  	include('assets/css/icons.css');
  	include('assets/css/helpers.css');
  	include('assets/css/print.css');
  	include('assets/css/application.css');
  	include('assets/css/responsive.css');

ob_end_flush();
?>