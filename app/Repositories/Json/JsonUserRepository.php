<?php
namespace App\Repositories\Json;

use App\Entities\User\UserEntity;
use App\Entities\User\UserJsonEntity;
use App\Repositories\Contracts\UserRepositoryInterface;

class JsonUserRepository extends JsonBaseRepository implements UserRepositoryInterface
{
    protected $repository = 'user.json';

    public function create(array $data):UserEntity
    {
        $newUser = parent::create($data);
        return new UserJsonEntity($data);
    }

    public function find(int $id):UserEntity
    {
        $user = parent::find($id);
        return new UserJsonEntity($user);
    }
}
