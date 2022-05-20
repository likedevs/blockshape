<?php

namespace App;

use Terranet\Administrator\Repository;

class Recipe extends Repository
{
    public $timestamps = false;

    protected $fillable = ['nutrient_id', 'name', 'quantity', 'quantity_alt', 'snack', 'season', 'eating', 'placement', 'targets'];

    protected $casts = [
        'snack' => "int"
    ];

    /**
     * Nutrient relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nutrient()
    {
        return $this->belongsTo(Nutrient::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function diseases()
    {
        return $this->belongsToMany(Disease::class, 'recipe_diseases_excludes');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function allergies()
    {
        return $this->belongsToMany(Allergy::class, 'recipe_allergies_excludes');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function foodExcludes()
    {
        return $this->belongsToMany(FoodExcludes::class, 'recipe_food_excludes');
    }

    /**
     * Get appropriate quantity
     *
     * @param $target
     * @return mixed|string
     */
    public function getQuantity($target = 'weight-loss')
    {
        if ('weight-gain' == $target && $this->quantity_gain) {
            return $this->quantity_gain;
        }

        return $this->quantity;
    }

    public function setSeasonAttribute($values)
    {
        $this->setArrayableValue('season', $values);
    }

    public function getSeasonAttribute($value)
    {
        return $this->getArrayableValue($value);
    }

    public function setEatingAttribute($values)
    {
        $this->setArrayableValue('eating', $values);
    }

    public function getEatingAttribute($value)
    {
        return $this->getArrayableValue($value);
    }

    public function setEatingGainAttribute($values)
    {
        $this->setArrayableValue('eating_gain', $values);
    }

    public function getEatingGainAttribute($value)
    {
        return $this->getArrayableValue($value);
    }

    public function setTargetsAttribute($values)
    {
        $this->setArrayableValue('targets', $values);
    }

    public function getTargetsAttribute($value)
    {
        return $this->getArrayableValue($value);
    }

    /**
     * Extract value for MySQL SET type
     *
     * @param $value
     * @return array|null
     */
    protected function getArrayableValue($value)
    {
        if (! empty($value)) {
            return explode(',', $value);
        }

        return [];
    }

    protected function setArrayableValue($name, $values)
    {
        $this->attributes[$name] = null;

        if (is_array($values)) {
            $this->attributes[$name] = join(',', $values);
        }
    }
}