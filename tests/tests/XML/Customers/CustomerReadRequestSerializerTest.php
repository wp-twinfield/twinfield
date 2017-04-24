<?php
/**
 * Customer read request XML test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Customer;

use PHPUnit\Framework\TestCase;

use Pronamic\WP\Twinfield\Customers\CustomerReadRequest;
use Pronamic\WP\Twinfield\XML\Customers\CustomerReadRequestSerializer;

/**
 * Customer read request XML test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class CustomerReadRequestSerializerTest extends TestCase {
	/**
	 * Test
	 */
	public function test() {
		$office_code   = getenv( 'TWINFIELD_OFFICE_CODE' );
		$customer_code = getenv( 'TWINFIELD_CUSTOMER_CODE' );

		$request = new CustomerReadRequest( $office_code, $customer_code );

		$xml = new CustomerReadRequestSerializer( $request );

		$string = (string) $xml;

		$this->assertInternalType( 'string', $string );
	}
}
