<?php
namespace App\Entities\User;
interface UserEntity 
{
    public function getFullName():string;
    public function getEmail():string;
    public function getMobile():string;
    public function getPassword():string;
    public function getId():int;
 
}