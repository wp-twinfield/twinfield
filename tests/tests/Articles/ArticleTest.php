<?php
/**
 * Article test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Articles;

use PHPUnit\Framework\TestCase;

/**
 * Article test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class ArticleTest extends TestCase {
	/**
	 * Test
	 */
	public function test() {
		$article = new Article( new ArticleHeader() );
	}
}
