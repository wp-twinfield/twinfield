<?php
/**
 * Sales Invoice Service
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/SalesInvoices
 */

namespace Pronamic\WP\Twinfield\SalesInvoices;

use Pronamic\WP\Twinfield\ProcessXmlString;
use Pronamic\WP\Twinfield\XMLProcessor;
use Pronamic\WP\Twinfield\XML\SalesInvoices\SalesInvoiceReadRequestSerializer;
use Pronamic\WP\Twinfield\XML\SalesInvoices\SalesInvoiceUnserializer;

/**
 * Sales Invoice Service
 *
 * This class represents an Twinfield sales invoice service.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SalesInvoiceService {
	private $xml_processor;

	public function __construct( XMLProcessor $xml_processor ) {
		$this->xml_processor = $xml_processor;
	}

	public function get_sales_invoice( $office, $code, $number ) {
		$request = new SalesInvoiceReadRequestSerializer( new SalesInvoiceReadRequest( $office, $code, $number ) );

		$response = $this->xml_processor->process_xml_string( new ProcessXmlString( $request ) );

		$xml = simplexml_load_string( $response );

		$sales_invoice_unserializer = new SalesInvoiceUnserializer();
		$sales_invoice = $sales_invoice_unserializer->unserialize( $xml );
	}

	public function insert_sales_invoice( SalesInvoice $sales_invoice ) {

	}

	public function update_sales_invoice( SalesInvoice $sales_invoice ) {

	}
}
