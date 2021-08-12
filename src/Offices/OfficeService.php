<?php
/**
 * Office Service
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/SalesInvoices
 */

namespace Pronamic\WP\Twinfield\Offices;

use Pronamic\WP\Twinfield\Client;
use Pronamic\WP\Twinfield\ProcessXmlString;
use Pronamic\WP\Twinfield\XMLProcessor;
use Pronamic\WP\Twinfield\XML\Security;
use Pronamic\WP\Twinfield\Offices\Office;

/**
 * Office Service
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class OfficeService {
	/**
	 * Client.
	 *
	 * @var Client
	 */
	private $client;

	/**
	 * Constructs and initializes an sales invoice service.
	 *
	 * @param XMLProcessor $xml_processor The XML processor.
	 */
	public function __construct( Client $client ) {
		$this->client = $client;
	}

	/**
	 * Get offices.
	 *
	 * @return array
	 */
	public function get_offices() {
		$result = null;

		$request = '<list><type>offices</type></list>';

		$document = new \DOMDocument();

		$list_element = $document->createElement( 'list' );

		$document->appendChild( $list_element );

		$type_element = $document->createElement( 'type' );
		$type_element->appendChild( new \DOMText( 'offices' ) );

		$list_element->appendChild( $type_element );

		$xml_string = $document->saveXML();

		$xml_processor = $this->client->get_xml_processor();

		$response = $xml_processor->process_xml_string( new ProcessXmlString( $xml_string ) );

		$xml = simplexml_load_string( $response );

		if ( false !== $xml ) {
			$result = array();

			foreach ( $xml->office as $element ) {
				$office = $this->client->organisation->new_office( Security::filter( $element ) );

				$office->set_name( Security::filter( $element['name'] ) );
				$office->set_shortname( Security::filter( $element['shortname'] ) );

				$result[] = $office;
			}
		}

		return $result;
	}

	/**
	 * Get office.
	 *
	 * @param Office $office Office.
	 * @return Office
	 */
	public function get_office( $office ) {
		$document = new \DOMDocument();

		$read_element = $document->createElement( 'read' );

		$document->appendChild( $read_element );

		$type_element = $document->createElement( 'type' );
		$type_element->appendChild( new \DOMText( 'office' ) );

		$read_element->appendChild( $type_element );

		$code_element = $document->createElement( 'code' );
		$code_element->appendChild( new \DOMText( $office->get_code() ) );

		$read_element->appendChild( $code_element );

		$xml_string = $document->saveXML();

		$xml_processor = $this->client->get_xml_processor();

		$xml_processor->set_office( $office );

		$response = $xml_processor->process_xml_string( new ProcessXmlString( $xml_string ) );

		return Office::from_xml( \strval( $response ), $office );
	}
}
