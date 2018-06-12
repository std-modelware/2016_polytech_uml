<?php

interface ITask
{
    public function createTask($tasktitle, $taskdescription, $taskdate, $taskagent, $taskauthor);
    public function getTaskList($taskauthor);
}

class Task
{
    public $id;
    public $title;
    public $description;
    public $date;
    public $agent_id;
    public $agent_email;
}