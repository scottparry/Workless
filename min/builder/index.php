<?php 

if (phpversion() < 5) {
    exit('Minify requires PHP5 or greater.');
}

// check for auto-encoding
$encodeOutput = (function_exists('gzdeflate')
                 && !ini_get('zlib.output_compression'));

// recommend $min_symlinks setting for Apache UserDir
$symlinkOption = '';
if (0 === strpos($_SERVER["SERVER_SOFTWARE"], 'Apache/')
    && preg_match('@^/\\~(\\w+)/@', $_SERVER['REQUEST_URI'], $m)
) {
    $userDir = DIRECTORY_SEPARATOR . $m[1] . DIRECTORY_SEPARATOR;
    if (false !== strpos(__FILE__, $userDir)) {
        $sm = array();
        $sm["//~{$m[1]}"] = dirname(dirname(__FILE__));
        $array = str_replace('array (', 'array(', var_export($sm, 1));
        $symlinkOption = "\$min_symlinks = $array;";
    }
}

require dirname(__FILE__) . '/../config.php';

if (! $min_enableBuilder) {
    header('Location: /');
    exit();
}

$setIncludeSuccess = set_include_path(dirname(__FILE__) . '/../lib' . PATH_SEPARATOR . get_include_path());
// we do it this way because we want the builder to work after the user corrects
// include_path. (set_include_path returning FALSE is OK).
try {
    require_once 'Solar/Dir.php';    
} catch (Exception $e) {
    if (! $setIncludeSuccess) {
        echo "Minify: set_include_path() failed. You may need to set your include_path "
            ."outside of PHP code, e.g., in php.ini.";    
    } else {
        echo $e->getMessage();
    }
    exit();
}
require 'Minify.php';

$cachePathCode = '';
if (! isset($min_cachePath)) {
    $detectedTmp = rtrim(Solar_Dir::tmp(), DIRECTORY_SEPARATOR);
    $cachePathCode = "\$min_cachePath = " . var_export($detectedTmp, 1) . ';';
}

ob_start();
?>
<!doctype html>

<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]> <html class="no-js" lang="en"> 		   <![endif]-->

<title>Workless Minify URI Builder</title>

<meta name="robots" content="noindex, nofollow">

<!-- Add workless to this directory -->
<link rel="stylesheet" href="../../assets/css/plugins.css">
<link rel="stylesheet" href="../../assets/css/workless.css">

<body>
	
<div class="container">
	
	<?php if ($symlinkOption): ?>
    	<div class="block-message info">
			<p><strong>Note:</strong> It looks like you're running Minify in a user directory. You may need the following option in /min/config.php to have URIs correctly rewritten in CSS output:</p>
			<br>
			<textarea id="symlinkOpt rows=3 cols=80 readonly"><?php echo htmlspecialchars($symlinkOption); ?></textarea>
		</div>
	<?php endif; ?>

	<div class="block-message error" id="jsDidntLoad">
		<p><strong>Uh Oh.</strong> Minify was unable to serve Javascript for this app. To troubleshoot this, <a href="http://code.google.com/p/minify/wiki/Debugging">enable FirePHP debugging</a> and request the <a id="builderScriptSrc" href="#">Minify URL</a> directly. Hopefully the FirePHP console will report the cause of the error.</p>
	</div>

	<?php if ($cachePathCode): ?>
		<div class="block-message info">
			<p>
				<strong>Note:</strong>
				<code><?php echo htmlspecialchars($detectedTmp); ?></code> was discovered as a usable temp directory. To slightly improve performance you can hardcode this in /min/config.php:
    			<code><?php echo htmlspecialchars($cachePathCode); ?></code>
			</p>
		</div>
	<?php endif; ?>

	<div id="minRewriteFailed" class="hide block-message error">
		<p><strong>Note:</strong> Your webserver does not seem to support mod_rewrite (used in /min/.htaccess). Your Minify URIs will contain "?", which <a href="http://www.stevesouders.com/blog/2008/08/23/revving-filenames-dont-use-querystring/"> may reduce the benefit of proxy cache servers</a>.</p>
	</div>

	<hr>

	<h3>Workless Minify URI Builder</h3>

	<noscript>
		<div class="block-message error">
			<p>Javascript and a browser supported by jQuery 1.2.6 is required for this application.</p>
		</div>
	</noscript>

	<!-- Start app -->
	<div id="app">

		<p>Create a list of Javascript or CSS files (or 1 is fine) you'd like to combine and click [Update].</p>

		<ol id="sources">
			<li></li>
		</ol>

		<div id="add">
			<button>Add file +</button>
		</div>

		<div id="bmUris"></div>
		
		<button id="update">Update</button>
		
		<hr>

		<!-- Start results -->
		<div id="results">
			<h4>Minify URI</h4>
			<p>Place this URI in your HTML to serve the files above combined, minified, compressed and with cache headers.</p>

			<table id="uriTable">
    			<tr>
					<th>URI</th>
					<td><a id="uriA" class="ext">min</a> <small>(opens in new window)</small></td>
				</tr>
    			
				<tr>
					<th>HTML</th>
					<td><input id="uriHtml" type="text" size="100" readonly></td>
				</tr>
			</table>

			<h4>How to serve these files as a group</h4>
			<p>For the best performance you can serve these files as a pre-defined group with a URI like: <code><span class="minRoot">/min/?</span>g=keyName</code></p>
			<p>To do this, add a line like this to /min/groupsConfig.php:</p>

