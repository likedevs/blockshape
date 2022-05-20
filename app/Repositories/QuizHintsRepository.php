<?php namespace App\Repositories;

class QuizHintsRepository extends Repository
{
    /**
     * Fetch full list of quiz hints
     *
     * @return mixed
     */
    public function all()
    {
        return $this->createModel()->orderBy('id')->get();
    }

    /**
     * Fetch short list of quiz hints
     *
     * @return mixed
     */
    public function lists()
    {
        return $this->createModel()->orderBy('id')->lists('code', 'id');
    }

    public function allByUserHistory($historyId)
    {
        return $this->createModel()
            ->distinct()
            ->select('quiz_hints.*')
            ->join('quiz_question_answers as qqa', function ($join) {
                $join->on('qqa.hint_id', '=', 'quiz_hints.id');
            })
            ->join('user_history_quiz_answers AS uhqa', function ($join) {
                $join->on('uhqa.question_id', '=', 'qqa.question_id')
                    ->on('uhqa.answer_id', '=', 'qqa.answer_id');
            })
            ->where('uhqa.history_id', (int) $historyId)
            ->get();
    }
}