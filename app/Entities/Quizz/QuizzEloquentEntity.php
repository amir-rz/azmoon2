<?php
namespace App\Entities\Quizz;

use App\Models\Quizz;

class QuizzEloquentEntity implements QuizzEntity
{
    private $quizz;
    public function __construct(Quizz|null $quizz)
    {
        $this->quizz = $quizz;
    }
    public function getId(): int
    {
        return $this->quizz->id;
    }
    public function getTitle(): string
    {
        return $this->quizz->title;
    }
    public function getCategoryId() :int
    {
        return $this->quizz->category_id;
    }
    public function getDescription():string|null
    {
        return $this->quizz->description;
    }
    public function getStartDate():string
    {
        return $this->quizz->start_date;
    }
    public function getDuration():string
    {
        return $this->quizz->duration;
    }
}