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
        $newUser = $this->userRepository->create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => app('hash')->make($request->password),
    
        ]);
        return $this->respondCreated('کاربر با موفقیت ایجاد شد',[
            'full_name' => $newUser->getFullName(),
            'email' => $newUser->getEmail(),
            'mobile' => $newUser->getMobile(),
            'password' => $newUser->getPassword(),
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

    public function updatePassword(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
            'password'=>'required|required_with:password_repeat|same:password_repeat',
            'password_repeat'=>'required',
        ]);
        $this->userRepository->update($request->id,[
            'password' => app('hash')->make($request->password),
        ]);
        return $this->respondSuccess('Password updated successfully',[
            'full_name' => $request->full_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ]);
    }
    public function delete(Request $request)
    {
        $this->validate($request,[
            'id'=>'required',
        ]);
        $this->userRepository->delete($request->id);
        // $user = $this->userRepository->find($request->id);
        // dd($user->getId());
        return $this->respondSuccess('کاربر با موفقیت حذف شد',[]);
    }
    public function index(Request $request)
    {
        $this->validate($request,[
            'search'=> 'nullable|string',
            'page'=>'required|numeric',
            'pagesize'=>'nullable|numeric',
        ]);
        $users = $this->userRepository->paginate($request->search, $request->page, $request->pagesize??20);
        return $this->respondSuccess('کاربران', $users);
    }
    
}