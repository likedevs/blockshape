<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;

class ResetTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translations:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset database translations.';

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
     * @return mixed
     */
    public function handle()
    {
        DB::table('language_keys')->delete();
        DB::statement('ALTER TABLE language_keys AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE language_key_translations AUTO_INCREMENT = 1;');

        $this->info("Done.");
    }
}
