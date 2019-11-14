<?php
	require_once('config.php');
?>
<a href='https://accounts.google.com/o/oauth2/auth?response_type=code&access_type=offline&client_id=<?= $googleAppId ?>&redirect_uri=<?= urlencode('http://localhost/googleconnect/googleConnect.php') ?>&state&scope=<?= urlencode('email https://www.googleapis.com/auth/userinfo.profile') ?>&approval_prompt=auto'>Connexion Google</a>