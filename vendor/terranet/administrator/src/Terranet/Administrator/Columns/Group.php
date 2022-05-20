<?php namespace Terranet\Administrator\Columns;

use Illuminate\Database\Eloquent\Collection;
use Terranet\Administrator\Contracts\Queryable;
use Terranet\Administrator\Contracts\Sortable;
use Terranet\Administrator\Traits\QueryableTrait;
use Terranet\Administrator\Traits\SortableTrait;

class Group extends ColumnAbstract implements ColumnInterface, Sortable, Queryable
{
    use SortableTrait;
    use QueryableTrait;
    /**
     * List of elements included in group
     *
     * @var array
     */
    protected $elements = [];

    protected $standalone = false;

    public function __construct($name, $title, array $elements, $sortField = null)
    {
        $this->name = $name;

        if (empty ($title)) {
            $title = $name;
        }
        $this->title = ucwords(join(" ", explode("_", $title)));

        $this->setElements($elements);

        $this->sortable  = $sortField;
    }

    /**
     * @param array $elements
     * @return $this
     */
    public function setElements($elements)
    {
        $this->elements = Collection::make([]);

        foreach($elements as $column => $options) {
            $element = new Column($column, $options);

            $this->elements->push($element);
        }

        return $this;
    }

    /**
     * Retrieve list of grouped elements
     *
     * @return array
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * Assign raw values to each group element
     *
     * @param $scaffoldRow
     * @return array
     */
    public function getValue($scaffoldRow)
    {
        $out = [];
        foreach ($this->getElements() as $element) {
            $out[$element->getName()] = $element->getRaw($scaffoldRow);
        }
        return $out;
    }

    /**
     * Assign formatted value to each group element
     *
     * @param $scaffoldRow
     * @return array
     */
    public function getFormatted($scaffoldRow)
    {
        $out = [];
        foreach ($this->getElements() as $element) {
            $out[$element->getName()] = $element->getFormatted($scaffoldRow);
        }
        return $out;
    }

    protected function getSortableElement()
    {
        return $this->getElements()->filter(function($item) {
            return $item->getName() == $this->sortable;
        })->first();
    }

    public function getSortable()
    {
        return ($e = $this->getSortableElement()) ? $e->getName() : null;
    }
}