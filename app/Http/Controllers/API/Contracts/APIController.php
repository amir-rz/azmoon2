<?php
namespace App\Http\Controllers\API\Contracts;

use App\Http\Controllers\Controller;
use Dotenv\Util\Str;
use PhpParser\Node\Expr\Cast\String_;
use PhpParser\Node\Stmt\Return_;

class APIController extends Controller
{
    protected $statusCode;
    public function respondSuccess(String $message , array $data)
    {
        return $this->setStatusCode(200)->respond($message, true, $data);
    } 
    public function respondCreated(String $message , array $data)
    {
        return $this->setStatusCode(201)->respond($message, true, $data);
    }
    public function respondNotFount(String $message)
    {
        return $this->setStatusCode(404)->respond($message, false);
    }
    private function respond(string $message,bool $isSuccess, array $data=null)
    {
        $responceData = [
            'success' => $isSuccess,
            'message' => $message,
            'data' => $data
        ];
        return response()->json($responceData)->setStatusCode($this->getStatusCode()); 
    }  

    private function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }
    private function getStatusCode()
    {
            return $this->statusCode;
    }
}