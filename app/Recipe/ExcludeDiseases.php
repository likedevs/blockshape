<?php namespace App\Recipe;

use App\RecipeDiseasesExclude;

class ExcludeDiseases extends Builder implements RecipeBuilder
{
    /**
     * @var RecipeBuilder
     */
    private $builder;
    /**
     * @var array
     */
    private $diseases;

    /**
     * ExcludeDiseases constructor.
     *
     * @param RecipeBuilder $builder
     * @param array         $diseases
     */
    public function __construct(RecipeBuilder $builder, array $diseases = [])
    {
        $this->builder = $builder;
        $this->diseases = $diseases;
    }

    public function build()
    {
        $this->query = $this->builder->build();

        if (! empty($this->diseases) && ($recipes = $this->getExcludes())) {
            $this->query->whereNotIn('recipes.id', $recipes);
        }

        return $this->query;
    }

    /**
     * @return mixed
     */
    private function getExcludes()
    {
        return RecipeDiseasesExclude::whereIn('disease_id', $this->diseases)->lists('recipe_id')->toArray();
    }
}