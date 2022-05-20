<?php namespace Terranet\Administrator\Filters\Element;

use Form;
use Terranet\Administrator\Contracts\Queryable;
use Terranet\Administrator\Traits\QueryableTrait;
use Terranet\Administrator\Form\Element;

class Text extends Element implements Queryable
{
    use QueryableTrait;

    public function renderInput()
    {
        return '<!-- Scaffold: '.$this->getName().' -->'
            . Form::label($this->getName(), $this->getLabel())
            . Form::text($this->getName(), $this->getValue(), $this->attributes);
    }
}