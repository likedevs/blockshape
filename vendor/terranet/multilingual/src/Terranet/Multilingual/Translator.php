<?php namespace Terranet\Multilingual;

use Illuminate\Container\Container;
use Illuminate\Translation\Translator as IlluminateTranslator;
use Terranet\Multilingual\Contracts\Multilingual;

class Translator extends IlluminateTranslator
{
    use TranslatorHelper;

    protected static $autoDetect = true;

    protected static $segment = 1;

    /**
     * The IoC Container
     *
     * @var Container
     */
    protected $app;

    /**
     * The language model instance
     *
     * @var Language|null
     */
    static protected $language;

    /**
     * List of active languages from the database
     *
     * @var \Illuminate\Database\Eloquent\Collection | Language[]
     */
    static protected $activeLanguages = null;

    /**
     * @var \Terranet\Multilingual\Contracts\Multilingual
     */
    protected $repository;

    public function setApplication(Container $application)
    {
        $this->app = $application;

        return $this;
    }

    public function setRepository(Multilingual $repository)
    {
        $this->repository = $repository;

        return $this;
    }

    /**
     * The current Language model instance
     * @return Language
     */
    public function language()
    {
        return self::$language;
    }

    /**
     *
     * @param int $segmentIndex
     * @return Language
     */
    public function resolve($segmentIndex = 1)
    {
        self::$segment = (int) $segmentIndex;

        $this->fetchActiveLanguages();

        $language = $this->resolveFromDb(
            $this->resolveFromRequest()
        );

        return $language;
    }

    /**
     *
     * @param \Terranet\Multilingual\Language $language
     * @param boolean $changeInternalLocale
     */
    public function setLanguage(Language $language, $changeInternalLocale = true)
    {
        self::$language = $language;

        if ($changeInternalLocale === true)
        {
            $this->setInternalLocale($this->language()->slug);
        }
    }

    /**
     *
     * @param string $locale
     */
    public function setInternalLocale($locale)
    {
        $this->app['config']->set('app.locale', $locale);

        $this->setLocale($locale);

        $this->app['events']->fire('locale.changed', array($locale));
    }

    /**
     * List of active languages from the database
     *
     * @var \Illuminate\Database\Eloquent\Collection | Language[]
     * @return \Illuminate\Database\Eloquent\Collection|Language[]
     */
    public function getActiveLanguages()
    {
        $this->fetchActiveLanguages();

        return self::$activeLanguages;
    }

    protected function resolveFromDb($langCode)
    {
        if ($this->getActiveLanguages()->count() > 0)
        {
            // Lookup for a matching language code
            foreach ($this->getActiveLanguages() as $ln)
            {
                if ($ln->slug == $langCode)
                {
                    $this->setLanguage($ln, true);
                    break;
                }
            }
        }

        return self::$language;
    }

    /**
     * @return int
     */
    public function getSegment()
    {
        return self::$segment;
    }

    /**
     * Resolves language code from current request (route segment or HTTP_ACCEPT_LANGUAGE header as fallback)
     * @return string
     */
    protected function resolveFromRequest()
    {
        $activeSlugs = $this->getActiveLanguages()->fetch('slug')->toArray();

        // if request does not contains language => try to detect from browser
        if (! ($langCode = $this->getCodeFromSegment()) && self::$autoDetect)
        {
            // It will rewrite the default language you want.
            //$langCode = $this->getCodeFromHeader();
        }

        // if no language is specified in the url, use the default one
        if (! $langCode || ! in_array($langCode, $activeSlugs))
        {
            $langCode = array_shift($activeSlugs);
        }

        return $langCode;
    }

    /**
     * Returns the (unresolved) language code part of the given URL segment index
     * @return null|string
     */
    public function getCodeFromSegment()
    {
        return $this->app['request']->segment(self::$segment, null);
    }

    /**
     * Returns the  (unresolved) language code from the HTTP_ACCEPT_LANGUAGE header
     * @return string|null
     */
    public function getCodeFromHeader()
    {
        $code = substr($this->app['request']->server('HTTP_ACCEPT_LANGUAGE', null), 0, 2);
        return empty($code) ? null : $code;
    }

    protected function fetchActiveLanguages()
    {
        if (null === self::$activeLanguages)
            self::$activeLanguages = $this->repository->getPublic();

        return self::$activeLanguages;
    }

}