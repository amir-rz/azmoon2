<?php
namespace API\V1\Users;

use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_should_be_created()
    {
        $responce = $this->call('post','api/v1/users' , [
            'full_name' => 'amir rezaei',
            'email' => 'amirrezaei@gmail.com',
            'mobile' => '09220847545',
            'password' => '123456',
        ]);
        $this->assertEquals(201,$responce->status());
        $this->seeJsonStructure([
            'success',
            'message',
            'data' => [
                'full_name',
                'email',
                'mobile',
                'password',
            ],
        ]);
    }
        public function test_if_throw_a_exeption()
        {
            $responce = $this->call('POST', 'api/v1/users',[]);
            $this->assertEquals(422,$responce->status());
        }
    }
