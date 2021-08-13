<?php
/**
 * Office
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Offices;

use Pronamic\WP\Twinfield\CodeName;
use Pronamic\WP\Twinfield\Organisation\Organisation;
use Pronamic\WP\Twinfield\Accounting\TransactionType;
use Pronamic\WP\Twinfield\Accounting\DimensionType;

/**
 * Office
 *
 * This class represents an Twinfield office
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class Office extends CodeName {
	/**
	 * Organisation.
	 *
	 * @var Organisation|null
	 */
	public $organisation;

    private $transaction_types = array();

    private $dimension_types = array();

    public function new_transaction_type( $code ) {
        $transaction_type = new TransactionType( $this, $code );

        $this->transaction_types[ $code ] = $transaction_type;

        return $transaction_type;
    }

    public function new_dimension_type( $code ) {
        $dimension_type = new DimensionType( $this, $code );

        $this->dimension_types[] = $dimension_type;

        return $dimension_type;
    }

    /**
     * From XML.
     */
    public static function from_xml( $xml, $office ) {
        $simplexml = \simplexml_load_string( $xml );

        if ( false === $simplexml ) {
            throw new \Exception( 'Could not parse XML.' );
        }

        if ( 'office' !== $simplexml->getName() ) {
            throw new \Exception( 'Invalid element name.' );   
        }

        $result = \strval( $simplexml['result'] );

        if ( '1' !== $result ) {
            throw new \Exception( \strval( $simplexml['msg'] ) );
        }

        $office->set_name( \strval( $simplexml->name ) );
        $office->set_shortname( \strval( $simplexml->shortname ) );

        $user = $office->organisation->new_user( \strval( $simplexml->user ) );

        return $office;
    }
}
