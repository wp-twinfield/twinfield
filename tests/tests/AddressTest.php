<?php
/**
 * Address test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/SalesInvoices
 */

namespace Pronamic\WP\Twinfield;

use PHPUnit\Framework\TestCase;

use Pronamic\WP\Twinfield;

/**
 * Address test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield.SalesInvoices
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class AddressTest extends TestCase {
	/**
	 * Test
	 */
	public function test() {
		$address = new Address();

		$address->set_name( 'Name' );
		$this->assertEquals( 'Name', $address->get_name() );

		$address->set_country( 'Country' );
		$this->assertEquals( 'Country', $address->get_country() );

		$address->set_city( 'City' );
		$this->assertEquals( 'City', $address->get_city() );

		$address->set_postcode( 'Postcode' );
		$this->assertEquals( 'Postcode', $address->get_postcode() );

		$address->set_telephone( 'Telephone' );
		$this->assertEquals( 'Telephone', $address->get_telephone() );

		$address->set_telefax( 'Telefax' );
		$this->assertEquals( 'Telefax', $address->get_telefax() );

		$address->set_email( 'Email' );
		$this->assertEquals( 'Email', $address->get_email() );

		$address->set_contact( 'Contact' );
		$this->assertEquals( 'Contact', $address->get_contact() );

		$address->set_field_1( 'Field 1' );
		$this->assertEquals( 'Field 1', $address->get_field_1() );

		$address->set_field_2( 'Field 2' );
		$this->assertEquals( 'Field 2', $address->get_field_2() );

		$address->set_field_3( 'Field 3' );
		$this->assertEquals( 'Field 3', $address->get_field_3() );

		$address->set_field_4( 'Field 4' );
		$this->assertEquals( 'Field 4', $address->get_field_4() );

		$address->set_field_5( 'Field 5' );
		$this->assertEquals( 'Field 5', $address->get_field_5() );

		$address->set_field_6( 'Field 6' );
		$this->assertEquals( 'Field 6', $address->get_field_6() );
	}
}
