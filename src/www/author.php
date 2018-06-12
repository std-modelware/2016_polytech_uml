<?php
require_once("./shared/SmartyManager.php");
require_once("./shared/Session.php");
require_once("./shared/services/Services.php");
require_once("./viewModel/AuthorVM.php");

$accountSessionData = Session::getInstance()->getValueByKey(AccountSessionData::KEY);

if ($accountSessionData == null) {
    header('Location: start.php');
    return;
}

$authorVM = new AuthorTaskListVM();
$authorVM->headerVM->activeItem = "Author";
$authorVM->headerVM->personEmail = $accountSessionData->email;

$res = Services::getInstance()->getTaskList($accountSessionData->id);

if ($res->hasError) {
} else {
    $tasks = $res->result["data"];
    foreach ($tasks as $task) {
        $t = new TaskInfoVM();
        $t->taskId = $task->id;
        $t->taskTitle = $task->title;
        $t->taskDate = $task->date;
        $t->taskStateId = 10; // Author: 10 - pause, 11 - play, 12 - close, Agent: 20 - pause, 21 - play
        $t->agentId = $task->agent_id;
        $t->agentEmail = $task->agent_email;

        $authorVM->authorTaskListVM[] = $t;
    }
}


$smarty = SmartyManager::GetInstance();
$smarty->assign("authorVM", $authorVM);
$smarty->display("view/pAuthor.tpl");