<?php
/**
 * Browse codes
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

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
    const GENERAL_LEDGER_TRANSACTIONS = '000';
    const TRANSACTIONS_STILL_TO_BE_MATCHED = '010';
    const TRANSACTION_LIST = '020';
    const CUSTOMER_TRANSACTIONS = '100';
    const DOCKET_INVOICES = '163';
    const SUPPLIER_TRANSACTIONS = '200';
    const PROJECT_TRANSACTIONS = '300';
    const ASSET_TRANSACTIONS = '301';
    const CASH_TRANSACTIONS = '400';
    const BANK_TRANSACTIONS = '410';
    const COST_CENTERS = '900';
    const GENERAL_LEDGER_DETAILS_V1 = '030_1';
    const GENERAL_LEDGER_DETAILS_V2 = '030_2';
    const GENERAL_LEDGER_INTER_COMPANY = '031';
    const ANNUAL_REPORT_TOTALS = '040_1';
    const ANNUAL_REPORT_YTD = '050_1';
    const ANNUAL_REPORT_TOTALS_MULTI_CURRENCY = '060';
    const CUSTOMERS = '130_1';
    const CREDIT_MANAGEMENT = '164';
    const SUPPLIERS = '230_1';
    const FIXED_ASSETS = '302_1';
    const TIME_AND_EXPENSES_TOTALS = '610_1';
    const TIME_AND_EXPENSES_MULTI_CURRENCY = '620';
    const TIME_AND_EXPENSES_DETAILS = '650_1';
    const TIME_AND_EXPENSES_TOTALS_PER_WEEK = '651_1';
    const TIME_AND_EXPENSES_TOTALS_PER_PERIOD = '652_2';
    const TIME_AND_EXPENSES_BILLING_DETAILS = '660_1';
    const TIME_AND_EXPENSES_BILLING_PER_WEEK = '661_1';
    const TIME_AND_EXPENSES_BILLING_PER_PERIOD = '662_1';
    const TRANSACTION_SUMMARY = '670';
    const BANK_LINK_DETAILS = '680';
    const VAT_RETURN_STATUS = '690';
    const HIERARCHY_ACCESS = '700';
}
