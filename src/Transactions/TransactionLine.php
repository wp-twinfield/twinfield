<?php
/**
 * Transaction Line
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Transactions
 */

namespace Pronamic\WP\Twinfield\Transactions;

use Pronamic\WP\Twinfield\Offices\Office;
use Pronamic\WP\Twinfield\Relations\Relation;

/**
 * Transaction Line
 *
 * This class represents a Twinfield transaction line.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class TransactionLine {
	/**
	 * Debit.
	 */
	const DEBIT = 'debit';

	/**
	 * Credit.
	 */
	const CREDIT = 'credit';

	/**
	 * The transaction this line is part of.
	 *
	 * @var Transaction
	 */
	private $transaction;

	/**
	 * Type.
	 *
	 * @var string|null
	 */
	private $type;

	/**
	 * The unique key of this transaction line.
	 *
	 * @var TransactionLineKey
	 */
	private $key;

	/**
	 * The debit/credit indicator of this transaction line.
	 *
	 * @var string
	 */
	private $debit_credit;

	/**
	 * Value
	 *
	 * If line type = total amount including VAT.
	 * If line type = detail amount without VAT.
	 * If line type = vat VAT amount.
	 *
	 * @twinfield-xml <value>
	 * @var float (unsigned)
	 */
	private $value;

	/**
	 * Value signed.
	 *
	 * @twinfield-xml <td field="fin.trs.line.valuesigned">
	 * @var float (signed)
	 */
	private $value_signed;

	/**
	 * Base value.
	 *
	 * Amount in the base currency.
	 *
	 * @twinfield-xml <basevalue>
	 * @var float (unsigned)
	 */
	private $base_value;

	/**
	 * Base value signed.
	 *
	 * @twinfield-xml <td field="fin.trs.line.valuesigned">
	 * @var flaot (signed)
	 */
	private $base_value_signed;

	/**
	 * Reporting value.
	 *
	 * Amount in the reporting currency.
	 *
	 * @twinfield-xml <repvalue>
	 * @var float (unsigned)
	 */
	private $reporting_value;

	/**
	 * Reporting value signed.
	 *
	 * @twinfield-xml <td field="fin.trs.line.repvaluesigned">
	 * @var float (unsigned)
	 */
	private $reporting_value_signed;

	/**
	 * Open base value.
	 *
	 * @twinfield-xml <openbasevalue>
	 * @var float (unsigned)
	 */
	private $open_base_value;

	/**
	 * Open base value signed.
	 *
	 * @twinfield-xml <td field="fin.trs.line.openbasevaluesigned">
	 * @var float (unsigned)
	 */
	private $open_base_value_signed;

	/**
	 * Input date.
	 *
	 * @var \DateTimeInterface
	 */
	private $input_date;

	/**
	 * Year.
	 *
	 * @var string
	 */
	private $year;

	/**
	 * Period.
	 *
	 * @var string
	 */
	private $period;

	/**
	 * Match status.
	 *
	 * @var string|null
	 */
	private $match_status;

	/**
	 * Match level.
	 *
	 * Only if line type is `detail`. The level of the matchable dimension.
	 *
	 * @var int|null
	 */
	private $match_level;

	/**
	 * Match date.
	 *
	 * @var \DateTimeInterface|null
	 */
	private $match_date;

	/**
	 * Match number.
	 *
	 * @var string
	 */
	private $match_number;

	/**
	 * VAT total.
	 *
	 * @var string|null
	 */
	private $vat_total;

	/**
	 * VAT base total.
	 *
	 * @var string|null
	 */
	private $vat_base_total;

	/**
	 * VAT base value signed.
	 *
	 * @twinfield-xml <td field="fin.trs.line.vatbasevaluesigned">
	 * @var string|null
	 */
	private $vat_base_value_signed;

	/**
	 * Comment.
	 *
	 * Comment set on the transaction line.
	 *
	 * @var string|null
	 */
	private $comment;

	/**
	 * Constructs and initialize a Twinfield transaction line.
	 *
	 * @param Transaction $transaction Transaction.
	 */
	public function __construct( Transaction $transaction ) {
		$this->transaction = $transaction;
	}

	/**
	 * Invert credit sign.
	 *
	 * @param string $value
	 * @return string|null
	 */
	private function invert_credit_sign( $value ) {
		if ( null === $this->debit_credit ) {
			return null;
		}

		if ( 'credit' === $this->debit_credit ) {
			return -$value;
		}

		return $value;
	}

	/**
	 * Get the transaction this line is part of.
	 *
	 * @return Transaction
	 */
	public function get_transaction() {
		return $this->transaction;
	}

	/**
	 * Get the unique ID of this transaction line.
	 *
	 * @return string
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Set the unique ID of this transaction line.
	 *
	 * @param string $id The ID.
	 */
	public function set_id( $id ) {
		$this->id = $id;
	}

	/**
	 * Get the unique key of this transaction line.
	 *
	 * @return string The key.
	 */
	public function get_key() {
		return $this->key;
	}

	/**
	 * Set the unique key of this transaction line.
	 *
	 * @param string $key The key.
	 */
	public function set_key( $key ) {
		$this->key = $key;
	}

	/**
	 * Get code.
	 *
	 * @return string
	 */
	public function get_code() {
		return $this->code;
	}

	/**
	 * Set code.
	 *
	 * @param string $code Code.
	 */
	public function set_code( $code ) {
		$this->code = $code;
	}

	/**
	 * Get number.
	 *
	 * @return string
	 */
	public function get_number() {
		return $this->number;
	}

	/**
	 * Set number.
	 *
	 * @param string $number Number.
	 */
	public function set_number( $number ) {
		$this->number = $number;
	}

	/**
	 * Get the type of this transaction line.
	 *
	 * @return string|null
	 */
	public function get_type() {
		return $this->type;
	}

	/**
	 * Set the type of this transaction line.
	 *
	 * @param string|null $type The type.
	 */
	public function set_type( $type ) {
		$this->type = $type;
	}

	/**
	 * Get dimension 1 of this transaction line.
	 *
	 * @return string
	 */
	public function get_dimension_1() {
		return $this->dimension_1;
	}

	/**
	 * Set dimension 1 of this transaction line.
	 *
	 * @param TransactionLineDimension $dimension The dimension.
	 */
	public function set_dimension_1( TransactionLineDimension $dimension ) {
		$this->dimension_1 = $dimension;
	}

	/**
	 * Get dimension 2 of this transaction line.
	 *
	 * @return string
	 */
	public function get_dimension_2() {
		return $this->dimension_2;
	}

	/**
	 * Set dimension 2 of this transaction line.
	 *
	 * @param TransactionLineDimension $dimension The dimension.
	 */
	public function set_dimension_2( TransactionLineDimension $dimension ) {
		$this->dimension_2 = $dimension;
	}

	/**
	 * Get dimension 3 of this transaction line.
	 *
	 * @return string
	 */
	public function get_dimension_3() {
		return $this->dimension_3;
	}

	/**
	 * Set dimension 3 of this transaction line.
	 *
	 * @param TransactionLineDimension $dimension The dimension.
	 */
	public function set_dimension_3( TransactionLineDimension $dimension ) {
		$this->dimension_3 = $dimension;
	}

	/**
	 * Get the value of this transaction line.
	 *
	 * @return string
	 */
	public function get_value() {
		return $this->value;
	}

	/**
	 * Set the value of this transaction line.
	 *
	 * @param string $value The value.
	 */
	public function set_value( $value ) {
		$this->value        = $value;
		$this->value_signed = $this->invert_credit_sign( $value );
	}

	/**
	 * Get the signed value of this transaction line.
	 *
	 * @return string
	 */
	public function get_value_signed() {
		return $this->value_signed;
	}

	/**
	 * Set the signed value of this transaction line.
	 *
	 * @param string $value The value.
	 */
	public function set_value_signed( $value ) {
		$this->value_signed = $value;
		$this->value        = $this->invert_credit_sign( $value );
	}

	/**
	 * Get the base value of this transaction line.
	 *
	 * @return string
	 */
	public function get_base_value() {
		return $this->base_value;
	}

	/**
	 * Set the base value of this transaction line.
	 *
	 * @param string $value The base value.
	 */
	public function set_base_value( $value ) {
		$this->base_value        = $value;
		$this->base_value_signed = $this->invert_credit_sign( $value );
	}

	/**
	 * Get the signed base value of this transaction line.
	 *
	 * @return string
	 */
	public function get_base_value_signed() {
		return $this->base_value_signed;
	}

	/**
	 * Set the signed base value of this transaction line.
	 *
	 * @param string $value The base value.
	 */
	public function set_base_value_signed( $value ) {
		$this->base_value_signed = $value;
		$this->base_value        = $this->invert_credit_sign( $value );
	}

	/**
	 * Get the open base value of this transaction line.
	 *
	 * @return string
	 */
	public function get_open_base_value() {
		return $this->open_base_value;
	}

	/**
	 * Set the open base value of this transaction line.
	 *
	 * @param string $value The value.
	 */
	public function set_open_base_value( $value ) {
		$this->open_base_value = $value;
	}

	/**
	 * Get the signed open base value of this transaction line.
	 *
	 * @return string
	 */
	public function get_open_base_value_signed() {
		return $this->open_base_value_signed;
	}

	/**
	 * Set the signed  open base value of this transaction line.
	 *
	 * @param string $value The value.
	 */
	public function set_open_base_value_signed( $value ) {
		$this->open_base_value_signed = $value;
	}

	/**
	 * Get report value.
	 *
	 * @return string
	 */
	public function get_report_value() {
		return $this->report_value;
	}

	/**
	 * Set report value.
	 *
	 * @param string $value The value.
	 */
	public function set_report_value( $value ) {
		$this->report_value = $value;
	}

	/**
	 * Get signed reporting value.
	 *
	 * @return string
	 */
	public function get_reporting_value_signed() {
		return $this->reporting_value_signed;
	}

	/**
	 * Set signed reporting value.
	 *
	 * @param string $value The value.
	 */
	public function set_reporting_value_signed( $value ) {
		$this->reporting_value_signed = $value;
	}

	/**
	 * Get the description of this transaction line.
	 *
	 * @return string
	 */
	public function get_description() {
		return $this->description;
	}

	/**
	 * Set the description of this transaction line.
	 *
	 * @param string $description The description.
	 */
	public function set_description( $description ) {
		$this->description = $description;
	}

	/**
	 * Get the invoice number of this transaction line.
	 *
	 * @return string
	 */
	public function get_invoice_number() {
		return $this->invoice_number;
	}

	/**
	 * Set the invoice number of this transaction line.
	 *
	 * @param string $invoice_number The invoice number.
	 */
	public function set_invoice_number( $invoice_number ) {
		$this->invoice_number = $invoice_number;
	}

	/**
	 * Get the due date of this transaction line.
	 *
	 * @return string
	 */
	public function get_due_date() {
		return $this->due_date;
	}

	/**
	 * Set the due date of this transaction line.
	 *
	 * @param string $due_date The due date.
	 */
	public function set_due_date( $due_date ) {
		$this->due_date = $due_date;
	}

	/**
	 * Get free text 1.
	 *
	 * @return string
	 */
	public function get_free_text_1() {
		return $this->free_text_1;
	}

	/**
	 * Set free text 1.
	 *
	 * @param string $text Text.
	 */
	public function set_free_text_1( $text ) {
		$this->free_text_1 = $text;
	}

	/**
	 * Get free text 2.
	 *
	 * @return string
	 */
	public function get_free_text_2() {
		return $this->free_text_2;
	}

	/**
	 * Set free text 2.
	 *
	 * @param string $text Text.
	 */
	public function set_free_text_2( $text ) {
		$this->free_text_2 = $text;
	}

	/**
	 * Get free text 3.
	 *
	 * @return string
	 */
	public function get_free_text_3() {
		return $this->free_text_3;
	}

	/**
	 * Set free text 2.
	 *
	 * @param string $text Text.
	 */
	public function set_free_text_3( $text ) {
		$this->free_text_3 = $text;
	}

	/**
	 * Get debit credit.
	 *
	 * @return string
	 */
	public function get_debit_credit() {
		return $this->debit_credit;
	}

	/**
	 * Set vat code.
	 *
	 * @param VatCode|null $vat_code Vat code.
	 */
	public function set_vat_code( $vat_code ) {
		$this->vat_code = $vat_code;
	}

	/**
	 * Get vat code.
	 *
	 * @return VatCode|null
	 */
	public function get_vat_code() {
		return $this->vat_code;
	}

	/**
	 * Set vat base value.
	 *
	 * @param string $value Vat base value.
	 */
	public function set_vat_base_value( $value ) {
		$this->vat_base_value        = $value;
		$this->vat_base_value_signed = $this->invert_credit_sign( $value );
	}

	/**
	 * Get vat base value.
	 *
	 * @return string
	 */
	public function get_vat_base_value() {
		return $this->vat_base_value;
	}

	/**
	 * Set signed VAT base value.
	 *
	 * @param string $value VAT base value.
	 */
	public function set_vat_base_value_signed( $value ) {
		$this->vat_base_value_signed = $value;
		$this->vat_base_value        = $this->invert_credit_sign( $value );
	}

	/**
	 * Get signed VAT base value.
	 *
	 * @return string
	 */
	public function get_vat_base_value_signed() {
		return $this->vat_base_value_signed;
	}

	/**
	 * Set quantity.
	 *
	 * @param int $quantity Quantity.
	 */
	public function set_quantity( $quantity ) {
		$this->quantity = $quantity;
	}

	/**
	 * Get quantity.
	 *
	 * @return int
	 */
	public function get_quantity() {
		return $this->quantity;
	}

	/**
	 * Set cheque number.
	 *
	 * @param string $cheque_number Cheque number.
	 */
	public function set_cheque_number( $cheque_number ) {
		$this->cheque_number = $cheque_number;
	}

	/**
	 * Get cheque number.
	 *
	 * @return string
	 */
	public function get_cheque_number() {
		return $this->cheque_number;
	}

	/**
	 * Set debit credit.
	 *
	 * @param string $debit_credit The debit/credit value.
	 */
	public function set_debit_credit( $debit_credit ) {
		$this->debit_credit = $debit_credit;
	}

	/**
	 * Is debit.
	 *
	 * @return boolean true if is debit, false otherwise.
	 */
	public function is_debit() {
		return self::DEBIT === $this->get_debit_credit();
	}

	/**
	 * Is credit.
	 *
	 * @return boolean true if is credit, false otherwise.
	 */
	public function is_credit() {
		return self::CREDIT === $this->get_debit_credit();
	}

	/**
	 * Set match status.
	 *
	 * @param string|null $match_status Match status.
	 */
	public function set_match_status( $match_status ) {
		$this->match_status = $match_status;
	}

	/**
	 * Get match status.
	 *
	 * @return string|null
	 */
	public function get_match_status() {
		return $this->match_status;
	}

	/**
	 * Set match level.
	 *
	 * @param int|null $match_level Match level.
	 */
	public function set_match_level( $match_level ) {
		$this->match_level = $match_level;
	}

	/**
	 * Get match level.
	 *
	 * @return int|null
	 */
	public function get_match_level() {
		return $this->match_level;
	}

	/**
	 * Set match date.
	 *
	 * @param \DateTimeInterface|null $match_date Match date.
	 */
	public function set_match_date( $match_date ) {
		$this->match_date = $match_date;
	}

	/**
	 * Get match date.
	 *
	 * @return \DateTimeInterface|null
	 */
	public function get_match_date() {
		return $this->match_date;
	}

	/**
	 * Set match number.
	 *
	 * @param string $match_number Match number.
	 */
	public function set_match_number( $match_number ) {
		$this->match_number = $match_number;
	}

	/**
	 * Get match number.
	 *
	 * @return string
	 */
	public function get_match_number() {
		return $this->match_number;
	}

	/**
	 * Get VAT total.
	 *
	 * Only if line type is `total`. The total VAT amount in the currency of the purchase transaction.
	 *
	 * @return string|null
	 */
	public function get_vat_total() {
		return $this->vat_total;
	}

	/**
	 * Set VAT total.
	 *
	 * @param string|null $vat_total VAT total.
	 */
	public function set_vat_total( $vat_total ) {
		$this->vat_total = $vat_total;
	}

	/**
	 * Get VAT base total.
	 *
	 * Only if line type is `total`. The total VAT amount in base currency.
	 *
	 * @return string|null
	 */
	public function get_vat_base_total() {
		return $this->vat_base_total;
	}

	/**
	 * Set VAT base total.
	 *
	 * @param string|null $vat_base_total VAT base total.
	 */
	public function set_vat_base_total( $vat_base_total ) {
		$this->vat_base_total = $vat_base_total;
	}

	/**
	 * Get comment.
	 *
	 * @return string|null
	 */
	public function get_comment() {
		return $this->comment;
	}

	/**
	 * Set comment.
	 *
	 * @param string|null $comment Comment.
	 */
	public function set_comment( $comment ) {
		$this->comment = $comment;
	}
}
