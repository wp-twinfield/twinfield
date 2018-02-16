<?php
/**
 * Browse definition
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Browse;

/**
 * Browse definition
 *
 * This class represents a Twinfield browse definition.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class BrowseDefinition {
	/**
	 * XML definition.
	 *
	 * @var \SimpleXMLElement
	 */
	private $xml_definition;

	/**
	 * Columns.
	 *
	 * @var array
	 */
	private $columns;

	/**
	 * Constructs and initialize a Twinfield browse definition.
	 *
	 * @param \SimpleXMLElement $xml_definition XML definition.
	 */
	public function __construct( \SimpleXMLElement $xml_definition ) {
		$this->xml_definition = $xml_definition;
		$this->columns        = array();

		foreach ( $this->get_xml_columns()->column as $column ) {
			$field = (string) $column->field;

			$this->columns[ $field ] = new ColumnDefinition( $column );
		}
	}

	/**
	 * Get XML columns.
	 *
	 * @return \SimpleXMLElement
	 */
	public function get_xml_columns() {
		return $this->xml_definition->columns;
	}

	/**
	 * Get column by the specified field.
	 *
	 * @param string $field The field.
	 * @return ColumnDefinition
	 */
	public function get_column( $field ) {
		if ( isset( $this->columns[ $field ] ) ) {
			return $this->columns[ $field ];
		}

		return new ColumnDefinition( new \SimpleXMLElement( '<column />' ) );
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
