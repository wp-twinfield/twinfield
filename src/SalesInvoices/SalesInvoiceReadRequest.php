<?php
/**
 * Sales invoice read request
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\SalesInvoices;

use Pronamic\WP\Twinfield\ReadRequest;

/**
 * Sales invoice read request
 *
 * This class represents an Twinfield sales invoice read request.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SalesInvoiceReadRequest extends ReadRequest {
	/**
	 * Specifcy which sales invoice type to read.
	 *
	 * @var string
	 */
	private $code;

	/**
	 * Specifcy which sales invoice number to read.
	 *
	 * @var string
	 */
	private $invoice_number;

	/**
	 * Constructs and initialize an Twinfield article read request.
	 *
	 * @param string $office         Specify from wich office to read.
	 * @param string $code           Specifcy which sales invoice code to read.
	 * @param string $invoice_number The invoice number number.
	 */
	public function __construct( $office, $code, $invoice_number ) {
		parent::__construct( 'salesinvoice', $office );

		$this->code           = $code;
		$this->invoice_number = $invoice_number;
	}

	/**
	 * Get the sales invoice type code.
	 *
	 * @return string
	 */
	public function get_code() {
		return $this->code;
	}

	/**
	 * Get the sales invoice number.
	 *
	 * @return string
	 */
	public function get_invoice_number() {
		return $this->invoice_number;
	}
}
