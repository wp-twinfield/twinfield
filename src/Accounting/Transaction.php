<?php
/**
 * Transaction
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Transactions
 */

namespace Pronamic\WP\Twinfield\Accounting;

use DOMDocument;

/**
 * Transaction
 *
 * This class represents a Twinfield transaction.
 *
 * @link https://accounting.twinfield.com/webservices/documentation/#/ApiReference/Transactions/BankTransactions
 * @link https://accounting.twinfield.com/webservices/documentation/#/ApiReference/Transactions/CashTransactions
 * @link https://accounting.twinfield.com/webservices/documentation/#/ApiReference/Transactions/JournalTransactions
 * @link https://accounting.twinfield.com/webservices/documentation/#/ApiReference/PurchaseTransactions
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class Transaction {
	private $transaction_type;

	private $lines;

	public function __construct( $transaction_type ) {
		$this->transaction_type = $transaction_type;

		$this->lines = array();
	}

	public function new_line() {
        $line = new TransactionLine( $this );

        $this->lines[] = $line;

        return $line;		
	}

	public function to_xml() {
		$document = new DOMDocument();

		$document->preserveWhiteSpace = false;
		$document->formatOutput       = true;

		$e_transaction = $document->appendChild( $document->createElement( 'transaction' ) );

		$e_header = $e_transaction->appendChild( $document->createElement( 'header' ) );

		$e_header->appendChild( $document->createElement( 'office', $this->transaction_type->get_office()->get_code() ) );
		$e_header->appendChild( $document->createElement( 'code', $this->transaction_type->get_code() ) );

		$e_lines = $e_transaction->appendChild( $document->createElement( 'lines' ) );

		foreach ( $this->lines as $line ) {
			$e_line = $e_lines->appendChild( $document->createElement( 'line' ) );

			$type = $line->get_type();

			if ( null !== $type ) {
				$e_line->setAttribute( 'type', $type );
			}

			$id = $line->get_id();

			if ( null !== $id ) {
				$e_line->setAttribute( 'id', $id );
			}

			$dimensions = array(
				'dim1' => $line->get_dimension_1(),
				'dim2' => $line->get_dimension_2(),
				'dim3' => $line->get_dimension_3(),
			);

			foreach ( $dimensions as $name => $dimension ) {
				if ( null !== $dimension ) {
					$e_line->appendChild( $document->createElement( $name, $dimension->get_code() ) );
				}
			}

			$debit_credit = $line->get_debit_credit();

			if ( null !== $debit_credit ) {
				$e_line->appendChild( $document->createElement( 'debitcredit', $debit_credit ) );
			}

			$value = $line->get_value();

			if ( null !== $value ) {
				$e_line->appendChild( $document->createElement( 'value', $value ) );
			}

			$invoice_number = $line->get_invoice_number();

			if ( null !== $invoice_number ) {
				$e_line->appendChild( $document->createElement( 'invoicenumber', $invoice_number ) );
			}

			$description = $line->get_description();

			if ( null !== $description ) {
				$e_line->appendChild( $document->createElement( 'description', $description ) );
			}
		}

		return $document->saveXML();
	}
}
