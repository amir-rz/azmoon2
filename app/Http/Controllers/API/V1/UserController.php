<?php
namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserController extends Controller
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
        
    }
    public function store()
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'User has been created successfully',
                'data' =>[
                    'full_name' => 'amir rezaei',
                    'email' => 'amirrezaei7545@gmail.com',
                    'mobile' => '09220847545',
                    'password' => '123456',
                ],
            ]
            );
    }
}