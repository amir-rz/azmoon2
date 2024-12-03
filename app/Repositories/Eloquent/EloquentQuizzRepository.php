<?php
namespace App\Repositories\Eloquent;

use App\Entities\Quizz\QuizzEloquentEntity;
use App\Models\Quizz;
use App\Repositories\Contracts\QuizzRepositoryInterface;
use Exception;
use RuntimeException;

class EloquentQuizzRepository extends EloquentBaseRepository implements QuizzRepositoryInterface
{
    protected $model = Quizz::class;

    public function create(array $data)
    {
        $createdQuizz = parent::create($data);
        return new QuizzEloquentEntity($createdQuizz);  
    }

    public function update(int $id, array $data)
    {
        if(!parent::update($id,$data))
            throw new RuntimeException('quiz not updated'); 
        
        return new QuizzEloquentEntity(parent::find($id));
    }
} 