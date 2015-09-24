<?php
/**
 * Customer credit management test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Customers;

/**
 * Customer credit management test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class CustomerCreditManagementTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Test
	 */
	public function test() {
		$credit_management = new CustomerCreditManagement();

		$credit_management->set_send_reminder( 'email' );
		$this->assertEquals( 'email', $credit_management->get_send_reminder() );

		$credit_management->set_reminder_email( 'info@pronamic.eu' );
		$this->assertEquals( 'info@pronamic.eu', $credit_management->get_reminder_email() );
	}
}
