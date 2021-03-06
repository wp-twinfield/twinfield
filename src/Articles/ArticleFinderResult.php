<?php
/**
 * Article finder result
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Articles;

use Pronamic\WP\Twinfield\Contacts\Contact;

/**
 * Article finder result
 *
 * This class represents an Twinfield article
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class ArticleFinderResult {
	/**
	 * Code.
	 *
	 * @var string
	 */
	private $code;

	/**
	 * Name.
	 *
	 * @var string
	 */
	private $name;

	/**
	 * Constructs and initializes an customer find result.
	 */
	public function __construct() {

	}

	/**
	 * Get code.
	 *
	 * @return string
	 */
	public function get_code() {
		return $this->code;
	}

	/**
	 * Set code.
	 *
	 * @param string $code The code.
	 */
	public function set_code( $code ) {
		$this->code = $code;
	}

	/**
	 * Get name.
	 *
	 * @return string
	 */
	public function get_name() {
		return $this->name;
	}

	/**
	 * Set name.
	 *
	 * @param string $name The name.
	 */
	public function set_name( $name ) {
		$this->name = $name;
	}
}
