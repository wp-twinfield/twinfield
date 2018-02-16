<?php
/**
 * Customer response
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Customers;

use Pronamic\WP\Twinfield\Response;

/**
 * Sales invoice response
 *
 * This class follows the Data Transfer Objects design pattern. This class represents an Twinfield sales invoice with some
 * additional information.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class CustomerResponse extends Response {
	/**
	 * The customer.
	 *
	 * @var Customer
	 */
	private $customer;

	/**
	 * Constructs and initialize an Twinfield customer response.
	 *
	 * @param Customer          $customer The customer.
	 * @param mixed             $result   The result.
	 * @param \SimpleXMLElement $message  The XML message.
	 */
	public function __construct( Customer $customer, $result, \SimpleXMLElement $message ) {
		parent::__construct( $result, $message );

		$this->customer = $customer;
	}

	/**
	 * Get the customer.
	 *
	 * @return Customer
	 */
	public function get_customer() {
		return $this->customer;
	}
}
