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
            ],
        ]);
    }
        public function test_if_throw_a_exeption_if_we_dont_senf_parameters()
        {
            $responce = $this->call('post', 'api/v1/users',[]);
            $this->assertEquals(422,$responce->status());
        }

        public function test_shour_update_user()
        {
            $responce = $this->call('put','api/v1/users' , [
                'id'=>1,
                'full_name' => 'amir updated',
                'email' => 'amirrezaei@gmail.com',
                'mobile' => '09220847545',
                'password' => '123456',
            ]);
            $this->assertEquals(200,$responce->status());
            $this->seeJsonStructure([
                'success',
                'message',
                'data' => [
                    'full_name',
                    'email',
                    'mobile',
                ],
            ]);

        }
        public function test_if_throw_a_exeption_if_we_dont_senf_parameters_to_update_info()
        {
            $responce = $this->call('put', 'api/v1/users',[]);
            $this->assertEquals(422,$responce->status());
        }

        public function test_should_update_password()
        {
            $responce = $this->call('put','api/v1/users/change-password' , [
                'id'=>13,
                'password' => '123456',
                'password_repeat' => '123456',
            ]);
            $this->assertEquals(200,$responce->status());
            $this->seeJsonStructure([
                'success',
                'message',
                'data' => [
                    'full_name',
                    'email',
                    'mobile',
                ],
            ]);
        }
    }
