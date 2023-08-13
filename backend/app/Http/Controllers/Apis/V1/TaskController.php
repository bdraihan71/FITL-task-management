<?php

namespace App\Http\Controllers\Apis\V1;

use App\Classes\MakeResponse;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(
        protected TaskRepositoryInterface $taskRepository
    ){}

    public function index()
    {
        try{
            $data = $this->taskRepository->getAllTask();
            return  MakeResponse::successResponse("Task data retrieved successfully", 200, $data);

        }catch(Exception $exception){
            Log::error("get all task error : " . json_encode($exception->getMessage()) ." User detail:" . auth()->user() . " trace : " . json_encode($exception->getTrace()));
            return MakeResponse::errorResponse();
        }
    }

    public function store()
    {

    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
