<?php

namespace App\Console\Commands;

use App\Nutrient;
use App\Recipe;
use DB;
use Illuminate\Console\Command;

class ImportRecipes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '
        import:recipes
        {file : File to import}
        {--clean : Clean tables before importing}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import recipes from a file (XLS format).';

    protected $nutrientsMap = [
        'glucide'           => 'carbohydrates',
        'glucide+proteine'  => 'proteins-carbohydrates',
        'proteine'          => 'proteins',
        'proteina-vegetala' => 'vegetables-carbohydrates'
    ];

    protected $headers = [
        'nutrient_id',
        'name', // product name
        'quantity', //
        'snack',  // main eating or a snack
        'season', // vara, primavara, etc...
        'eating', // 1, 2, 3 (dimineata, zi, seara)
        'placement', // before / after workout,
    ];

    /**
     * Create a new command instance.
     *
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
        $this->prepareTablesForImport();

        $file = $this->argument('file');

        $sheet = (new \PHPExcel_Reader_Excel2007)->load($file)->getActiveSheet();

        $recipes = $this->fetchRecipesData($sheet);

        foreach ($recipes as $recipe) {
            $recipe = $this->prepareRecipeItem($recipe);

            try {
                $this->createRecipe($recipe);
            } catch (\Exception $e) {
                $this->comment("Recipe exists: {$recipe['name']}");
            }
        }

        $this->info('Done: ' . count($recipes) . ' recipes were processed');
    }

    /**
     * Prepare database for import
     */
    private function prepareTablesForImport()
    {
        if ($clean = $this->option('clean')) {
            DB::table('recipes')->delete();
            DB::statement('ALTER TABLE recipes AUTO_INCREMENT = 1;');
            DB::statement('ALTER TABLE recipe_allergies_excludes AUTO_INCREMENT = 1;');
            DB::statement('ALTER TABLE recipe_diseases_excludes AUTO_INCREMENT = 1;');
            DB::statement('ALTER TABLE recipe_food_excludes AUTO_INCREMENT = 1;');
        }
    }

    /**
     * @param $sheet
     * @return array
     */
    private function fetchRecipesData($sheet)
    {
        $recipes = array_filter($sheet->toArray(), function ($row) {
            return ! is_null($row[0]) && array_key_exists($row[0], $this->nutrientsMap);
        });

        return $recipes;
    }

    private function findNutrient($slug)
    {
        $slug = trim($slug);

        return $this->nutrients()->get($slug);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function nutrients()
    {
        static $data = null;

        if (null === $data) {
            $data = Nutrient::lists('id', 'slug');
        }

        return $data;
    }

    /**
     * @param $recipe
     * @return array
     */
    private function prepareRecipeItem($recipe)
    {
        $recipe = array_splice($recipe, 0, count($this->headers));
        $recipe = array_combine($this->headers, $recipe);

        $recipe['nutrient_id'] = $this->findNutrient($this->nutrientsMap[$recipe['nutrient_id']]);
        $recipe['snack'] = (int) $recipe['snack'];

        return $recipe;
    }

    /**
     * @param $recipe
     */
    private function createRecipe($recipe)
    {
        if ($recipe = Recipe::create($recipe)) {
            $this->info("Recipe created: {$recipe->name} [{$recipe->nutrient->name} / Snack: {$recipe->snack}]");
        }
    }
}
