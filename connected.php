<?php

	require_once('config.php');
	$client = new Google_Client();
	$client->setClientId($googleAppId);
	$client->setClientSecret($googleAppSecret);
	$client->setAccessToken($_SESSION['gg_token']);
	$client->setRedirectUri("http://localhost/googleconnect/googleConnect.php");
	if ($client->isAccessTokenExpired()) {
		unset($_SESSION['gg_token']);
		header("Location: /googleconnect/"); die;
	}
//	$service = new Google_Service_Oauth2($client);
//	$client->addScope(Google_Service_Oauth2::USERINFO_EMAIL);
	$plus = new Google_Service_Oauth2($client);
	var_dump($plus->userinfo->get());