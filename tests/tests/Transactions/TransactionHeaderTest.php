<?php
/**
 * Transaction header test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Transactions
 */

namespace Pronamic\WP\Twinfield\Transactions;

use Pronamic\WP\Twinfield\PaymentMethods;

/**
 * Transaction header test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield.SalesInvoices
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class TransactionHeaderTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Test
	 */
	public function test() {
		$header = new TransactionHeader();

		$header->set_office( '11024' );
		$this->assertEquals( '11024', $header->get_office() );

		$header->set_code( 'INK' );
		$this->assertEquals( 'INK', $header->get_code() );

		$header->set_number( '201400001' );
		$this->assertEquals( '201400001', $header->get_number() );

		$header->set_period( '2014/12' );
		$this->assertEquals( '2014/12', $header->get_period() );

		$header->set_currency( 'EUR' );
		$this->assertEquals( 'EUR', $header->get_currency() );

		$date = new \DateTime();
		$header->set_date( $date );
		$this->assertEquals( $date, $header->get_date() );
	}
}
