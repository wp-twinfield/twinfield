<?php
/**
 * Sales invoice test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/SalesInvoices
 */

namespace Pronamic\WP\Twinfield\SalesInvoices;

/**
 * Sales invoice test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield.SalesInvoices
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SalesInvoiceTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Test
	 */
	public function test() {
		$invoice = new SalesInvoice();

		$line = $invoice->new_line();
		$line->set_value_excl( 1.00 );
		$line->set_vat_value( 0.21 );
		$line->set_value_inc( 1.21 );

		$line = $invoice->new_line();
		$line->set_value_excl( 1.00 );
		$line->set_vat_value( 0.21 );
		$line->set_value_inc( 1.21 );

		$this->assertEquals( 2.00, $invoice->get_value_excl() );
		$this->assertEquals( 0.42, $invoice->get_vat_value() );
		$this->assertEquals( 2.42, $invoice->get_value_inc() );
	}
}
