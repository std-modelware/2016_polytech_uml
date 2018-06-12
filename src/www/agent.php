<?php
require_once("./shared/SmartyManager.php");
require_once("./shared/Session.php");
require_once("./viewModel/AgentVM.php");

$accountSessionData = Session::getInstance()->getValueByKey(AccountSessionData::KEY);

if ($accountSessionData == null)
{
    header('Location: start.php');
    return;
}

$agentVM = new AgentTaskListVM();
$agentVM->headerVM->activeItem = "Agent";
$agentVM->headerVM->personEmail = $accountSessionData->email;

$t1 = new TaskInfoVM();
$t1->taskId = 11;
$t1->taskTitle = "Задача 11";
$t1->taskDate = "2016-01-01";
$t1->taskStateId = 20; // Author: 10 - pause, 11 - play, 12 - close, Agent: 20 - pause, 21 - play
$t1->agentId = 1;
$t1->agentEmail = "a@b.c";

$t2 = new TaskInfoVM();
$t2->taskId = 21;
$t2->taskTitle = "Задача 21";
$t2->taskDate = "2016-01-01";
$t2->taskStateId = 21; // Author: 10 - pause, 11 - play, 12 - close, Agent: 20 - pause, 21 - play
$t2->agentId = 1;
$t2->agentEmail= "a@b.c";

$agentVM->agentTaskListVM[] = $t1;
$agentVM->agentTaskListVM[] = $t2;

$smarty = SmartyManager::GetInstance();
$smarty->assign("agentVM", $agentVM);
$smarty->display("view/pAgent.tpl");