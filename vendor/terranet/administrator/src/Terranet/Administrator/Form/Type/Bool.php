<?php namespace Terranet\Administrator\Form\Type;

use Form;
use Terranet\Administrator\Form\Element;

class Bool extends Element
{
	public $value = null;

	public function renderInput()
	{
        return ''
			. Form::hidden($this->name, 0)
			. Form::checkbox($this->name, 1, (bool) $this->value, $this->attributes);
	}
}
