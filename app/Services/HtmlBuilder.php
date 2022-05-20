<?php

namespace App\Services;

use App\Week\Manager;
use App\User;
use App\UserHistory;
use App\MRation;
use App\MRationTerm;
use App\MUserDiary;
use App\Video;
use BMICalculator;
use App\Traits\DocumentBuilder;
use App\Repositories\ExercisesRepository;
use App\Repositories\NutrientsRepository;
use App\Repositories\QuizHintsRepository;
use App\Repositories\SuggestionsRepository;
use App\Services\Contracts\HtmlBuilder as DocumentBuilderContract;
use Auth;
use Session;

class HtmlBuilder implements DocumentBuilderContract
{
    protected $metabolismCalculator;

    protected $weekManager;
    /**
     * @var QuizHintsRepository
     */
    private $hintsRepository;
    /**
     * @var NutrientsRepository
     */
    private $nutrientsRepository;
    /**
     * @var ExercisesRepository
     */
    private $exercisesRepository;
    /**
     * @var SuggestionsRepository
     */
    private $suggestionsRepository;

    /**
     * Create a new command instance.
     *
     * @param QuizHintsRepository   $hintsRepository
     * @param NutrientsRepository   $nutrientsRepository
     * @param ExercisesRepository   $exercisesRepository
     * @param SuggestionsRepository $suggestionsRepository
     */
    public function __construct(
        QuizHintsRepository $hintsRepository,
        NutrientsRepository $nutrientsRepository,
        ExercisesRepository $exercisesRepository,
        SuggestionsRepository $suggestionsRepository
    ) {
        $this->hintsRepository = $hintsRepository;
        $this->nutrientsRepository = $nutrientsRepository;
        $this->exercisesRepository = $exercisesRepository;
        $this->suggestionsRepository = $suggestionsRepository;
    }

    /**
     * Build the document
     *
     * @param User        $user
     * @param UserHistory $record
     *
     * @return $this
     */
    public function build(User $user, UserHistory $record, $traning = null, $date = null, $rebuild = null)
    {
        $maxWeight = $this->recommendedWeight($user, $record);

        list($estimatedTime, $estimatedTimeMax, $estimatedTimeAnabolic, $estimatedTimeMaxAnabolic)
            = $this->estimateProgress($record, $maxWeight);

        $weekManager = $this->weekManager()->setRecord($record);

        if (!is_null($traning)) {
            $schedule = ['mon' => ['type' => 'activity', 'time' => $traning]];
            return $this->changeRation($weekManager->build($schedule, 'oneDay'), $user);
        }

        if (!is_null($rebuild)) {
            $schedule = ['mon' => ['type' => 'rest']];
            return $this->changeRation($weekManager->build($schedule, 'oneDay'), $user);
        }

        $this->buildSchedule($weekManager->build($record->schedule, 'allDays'), $user, $date);

        return view('dompdf.template')->with([
            'user'                     => $user,
            'record'                   => $record,
            'bmi'                      => $this->calculateBMI($record),
            'diseases'                 => $this->fetchDiseases($record),
            'allergies'                => $this->fetchAllergies($record),
            'excludes'                 => $this->fetchFoodExcludes($record),
            'quizHints'                => $this->fetchQuizSuggestions($record),
            'nutrients'                => $this->fetchNutrients(),
            'diseasesNotes'            => $this->fetchDiseasesNotes($record, 0),
            'deferDiseasesNotes'       => $this->fetchDiseasesNotes($record, 1),
            'exercises'                => $this->fetchExercises(),
            'suggestions'              => $this->fetchSuggestions(),
            'maxWeight'                => $maxWeight,
            'estimatedTime'            => join('-', $estimatedTime),
            'estimatedTimeMax'         => join('-', $estimatedTimeMax),
            'estimatedTimeAnabolic'    => join('-', $estimatedTimeAnabolic),
            'estimatedTimeMaxAnabolic' => join('-', $estimatedTimeMaxAnabolic),
            'metabolism'               => [
                'current'     => $this->metabolismCalculator()->calculate(
                    $record->current_weight, $record->height, $user->age()
                ),
                'target'      => $this->metabolismCalculator()->calculate(
                    $record->target_weight, $record->height, $user->age()
                ),
                'recommended' => $this->metabolismCalculator()->calculate($maxWeight, $record->height, $user->age())
            ],
            'weekDays'                 => $weekManager->getWeekDays(),
            'schedule'                 => $weekManager->build($record->schedule)
        ])->render();

    }

