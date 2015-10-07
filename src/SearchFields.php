<?php
/**
 * Search fields
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Search fields
 *
 * This class contains constants for different Twinfield search fields.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SearchFields {
	/**
	 * Searches on the code or name field.
	 * Type: All
	 *
	 * @var int
	 */
	const CODE_AND_NAME = 0;

	/**
	 * Searches only on the code field
	 * Type: All
	 *
	 * @var int
	 */
	const CODE = 1;

	/**
	 * Searches only on the name field
	 * Type: All
	 *
	 * @var int
	 */
	const NAME = 2;

	/**
	 * Bank account number
	 * Type: Dimensions
	 *
	 * @var int
	 */
	const BANK_ACCOUNT_NUMBER = 3;

	/**
	 * Address fields
	 * Type: Dimensions
	 *
	 * @var int
	 */
	const ADDRESS_FIELDS = 4;
}
