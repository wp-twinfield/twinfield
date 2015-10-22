<?php
/**
 * Customer XML unserializer test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\XML\Customers;

use Pronamic\WP\Twinfield\Customers\Customer;

/**
 * Customer XML unserializer test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class CustomerUnserializerTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Test
	 */
	public function test() {
		$xml = simplexml_load_file( __DIR__ . '/../../../xml/Customers/read-dimensions-deb-response-1.xml' );

		$unserializer = new CustomerUnserializer();

		$response = $unserializer->unserialize( $xml );

		$expected = new Customer();
		$expected->set_office( '123456' );
		$expected->set_code( '1002' );
		$expected->set_name( 'Remco Tolsma' );
		$expected->set_shortname( '' );

		$address = $expected->new_address();
		$address->set_id( '1' );
		$address->set_type( 'invoice' );
		$address->set_default( true );
		$address->set_name( 'Remco Tolsma' );
		$address->set_country( 'NL' );
		$address->set_city( 'Drachten' );
		$address->set_postcode( '9203 KA' );
		$address->set_telephone( '+31 (0)516 481 200' );
		$address->set_telefax( '+31 (0)516 481 999' );
		$address->set_email( 'remco@pronamic.nl' );
		$address->set_contact( '' );
		$address->set_field_1( 'Remco Tolsma' );
		$address->set_field_2( 'Merkebuorren39a' );
		$address->set_field_3( '' );
		$address->set_field_4( '' );
		$address->set_field_5( '' );
		$address->set_field_6( '' );

		$address = $expected->new_address();
		$address->set_id( '2' );
		$address->set_type( 'postal' );
		$address->set_default( false );
		$address->set_name( 'Remco Tolsma' );
		$address->set_country( 'NL' );
		$address->set_city( 'Drachten' );
		$address->set_postcode( '9203 KA' );
		$address->set_telephone( '+31 (0)516 481 200' );
		$address->set_telefax( '+31 (0)516 481 999' );
		$address->set_email( 'remco@pronamic.nl' );
		$address->set_contact( '' );
		$address->set_field_1( '' );
		$address->set_field_2( 'Merkebuorren39a' );
		$address->set_field_3( '' );
		$address->set_field_4( '' );
		$address->set_field_5( '' );
		$address->set_field_6( '' );

		$this->assertEquals( $expected, $response->get_customer() );
	}
}
