<?php

	require_once('config.php');
	if (empty($_SESSION['gg_token'])) {
		header("Location: /googleconnect/"); die;
	}
	$googleClient->setAccessToken($_SESSION['gg_token']);
	if ($googleClient->isAccessTokenExpired()) {
		unset($_SESSION['gg_token']);
		header("Location: /googleconnect/"); die;
	}
//	$service = new Google_Service_Oauth2($client);
//	$client->addScope(Google_Service_Oauth2::USERINFO_EMAIL);
	$plus = new Google_Service_Oauth2($googleClient);
	var_dump($plus->userinfo->get());


	// Upload Youtube
	$youtube = new Google_Service_YouTube($googleClient);

	$snippet = new Google_Service_YouTube_VideoSnippet();
	$snippet->setTitle("test titre");
	$snippet->setDescription("test descritpion");
	$snippet->setTags("test,developpement,php");


	$status = new Google_Service_YouTube_VideoStatus();
	$status->privacyStatus = "private"; // "public", "private" and "unlisted"

	$video = new Google_Service_YouTube_Video();
	$video->setSnippet($snippet);
	$video->setStatus($status);

	$chunkSizeBytes = 1 * 1024 * 1024;
	$googleClient->setDefer(true);

	$insertRequest = $youtube->videos->insert("status,snippet", $video);
	$media = new Google_Http_MediaFileUpload(
		$googleClient,
		$insertRequest,
		'video/*',
		null,
		true,
		$chunkSizeBytes
	);
	$videoPath = __DIR__.'/video.mp4';
	$media->setFileSize(filesize($videoPath));


	// Read the media file and upload it chunk by chunk.
	$status = false;
	$handle = fopen($videoPath, "rb");
	while (!$status && !feof($handle)) {
		$chunk = fread($handle, $chunkSizeBytes);
		$status = $media->nextChunk($chunk);
	}
	fclose($handle);

	$googleClient->setDefer(false);
	var_dump($media);

