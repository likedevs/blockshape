<?php namespace Terranet\Rankable;

trait HasRankableField
{
    /**
     * Get the rankable field name
     *
     * @return mixed
     */
    public function getRankableColumn()
    {
        return (isset($this->rankableColumn) ? $this->rankableColumn : 'rank');
    }

    /**
     * Get the rankable field name
     *
     * @return mixed
     */
    public function getRankableIncrementValue()
    {
        return (isset($this->rankableIncrementValue) ? (int) $this->rankableIncrementValue : 1);
    }

    /**
     * Calculate new rank value based on records group
     *
     * @ex.: Group comments rank by post_id
     *
     * @return array|null
     */
    public function getRankableGroupByColumn()
    {
        return (isset($this->rankableGroupByColumn) ? (array) $this->rankableGroupByColumn : null);
    }

    /**
     * Synchronize ranking
     *
     * @param array $ranking - assoc array where key = record id, value = record rank value
     * @return mixed
     */
    public function syncRanking(array $ranking = [])
    {
        foreach((array) $ranking as $id => $value)
        {
            $this
                ->where($this->getKeyName(), '=', $id)
                ->update([
                    $this->getRankableColumn() => (int) $value
                ]);
        }
    }

    public static function bootHasRankableField()
    {
        static::addGlobalScope(new RankableScope);

        static::updating(function(Rankable $model)
        {
            if ($model->isDirty($model->getRankableColumn()) && $oldValue = $model->getOriginal($model->getRankableColumn()))
            {
                // switch ranks in conflicts
                $query = $model->newQuery();

                $query = $model->applyRankGrouping($query, $model);

                $query->where($model->getRankableColumn(), '=', (int) $model->getAttribute($model->getRankableColumn()));

                $query->update([
                    $model->getRankableColumn() => $oldValue
                ]);
            }
        });

        static::creating(function(Rankable $model)
        {
            $field = $model->getRankableColumn();

            if (! $model->{$field})
            {
                $query = $model->newQuery();

                $query = $model->applyRankGrouping($query, $model);

                $value = (int) $query->max($field);

                $model->{$field} = ($value + $model->getRankableIncrementValue());
            }
        });

    }

    protected function applyRankGrouping($query, $model)
    {
        if ($columns = (array) $model->getRankableGroupByColumn())
        {
            foreach($columns as $column)
            {
                $query->where($column, '=', $model->{$column});
            }
        }

        return $query;
    }
}