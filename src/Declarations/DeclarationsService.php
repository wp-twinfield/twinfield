<?php
/**
 * Declarations service
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Declarations;

use Pronamic\WP\Twinfield\Authentication\AuthenticationInfo;
use Pronamic\WP\Twinfield\AbstractService;
use Pronamic\WP\Twinfield\Client;
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
class DeclarationsService extends AbstractService {
	/**
	 * The Twinfield declarations WSDL URL.
	 *
	 * @var string
	 */
	const WSDL_FILE = '/webservices/declarations.asmx?wsdl';

	/**
	 * Constructs and initializes a declarations service object.
	 *
	 * @param Client $client Twinfield client object.
	 */
	public function __construct( Client $client ) {
		parent::__construct( self::WSDL_FILE, $client );
	}

	/**
	 * Get all sumaries of the specified office code.
	 *
	 * @see https://c5.twinfield.de/webservices/documentation/#/ApiReference/Miscellaneous/Declaration
	 * @param string $office_code The code of the office for which the returns should be retrieved. Mandatory.
	 * @return array
	 */
	public function get_all_summaries( $office ) {
		$parameters = new \stdClass();

		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar -- Twinfield vaiable name.
		$parameters->companyCode = $office->get_code();

		$this->set_office( $office );

		$soap_client = $this->get_soap_client();

		return $soap_client->GetAllSummaries( $parameters );
	}

	/**
	 * Get payment reference for the specified document code and ID.
	 *
	 * @see https://c5.twinfield.de/webservices/documentation/#/ApiReference/Miscellaneous/Declaration
	 * @param string $document_id   The document ID.
	 * @param string $document_code The document code.
	 * @return string
	 */
	public function get_payment_reference( $document_id, $document_code = null ) {
		$function = 'GetVatReturnPaymentReference';

		switch ( $document_code ) {
			case DocumentCodes::VATTURNOVER:
				$function = 'GetVatReturnPaymentReference';

				break;
			case DocumentCodes::TAXGROUP:
				$function = 'GetTaxGroupVatReturnPaymentReference';

				break;
		}

		// phpcs:disable WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar -- Twinfield vaiable name.

		$parameters = new \stdClass();

		$parameters->documentId = $document_id;

		$response = $this->soap_client->__soapCall( $function, array( $parameters ) );

		if ( isset( $response->paymentReference ) ) {
			return $response->paymentReference;
		}

		// phpcs:enable
	}

	/**
	 * Get VAT return payment reference for the specified document ID.
	 *
	 * @see https://c5.twinfield.de/webservices/documentation/#/ApiReference/Miscellaneous/Declaration
	 * @param string $document_id The document ID.
	 * @return string
	 */
	public function get_vat_return_payment_reference( $document_id ) {
		return $this->get_payment_reference( $document_id, DocumentCodes::VATTURNOVER );

	}

	/**
	 * Get TAX group payment reference for the specified document ID.
	 *
	 * @see https://c5.twinfield.de/webservices/documentation/#/ApiReference/Miscellaneous/Declaration
	 * @param string $document_id The document ID.
	 * @return string
	 */
	public function get_tax_group_vat_return_payment_reference( $document_id ) {
		return $this->get_payment_reference( $document_id, DocumentCodes::TAXGROUP );

	}

	/**
	 * Get XBRL for the specified document code and ID.
	 *
	 * @see https://c5.twinfield.de/webservices/documentation/#/ApiReference/Miscellaneous/Declaration
	 * @param string $document_id   The document ID.
	 * @param string $document_code The document code.
	 * @return string
	 */
	public function get_xbrl( $document_id, $document_code = null ) {
		$function = 'GetVatReturnAsXbrl';

		switch ( $document_code ) {
			case DocumentCodes::VATTURNOVER:
				$function = 'GetVatReturnAsXbrl';

				break;
			case DocumentCodes::VATICT:
				$function = 'GetIctReturnAsXbrl';

				break;
			case DocumentCodes::TAXGROUP:
				$function = 'GetTaxGroupVatReturnAsXbrl';

				break;
		}

		// phpcs:disable WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar -- Twinfield vaiable name.

		$parameters = new \stdClass();

		$parameters->documentId          = $document_id;
		$parameters->isMessageIdRequired = true;

		$response = $this->soap_client->__soapCall( $function, array( $parameters ) );

		if ( isset( $response->vatReturn, $response->vatReturn->any ) ) {
			return $response->vatReturn->any;
		}

		// phpcs:enable
	}

	public function get_xml( $document_id, $document_code = null ) {
		$function = 'GetVatReturnAsXml';

		switch ( $document_code ) {
			case DocumentCodes::VATTURNOVER:
				$function = 'GetVatReturnAsXml';

				break;
			case DocumentCodes::VATICT:
				$function = 'GetIctReturnAsXml';

				break;
			case DocumentCodes::TAXGROUP:
				$function = 'GetTaxGroupVatReturnAsXml';

				break;
		}

		$parameters = new \stdClass();

		$parameters->documentId = $document_id;

		$response = $this->soap_client->__soapCall( $function, array( $parameters ) );

		if ( isset( $response->vatReturn, $response->vatReturn->any ) ) {
			return $response->vatReturn->any;			
		}
	}

	/**
	 * Get VAT return XBRL for the specified document ID.
	 *
	 * @see https://c5.twinfield.de/webservices/documentation/#/ApiReference/Miscellaneous/Declaration
	 * @param string $document_id The document ID.
	 * @return string
	 */
	public function get_vat_return_as_xbrl( $document_id ) {
		return $this->get_xbrl( $document_id, DocumentCodes::VATTURNOVER );
	}

	/**
	 * Get ICT VAT return XBRL for the specified document ID.
	 *
	 * @see https://c5.twinfield.de/webservices/documentation/#/ApiReference/Miscellaneous/Declaration
	 * @param string $document_id The document ID.
	 * @return string
	 */
	public function get_ict_return_as_xbrl( $document_id ) {
		return $this->get_xbrl( $document_id, DocumentCodes::VATICT );
	}

	/**
	 * Get TAX group VAT return XBRL for the specified document ID.
	 *
	 * @see https://c5.twinfield.de/webservices/documentation/#/ApiReference/Miscellaneous/Declaration
	 * @param string $document_id The document ID.
	 * @return string
	 */
	public function get_tax_group_vat_return_as_xbrl( $document_id ) {
		return $this->get_xbrl( $document_id, DocumentCodes::TAXGROUP );
	}
}
