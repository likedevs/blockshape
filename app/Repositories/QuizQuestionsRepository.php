<?php namespace App\Repositories;

class QuizQuestionsRepository extends Repository
{
    public function all()
    {
        return $this->createModel()->orderBy('id')->get();
    }
}