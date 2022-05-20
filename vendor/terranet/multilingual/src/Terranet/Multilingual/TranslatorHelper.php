<?php namespace Terranet\Multilingual;

trait TranslatorHelper {

    /**
     * Fetch all published languages
     *
     * @return mixed
     */
    public function getPublic()
    {
        return $this->getActiveLanguages();
    }

    public function find($slug)
    {
        return $this->repository->find($slug);
    }

    protected function fetch($field)
    {
        return $this->getPublic()->fetch($field);
    }

    /**
     * Get an array of languages slugs
     *
     * @return mixed
     */
    public function lists()
    {
        return $this->fetch('slug')->toArray();
    }

    /**
     * Get an array of languages ids
     *
     * @return mixed
     */
    public function ids()
    {
        return $this->fetch('id')->toArray();
    }

    /**
     * Check if language is valid
     *
     * @param $slug
     * @return bool
     */
    public function isValid($slug)
    {
        return in_array($slug, $this->fetch('slug')->toArray());
    }

    /**
     * Current language id
     *
     * @return mixed
     */
    public function id()
    {
        return $this->language()->id;
    }

    /**
     * Current language slug
     *
     * @return mixed
     */
    public function slug()
    {
        return $this->language()->slug;
    }

    /**
     * Current language title
     *
     * @return mixed
     */
    public function title()
    {
        return $this->language()->title;
    }
}