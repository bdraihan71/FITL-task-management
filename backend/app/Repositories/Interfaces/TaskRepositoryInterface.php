<?php

namespace App\Repositories\Interfaces;

interface TaskRepositoryInterface
{
    public function getAllTask();
    public function createNewTask($request);
    public function deleteTask($taskId);
}