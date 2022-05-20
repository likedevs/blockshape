<?php namespace Terranet\Multilingual;

use Terranet\Multilingual\Contracts\Multilingual;

class LanguagesRepository implements Multilingual {

    static protected $current = null;

    /**
     * @var \Terranet\Multilingual\Model|\Illuminate\Database\Query\Builder
     */
    private $languages;

    public function __construct(Language $languages)
    {
        $this->languages = $languages;
    }


    /**
     * Get list of active (public) languages
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPublic()
    {
        $active = $this->languages->active()->ranked()->get();

        if (! $active->count()) {
            abort(500, "The database has no active languages.");
        }

        return $active;
    }

    /**
     * Find language by id or slug
     *
     * @param $slug
     * @return mixed
     */
    public function find($slug)
    {
        if (is_numeric($slug))
            return $this->languages->active()->whereId((int) $slug)->first();

        return $this->languages->active()->whereSlug($slug)->first();
    }
}