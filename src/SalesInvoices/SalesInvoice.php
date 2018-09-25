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
	 * @param SalesInvoiceLine $line The sales invoice line to add.
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

	/**
	 * Get the value without VAT of this sales invoice.
	 *
	 * @return float
	 */
	public function get_value_excl() {
		return array_sum(
			array_map(
				function( $line ) {
					return $line->get_value_excl();
				},
				$this->get_lines()
			)
		);
	}

	/**
	 * Get the VAT value of this sales invoice.
	 *
	 * @return float
	 */
	public function get_vat_value() {
		return array_sum(
			array_map(
				function( $line ) {
					return $line->get_vat_value();
				},
				$this->get_lines()
			)
		);
	}

	/**
	 * Get the value with VAT of this sales invoice.
	 *
	 * @return float
	 */
	public function get_value_inc() {
		return array_sum(
			array_map(
				function( $line ) {
					return $line->get_value_inc();
				},
				$this->get_lines()
			)
		);
	}
}
