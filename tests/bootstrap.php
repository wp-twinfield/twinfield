<?php

require_once 'vendor/autoload.php';

$user         = getenv( 'TWINFIELD_USER' );
$password     = getenv( 'TWINFIELD_PASSWORD' );
$organisation = getenv( 'TWINFIELD_ORGANISATION' );

global $credentials;

$credentials = new Pronamic\Twinfield\Credentials( $user, $password,$organisation );
