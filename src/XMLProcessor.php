<?php
/**
 * XML Processor
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * XML Processor
 *
 * This class connects to the Twinfield XML processor Webservices to process XML messages.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class XMLProcessor extends AbstractClient {
	/**
	 * The Twinfield process XML WSDL URL.
	 *
	 * @var string
	 */
	const WSDL_FILE = '/webservices/processxml.asmx?wsdl';

	/**
	 * Constructs and initializes an XML processor object.
	 *
	 * @param Session $session The Twinfield session.
	 */
	public function __construct( Session $session ) {
		parent::__construct( self::WSDL_FILE, $session );
	}

	/**
	 * Send the specified XML string to Twinfield for processing.
	 *
	 * @param string $xml The XML string to process by Twinfield.
	 * @return string
	 */
	public function process_xml_string( $xml ) {
		$response = $this->soap_client->ProcessXmlString(
			array( 'xmlRequest' => $xml )
		);

		return $response;
	}
}
