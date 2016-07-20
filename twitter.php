<?php
// verify request from Uptime robot
if($_GET['verify'] != "c5eac121edc0a047fb13"){
	die("verification failed. ");
}


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



// Data from Uptime Robot web-hook:
//   *monitorID* (the ID of the monitor)
//   *monitorURL* (the URL of the monitor)
//   *monitorFriendlyName* (the friendly name of the monitor)
//   *alertType* (1 is down, 2 is up)
//   *alertDetails* (any info regarding the alert -if exists-)
//   *monitorAlertContacts* (the alert contacts associated with the alert in the format of 457;2;john@doe.com -alertContactID;alertContactType, alertContactValue)



// status is DOWN (previous was UP)
if($_GET['alertType'] == "1"){
	$twitter_status = $connection->post(
	    "statuses/update", [
	        "status" => "Ohhh ❌ ".$_GET['monitorFriendlyName']." is down. We are working on a fix. For more see: https://status.spamty.eu/"
	    ]
	);
	//var_dump($twitter_status);
	echo $_GET['monitorFriendlyName']." is DOWN. Posted to twitter. ";
}
// status is UP (previous was DOWN)
elseif($_GET['alertType'] == "2"){
	$twitter_status = $connection->post(
	    "statuses/update", [
	        "status" => $_GET['monitorFriendlyName']." 🎉 is up and running again. For more information check out: https://status.spamty.eu/"
	    ]
	);
	//var_dump($twitter_status);
	echo $monitor['friendlyname']." is UP. Posted to twitter. ";
}



