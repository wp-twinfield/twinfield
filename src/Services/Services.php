<?php
/**
 * Services
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Services;

/**
 * Services
 *
 * This class contains constants for different Twinfield services.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 * @see        https://accounting.twinfield.com/webservices/documentation/#/GettingStarted/WebServicesOverview
 */
class Services {
	/**
	 * Session.
	 *
	 * @var string
	 */
	const SESSION = '/webservices/session.asmx?wsdl';

	/**
	 * Bank books.
	 *
	 * @var string
	 */
	const BANK_BOOKS = '/webservices/bankbookservice.svc?wsdl';

	/**
	 * Bank statements.
	 *
	 * @var string
	 */
	const BANK_STATEMENTS = '/webservices/bankstatementservice.svc?wsdl';

	/**
	 * Budgets.
	 *
	 * @var string
	 */
	const BUDGETS = '/webservices/budgetservice.svc?wsdl';

	/**
	 * Cash books.
	 *
	 * @var string
	 */
	const CASH_BOOKS = '/webservices/cashbookservice.svc?wsdl';

	/**
	 * Declarations.
	 *
	 * @var string
	 */
	const DECLARATIONS = '/webservices/declarations.asmx?wsdl';

	/**
	 * Documents.
	 *
	 * @var string
	 */
	const DOCUMENTS = '/webservices/documentservice.svc?wsdl';

	/**
	 * Finder.
	 *
	 * @var string
	 */
	const FINDER = '/webservices/finder.asmx?wsdl';

	/**
	 * Hierarchies.
	 *
	 * @var string
	 */
	const HIERARCHIES = '/webservices/hierarchies.asmx?wsdl';

	/**
	 * Matching.
	 *
	 * @var string
	 */
	const MATCHING = '	/webservices/matching.asmx?wsdl';

	/**
	 * Pay and collect.
	 *
	 * @var string
	 */
	const PAY_AND_COLLECT = '/webservices/payandcollect.asmx?wsdl';

	/**
	 * Pay type.
	 *
	 * @var string
	 */
	const PAY_TYPE = '/webservices/paytype.asmx?wsdl';

	/**
	 * Periods
	 *
	 * @var string
	 */
	const PERIODS = '/webservices/periodservice.svc?wsdl';

	/**
	 * ProcessXml.
	 *
	 * @var string
	 */
	const PROCESS_XML = '/webservices/processxml.asmx?wsdl';

	/**
	 * XBRL.
	 *
	 * @var string
	 */
	const XBRL = '/webservices/sbr.asmx?wsdl';

	/**
	 * Versions.
	 *
	 * @var string
	 */
	const VERSIONS = '/webservices/versions.asmx?wsdl';

	/**
	 * Deleted transactions.
	 *
	 * @var string
	 */
	const DELETED_TRANSACTIONS = '/webservices/deletedtransactionsservice.svc?wsdl';

	/**
	 * Blocked value.
	 *
	 * @var string
	 */
	const BLOCKED_VALUE = '/webservices/transactionblockedvalueservice.svc?wsdl';
}
