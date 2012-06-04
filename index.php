<!doctype html>

<!--[if lt IE 7]> 
	<html class="nojs ms lt_ie7" lang="en"> 
<![endif]-->

<!--[if IE 7]>    
	<html class="nojs ms ie7" lang="en"> 
<![endif]-->

<!--[if IE 8]>    
	<html class="nojs ms ie8" lang="en"> 
<![endif]-->

<!--[if gt IE 8]> 
	<html class="nojs ms" lang="en"> 
<![endif]-->

<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="author" content="iKreativ">
	<meta name="description" content="Workless - A classy HTML5, CSS3 framework">
	<meta name="keywords" content="workless, classy, css, framework, jquery, bootstrap, h5bp, twitter, bolierplate, jquery, html5, ikreativ">
	
	<!-- Mobile Viewport -->
    <meta name="viewport" content="width=device-width">

	<title>Workless - A classy HTML5, CSS3 framework</title>

    <!-- 
		You'll notice that we're loading all the CSS via a minification script. 
		This script joins all the CSS files referenced and minifies them to
		reduce HTTP requests and speed up the site.

		This also allow you to work with each individual file for development
		and only serve the minified version for production.

		The CSS files served are added inside minified.css.php
	-->
	
	<!-- 
		Commented for minification script
	
    	<link href="assets/css/plugins.css" rel="stylesheet">
		<link href="assets/css/workless.css" rel="stylesheet">
		<link href="assets/css/typography.css" rel="stylesheet">
		<link href="assets/css/forms.css" rel="stylesheet">
		<link href="assets/css/tables.css" rel="stylesheet">
		<link href="assets/css/buttons.css" rel="stylesheet">
		<link href="assets/css/alerts.css" rel="stylesheet">
		<link href="assets/css/tabs.css" rel="stylesheet">
		<link href="assets/css/pagination.css" rel="stylesheet">
		<link href="assets/css/breadcrumbs.css" rel="stylesheet">
		<link href="assets/css/icons.css" rel="stylesheet">
		<link href="assets/css/helpers.css" rel="stylesheet">
		<link href="assets/css/print.css" rel="stylesheet">
		<link href="assets/css/application.css" rel="stylesheet">
		<link href="assets/css/responsive.css" rel="stylesheet">
	-->
	
	<!-- We're minifying and combining all the CSS -->
	<link href="assets/css/minified.css.php" rel="stylesheet">

	<!-- Googlelicious -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open Sans:regular,bold" type="text/css" />
	
	<!-- All JavaScript at the bottom, except modernizr -->
  	<script type="text/javascript" src="assets/js/modernizr.js"></script>
</head>

<body id="top" onload="prettyPrint()">

<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6 -->
<!--[if lt IE 7]>
	<p>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p>
<![endif]-->

<!-- topbar -->
<div id="topbar">
	<div class="wrapper logo">
		<a href="//workless.ikreativ.com">
			{ workless.css }
		</a>
        <small> A clean <span class="fancyamp">&amp;</span> classy HTML5, CSS3 framework.</small>

        <nav id="primary">
			<ul>
				<li><a href="#">Base CSS</a></li>
				<li><a href="#">Scaffold</a></li>
				<li><a href="#">Forms</a></li>
				<li><a href="#">Tables</a></li>
				<li><a href="#">Helpers</a></li>
				<li><a href="#">Responsive</a></li>
				<li><a href="#">Plugins</a></li>
			</ul>
		</nav>
	</div>
</div>
<!-- /topbar -->

	<section class="wrapper">
		<header>
			<div class="intro">
        		Workless is a clean <span class="fancyamp">&amp;</span> classy HTML5, CSS3 framework that helps you to get your project up and running as fast as possible and tries to prevent repetitive tasks.
			</div>
		</header>
		
		<h3>What does it do?</h3>
       	<ul>
           	<li><strong>Standardizes CSS</strong> for a wide range of HTML elements.</li>
           	<li><strong>Improves usability and interaction</strong> with subtle improvements.</li>
           	<li><strong>Sets base typography</strong> to help vertical rhythm and readability.</li>
			<li><strong>Adds helper classes</strong> to style elements easily.</li>
			<li><strong>Combines and compresses CSS</strong> if you want it to!</li>
        </ul>
		
		<hr>
		
      	<h3>How do I use it?</h3>
       	<p>Drop the files into your project and then reference the CSS and Javascript files in your source. Once you've done this you can then begin adding your own application specific CSS.</p>
		<p><strong>Don't forget!</strong> If you intend to use the entire framework ensure that you combine all the CSS stylesheets into one or two files to reduce HTTP requests. The typical file structure would look like:</p>
		
<pre>
&lt;link href="assets/css/plugins.css" rel="stylesheet"&gt; // all javascript plugins css
&lt;link href="assets/css/workless.css" rel="stylesheet"&gt; // main framework css
&lt;link href="assets/css/application.css" rel="stylesheet"&gt; // app specific css (your code)
&lt;link href="assets/css/responsive.css" rel="stylesheet"&gt; // media queries
</pre>

		<p>This is just a suggested way to use the framework, feel free to use however you want!</p>
		
		<hr>
		
		<h3>Get your hands on it!</h3>
        <ul class="nolist">
        	<li><a class="alignleft large button blue flat" href="//github.com/iKreativ/Workless"><i class="icon-inbox icon-white"></i> Workless on GitHub</a></li>
            <li><a class="large button pink flat" href="//github.com/iKreativ/Workless/zipball/master"><i class="icon-download-alt icon-white"></i> Download .ZIP</a></li>
        </ul>

		<p>You can also clone the repo on GitHub.</p>
		
<pre>
$ git clone git@github.com:iKreativ/Workless.git
</pre>
		
		<p>Feel free to fork, use, abuse and modify to suit your project. Found a bug? <a href="//github.com/iKreativ/Workless">Submit a pull request!</a></p>
		
		<hr>
		
		<footer>
        	<p class="small muted">A project by <a href="//ikreativ.com">Scott Parry</a> (<a href="//twitter.com/iKreativ">@iKreativ</a>). Originally based off <a href="//html5boilerplate.com/">H5BP</a> and <a href="//twitter.github.com/bootstrap/">Bootstrap</a>. Released under the <a href="//philsturgeon.co.uk/code/dbad-license/">DBAD License</a>.</p>
		</footer>
	</section>

<!-- JavaScript at the bottom for fast page loading -->

<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="assets/js/jquery.js"><\/script>')</script>

<!-- scripts  -->
<script src="assets/js/plugins.js"></script>
<script src="assets/js/application.js"></script>
<!-- /scripts -->

<!-- Asynchronous Google Analytics snippet. Change UA-XXXXX-X to be your site's ID -->
<script>
    var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
    (function(d,t){
		var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    	s.parentNode.insertBefore(g,s)
	}(document,'script'));
</script>

</body>
</html>