    // build videos
    public function buildVideos($user)
    {
        $history = UserHistory::where('user_id', $user->id)->first();
        if (is_null($history)) {
            return false;
        }

        $figureType = $history->figureType->name;
        $target = $history->target->name;

        // $rations = MRation::where('user_id', Auth::user()->id)->get();
        $i = 0;
        if ($figureType == 'Pară') {
            foreach ($rations as $key => $ration) {
                $i++;
                if ($i % 8 == 0) {
                    $i = 1;
                }
                echo $i;
            }
        }
        dd($figureType);
    }

    public $instrs = [1 => '', 2 => ''];

    public function findVideo($type)
    {
        $video = Video::orderByRaw("RAND()")->where('type', $type)->whereNotIn('instructor_id', $this->instrs)->first();
        if (is_null($video)) {
            return false;
        }
        $this->instrs[1] = $this->instrs[2];
        $this->instrs[2] = $video->instructor_id;
        return $video->id;
    }

    public function getVideo($day, $history)
    {
        // return $day;
        $figureType = $history->figureType;
        $target = $history->target;

        if ($target->slug == 'weight-gain') {
            switch ($day) {
                case 'mon':  return $this->findVideo('fese/coapse');  break;
                case 'tue':  return $this->findVideo('talie/abdomen');  break;
                case 'fri':  return $this->findVideo('general'); break;
                case 'thu':  return $this->findVideo('fese/coapse'); break;
                case 'wen':  return $this->findVideo('general'); break;
                case 'sat':  return $this->findVideo('fese/coapse'); break;
                case 'sun':  return $this->findVideo('prezentation');break;
            }
        }elseif ($figureType->id == 1) {
            switch ($day) {
                case 'mon':  return $this->findVideo('talie/abdomen');  break;
                case 'tue':  return $this->findVideo('general');  break;
                case 'fri':  return $this->findVideo('talie/abdomen'); break;
                case 'thu':  return $this->findVideo('fese/coapse'); break;
                case 'wen':  return $this->findVideo('talie/abdomen'); break;
                case 'sat':  return $this->findVideo('general'); break;
                case 'sun':  return $this->findVideo('prezentation');break;
            }
        }elseif ($figureType->id == 2) {
            switch ($day) {
                case 'mon':  return $this->findVideo('fese/coapse');  break;
                case 'tue':  return $this->findVideo('general');  break;
                case 'fri':  return $this->findVideo('fese/coapse'); break;
                case 'thu':  return $this->findVideo('talie/abdomen'); break;
                case 'wen':  return $this->findVideo('fese/coapse'); break;
                case 'sat':  return $this->findVideo('general'); break;
                case 'sun':  return $this->findVideo('prezentation');break;
            }
        }elseif ($figureType->id == 3) {
            switch ($day) {
                case 'mon':  return $this->findVideo('fese/coapse');  break;
                case 'tue':  return $this->findVideo('talie/abdomen');  break;
                case 'fri':  return $this->findVideo('general'); break;
                case 'thu':  return $this->findVideo('fese/coapse'); break;
                case 'wen':  return $this->findVideo('talie/abdomen'); break;
                case 'sat':  return $this->findVideo('general'); break;
                case 'sun':  return $this->findVideo('prezentation');break;
            }
        }elseif ($target->slug == 'maintenance') {
            switch ($day) {
                case 'mon':  return $this->findVideo('fese/coapse');  break;
                case 'tue':  return $this->findVideo('talie/abdomen');  break;
                case 'fri':  return $this->findVideo('general'); break;
                case 'thu':  return $this->findVideo('fese/coapse'); break;
                case 'wen':  return $this->findVideo('talie/abdomen'); break;
                case 'sat':  return $this->findVideo('general'); break;
                case 'sun':  return $this->findVideo('prezentation');break;
            }
        }

        return $history;
    }

