<?php namespace App\Recipe;

use App\RecipeFoodExclude;

class ExcludeFood extends Builder implements RecipeBuilder
{
    /**
     * @var RecipeBuilder
     */
    private $builder;
    /**
     * @var array
     */
    private $excludes;

    /**
     * ExcludeDiseases constructor.
     *
     * @param RecipeBuilder $builder
     * @param array         $excludes
     */
    public function __construct(RecipeBuilder $builder, array $excludes = [])
    {
        $this->builder = $builder;
        $this->excludes = $excludes;
    }

    public function build()
    {
        $this->query = $this->builder->build();

        if (! empty($this->excludes) && ($recipes = $this->getExcludes())) {
            $this->query->whereNotIn('recipes.id', $recipes);
        }

        return $this->query;
    }

    /**
     * @return mixed
     */
    private function getExcludes()
    {
        return RecipeFoodExclude::whereIn('food_excludes_id', $this->excludes)->lists('recipe_id')->toArray();
    }
}