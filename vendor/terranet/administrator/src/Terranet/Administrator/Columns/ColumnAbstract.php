<?php namespace Terranet\Administrator\Columns;

use Terranet\Administrator\Contracts\Builder;

class ColumnAbstract
{
    protected $name;

    protected $title;

    public function getName()
    {
        return $this->name;
    }

    public function getTitle()
    {
        return $this->title;
    }
}