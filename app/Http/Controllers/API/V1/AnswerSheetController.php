<?php
namespace App\Http\Controllers\API\V1;
use App\Http\Controllers\API\Contracts\APIController;
use App\Repositories\Contracts\AnswerSheetRepositoryInterface;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class AnswerSheetController extends APIController
{
    public function __construct(private AnswerSheetRepositoryInterface $answerSheet)
    {
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'quiz_id' => 'required|integer',
            'answers'=>'required|json',
            'status' => 'required|numeric',
            'score'=>'required|numeric',
            'finished_at' => 'required|date',
        ]);

        $answers = $this->answerSheet->create([
            'quiz_id' => $request->quiz_id,
            'answers' => $request->answers,
           'status' => $request->status,
           'score' => $request->score,
            'finished_at' => $request->finished_at,
        ]);
        if(!$answers)
            return $this->respondInternalError('something went wrong');
        return $this->respondSuccess('جواب ها با موفقیت ثبت شدند',[
            'id' => $answers->getId(),
            'quiz_id' => $answers->getQuizId(),
            'answers' => $answers->getAnswers(),
           'status' => $answers->getStatus(),
           'score' => $answers->getScore(),
            'finished_at' => $answers->getFinishedAt(),
        ]);
    }

    public function delete(Request $request)
    {
        $this->validate($request,[
            'id' =>'required|integer',
        ]);
        if(!$this->answerSheet->find($request->id))
            return $this->respondNotFount('پاسخ نامه با این ایدی پیدا نشد');
        if(!$this->answerSheet->delete($request->id))
            return $this->respondInternalError('حظایی رخ داده است');
        return $this->respondSuccess('پاسخ نامه با موفقیت حذف شد',[]);
    }

    public function index(Request $request)
    {
        $this->validate($request,[
            'search'=>'nullable|string',
            'page'=>'required|integer',
            'pagesize'=>'nullable|integer',
        ]);
        $answerSheet = $this->answerSheet->paginate($request->search, $request->page, $request->page,['quiz_id','answers','status','score']);
        return $this->respondSuccess('جواب‌های پا��خ‌نامه', $answerSheet);
    }

}