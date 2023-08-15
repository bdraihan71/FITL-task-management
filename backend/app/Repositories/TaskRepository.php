<?php

namespace App\Repositories;

use App\Events\TaskEvent;
use App\Models\Task;
use App\Models\User;
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
            $user = $this->findUserByEmail($request['created_for']);
            $task  = Task::create([
                'title' => $request['title'],
                'description' => $request['description'],
                'deadline' => $request['deadline'],
                'created_by' => auth()->user()->id,
                'created_for' => $user->id
            ]);

            if($task->created_for){
                $this->callTaskEvent($task);
            }
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
            $user = $this->findUserByEmail($newDetails['created_for']);
            $task = Task::findOrFail($taskId);
            $oldTask = $task->toArray();

            $task->title = $newDetails['title'];
            $task->description = $newDetails['description'];
            $task->status = $newDetails['status'];
            $task->deadline = $newDetails['deadline'];
            $task->created_for = $user->id;
            $task->save();

            if($task->created_for && $task->created_for != $oldTask['created_for']) //only mail natification for new assign user
            {
                $this->callTaskEvent($task);
            }

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

    public function findUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function callTaskEvent($task)
    {
        $user = User::findOrFail($task->created_for);
        $data['created_by_email'] = auth()->user()->email;
        $data['created_by_name'] = auth()->user()->name;
        $data['title'] = $task->title;
        $data['description'] = $task->description;
        $data['deadline'] = $task->deadline;
        event(new TaskEvent($data, $user));
    }
}