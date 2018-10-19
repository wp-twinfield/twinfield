<?php
/**
 * Deleted transactions service
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Transactions;

use Pronamic\WP\Twinfield\Authentication\AuthenticationInfo;
use Pronamic\WP\Twinfield\AbstractService;
use Pronamic\WP\Twinfield\Client;
use Pronamic\WP\Twinfield\Session;

/**
 * Deleted transactions service
 *
 * This class connects to the Twinfield deleted transactions webservices.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class DeletedTransactionsService extends AbstractService {
	/**
	 * The Twinfield declarations WSDL URL.
	 *
	 * @var string
	 */
	const WSDL_FILE = '/webservices/DeletedTransactionsService.svc?wsdl';

	/**
	 * Constructs and initializes a declarations service object.
	 *
	 * @param Client $client Twinfield client object.
	 */
	public function __construct( Client $client ) {
		parent::__construct( self::WSDL_FILE, $client );
	}

	/**
	 * Get deleted transactions.
	 *
	 * @see https://c3.twinfield.com/webservices/documentation/#/ApiReference/Transactions/DeletedTransactions
	 */
	public function get_deleted_transactions( $office_code ) {
		$authentication = array(
			'AccessToken' => $this->client->access_token,
			'CompanyCode' => $office_code,
		);

		$soap_header = new \SoapHeader(
			'http://www.twinfield.com/',
			'Authentication',
			$authentication
		);

		$this->soap_client->__setSoapHeaders( $soap_header );

		$query = new GetDeletedTransactions();
		$query->CompanyCode = $office_code;

		$result = $this->soap_client->Query( $query );

		$transactions = $result->DeletedTransactions->DeletedTransaction;

		return $transactions;
	}
}
