<?php
/**
 * Dimension types
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Dimension types
 *
 * This class contains constants for different Twinfield dimension types.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class DimensionTypes {
	/**
	 * Balancesheet
	 *
	 * @var string
	 */
	const BAS = 'BAS';

	/**
	 * Profit and Loss
	 *
	 * @var string
	 */
	const PNL = 'PNL';

	/**
	 * Accounts Payable
	 *
	 * @var string
	 */
	const CRD = 'CRD';

	/**
	 * Accounts Receivable
	 *
	 * @var string
	 */
	const DEB = 'DEB';

	/**
	 * Cost centers
	 *
	 * @var string
	 */
	const KPL = 'KPL';

	/**
	 * Assets
	 *
	 * @var string
	 */
	const AST = 'AST';

	/**
	 * Projects
	 *
	 * @var string
	 */
	const PRJ = 'PRJ';

	/**
	 * Activities
	 *
	 * @var string
	 */
	const ACT = 'ACT';
}
