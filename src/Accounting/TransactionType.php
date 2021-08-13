<?php
/**
 * Transaction Type
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Accounting;

use Pronamic\WP\Twinfield\CodeName;
use Pronamic\WP\Twinfield\Accounting\Transaction;
use Pronamic\WP\Twinfield\Accounting\TransactionType;

/**
 * Transaction Type
 *
 * This class represents a Twinfield transaction type
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class TransactionType extends CodeName {
    private $office;

    private $transactions;

    public function __construct( $office, $code ) {
        parent::__construct( $code );

        $this->office       = $office;
        $this->transactions = array();
    }

    public function get_office() {
        return $this->office;
    }

    public function new_transaction() {
        $transaction = new Transaction( $this );

        $this->transactions[] = $transaction;

        return $transaction;
    }
}