<pre><code>return array(
<span>... your existing groups here ...</span>
<input id="groupConfig" size="100" type="text" readonly>
);</code></pre>

			<p><em>Make sure to replace <code>keyName</code> with a unique key for this group.</em></p>
		</div>
		<!-- End results -->

		<!-- Begin find uri -->
		<div id="getBm">
			<h4>Find URIs on a Page</h4>
			<p>You can use the bookmarklet below to fetch all CSS &amp; Javascript URIs from a page on your site. When you active it, this page will open in a new window with a list of available URIs to add.</p>
			<div class="btn blue alignleft">
				<a id="bm">Create Minify URIs</a> <small>(right-click, add to bookmarks)</small>
			</div>
		</div>
		<!-- End find uri -->

		<hr>

		<h4>Combining CSS files that contain <code>@import</code></h4>
		<p>If your CSS files contain <code>@import</code> declarations, Minify will not remove them. Therefore, you will want to remove those that point to files already in your list, and move any others to the top of the first file in your list (imports below any styles will be ignored by browsers as invalid).</p>
		<p>If you desire, you can use Minify URIs in imports and they will not be touched by Minify. E.g. <code>@import "<span class="minRoot">/min/?</span>g=css2";</code></p>
		
		<hr>

		<h4>Debug Mode</h4>
		<p>When /min/config.php has <code>$min_allowDebugFlag = <strong>true</strong>;</code> you can get debug output by appending <code>&amp;debug</code> to a Minify URL, or by sending the cookie 		<code>minDebug=&lt;match&gt;</code>, where <code>&lt;match&gt;</code> should be a string in the Minify URIs you'd like to debug. This bookmarklet will allow you to set this cookie.</p>
		
		<div class="btn blue alignleft">
			<a id="bm2">Minify Debug</a> <small>(right-click, add to bookmarks)</small>
		</div>

</div>
<!-- End app -->

<hr>

<br>

<p>Need help? Check the <a href="http://code.google.com/p/minify/w/list?can=3">wiki</a>, or post to the <a class=ext href="http://groups.google.com/group/minify">discussion list</a>.</p>
<p><small>Powered by Minify <?php echo Minify::VERSION; ?></small></p>

</div>
<!-- /container -->

<!-- JavaScript at the bottom for fast page loading -->

<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/libs/jquery.js"><\/script>')</script>

<!-- Scripts -->
<script defer src="../../assets/js/plugins.js"></script>
<script defer src="../../assets/js/script.js"></script>
<!-- End Scripts -->

<!-- Change UA-XXXXX-X to be your site's ID -->
<script>
  window._gaq = [['_setAccount','UAXXXXXXXX1'],['_trackPageview'],['_trackPageLoadTime']];
  Modernizr.load({
    load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
  });
</script>

<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6. chromium.org/developers/how-tos/chrome-frame-getting-started -->
<!--[if lt IE 7 ]>
  <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
<![endif]-->

<script>
$(function () {
    // give Minify a few seconds to serve _index.js before showing scary red warning
    $('#jsDidntLoad').hide();
    setTimeout(function () {
        if (! window.MUB) {
            // Minify didn't load
            $('#jsDidntLoad').show();
        }
    }, 3000);

    // detection of double output encoding
    var msg = '<\p class="block-message error"><\strong>Warning:<\/strong> ';
    var url = 'ocCheck.php?' + (new Date()).getTime();
    $.get(url, function (ocStatus) {
        $.get(url + '&hello=1', function (ocHello) {
            if (ocHello != 'World!') {
                msg += 'It appears output is being automatically compressed, interfering ' 
                     + ' with Minify\'s own compression. ';
                if (ocStatus == '1')
                    msg += 'The option "zlib.output_compression" is enabled in your PHP configuration. '
                         + 'Minify set this to "0", but it had no effect. This option must be disabled ' 
                         + 'in php.ini or .htaccess.';
                else
                    msg += 'The option "zlib.output_compression" is disabled in your PHP configuration '
                         + 'so this behavior is likely due to a server option.';
                $(document.body).prepend(msg + '<\/p>');
            } else
                if (ocStatus == '1')
                    $(document.body).prepend('<\p class=topNote><\strong>Note:</\strong> The option '
                        + '"zlib.output_compression" is enabled in your PHP configuration, but has been '
                        + 'successfully disabled via ini_set(). If you experience mangled output you '
                        + 'may want to consider disabling this option in your PHP configuration.<\/p>'
                    );
        });
    });
});
</script>

<script>
// workaround required to test when /min isn't child of web root
var src = location.pathname.replace(/\/[^\/]*$/, '/_index.js').substr(1);
src = "../?f=" + src;
document.write('<\script type="text/javascript" src="' + src + '"><\/script>');
$(function () {
    $('#builderScriptSrc')[0].href = src;
});
</script>

</body>
</html>
<?php
$content = ob_get_clean();

// setup Minify
if (0 === stripos(PHP_OS, 'win')) {
    Minify::setDocRoot(); // we may be on IIS
}
Minify::setCache(
    isset($min_cachePath) ? $min_cachePath : ''
    ,$min_cacheFileLocking
);
Minify::$uploaderHoursBehind = $min_uploaderHoursBehind;

Minify::serve('Page', array(
    'content' => $content
    ,'id' => __FILE__
    ,'lastModifiedTime' => max(
        // regenerate cache if any of these change
        filemtime(__FILE__)
        ,filemtime(dirname(__FILE__) . '/../config.php')
        ,filemtime(dirname(__FILE__) . '/../lib/Minify.php')
    )
    ,'minifyAll' => true
    ,'encodeOutput' => $encodeOutput
));
