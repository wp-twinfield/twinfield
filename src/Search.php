<?php

namespace Pronamic\Twinfield;

class Search
{
	private $type;

	private $pattern;

	private $field;

	private $firstRow;

	private $maxRows;

	public function __construct($type, $pattern, $field, $firstRow, $maxRows) {

		$this->type = $type;
		$this->pattern = $pattern;
		$this->field = $field;
		$this->firstRow = $firstRow;
		$this->maxRows = $maxRows;
	}
}
