<?php namespace App\Recipe;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder as QueryBuilder;

class SeasonFilter extends Builder implements RecipeBuilder
{
    /**
     * @var Finder
     */
    private $builder;

    /**
     * SeasonFilter constructor.
     *
     * @param Finder $builder
     */
    public function __construct($builder)
    {
        $this->builder = $builder;
    }

    /**
     * Build a complex query
     *
     * @return QueryBuilder
     */
    public function build()
    {
        $this->query = $this->builder->build();

        return $this->query->whereRaw("(season IS NULL OR season='" . $this->getSeason() . "')");
    }

    private function getSeason()
    {
        $seasons = array(
            0 => 'winter',
            1 => 'spring',
            2 => 'summer',
            3 => 'autumn'
        );
        return $seasons[floor(date('n') / 3) % 4];
    }
}