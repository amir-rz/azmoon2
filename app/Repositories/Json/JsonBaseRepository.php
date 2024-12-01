<?php
namespace App\Repositories\Json;

use App\Repositories\Contracts\RepositoryInterface;

class JsonBaseRepository implements RepositoryInterface
{
    protected $repository = 'user.json';
    public function create(array $data)
    {
        if(file_exists($this->repository))
        { 
            $users = json_decode(file_get_contents($this->repository), true);
            $data['id'] = count($users) + 1;
            array_push($users, $data);
            file_put_contents($this->repository,json_encode($users,JSON_PRETTY_PRINT)); 

        }else{
            $users=[];
            $data['id'] = count($users) + 1;
            array_push($users, $data);
            file_put_contents($this->repository,json_encode($users,JSON_PRETTY_PRINT)); 
        }

    }
    public function find(int $id,array $data)
    {

    }
    public function update(int $id, array $data)
    {
        $users = json_decode( file_get_contents ($this->repository),true );
        foreach ($users as $key => $user) {
          if($user['id'] == $id)
          {
            $user['full_name'] = $data['full_name'] ?? $user['full_name'];
            $user['email'] = $data['email'] ?? $user['email'];
            $user['mobile'] = $data['mobile'] ?? $user['mobile'];
            $user['password'] = $data['password']?? $user['password'];

            unset($users[$key]);
            array_push($users,$user);
            if(file_exists($this->repository))
            unlink($this->repository);

            file_put_contents($this->repository,json_encode($users,JSON_PRETTY_PRINT)); 
            break;

          }
        }
    }
    public function delete(int $id)
    {   
        $users = json_decode( file_get_contents ($this->repository),true );
        foreach ($users as $key => $user) {
          if($user['id'] == $id)
          {
            unset($users[$key]);
            if(file_exists($this->repository))
            unlink($this->repository); 
          } 
          file_put_contents($this->repository,json_encode($users,JSON_PRETTY_PRINT));
          break;

        }
    }
    public function paginate(string $search = null,int $page,int $pagesize = 20)
    {
        $users = json_decode(file_get_contents(base_path('/').$this->repository),true);
        if(!is_null($search))
        {
            foreach($users as $key => $user)
            {
                if(array_search($search,$user))
                    return $users[$key];
            }
        }
        $totalRecords = count($users);
        $totalPages = ceil($totalRecords / $pagesize);
 
        if($page > $totalPages)
            $page = $totalRecords;
        if($page < 1)
            $page = 1;
        $offset = ($page - 1) * $pagesize;
        return array_slice($users, $offset, $pagesize);
    }
    public function deleteBy(array $where)
    {

    }
    public function all(array $where)
    {

    }
}