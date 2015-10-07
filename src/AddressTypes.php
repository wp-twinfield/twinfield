<?php
/**
 * Address types
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Address types
 *
 * This class contains constants for different Twinfield address types.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class AddressTypes {
	/**
	 * Adress type invoice.
	 *
	 * @var string
	 */
	const INVOICE = 'invoice';

	/**
	 * Adress type postal.
	 *
	 * @var string
	 */
	const POSTAL = 'postal';

	/**
	 * Adress type contact.
	 *
	 * @var string
	 */
	const CONTACT = 'contact';
}
