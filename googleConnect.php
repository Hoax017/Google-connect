<?php

	require_once('config.php');
	$googleClient->fetchAccessTokenWithAuthCode($_GET['code']);

	if(!$googleClient->getAccessToken()) {
		unset($_SESSION['gg_token']);
		header("Location: /googleconnect/?fail"); die;
	}
	$_SESSION['gg_token'] = $googleClient->getAccessToken();
	header("Location: /googleconnect/connected.php"); die;