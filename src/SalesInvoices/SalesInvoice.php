<?php
/**
 * Sales Invoice
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/SalesInvoices
 */

namespace Pronamic\WP\Twinfield\SalesInvoices;

/**
 * Sales Invoice
 *
 * This class represents an Twinfield sales invoice.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SalesInvoice {
	/**
	 * Header.
	 *
	 * @var SalesInvoiceHeader
	 */
	private $header;

	/**
	 * Lines.
	 *
	 * @var array
	 */
	private $lines;

	/**
	 * Constructs and initialize an Twinfield sales invoice.
	 *
	 * @param SalesInvoiceHeader $header    The sales invoice header object for this sales invoice.
	 * @param array              $lines     The sales invoice lines for this sales invoice.
	 */
	public function __construct( SalesInvoiceHeader $header, array $lines = array() ) {
		$this->header = $header;
		$this->lines  = $lines;
	}
}
