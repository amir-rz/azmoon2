<?php
namespace App\Repositories\Json;

use App\Repositories\Contracts\RepositoryInterface;

class JsonBaseRepository implements RepositoryInterface
{
    public function create(array $data)
    {
        if(file_exists('user.json'))
        { 
            $users = json_decode(file_get_contents('user.json'), true);
            $data['id'] = count($users) + 1;
            array_push($users, $data);
            file_put_contents('user.json',json_encode($users)); 

        }else{
            $users=[];
            $data['id'] = count($users) + 1;
            array_push($users, $data);
            file_put_contents('user.json',json_encode($users)); 
        }

    }
    public function find(int $id,array $data)
    {

    }
    public function update(int $id, array $data)
    {

    }
    public function delete(array $where)
    {

    }
    public function all(array $where)
    {

    }
}