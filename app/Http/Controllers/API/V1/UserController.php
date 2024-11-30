<?php
namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\Contracts\APIController;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends APIController
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
        
    }
    public function store(Request $request)
    {
        // Validate the incoming request
        $this->validate($request , [
            'full_name' =>'required|max:255',
            'email' =>'required|email|max:255',
            'mobile' =>'required|max:15',
            'password' =>'required|',
        ]);
        // Create a new user
        $this->userRepository->create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => app('hash')->make($request->password),
    
        ]);
        return $this->respondCreated('کاربر با موفقیت ایجاد شد',[
            'full_name' => $request->full_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => $request->password,
        ]);
        
    }

    public function updateInfo(Request $request)
    {
        $this->validate($request , [
            'id' => 'required',
            'full_name' =>'required|max:255',
            'email' =>'required|email|max:255',
            'mobile' =>'required|max:15',
        ]);
        #update user
        $this->userRepository->update($request->id,[ 
            'full_name' => $request->full_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => app('hash')->make($request->password),

    ]);
    return $this->respondSuccess('کاربر با موفقیت ویرایش شد',[
        'full_name' => $request->full_name,
        'email' => $request->email,
        'mobile' => $request->mobile,
    ]);

    }
}