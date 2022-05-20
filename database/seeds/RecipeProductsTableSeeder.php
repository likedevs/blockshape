<?php

use Illuminate\Database\Seeder;

use App\Recipe;
use App\RecipeProduct;
use App\Product;

use Illuminate\Support\Facades\DB;

class RecipeProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recipes')->delete();

        $items = 150;
        $nutrients = 3;

        for ($r = 0; $r < $items; $r++) {
            $recipe = factory(Recipe::class)->create([
                'nutrient_id' => (int) ceil(($r + 1) / ($items / $nutrients))
            ]);

            for ($i = 0; $i < rand(1, 3); $i++) {
                $product = factory(Product::class)->create();

                factory(RecipeProduct::class)->create([
                    'recipe_id'  => $recipe->id,
                    'product_id' => $product->id
                ]);
            }
        }
    }
}
