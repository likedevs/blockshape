<?php namespace App\Repositories;

abstract class Repository
{
    protected $model;

    /**
     * Init repository
     *
     * @param string $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Create a new instance of the model.
     *
     * @param array $attribs
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function createModel(array $attribs = [])
    {
        $class = '\\' . ltrim($this->model, '\\');

        return new $class($attribs);
    }
}