<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('UserTableSeeder');
        $this->call('LanguagesTableSeeder');
        $this->call('NutrientsTableSeeder');
        $this->call('RecipeProductsTableSeeder');
        $this->call('OfficesTableSeeder');
        $this->call('ExercisesTableSeeder');
        $this->call('ExercisePressureMapTableSeeder');
        $this->call('DiseasesTableSeeder');
        $this->call('AllergiesTableSeeder');
        $this->call('FoodExcludesTableSeeder');
        $this->call('ConstitutionTypesTableSeeder');
        $this->call('GeneralRecommendationsTableSeeder');
        $this->call('QuizQuestionsTableSeeder');
        $this->call('QuizHintsTableSeeder');
        $this->call('ReferenceGroupsTableSeeder');
        $this->call('ReferenceProductsTableSeeder');
        $this->call('GlossaryTableSeeder');
        $this->call('PressureTypesTableSeeder');
        $this->call('QuizAnswersGroupsTableSeeder');
        $this->call('QuizQuestionAnswersTableSeeder');
        $this->call('QuizAnswersTableSeeder');
        $this->call('ImcsTableSeeder');
        $this->call('OptionsTableSeeder');
        $this->call('FigureTypesTableSeeder');
    	$this->call('TargetsTableSeeder');
	}
}
