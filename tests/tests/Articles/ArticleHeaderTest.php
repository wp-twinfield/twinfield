<?php
/**
 * Article read request test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Articles;

/**
 * Article read request test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class ArticleHeaderTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Test
	 */
	public function test() {
		$article_header = new ArticleHeader();

		$article_header->set_office( '1000' );
		$article_header->set_code( 'CODE' );
		$article_header->set_type( 'TYPE' );
		$article_header->set_name( 'Article' );
	}
}
