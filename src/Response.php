<?php
/**
 * Response
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Response
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
abstract class Response {
	/**
	 * The result code.
	 *
	 * @var int
	 */
	private $result;

	/**
	 * The result message.
	 *
	 * @var string
	 */
	private $message;

	/**
	 * Constructs and initialize an Twinfield article read request.
	 *
	 * @param int               $result  The number of results.
	 * @param \SimpleXMLElement $message The XML response message.
	 */
	public function __construct( $result, \SimpleXMLElement $message ) {
		$this->result  = $result;
		$this->message = $message;
	}

	/**
	 * Get the sales invoice response result.
	 *
	 * @return string
	 */
	public function get_result() {
		return $this->result;
	}

	/**
	 * Helper function to check if this response is successful
	 *
	 * @return boolean
	 */
	public function is_successful() {
		return Result::SUCCESSFUL === $this->result;
	}

	/**
	 * Helper function to check if this response is not successful
	 *
	 * @return boolean
	 */
	public function is_not_successful() {
		return Result::NOT_SUCCESSFUL === $this->result;
	}

	/**
	 * Get the sales invoice.
	 *
	 * @return string
	 */
	public function get_message() {
		return $this->message;
	}
}