    // build schedule
    public function buildSchedule($schedule, $user, $date = null)
    {
        if (!empty($schedule)) {
            $history = UserHistory::where('user_id', $user->id)->first();
            if (is_null($history)) {
                return false;
            }

            foreach ($schedule as $i =>  $items) {

                // dd($this->getVideo($items['day'], $history));

                $food = [];
                if (array_key_exists('nutrition', $items)) {
                    if (is_array($items['nutrition'])) {
                        foreach ($items['nutrition'] as $key => $item) {
                            $food[] = json_encode([
                                            'time' => $key,
                                            'name' => $item['name'],
                                            'qty' => $item['quantity']
                                            ]);
                        }
                    }
                }
                $date = strtotime("+".$i." day", strtotime(date("Y-m-d")));

                if (count($food) == 5) {
                    MRation::create([
                        'user_id' => $user->id,
                        'date' => gmdate("Y-m-d", $date),
                        'day' => $i+1,
                        'food_1' => $food[0],
                        'food_2' => $food[1],
                        'food_3' => $food[2],
                        'food_4' => $food[3],
                        'food_5' => $food[4],
                        'type'   => $items['type'],
                        'traning'  => $items['workout'],
                        'details'   => '',
                        'video_id' => $this->getVideo($items['day'], $history),
                    ]);
                }elseif (count($food) == 4) {
                    MRation::create([
                        'user_id' => $user->id,
                        'date' => gmdate("Y-m-d", $date),
                        'day' => $i+1,
                        'food_1' => $food[0],
                        'food_2' => $food[1],
                        'food_3' => $food[2],
                        'food_4' => $food[3],
                        'food_5' => '',
                        'type'   => $items['type'],
                        'traning'   => $items['workout'],
                        'details'   => '',
                        'video_id' => $this->getVideo($items['day'], $history),
                    ]);
                }else{
                    MRation::create([
                        'user_id' => $user->id,
                        'date' => gmdate("Y-m-d", $date),
                        'day' => $i+1,
                        'food_1' => "",
                        'food_2' => "",
                        'food_3' => "",
                        'food_4' => "",
                        'food_5' => "",
                        'type'   => $items['type'],
                        'traning'   => $items['workout'],
                        'details'   => $items['nutrition'],
                        'video_id' => $this->getVideo($items['day'], $history),
                    ]);
                }

                $this->createDiary(gmdate("Y-m-d", $date));
            }
        }

        $term_from = MRation::where('user_id', $user->id)->orderBy('id', 'asc')->first();
        $term_to = MRation::where('user_id', $user->id)->orderBy('id', 'desc')->first();
        $checkRationTerm = MRationTerm::where('user_id', $user->id)->first();

        if (is_null($checkRationTerm)) {
            MRationTerm::create([
                'user_id' => $user->id,
                'term_from' => $term_from->date,
                'term_to' => $term_to->date,
            ]);
        }else{
            MRationTerm::where('user_id', $user->id)->update([
                'term_from' => $term_from->date,
                'term_to' => $term_to->date,
            ]);
        }
    }

    public $mouths = [];

    public function createDiary($date)
    {
        if (!in_array(date('m', strtotime($date)), $this->mouths)) {
            $this->mouths[] = date('m', strtotime($date));
        }

        $nowMouth = date('m', strtotime($date));
        $nowYear = date('Y', strtotime($date));

        $day = substr($date, -2);
        $userHistory = UserHistory::where('user_id', Auth::user()->id)->first();

        if (is_null($userHistory)) { return false; }

        $menstrualCicle = $userHistory->menstrual_cycle;

        $menstrualDuration = 28;

        if (array_key_exists('duration', $menstrualCicle)) {
            if ($menstrualCicle['duration'] > 0) {
                $menstrualDuration = $menstrualCicle['duration'];
            }
        }

        if (array_key_exists('start_date', $menstrualCicle)) {
            $startDate = $menstrualCicle['start_date'];
            $duration = round($menstrualDuration / 2);
            $midlleDate =  strtotime("+".$duration." days", strtotime(date('Y').'-'.date('m').'-'.$startDate));
            $finishDate =  strtotime("+".$menstrualDuration." days", strtotime(date('Y').'-'.date('m').'-'.$startDate));
            $start_date = strtotime(date('Y').'-'.date('m').'-'.$startDate);
        }else{
            $startDate = 0;
            $duration = 0;
            $midlleDate =  0;
            $finishDate =  0;
        }

        if ((date('d', strtotime($date)) >= $startDate) && (date('d', strtotime($date)) < date('d', $midlleDate))) {
            MUserDiary::create([
                'user_id' => Auth::user()->id,
                'date' => $date,
                'menstruation_start' => $startDate,
                'period' => 'catabolic',
                'empty' => 1,
            ]);
        }elseif((date('d', strtotime($date)) >= date('d', $midlleDate)) && (date('d', strtotime($date)) < date('d', $finishDate))){
            MUserDiary::create([
                'user_id' => Auth::user()->id,
                'date' => $date,
                'menstruation_start' => $startDate,
                'period' => 'anabolic',
                'empty' => 1,
            ]);
        }else{
            MUserDiary::create([
                'user_id' => Auth::user()->id,
                'date' => $date,
                'menstruation_start' => $startDate,
                'period' => 'none',
                'empty' => 1,
            ]);
        }
    }

