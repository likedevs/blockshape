<?php namespace App\BMICalculator;


class BMIValue
{

    protected $value;

    /**
     * BMIValue constructor.
     *
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = round($value, 1);
    }

    /**
     * Get the numeric BMI representation
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Find a record in database corresponding to current value
     *
     * @return mixed
     */
    public function resolve()
    {
        return (new EloquentProvider)->find($this);
    }
}