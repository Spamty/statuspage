<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="//cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.6/cosmo/bootstrap.min.css" rel="stylesheet" />
	<link href="//d1r0dd7tzzqtcd.cloudfront.net/css/spamty.css" rel="stylesheet" />

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
	<meta property="og:locale" content="en" />

	<!-- custom SEO -->
	<title>Spamty Server Status</title>
	<meta property="og:title" content="Spamty Server Status" />
	<meta name="twitter:title" content="Spamty Server Status" />
	
	<meta name="description" content="See uptime and response times of the Spamty.eu website, API and the server" />
	<meta property="og:description" content="See uptime and response times of the Spamty.eu website, API and the server" />
	<meta name="twitter:description" content="See uptime and response times of the Spamty.eu website, API and the server" />
	
	<link rel="canonical" href="https://status.spamty.eu/" />
	<meta property="og:url" content="https://status.spamty.eu/" />
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

<p class="text-center">Powered by <a href="https://uptimerobot.com/" target="_blank">Uptime Robot</a>.</p>

</div>
</div><!-- /container -->
</body>
</html>