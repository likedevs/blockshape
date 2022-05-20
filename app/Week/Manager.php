<?php namespace App\Week;

use App\Convert\TimeToMins;
use App\Nutrient;
use App\Recipe;
use App\Recipe\Params;
use App\Services\Contracts\RecipeFinder;
use App\Http\Controllers\Controller;

class Manager extends Controller
{
    private $schedule;

    private $weekDays = ['mon', 'tue', 'wen', 'thu', 'fri', 'sat', 'sun'];

    private $allDays = ['mon', 'tue', 'wen', 'thu', 'fri', 'sat', 'sun', 'mon', 'tue', 'wen', 'thu', 'fri', 'sat', 'sun', 'mon', 'tue', 'wen', 'thu', 'fri', 'sat', 'sun', 'mon', 'tue', 'wen', 'thu', 'fri', 'sat', 'sun', 'mon', 'tue', 'mon', 'tue', 'wen', 'thu', 'fri', 'sat', 'sun', 'mon', 'tue', 'wen', 'thu', 'fri', 'sat', 'sun', 'mon', 'tue', 'wen', 'thu', 'fri', 'sat', 'sun', 'mon', 'tue', 'wen', 'thu', 'fri', 'sat', 'sun', 'mon', 'tue'];

    private $oneDay = ['mon'];

    private $record;

    /**
     * @var
     */
    private $recipeFinder;

    public function __construct(RecipeFinder $recipeFinder)
    {
        $this->recipeFinder = $recipeFinder;
        $this->dayQty = date("t", strtotime(date("Y-m")));
    }

    /**
     * @param $schedule
     * @return array
     */
    public function build($schedule, $forUser = false)
    {
        $this->schedule = $schedule;

        $schedule = [];

        $diseases = $this->record->diseases->lists('id')->toArray();
        $allergies = $this->record->allergies->lists('id')->toArray();
        $excludes = $this->record->excludes->lists('id')->toArray();

        $params = new Params();
        $params->setForTarget($target = $this->record->target->slug);


        if ($forUser == 'allDays') {
            $days = $this->allDays;
        }elseif($forUser === 'oneDay'){
            $days = $this->oneDay;
        }else{
            $days = $this->weekDays;
        }

        // dd($days);
        foreach ($days as $dayNum => $day) {
            $disabled = [];
            $type = $this->schedule[$day]['type'];

            $nutrition = [];
            $workoutTime = null;
            if (in_array($type, ['activity', 'rest'])) {
                if ('activity' == $type) {
                    $workoutTime = $this->schedule[$day]['time'];
                    $dailySchedule = $this->loadScheduler()->schedule($workoutTime);
                } else {
                    $dailySchedule = $this->restScheduler()->schedule();
                }

                $eatingNum = 0;
                foreach ($dailySchedule as $hour => $nutrient) {
                    if ('water' == $nutrient) {
                        continue;
                    }

                    list($eating, $nutrient) = explode(':', $nutrient);

                    $isSnack = ('snack' == $eating);
                    if ('main' == $eating) {
                        $eatingNum++;
                    }

                    $params->setNutrient($nutrient)
                        ->setSnack($isSnack)
                        ->setEatingNum($eatingNum)
                        ->setDiseases($diseases)
                        ->setAllergies($allergies)
                        ->setFoodExcludes($excludes)
                        ->setDisabled($disabled);

                    $placement = null;
                    if ('activity' == $type && ! $isSnack) {
                        $hourInMins = (new TimeToMins($hour))->convert();
                        $workoutTimeInMins = (new TimeToMins($workoutTime))->convert();

                        $placement = $hourInMins == $workoutTime ? null : ($hourInMins > $workoutTimeInMins ? 'after' : 'before');
                    }
                    $params->setPlacement($placement);

                    $recipe = $this->recipeFinder->find($params);

                    if (! $recipe) {
                        $recipe = new Recipe([
                            'nutrient'  => new Nutrient(['name' => $nutrient]),
                            'name'      => 'Not found (' . $params->debug() . ')',
                            'quantity'  => 0,
                            'season'    => null,
                            'snack'     => $isSnack,
                            'eating'    => $eatingNum,
                            'placement' => $placement
                        ]);
                    }

                    if ($recipe && $recipe->id) {
                        $disabled[] = $recipe->id;
                    }

                    $nutrition[$hour] = [
                        'nutrient'  => $recipe->nutrient->name,
                        'name'      => /*$eating . ' | ' . */$recipe->name,
                        'quantity'  => $recipe->getQuantity($target),
                        'season'    => $recipe->season,
                        'snack'     => $recipe->snack,
                        'eating'    => $recipe->eating,
                        'placement' => $recipe->placement
                    ];
                }
            } else {
                $nutrition = glossary('definition.detoxification', 'body');
            }

            $schedule[$dayNum] = [
                'day' => $day,
                'type' => $type,
                'workout' => $workoutTime,
                'nutrition' => $nutrition
            ];
        }

        return $schedule;
    }

    /**
     * @return mixed
     */
    private function loadScheduler()
    {
        return app('LoadScheduler')->driver($this->record->target->slug);
    }

    /**
     * @return mixed
     */
    private function restScheduler()
    {
        return app('RestScheduler')->driver($this->record->target->slug);
    }

    /**
     * @return array
     */
    public function getWeekDays()
    {
        return $this->weekDays;
    }

    /**
     * @param $record
     * @return $this
     */
    public function setRecord($record)
    {
        $this->record = $record;

        return $this;
    }
}
