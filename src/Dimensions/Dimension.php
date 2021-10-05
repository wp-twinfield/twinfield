<?php
/**
 * Dimension
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Dimensions;

use Pronamic\WP\Twinfield\CodeName;

/**
 * Dimension
 *
 * This class represents an Twinfield dimension
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class Dimension extends CodeName {
	/**
	 * Type.
	 *
	 * @var string
	 */
	private $type;

	/**
	 * Level.
	 *
	 * The level of the dimension determines what data you can capture.
	 * At level 1, the balance sheet and profit and loss accounts are
	 * captured, at level 2 relations (accounts payable and accounts
	 * receivable) and cost centres and at level 3 you can register
	 * projects and assets.
	 *
	 * @var int|null
	 */
	private $level;

	/**
	 * Modified at datetime object.
	 *
	 * The modified date is only returned when using the Twinfield finder
	 * service with the 'modifiedsince' option.
	 *
	 * @var null|\DateTimeImmutable
	 */
	private $modified_at;

	/**
	 * Status.
	 *
	 * @var string|null
	 */
	private $status;

	/**
	 * Constructs and initializes a dimension.
	 *
	 * @param string      $type      Type.
	 * @param string      $code      Code.
	 * @param string|null $name      Name.
	 * @param string|null $shortname Shortname.
	 * @param int|null    $level     Level.
	 */
	public function __construct( $type, $code, $name = null, $shortname = null, $level = null ) {
		parent::__construct( $code, $name, $shortname );

		$this->set_type( $type );
		$this->set_level( $level );
	}

	/**
	 * Get type.
	 *
	 * @return string
	 */
	public function get_type() {
		return $this->type;
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
	 * Get level.
	 *
	 * @return int|null
	 */
	public function get_level() {
		return $this->level;
	}

	/**
	 * Set level.
	 *
	 * @param int|null $level The level.
	 */
	public function set_level( $level ) {
		$this->level = $level;
	}

	/**
	 * Get modified at datetime object.
	 *
	 * @return null|\DateTimeImmutable
	 */
	public function get_modified_at() {
		return $this->modified_at;
	}

	/**
	 * Set modified at datetime object.
	 *
	 * @param null|\DateTimeImmutable 
	 */
	public function set_modified_at( \DateTimeImmutable $modified_at = null ) {
		$this->modified_at = $modified_at;
	}

	/**
	 * Get status.
	 *
	 * @return string
	 */
	public function get_status() {
		return $this->status;
	}

	/**
	 * Set status.
	 *
	 * @param string $status The status.
	 */
	public function set_status( $status ) {
		$this->status = $status;
	}
}
