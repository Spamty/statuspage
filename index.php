<?php
// choose correct translation file
switch ($_GET['lang']){
	case "de":
		$lcAll = "de_DE";
		break;
	case "es":
		$lcAll = "es_ES";
		break;
	case "fr":
		$lcAll = "fr_FR";
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
bindtextdomain("spamty-status", "./translate");
bind_textdomain_codeset("spamty-status", 'UTF-8');
textdomain("spamty-status");


if(strtolower($_GET['lang']) == "en" || empty($_GET['lang'])){
	$lang_url = "";
}else{
	$lang_url = strtolower($_GET['lang'])."/";
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
	<link href="https://status.spamty.eu/index.php" rel="alternate" hreflang="en" />
	<link href="https://status.spamty.eu/de/index.php" rel="alternate" hreflang="de" />
	<link href="https://status.spamty.eu/es/index.php" rel="alternate" hreflang="es" />
	<link href="https://status.spamty.eu/fr/index.php" rel="alternate" hreflang="fr" />
	<link href="https://status.spamty.eu/cn/index.php" rel="alternate" hreflang="zh" />

	<!-- custom SEO -->
	<title><?php echo _("Spamty Server Status"); ?></title>
	<meta property="og:title" content="<?php echo _("Spamty Server Status"); ?>" />
	<meta name="twitter:title" content="<?php echo _("Spamty Server Status"); ?>" />
	
	<meta name="description" content="<?php echo _("See uptime and response times of the Spamty.eu website, API and the server."); ?>" />
	<meta property="og:description" content="<?php echo _("See uptime and response times of the Spamty.eu website, API and the server."); ?>" />
	<meta name="twitter:description" content="<?php echo _("See uptime and response times of the Spamty.eu website, API and the server."); ?>" />
	
	<link rel="canonical" href="https://status.spamty.eu/<?php echo $lang_url; ?>index.php" />
	<meta property="og:url" content="https://status.spamty.eu/<?php echo $lang_url; ?>index.php" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="//d1r0dd7tzzqtcd.cloudfront.net/js/ajaxform-tab.min.js"></script>
  </head>  <body>

    <div class="container"><!-- container -->

      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li><a href="https://spamty.eu/<?php echo $lang_url; ?>">Spamty.eu</a></li>
        </ul>
        <h3 class="text-muted"><a href="index.php"><img src="//d1r0dd7tzzqtcd.cloudfront.net/img/logo.png" alt="Spamty Logo"></a></h3>
      </div>



<?php if($_GET['lang'] == "fr"){ ?>
	<div class="alert alert-warning" role="alert">
		La traduction en fran&#231;ais n'est pas encore fini. <a href="https://status.spamty.eu/index.php" class="alert-link">Visite la site en anglais</a>.<br>
		S'il vous plaît <a href="https://spamty.eu/fr/contact.php" class="alert-link">me contacter</a> si vous trouvez des erreurs.
	</div>
<?php } 
elseif($_GET['lang'] == "es"){ ?>
	<div class="alert alert-warning" role="alert">
		La traducción al español aún no está terminada. <a href="https://status.spamty.eu/index.php" class="alert-link">Visite el sitio web de Inglés</a>.<br>
		Póngase <a href="https://spamty.eu/es/contact.php" class="alert-link">en contacto conmigo</a> si encuentra errores.
	</div>
<?php }
elseif($_GET['lang'] == "zh"){ ?>
	<div class="alert alert-warning" role="alert">
		这一转换是尚未完成。<a href="https://status.spamty.eu/index.php" class="alert-link">请参阅本网站英文版</a>。<br>
		This translation is not finished yet. <a href="https://status.spamty.eu/index.php" class="alert-link">See this website in English</a>.<br>
		<a href="https://spamty.eu/zh/contact.php" class="alert-link">与我联系，汇报错误</a>。<br>
		<a href="https://spamty.eu/zh/contact.php" class="alert-link">Contact me to report mistakes</a>.
	</div>
<?php } ?>



<h1><?php echo _("Status"); ?></h1><hr>
<p><?php echo _("See uptime and response times of the Spamty.eu website, API and the server."); ?></p>
<?php

$monitor_keys = array(
	"m777357002-1cfe8b61308dcabad91c5bb3", // API
	"m777356996-3bb21e17887a1758264465d2", // website
	"m777952468-0fa4e19b03ef02a223e06a5f", // Server
	"m777357000-265c2deafc07df5697f5c950", // 3q3
);
foreach($monitor_keys as $monitor_key){


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.uptimerobot.com/getMonitors?apiKey=".$monitor_key."&customUptimeRatio=30&responseTimes=1&responseTimesLimit=24&responseTimesAverage=720&format=json");
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
	    	$statusText = _("Paused");
	        break;
		// not checked yet
	    case "1":
	    	$emoji = "🔄";
	    	$statusText = _("Not checked yet");
	        break;
		// up
	    case "2":
	    	$emoji = "✅";
	    	$statusText = _("Online");
	        break;
		// seems down
	    case "8":
	    	$emoji = "⭕️";
	    	$statusText = _("Seems down");
	        break;
		// down
	    case "9":
	    	$emoji = "🚫";
	    	$statusText = _("DOWN");
	        break;
	}
	echo "<h2>".$emoji." ".$monitor['friendlyname']."</h2>";
	echo "<p>Status: <b>".$statusText."</b></p>";
	
	echo "<h3>"._("Uptime")."</h3>";
	?>
	<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $monitor['customuptimeratio']; ?>" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: <?php echo $monitor['customuptimeratio']; ?>%;"><?php echo $monitor['customuptimeratio']; ?>%</div></div>
	<?php
	echo "<p>"._("Last 30 days").": <b>".$monitor['customuptimeratio']."%</b><br>";
	echo _("Alltime").": ".$monitor['alltimeuptimeratio']."% </p>";
	
	if( !empty($monitor['responsetime'][0]['value']) ){
		echo "<h3>"._("Response Time")."</h3>";
		echo "<p>"._("Average in last 12 hours").": <b>".$monitor['responsetime'][0]['value']." "._("Milliseconds")."</b>";
		
		if( !empty($monitor['responsetime'][1]['value']) ){
			echo "<br>"._("Average previous 12 hours").": ".$monitor['responsetime'][1]['value']." "._("Milliseconds");
		}
		echo "</p>";
	}

}


}
?>




