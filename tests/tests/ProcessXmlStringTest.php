<?php
/**
 * Process XML string test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

use PHPUnit\Framework\TestCase;

/**
 * Process XML string test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class ProcessXmlStringTest extends TestCase {
	/**
	 * Test
	 */
	public function test() {
		$process_xml_string = new ProcessXmlString( 'test' );

		$string = (string) $process_xml_string;

		$this->assertEquals( 'test', $string );
	}
}