    public function changeRation($schedule, $user)
    {
        if (!empty($schedule)) {
            $food = [];
            if (array_key_exists('nutrition', $schedule[0])) {
                if (is_array($schedule[0]['nutrition'])) {
                    foreach ($schedule[0]['nutrition'] as $key => $item) {
                        $food[] = json_encode([
                                        'time' => $key,
                                        'name' => $item['name'],
                                        'qty' => $item['quantity']
                                        ]);
                    }
                }
            }

            if (count($food) == 5) {
                MRation::where('date', Session::get('history_date'))
                        ->where('user_id', Auth::user()->id)
                        ->update([
                            'user_id' => $user->id,
                            'food_1' => $food[0],
                            'food_2' => $food[1],
                            'food_3' => $food[2],
                            'food_4' => $food[3],
                            'food_5' => $food[4],
                            'type'   => $schedule[0]['type'],
                            'traning'  => $schedule[0]['workout'],
                            'details'   => '',
                ]);
            }else {
                MRation::where('date', date('Y-m-d'))
                        ->where('user_id', Auth::user()->id)
                        ->update([
                            'user_id' => $user->id,
                            'food_1' => $food[0],
                            'food_2' => $food[1],
                            'food_3' => $food[2],
                            'food_4' => $food[3],
                            'food_5' => '',
                            'type'   => $schedule[0]['type'],
                            'traning'  => $schedule[0]['workout'],
                            'details'   => '',
                ]);
            }
        }
    }

    /**
     * @param UserHistory $record
     *
     * @return mixed
     */
    private function fetchDiseasesNotes(UserHistory $record, $defer = false)
    {
        $diseases = $record->diseases()->defer($defer)->get()->map(function ($item) {
            if (! $item->hasNote() && ($parent = $item->parent) && $parent->hasNote()) {
                $item->note = $parent->note;
            }

            return $item;
        })->unique('note');

        return $diseases;
    }

    /**
     * @param UserHistory $record
     * @param             $maxWeight
     *
     * @return array
     */
    private function estimateProgress(UserHistory $record, $maxWeight)
    {
        $estimator = (new ProgressTimeEstimator)->estimate($record->current_weight, $record->target_weight);
        $estimatorMax = (new ProgressTimeEstimator)->estimate($record->current_weight, $maxWeight);
        $estimatedTime = $estimator->getValues();
        $estimatedTimeAnabolic = $estimator->getAnabolicValues();
        $estimatedTimeMax = $estimatorMax->getValues();
        $estimatedTimeMaxAnabolic = $estimatorMax->getAnabolicValues();

        return [$estimatedTime, $estimatedTimeMax, $estimatedTimeAnabolic, $estimatedTimeMaxAnabolic];
    }

    /**
     * @param User        $user
     * @param UserHistory $record
     *
     * @return float
     */
    private function recommendedWeight(User $user, UserHistory $record)
    {
        return (new MaxWeight)->calculate($record->height, $user->age());
    }

    /**
     * @return mixed
     */
    private function fetchNutrients()
    {
        return $this->nutrientsRepository->all();
    }

    /**
     * @return mixed
     */
    private function fetchExercises()
    {
        return $this->exercisesRepository->all(true);
    }

    /**
     * @return mixed
     */
    private function fetchSuggestions()
    {
        return $this->suggestionsRepository->all();
    }

    /**
     * @param UserHistory $record
     *
     * @return mixed
     */
    private function fetchQuizSuggestions(UserHistory $record)
    {
        return $this->hintsRepository->allByUserHistory($record->id);
    }

    /**
     * @return BasalMetabolism
     */
    private function metabolismCalculator()
    {
        if (null == $this->metabolismCalculator) {
            $this->metabolismCalculator = new BasalMetabolism;
        }

        return $this->metabolismCalculator;
    }

    /**
     * @param UserHistory $record
     *
     * @return mixed
     */
    private function fetchDiseases(UserHistory $record)
    {
        return $record->diseases->lists('id')->toArray();
    }

    /**
     * @param UserHistory $record
     *
     * @return mixed
     */
    private function fetchAllergies(UserHistory $record)
    {
        return $record->allergies->lists('id')->toArray();
    }

    /**
     * @param UserHistory $record
     *
     * @return mixed
     */
    private function fetchFoodExcludes(UserHistory $record)
    {
        return $record->excludes->lists('id')->toArray();
    }

    /**
     * @param UserHistory $record
     *
     * @return mixed
     */
    private function calculateBMI(UserHistory $record)
    {
        return BMICalculator::driver('female')->calculate($record->height,
            $record->current_weight);
    }

    private function weekManager()
    {
        if (null === $this->weekManager) {
            $this->weekManager = new Manager(app('App\Services\Contracts\RecipeFinder'));
        }

        return $this->weekManager;
    }
}
