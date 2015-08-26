<?php
/**
 * Article
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Articles;

/**
 * Article
 *
 * This class represents an Twinfield article
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class Article {
	/**
	 * Header.
	 *
	 * @var ArticleHeader
	 */
	private $header;

	/**
	 * Lines.
	 *
	 * @var array
	 */
	private $lines;

	/**
	 * Constructs and initialize an Twinfield article.
	 *
	 * @param ArticleHeader $header    The article header object for this article.
	 * @param array         $lines     The articles lines for this article.
	 */
	public function __construct( ArticleHeader $header, array $lines = array() ) {
		$this->header = $header;
		$this->lines  = $lines;
	}
}
