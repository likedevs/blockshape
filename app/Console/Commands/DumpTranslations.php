<?php

namespace App\Console\Commands;

use App\LanguageKey;
use App\LanguageKeyTranslation;
use DB;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;

class DumpTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translations:dump';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dump database translations to files.';

    /**
     * @var Filesystem
     */
    protected $files;

    /**
     * @var Application
     */
    protected $app;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param Filesystem  $files
     * @param Application $app
     * @return mixed
     */
    public function handle(Filesystem $files, Application $app)
    {
        $this->files = $files;
        $this->app = $app;

        $groups = LanguageKey::select(DB::raw('DISTINCT `group`'))->get('group');

        foreach ($groups as $group) {
            $this->exportTranslations($group->group);
        }
    }

    protected function exportTranslations($group)
    {
        $items = LanguageKeyTranslation::with(['language'])->join('language_keys', function ($join) {
            $join->on('language_key_translations.translation_id', '=', 'language_keys.id');
        })->where('language_keys.group', $group)->whereRaw("(language_key_translations.value IS NOT NULL AND language_key_translations.value != '')")->get();

        $tree = $this->makeTree($items);

        foreach ($tree as $locale => $groups) {
            if (isset($groups[$group])) {
                $translations = $groups[$group];

                if (! $this->files->isDirectory($this->app->langPath() . '/' . $locale)) {
                    $this->files->makeDirectory($this->app->langPath() . '/' . $locale);
                }
                $path = $this->app->langPath() . '/' . $locale . '/' . $group . '.php';
                $output = "<?php\n\nreturn " . var_export($translations, true) . ";\n";
                $this->files->put($path, $output);
            }
        }
    }

    protected function makeTree($translations)
    {
        $array = [];
        foreach ($translations as $translation) {
            array_set($array[$translation->language->slug][$translation->group], $translation->key,
                $translation->value);
        }

        return $array;
    }
}
