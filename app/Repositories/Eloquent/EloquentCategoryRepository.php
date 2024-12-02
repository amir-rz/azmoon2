<?php
namespace App\Repositories\Eloquent;

use App\Entities\Category\CategoryEloquentEntity;
use App\Entities\Category\CategoryEntity;
use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class EloquentCategoryRepository extends EloquentBaseRepository implements CategoryRepositoryInterface
{
    protected $model = Category::class;

    public function create(array $data):CategoryEntity
    {
        $createdCategoty= parent::create($data);
        return new CategoryEloquentEntity($createdCategoty);
    }
  
}