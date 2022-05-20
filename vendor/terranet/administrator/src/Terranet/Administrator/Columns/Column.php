<?php namespace Terranet\Administrator\Columns;

use Terranet\Administrator\Contracts\Queryable;
use Terranet\Administrator\Contracts\Sortable;
use Terranet\Administrator\Exception;
use Terranet\Administrator\Traits\CallableTrait;
use Terranet\Administrator\Traits\QueryableTrait;
use Terranet\Administrator\Traits\SortableTrait;

class Column extends ColumnAbstract implements ColumnInterface, Queryable, Sortable
{
    use CallableTrait, QueryableTrait, SortableTrait;

    protected $outputCallback;

    protected $standalone = false;

    public function __construct($column, $options = null, $standalone = false)
    {
        if (is_numeric($column) && is_string($options)) {
            $name = $options;
            $title = $name;
            $sortable = $name;
            $standalone = false;
            $output = null;
            // column set using simple style: 'username'
        } else if (is_string($column) && is_array($options)) {
            $name = $column;
            $title = isset($options['title']) ? $options['title'] : '';
            $sortable = isset($options['sortable']) ? $options['sortable'] : $name;
            $standalone = isset($options['standalone']) ? $options['standalone'] : false;
            $output = isset($options['output']) ? $options['output'] : false;
        } else {
            throw new Exception(sprintf('Invalid column format: %s, $s', $column, $options));
        }

        $this->name = $name;

        if (empty ($title)) {
            $title = $name;
        }
        $this->title = ucwords(join(" ", explode("_", $title)));

        $this->setSortable($sortable);

        $this->standalone = (bool) $standalone;

        $this->outputCallback = $output;
    }

    public function getValue($scaffoldRow)
    {
        return $scaffoldRow->{$this->getName()};
    }

    public function getFormatted($scaffoldRow)
    {
        if (! $this->outputCallback) {
            return $this->getValue($scaffoldRow);
        }

        if (is_callable($this->outputCallback)) {
            return $this->callback($this->outputCallback, $scaffoldRow);
        }

        return preg_replace_callback('~\(\:([a-z0-9\_]+)\)~si', function ($matches) use ($scaffoldRow) {
            $field = $matches[1];

            return $scaffoldRow->$field;
        }, $this->outputCallback);
    }

    public function isStandalone()
    {
        return $this->standalone;
    }

    /**
     * @param $sortable
     */
    private function setSortable($sortable)
    {
        if (is_callable($sortable)) {
            $this->sortable = $this->name;
            $this->query = $sortable;
        } else if (is_string($sortable)) {
            $this->sortable = $sortable;
            $this->query = null;
        } else {
            $this->sortable = false;
            $this->query = null;
        }
    }
}