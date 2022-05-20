<?php

namespace App\Console\Commands;

use App\LanguageKey;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;
use Terranet\Administrator\Model\Language;

class LoadTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translations:load';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load translations from files to database.';

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
     * @param Filesystem $files
     * @return mixed
     */
    public function handle(Filesystem $files, Application $app)
    {
        $this->comment("Load translations ...");

        $counter = 0;
        foreach ($files->directories($app->langPath()) as $langPath) {
            $locale = basename($langPath);
            $localeId = Language::where('slug', $locale)->pluck('id');

            foreach ($files->files($langPath) as $file) {
                $info = pathinfo($file);
                $group = $info['filename'];

                $this->comment("Importing {$group}...");

                $translations = \Lang::getLoader()->load($locale, $group);

                if ($translations && is_array($translations)) {
                    $keys = array_dot($translations);

                    $this->comment(count($keys) . " keys loaded.");

                    foreach ($keys as $key => $value) {
                        $value = (string) $value;
                        $data = [
                            'group' => $group,
                            'key'   => $key,
                        ];

                        if (! $key = LanguageKey::where($data)->first()) {
                            $key = LanguageKey::create($data);
                        }

                        if (! ($translation = $key->translate($localeId))) {
                            $key->translations()->create([
                                'language_id' => $localeId,
                                'value'       => $value
                            ]);
                        } else if ($translation->value !== $value) {
                            $translation->fill([
                                'value' => $value
                            ])->save();
                        }

                        $counter++;
                    }
                }
            }
        }

        $this->info("{$counter} translations were loaded.");

        return $counter;
    }
}
