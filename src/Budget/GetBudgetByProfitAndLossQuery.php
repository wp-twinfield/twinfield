<?php
/**
 * Get budget by profit and loss.
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Budget;

use Pronamic\WP\Twinfield\Query;

/**
 * Get budget by profit and loss.
 *
 * @link       https://accounting.twinfield.com/webservices/documentation/#/ApiReference/Masters/Budget
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class GetBudgetByProfitAndLossQuery extends Query {
	/**
	 * Code of the budget to be retrieved.
	 *
	 * @var string
	 */
    public $Code;

    /**
     * Year to be retrieved.
     *
     * @var int
     */
    public $Year;

    /**
     * Start period to be retrieved.
     *
     * @var int
     */
    public $PeriodFrom;

    /**
     * End period to be retrieved.
     *
     * @var int
     */
    public $PeriodTo;

    /**
     * Include provisional transactions.
     *
     * @var bool
     */
    public $IncludeProvisional;

    /**
     * Include final transactions.
     *
     * @var bool
     */
    public $IncludeFinal;

    /**
     * General ledger start code.
     *
     * @var string
     */
    public $Dim1From;

    /**
     * General ledger end code.
     *
     * @var string
     */
    public $Dim1To;

    /**
     * Cost center start code.
     *
     * @var string
     */
    public $Dim2From;

    /**
     * Cost center end code.
     *
     * @var string
     */
    public $Dim2To;

    /**
     * Project start code.
     *
     * @var string
     */
    public $Dim3From;

    /**
     * Project end code.
     *
     * @var string
     */
    public $Dim3To;
}
