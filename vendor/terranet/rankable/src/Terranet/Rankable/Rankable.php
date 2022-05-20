<?php namespace Terranet\Rankable;

interface Rankable
{

    /**
     * Get the sortable field name
     *
     * @return mixed
     */
    public function getRankableColumn();

    /**
     * Get incrementing value
     *
     * @return mixed
     */
    public function getRankableIncrementValue();

    /**
     * Calculate new rank value based on records group
     *
     * @ex.: Group comments rank by post_id
     *
     * @return array|null
     */
    public function getRankableGroupByColumn();

    /**
     * Synchronize ranking
     *
     * @param array $ranking - assoc array where key = record id, value = record rank value
     * @return mixed
     */
    public function syncRanking(array $ranking = []);

}