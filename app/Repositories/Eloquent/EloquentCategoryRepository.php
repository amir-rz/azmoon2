<?php
namespace App\Repositories\Eloquent;

use App\Entities\Category\CategoryEloquentEntity;
use App\Entities\Category\CategoryEntity;
use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use RuntimeException;

class EloquentCategoryRepository extends EloquentBaseRepository implements CategoryRepositoryInterface
{
    protected $model = Category::class;

    public function create(array $data):CategoryEntity
    {
        $createdCategoty= parent::create($data);
        return new CategoryEloquentEntity($createdCategoty);
    }
  
    public function update(int $id, array $data): CategoryEntity
    {
        if(!parent::update($id, $data))
            throw new RuntimeException('category not updated');
        return new CategoryEloquentEntity(parent::find($id));
    }
}