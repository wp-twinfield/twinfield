<?php
/**
 * Column definition
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
class ColumnDefinition {
	/**
	 * XML definition.
	 *
	 * @var \SimpleXMLElement
	 */
	private $xml_definition;

	/**
	 * Constructs and initialize a Twinfield browse definition.
	 *
	 * @param \SimpleXMLElement $xml_definition XML definition.
	 */
	public function __construct( \SimpleXMLElement $xml_definition ) {
		$this->xml_definition = $xml_definition;
	}

	/**
	 * Get form.
	 *
	 * @return string|null
	 */
	public function get_from() {
		if ( isset( $this->xml_definition->from ) ) {
			return \strval( $this->xml_definition->from );
		}

		return null;
	}

	/**
	 * Set from.
	 *
	 * @param string $from The from value.
	 */
	public function set_from( $from ) {
		if ( null !== $from ) {
			$this->xml_definition->from = $from;
		}

		return $this;
	}

	/**
	 * Set to.
	 *
	 * @param string $to The to value.
	 */
	public function set_to( $to ) {
		if ( null !== $to ) {
			$this->xml_definition->to = $to;
		}

		return $this;
	}

	/**
	 * Between.
	 *
	 * @param string $from The from value.
	 * @param string $to   The to value.
	 */
	public function between( $from, $to = null ) {
		$this->xml_definition->operator = 'between';

		return $this->set_from( $from )->set_to( $to );
	}

	/**
	 * Equal.
	 *
	 * @param string $value Set equal to value.
	 */
	public function equal( $value ) {
		$this->xml_definition->operator = 'equal';

		return $this->set_from( $value );
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
