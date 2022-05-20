<?php namespace Terranet\Multilingual\Contracts;

interface Multilingual
{
    /**
     * Get the list of active languages
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPublic();

    /**
     * Find language by id or slug
     *
     * @param $slug
     * @return mixed
     */
    public function find($slug);
}