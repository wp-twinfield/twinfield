<?php
/**
 * Article read request test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Articles;

use PHPUnit\Framework\TestCase;

/**
 * Article read request test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class ArticleReadRequestTest extends TestCase {
	/**
	 * Test
	 */
	public function test() {
		$office = getenv( 'TWINFIELD_OFFICE_CODE' );
		$code   = getenv( 'TWINFIELD_ARTICLE_CODE' );

		$read_request = new ArticleReadRequest( $office, $code );

		$this->assertInstanceOf( __NAMESPACE__ . '\ArticleReadRequest', $read_request );
	}
}
