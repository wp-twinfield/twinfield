<?php
/**
 * Article header
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Articles;

/**
 * Article header
 *
 * This class represents an Twinfield article header.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class ArticleHeader {
	/**
	 * Status.
	 *
	 * @var string
	 */
	private $status;

	/**
	 * Office.
	 *
	 * @var string
	 */
	private $office;

	/**
	 * Code
	 *
	 * @var string
	 */
	private $code;

	/**
	 * Type
	 *
	 * @var string
	 */
	private $type;

	/**
	 * Name
	 *
	 * @var string
	 */
	private $name;

	/**
	 * Constructs and initialize an Twinfield article header.
	 */
	public function __construct() {

	}

	/**
	 * Set office.
	 *
	 * @param string $office The office.
	 */
	public function set_office( $office ) {
		$this->office = $office;
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
	 * Set type.
	 *
	 * @param string $type The type.
	 */
	public function set_type( $type ) {
		$this->type = $type;
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
