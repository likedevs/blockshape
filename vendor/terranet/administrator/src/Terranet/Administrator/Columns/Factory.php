<?php namespace Terranet\Administrator\Columns;

use Illuminate\Database\Eloquent\Collection;

class Factory
{
    protected $_cleanColumns = [];

    protected $columns = null;

    public function __construct(array $columns)
    {
        $this->_cleanColumns = $columns;
    }

    /**
     * Get list of columns
     *
     * @param bool $force
     * @return array|null
     */
    public function getColumns($force = false)
    {
        if (null === $this->columns || $force) {
            $this->columns = new Collection();

            foreach ($this->_cleanColumns as $column => $options) {
                // @todo: implement "visibility" concept

                if ($this->isGroup($options)) {
                    $title = isset($options['title']) ? $options['title'] : $column;
                    $sortField = isset($options['sortable']) ? $options['sortable'] : null;

                    $item = new Group($column, $title, $options['elements'], $sortField);
                } else {
                    $item = new Column($column, $options);
                }

                $this->columns->push($item);
            }
        }

        return $this->columns;
    }

    /**
     * Find column
     *
     * @param $name
     * @return mixed
     */
    public function getColumn($name)
    {
        return $this->getColumns()->first(function($key, $column) use ($name) {
            if ($column instanceof Group) {
                return $column->getElements()->first(function($key, $column) use ($name) {
                    return $column->getName() == $name;
                });
            }
            return $column->getName() == $name;
        });
    }

    /**
     * @param $options
     * @return bool
     */
    private function isGroup($options)
    {
        return is_array($options) && array_key_exists('elements', $options);
    }
}