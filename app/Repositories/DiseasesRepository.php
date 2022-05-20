<?php namespace App\Repositories;

class DiseasesRepository extends Repository
{
    public function all()
    {
        $list = $this->createModel()->unRanked()->orderBy('id')->get(['id', 'name', 'parent_id', 'rank'])->toArray();

        return $this->sort(
            $this->makeTree($list)
        );
    }

    /**
     * @param $list
     *
     * @return array
     */
    private function makeTree($list)
    {
        $out = [];

        foreach ($list as $item) {
            if (is_null($item['parent_id'])) {
                $out[$item['id']] = $item;
                if (!array_key_exists('children', $out[$item['id']])) {
                    $out[$item['id']]['children'] = [];
                }
            } else {
                $out[$item['parent_id']]['children'][] = $item;
            }
        }


        return $out;
    }

    /**
     * Sort tree by rank field
     *
     * @param $tree
     */
    private function sort($tree)
    {
        foreach($tree as &$value) {
            if (! empty($value['children'])) {
                $value['children'] = $this->sort($value['children']);
            }
        }

        usort($tree, function ($a, $b) {
            return $a['rank'] < $b['rank'] ? -1 : ($a['rank'] == $b['rank'] ? 0 : 1);
        });

        return $tree;
    }
}