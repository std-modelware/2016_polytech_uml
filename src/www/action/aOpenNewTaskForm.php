<?php

require_once(dirname(__FILE__) . "/../shared/services/Services.php");
require_once(dirname(__FILE__) . "/../shared/SmartyManager.php");
require_once(dirname(__FILE__) . "/../viewModel/AuthorVM.php");

$smarty = SmartyManager::GetInstance();

$res = Services::getInstance()->getAccountList();

if ($res->hasError) {
}
else
{
    $newTaskFormVM = new NewTaskFormVM();
    $newTaskFormVM->taskInfoVM->accountList = $res->result["data"];
    $newTaskFormVM->taskInfoVM->taskId = 0;

    $smarty->assign("newTaskFormVM", $newTaskFormVM);

    $result = array(
        "ModalView" => array(
            "Selector" => "#NewTaskForm",
            "Html" => $smarty->fetch("../view/author/mNewTaskForm.tpl"),
        )
    );
}

header('Content-Type: application/json;charset=utf-8');
echo json_encode($result, JSON_UNESCAPED_UNICODE);

