<?php namespace Terranet\Administrator;

use Terranet\Administrator\Form\Contracts\QueryString as QueryStringContract;

class QueryString implements QueryStringContract
{
    protected $args;

    /**
     * QueryString constructor.
     *
     * @param array $args
     */
    public function __construct(array $args = [])
    {
        $this->args = $args;
    }

    /**
     * Convert QueryString args to string
     *
     * @return string
     */
    public function toString()
    {
        return empty($this->args) ? "" : "?" . http_build_query($this->args);
    }

    /**
     * Convert QueryString args to array
     *
     * @return string
     */
    public function toArray()
    {
        return $this->args;
    }
}