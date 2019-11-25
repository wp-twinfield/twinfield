<?php
/**
 * Date unserializer
 *
 * @link       http://pear.php.net/package/XML_Serializer/docs
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/XML
 */

namespace Pronamic\WP\Twinfield\XML;

/**
 * Sales invoices unserializer
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class DateUnserializer extends Unserializer {
	/**
	 * Unserialize the specified XML to an article.
	 *
	 * @param \SimpleXMLElement|string $element The XML element to unserialize.
	 */
	public function unserialize( $element ) {
		$date = \DateTimeImmutable::createFromFormat( 'Ymd', Security::filter( $element ), new \DateTimeZone( 'UTC' ) );

		if ( false !== $date ) {
			$date->setTime( 0, 0 );

			return $date;
		}

		return null;
	}
}
