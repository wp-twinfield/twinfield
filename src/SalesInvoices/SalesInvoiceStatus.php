<?php
/**
 * Sales invoice status
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Sales invoice status
 *
 * This class contains constants for different Twinfield sales invoice statuses.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SalesInvoiceStatus {
	/**
	 * Default.
	 *
	 * @var string
	 */
	const DEFAULT = 'default';

	/**
	 * Concept.
	 *
	 * @var string
	 */
	const CONCEPT = 'concept';

	/**
	 * Final.
	 *
	 * @var string
	 */
	const FINAL = 'final';
}
