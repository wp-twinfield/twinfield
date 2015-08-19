<?php

namespace Pronamic\Twinfield;

class ArrayOfString implements \IteratorAggregate
{
	/**
	 * An array with strings
	 *
	 * @var array
	 */
	private $string;

	public function getIterator() {
		return new \ArrayIterator( $this->string );
	}
}
