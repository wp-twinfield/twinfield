<?php
/**
 * Customer
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Customers;

use Pronamic\WP\Twinfield\Contacts\Contact;

/**
 * Customer
 *
 * This class represents an Twinfield customer
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class Customer extends Contact {
	/**
	 * Code.
	 *
	 * @var string
	 */
	private $code;

	/**
	 * Shortname.
	 *
	 * @var string
	 */
	private $shortname;

	/**
	 * Financials.
	 *
	 * @var CustomerFinancials
	 */
	private $financials;

	/**
	 * Credit management.
	 *
	 * @var CustomerCreditManagement
	 */
	private $credit_management;

	/**
	 * Constructs and initializes an customer/
	 */
	public function __construct() {
		parent::__construct();

		$this->financials        = new CustomerFinancials();
		$this->credit_management = new CustomerCreditManagement();
	}

	/**
	 * Get code.
	 *
	 * @return string
	 */
	public function get_code() {
		return $this->code;
	}

	/**
	 * Set code.
	 *
	 * @param string $code The code.
	 */
	public function set_code( $code ) {
		$this->code = $code;
	}

	/**
	 * Get shortname.
	 *
	 * @return string
	 */
	public function get_shortname() {
		return $this->shortname;
	}

	/**
	 * Set shortname.
	 *
	 * @param string $shortname The shortname.
	 */
	public function set_shortname( $shortname ) {
		$this->shortname = $shortname;
	}

	/**
	 * Get financials.
	 *
	 * @return CustomerFinancials
	 */
	public function get_financials() {
		return $this->financials;
	}

	/**
	 * Get credit management.
	 *
	 * @return CustomerCreditManagement
	 */
	public function get_credit_management() {
		return $this->credit_management;
	}
}
