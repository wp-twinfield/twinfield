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

		<link rel="stylesheet" type="text/css" href="https://unpkg.com/codemirror@5.62.2/lib/codemirror.css" />
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
				
				<h2>Transaction Types</h2>

				<?php

				$transaction_types = $client->get_transaction_types( $office );

				?>
				<table>
					<thead>
						<tr>
							<th scope="col">Code</th>
							<th scope="col">Name</th>
						</tr>
					</thead>

					<tbody>
						
						<?php foreach ( $transaction_types as $transaction_type ) : ?>

							<tr>
								<td>
									<code><?php echo \esc_html( $transaction_type->get_code() ); ?></code>
								</td>
								<td>
									<?php echo \esc_html( $transaction_type->get_name() ); ?>
								</td>
							</tr>

						<?php endforeach; ?>

					</tbody>
				</table>
				
				<h2>Transaction Type</h2>

				<?php

				$transaction_type = $office->new_transaction_type( 'MEMO' );

				?>

				<dl>
					<dt>Code</dt>
					<dd><code><?php echo \esc_html( $transaction_type->get_code() ); ?></code></dd>
				</dl>
				
				<h2>Transaction</h2>

				<?php

				$transaction = $transaction_type->new_transaction();

				$dimension_type_pnl = $office->new_dimension_type( 'PNL' );
				$dimension_type_crd = $office->new_dimension_type( 'CRD' );
				$dimension_type_bas = $office->new_dimension_type( 'BAS' );

				$line_1 = $transaction->new_line();

				$line_1->set_type( 'detail' );
				$line_1->set_id( '1' );
				$line_1->set_dimension_1( $dimension_type_pnl->new_dimension( '4008' ) );
				$line_1->set_debit_credit( 'debit' );
				$line_1->set_value( '435.55' );

				$line_2 = $transaction->new_line();

				$line_2->set_type( 'detail' );
				$line_2->set_id( '2' );
				$line_2->set_dimension_1( $dimension_type_bas->new_dimension( '1300' ) );
				$line_2->set_dimension_2( $dimension_type_crd->new_dimension( '1000' ) );
				$line_2->set_debit_credit( 'credit' );
				$line_2->set_value( '435.55' );
				$line_2->set_invoice_number( '11001770' );
				$line_2->set_description( 'Invoice paid' );

				?>
				<textarea id="test"><?php echo \esc_textarea( $transaction->to_xml() ); ?></textarea>

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

		<script src="https://unpkg.com/codemirror@5.62.2/lib/codemirror.js"></script>
		<script src="https://unpkg.com/codemirror@5.62.2/mode/xml/xml.js"></script>

		<script type="text/javascript">
			var textarea = document.getElementById( 'test' );

			editor = CodeMirror.fromTextArea( textarea, {
				lineNumbers: true,
				mode: 'application/xml'
			} );
		</script>
	</body>
</html>
