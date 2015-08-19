<?php

namespace Pronamic\Twinfield;

class SearchResponse
{
	private $SearchResult;

	private $data;

	public function getSearchResult() {

		return $this->SearchResult;
	}

	public function getData() {

		return $this->data;
	}
}
