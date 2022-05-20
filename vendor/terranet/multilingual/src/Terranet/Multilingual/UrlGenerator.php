<?php namespace Terranet\Multilingual;

use Illuminate\Routing\UrlGenerator as IlluminateUrlGenerator;
use Lang;
use Request;

/**
 * An UrlGenerator with multilingual features
 */
class UrlGenerator extends IlluminateUrlGenerator
{

    /**
     * Generate a absolute URL to the given path, with the current language code
     * as the prefix.
     *
     * @param  string  $path
     * @param  mixed  $extra
     * @param  bool  $secure
     * @param  string  $langCode If null, the current Lang::code() will be used
     * @return string
     */
    public function lang_to($path, $extra = array(), $secure = null, $langCode = null)
    {
        return parent::to($this->langPath($langCode ? : Lang::slug()) . trim($path, '/'), $extra, $secure);
    }

    /**
     * Generate a absolute URL of the current URL but in another language.
     * If the current url is not multilingual, the language code is prepended to the url.
     *
     * @param  string  $langCode
     * @param  mixed   $extra
     * @param  bool    $secure
     * @return string
     */
    public function lang_switch($langCode, $extra = array(), $secure = null)
    {
        $langSegment = Lang::getSegment();

        if (in_array(Request::segment($langSegment), Lang::getPublic()->fetch('slug')->toArray())) {
            $current = preg_replace('#^/?([a-z]{2}/)?#', null, preg_replace('#^/([a-z]{2})?$#', null, $this->request->getPathInfo()));
        } else {
            // url is not multilingual
            $current = ltrim($this->request->getPathInfo(), '/ ');
        }

        return $this->to($this->langPath($langCode) . $current, $extra, $secure);
    }

    protected function langPath($lang)
    {
        return config('app.default_locale') !== $lang ? $lang . '/' : '';
    }
}