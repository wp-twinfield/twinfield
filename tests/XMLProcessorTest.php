<?php
/**
 * XML processor test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

use Pronamic\WP\Twinfield\Articles\ArticleReadRequest;
use Pronamic\WP\Twinfield\XML\Articles\ArticleReadRequestSerializer;

use Pronamic\WP\Twinfield\Customers\CustomerReadRequest;
use Pronamic\WP\Twinfield\XML\Customers\CustomerReadRequestSerializer;

/**
 * XML processor test
 *
 * This class will test the Twinfield XML processor features.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class XMLProcessorTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Test processor
	 *
	 * @dataProvider provider
	 */
	public function test_processor( $xml ) {
		global $credentials;

		$client = new Client();

		// Test logon.
		$logon_response = $client->logon( $credentials );

		$this->assertInstanceOf( __NAMESPACE__ . '\LogonResponse', $logon_response );
		$this->assertInternalType( 'string', $logon_response->get_cluster() );

		// Test session.
		$session = $client->get_session( $logon_response );

		// Test XML processor.
		$xml_processor = new XMLProcessor( $session );

		$response = $xml_processor->process_xml_string( new ProcessXmlString( $xml ) );

		$this->assertInstanceOf( __NAMESPACE__ . '\ProcessXmlStringResponse', $response );
		$this->assertInternalType( 'string', $response->get_result() );
	}

	public function provider() {
		$office_code   = getenv( 'TWINFIELD_OFFICE_CODE' );
		$article_code  = getenv( 'TWINFIELD_ARTICLE_CODE' );
		$customer_code = getenv( 'TWINFIELD_CUSTOMER_CODE' );

		return array(
			array( new ArticleReadRequestSerializer( new ArticleReadRequest( $office_code, $article_code ) ) ),
			array( new CustomerReadRequestSerializer( new CustomerReadRequest( $office_code, $customer_code ) ) ),
		);
	}
}
