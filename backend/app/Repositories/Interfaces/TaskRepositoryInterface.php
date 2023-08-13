<?php

namespace App\Repositories\Interfaces;

interface TaskRepositoryInterface
{
    public function getAllTask();
    public function createNewTask($request);
    public function gettaskById($taskId);
    public function updateTask($taskId, $newDetails);
    public function deleteTask($taskId);
    public function callTaskEvent($task);
}