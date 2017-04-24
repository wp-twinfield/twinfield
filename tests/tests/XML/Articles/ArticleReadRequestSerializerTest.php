<?php
/**
 * Article read request XML test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Articles;

use PHPUnit\Framework\TestCase;

use Pronamic\WP\Twinfield\Articles\ArticleReadRequest;
use Pronamic\WP\Twinfield\XML\Articles\ArticleReadRequestSerializer;

/**
 * Article read request XML test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class ArticleReadRequestSerializerTest extends TestCase {
	/**
	 * Test
	 */
	public function test() {
		$office_code  = getenv( 'TWINFIELD_OFFICE_CODE' );
		$article_code = getenv( 'TWINFIELD_ARTICLE_CODE' );

		$request = new ArticleReadRequest( $office_code, $article_code );

		$xml = new ArticleReadRequestSerializer( $request );

		$string = (string) $xml;

		$this->assertInternalType( 'string', $string );
	}
}
