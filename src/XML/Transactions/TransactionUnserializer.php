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

use Pronamic\WP\Twinfield\Currency;
use Pronamic\WP\Twinfield\Offices\Office;
use Pronamic\WP\Twinfield\Transactions\Transaction;
use Pronamic\WP\Twinfield\Transactions\TransactionHeader;
use Pronamic\WP\Twinfield\Transactions\TransactionLine;
use Pronamic\WP\Twinfield\Transactions\TransactionLineDimension;
use Pronamic\WP\Twinfield\Transactions\TransactionResponse;
use Pronamic\WP\Twinfield\XML\Security;
use Pronamic\WP\Twinfield\XML\Unserializer;
use Pronamic\WP\Twinfield\XML\DateUnserializer;
use Pronamic\WP\Twinfield\XML\DateTimeUnserializer;

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
		$this->date_unserializer     = new DateUnserializer();
		$this->datetime_unserializer = new DateTimeUnserializer();
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
				// Office.
				$office = new Office();
				$office->set_code( Security::filter( $element->header->office ) );

				$header->set_office( $office );

				// Currency.
				$currency = new Currency();
				$currency->set_code( Security::filter( $element->header->currency ) );
				$currency->set_name( Security::filter( $element->header->currency['name'] ) );
				$currency->set_shortname( Security::filter( $element->header->currency['shortname'] ) );

				$header->set_currency( $currency );

				// Other.
				$header->set_code( Security::filter( $element->header->code ) );
				$header->set_number( Security::filter( $element->header->number ) );
				$header->set_date( $this->date_unserializer->unserialize( $element->header->date ) );

				// Input date.
				if ( $element->header->inputdate ) {
					$header->set_input_date( $this->datetime_unserializer->unserialize( $element->header->inputdate ) );
				}

				// Due date.
				if ( $element->header->duedate ) {
					$header->set_due_date( $this->date_unserializer->unserialize( $element->header->duedate ) );
				}

				// Modification date.
				if ( $element->header->modificationdate ) {
					$header->set_modification_date( $this->datetime_unserializer->unserialize( $element->header->modificationdate ) );
				}

				// Year/period.
				$year   = null;
				$period = null;

				$year_period = Security::filter( $element->header->period );

				$seperator_position = strpos( $year_period, '/' );

				if ( false !== $seperator_position ) {
					$year   = substr( $year_period, 0, $seperator_position );
					$period = substr( $year_period, $seperator_position + 1 );
				}

				$header->set_year( $year );
				$header->set_period( $period );

				// Invoice number.
				$header->set_invoice_number( Security::filter( $element->header->invoicenumber ) );				

				// Free texts.
				$header->set_free_text_1( Security::filter( $element->header->freetext1 ) );
				$header->set_free_text_2( Security::filter( $element->header->freetext2 ) );
				$header->set_free_text_3( Security::filter( $element->header->freetext3 ) );
			}

			if ( $element->lines ) {
				foreach ( $element->lines->line as $element_line ) {
					$line = $transaction->new_line();

					$line->set_id( Security::filter( $element_line['id'] ) );
					$line->set_type( Security::filter( $element_line['type'] ) );

					if ( $element_line->dim1 ) {
						$line->set_dimension_1( new TransactionLineDimension(
							Security::filter( $element_line->dim1 ),
							Security::filter( $element_line->dim1['name'] ),
							Security::filter( $element_line->dim1['dimensiontype'] )
						) );
					}

					if ( $element_line->dim2 ) {
						$line->set_dimension_2( new TransactionLineDimension(
							Security::filter( $element_line->dim2 ),
							Security::filter( $element_line->dim2['name'] ),
							Security::filter( $element_line->dim2['dimensiontype'] )
						) );
					}

					if ( $element_line->dim3 ) {
						$line->set_dimension_3( new TransactionLineDimension(
							Security::filter( $element_line->dim3 ),
							Security::filter( $element_line->dim3['name'] ),
							Security::filter( $element_line->dim3['dimensiontype'] )
						) );
					}

					$line->set_debit_credit( Security::filter( $element_line->debitcredit ) );
					$line->set_value( Security::filter( $element_line->value, FILTER_VALIDATE_FLOAT ) );
					$line->set_description( Security::filter( $element_line->description ) );

					if ( $element_line->invoicenumber ) {
						$line->set_invoice_number( Security::filter( $element_line->invoicenumber ) );
					}

					if ( $element_line->matchstatus ) {
						$line->set_match_status( Security::filter( $element_line->matchstatus ) );
					}
				}
			}

			// Response.
			$result = Security::filter( $element['result'] );

			$response = new TransactionResponse( $transaction, $result, $element );

			return $response;
		}
	}
}
