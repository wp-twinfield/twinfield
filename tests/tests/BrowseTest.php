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
use Pronamic\WP\Twinfield\XML\Articles\ArticleUnserializer;

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
class BrowseTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Test processor
	 */
	public function test_processor() {
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

        $xml = new \SimpleXMLElement('<read/>');
        $xml->addChild('type', 'browse');
        $xml->addChild('office', getenv( 'TWINFIELD_OFFICE_CODE' ) );
        $xml->addChild('code', '130_1');

		$response = $xml_processor->process_xml_string( new ProcessXmlString( $xml->asXML() ) );

echo $response->get_result();

		$this->assertInstanceOf( __NAMESPACE__ . '\ProcessXmlStringResponse', $response );
		$this->assertInternalType( 'string', $response->get_result() );
	}
}
