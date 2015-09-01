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
 * This class represents an Twinfield sales invoice response.
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
	 * The sales invoice.
	 *
	 * @var SalesInvoice
	 */
	private $sales_invoice;

	/**
	 * Constructs and initialize an Twinfield article read request.
	 *
	 * @param int          $result          The result code.
	 * @param SalesInvoice $sales_invoice   The sales invoice.
	 */
	public function __construct( $result, SalesInvoice $sales_invoice ) {
		$this->code           = $code;
		$this->sales_invoice = $sales_invoice;
	}

	/**
	 * Get the sales invoice response result.
	 *
	 * @return string
	 */
	public function get_result() {
		return $this->code;
	}

	/**
	 * Get the sales invoice number.
	 *
	 * @return string
	 */
	public function get_sales_invoice() {
		return $this->sales_invoice;
	}
}
