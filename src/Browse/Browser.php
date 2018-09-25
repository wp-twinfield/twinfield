<?php
/**
 * Browser
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Browse
 */

namespace Pronamic\WP\Twinfield\Browse;

use Pronamic\WP\Twinfield\XMLProcessor;
use Pronamic\WP\Twinfield\ProcessXmlString;
use Pronamic\WP\Twinfield\XML\Browse\BrowseReadRequestSerializer;

/**
 * Browser
 *
 * This class utilizes Twinfield browse features.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class Browser {
	/**
	 * Constructs and initializes a browser object.
	 *
	 * @param XMLProcessor $xml_processor Twinfield XML processor object.
	 */
	public function __construct( XMLProcessor $xml_processor ) {
		$this->xml_processor = $xml_processor;
	}

	/**
	 * Get browse read request by the specified request.
	 *
	 * @param BrowseReadRequest $request The browse read request.
	 * @return BrowseDefinition
	 */
	public function get_browse_definition( BrowseReadRequest $request ) {
		$serializer = new BrowseReadRequestSerializer( $request );

		$response = $this->xml_processor->process_xml_string( new ProcessXmlString( $serializer ) );

		$string = $response->get_result();

		$xml = simplexml_load_string( $string );

		$browse_definition = new BrowseDefinition( $xml );

		return $browse_definition;
	}

	/**
	 * Get XML by the specified browse definition.
	 *
	 * @param BrowseDefinition $browse_definition The browse definition.
	 * @return string
	 */
	public function get_xml_string( BrowseDefinition $browse_definition ) {
		$string = $browse_definition->get_xml_columns()->asXML();

		$process_xml_string = new ProcessXmlString( $string );

		$response = $this->xml_processor->process_xml_string( $process_xml_string );

		return $response;
	}

	/**
	 * Get columns by the specified columns.
	 *
	 * @param BrowseDefinition $browse_definition The browse definition.
	 * @return \SimpleXMLElement
	 */
	public function get_data( BrowseDefinition $browse_definition ) {
		$string = $this->get_xml_string( $browse_definition );

		$xml = simplexml_load_string( $string );

		$data = new BrowseData( $xml );

		return $data;
	}
}
