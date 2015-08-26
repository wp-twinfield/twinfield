<?php
/**
 * Serializer
 *
 * @link       http://pear.php.net/package/XML_Serializer/docs
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\XML;

/**
 * Serialize
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
abstract class Serializer {
	/**
	 * DOM Document
	 *
	 * @var \DOMDocument
	 */
	protected $document;

	/**
	 * Constructs and initalizes an serializer object
	 */
	public function __construct() {
		$this->document = new \DOMDocument();
	}

	/**
	 * Create a string representation of this XML object
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->document->saveXML();
	}
}
