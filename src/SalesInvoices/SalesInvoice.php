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
	 */
	public function __construct() {
		$this->header = new SalesInvoiceHeader();
		$this->lines  = array();
	}

	/**
	 * Get sales invoice header.
	 *
	 * @return SalesInvoiceHeader
	 */
	public function get_header() {
		return $this->header;
	}

	/**
	 * Get office.
	 *
	 * @return string
	 */
	public function get_office() {
		return $this->header->get_office();
	}

	/**
	 * Set office
	 *
	 * @param string $office
	 */
	public function set_office( $office ) {
		$this->header->set_office( $office );
	}

	/**
	 * Get type.
	 *
	 * @return string
	 */
	public function get_type() {
		return $this->header->get_type();
	}

	/**
	 * Set type.
	 *
	 * @param string $type
	 */
	public function set_type( $type ) {
		$this->header->set_type( $type );
	}

	/**
	 * Get customer.
	 *
	 * @return string
	 */
	public function get_customer() {
		return $this->header->get_customer();
	}

	/**
	 * Set customer.
	 *
	 * @param string $customer
	 */
	public function set_customer( $customer ) {
		$this->header->set_customer( $customer );
	}

	/**
	 * Get the sales invoice lines.
	 *
	 * @return array
	 */
	public function get_lines() {
		return $this->lines;
	}

	/**
	 * Add the specified line to this sales invoice.
	 *
	 * @param SalesInvoiceLine $line
	 */
	public function add_line( SalesInvoiceLine $line ) {
		$this->lines[] = $line;
	}

	/**
	 * Create a new sales invoice line.
	 *
	 * @return SalesInvoiceLine
	 */
	public function new_line() {
		$line = new SalesInvoiceLine();

		$this->add_line( $line );

		return $line;
	}
}
