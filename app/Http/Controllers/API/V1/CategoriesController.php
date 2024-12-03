<?php
namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\Contracts\APIController;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class CategoriesController extends APIController
{
    private $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string',
            'slug' => 'required|string',
            
        ]);
        $createdCategory = $this->categoryRepository->create([
            'name' => $request->name,
           'slug' => $request->slug,
        ]);
        return $this->respondCreated('دسته بندی با موفقیت ایجاد شد',[
            'name'=>$createdCategory->getName(),
            'slug'=>$createdCategory->getSlug(),
        ]);
    }

    public function delete(Request $request)
    {
        $this->validate($request,[
            'id' =>'required|integer',
        ]);
        $deletedCategory = $this->categoryRepository->delete($request->id);
        if(!$this->categoryRepository->find($request->id))
            return $this->respondNotFount('دسته بندی با این ایدی یافت نشد ');
        if($deletedCategory){
            return $this->respondSuccess('دسته بندی با موفقیت حذف شد',[]);
        }
        return $this->respondNotFount('دسته بندی یافت نشد');
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'id' =>'required|integer',
            'name' =>'required|string',
           'slug' =>'required|string',
        ]);
        try{
        $updateCategory = $this->categoryRepository->update($request->id,[
            'name' => $request->name,
           'slug' => $request->slug,
        ]); 
        }catch(Exception $e){
            return $this->respondInternalError('دسته بندی بروزرسانی نشد');
        }       
        return $this->respondSuccess('کتگوری با موفقیت اپدیت شد',[
            'name'=>$updateCategory->getName(),
            'slug'=>$updateCategory->getSlug(),
        ]);
    }
}
