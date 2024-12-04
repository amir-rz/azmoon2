<?php
namespace App\Entities\Question;

use App\Models\Question;

class QuestionEloquentEntity implements QuestionEntity
{
    private $question;
    public function __construct(Question|null $question)
    {
        $this->question = $question;
    }
    public function getId():int
    {
        return $this->question->id;
    }
    public function getTitle():string
    {
        return $this->question->title;
    }
    public function getScore():float
    {
        return $this->question->score;
    }
    public function getIsActive():int
    {
        return $this->question->is_active;
    }
    public function getOption():array|null
    {
        return $this->question->options;
    }
    public function getQuizId():int
    {
        return $this->question->quiz_id;
    }
}