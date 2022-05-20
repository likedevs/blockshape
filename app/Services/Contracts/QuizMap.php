<?php


namespace App\Services\Contracts;

interface QuizMap
{
    /**
     * Sync answers with question and hints
     *
     * @param $questionId
     * @param $answerId
     * @param $hintId
     * @param $value
     * @return mixed
     */
    public function sync($questionId, $answerId, $hintId, $value);
}