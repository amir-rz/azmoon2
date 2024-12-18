<?php
namespace App\Entities\AnswerSheet;

use App\Models\AnswerSheet;
use Carbon\Carbon;

 class AnswerSheetEloquentEntity implements AnswerSheetEntity
{
    private $answerSheet;
    public function __construct(AnswerSheet|null $AnswerSheet)
    {
        $this->answerSheet = $AnswerSheet;
    }

    public function getId(): int
    {
        return $this->answerSheet->id;
    }
   
    public function getQuizId(): int
    {
        return $this->answerSheet->quiz_id;
    }
    public function getAnswers(): array
    {
        return json_decode($this->answerSheet->answers,true);
    }
    public function getFinishedAt(): Carbon
    {
        return Carbon::parse($this->answerSheet->finished_at);
    }
    public function getScore(): float|null
    {
        return $this->answerSheet?->score;
    }
    public function getStatus(): int
    {
        return $this->answerSheet->status;
    }
  
}