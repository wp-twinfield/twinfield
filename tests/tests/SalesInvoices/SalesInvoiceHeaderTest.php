<?php
/**
 * Sales invoice header test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/SalesInvoices
 */

namespace Pronamic\WP\Twinfield\SalesInvoices;

use PHPUnit\Framework\TestCase;
use Pronamic\WP\Twinfield\PaymentMethods;

/**
 * Sales invoice header test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield.SalesInvoices
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SalesInvoiceHeaderTest extends TestCase {
	/**
	 * Test
	 */
	public function test() {
		$header = new SalesInvoiceHeader();

		$header->set_office( '1000' );
		$this->assertEquals( '1000', $header->get_office() );

		$header->set_type( 'FACTUUR' );
		$this->assertEquals( 'FACTUUR', $header->get_type() );

		$header->set_number( '1234567890' );
		$this->assertEquals( '1234567890', $header->get_number() );

		$date = new \DateTime();
		$header->set_date( $date );
		$this->assertEquals( $date, $header->get_date() );

		$due_date = new \DateTime();
		$header->set_due_date( $due_date );
		$this->assertEquals( $due_date, $header->get_due_date() );

		$header->set_bank( 'Bank' );
		$this->assertEquals( 'Bank', $header->get_bank() );

		$header->set_customer( '123' );
		$this->assertEquals( '123', $header->get_customer() );

		$header->set_status( SalesInvoiceStatus::STATUS_CONCEPT );
		$this->assertEquals( SalesInvoiceStatus::STATUS_CONCEPT, $header->get_status() );

		$header->set_payment_method( PaymentMethods::BANK );
		$this->assertEquals( PaymentMethods::BANK, $header->get_payment_method() );

		$header->set_header_text( 'Header' );
		$this->assertEquals( 'Header', $header->get_header_text() );

		$header->set_footer_text( 'Footer' );
		$this->assertEquals( 'Footer', $header->get_footer_text() );
	}
}
