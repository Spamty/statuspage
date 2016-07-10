<?php
// choose correct translation file
switch ($_GET['lang']){
	case "de":
		$lcAll = "de_DE";
		break;
	case "es":
		$lcAll = "es_ES";
		break;
	case "ej":
		$lcAll = "en_IN";
		break;
	case "fr":
		$lcAll = "fr_FR";
		break;
	case "up":
		$lcAll = "en_NG";
		break;
	case "zh":
		$lcAll = "zh_CN";
		break;
	default:
		$_GET['lang'] = "en";
		$lcAll = "en_US";
}

// translation settings
putenv('LC_ALL='.$lcAll);
setlocale(LC_ALL, $lcAll);
bindtextdomain("spamty", "./translate");
bind_textdomain_codeset("spamty", 'UTF-8');
textdomain("spamty");

// link translation
function _l ( $text, $url, $attributes ){
	// this is a function to translate a text with link
	// Example usage: echo _l( _('text <a>with link</a>'), 'http://example.com', 'title="'._('example link').'"' );
	$newText = preg_replace('#<a>(.*?)</a>#', '<a href="'.$url.'" '.$attributes.'>$1</a>', $text);
	return $newText; 
}

?>
<!DOCTYPE html>
<html lang="<?php echo $_GET['lang']; ?>">
  <head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="//cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.6/cosmo/bootstrap.min.css" rel="stylesheet" />
	<link href="//d1r0dd7tzzqtcd.cloudfront.net/css/spamty.css" rel="stylesheet" />
	<link href="//d1r0dd7tzzqtcd.cloudfront.net/css/flags.css" rel="stylesheet" />

	<!-- Icons -->
	<link rel="apple-touch-icon" sizes="76x76"   href="//d1r0dd7tzzqtcd.cloudfront.net/img/touch-icon-76.png"  />
	<link rel="apple-touch-icon" sizes="120x120" href="//d1r0dd7tzzqtcd.cloudfront.net/img/touch-icon-120.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="//d1r0dd7tzzqtcd.cloudfront.net/img/touch-icon-152.png" />
	<link rel="apple-touch-icon" sizes="180x180" href="//d1r0dd7tzzqtcd.cloudfront.net/img/touch-icon-180.png" />
	<link rel="shortcut icon" href="//d1r0dd7tzzqtcd.cloudfront.net/img/favicon.ico" />
	
	<!-- default SEO -->
	<meta name="publisher" content="Spamty" />
	<meta property="og:site_name" content="Spamty" />
	<meta name="twitter:site" content="@spamty" />
	<meta name="twitter:creator" content="@philipp_ra" />
	<meta name="copyright" content="(c) 2016 Spamty.eu" />
	<meta property="og:type" content="website" />
	<meta name="twitter:card" content="summary" />
	<meta name="keywords" content="status page, API status, website status, server, uptime, response time" />
	
	<!-- language SEO -->
	<meta property="og:locale" content="<?php echo $_GET['lang']; ?>" />

	<!-- custom SEO -->
	<title>Spamty Server Status</title>
	<meta property="og:title" content="Spamty Server Status" />
	<meta name="twitter:title" content="Spamty Server Status" />
	
	<meta name="description" content="See uptime and response times of the Spamty.eu website, API and the server" />
	<meta property="og:description" content="See uptime and response times of the Spamty.eu website, API and the server" />
	<meta name="twitter:description" content="See uptime and response times of the Spamty.eu website, API and the server" />
	
	<link rel="canonical" href="https://status.spamty.eu/<?php echo $_GET['lang']; ?>/index.php" />
	<meta property="og:url" content="https://status.spamty.eu/<?php echo $_GET['lang']; ?>/index.php" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="//d1r0dd7tzzqtcd.cloudfront.net/js/ajaxform-tab.min.js"></script>
  </head>  <body>

    <div class="container"><!-- container -->

      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li><a href="https://spamty.eu/">Spamty.eu</a></li>
        </ul>
        <h3 class="text-muted"><a href="index.php"><img src="//d1r0dd7tzzqtcd.cloudfront.net/img/logo.png" alt="Spamty Logo"></a></h3>
      </div>

<h1>Status</h1>
<p>See uptime and response times of the Spamty.eu website, API and the server.</p>
<?php



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.uptimerobot.com/getMonitors?apiKey=u287454-395b58ff8c08619f09e26150&monitors=777952468-777357002-777356996-777357000&customUptimeRatio=30&responseTimes=1&responseTimesLimit=24&responseTimesAverage=720&format=json");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

