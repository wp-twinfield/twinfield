<?php
/**
 * Browse codes
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Browse;

/**
 * Browse codes
 *
 * This class contains constants for different Twinfield browse codes.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class BrowseCodes {
	/**
	 * General ledger transactions.
	 *
	 * @var string
	 */
	const GENERAL_LEDGER_TRANSACTIONS = '000';

	/**
	 * Transactions still to be matched
	 *
	 * @var string
	 */
	const TRANSACTIONS_STILL_TO_BE_MATCHED = '010';

	/**
	 * Transaction list
	 *
	 * @var string
	 */
	const TRANSACTION_LIST = '020';

	/**
	 * Customer transactions
	 *
	 * @var string
	 */
	const CUSTOMER_TRANSACTIONS = '100';

	/**
	 * ?
	 *
	 * @var string
	 */
	const DOCKET_INVOICES = '163';

	/**
	 * Supplier transactions
	 *
	 * @var string
	 */
	const SUPPLIER_TRANSACTIONS = '200';

	/**
	 * Project transactions
	 *
	 * @var string
	 */
	const PROJECT_TRANSACTIONS = '300';

	/**
	 * Asset transactions
	 *
	 * @var string
	 */
	const ASSET_TRANSACTIONS = '301';

	/**
	 * Cash transactions
	 *
	 * @var string
	 */
	const CASH_TRANSACTIONS = '400';

	/**
	 * Bank transactions
	 *
	 * @var string
	 */
	const BANK_TRANSACTIONS = '410';

	/**
	 * Cost centers
	 *
	 * @var string
	 */
	const COST_CENTERS = '900';

	/**
	 * General Ledger (details)
	 *
	 * @var string
	 */
	const GENERAL_LEDGER_DETAILS_V1 = '030_1';

	/**
	 * General Ledger (details) (v2)
	 *
	 * @var string
	 */
	const GENERAL_LEDGER_DETAILS_V2 = '030_2';

	/**
	 * General Ledger (intercompany)
	 *
	 * @var string
	 */
	const GENERAL_LEDGER_INTER_COMPANY = '031';

	/**
	 * Annual Report (totals)
	 *
	 * @var string
	 */
	const ANNUAL_REPORT_TOTALS = '040_1';

	/**
	 * Annual Report (YTD)
	 *
	 * @var string
	 */
	const ANNUAL_REPORT_YTD = '050_1';

	/**
	 * Annual Report (totals multicurrency)
	 *
	 * @var string
	 */
	const ANNUAL_REPORT_TOTALS_MULTI_CURRENCY = '060';

	/**
	 * Customers
	 *
	 * @var string
	 */
	const CUSTOMERS = '130_1';

	/**
	 * Credit Management
	 *
	 * @var string
	 */
	const CREDIT_MANAGEMENT = '164';

	/**
	 * Suppliers
	 *
	 * @var string
	 */
	const SUPPLIERS = '230_1';

	/**
	 * Fixed Assets
	 *
	 * @var string
	 */
	const FIXED_ASSETS = '302_1';

	/**
	 * Time & Expenses (Totals)
	 *
	 * @var string
	 */
	const TIME_AND_EXPENSES_TOTALS = '610_1';

	/**
	 * Time & Expenses (Multicurrency)
	 *
	 * @var string
	 */
	const TIME_AND_EXPENSES_MULTI_CURRENCY = '620';

	/**
	 * Time & Expenses (Details)
	 *
	 * @var string
	 */
	const TIME_AND_EXPENSES_DETAILS = '650_1';

	/**
	 * Time & Expenses (Totals per week)
	 *
	 * @var string
	 */
	const TIME_AND_EXPENSES_TOTALS_PER_WEEK = '651_1';

	/**
	 * Time & Expenses (Totals per period)
	 *
	 * @var string
	 */
	const TIME_AND_EXPENSES_TOTALS_PER_PERIOD = '652_2';

	/**
	 * Time & Expenses (Billing details)
	 *
	 * @var string
	 */
	const TIME_AND_EXPENSES_BILLING_DETAILS = '660_1';

	/**
	 * Time & Expenses (Billing per week)
	 *
	 * @var string
	 */
	const TIME_AND_EXPENSES_BILLING_PER_WEEK = '661_1';

	/**
	 * Time & Expenses (Billing per period)
	 *
	 * @var string
	 */
	const TIME_AND_EXPENSES_BILLING_PER_PERIOD = '662_1';

	/**
	 * Transaction summary
	 *
	 * @var string
	 */
	const TRANSACTION_SUMMARY = '670';

	/**
	 * Bank link details
	 *
	 * @var string
	 */
	const BANK_LINK_DETAILS = '680';

	/**
	 * Vat Return status
	 *
	 * @var string
	 */
	const VAT_RETURN_STATUS = '690';

	/**
	 * Hierarchy access
	 *
	 * @var string
	 */
	const HIERARCHY_ACCESS = '700';
}
