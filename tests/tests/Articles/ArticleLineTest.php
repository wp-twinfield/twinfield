<?php
/**
 * Article line test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Articles;

use PHPUnit\Framework\TestCase;

/**
 * Article line test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class ArticleLineTest extends TestCase {
	/**
	 * Test
	 */
	public function test() {
		$article_line = new ArticleLine();

		$article_line->set_name( 'Article' );
	}
}
