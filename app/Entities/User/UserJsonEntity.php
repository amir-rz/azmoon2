<?php
namespace App\Entities\User;
class UserJsonEntity implements UserEntity
{
    private $user;
    public function __construct(array|null $user)
    {
        $this->user = $user;
    }
    public function getFullName():string
    {
       return $this->user['full_name'];
    }
    public function getEmail():string
    {
        return $this->user['email'];

    }
    public function getMobile():string
    {
        return $this->user['mobile'];

    }
    public function getPassword():string
    {
       return $this->user['password'];
        
    }
    public function getId(): int
    {
       return $this->user['id'];
        
    }
}