<?php
namespace API\V1\Users;

use Tests\TestCase;

class UserTest extends TestCase
{
    #--------------------CREATE USER---------------------------------#
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
     #--------------------Update USER----------------------------#   
        // public function test_shour_update_user()
        // {
        //     $responce = $this->call('put','api/v1/users' , [
        //         'id'=>1,
        //         'full_name' => 'amir updated',
        //         'email' => 'amirrezaei@gmail.com',
        //         'mobile' => '09220847545',
        //         'password' => '123456',
        //     ]);
        //     $this->assertEquals(200,$responce->status());
        //     $this->seeJsonStructure([
        //         'success',
        //         'message',
        //         'data' => [
        //             'full_name',
        //             'email',
        //             'mobile',
        //         ],
        //     ]);

        // }
        // public function test_if_throw_a_exeption_if_we_dont_senf_parameters_to_update_info()
        // {
        //     $responce = $this->call('put', 'api/v1/users',[]);
        //     $this->assertEquals(422,$responce->status());
        // }
        #--------------------UPDATE Password----------------------------#

        // public function test_should_update_password()
        // {
        //     $responce = $this->call('put','api/v1/users/change-password' , [
        //         'id'=>13,
        //         'password' => '123456',
        //         'password_repeat' => '123456',
        //     ]);
        //     $this->assertEquals(200,$responce->status());
        //     $this->seeJsonStructure([
        //         'success',
        //         'message',
        //         'data' => [
        //             'full_name',
        //             'email',
        //             'mobile',
        //         ],
        //     ]);
        // }

        #---------------------DELETE USER--------------------------------#
        // public function test_should_delete_user()
        // {
        //     $responce = $this->call('delete','api/v1/users',[
        //         'id'=>1,
        //     ]);
        //     $this->assertEquals(200,$responce->status());
        //     $this->seeJsonStructure([
        //         'success',
        //         'message',
        //         'data',
        //     ]); 
        // }
        #---------------------READ USER-----------------------------------#
        // public function test_should_read_user()
        // {
        //     $pagesize = 3;
        //     $userEmail = 'amirrezaei@gmail.com';
        //     $responce = $this->call('get','api/v1/users',[
        //         'search'=> $userEmail,
        //         'page'=>1,
        //         'pagesize'=> $pagesize
        //     ]);
        //     $data = json_decode($responce->getContent(),true);
        //     $this->assertEquals($data['data']['email'],$userEmail);
        //     $this->assertEquals(200,$responce->status());
        //     $this->seeJsonStructure([
        //         'success',
        //         'message',
        //         'data',
        //     ]);
        // }
    }
