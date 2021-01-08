<?php

require __DIR__ . '/../vendor/autoload.php';

?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Twinfield Examples</title>
	</head>

	<body>
		<h1>Twinfield Examples</h1>

		<p>
			<a href="https://developers.twinfield.com/">https://developers.twinfield.com/</a>
		</p>

		<form method="post" action="">
			Client ID <input type="text" name="client_id" />
			Client Secret <input type="text" name="client_secret" />
			Redirect URI <input type="url" name="redirect_uri" />
			<button type="submit">Connect</button>
		</form>
	</body>
</html>
