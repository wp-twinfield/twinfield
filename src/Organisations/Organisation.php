<?php
/**
 * Organisation
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Organisations;

use Pronamic\WP\Twinfield\CodeName;
use Pronamic\WP\Twinfield\UuidTrait;
use Pronamic\WP\Twinfield\Twinfield;
use Pronamic\WP\Twinfield\Users\User;
use Pronamic\WP\Twinfield\Offices\Office;

/**
 * Organisation
 *
 * This class represents a Twinfield organisation
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class Organisation extends CodeName {
    /**
     * Twinfield.
     * 
     * @var Twinfield
     */
    private $twinfield;

    private $users;

    private $offices;

    use UuidTrait;

    public function __construct( $code ) {
        parent::__construct( $code );

        $this->users     = array();
        $this->offices   = array();
    }

    public function get_offices() {
        return $this->offices;
    }

    public function new_user( $code ) {
        $user = new User( $code );

        $user->organisation = $this;

        $this->users[ $code ] = $user;

        return $user;
    }

    public function new_office( $code ) {
        $office = new Office( $code );

        $office->organisation = $this;

        $this->offices[ $code ] = $office;

        return $office;
    }
}
