<?php namespace App\Transformers;

use App\UserHistory;
use League\Fractal\TransformerAbstract;

class UserHistoryTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user'];

    public function transform(UserHistory $record)
    {
        $out = $this->getCleanArray($record);

        $out['constitution_type_id'] = $record->constitutionType()->id;

        $out['diseases'] = $record->diseases->lists('id')->toArray();
        $out['allergies'] = $record->allergies->lists('id')->toArray();
        $out['excludes'] = $record->excludes->lists('id')->toArray();
        $out['quiz'] = $record->quizPairs->lists('answer_id', 'question_id')->toArray();

        if ($order = $record->order) {
            $out = array_merge($out, [
                'offer_id' => $record->order->offer_id,
                'discount' => $record->order->discount
            ]);
        }

        return $out;
    }

    /**
     * Include User object
     *
     * @param UserHistory $record
     * @return \League\Fractal\Resource\Item
     */
    public function includeUser(UserHistory $record)
    {
        return $this->item($record->user, new UserTransformer);
    }

    /**
     * @param UserHistory $record
     *
     * @return array
     */
    private function getCleanArray(UserHistory $record)
    {
        $data = array_except(
            $record->toArray(),
            ['document', 'declineReason', 'created_at', 'purchased_at', 'updated_at', 'status']
        );

        foreach(['created_at', 'purchased_at'] as $key) {
            if ($date = $record->$key) {
                $data[$key] = [
                    'year'  => $date->year,
                    'month' => $date->month,
                    'day'   => $date->day
                ];
            }
        }

        return $data;
    }
}