<?php
/**
 * Contact
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Contacts
 */

namespace Pronamic\WP\Twinfield\Contacts;

use Pronamic\WP\Twinfield\Address;

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

	/**
	 * Get office.
	 *
	 * @return string
	 */
	public function get_office() {
		return $this->office;
	}

	/**
	 * Set office
	 *
	 * @param string $office The office.
	 */
	public function set_office( $office ) {
		$this->office = $office;
	}

	/**
	 * Get name.
	 *
	 * @return string
	 */
	public function get_name() {
		return $this->name;
	}

	/**
	 * Set name.
	 *
	 * @param string $name The name.
	 */
	public function set_name( $name ) {
		$this->name = $name;
	}

	/**
	 * Create and add a new address.
	 *
	 * @return Address
	 */
	public function new_address() {
		$address = new Address();

		$this->addresses[] = $address;

		return $address;
	}

	/**
	 * Get the addresses of this contact.
	 *
	 * @return array An array with addresses.
	 */
	public function get_addresses() {
		return $this->addresses;
	}
}
