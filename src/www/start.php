<?php
require_once("./shared/SmartyManager.php");
require_once("./shared/Session.php");
require_once("./viewModel/StartVM.php");

Session::getInstance()->reset();

$startVM = new StartVM();
//$startVM->startFormVM->email = "email";
//$startVM->startFormVM->message = "message login";

$smarty = SmartyManager::GetInstance();
$smarty->assign("startVM", $startVM);
$smarty->display("view/pStart.tpl");