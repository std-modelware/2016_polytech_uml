<?php

class HeaderVM
{
    public $activeItem; // "Agent", "Author"
    public $personEmail;
}

class TaskInfoVM
{
    public $taskId;
    public $accountList;

    public function __construct()
    {
        $this->accountList = array();
    }
//    public $taskTitle;
//    public $taskDate;
//    public $taskStateId; // Author: 10 - pause, 11 - play, 12 - close, Agent: 20 - pause, 21 - play
//    public $agentId;
//    public $agentEmail;
//    public $authorId;
//    public $authorEmail;
}

//class TaskFormVM
//{
//    public $taskId;
//
//    public $taskInfoVM; // TaskInfo
//    public $taskFormStateVM;
//    public $taskFormNoteVM;
//
//    public function __construct()
//    {
//        $this->taskInfoVM = new TaskInfoVM();
//        $this->taskFormStateVM = new TaskFormStateVM();
//        $this->taskFormNoteVM = new TaskFormNoteVM();
//    }
//}
//
//class TaskFormStateVM
//{
//    public $taskId;
//
//    public $taskStateListVM; // TaskState
//
//    public function __construct()
//    {
//        $this->taskStateListVM = array();
//    }
//}
//
//class TaskFormNoteVM
//{
//    public $taskId;
//
//    public $taskNoteListVM; // TaskNote
//
//    public function __construct()
//    {
//        $this->taskNoteListVM = array();
//    }
//}



//
//class TaskStateVM
//{
//    public $taskId;
//    public $taskStateChangeDate;
//    public $taskPersonId; // who
//    public $taskPersonEmail;
//    public $taskStateId; // Author: 10 - pause, 11 - play, 12 - close, Agent: 20 - pause, 21 - play
//}
//
//class TaskNoteVM
//{
//    public $taskId;
//    public $taskNoteAddDate;
//    public $taskPersonId; // who
//    public $taskPersonEmail;
//    public $taskNote;
//}
