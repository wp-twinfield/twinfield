<?php
/**
 * Document service test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Documents
 */

namespace Pronamic\WP\Twinfield\Documents;

use PHPUnit\Framework\TestCase;
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
class DocumentServiceTest extends TestCase {
	/**
	 * Test document service.
	 */
	public function test_document_service() {
		global $credentials;

		$client = new Client();

		$logon_response = $client->logon( $credentials );

		$session = $client->get_session( $logon_response );

		$service = new DocumentService( $session );
		$service->query();
	}
}
