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
	 * ID.
	 *
	 * @var string
	 */
	private $id;

	/**
	 * Type.
	 *
	 * @var string
	 */
	private $type;

	/**
	 * Default.
	 *
	 * @var string
	 */
	private $default;

	/**
	 * Name.
	 *
	 * @var string
	 */
	private $name;

	/**
	 * Country.
	 *
	 * @var string
	 */
	private $country;

	/**
	 * City.
	 *
	 * @var string
	 */
	private $city;

	/**
	 * Postcode.
	 *
	 * @var string
	 */
	private $postcode;

	/**
	 * Telephone.
	 *
	 * @var string
	 */
	private $telephone;

	/**
	 * Telefax.
	 *
	 * @var string
	 */
	private $telefax;

	/**
	 * Email.
	 *
	 * @var string
	 */
	private $email;

	/**
	 * Contact.
	 *
	 * @var string
	 */
	private $contact;

	/**
	 * Field 1.
	 *
	 * @var string
	 */
	private $field_1;

	/**
	 * Field 2.
	 *
	 * @var string
	 */
	private $field_2;

	/**
	 * Field 3.
	 *
	 * @var string
	 */
	private $field_3;

	/**
	 * Field 4.
	 *
	 * @var string
	 */
	private $field_4;

	/**
	 * Field 5.
	 *
	 * @var string
	 */
	private $field_5;

	/**
	 * Field 6.
	 *
	 * @var string
	 */
	private $field_6;

	/**
	 * Get ID.
	 *
	 * @return string
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Set id.
	 *
	 * @param string $id ID.
	 */
	public function set_id( $id ) {
		$this->id = $id;
	}

	/**
	 * Get ID.
	 *
	 * @return string
	 */
	public function get_type() {
		return $this->type;
	}

	/**
	 * Set type.
	 *
	 * @param string $type Type.
	 */
	public function set_type( $type ) {
		$this->type = $type;
	}

	/**
	 * Is default.
	 *
	 * @return boolean
	 */
	public function is_default() {
		return $this->default;
	}

	/**
	 * Set default.
	 *
	 * @param boolean $default Default falg.
	 */
	public function set_default( $default ) {
		$this->default = $default;
	}

	/**
	 * Get name.
	 *
	 * @return string
	 */
	public function get_name() {
		return $this->name;
	}

	/**
	 * Set name.
	 *
	 * @param string $name Name.
	 */
	public function set_name( $name ) {
		$this->name = $name;
	}

	/**
	 * Get country.
	 *
	 * @return string
	 */
	public function get_country() {
		return $this->country;
	}

	/**
	 * Set country.
	 *
	 * @param string $country Country.
	 */
	public function set_country( $country ) {
		$this->country = $country;
	}

	/**
	 * Get city.
	 *
	 * @return string
	 */
	public function get_city() {
		return $this->city;
	}

	/**
	 * Set city.
	 *
	 * @param string $city City.
	 */
	public function set_city( $city ) {
		$this->city = $city;
	}

	/**
	 * Get postcode.
	 *
	 * @return string
	 */
	public function get_postcode() {
		return $this->postcode;
	}

	/**
	 * Set postcode.
	 *
	 * @param string $postcode Postcode.
	 */
	public function set_postcode( $postcode ) {
		$this->postcode = $postcode;
	}

	/**
	 * Get telephone.
	 *
	 * @return string
	 */
	public function get_telephone() {
		return $this->telephone;
	}

	/**
	 * Set telephone.
	 *
	 * @param string $telephone Telephone.
	 */
	public function set_telephone( $telephone ) {
		$this->telephone = $telephone;
	}

	/**
	 * Get telefax.
	 *
	 * @return string
	 */
	public function get_telefax() {
		return $this->telefax;
	}

	/**
	 * Set telefax.
	 *
	 * @param string $telefax Telefax.
	 */
	public function set_telefax( $telefax ) {
		$this->telefax = $telefax;
	}

	/**
	 * Get email.
	 *
	 * @return string
	 */
	public function get_email() {
		return $this->email;
	}

	/**
	 * Set email.
	 *
	 * @param string $email Email.
	 */
	public function set_email( $email ) {
		$this->email = $email;
	}

	/**
	 * Get contact.
	 *
	 * @return string
	 */
	public function get_contact() {
		return $this->contact;
	}

	/**
	 * Set contact.
	 *
	 * @param string $contact Contact.
	 */
	public function set_contact( $contact ) {
		$this->contact = $contact;
	}

	/**
	 * Get field 1.
	 *
	 * User defined fields, the labels are configured in the Dimension type.
	 *
	 * @return string
	 */
	public function get_field_1() {
		return $this->field_1;
	}

	/**
	 * Set field 1.
	 *
	 * User defined fields, the labels are configured in the Dimension type.
	 *
	 * @param string $value Value.
	 */
	public function set_field_1( $value ) {
		$this->field_1 = $value;
	}

	/**
	 * Get field 2.
	 *
	 * User defined fields, the labels are configured in the Dimension type.
	 *
	 * Default: Address.
	 *
	 * @return string
	 */
	public function get_field_2() {
		return $this->field_2;
	}

	/**
	 * Set field 2.
	 *
	 * User defined fields, the labels are configured in the Dimension type.
	 *
	 * Default: Address.
	 *
	 * @param string $value Value.
	 */
	public function set_field_2( $value ) {
		$this->field_2 = $value;
	}

	/**
	 * Get field 3.
	 *
	 * User defined fields, the labels are configured in the Dimension type.
	 *
	 * Default: Postal address.
	 *
	 * @return string
	 */
	public function get_field_3() {
		return $this->field_3;
	}

	/**
	 * Set field 3.
	 *
	 * User defined fields, the labels are configured in the Dimension type.
	 *
	 * Default: Postal address.
	 *
	 * @param string $value Value.
	 */
	public function set_field_3( $value ) {
		$this->field_3 = $value;
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
		return $this->field_4;
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
		$this->field_4 = $value;
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
		return $this->field_5;
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
		$this->field_5 = $value;
	}

	/**
	 * Get field 6.
	 *
	 * User defined fields, the labels are configured in the Dimension type.
	 *
	 * @return string
	 */
	public function get_field_6() {
		return $this->field_6;
	}

	/**
	 * Set field 6.
	 *
	 * User defined fields, the labels are configured in the Dimension type.
	 *
	 * @param string $value Value.
	 */
	public function set_field_6( $value ) {
		$this->field_6 = $value;
	}
}
