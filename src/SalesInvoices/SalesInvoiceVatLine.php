<?php
/**
 * Sales Invoice VAT Line
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/SalesInvoices
 */

namespace Pronamic\WP\Twinfield\SalesInvoices;

use Pronamic\WP\Twinfield\VatCode;

/**
 * Sales Invoice VAT Line
 *
 * This class represents an Twinfield sales invoice VAT line.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SalesInvoiceVatLine {
	/**
	 * VAT code.
	 *
	 * @var VatCode|null
	 */
	private $vat_code;

	/**
	 * VAT value.
	 *
	 * @var float|null
	 */
	private $vat_value;

	/**
	 * Get VAT code.
	 *
	 * @return VatCode|null
	 */
	public function get_vat_code() {
		return $this->vat_code;
	}

	/**
	 * Set VAT code.
	 *
	 * @param VatCode|null $vat_code VAT code.
	 */
	public function set_vat_code( $vat_code ) {
		$this->vat_code = $vat_code;
	}

	/**
	 * Get VAT value.
	 *
	 * @return float|null
	 */
	public function get_vat_value() {
		return $this->vat_value;
	}

	/**
	 * Set VAT value.
	 *
	 * @param float|null $vat_value VAT value.
	 */
	public function set_vat_value( $vat_value ) {
		$this->vat_value = $vat_value;
	}
}
