<?php
/**
 * Budget service
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Budget;

use Pronamic\WP\Twinfield\AbstractService;
use Pronamic\WP\Twinfield\Client;

/**
 * Budget service
 *
 * This class connects to the Twinfield budget Webservices.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class BudgetService extends AbstractService {
	/**
	 * The Twinfield budget WSDL URL.
	 *
	 * @var string
	 */
	const WSDL_FILE = '/webservices/BudgetService.svc?wsdl';

	/**
	 * Constructs and initializes an finder object.
	 *
	 * @param Client $client Twinfield client object.
	 */
	public function __construct( Client $client ) {
		parent::__construct( self::WSDL_FILE, $client );
	}
}
