<?php

namespace App\Http\Controllers\Apis\V1;

use App\Classes\MakeResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
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

    public function store(StoreTaskRequest $request)
    {
        try{
            $data = $this->taskRepository->createNewTask($request);
            return  MakeResponse::successResponse("New Task created successfully", 200, $data);

        }catch(Exception $exception){
            Log::error("create new task error : " . json_encode($exception->getMessage()) ." User detail:" . auth()->user() . " trace : " . json_encode($exception->getTrace()));
            return MakeResponse::errorResponse();
        }
    }

    public function show($id)
    {
        try{
            $data = $this->taskRepository->gettaskById($id);
            return  MakeResponse::successResponse("Task data retrieved successfully", 200, $data);

        }catch(Exception $exception){
            Log::error("get task by id error : " . json_encode($exception->getMessage()) ." User detail:" . auth()->user() . " trace : " . json_encode($exception->getTrace()));
            return MakeResponse::errorResponse();
        }
    }

    public function update(StoreTaskRequest $request, $id)
    {
        try{
            $data = $this->taskRepository->updateTask($id, $request);
            return  MakeResponse::successResponse("Task update successfully", 200, $data);

        }catch(Exception $exception){
            Log::error("task update error : " . json_encode($exception->getMessage()) ." User detail:" . auth()->user() . " trace : " . json_encode($exception->getTrace()));
            return MakeResponse::errorResponse();
        }
    }

    public function destroy($id)
    {
        try{
            $data = $this->taskRepository->deleteTask($id);
            return  MakeResponse::successResponse("Item deleted successfully", 200, $data);

        }catch(Exception $exception){
            Log::error("task delete error : " . json_encode($exception->getMessage()) ." User detail:" . auth()->user() . " trace : " . json_encode($exception->getTrace()));
            return MakeResponse::errorResponse();
        }
    }
}
