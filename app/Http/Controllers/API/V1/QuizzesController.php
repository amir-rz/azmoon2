<?php
namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\Contracts\APIController;
use App\Repositories\Contracts\QuizzRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class QuizzesController extends APIController
{
    private $quizRepository;
    public function __construct(QuizzRepositoryInterface $quizRepository)
    {
        $this->quizRepository = $quizRepository;
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'category_id'=>'required|string',
            'title'=>'required|string',
            'description'=>'required|string',
            'start_date'=>'required|date',
            'duration'=>'required|date',
        ]);
        $startDate = Carbon::parse($request->start_date);
        $duration = Carbon::parse($request->duration);
        $createdQuiz = $this->quizRepository->create([
            'category_id'=> $request->category_id,
            'title'=> $request->title,
            'description'=> $request->description,
           'start_date'=> $startDate->format('Y-m-d'),  
           'duration'=> $request->duration,
        ]);
        if(!$createdQuiz)
            return $this->respondInternalError('failed');
        return $this->respondCreated('زمون با موفقیت ایجاد شد',[
            'categery_id'=>$createdQuiz->getCategoryId(),
            'title'=>$createdQuiz->getTitle(),
            'description'=>$createdQuiz->getDescription(),
            'start_date'=>$createdQuiz->getStartDate(),
            'duration'=>Carbon::parse($createdQuiz->getDuration()),
        ]); 
    }

    public function delete(Request $request)
    {
        $this->validate($request,[
            'id'=>'required|numeric',
        ]);
        if(!$this->quizRepository->find($request->id))
            return $this->respondNotFount('ازمون یافت نشد');
        if(!$this->quizRepository->delete($request->id))
            $this->respondInternalError('خطایی رخ داده است');
        return $this->respondSuccess('ازمون با موفقیت حذف شد',[]);
    }

    public function index(Request $request)
    {
        $this->validate($request,[
            'search' =>'nullable|string',
            'page'=> 'required|integer',
            'pagesiz'=>'nullable|integer',
        ]);
        $quizzes = $this->quizRepository->paginate($request->search, $request->page, $request->pagesiz??10,['title','description']);
        dd($quizzes );
        return $this->respondSuccess('ازمون ها',$quizzes);
    }

    public function update(Request $request)
    {
        $startDate = Carbon::parse($request->start_date);

        $this->validate($request,[
            'id'=>'required|numeric',
           // 'category_id'=>'|string',
            'title'=>'required|string',
            'description'=>'required|string',
           'start_date'=>'date|required',
           'duration'=>'date|required',
        ]);

        try{
        $updatedQuiz = $this->quizRepository->update($request->id,[
            //'category_id'=> 5,
            'title'=> $request->title,
            'description'=> $request->description,
           'start_date'=> $startDate->format('Y-m-d'),  
           'duration'=> $request->duration,
        ]);
         }catch(Exception $e)
         {
            return $this->respondInternalError('sddf');
         }
        return $this->respondSuccess('ازمون با موفقیت به روزرسانی شد',[
            //'categery_id'=>$updatedQuiz->getCategoryId(),
            'title'=>$updatedQuiz->getTitle(),
            'description'=>$updatedQuiz->getDescription(),
            'start_date'=>$updatedQuiz->getStartDate(),
            'duration'=>Carbon::parse($updatedQuiz->getDuration()),
        ]);
    }
}