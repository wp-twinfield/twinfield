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

$openid_connect_client = \Pronamic\WP\Twinfield\Authentication\OpenIdConnectClient::from_json_file( $file );

// Authentication
$authentication_file = __DIR__ . '/authentication-secret.json';

if ( \is_readable( $authentication_file ) ) {
	$authentication = \Pronamic\WP\Twinfield\Authentication\AuthenticationInfo::from_object( \json_decode( \file_get_contents( $authentication_file, true ) ) );
}

/**
 * @link https://github.com/googleapis/google-api-php-client/blob/master/docs/oauth-web.md#create-authorization-credentials
 * @link https://developers.google.com/gmail/api/quickstart/php
 */
if ( \array_key_exists( 'code', $_GET ) ) {
	$response = $openid_connect_client->get_access_token( $_GET['code'] );

	$tokens = \Pronamic\WP\Twinfield\Authentication\AuthenticationTokens::from_object( $response );

	$response = $openid_connect_client->get_access_token_validation( $tokens->get_access_token() );

	$validation = \Pronamic\WP\Twinfield\Authentication\AccessTokenValidation::from_object( $response );

	$authentication = new \Pronamic\WP\Twinfield\Authentication\AuthenticationInfo( $tokens, $validation );

	\file_put_contents( $authentication_file, \wp_json_encode( $authentication, \JSON_PRETTY_PRINT ) );

	$url = \remove_query_arg( 'code' );

	\wp_safe_redirect( $url );

	exit;
}

if ( isset( $authentication ) ) {
	$client = new Pronamic\WP\Twinfield\Client( $openid_connect_client, $authentication );

	$client->set_authentication_refresh_handler( function( $client ) use ( $authentication_file ) {
		\file_put_contents( $authentication_file, \wp_json_encode( $client->get_authentication(), \JSON_PRETTY_PRINT ) );
	} );
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

		<?php if ( isset( $client ) ) : ?>

			<h2>Organisation</h2>

			<?php var_dump( $client->get_organisation() ); ?>

			<h2>User</h2>

			<?php var_dump( $client->get_user() ); ?>

			<h2>Offices</h2>

			<?php

			$offices = $client->get_offices();

			?>
			<table>
				<thead>
					<tr>
						<th scope="col">Code</th>
						<th scope="col">Name</th>
						<th scope="col">Shortname</th>
					</tr>
				</thead>

				<tbody>
					
					<?php foreach ( $offices as $office ) : ?>

						<tr>
							<td>
								<code><?php echo \esc_html( $office->get_code() ); ?></code>
							</td>
							<td>
								<?php echo \esc_html( $office->get_name() ); ?>
							</td>
							<td>
								<?php echo \esc_html( $office->get_shortname() ); ?>
							</td>
						</tr>

					<?php endforeach; ?>

				</tbody>
			</table>

			<?php

			$office = \reset( $offices );

			if ( false !== $office ) : ?>

				<?php

				$office = $client->get_office( $office );

				?>
				<h2>Office</h2>

				<?php var_dump( $office ); ?>
				
				<h2>Journals</h2>

				<?php

				$journals = $client->get_journals( $office );

				?>
				<table>
					<thead>
						<tr>
							<th scope="col">Code</th>
							<th scope="col">Name</th>
						</tr>
					</thead>

					<tbody>
						
						<?php foreach ( $journals as $journal ) : ?>

							<tr>
								<td>
									<code><?php echo \esc_html( $journal->get_code() ); ?></code>
								</td>
								<td>
									<?php echo \esc_html( $journal->get_name() ); ?>
								</td>
							</tr>

						<?php endforeach; ?>

					</tbody>
				</table>
				
				<h2>Journal</h2>

				<?php

				$journal = $office->new_journal( 'MEMO' );

				var_dump( $journal );

				?>

				<h2>Declarations</h2>

				<?php

				$declarations_service = $client->get_service( 'declarations' );

				$summaries = $declarations_service->get_all_summaries( $office );

				var_dump( $summaries->GetAllSummariesResult );
				var_dump( $summaries->vatReturn );

				?>
			
			<?php endif; ?>

		<?php endif; ?>

		<p>
			<?php

			$state = \bin2hex( \openssl_random_pseudo_bytes( 32 ) );

			$url = $openid_connect_client->get_authorize_url( $state );

			printf(
				'<a href="%s">Connect with Twinfield</a>',
				\htmlspecialchars( $url )
			);

			?>
		</p>
	</body>
</html>
