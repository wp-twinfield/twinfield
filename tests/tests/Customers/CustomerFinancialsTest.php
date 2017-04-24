<?php
/**
 * Customer financials test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Customers;

use PHPUnit\Framework\TestCase;

/**
 * Customer financials test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class CustomerFinancialsTest extends TestCase {
	/**
	 * Test
	 */
	public function test() {
		$customer_financials = new CustomerFinancials();

		$customer_financials->set_due_days( 14 );
		$this->assertEquals( 14, $customer_financials->get_due_days() );

		$customer_financials->set_ebilling( true );
		$this->assertEquals( true, $customer_financials->get_ebilling() );

		$customer_financials->set_ebillmail( 'info@pronamic.nl' );
		$this->assertEquals( 'info@pronamic.nl', $customer_financials->get_ebillmail() );
	}
}
