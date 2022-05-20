<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Terranet\Administrator\Model\Language;

class LanguageKeyTranslation extends Model
{
    protected $table = 'language_key_translations';

    public $timestamps = false;

    protected $fillable = ['translation_id', 'language_id', 'value'];

    public function key()
    {
        return $this->belongsTo(LanguageKey::class, 'translation_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
