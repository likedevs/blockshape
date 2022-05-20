<?php

namespace App\Providers;

use App\Allergy;
use App\Disease;
use App\Exercise;
use App\FigureType;
use App\FoodExcludes;
use App\GeneralRecommendation;
use App\Nutrient;
use App\Offer;
use App\Office;
use App\Order;
use App\PressureType;
use App\Product;
use App\QuizHint;
use App\QuizQuestion;
use App\QuizQuestionAnswer;
use App\Recipe;
use App\ReferenceGroup;
use App\Repositories\AllergiesRepository;
use App\Repositories\DepartmentsRepository;
use App\Repositories\DiseasesRepository;
use App\Repositories\ExcludesRepository;
use App\Repositories\ExercisesRepository;
use App\Repositories\FigureTypesRepository;
use App\Repositories\NutrientsRepository;
use App\Repositories\OffersRepository;
use App\Repositories\OrdersRepository;
use App\Repositories\PressureTypesRepository;
use App\Repositories\QuizHintsRepository;
use App\Repositories\QuizQuestionAnswersRepository;
use App\Repositories\QuizQuestionsRepository;
use App\Repositories\SuggestionsRepository;
use App\Repositories\TargetsRepository;
use App\Repositories\UserHistoryRepository;
use App\Repositories\UsersRepository;
use App\Services\HtmlBuilder;
use App\Services\PdfBuilder;
use App\Target;
use App\User;
use App\UserHistory;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use App\MPages;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $pages = MPages::where('is_home', 0)->where('is_menu', 1)->get();
        View::share('pages', $pages);
        View::share('lang_id', 1);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRepositories();

        $this->registerStaticContainers();

        $this->registerServices();
    }

    private function registerRepositories()
    {
        $this->app->singleton('App\Repositories\UsersRepository', function () {
            return new UsersRepository(User::class);
        });

        $this->app->singleton('App\Repositories\OffersRepository', function () {
            return new OffersRepository(Offer::class);
        });

        $this->app->singleton('App\Repositories\OrdersRepository', function () {
            return new OrdersRepository(Order::class);
        });

        $this->app->singleton('App\Repositories\DepartmentsRepository', function () {
            return new DepartmentsRepository(Office::class);
        });

        $this->app->singleton('App\Repositories\FigureTypesRepository', function () {
            return new FigureTypesRepository(FigureType::class);
        });

        $this->app->singleton('App\Repositories\AllergiesRepository', function () {
            return new AllergiesRepository(Allergy::class);
        });

        $this->app->singleton('App\Repositories\DiseasesRepository', function () {
            return new DiseasesRepository(Disease::class);
        });

        $this->app->singleton('App\Repositories\ExcludesRepository', function () {
            return new ExcludesRepository(FoodExcludes::class);
        });

        $this->app->singleton('App\Repositories\QuizHintsRepository', function () {
            return new QuizHintsRepository(QuizHint::class);
        });

        $this->app->singleton('App\Repositories\QuizQuestionsRepository', function () {
            return new QuizQuestionsRepository(QuizQuestion::class);
        });

        $this->app->singleton('App\Repositories\QuizQuestionAnswersRepository', function () {
            return new QuizQuestionAnswersRepository(QuizQuestionAnswer::class);
        });

        $this->app->singleton('App\Repositories\UserHistoryRepository', function () {
            return new UserHistoryRepository(UserHistory::class);
        });

        $this->app->singleton('App\Repositories\ExercisesRepository', function () {
            return new ExercisesRepository(Exercise::class);
        });

        $this->app->singleton('App\Repositories\NutrientsRepository', function () {
            return new NutrientsRepository(Nutrient::class);
        });

        $this->app->singleton('App\Repositories\SuggestionsRepository', function () {
            return new SuggestionsRepository(GeneralRecommendation::class);
        });

        $this->app->singleton('App\Repositories\PressureTypesRepository', function () {
            return new PressureTypesRepository(PressureType::class);
        });

        $this->app->singleton('App\Repositories\TargetsRepository', function () {
            return new TargetsRepository(Target::class);
        });
    }

    private function registerStaticContainers()
    {
        $this->app->singleton('products_list', function () {
            return Product::lists('name', 'id');
        });

        $this->app->singleton('quiz_questions', function () {
            return $this->app['App\Repositories\QuizQuestionsRepository']->all();
        });

        // full list
        $this->app->singleton('quiz_hints', function () {
            return $this->app['App\Repositories\QuizHintsRepository']->all();
        });

        // short list
        $this->app->singleton('quiz_hints_list', function () {
            return $this->app['App\Repositories\QuizHintsRepository']->lists();
        });

        $this->app->singleton('quiz_attached_hints', function () {
            return $this->app['App\Repositories\QuizQuestionAnswersRepository']->concatList();
        });
    }

    private function registerServices()
    {
        $this->app->bind('App\Services\Contracts\QuizMap', 'App\Services\QuizMap');

        $this->app->bind('App\Services\Contracts\RecipeFinder', 'App\Services\RecipeFinder');
        //$this->app->bind('App\Services\Contracts\RecipeFinder', 'App\Services\RecipeTwoStepsFinder');

        $this->app->bind('App\Services\Contracts\HtmlBuilder', function ($app) {
            return new HtmlBuilder(
                $app[QuizHintsRepository::class],
                $app[NutrientsRepository::class],
                $app[ExercisesRepository::class],
                $app[SuggestionsRepository::class]
            );
        });

        $this->app->bind('App\Services\Contracts\PdfBuilder', function ($app) {
            return new PdfBuilder(new Filesystem);
        });
    }
}
