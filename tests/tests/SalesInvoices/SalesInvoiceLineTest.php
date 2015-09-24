<?php
/**
 * Sales invoice header test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/SalesInvoices
 */

namespace Pronamic\WP\Twinfield\SalesInvoices;

use Pronamic\WP\Twinfield\PaymentMethods;

/**
 * Sales invoice header test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield.SalesInvoices
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SalesInvoiceLineTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Test
	 */
	public function test() {
		$line = new SalesInvoiceLine();

		$line->set_id( '1234' );
		$this->assertEquals( '1234', $line->get_id() );

		$line->set_article( 'article' );
		$this->assertEquals( 'article', $line->get_article() );

		$line->set_subarticle( 'subarticle' );
		$this->assertEquals( 'subarticle', $line->get_subarticle() );

		$line->set_quantity( 1 );
		$this->assertEquals( 1, $line->get_quantity() );

		$line->set_units( 2 );
		$this->assertEquals( 2, $line->get_units() );

		$line->set_allow_discount_or_premium( false );
		$this->assertEquals( false, $line->get_allow_discount_or_premium() );

		$line->set_value_excl( 1.00 );
		$this->assertEquals( 1.00, $line->get_value_excl() );

		$line->set_vat_value( 0.21 );
		$this->assertEquals( 0.21, $line->get_vat_value() );

		$line->set_value_inc( 1.21 );
		$this->assertEquals( 1.21, $line->get_value_inc() );

		$line->set_free_text_1( 'Free Text 1' );
		$this->assertEquals( 'Free Text 1', $line->get_free_text_1() );

		$line->set_free_text_2( 'Free Text 2' );
		$this->assertEquals( 'Free Text 2', $line->get_free_text_2() );

		$line->set_free_text_3( 'Free Text 3' );
		$this->assertEquals( 'Free Text 3', $line->get_free_text_3() );
	}
}
