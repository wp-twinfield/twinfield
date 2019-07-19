<?php
/**
 * Date/time unserializer
 *
 * @link       http://pear.php.net/package/XML_Serializer/docs
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/XML
 */

namespace Pronamic\WP\Twinfield\XML;

/**
 * Date/time unserializer
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class DateTimeUnserializer extends Unserializer {
	/**
	 * Unserialize the specified XML to an article.
	 *
	 * @param \SimpleXMLElement $element The XML element to unserialize.
	 */
	public function unserialize( \SimpleXMLElement $element ) {
		$date = \DateTime::createFromFormat( 'YmdHis', Security::filter( $element ) );

		if ( false !== $date ) {
			return $date;
		}

		return null;
	}
}
