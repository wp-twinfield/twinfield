<?php
/**
 * Transactions Service
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Transactions
 */

namespace Pronamic\WP\Twinfield\Transactions;

use Pronamic\WP\Twinfield\ProcessXmlString;
use Pronamic\WP\Twinfield\XMLProcessor;
use Pronamic\WP\Twinfield\XML\Transactions\TransactionReadRequestSerializer;
use Pronamic\WP\Twinfield\XML\Transactions\TransactionUnserializer;

/**
 * Transactions Service
 *
 * This class represents an Twinfield transactions service.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class TransactionsService {
	/**
	 * The XML processor wich is used to connect with Twinfield.
	 *
	 * @var XMLProcessor
	 */
	private $xml_processor;

	/**
	 * Constructs and initializes an sales invoice service.
	 *
	 * @param XMLProcessor $xml_processor The XML processor to use within this sales invoice service object.
	 */
	public function __construct( XMLProcessor $xml_processor ) {
		$this->xml_processor = $xml_processor;
	}

	/**
	 * Get the specified transaction.
	 *
	 * @param string $office The office to get the transaction from.
	 * @param string $code   The code of the transaction to retrieve.
	 * @param string $number The number of the transaction to retrieve.
	 * @return Transaction
	 */
	public function get_transaction( $office, $code, $number ) {
		$result = null;

		$request = new TransactionReadRequestSerializer( new TransactionReadRequest( $office, $code, $number ) );

		$response = $this->xml_processor->process_xml_string( new ProcessXmlString( $request ) );

		$xml = simplexml_load_string( $response );

		if ( false !== $xml ) {
			$unserializer = new TransactionUnserializer();

			$result = $unserializer->unserialize( $xml );
		}

		return $result;
	}
}
