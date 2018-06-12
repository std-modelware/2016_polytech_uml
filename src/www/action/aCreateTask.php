<?php

require_once(dirname(__FILE__) . "/../shared/Session.php");
require_once(dirname(__FILE__) . "/../shared/services/Services.php");
require_once(dirname(__FILE__) . "/../shared/SmartyManager.php");

$accountSessionData = Session::getInstance()->getValueByKey(AccountSessionData::KEY);

if ($accountSessionData == null)
{
    header('Location: start.php');
    return;
}

$tasktitle = $_POST["tasktitle"];
$taskdescription = $_POST["taskdescription"];
$taskdate = $_POST["taskdate"];
$taskagent = $_POST["taskagent"];
$taskauthor = $accountSessionData->id;

$res = Services::getInstance()->createTask($tasktitle, $taskdescription, $taskdate, $taskagent, $taskauthor);

if ($res->hasError) {

} else {
    $result = array(
        "RedirectUrl" => "author.php",
    );

    header('Content-Type: application/json');
    echo json_encode($result);
}