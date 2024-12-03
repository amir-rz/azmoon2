<?php
namespace App\Repositories\Eloquent;

use App\Entities\Quizz\QuizzEloquentEntity;
use App\Models\Quizz;
use App\Repositories\Contracts\QuizzRepositoryInterface;

class EloquentQuizzRepository extends EloquentBaseRepository implements QuizzRepositoryInterface
{
    protected $model = Quizz::class;

    public function create(array $data)
    {
        $createdQuizz = parent::create($data);
        return new QuizzEloquentEntity($createdQuizz);  
    }
}