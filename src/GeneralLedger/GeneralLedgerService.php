<?php
/**
 * General ledger service
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/SalesInvoices
 */

namespace Pronamic\WP\Twinfield\GeneralLedger;

use Pronamic\WP\Twinfield\Browse\Browser;
use Pronamic\WP\Twinfield\Browse\BrowseCodes;
use Pronamic\WP\Twinfield\Browse\BrowseReadRequest;

use Pronamic\WP\Twinfield\Transactions\TransactionLine;
use Pronamic\WP\Twinfield\Transactions\TransactionLineKey;

/**
 * Office Service
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class GeneralLedgerService {
	/**
	 * The browser wich is used to connect with Twinfield.
	 *
	 * @var Browser
	 */
	private $browser;

	/**
	 * Constructs and initializes an sales invoice service.
	 *
	 * @param Browser $browser The browser.
	 */
	public function __construct( Browser $browser ) {
		$this->browser = $browser;
	}

	/**
	 * Get lines.
	 *
	 * @param string $office_code    The office code.
	 * @param string $general_ledger The general ledger.
	 * @param int    $year           The year.
	 * @return array
	 */
	public function get_transaction_lines( $office_code, $general_ledger, $year ) {
		$lines = array();

		$browse_read_request = new BrowseReadRequest( $office_code, BrowseCodes::GENERAL_LEDGER_DETAILS_V2 );

		$browse_definition = $this->browser->get_browse_definition( $browse_read_request );
		$browse_definition->get_column( 'fin.trs.head.yearperiod' )->between( $year . '/01', $year . '/12' );

		$browse_definition->get_column( 'fin.trs.line.dim1' )->between( $general_ledger );
		$browse_definition->get_column( 'fin.trs.line.matchstatus' )->equal( 'available' );

		$data = $this->browser->get_data( $browse_definition );

		$rows = $data->get_rows();

		foreach ( $rows as $row ) {
			$line = new TransactionLine();

			$xml_key = $row->get_xml_key();

			$key = new TransactionLineKey(
				(string) $xml_key->office,
				(string) $xml_key->code,
				(string) $xml_key->number,
				(string) $xml_key->line
			);

			$line->set_date( \DateTime::createFromFormat( 'Ymd', $row->get_field( 'fin.trs.head.date' ) ) );
			$line->set_input_date( \DateTime::createFromFormat( 'YmdHis', $row->get_field( 'fin.trs.head.inpdate' ) ) );

			$line->set_key( $key );
			$line->set_id( $key->get_line() );
			$line->set_dimension_1( $row->get_field( 'fin.trs.line.dim1' ) );
			$line->set_dimension_2( $row->get_field( 'fin.trs.line.dim2' ) );
			$line->set_value( $row->get_field( 'fin.trs.line.valuesigned' ) );
			$line->set_debit_credit( $row->get_field( 'fin.trs.line.debitcredit' ) );
			$line->set_description( $row->get_field( 'fin.trs.line.description' ) );
			$line->set_invoice_number( $row->get_field( 'fin.trs.line.invnumber' ) );

			$lines[] = $line;
		}

		return $lines;
	}
}