<h2><?php echo _("Contact Me"); ?></h2><hr>

<p><?php echo _("You can contact me if you have any questions or if there is a problem with the server."); ?></p>

<ul>
	<li><a href="https://spamty.eu/<?php echo $lang_url; ?>contact-dev.php"><?php echo _("Go to the contact form"); ?></a></li>
</ul>

<?php echo _("You can also:"); ?>
<ul>
	<li><a href="http://3q3.de/spamty"><?php echo _("Send us an email"); ?></a></li>
</ul>



<div class="footer">
 <p>
	<a href="https://blog.spamty.eu/"><?php echo _("Blog"); ?></a> | 
	<a href="https://spamty.eu/<?php echo $lang_url; ?>contact.php"><?php echo _("Contact"); ?></a> | 
	<a href="https://spamty.eu/<?php echo $lang_url; ?>faq.php"><?php echo _("FAQ/Help"); ?></a> | 
	<a href="https://spamty.eu/<?php echo $lang_url; ?>legal.php"><?php echo _("Legal Notice"); ?></a> | 
	<a href="https://spamty.eu/<?php echo $lang_url; ?>privacy.php"><?php echo _("Privacy Policy"); ?></a> | 
	<a href="https://dev.spamty.eu/"><?php echo _("Developer"); ?></a>
 </p>



	<p><?php echo _("Language:"); ?>
	<a onclick="setLangCookie('en')" href="https://status.spamty.eu/index.php" title="English"><i class="famfamfam-flag-gb"><span class="famfamfam-desc">British English<span></i> <i class="famfamfam-flag-us"><span class="famfamfam-desc">American English<span></i></a>
	<a onclick="setLangCookie('de')" href="https://status.spamty.eu/de/index.php" title="Deutsch"><i class="famfamfam-flag-de"><span class="famfamfam-desc">Deutsch<span></i></a>
	<a onclick="setLangCookie('es')" href="https://status.spamty.eu/es/index.php" title="Español"><i class="famfamfam-flag-es"><span class="famfamfam-desc">Español<span></i></a>
	<a onclick="setLangCookie('fr')" href="https://status.spamty.eu/fr/index.php" title="Fran&ccedil;ais"><i class="famfamfam-flag-fr"><span class="famfamfam-desc">Fran&ccedil;ais<span></i></a>
	<a onclick="setLangCookie('zh')" href="https://status.spamty.eu/zh/index.php" title="中文"><i class="famfamfam-flag-cn"><span class="famfamfam-desc">中文<span></i></a>
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


<p class="text-center"><?php echo _("Powered by"); ?> <a href="https://uptimerobot.com/" target="_blank">Uptime Robot</a>.</p>

</div>
</div><!-- /container -->
</body>
</html>
