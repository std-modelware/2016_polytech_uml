<?php
require_once(dirname(__FILE__) . "/SharedVM.php");


class AuthorTaskListVM
{
    public $authorTaskListVM; // TaskInfo from shared
    public $headerVM; // Header from shared

    public function __construct()
    {
        $this->authorTaskListVM= array();
        $this->headerVM = new HeaderVM();
    }
}

class NewTaskFormVM
{
    public $taskInfoVM;

    public function __construct()
    {
        $this->taskInfoVM = new TaskInfoVM();
    }
}