<?php
/**
 * Journal
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Journal
 *
 * This class represents a Twinfield journal
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class Journal extends CodeName {
    private $office;

    private $transactions;

    public function __construct( $office, $code ) {
        parent::__construct( $code );

        $this->office       = $office;
        $this->transactions = array();
    }

    public function new_transaction() {
        $transaction = new Transaction( $this );

        $this->transactions[] = $transaction;

        return $code;
    }
}
