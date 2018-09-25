<?php
/**
 * Address
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Address
 *
 * This class represents an Twinfield address.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class Address {
	/**
	 * Data.
	 *
	 * @var array
	 */
	private $data = array(
		'id'        => null,
		'type'      => null,
		'default'   => null,
		'name'      => null,
		'country'   => null,
		'city'      => null,
		'postcode'  => null,
		'telephone' => null,
		'telefax'   => null,
		'email'     => null,
		'contact'   => null,
		'field_1'   => null,
		'field_2'   => null,
		'field_3'   => null,
		'field_4'   => null,
		'field_5'   => null,
		'field_6'   => null,
	);

	/**
	 * Get property.
	 *
	 * @see https://github.com/woocommerce/woocommerce/blob/3.3.4/includes/abstracts/abstract-wc-data.php#L624-L644
	 * @param string $property Property.
	 */
	private function get_property( $property ) {
		if ( array_key_exists( $property, $this->data ) ) {
			return $this->data[ $property ];
		}
	}

	/**
	 * Set property.
	 *
	 * @see https://github.com/woocommerce/woocommerce/blob/3.3.4/includes/abstracts/abstract-wc-data.php#L624-L644
	 * @param string $property Property.
	 * @param string $value    Value.
	 */
	private function set_property( $property, $value ) {
		if ( array_key_exists( $property, $this->data ) ) {
			$this->data[ $property ] = $value;
		}
	}

	/**
	 * Get ID.
	 *
	 * @return string
	 */
	public function get_id() {
		return $this->get_property( 'id' );
	}

	/**
	 * Set id.
	 *
	 * @param string $id ID.
	 */
	public function set_id( $id ) {
		$this->set_property( 'id', $id );
	}

	/**
	 * Get ID.
	 *
	 * @return string
	 */
	public function get_type() {
		return $this->get_property( 'type' );
	}

	/**
	 * Set type.
	 *
	 * @param string $type Type.
	 */
	public function set_type( $type ) {
		$this->set_property( 'type', $type );
	}

	/**
	 * Is default.
	 *
	 * @return boolean
	 */
	public function is_default() {
		return $this->get_property( 'default' );
	}

	/**
	 * Set default.
	 *
	 * @param boolean $default Default falg.
	 */
	public function set_default( $default ) {
		$this->set_property( 'default', $default );
	}

	/**
	 * Get name.
	 *
	 * @return string
	 */
	public function get_name() {
		return $this->get_property( 'name' );
	}

	/**
	 * Set name.
	 *
	 * @param string $name Name.
	 */
	public function set_name( $name ) {
		$this->set_property( 'name', $name );
	}

	/**
	 * Get country.
	 *
	 * @return string
	 */
	public function get_country() {
		return $this->get_property( 'country' );
	}

	/**
	 * Set country.
	 *
	 * @param string $country Country.
	 */
	public function set_country( $country ) {
		$this->set_property( 'country', $country );
	}

	/**
	 * Get city.
	 *
	 * @return string
	 */
	public function get_city() {
		return $this->get_property( 'city' );
	}

	/**
	 * Set city.
	 *
	 * @param string $city City.
	 */
	public function set_city( $city ) {
		$this->set_property( 'city', $city );
	}

	/**
	 * Get postcode.
	 *
	 * @return string
	 */
	public function get_postcode() {
		return $this->get_property( 'postcode' );
	}

	/**
	 * Set postcode.
	 *
	 * @param string $postcode Postcode.
	 */
	public function set_postcode( $postcode ) {
		$this->set_property( 'postcode', $postcode );
	}

	/**
	 * Get telephone.
	 *
	 * @return string
	 */
	public function get_telephone() {
		return $this->get_property( 'telephone' );
	}

	/**
	 * Set telephone.
	 *
	 * @param string $telephone Telephone.
	 */
	public function set_telephone( $telephone ) {
		$this->set_property( 'telephone', $telephone );
	}

	/**
	 * Get telefax.
	 *
	 * @return string
	 */
	public function get_telefax() {
		return $this->get_property( 'telefax' );
	}

	/**
	 * Set telefax.
	 *
	 * @param string $telefax Telefax.
	 */
	public function set_telefax( $telefax ) {
		$this->set_property( 'telefax', $telefax );
	}

	/**
	 * Get email.
	 *
	 * @return string
	 */
	public function get_email() {
		return $this->get_property( 'email' );
	}

	/**
	 * Set email.
	 *
	 * @param string $email Email.
	 */
	public function set_email( $email ) {
		$this->set_property( 'email', $email );
	}

	/**
	 * Get contact.
	 *
	 * @deprecated Obsolete.
	 * @see https://accounting.twinfield.com/webservices/documentation/#/ApiReference/Masters/Customers#Read
	 * @return string
	 */
	public function get_contact() {
		return $this->get_property( 'contact' );
	}

	/**
	 * Set contact.
	 *
	 * @deprecated Obsolete.
	 * @see https://accounting.twinfield.com/webservices/documentation/#/ApiReference/Masters/Customers#Read
	 * @param string $contact Contact.
	 */
	public function set_contact( $contact ) {
		$this->set_property( 'contact', $contact );
	}

	/**
	 * Get field 1.
	 *
	 * User defined fields, the labels are configured in the Dimension type.
	 *
	 * Default: To the attention of. Dutch: "Ter attentie van".
	 *
	 * @return string
	 */
	public function get_field_1() {
		return $this->get_property( 'field_1' );
	}

	/**
	 * Set field 1.
	 *
	 * User defined fields, the labels are configured in the Dimension type.
	 *
	 * Default: To the attention of. Dutch: "Ter attentie van".
	 *
	 * @param string $value Value.
	 */
	public function set_field_1( $value ) {
		$this->set_property( 'field_1', $value );
	}

	/**
	 * Get field 2.
	 *
	 * User defined fields, the labels are configured in the Dimension type.
	 *
	 * Default: Address 1.
	 *
	 * @return string
	 */
	public function get_field_2() {
		return $this->get_property( 'field_2' );
	}

	/**
	 * Set field 2.
	 *
	 * User defined fields, the labels are configured in the Dimension type.
	 *
	 * Default: Address 1.
	 *
	 * @param string $value Value.
	 */
	public function set_field_2( $value ) {
		$this->set_property( 'field_2', $value );
	}

	/**
	 * Get field 3.
	 *
	 * User defined fields, the labels are configured in the Dimension type.
	 *
	 * Default: Address 2.
	 *
	 * @return string
	 */
	public function get_field_3() {
		return $this->get_property( 'field_3' );
	}

	/**
	 * Set field 3.
	 *
	 * User defined fields, the labels are configured in the Dimension type.
	 *
	 * Default: Addres 3.
	 *
	 * @param string $value Value.
	 */
	public function set_field_3( $value ) {
		$this->set_property( 'field_3', $value );
	}

	/**
	 * Get field 4.
	 *
	 * User defined fields, the labels are configured in the Dimension type.
	 *
	 * Default: VAT number.
	 *
	 * @return string
	 */
	public function get_field_4() {
		return $this->get_property( 'field_4' );
	}

	/**
	 * Set field 4.
	 *
	 * User defined fields, the labels are configured in the Dimension type.
	 *
	 * Default: VAT number.
	 *
	 * @param string $value Value.
	 */
	public function set_field_4( $value ) {
		$this->set_property( 'field_4', $value );
	}

	/**
	 * Get field 5.
	 *
	 * User defined fields, the labels are configured in the Dimension type.
	 *
	 * Default: COC number.
	 *
	 * @return string
	 */
	public function get_field_5() {
		return $this->get_property( 'field_5' );
	}

	/**
	 * Set field 5.
	 *
	 * User defined fields, the labels are configured in the Dimension type.
	 *
	 * Default: COC number.
	 *
	 * @param string $value Value.
	 */
	public function set_field_5( $value ) {
		$this->set_property( 'field_5', $value );
	}

	/**
	 * Get field 6.
	 *
	 * User defined fields, the labels are configured in the Dimension type.
	 *
	 * @return string
	 */
	public function get_field_6() {
		return $this->get_property( 'field_6' );
	}

	/**
	 * Set field 6.
	 *
	 * User defined fields, the labels are configured in the Dimension type.
	 *
	 * @param string $value Value.
	 */
	public function set_field_6( $value ) {
		$this->set_property( 'field_6', $value );
	}

	/**
	 * Get array.
	 *
	 * @return array
	 */
	public function get_array() {
		return $this->data;
	}

	/**
	 * Calculate similarity.
	 *
	 * @param Address $address    Address to compare.
	 * @param array   $properties Properties to compare.
	 * @return int
	 */
	public function similar( $address, $properties = null ) {
		$address1 = $this;
		$address2 = $address;

		if ( empty( $properties ) ) {
			$properties = array_keys( $this->data );
		}

		$matching_chars    = array();
		$matching_percents = array();

		foreach ( $properties as $property ) {
			$value1 = $address1->get_property( $property );
			$value2 = $address2->get_property( $property );

			$matching_chars[ $property ]    = similar_text( $value1, $value2, $percent );
			$matching_percents[ $property ] = $percent;
		}

		return array_sum( $matching_percents ) / count( $matching_percents );
	}
}
