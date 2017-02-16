<?php
/**
 * Transaction unserializer
 *
 * @link       http://pear.php.net/package/XML_Serializer/docs
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/XML/Articles
 */

namespace Pronamic\WP\Twinfield\XML\Transactions;

use Pronamic\WP\Twinfield\XML\Security;
use Pronamic\WP\Twinfield\XML\Unserializer;
use Pronamic\WP\Twinfield\XML\DateUnserializer;
use Pronamic\WP\Twinfield\Transactions\Transaction;
use Pronamic\WP\Twinfield\Transactions\TransactionHeader;
use Pronamic\WP\Twinfield\Transactions\TransactionLine;
use Pronamic\WP\Twinfield\Transactions\TransactionResponse;

/**
 * Transaction unserializer
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class TransactionUnserializer extends Unserializer {
	/**
	 * Constructs and initializes an sales invoice unserializer.
	 */
	public function __construct() {
		$this->date_unserializer = new DateUnserializer();
	}

	/**
	 * Unserialize the specified XML to an article.
	 *
	 * @param \SimpleXMLElement $element The XML element to unserialize.
	 */
	public function unserialize( \SimpleXMLElement $element ) {
		if ( 'transaction' === $element->getName() ) {
			$transaction = new Transaction();

			$header = $transaction->get_header();

			if ( $element->header ) {
				$header->set_office( Security::filter( $element->header->office ) );
				$header->set_code( Security::filter( $element->header->code ) );
				$header->set_number( Security::filter( $element->header->number ) );
			}

			if ( $element->lines ) {
				foreach ( $element->lines->line as $element_line ) {
					$line = $transaction->new_line();

					$line->set_id( Security::filter( $element_line['id'] ) );
				}
			}

			// Response.
			$result = Security::filter( $element['result'] );

			$response = new TransactionResponse( $transaction, $result, $element );

			return $response;
		}
	}
}