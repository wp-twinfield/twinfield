<?php
/**
 * Office Service
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/SalesInvoices
 */

namespace Pronamic\WP\Twinfield\Offices;

use Pronamic\WP\Twinfield\ProcessXmlString;
use Pronamic\WP\Twinfield\XMLProcessor;
use Pronamic\WP\Twinfield\XML\Security;

/**
 * Office Service
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class OfficeService {
	/**
	 * The XML processor wich is used to connect with Twinfield.
	 *
	 * @var XMLProcessor
	 */
	private $xml_processor;

	/**
	 * Constructs and initializes an sales invoice service.
	 *
	 * @param XMLProcessor $xml_processor The XML processor.
	 */
	public function __construct( XMLProcessor $xml_processor ) {
		$this->xml_processor = $xml_processor;
	}

	/**
	 * Get offices.
	 *
	 * @return array
	 */
	public function get_offices() {
		$result = null;

		$request = '<list><type>offices</type></list>';

		$response = $this->xml_processor->process_xml_string( new ProcessXmlString( $request ) );

		$xml = simplexml_load_string( $response );

		if ( false !== $xml ) {
			$result = array();

			foreach ( $xml->office as $element ) {
				$office = new Office();
				$office->set_code( Security::filter( $element ) );
				$office->set_name( Security::filter( $element['name'] ) );
				$office->set_shortname( Security::filter( $element['shortname'] ) );

				$result[] = $office;
			}
		}

		return $result;
	}
}
