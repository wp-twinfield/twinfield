<?php
/**
 * Read request
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Session
 *
 * This class represents an Twinfield session.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
abstract class ReadRequest {
	/**
	 * Specify what type of data to read.
	 *
	 * @var string
	 */
	private $type;

	/**
	 * Specify from wich office to read.
	 *
	 * @var string
	 */
	private $office;

	/**
	 * Constructs and initialize an Twinfield read request.
	 *
	 * @param string $type    Specify what type of data to read.
	 * @param string $office  Specify from wich office to read.
	 */
	public function __construct( $type, $office ) {
		$this->type   = $type;
		$this->office = $office;
	}
}
