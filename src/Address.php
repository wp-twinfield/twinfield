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
	private $id;

	private $type;

	private $default;

	private $name;

	private $country;

	private $city;

	private $postcode;

	private $telephone;

	private $telefax;

	private $email;

	private $contact;

	private $field_1;

	private $field_2;

	private $field_3;

	private $field_4;

	private $field_5;

	private $field_6;

	public function get_type() {
		return $this->type;
	}

	public function set_type( $type ) {
		$this->type = $type;
	}

	public function is_default() {
		return $this->default;
	}

	public function set_default( $default ) {
		$this->default = $default;
	}

	public function get_name() {
		return $this->name;
	}

	public function set_name( $name ) {
		$this->name = $name;
	}

	public function get_country() {
		return $this->country;
	}

	public function set_country( $country ) {
		$this->country = $country;
	}

	public function get_city() {
		return $this->city;
	}

	public function set_city( $city ) {
		$this->city = $city;
	}

	public function get_postcode() {
		return $this->postcode;
	}

	public function set_postcode( $postcode ) {
		$this->postcode = $postcode;
	}

	public function get_telephone() {
		return $this->telephone;
	}

	public function set_telephone( $telephone ) {
		$this->telephone = $telephone;
	}

	public function get_telefax() {
		return $this->telefax;
	}

	public function set_telefax( $telefax ) {
		$this->telefax = $telefax;
	}

	public function get_email() {
		return $this->email;
	}

	public function set_email( $email ) {
		$this->email = $email;
	}

	public function get_contact() {
		return $this->contact;
	}

	public function set_contact( $contact ) {
		$this->contact = $contact;
	}

	public function get_field_1() {
		return $this->field_1;
	}

	public function set_field_1( $value ) {
		$this->field_1 = $value;
	}

	public function get_field_2() {
		return $this->field_2;
	}

	public function set_field_2( $value ) {
		$this->field_2 = $value;
	}

	public function get_field_3() {
		return $this->field_3;
	}

	public function set_field_3( $value ) {
		$this->field_3 = $value;
	}

	public function get_field_4() {
		return $this->field_4;
	}

	public function set_field_4( $value ) {
		$this->field_4 = $value;
	}

	public function get_field_5() {
		return $this->field_5;
	}

	public function set_field_5( $value ) {
		$this->field_5 = $value;
	}

	public function get_field_6() {
		return $this->field_6;
	}

	public function set_field_6( $value ) {
		$this->field_6 = $value;
	}
}
