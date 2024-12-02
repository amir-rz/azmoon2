<?php
namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\Contracts\APIController;
use App\Repositories\Contracts\CategoryRepositoryInterface;
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
}
