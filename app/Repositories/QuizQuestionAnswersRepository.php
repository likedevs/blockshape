<?php namespace App\Repositories;

use DB;

class QuizQuestionAnswersRepository extends Repository
{
    /**
     * Attach hint to answer
     *
     * @param $question_id
     * @param $answer_id
     * @param $hint_id
     * @return static
     */
    public function attachHint($question_id, $answer_id, $hint_id)
    {
        return $this->createModel()->create(compact('question_id', 'answer_id', 'hint_id'));
    }


    /**
     * Detach hint from answer
     *
     * @param $question_id
     * @param $answer_id
     * @param $hint_id
     * @return mixed
     */
    public function detachHint($question_id, $answer_id, $hint_id)
    {
        return $this->createModel()->where(compact('question_id', 'answer_id', 'hint_id'))->delete();
    }

    /**
     * Fetch full list of attached hints concatenated into single string
     *
     * @return array
     */
    public function concatList()
    {
        return $this->createModel()->get(['question_id', 'answer_id', 'hint_id'])->map(function($row) {
            return $row->question_id . '_' . $row->answer_id . '_' . $row->hint_id;
        })->toArray();
    }
}