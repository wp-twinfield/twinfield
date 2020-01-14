<?php
/**
 * Sales Invoice totals.
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/SalesInvoices
 */

namespace Pronamic\WP\Twinfield\SalesInvoices;

use Pronamic\WP\Twinfield\VatCode;

/**
 * Sales Invoice totals
 *
 * This class represents an Twinfield sales invoice totals.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SalesInvoiceTotals {
	/**
	 * Value without VAT.
	 *
	 * @var float|null
	 */
	private $value_excl;

	/**
	 * Value with VAT.
	 *
	 * @var float|null
	 */
	private $value_inc;

	/**
	 * Get value without VAT.
	 *
	 * @return float|null
	 */
	public function get_value_excl() {
		return $this->value_excl;
	}

	/**
	 * Set value without VAT.
	 *
	 * @param float|null $value_excl Value without VAT.
	 */
	public function set_value_excl( $value_excl ) {
		$this->value_excl = $value_excl;
	}

	/**
	 * Get value with VAT.
	 *
	 * @return float|null
	 */
	public function get_value_inc() {
		return $this->value_inc;
	}

	/**
	 * Set value with VAT.
	 *
	 * @param float|null $value_inc Value with VAT.
	 */
	public function set_value_inc( $value_inc ) {
		$this->value_inc = $value_inc;
	}
}
