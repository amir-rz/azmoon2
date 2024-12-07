<?php
namespace App\Http\Controllers\API\V1;
use App\Http\Controllers\API\Contracts\APIController;
use App\Repositories\Contracts\AnswerSheetRepositoryInterface;
use Illuminate\Http\Request;

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
}