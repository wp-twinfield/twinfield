<?php
/**
 * Sales Invoice Line
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/SalesInvoices
 */

namespace Pronamic\WP\Twinfield\SalesInvoices;

/**
 * Sales Invoice Line
 *
 * This class represents an Twinfield sales invoice header.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SalesInvoiceLine {
	/**
	 * The unique ID of this sales invoice line.
	 *
	 * @var string
	 */
	private $id;

	/**
	 * The article of this sales invoice line.
	 *
	 * @var string
	 */
	private $article;

	/**
	 * The subarticle of this sales invoice line.
	 *
	 * @var string
	 */
	private $subarticle;

	/**
	 * The quantity of this sales invoice line.
	 *
	 * @var int
	 */
	private $quantity;

	/**
	 * The units of this sales invoice line.
	 *
	 * @var int
	 */
	private $units;

	/**
	 * Calculate discount on this line. Must be 'false' or 'true'.
	 *
	 * @var bool
	 */
	private $allow_discount_or_premium;

	/**
	 * Description
	 *
	 * @var string
	 */
	private $description;

	/**
	 * The value without VAT of this sales invoice line.
	 *
	 * @var float
	 */
	private $value_excl;

	/**
	 * The VAT value of this sales invoice line.
	 *
	 * @var float
	 */
	private $vat_value;

	/**
	 * The value with VAT of this sales invoice line.
	 *
	 * @var float
	 */
	private $value_inc;

	/**
	 * Free text 1.
	 *
	 * @var string
	 */
	private $free_text_1;

	/**
	 * Free text 2.
	 *
	 * @var string
	 */
	private $free_text_2;

	/**
	 * Free text 2.
	 *
	 * @var string
	 */
	private $free_text_3;

	/**
	 * Constructs and initialize an Twinfield article line.
	 */
	public function __construct() {
		$this->quantity = 1;
		$this->units    = 1;
	}

	/**
	 * Get the unique ID of this sales invoice line.
	 *
	 * @return string
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Set the unique ID of this sales invoice line.
	 *
	 * @param string $id
	 */
	public function set_id( $id ) {
		$this->id = $id;
	}

	/**
	 * Get the article of this sales invoice line.
	 *
	 * @return string
	 */
	public function get_article() {
		return $this->article;
	}

	/**
	 * Set the article of this sales invoice line.
	 *
	 * @param string $article
	 */
	public function set_article( $article ) {
		$this->article = $article;
	}

	/**
	 * Get the subarticle of this sales invoice line.
	 *
	 * @return string
	 */
	public function get_subarticle() {
		return $this->subarticle;
	}

	/**
	 * Set the article of this sales invoice line.
	 *
	 * @param string $subarticle
	 */
	public function set_subarticle( $subarticle ) {
		$this->subarticle = $subarticle;
	}

	/**
	 * Get the quantity of this sales invoice line.
	 *
	 * @return int
	 */
	public function get_quantity() {
		return $this->quantity;
	}

	/**
	 * Set the quantity of this sales invoice line.
	 *
	 * @param int $quantity
	 */
	public function set_quantity( $quantity ) {
		$this->quantity = $quantity;
	}

	/**
	 * Get the units of this sales invoice line.
	 *
	 * @return int
	 */
	public function get_units() {
		return $this->units;
	}

	/**
	 * Set the units of this sales invoice line.
	 *
	 * @param int $units
	 */
	public function set_units( $units ) {
		$this->units = $units;
	}


	/**
	 * Set calculate discount on this line. Must be 'false' or 'true'.
	 *
	 * @return bool
	 */
	public function get_allow_discount_or_premium() {
		return $this->description;
	}

	/**
	 * Get calculate discount on this line.
	 *
	 * @param bool $allow
	 */
	public function set_allow_discount_or_premium( $allow ) {
		$this->allow_discount_or_premium = $allow;
	}

	/**
	 * Get the description of this sales invoice line.
	 *
	 * @return string
	 */
	public function get_description() {
		return $this->description;
	}

	/**
	 * Set the description of this sales invoice line.
	 *
	 * @param string $description
	 */
	public function set_description( $description ) {
		$this->description = $description;
	}

	/**
	 * Get the value without VAT of this sales invoice line.
	 *
	 * @return float
	 */
	public function get_value_excl() {
		return $this->value_excl;
	}

	/**
	 * Set the value without VAT of this sales invoice line.
	 *
	 * @param float $value_excl
	 */
	public function set_value_excl( $value_excl ) {
		$this->value_excl = $value_excl;
	}

	/**
	 * Get the VAT value of this sales invoice line.
	 *
	 * @return float
	 */
	public function get_vat_value() {
		return $this->vat_value;
	}

	/**
	 * Set the VAT value of this sales invoice line.
	 *
	 * @param float $vat_value
	 */
	public function set_vat_value( $vat_value ) {
		$this->vat_value = $vat_value;
	}

	/**
	 * Get the value with VAT of this sales invoice line.
	 *
	 * @return float
	 */
	public function get_value_inc() {
		return $this->value_inc;
	}

	/**
	 * Set the value with VAT of this sales invoice line.
	 *
	 * @param float $value_inc
	 */
	public function set_value_inc( $value_inc ) {
		$this->value_inc = $value_inc;
	}

	/**
	 * Get the free text 1 value of this sales invoice line.
	 *
	 * @return string
	 */
	public function get_free_text_1() {
		return $this->free_text_1;
	}

	/**
	 * Set the free text 1 value of this sales invoice line.
	 *
	 * @param string $text
	 */
	public function set_free_text_1( $text ) {
		$this->free_text_1 = $text;
	}

	/**
	 * Get the free text 2 value of this sales invoice line.
	 *
	 * @return string
	 */
	public function get_free_text_2() {
		return $this->free_text_2;
	}

	/**
	 * Set the free text 2 value of this sales invoice line.
	 *
	 * @param string $text
	 */
	public function set_free_text_2( $text ) {
		$this->free_text_2 = $text;
	}

	/**
	 * Get the free text 3 value of this sales invoice line.
	 *
	 * @return string
	 */
	public function get_free_text_3() {
		return $this->free_text_3;
	}

	/**
	 * Set the free text 3 value of this sales invoice line.
	 *
	 * @param string $text
	 */
	public function set_free_text_3( $text ) {
		$this->free_text_3 = $text;
	}
}
