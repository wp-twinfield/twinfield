<?php
/**
 * Customer XML serializer test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\XML\Customers;

use Pronamic\WP\Twinfield\Customers\Customer;

/**
 * Customer XML serializer test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class CustomerSerializerTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Test.
	 */
	public function test() {
		$customer = new Customer();

		$customer->set_office( '1234' );
		$customer->set_code( '123456' );
		$customer->set_name( 'Test' );

		// Finanicials.
		$financials = $customer->get_financials();
		$financials->set_due_days( 14 );

		// Credit Management.
		$credit_management = $customer->get_credit_management();
		$credit_management->set_send_reminder( 'email' );
		$credit_management->set_reminder_email( 'info@pronamic.nl' );

		$serializer = new CustomerSerializer( $customer );

		$this->assertXmlStringEqualsXmlFile(
			__DIR__ . '/../../../xml/Customers/serialize-customer.xml',
			(string) $serializer
		);
	}
}
