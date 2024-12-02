<?php
namespace App\Repositories\Eloquent;

use App\Entities\User\UserEloquentEntity;
use App\Entities\User\UserEntity;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class EloquentUserRepository extends EloquentBaseRepository implements UserRepositoryInterface
{
    protected $model = User::class;

    public function create(array $data):UserEntity
    {
        $newUser = parent::create($data);
        return new UserEloquentEntity($newUser);
    }
    public function find(int $id):UserEntity
    {
        $user = parent::find($id);
        if($user){
            return new UserEloquentEntity($user);
        }
        return null;
    }
    public function update(int $id, array $data):UserEntity
    {
        if(!parent::update($id, $data))
            return new UserEloquentEntity(null);
        return new UserEloquentEntity(parent::find($id));
    }
}