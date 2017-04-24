<?php
/**
 * General ledger service test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Documents
 */

namespace Pronamic\WP\Twinfield\GeneralLedger;

use PHPUnit\Framework\TestCase;
use Pronamic\WP\Twinfield\Browse\Browser;
use Pronamic\WP\Twinfield\Client;
use Pronamic\WP\Twinfield\Result;
use Pronamic\WP\Twinfield\XMLProcessor;

/**
 * Sales invoices service test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield/SalesInvoice
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class GeneralLedgerServiceTest extends TestCase {
	/**
	 * Test document service.
	 */
	public function test_service() {
		global $credentials;

		$client = new Client();

		$logon_response = $client->logon( $credentials );

		$session = $client->get_session( $logon_response );

		$xml_processor = new XMLProcessor( $session );

		$browser = new Browser( $xml_processor );

		$service = new GeneralLedgerService( $browser );

		$office_code    = getenv( 'TWINFIELD_OFFICE_CODE' );
		$general_ledger = '2999';
		$year           = '2017';

		$transaction_lines = $service->get_transaction_lines( $office_code, $general_ledger, $year );

		var_dump( $transaction_lines );
	}
}