$response = str_replace("jsonUptimeRobotApi(", "", $response);
$response = substr($response, 0, -1);

$uptime_data = json_decode($response, true);


foreach($uptime_data['monitors']['monitor'] as $monitor){
	switch ($monitor['status']) {
		// paused
	    case "0":
	    	$emoji = "⏸";
	    	$statusText = "Paused";
	        break;
		// not checked yet
	    case "1":
	    	$emoji = "🔄";
	    	$statusText = "Not checked yet";
	        break;
		// up
	    case "2":
	    	$emoji = "✅";
	    	$statusText = "Online";
	        break;
		// seems down
	    case "8":
	    	$emoji = "⭕️";
	    	$statusText = "Seems down";
	        break;
		// down
	    case "9":
	    	$emoji = "🚫";
	    	$statusText = "DOWN";
	        break;
	}
	echo "<h2>".$emoji." ".$monitor['friendlyname']."</h2>";
	echo "<p>Status: <b>".$statusText."</b></p>";
	
	echo "<h3>Uptime</h3>";
	?>
	<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $monitor['customuptimeratio']; ?>" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: <?php echo $monitor['customuptimeratio']; ?>%;"><?php echo $monitor['customuptimeratio']; ?>%</div></div>
	<?php
	echo "<p>Last 30 days: <b>".$monitor['customuptimeratio']."%</b><br>";
	echo "Alltime: ".$monitor['alltimeuptimeratio']."% </p>";
	
	if( !empty($monitor['responsetime'][0]['value']) ){
		echo "<h3>Response Time</h3>";
		echo "<p>Average in last 12 hours: <b>".$monitor['responsetime'][0]['value']." Milliseconds</b>";
		
		if( !empty($monitor['responsetime'][1]['value']) ){
			echo "<br>Average previous 12 hours: ".$monitor['responsetime'][1]['value']." Milliseconds";
		}
		echo "</p>";
	}

}

?>
<div class="footer">
 <p>
	<a href="https://blog.spamty.eu/">Blog</a> | 
	<a href="https://spamty.eu/contact.php">Contact</a> | 
	<a href="https://spamty.eu/faq.php">FAQ/Help</a> | 
	<a href="https://spamty.eu/legal.php">Legal Notice</a> | 
	<a href="https://spamty.eu/privacy.php">Privacy Policy</a> | 
	<a href="https://dev.spamty.eu/">Developer</a>
 </p>



	<p><?php echo _("Language:"); ?>
	<a onclick="setLangCookie('en')" href="https://status.spamty.eu/index.php" title="English"><i class="famfamfam-flag-gb"><span class="famfamfam-desc">British English<span></i> <i class="famfamfam-flag-us"><span class="famfamfam-desc">American English<span></i></a>
	<a onclick="setLangCookie('de')" href="https://status.spamty.eu/de/index.php" title="Deutsch"><i class="famfamfam-flag-de"><span class="famfamfam-desc">Deutsch<span></i></a>
	<a onclick="setLangCookie('es')" href="https://status.spamty.eu/es/index.php" title="Español"><i class="famfamfam-flag-es"><span class="famfamfam-desc">Español<span></i></a>
	<a onclick="setLangCookie('fr')" href="https://status.spamty.eu/fr/index.php" title="Fran&ccedil;ais"><i class="famfamfam-flag-fr"><span class="famfamfam-desc">Fran&ccedil;ais<span></i></a>
	<a onclick="setLangCookie('cn')" href="https://status.spamty.eu/zh/index.php" title="中文"><i class="famfamfam-flag-cn"><span class="famfamfam-desc">中文<span></i></a>
	</p>
	<script>
	// set cookie
	function setLangCookie( lang ){
	    var d = new Date();
	    d.setTime(d.getTime() + (30*24*60*60*1000)); // in 30 days
	    var expires = d.toUTCString();
		document.cookie="lang="+lang+"; expires="+expires+"; path=/";
	}

	// if language cookie not exists
	if (!(document.cookie.indexOf("lang") >= 0)) {
	  setLangCookie("<?php echo $_GET['lang']; ?>");
	}
	</script>


<p class="text-center">Powered by <a href="https://uptimerobot.com/" target="_blank">Uptime Robot</a>.</p>

</div>
</div><!-- /container -->
</body>
</html>