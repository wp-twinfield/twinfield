<?php
/**
 * Office
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Offices;

use Pronamic\WP\Twinfield\CodeName;
use Pronamic\WP\Twinfield\Organisation\Organisation;

/**
 * Office
 *
 * This class represents an Twinfield office
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class Office extends CodeName {
	/**
	 * Organisation.
	 *
	 * @var Organisation|null
	 */
	private $organisation;
}
