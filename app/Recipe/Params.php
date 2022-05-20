<?php namespace App\Recipe;

class Params
{
    const PLACEMENT_BEFORE = 'before';

    const PLACEMENT_AFTER = 'after';

    protected $nutrient;

    protected $forTarget = null;

    protected $snack = false;

    protected $eatingNum = null;

    protected $placement = null;

    protected $diseases = [];

    protected $allergies = [];

    protected $foodExcludes = [];

    protected $disabled = [];

    /**
     * @return mixed
     */
    public function getNutrient()
    {
        return $this->nutrient;
    }

    /**
     * @param mixed $nutrient
     * @return $this
     */
    public function setNutrient($nutrient)
    {
        $this->nutrient = $nutrient;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isSnack()
    {
        return $this->snack;
    }

    /**
     * @param boolean $snack
     * @return $this
     */
    public function setSnack($snack)
    {
        $this->snack = (bool) $snack;

        return $this;
    }

    /**
     * @return null
     */
    public function getEatingNum()
    {
        return $this->eatingNum;
    }

    /**
     * @param null $eatingNum
     * @return $this
     */
    public function setEatingNum($eatingNum)
    {
        $this->eatingNum = (int) $eatingNum;

        return $this;
    }

    /**
     * @return null
     */
    public function getPlacement()
    {
        return $this->placement;
    }

    /**
     * @param null $placement
     * @return $this
     * @throws \Exception
     */
    public function setPlacement($placement)
    {
        if (null != $placement && ! in_array($placement, [static::PLACEMENT_BEFORE, static::PLACEMENT_AFTER])) {
            throw new \Exception("Invalid placement");
        }

        $this->placement = $placement;

        return $this;
    }

    /**
     * @return array
     */
    public function getDiseases()
    {
        return $this->diseases;
    }

    /**
     * @param array $diseases
     * @return $this
     */
    public function setDiseases(array $diseases = [])
    {
        $this->diseases = $diseases;

        return $this;
    }

    /**
     * @return array
     */
    public function getAllergies()
    {
        return $this->allergies;
    }

    /**
     * @param array $allergies
     * @return $this
     */
    public function setAllergies(array $allergies = [])
    {
        $this->allergies = $allergies;

        return $this;
    }

    /**
     * @return array
     */
    public function getFoodExcludes()
    {
        return $this->foodExcludes;
    }

    /**
     * @param array $foodExcludes
     * @return $this
     */
    public function setFoodExcludes(array $foodExcludes = [])
    {
        $this->foodExcludes = $foodExcludes;

        return $this;
    }

    /**
     * @return array
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * @param array $disabled
     * @return $this
     */
    public function setDisabled(array $disabled = [])
    {
        $this->disabled = $disabled;

        return $this;
    }

    public function debug()
    {
        $params = [];

        $reflection = new \ReflectionClass($this);

        foreach ($reflection->getProperties() as $property) {
            $name = $property->name;
            $value = $this->$name;

            if (is_array($value)) {
                $value = "[" . (empty($value) ? "" : join(", ", $value)) . "]";
            }

            $params[] = "{$name}: {$value}";
        }

        return join(" | ", $params);
    }

    /**
     * @return null
     */
    public function forTarget()
    {
        return $this->forTarget;
    }

    /**
     * @param null $forTarget
     * @return $this
     */
    public function setForTarget($forTarget)
    {
        $this->forTarget = $forTarget;

        return $this;
    }
}