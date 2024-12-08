<?php
namespace App\Repositories\Eloquent;
use App\Entities\AnswerSheet\AnswerSheetEloquentEntity;
use App\Models\AnswerSheet;
use App\Repositories\Contracts\AnswerSheetRepositoryInterface;
use App\Repositories\Eloquent\EloquentBaseRepository;

class EloquentAnswerSheetRepository extends EloquentBaseRepository implements AnswerSheetRepositoryInterface
{
    protected $model = AnswerSheet::class;

    public function create(array $data)
    {
        $createdAnswer = parent::create($data);
        return new AnswerSheetEloquentEntity($createdAnswer);
    }
}