<?php

namespace App;

use Terranet\Administrator\Repository;
use Terranet\Rankable\HasRankableField;
use Terranet\Rankable\Rankable;

class Disease extends Repository implements Rankable
{
    use HasRankableField;

    protected $rankableColumn = 'rank';

    protected $rankableGroupByColumn = 'parent_id';

    public $timestamps = false;

    protected $fillable = ['name'];

    /**
     * Select top-level diseases
     *
     * @param $query
     * @return mixed
     */
    public function scopeMain($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeChild($query, $parentId)
    {
        return $query->where('parent_id', (int) $parentId);
    }

    public function scopeDefer($query, $defer = 0)
    {
        return $query->where('defer', (int) $defer);
    }

    public function children()
    {
        return $this->hasMany(Disease::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Disease::class, 'parent_id');
    }

    public function hasNote()
    {
        return ! empty($note = trim($this->note));
    }
}
