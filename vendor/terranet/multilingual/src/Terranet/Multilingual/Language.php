<?php namespace Terranet\Multilingual;

/**
 * Model for the languages table
 *
 * @property int $id
 * @property string $name
 * @property string $slug International language code with 2 letter (ISO 639-1)
 * @property string $locale International locale code in the format [language[_territory]
 *  e.g. : en_US, en_AU
 *  It is used for identify translation locales.
 * @property boolean $active
 * @property boolean $isDefault
 * @property int $rank
 */
use Illuminate\Database\Eloquent\Model AS Eloquent;

class Language extends Eloquent {

    protected $table = 'languages';

    public $timestamps = null;

    public static $rules = [
        'name' => 'required',
        'slug' => 'required|unique:languages'
    ];

    protected $fillable = ['name', 'slug', 'locale', 'active'];

    /**
     * Retrieve only active languages
     *
     * @param $query
     * @return Language[]
     */
    public function scopeActive($query)
    {
        $query->where('active', '=', 1);
    }

    /**
     * Order languages in desired order
     *
     * @param $query
     */
    public function scopeRanked($query)
    {
        $query->orderBy('rank', 'ASC');
    }
}