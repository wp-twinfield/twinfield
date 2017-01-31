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
	 * @param \SimpleXMLElement $xml_definiation XML definition.
	 */
	public function __construct( \SimpleXMLElement $xml_definition ) {
		$this->xml_definition = $xml_definition;
	}

	/**
	 * Set from.
	 *
	 * @param string $from
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
	 * @param string $to
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
	 * @param string $to
	 */
	public function between( $from, $to = null ) {
		$this->xml_definition->operator = 'between';

		return $this->set_from( $from )->set_to( $to );
	}

	/**
	 * Equal.
	 *
	 * @param string $value
	 */
	public function equal( $value ) {
		$this->xml_definition->operator = 'equal';

		return $this->set_from( $value );
	}
}
