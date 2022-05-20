<?php

namespace App\Console\Commands;

use App\Nutrient;
use App\ReferenceGroup;
use App\ReferenceProduct;
use DB;
use Illuminate\Console\Command;

class ImportReferences extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '
        import:references
        {file : File to import}
        {--bounds=A13:F36,A47:F50,A61:F127 : Bounds of blocks to import}
        {--names=proteins,lipids,carbohydrates : Bounds names}
        {--clean : Clean tables before importing.}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import caloric tables (XLS format).';

    protected $headers = ['name', 'proteins', 'lipids', 'disaccharides', 'starch', 'energy_value'];

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

        $blocks = explode(",", $this->option('bounds'));
        $nutrients = explode(',', $this->option('names'));

        foreach ($blocks as $b => $bounds) {
            list($colFrom, $rowFrom, $colTo, $rowTo) = $this->parseBounds($bounds);
            $nutrient = $this->findNutrient($nutrients[$b]);
            $columns = range($colFrom, $colTo); // [A,B,C,D]
            $rows = range($rowFrom, $rowTo); // [13, 14, 15, 16]

            foreach ($rows as $row) {
                $firstCellInRow = $sheet->getCellByColumnAndRow($colFrom, $row);

                if ($this->isGroup($firstCellInRow)) {
                    $groupName = trim($firstCellInRow->getValue());

                    if (! ($group = $this->findGroup($groupName))) {
                        $this->createGroup($groupName, $nutrient);
                    }
                } else {
                    $data = $this->collectProductData($columns, $sheet, $row);

                    if (! $this->findProduct($data['name'])) {
                        $this->createProduct($data, $group);
                    }
                }
            }
        }

        $this->comment("Done!");
    }

    /**
     * @param $bounds
     * @return array
     */
    private function parseBounds($bounds)
    {
        $pattern = '~^(?P<column>[A-Z]+)(?P<row>\d+)$~si';

        list($start, $end) = explode(":", $bounds);

        preg_match($pattern, $start, $from);
        preg_match($pattern, $end, $to);

        return [$from['column'], $from['row'], $to['column'], $to['row']];
    }

    /**
     * Find most appropriate group by name
     *
     * @param $group
     * @return mixed
     */
    private function findGroup($group)
    {
        if ($group = $this->groups()->sort(function ($object1, $object2) use ($group) {
            return levenshtein($group, $object1->name) > levenshtein($group, $object2->name) ? 1 : 0;
        })->first()
        ) {
            $this->info("Group exists: {$group->name}");
        };

        return $group;
    }

    /**
     * Find a product by name
     *
     * @param $name
     * @return mixed
     */
    private function findProduct($name)
    {
        if ($product = $this->products()->sort(function ($object1, $object2) use ($name) {
            return levenshtein($name, $object1->name) > levenshtein($name, $object2->name) ? 1 : 0;
        })->first()
        ) {
            $this->info("Product exists: {$product->name}");
        };

        return $product;
    }

    /**
     * Find nutrient by slug
     *
     * @param $nutrient
     * @return mixed
     */
    private function findNutrient($nutrient)
    {
        return Nutrient::where('slug', $nutrient)->first();
    }

    /**
     * Prepare database for import
     */
    private function prepareTablesForImport()
    {
        if ($clean = $this->option('clean')) {
            DB::table('reference_groups')->delete();
            DB::statement('ALTER TABLE reference_groups AUTO_INCREMENT = 1;');
            DB::statement('ALTER TABLE reference_products AUTO_INCREMENT = 1;');
        }
    }

    /**
     * Create a new group
     *
     * @param $name
     * @param $nutrient
     * @return mixed
     */
    private function createGroup($name, $nutrient)
    {
        $group = $nutrient->referenceGroups()->create(['name' => $name]);

        $this->info("Added group: {$group->name}");

        return $group;
    }

    /**
     * Append product to a group
     *
     * @param $data
     * @param $group
     * @return mixed
     */
    private function createProduct($data, $group)
    {
        $product = $group->products()->create($data);

        $this->info("Added product: {$product->name}");

        return $product;
    }

    /**
     * List all groups
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function groups()
    {
        static $groups = null;

        if (null === $groups) {
            $groups = ReferenceGroup::all();
        }

        return $groups;
    }

    /**
     * List all products
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function products()
    {
        static $products = null;
        if (null === $products) {
            $products = ReferenceProduct::all();
        }

        return $products;
    }

    /**
     * Detect groups
     *
     * @param $firstCellInRow
     * @return mixed
     */
    private function isGroup($firstCellInRow)
    {
        return $firstCellInRow->getMergeRange();
    }

    /**
     * Collect cells data for a product
     *
     * @param $columns
     * @param $sheet
     * @param $row
     * @return array
     */
    private function collectProductData($columns, $sheet, $row)
    {
        $data = [];

        foreach ($columns as $i => $column) {
            $value = $sheet->getCellByColumnAndRow($i, $row)->getValue();
            if (is_object($value)) {
                $value = $value->getPlainText();
            }
            $data[$this->headers[$i]] = trim($value);
        }

        return $data;
    }
}
