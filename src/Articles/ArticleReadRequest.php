<?php
/**
 * Read request
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Articles;

use Pronamic\WP\Twinfield\ReadRequest;

/**
 * Session
 *
 * This class represents an Twinfield session.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class ArticleReadRequest extends ReadRequest {
	/**
	 * Specifcy which article code to read.
	 *
	 * @var string
	 */
	private $code;

	/**
	 * Constructs and initialize an Twinfield article read request.
	 *
	 * @param string $office  Specify from wich office to read.
	 * @param string $code    Specifcy which article code to read.
	 */
	public function __construct( $office, $code ) {
		parent::__construct( 'article', $office );

		$this->code = $code;
	}
}
