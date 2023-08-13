<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class TaskRepository implements TaskRepositoryInterface
{
    public function getAllTask()
    {
        try{
            $authUserId = auth()->user()->id;

            $results = Task::where(function ($query) use ($authUserId) {
                $query->where('created_for', $authUserId);
            })->orWhere(function ($query) use ($authUserId) {
                $query->whereNull('created_for')->where('created_by', $authUserId);   // If created_for is null, then check created_by to matches the auth user id
            })->get()
            ->map
            ->format();

            return $results;

        }catch(Exception $exception){
            Log::error("getAllTask error : " . json_encode($exception->getMessage()) ." User detail:" . auth()->user() . " trace : " . json_encode($exception->getTrace()));
            throw new Exception($exception->getMessage());
        }
    }

    public function createNewTask($request)
    {
        try{
            $task  = Task::create([
                'title' => $request['title'],
                'description' => $request['description'],
                'deadline' => $request['deadline'],
                'created_by' => auth()->user()->id,
                'created_for' => $request['created_for'],
            ]);

            return $task;

        }catch(Exception $exception){
            Log::error("create new task error : " . json_encode($exception->getMessage()) ." User detail:" . auth()->user() . " trace : " . json_encode($exception->getTrace()));
            throw new Exception($exception->getMessage());
        }
    }

    public function gettaskById($taskId)
    {
        try{
            $task = Task::findOrFail($taskId);
            return $task;

        }catch(Exception $exception){
            Log::error("get task by id error : " . json_encode($exception->getMessage()) ." User detail:" . auth()->user() . " trace : " . json_encode($exception->getTrace()));
            throw new Exception($exception->getMessage());
        }
    }

    public function updateTask($taskId, $newDetails)
    {
        try{
            $task = Task::findOrFail($taskId);

            $task->title = $newDetails['title'];
            $task->description = $newDetails['description'];
            $task->deadline = $newDetails['deadline'];
            $task->created_by = $newDetails['created_by'];
            $task->created_for = $newDetails['created_for'];
            $task->save();

            return $task;

        }catch(Exception $exception){
            Log::error("task update error : " . json_encode($exception->getMessage()) ." User detail:" . auth()->user() . " trace : " . json_encode($exception->getTrace()));
            throw new Exception($exception->getMessage());
        }
    }

    public function deleteTask($taskId)
    {
        try{
            $task = Task::findOrFail($taskId);
            $task->delete();
            return $task;

        }catch(Exception $exception){
            Log::error("task delete error : " . json_encode($exception->getMessage()) ." User detail:" . auth()->user() . " trace : " . json_encode($exception->getTrace()));
            throw new Exception($exception->getMessage());
        }
    }
}