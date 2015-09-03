<?php
/**
 * Customer Service
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/SalesInvoices
 */

namespace Pronamic\WP\Twinfield\Customers;

use Pronamic\WP\Twinfield\ProcessXmlString;
use Pronamic\WP\Twinfield\XMLProcessor;
use Pronamic\WP\Twinfield\XML\Customers\CustomerReadRequestSerializer;
use Pronamic\WP\Twinfield\XML\Customers\CustomerSerializer;
use Pronamic\WP\Twinfield\XML\Customers\CustomerUnserializer;

/**
 * Customer Service
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class CustomerService {
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
	 * Get the specified customer.
	 *
	 * @param string $office
	 * @param string $code
	 * @return Customer
	 */
	public function get_customer( $office, $code ) {
		$request = new CustomerReadRequestSerializer( new CustomerReadRequest( $office, $code ) );

		$response = $this->xml_processor->process_xml_string( new ProcessXmlString( $request ) );

		$xml = simplexml_load_string( $response );

		$unserializer = new CustomerUnserializer();

		$object = $unserializer->unserialize( $xml );
var_dump( $object );
		return $object;
	}

	/**
	 * Insert the specified customer.
	 *
	 * @param Customer $customer
	 * @return Customer
	 */
	public function insert_customer( Customer $customer ) {
		$xml = new CustomerSerializer( $customer );

		$response = $this->xml_processor->process_xml_string( new ProcessXmlString( $xml ) );

		
	}

	/**
	 * Update the specified customer.
	 *
	 * This function is based on the WordPress `wp_update_post` function.
	 * https://github.com/WordPress/WordPress/blob/4.3/wp-includes/post.php#L3607-L3665
	 *
	 * @param Customer $customer The customer to update.
	 * @return 
	 */
	public function update_customer( Customer $customer ) {
		// @see https://github.com/WordPress/WordPress/blob/4.3/wp-includes/post.php#L3627-L3628
		$original = $this->get_customer( $customer->get_office(), $customer->get_code() );

		if ( null === $original ) {
			return false;
		}
	}
}
