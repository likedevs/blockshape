<?php namespace Terranet\Multilingual\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Composer;

class TableCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'languages:table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a migration for the languages database table';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * @var \Illuminate\Foundation\Composer
     */
    protected $composer;

    /**
     * Create a new queue job table command instance.
     *
     * @param \Illuminate\Filesystem\Filesystem|Filesystem $files
     * @param Composer                                     $composer
     */
    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct();

        $this->files = $files;
        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $fullPath = $this->createBaseMigration();

        $stub = $this->files->get(__DIR__.'/stubs/languages.stub');

        $this->files->put($fullPath, $stub);

        $this->info('Languages migration created successfully!');

        $this->composer->dumpAutoloads();
    }

    /**
     * Create a base migration file for the table.
     *
     * @return string
     */
    protected function createBaseMigration()
    {
        $name = 'create_languages_table';

        $path = $this->laravel->databasePath().'/migrations';

        return $this->laravel['migration.creator']->create($name, $path);
    }
}
