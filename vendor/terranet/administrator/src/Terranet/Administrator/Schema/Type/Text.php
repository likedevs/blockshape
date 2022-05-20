<?php namespace Terranet\Administrator\Schema\Type;

class Text extends TypeAbstract
{
    protected $length;

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }
}