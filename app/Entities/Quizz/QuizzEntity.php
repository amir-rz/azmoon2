<?php
namespace App\Entities\Quizz;
interface QuizzEntity
{
    public function getId(): int;
    public function getTitle(): string;
    public function getCategoryId():int;
    public function getDescription():string|null;
    public function getStartDate():string;
    public function getDuration():string;
}
