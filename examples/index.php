<?php

require __DIR__ . '/../vendor/autoload.php';

// WorDBless.
\WorDBless\Load::load();

// Xdebug.
\ini_set( 'xdebug.var_display_max_depth', -1 );
\ini_set( 'xdebug.var_display_max_children', -1 );
\ini_set( 'xdebug.var_display_max_data', -1 );

// Load.
$file = __DIR__ . '/client-secret.json';

if ( ! is_readable( $file ) ) {
	die( 'Create `client-secret.json` file.' );
}

$json = \file_get_contents( $file, true );

$data = \json_decode( $json );

$state = \bin2hex( \openssl_random_pseudo_bytes( 32 ) );

$openid_connect_provider = new \Pronamic\WP\Twinfield\Authentication\OpenIdConnectProvider( $data->client_id, $data->client_secret, $data->redirect_uri );

$openid_connect_provider->maybe_handle_twinfield_return( $_GET, function( $token_response ) use ( $file, $data ) {
	$data->token = $token_response;

	$result = \file_put_contents( $file, \wp_json_encode( $data, \JSON_PRETTY_PRINT ) );

	if ( false === $result ) {
		die( 'Could not save token.' );
	}
} );

if ( property_exists( $data, 'token' ) && ! \property_exists( $data, 'access_token_validation' ) ) {
	$data->access_token_validation = $openid_connect_provider->get_access_token_validation( $data->token->access_token );
}

if ( property_exists( $data, 'token' ) && ! \property_exists( $data, 'user_info' ) ) {
	$data->user_info = $openid_connect_provider->get_user_info( $data->token->access_token );
}

// Save.
$json_update = \wp_json_encode( $data, \JSON_PRETTY_PRINT );

if ( $json !== $json_update ) {
	$result = \file_put_contents( $file, $json_update );

	if ( false === $result ) {
		die( 'Could not save JSON.' );
	}
}

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

		<h2>Client</h2>

		<dl>
			<dt>Client ID</dt>
			<dd><?php echo \esc_html( $data->client_id ); ?></dd>

			<dt>Client Secret</dt>
			<dd><?php echo \esc_html( $data->client_secret ); ?></dd>

			<dt>Redirect URI</dt>
			<dd><?php echo \esc_html( $data->redirect_uri ); ?></dd>
		</dl>

		<?php if ( \property_exists( $data, 'token' ) ) : ?>

			<h2>Token</h2>

			<dl>
				<dt><code>id_token</code></dt>
				<dd><code><?php echo \esc_html( $data->token->id_token ); ?></code></dd>

				<dt><code>access_token</code></dt>
				<dd><code><?php echo \esc_html( $data->token->access_token ); ?></code></dd>

				<dt><code>expires_in</code></dt>
				<dd><code><?php echo \esc_html( $data->token->expires_in ); ?></code></dd>

				<dt><code>token_type</code></dt>
				<dd><code><?php echo \esc_html( $data->token->token_type ); ?></code></dd>

				<dt><code>refresh_token</code></dt>
				<dd><code><?php echo \esc_html( $data->token->refresh_token ); ?></code></dd>
			</dl>

		<?php endif; ?>

		<?php if ( \property_exists( $data, 'access_token_validation' ) ) : ?>

			<h2>Access Token Validation</h2>

			<pre><?php \var_dump( $data->access_token_validation ); ?></pre>

		<?php endif; ?>

		<?php if ( \property_exists( $data, 'token' ) && \property_exists( $data, 'access_token_validation' ) ) : ?>

			<h2>Offices</h2>

			<?php

			$authentication = new Pronamic\WP\Twinfield\Authentication\OpenIdConnectAuthenticationStrategy(
				$data->token->access_token,
				'',
				$data->access_token_validation->{'twf.clusterUrl'}
			);

			$client = new Pronamic\WP\Twinfield\Client( $authentication );

			$client->login();

			$xml_processor = $client->get_xml_processor();

			$office_service = new Pronamic\WP\Twinfield\Offices\OfficeService( $xml_processor );

			$offices = $office_service->get_offices();

			var_dump( $offices );

			?>

		<?php endif; ?>

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
