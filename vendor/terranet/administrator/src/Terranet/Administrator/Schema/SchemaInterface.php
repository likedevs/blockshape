<?php


namespace Terranet\Administrator\Schema;

interface SchemaInterface
{
    public function setTable($table);

    public function describe($table);

    public function get($field);
}