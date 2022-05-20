<?php namespace Terranet\Administrator\Filters;

interface FilterInterface
{
    public function addElements(array $elements = []);

    public function getElements();
}