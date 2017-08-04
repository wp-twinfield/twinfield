<?php
/**
 * Declarations service
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Declarations;

use Pronamic\WP\Twinfield\AbstractClient;
use Pronamic\WP\Twinfield\Session;

/**
 * Declarations service
 *
 * This class connects to the Twinfield declarations Webservices.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class DeclarationsService extends AbstractClient {
	/**
	 * The Twinfield declarations WSDL URL.
	 *
	 * @var string
	 */
	const WSDL_FILE = '/webservices/declarations.asmx?wsdl';

	/**
	 * Constructs and initializes a declarations service object.
	 *
	 * @param Session $session The Twinfield session.
	 */
	public function __construct( Session $session ) {
		parent::__construct( self::WSDL_FILE, $session );
	}

	public function get_all_summaries( $office_code ) {
		$parameters = new \stdClass();
		$parameters->companyCode = $office_code;

		return $this->soap_client->GetAllSummaries( $parameters );
	}

	public function get_payment_reference( $document_id ) {
		$parameters = new \stdClass();
		$parameters->documentId = $document_id;

		$response = $this->soap_client->GetVatReturnPaymentReference( $parameters );

		return $response->paymentReference;
	}

	public function get_vat_return_as_xbrl( $document_id ) {
		$parameters = new \stdClass();
		$parameters->documentId = $document_id;
		$parameters->isMessageIdRequired = true;

		$response = $this->soap_client->GetVatReturnAsXbrl( $parameters );

		if ( isset( $response->vatReturn, $response->vatReturn->any ) ) {
			return $response->vatReturn->any;
		}
	}

	public function test() {
		var_dump( $test->vatReturn );

		var_dump( $this->soap_client->__getFunctions() );
		var_dump( $this->soap_client->__getTypes() );
	}
}
