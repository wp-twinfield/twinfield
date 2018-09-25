<?php
/**
 * Browser test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Browse;

use PHPUnit\Framework\TestCase;

use Pronamic\WP\Twinfield\Credentials;
use Pronamic\WP\Twinfield\Client;
use Pronamic\WP\Twinfield\XMLProcessor;
use Pronamic\WP\Twinfield\ProcessXmlString;
use Pronamic\WP\Twinfield\Authentication\WebServicesAuthenticationStrategy;

/**
 * Browser test
 *
 * This class will test the Twinfield browser features.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class BrowserTest extends TestCase {
	/**
	 * Test browser.
	 */
	public function test_browser() {
		global $credentials;

		$authentication_strategy = new WebServicesAuthenticationStrategy( $credentials );

		$client = new Client( $authentication_strategy );

		$client->login();

		$xml_processor = $client->get_xml_processor();

		$browser = new Browser( $xml_processor );

		$browse_read_request = new BrowseReadRequest( getenv( 'TWINFIELD_OFFICE_CODE' ), BrowseCodes::GENERAL_LEDGER_TRANSACTIONS );

		$browse_definition = $browser->get_browse_definition( $browse_read_request );
		$browse_definition->get_column( 'fin.trs.head.yearperiod' )->between( '2014/01', '2014/12' );
		$browse_definition->get_column( 'fin.trs.line.dim1' )->between( '1280' );

		$data = $browser->get_data( $browse_definition );

		$this->assertInstanceOf( __NAMESPACE__ . '\BrowseData', $data );
	}
}
