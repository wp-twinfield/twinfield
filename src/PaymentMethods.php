<?php
/**
 * Payment methods.
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Payment methods
 *
 * This class contains constants for different Twinfield payment methods.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class PaymentMethods {
	/**
	 * Cash.
	 *
	 * @var string
	 */
	const CASH = 'cash';

	/**
	 * Bank.
	 *
	 * @var string
	 */
	const BANK = 'bank';

	/**
	 * Cheque.
	 *
	 * @var string
	 */
	const CHEQUE = 'cheque';

	/**
	 * Cash on delivery.
	 *
	 * @var string
	 */
	const CASH_ON_DELIVERY = 'cashondelivery';

	/**
	 * DA.
	 *
	 * @var string
	 */
	const DA = 'da';
}
