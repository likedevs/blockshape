<?php namespace Terranet\Administrator\Form\Type;

use Form;
use Terranet\Administrator\Form\Element;

class Textarea extends Element
{
	/**
	 * The specific defaults for subclasses to override
	 *
	 * @var array
	 */
	protected $attributes = [
		'style'			=> 'min-width: 700px; height: 150px;'
	];

	/**
	 * The specific rules for subclasses to override
	 *
	 * @var array
	 */
	protected $rules = [];

	public function renderInput()
	{
		return Form::textarea($this->name, $this->value, $this->attributes);
	}
}