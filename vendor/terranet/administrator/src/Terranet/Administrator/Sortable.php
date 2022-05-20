<?php namespace Terranet\Administrator;

use Terranet\Administrator\Columns\Factory AS ColumnsFactory;
use Terranet\Administrator\Contracts\Builder;

class Sortable
{
    static protected $columns;

    protected $element;

    protected $direction;

    public function __construct($element, $direction)
    {
        $this->element = $element;
        $this->direction = $direction;
    }

    public static function setColumns(ColumnsFactory $columns)
    {
        self::$columns = $columns;
    }

    public function getElement()
    {
        return $this->element ? : $this->firstSortableColumn();
    }

    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * Build sortable url
     *
     * @param $element
     * @return string
     */
    public function url($element)
    {
        return qsRoute(null, [
            'sort_by'  => $element,
            'sort_dir' => $this->proposeDirection($element)
        ]);
    }

    /**
     * Find first sortable column
     *
     * @return bool
     * @throws Exception
     */
    private function firstSortableColumn()
    {
        foreach ($this->getColumns() as $column) {
            if ($sortable = $column->getSortable()) {
                return $sortable;
            }
        }

        return false;
    }

    /**
     * Propose new sort direction for element
     *
     * @param $forElement
     * @return string
     */
    protected function proposeDirection($forElement)
    {
        $sortDir = $this->getDirection();

        return $forElement == $this->getElement() ? $this->reverseDirection($sortDir) : $sortDir;
    }

    protected function reverseDirection($direction)
    {
        return 'asc' == strtolower($direction) ? 'desc' : 'asc';
    }

    /**
     * @return mixed
     * @throws Exception
     */
    private function getColumns()
    {
        if (! self::$columns) {
            throw new Exception('Set columns factory using Sortable::setColumns() method');
        }

        return self::$columns->getColumns();
    }
}