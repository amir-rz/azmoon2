<?php
namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\Contracts\APIController;
use App\Repositories\Contracts\QuestionRepositoryInterface;
use App\Repositories\Contracts\QuizzRepositoryInterface;
use Illuminate\Http\Request;

class QuestionController extends APIController
{
    private $questionRepository;
    public function __construct(QuestionRepositoryInterface $questionRepository,
    private QuizzRepositoryInterface $quizzRepositoryInterface)
    {
        $this->questionRepository = $questionRepository;
    }

    public function store(Request $request)
    {
        return;
        // dump(json_encode([
        //     1 => ['text'=>'dasdsad','is_correct'=>0],
        // ]));
        $this->validate($request,[
            'title' => 'required|string',
            'score'=>'required|numeric',
            'is_active'=>'required|numeric',
            'quiz_id' => 'required|numeric',
            'option' => 'required|json',
        ]);
        if(!$this->quizzRepositoryInterface->find($request->quiz_id))
            return $this->respondNotFount('Not Found');
        $question = $this->questionRepository->create([
            'title' => $request->title,
            'score'=>$request->score,
            'is_active'=>$request->is_active,
            'quiz_id' => $request->quiz_id,
            'option' => $request->options,
        ]);
        return $this->respondSuccess('سوال جدید با موفقیت ایجاد شد',[
            'title' => $question->getTitle(),
            'option' => $question->getOption(),
            'is_active' => $question->getIsActive(),
            'quiz_id' => $question->getQuizId(),
            'id' => $question->getId(),
            'score' => $question->getScore(),
        ]);
    }

    public function delete(Request $request)
    {
        $this->validate($request,[
            'id' =>'required|integer',
        ]);
        
        if(!$this->questionRepository->find($request->id))
        return $this->respondNotFount('سوالی پیدا نشد');
        $deletedQuestion = $this->questionRepository->delete($request->id);
        if($deletedQuestion){
            return $this->respondSuccess('سوال با موفقیت حذف شد',[]);
        }
        return $this->respondInternalError('خطا در عملیان');
    }
}