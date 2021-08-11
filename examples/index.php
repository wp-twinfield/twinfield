<?php

require __DIR__ . '/../vendor/autoload.php';

\WorDBless\Load::load();

$client_id     = '';
$client_secret = '';
$redirect_uri  = '';
$state         = \bin2hex( \openssl_random_pseudo_bytes( 32 ) );

if ( 'POST' === $_SERVER['REQUEST_METHOD'] ) {
	$client_id     = $_POST['client_id'];
	$client_secret = $_POST['client_secret'];
	$redirect_uri  = $_POST['redirect_uri'];
}

$openid_connect_provider = new \Pronamic\WP\Twinfield\Authentication\OpenIdConnectProvider( $client_id, $client_secret, $redirect_uri );
/*
$openid_connect_provider->maybe_handle_twinfield_return( function( $data ) {
	var_dump( $data );
} );
*/
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
			Client ID <input type="text" name="client_id" value="<?php echo \htmlspecialchars( $client_id ); ?>" />
			Client Secret <input type="text" name="client_secret" value="<?php echo \htmlspecialchars( $client_secret ); ?>" />
			Redirect URI <input type="url" name="redirect_uri" value="<?php echo \htmlspecialchars( $redirect_uri ); ?>" />
			<button type="submit">Connect</button>
		</form>

		<p>
			<?php

			$url = $openid_connect_provider->get_authorize_url( $state );

			printf(
				'<a href="%s">Connect with Twinfield</a>',
				\htmlspecialchars( $url )
			);

			?>
		</p>
	</body>
</html>
