<?php
/**
 * Transaction header test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Transactions
 */

namespace Pronamic\WP\Twinfield\Transactions;

use PHPUnit\Framework\TestCase;
use Pronamic\WP\Twinfield\Currency;
use Pronamic\WP\Twinfield\PaymentMethods;

/**
 * Transaction header test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield.SalesInvoices
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class TransactionHeaderTest extends TestCase {
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

		$currency = new Currency();
		$currency->set_code( 'EUR' );

		$header->set_currency( $currency );
		$this->assertEquals( 'EUR', $header->get_currency()->get_code() );

		$date = new \DateTime();
		$header->set_date( $date );
		$this->assertEquals( $date, $header->get_date() );
	}
}
