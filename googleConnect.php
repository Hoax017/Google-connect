<?php

	require_once('config.php');
	$client = new Google_Client();
	$client->setScopes('email');
	$client->setAccessType("offline");
	$client->setRedirectUri("http://localhost/googleconnect/googleConnect.php");
	$client->setClientId($googleAppId);
	$client->setClientSecret($googleAppSecret);
	$client->fetchAccessTokenWithAuthCode($_GET['code']);
	if(!$client->getAccessToken()) {
		unset($_SESSION['gg_token']);
		header("Location: /googleconnect/?fail"); die;
	}
	$_SESSION['gg_token'] = $client->getAccessToken();
	header("Location: /googleconnect/connected.php"); die;