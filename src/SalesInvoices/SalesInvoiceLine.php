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
	 * @param string
	 */
	private $id;

	/**
	 * Description
	 *
	 * @var string
	 */
	private $description;

	/**
	 * Constructs and initialize an Twinfield article line.
	 */
	public function __construct() {

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
}
