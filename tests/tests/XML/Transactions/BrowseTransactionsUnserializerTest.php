<?php
/**
 * Customer XML unserializer test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\XML\Transactions;

use PHPUnit\Framework\TestCase;

/**
 * Customer XML unserializer test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class BrowseTransactionsUnserializerTest extends TestCase {
	/**
	 * Test
	 */
	public function test() {
		$xml = simplexml_load_file( __DIR__ . '/../../../xml/Transactions/browse-transaction-lines.xml' );

		$unserializer = new BrowseTransactionsUnserializer();

		$lines = $unserializer->unserialize( $xml );

		$this->assertInternalType( 'array', $lines );
		$this->assertCount( 88, $lines );
	}
}
