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
use Pronamic\WP\Twinfield\Authentication\WebServicesAuthenticationStrategy;

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

		$authentication_strategy = new WebServicesAuthenticationStrategy( $credentials );

		$client = new Client( $authentication_strategy );

		$client->login();

		$service = $client->get_service( 'document' );
		$service->query();

		$this->assertInstanceOf( __NAMESPACE__ . '\DocumentService', $service );
	}
}
