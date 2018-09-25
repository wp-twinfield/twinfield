<?php
/**
 * Browse transactions unserializer
 *
 * @link       http://pear.php.net/package/XML_Serializer/docs
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/XML/Articles
 */

namespace Pronamic\WP\Twinfield\XML\Transactions;

use Pronamic\WP\Twinfield\Currency;
use Pronamic\WP\Twinfield\Browse\Row;
use Pronamic\WP\Twinfield\Offices\Office;
use Pronamic\WP\Twinfield\Relations\Relation;
use Pronamic\WP\Twinfield\Transactions\Transaction;
use Pronamic\WP\Twinfield\Transactions\TransactionHeader;
use Pronamic\WP\Twinfield\Transactions\TransactionLine;
use Pronamic\WP\Twinfield\Transactions\TransactionLineDimension;
use Pronamic\WP\Twinfield\Transactions\TransactionLineKey;
use Pronamic\WP\Twinfield\Transactions\TransactionResponse;
use Pronamic\WP\Twinfield\XML\Security;
use Pronamic\WP\Twinfield\XML\Unserializer;
use Pronamic\WP\Twinfield\XML\DateUnserializer;

/**
 * Browse transactions unserializer
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class BrowseTransactionsUnserializer extends Unserializer {
	/**
	 * Constructs and initializes a browse transaction unserializer.
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
		if ( 'browse' !== $element->getName() ) {
			return;
		}

		$transactions = array();

		$lines = array();

		if ( $element->tr ) {
			foreach ( $element->tr as $tr ) {
				$row = new Row( $tr );

				$xml_key = $row->get_xml_key();

				$transaction_key = implode(
					'-',
					array(
						(string) $xml_key->office,
						(string) $xml_key->code,
						(string) $xml_key->number,
					)
				);

				if ( ! isset( $transactions[ $transaction_key ] ) ) {
					// Transaction.
					$transaction = new Transaction();

					$transactions[ $transaction_key ] = $transaction;

					// Header.
					$header = $transaction->get_header();

					// Office.
					$office = new Office();
					$office->set_code( $row->get_field( 'fin.trs.head.office' ) );
					$office->set_name( $row->get_field( 'fin.trs.head.officename' ) );

					$header->set_office( $office );

					// Relation.
					$relation = new Relation();
					$relation->set_code( $row->get_field( 'fin.trs.head.relation' ) );
					$relation->set_name( $row->get_field( 'fin.trs.head.relationname' ) );

					$header->set_relation( $relation );

					// Currency.
					$currency = new Currency();
					$currency->set_code( $row->get_field( 'fin.trs.head.curcode' ) );

					// Other.
					$header->set_code( $row->get_field( 'fin.trs.head.code' ) );
					$header->set_number( $row->get_field( 'fin.trs.head.number' ) );
					$header->set_status( $row->get_field( 'fin.trs.head.status' ) );
					$header->set_date( \DateTime::createFromFormat( 'Ymd', $row->get_field( 'fin.trs.head.date' ) ) );
					$header->set_currency( $currency );

					$input_date = \DateTime::createFromFormat( 'YmdHis', $row->get_field( 'fin.trs.head.inpdate' ) );

					if ( false !== $input_date ) {
						$header->set_input_date( $input_date );
					}

					$header->set_username( $row->get_field( 'fin.trs.head.username' ) );

					// Year/period.
					$year   = null;
					$period = null;

					if ( $row->has_field( 'fin.trs.head.yearperiod' ) ) {
						$year_period = $row->get_field( 'fin.trs.head.yearperiod' );

						$seperator_position = strpos( $year_period, '/' );

						if ( false !== $seperator_position ) {
							$year   = substr( $year_period, 0, $seperator_position );
							$period = substr( $year_period, $seperator_position + 1 );
						}
					}

					if ( $row->has_field( 'fin.trs.head.year' ) ) {
						$year = $row->get_field( 'fin.trs.head.year' );
					}

					if ( $row->has_field( 'fin.trs.head.period' ) ) {
						$period = $row->get_field( 'fin.trs.head.period' );
					}

					$header->set_year( $year );
					$header->set_period( $period );

					$header->set_origin( $row->get_field( 'fin.trs.head.origin' ) );
				}

				$transaction = $transactions[ $transaction_key ];

				$line = $transaction->new_line();

				$lines[] = $line;

				$key = new TransactionLineKey(
					(string) $xml_key->office,
					(string) $xml_key->code,
					(string) $xml_key->number,
					(string) $xml_key->line
				);

				$line->set_key( $key );
				$line->set_id( $key->get_line() );

				$line->set_dimension_1( new TransactionLineDimension( $row->get_field( 'fin.trs.line.dim1' ), $row->get_field( 'fin.trs.line.dim1name' ), $row->get_field( 'fin.trs.line.dim1type' ) ) );
				$line->set_dimension_2( new TransactionLineDimension( $row->get_field( 'fin.trs.line.dim2' ), $row->get_field( 'fin.trs.line.dim2name' ), $row->get_field( 'fin.trs.line.dim2type' ) ) );
				$line->set_dimension_3( new TransactionLineDimension( $row->get_field( 'fin.trs.line.dim3' ), $row->get_field( 'fin.trs.line.dim3name' ), $row->get_field( 'fin.trs.line.dim3type' ) ) );
				$line->set_value( filter_var( $row->get_field( 'fin.trs.line.valuesigned' ), FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE ) );
				$line->set_base_value( filter_var( $row->get_field( 'fin.trs.line.basevaluesigned' ), FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE ) );
				$line->set_open_base_value( filter_var( $row->get_field( 'fin.trs.line.openbasevaluesigned' ), FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE ) );
				$line->set_report_value( filter_var( $row->get_field( 'fin.trs.line.repvaluesigned' ), FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE ) );
				$line->set_debit_credit( $row->get_field( 'fin.trs.line.debitcredit' ) );
				$line->set_vat_code( $row->get_field( 'fin.trs.line.vatcode' ) );
				$line->set_vat_base_value( $row->get_field( 'fin.trs.line.vatbasevaluesigned' ) );
				$line->set_quantity( $row->get_field( 'fin.trs.line.quantity' ) );
				$line->set_cheque_number( $row->get_field( 'fin.trs.line.chequenumber' ) );
				$line->set_description( $row->get_field( 'fin.trs.line.description' ) );
				$line->set_invoice_number( $row->get_field( 'fin.trs.line.invnumber' ) );
				$line->set_free_text_1( $row->get_field( 'fin.trs.line.freetext1' ) );
				$line->set_free_text_2( $row->get_field( 'fin.trs.line.freetext2' ) );
				$line->set_free_text_3( $row->get_field( 'fin.trs.line.freetext3' ) );
			}
		}

		return $lines;
	}
}
