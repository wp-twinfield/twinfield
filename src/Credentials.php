<?php

namespace Pronamic\Twinfield;

class Credentials
{
	public function __construct($user, $password, $organisation) {

		$this->user = $user;
		$this->password = $password;
		$this->organisation = $organisation;
	}
}
