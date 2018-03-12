<?php
/**
 * XML Processor
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

use Pronamic\WP\Twinfield\Authentication\AuthenticationInfo;

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
	 * @param AuthenticationInfo $authentication_info A Twinfield authentication info object.
	 */
	public function __construct( AuthenticationInfo $authentication_info ) {
		parent::__construct( self::WSDL_FILE, $authentication_info );
	}

	/**
	 * Send the specified XML string to Twinfield for processing.
	 *
	 * @param ProcessXmlString $xml The XML string to process by Twinfield.
	 * @return string
	 */
	public function process_xml_string( ProcessXmlString $xml ) {
		$response = $this->soap_client->ProcessXmlString( $xml );

		return $response;
	}
}
