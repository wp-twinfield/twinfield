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
use Pronamic\WP\Twinfield\XML\SalesInvoices\SalesInvoiceSerializer;
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
	/**
	 * The XML processor wich is used to connect with Twinfield.
	 *
	 * @param XMLProcessor
	 */
	private $xml_processor;

	/**
	 * Constructs and initializes an sales invoice service.
	 *
	 * @param XMLProcessor $xml_processor
	 */
	public function __construct( XMLProcessor $xml_processor ) {
		$this->xml_processor = $xml_processor;
	}

	/**
	 * Get the specified sales invoice.
	 *
	 * @param string $office
	 * @param string $code
	 * @param string $number
	 * @return SalesInvoiceResponse
	 */
	public function get_sales_invoice( $office, $code, $number ) {
		$request = new SalesInvoiceReadRequestSerializer( new SalesInvoiceReadRequest( $office, $code, $number ) );

		$response = $this->xml_processor->process_xml_string( new ProcessXmlString( $request ) );

		$xml = simplexml_load_string( $response );

		$sales_invoice_unserializer = new SalesInvoiceUnserializer();
		$sales_invoice = $sales_invoice_unserializer->unserialize( $xml );

		return $sales_invoice;
	}

	/**
	 * Insert the specifiekd sales invoice.
	 *
	 * @param SalesInvoice $sales_invoice
	 * @return SalesInvoiceResponse
	 */
	public function insert_sales_invoice( SalesInvoice $sales_invoice ) {
		$xml = new SalesInvoiceSerializer( $sales_invoice );

		$response = $this->xml_processor->process_xml_string( new ProcessXmlString( $xml ) );

echo $response;
exit;
	}

	/**
	 * Update the specified sales invoice.
	 *
	 * This function is based on the WordPress `wp_update_post` function.
	 * https://github.com/WordPress/WordPress/blob/4.3/wp-includes/post.php#L3607-L3665
	 *
	 * @param SalesInvoice $sales_invoice The sales invoice to update.
	 * @return SalesInvoiceResponse
	 */
	public function update_sales_invoice( SalesInvoice $sales_invoice ) {
		$header = $sales_invoice->get_header();

		// @see https://github.com/WordPress/WordPress/blob/4.3/wp-includes/post.php#L3627-L3628
		$response = $this->get_sales_invoice( $header->get_office(), $header->get_code(), $heaer->get_number() );

		if ( 0 === $response->get_result() ) {
			return false;
		}
	}
}
