<?php
/* Twitter API tutorial: https://goo.gl/N2Znbb */

// include twitteroauth
require "twitteroauth/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;
session_start();
$config = require_once 'twitter_config.php';

// connect
$connection = new TwitterOAuth(
    $config['consumer_key'],
    $config['consumer_secret'],
    $config['oauth_token'],
    $config['oauth_token_secret']
);
// verify connection
$content = $connection->get("account/verify_credentials");
echo "connect to twitter. ";
//var_dump($content);


 
// get previous status from json file
$prev_status = json_decode(file_get_contents("twitter_previous.json"), true);
echo "read statuses. ";
//var_dump($prev_status);



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.uptimerobot.com/getMonitors?apiKey=u287454-395b58ff8c08619f09e26150&monitors=777357002-777356996-777357000&customUptimeRatio=30&format=json");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

$response = str_replace("jsonUptimeRobotApi(", "", $response);
$response = substr($response, 0, -1);

$uptime_data = json_decode($response, true);
echo "get server status. ";


foreach($uptime_data['monitors']['monitor'] as $monitor){
	//print_r($monitor);
	// status is DOWN previous was UP
	if($monitor['status'] == "9" && $prev_status[$monitor['id']] == "2"){
		$twitter_status = $connection->post(
		    "statuses/update", [
		        "status" => "Ohhh ❌ ".$monitor['friendlyname']." is down. We are working on a fix. Uptime of ".$monitor['friendlyname']." was ".$monitor['alltimeuptimeratio']."%. For more see: https://status.spamty.eu/"
		    ]
		);
		//var_dump($twitter_status);
		echo $monitor['friendlyname']." is DOWN was UP. Posted to twitter. ";
	}
	// status is UP previous was DOWN
	elseif($monitor['status'] == "2" && $prev_status[$monitor['id']] == "9"){
		$twitter_status = $connection->post(
		    "statuses/update", [
		        "status" => $monitor['friendlyname']." 🎉 is up and running again. Uptime in last 30 days was ".$monitor['customuptimeratio']."%. For more information check out: https://status.spamty.eu/"
		    ]
		);
		//var_dump($twitter_status);
		echo $monitor['friendlyname']." is UP was DOWN. Posted to twitter. ";
	}
	// set status in json
	$prev_status[$monitor['id']] = $monitor['status'];
}



// write status in json file
file_put_contents("twitter_previous.json", json_encode($prev_status));
echo "write in json. ";
