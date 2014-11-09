<?php

namespace Pronamic\Twinfield;

class FinderData
{
    private $TotalRows;

    private $Columns;

    private $Items;

    public function getTotalRows()
    {
        return $this->TotalRows;
    }

    public function getColumns()
    {
        return $this->Columns;
    }

    public function getItems()
    {
        return $this->Items;
    }
}
