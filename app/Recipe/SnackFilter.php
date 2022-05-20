<?php namespace App\Recipe;

use Illuminate\Database\Query\Builder as QueryBuilder;

class SnackFilter extends Builder implements RecipeBuilder
{
    /**
     * @var RecipeBuilder
     */
    private $builder;
    /**
     * @var
     */
    private $snack;

    /**
     * SnackFilter constructor.
     *
     * @param RecipeBuilder $builder
     * @param               $snack
     */
    public function __construct(RecipeBuilder $builder, $snack)
    {
        $this->builder = $builder;
        $this->snack = $snack;
    }


    /**
     * Build a complex query
     *
     * @return QueryBuilder
     */
    public function build()
    {
        return $this->query = $this->builder->build();

        return $this->query->where('snack', (int) $this->snack);
    }
}