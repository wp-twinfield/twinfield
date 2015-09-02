<?php
/**
 * Sales invoice response
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\SalesInvoices;

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
class SalesInvoiceResponse {
	/**
	 * The result code.
	 *
	 * @var int
	 */
	private $result;

	/**
	 * The result message.
	 *
	 * @var string
	 */
	private $message;

	/**
	 * The sales invoice.
	 *
	 * @var SalesInvoice
	 */
	private $sales_invoice;

	/**
	 * Constructs and initialize an Twinfield article read request.
	 *
	 * @param int $result The number of results.
	 */
	public function __construct( $result, \SimpleXMLElement $message ) {
		$this->result  = $result;
		$this->message = $message;
	}

	/**
	 * Get the sales invoice response result.
	 *
	 * @return string
	 */
	public function get_result() {
		return $this->result;
	}

	/**
	 * Get the sales invoice.
	 *
	 * @return string
	 */
	public function get_sales_invoice() {
		return $this->sales_invoice;
	}

	/**
	 * Set the sales invoice.
	 *
	 * @param SalesInvoice $sales_invoice
	 */
	public function set_sales_invoice( SalesInvoice $sales_invoice ) {
		$this->sales_invoice = $sales_invoice;
	}
}
