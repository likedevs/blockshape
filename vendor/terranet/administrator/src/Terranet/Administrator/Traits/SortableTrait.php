<?php namespace Terranet\Administrator\Traits;

trait SortableTrait
{
    /**
     * Sortable element
     *
     * @var bool
     */
    protected $sortable = false;

    /**
     * @return boolean
     */
    public function getSortable()
    {
        return $this->sortable;
    }

    /**
     * Is Sortable item
     *
     * @return bool
     */
    public function isSortable()
    {
        return is_string($this->sortable) || is_callable($this->sortable);
    }
}