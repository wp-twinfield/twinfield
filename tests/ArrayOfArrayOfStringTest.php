<?php
/**
 * Array of array of string test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Array of array of string test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class ArrayOfArrayOfStringTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Test
	 */
	public function test() {
		global $credentials;

		$array_of_array_string = new ArrayOfArrayOfString();
		$array_of_array_string->add( new ArrayOfString() );

		$data = array();

		foreach ( $array_of_array_string as $array_of_string ) {
			$data[] = $array_of_string;
		}

		$this->assertCount( 1, $data );
	}
}
