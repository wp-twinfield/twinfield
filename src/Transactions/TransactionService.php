<?php
/**
 * Transaction Service
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Transactions
 */

namespace Pronamic\WP\Twinfield\Transactions;

use Pronamic\WP\Twinfield\ProcessXmlString;
use Pronamic\WP\Twinfield\XMLProcessor;
use \Pronamic\WP\Twinfield\Browse\Browser;
use \Pronamic\WP\Twinfield\Browse\BrowseReadRequest;
use Pronamic\WP\Twinfield\XML\Transactions\TransactionReadRequestSerializer;
use Pronamic\WP\Twinfield\XML\Transactions\TransactionUnserializer;

/**
 * Transaction Service
 *
 * This class represents an Twinfield transactions service.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class TransactionService {
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
		$this->browser       = new Browser( $xml_processor );
	}

	/**
	 * Get browse definiation.
	 *
	 * @param string $office_code
	 * @param string $browse_code
	 * @return BrowseDefinition
	 */
	public function get_browse_definition( $office_code, $browse_code ) {
		$browse_read_request = new BrowseReadRequest( $office_code, $browse_code );

		$browse_definition = $this->browser->get_browse_definition( $browse_read_request );

		return $browse_definition;
	}

	/**
	 * Get lines.
	 *
	 * @return array
	 */
	public function get_transaction_lines( $browse_definition ) {
		$lines = array();

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

			$input_date = \DateTime::createFromFormat( 'YmdHis', $row->get_field( 'fin.trs.head.inpdate' ) );

			if ( false !== $input_date ) {
				$line->set_input_date( $input_date );
			}

			$line->set_key( $key );
			$line->set_id( $key->get_line() );
			$line->set_status( $row->get_field( 'fin.trs.head.status' ) );

			// Year/period
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

			$line->set_year( $year );
			$line->set_period( $period );

			$line->set_dimension_1( new TransactionLineDimension( $row->get_field( 'fin.trs.line.dim1' ), $row->get_field( 'fin.trs.line.dim1name' ), $row->get_field( 'fin.trs.line.dim1type' ) ) );
			$line->set_dimension_2( new TransactionLineDimension( $row->get_field( 'fin.trs.line.dim2' ), $row->get_field( 'fin.trs.line.dim2name' ), $row->get_field( 'fin.trs.line.dim2type' ) ) );
			$line->set_value( filter_var( $row->get_field( 'fin.trs.line.valuesigned' ), FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE ) );
			$line->set_base_value( filter_var( $row->get_field( 'fin.trs.line.basevaluesigned' ), FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE ) );
			$line->set_open_base_value( filter_var( $row->get_field( 'fin.trs.line.openbasevaluesigned' ), FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE ) );
			$line->set_debit_credit( $row->get_field( 'fin.trs.line.debitcredit' ) );
			$line->set_description( $row->get_field( 'fin.trs.line.description' ) );
			$line->set_invoice_number( $row->get_field( 'fin.trs.line.invnumber' ) );

			$lines[] = $line;
		}

		return $lines;
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
