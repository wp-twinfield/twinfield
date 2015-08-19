<?php
/**
 * Bootstrap PHPUnit tests
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

require_once 'vendor/autoload.php';

$user         = getenv( 'TWINFIELD_USER' );
$password     = getenv( 'TWINFIELD_PASSWORD' );
$organisation = getenv( 'TWINFIELD_ORGANISATION' );
$office_code  = getenv( 'TWINFIELD_OFFICE_CODE' );
$article_code = getenv( 'TWINFIELD_ARTICLE_CODE' );

global $credentials;

$credentials = new Pronamic\WP\Twinfield\Credentials( $user, $password, $organisation );
