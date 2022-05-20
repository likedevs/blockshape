<?php namespace App\Recipe;

use App\RecipeAllergiesExclude;

class ExcludeAllergies extends Builder implements RecipeBuilder
{
    /**
     * @var RecipeBuilder
     */
    private $builder;
    /**
     * @var array
     */
    private $allergies;

    /**
     * ExcludeDiseases constructor.
     *
     * @param RecipeBuilder $builder
     * @param array         $allergies
     */
    public function __construct(RecipeBuilder $builder, array $allergies = [])
    {
        $this->builder = $builder;
        $this->allergies = $allergies;
    }

    public function build()
    {
        $this->query = $this->builder->build();

        if (! empty($this->allergies) && ($recipes = $this->getExcludes())) {
            $this->query->whereNotIn('recipes.id', $recipes);
        }

        return $this->query;
    }

    /**
     * @return mixed
     */
    private function getExcludes()
    {
        return RecipeAllergiesExclude::whereIn('allergy_id', $this->allergies)->lists('recipe_id')->toArray();
    }
}