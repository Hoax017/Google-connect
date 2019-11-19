<?php
	require_once('vendor/autoload.php');
	session_start();
	$googleAppId = "CLE API PUBLIQUE GOOGLE";
	$googleAppSecret = "CLE API PRIVE GOOGLE";



	$googleClient = new Google_Client();
	$googleClient->setScopes(['email', 'https://www.googleapis.com/auth/userinfo.profile', 'https://www.googleapis.com/auth/youtube']);
	$googleClient->setAccessType("offline");
	$googleClient->setRedirectUri("http://localhost/googleconnect/googleConnect.php");
	$googleClient->setClientId($googleAppId);
	$googleClient->setClientSecret($googleAppSecret);