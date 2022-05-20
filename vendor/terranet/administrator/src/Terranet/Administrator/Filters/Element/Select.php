<?php namespace Terranet\Administrator\Filters\Element;

use Form;
use Terranet\Administrator\Contracts\Queryable;
use Terranet\Administrator\Traits\QueryableTrait;
use Terranet\Administrator\Form\Element;
use Terranet\Administrator\Traits\CallableTrait;

class Select extends Element implements Queryable
{
    use CallableTrait, QueryableTrait;

    protected $multiple = false;

    public function getOptions()
    {
        $options = $this->options;

        if (empty($options))
            return [];

        if (is_callable($options))
        {

            return $this->callback($options);
        }

        return (array) $options;
    }

    public function renderInput()
    {
        $name = $this->getName();

        if ($this->multiple) {
            $name = "{$name}[]";
            $this->attributes["multiple"] = "multiple";
        }

        return '<!-- Scaffold: '.$this->getName().' -->'
            . Form::label($this->getName(), $this->getLabel())
            . Form::select($name, $this->getOptions(), $this->getValue(), $this->attributes);
    }
}