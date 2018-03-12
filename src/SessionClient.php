<?php
/**
 * Session client
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

use Pronamic\WP\Twinfield\AbstractService;
use Pronamic\WP\Twinfield\Client;

/**
 * Session client
 *
 * This class represents an Twinfield session.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SessionClient extends AbstractService {
	/**
	 * The Twinfield process XML WSDL file.
	 *
	 * @var string
	 */
	const WSDL_FILE = '/webservices/session.asmx?wsdl';

	/**
	 * Constructs and initializes an session object.
	 *
	 * @param Client $client Twinfield client object.
	 */
	public function __construct( Client $client ) {
		parent::__construct( self::WSDL_FILE, $client );
	}

	/**
	 * Keep the session alive, to prevent session time out. A session time out will occur 2 hours after the last web service call for the session.
	 *
	 * @see https://c3.twinfield.com/webservices/documentation/#/ApiReference/Authentication/WebServices#Complete-session
	 */
	public function keep_alive() {
		$response = $this->soap_client->KeepAlive();

		return $response;
	}

	/**
	 * Select the specified company.
	 *
	 * @param string $company_code The code of the company you want to select.
	 * @return SelectCompanyResult
	 */
	public function select_company( $company_code ) {
		$select_company = new \stdClass();

		$select_company->company = $company_code;

		$response = $this->soap_client->SelectCompany( $select_company );

		return $response;
	}
}
