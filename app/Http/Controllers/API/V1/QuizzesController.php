<?php
namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\Contracts\APIController;
use App\Repositories\Contracts\QuizzRepositoryInterface;
use Carbon\Carbon;
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
            'start_date'=>'date',
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
}