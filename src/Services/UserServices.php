<?php

namespace App\Services;

use App\MicroServices\TasksMicroServices;

class UserServices
{
    private TasksMicroServices $tasks;

    public function __construct(TasksMicroServices $tasksMicroServices)
    {
        $this->tasks = $tasksMicroServices;
    }

    /**
     * @return TasksMicroServices
     */
    public function getTasks(): TasksMicroServices
    {
        return $this->tasks;
    }
}