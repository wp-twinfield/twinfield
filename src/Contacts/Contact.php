<?php
/**
 * Contact
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Contacts
 */

namespace Pronamic\WP\Twinfield\Contacts;

/**
 * Contact
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield/Contacts
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class Contact {
	/**
	 * Office.
	 *
	 * @var string
	 */
	private $office;

	/**
	 * Type.
	 *
	 * @var string
	 */
	private $type;

	/**
	 * Name.
	 *
	 * @var string
	 */
	private $name;

	/**
	 * Website.
	 *
	 * @var string
	 */
	private $website;

	/**
	 * Addresses
	 *
	 * @var array
	 */
	private $addresses;

	/**
	 * Constructs and initialize an contact.
	 */
	public function __construct() {
		$this->addresses = array();
	}
}
