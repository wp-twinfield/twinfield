<?php
/**
 * Sales invoice response
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\SalesInvoices;

use Pronamic\WP\Twinfield\Response;

/**
 * Sales invoice response
 *
 * This class follows the Data Transfer Objects design pattern. This class represents an Twinfield sales invoice with some
 * additional information.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SalesInvoiceResponse extends Response {
	/**
	 * The sales invoice.
	 *
	 * @var SalesInvoice
	 */
	private $sales_invoice;

	/**
	 * Constructs and initialize an Twinfield article read request.
	 *
	 * @param SalesInvoice      $sales_invoice An sales invoice.
	 * @param int               $result        The number of results.
	 * @param \SimpleXMLElement $message       The XML message.
	 */
	public function __construct( SalesInvoice $sales_invoice, $result, \SimpleXMLElement $message ) {
		parent::__construct( $result, $message );

		$this->sales_invoice = $sales_invoice;
	}

	/**
	 * Get the sales invoice.
	 *
	 * @return string
	 */
	public function get_sales_invoice() {
		return $this->sales_invoice;
	}
}
