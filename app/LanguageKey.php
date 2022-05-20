<?php

namespace App;

use Terranet\Administrator\Repository;
use Terranet\Translatable\HasTranslations;
use Terranet\Translatable\Translatable;

/**
 * Translation model
 *
 * @property integer        $id
 * @property integer        $status
 * @property string         $locale
 * @property string         $group
 * @property string         $key
 * @property string         $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class LanguageKey extends Repository implements Translatable
{
    use HasTranslations;

    public $timestamps = false;

    protected $table = 'language_keys';

    protected $fillable = ['group', 'key'];

    protected $translatedAttributes = ['value'];

    protected $translationForeignKey = 'translation_id';
}
