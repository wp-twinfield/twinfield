<?php
/**
 * Customer financials test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Customers;

/**
 * Customer financials test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class CustomerFinancialsTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Test
	 */
	public function test() {
		$customer_financials = new CustomerFinancials();

		$customer_financials->set_due_days( 14 );

		$this->assertEquals( 14, $customer_financials->get_due_days() );
	}
}
