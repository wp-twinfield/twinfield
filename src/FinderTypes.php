<?php
/**
 * Finder types
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Finder types
 *
 * This class contains constants for different Twinfield finder types.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class FinderTypes {
	/**
	 * Twinfield finder type constant for "Items".
	 * Return fields: code, name
	 *
	 * @var string
	 */
	const ART = 'ART';

	/**
	 * Twinfield finder type constant for "Asset methods".
	 * Return fields: code, name
	 *
	 * @var string
	 */
	const ASM = 'ASM';

	/**
	 * Twinfield finder type constant for "Budgets".
	 * Return fields: code, name
	 *
	 * @var string
	 */
	const BDS = 'BDS';

	/**
	 * Twinfield finder type constat for "Dimensions".
	 * Return fields: code, name, bank account number, address fields
	 *
	 * @var string
	 */
	const DIM = 'DIM';
}
