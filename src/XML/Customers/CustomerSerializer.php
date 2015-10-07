<?php
/**
 * Customer serializer
 *
 * @link       http://pear.php.net/package/XML_Serializer/docs
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\XML\Customers;

use Pronamic\WP\Twinfield\DimensionTypes;
use Pronamic\WP\Twinfield\XML\Serializer;
use Pronamic\WP\Twinfield\Customers\Customer;

/**
 * Sales invoice serializer
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class CustomerSerializer extends Serializer {
	/**
	 * Constructs and initialize an article read request XML object.
	 *
	 * @param Customer $customer the customer to serialize.
	 */
	public function __construct( Customer $customer ) {
		parent::__construct();

		$root = $this->document->createElement( 'dimension' );

		$this->document->appendChild( $root );

		$elements = array(
			'office'    => $customer->get_office(),
			'type'      => DimensionTypes::DEB,
			'code'      => $customer->get_code(),
			'name'      => $customer->get_name(),
			'shortname' => $customer->get_shortname(),
		);

		foreach ( $elements as $name => $value ) {
			if ( ! is_null( $value ) ) {
				$element = $this->document->createElement( $name );
				$element->appendChild( new \DOMText( $value ) );

				$root->appendChild( $element );
			}
		}

		// Financials.
		$financials = $customer->get_financials();

		if ( $financials ) {
			$financials_element = $this->document->createElement( 'financials' );

			$root->appendChild( $financials_element );

			$elements = array(
				'duedays' => $financials->get_due_days(),
			);

			foreach ( $elements as $name => $value ) {
				if ( ! is_null( $value ) ) {
					$element = $this->document->createElement( $name );
					$element->appendChild( new \DOMText( $value ) );

					$financials_element->appendChild( $element );
				}
			}
		}

		// Credit Management.
		$credit_management = $customer->get_credit_management();

		if ( $credit_management ) {
			$credit_management_element = $this->document->createElement( 'creditmanagement' );

			$root->appendChild( $credit_management_element );

			$send_reminder = $credit_management->get_send_reminder();

			$elements = array(
				'sendreminder'  => is_bool( $send_reminder ) ? ( $send_reminder ? 'true' : 'false' ) : $send_reminder,
				'reminderemail' => $credit_management->get_reminder_email(),
			);

			foreach ( $elements as $name => $value ) {
				if ( ! is_null( $value ) ) {
					$element = $this->document->createElement( $name );
					$element->appendChild( new \DOMText( $value ) );

					$credit_management_element->appendChild( $element );
				}
			}
		}
	}
}
