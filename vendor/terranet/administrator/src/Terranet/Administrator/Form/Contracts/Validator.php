<?php namespace Terranet\Administrator\Form\Contracts;

interface Validator {

    /**
     * Set validation rules
     *
     * @param array $rules
     * @return mixed
     */
    public function setRules(array $rules = null);
}