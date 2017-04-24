<?php
/**
 * Browse data
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Browse;

/**
 * Column definition
 *
 * This class represents a Twinfield column definition.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class BrowseData {
	/**
	 * XML definition.
	 *
	 * @var \SimpleXMLElement
	 */
	private $xml_definition;

	/**
	 * Rows.
	 *
	 * @var array
	 */
	private $rows;

	/**
	 * Constructs and initialize a Twinfield browse data object.
	 *
	 * @param \SimpleXMLElement $xml_definiation XML definition.
	 */
	public function __construct( \SimpleXMLElement $xml_definition ) {
		$this->xml_definition = $xml_definition;
		$this->rows           = array();

		$this->parse_rows();
	}

	/**
	 * Parse rows.
	 */
	private function parse_rows() {
		$this->rows = array();

		foreach ( $this->xml_definition->tr as $tr ) {
			$this->rows[] = new Row( $tr );
		}
	}

	/**
	 * Get rows.
	 *
	 * @return array
	 */
	public function get_rows() {
		return $this->rows;
	}

	/**
	 * Create a string representatino of this object.
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->xml_definition->asXML();
	}
}
