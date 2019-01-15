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

			$ebilling  = $financials->get_ebilling();
			$ebillmail = $financials->get_ebillmail();

			$elements = array(
				'duedays'   => $financials->get_due_days(),
				'ebilling'  => is_bool( $ebilling ) ? ( $ebilling ? 'true' : 'false' ) : $ebilling,
				'ebillmail' => is_null( $ebillmail ) ? $ebillmail : (string) $ebillmail,
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

		// Addresses.
		$addresses = $customer->get_addresses();

		if ( $addresses ) {
			$addresses_element = $this->document->createElement( 'addresses' );

			$root->appendChild( $addresses_element );

			foreach ( $addresses as $address ) {
				$address_element = $this->document->createElement( 'address' );

				$addresses_element->appendChild( $address_element );

				// Attributes.
				$is_default = $address->is_default();

				$attributes = array(
					'id'      => $address->get_id(),
					'type'    => $address->get_type(),
					'default' => is_bool( $is_default ) ? ( $is_default ? 'true' : 'false' ) : $is_default,
				);

				foreach ( $attributes as $name => $value ) {
					if ( null !== $value ) {
						$address_element->setAttribute( $name, $value );
					}
				}

				// Elements.
				$elements = array(
					'name'      => $address->get_name(),
					'country'   => $address->get_country(),
					'city'      => $address->get_city(),
					'postcode'  => $address->get_postcode(),
					'telephone' => $address->get_telephone(),
					'telefax'   => $address->get_telefax(),
					'email'     => $address->get_email(),
					'contact'   => $address->get_contact(),
					'field1'    => $address->get_field_1(),
					'field2'    => $address->get_field_2(),
					'field3'    => $address->get_field_3(),
					'field4'    => $address->get_field_4(),
					'field5'    => $address->get_field_5(),
					'field6'    => $address->get_field_6(),
				);

				foreach ( $elements as $name => $value ) {
					if ( null !== $value ) {
						$element = $this->document->createElement( $name );
						$element->appendChild( new \DOMText( $value ) );

						$address_element->appendChild( $element );
					}
				}
			}
		}
	}
}
