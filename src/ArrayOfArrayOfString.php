<?php

namespace Pronamic\Twinfield;

class ArrayOfArrayOfString implements \IteratorAggregate
{
	/**
	 * An array with array strings
	 *
	 * @var array
	 */
	private $ArrayOfString;

	public function getIterator() {
		return new \ArrayIterator( $this->ArrayOfString );
	}
}
