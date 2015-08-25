<?php
/**
 * Read request test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Read request test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class ReadRequestTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Test
	 */
	public function test() {
		$type   = 'article';
		$office = getenv( 'TWINFIELD_OFFICE_CODE' );

		$read_request = new ReadRequest( $type, $office );
		
		$this->assertInstanceOf( __NAMESPACE__ . '\ReadRequest', $read_request );
	}
}
