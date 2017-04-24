<?php
/**
 * Customer test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/SalesInvoice
 */

namespace Pronamic\WP\Twinfield\Customers;

use PHPUnit\Framework\TestCase;

/**
 * Customer test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield/SalesInvoice
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class CustomerTest extends TestCase {
	/**
	 * Test
	 */
	public function test() {
		$customer = new Customer();

		$customer->set_office( '1000' );
		$this->assertEquals( '1000', $customer->get_office() );

		$customer->set_code( '1000' );
		$this->assertEquals( '1000', $customer->get_code() );

		$customer->set_name( 'Name' );
		$this->assertEquals( 'Name', $customer->get_name() );

		$customer->set_shortname( 'Shortname' );
		$this->assertEquals( 'Shortname', $customer->get_shortname() );

		$this->assertInstanceOf( __NAMESPACE__ . '\CustomerFinancials', $customer->get_financials() );

		$this->assertInstanceOf( __NAMESPACE__ . '\CustomerCreditManagement', $customer->get_credit_management() );
	}
}
