<?php

require_once(dirname(__FILE__) . "/../3rd/smarty/Smarty.class.php");
require_once dirname(__FILE__) . "/../3rd/log4php/Logger.php";
require_once(dirname(__FILE__) . "/model.php");
require_once(dirname(__FILE__) . "/utils.php");

Logger::configure(dirname(__FILE__) . '/log4php.xml');
$logger = Logger::getRootLogger();

$smarty = new Smarty;
$smarty->debugging = false;
$smarty->caching = false;

$logger->info("Start");

// Instance
// --------

// Parameter
$parameter_email = new Parameter("email");
$parameter_password = new Parameter("password");
$parameter_tasktitle = new Parameter("tasktitle");
$parameter_taskdescription = new Parameter("taskdescription");
$parameter_taskdate = new Parameter("taskdate");
$parameter_taskagent = new Parameter("taskagent");
$parameter_taskauthor = new Parameter("taskauthor");

// Operation
$operation_getAccountByEmailAndPassword = new Operation("getAccountByEmailAndPassword");
$operation_getAccountByEmailAndPassword->hasParameter($parameter_email);
$operation_getAccountByEmailAndPassword->hasParameter($parameter_password);

$operation_checkAccountWithEmail = new Operation("checkAccountWithEmail");
$operation_checkAccountWithEmail->hasParameter($parameter_email);

$operation_createTask = new Operation("createTask");
$operation_createTask->hasParameter($parameter_tasktitle);
$operation_createTask->hasParameter($parameter_taskdescription);
$operation_createTask->hasParameter($parameter_taskdate);
$operation_createTask->hasParameter($parameter_taskagent);
$operation_createTask->hasParameter($parameter_taskauthor);

// Action
$action_login = new Action("Login");
$action_login->hasParameter($parameter_email);
$action_login->hasParameter($parameter_password);
$action_login->callsOperation($operation_getAccountByEmailAndPassword);

$action_register = new Action("Register");
$action_register->hasParameter($parameter_email);
$action_register->hasParameter($parameter_password);
$action_register->callsOperation($operation_checkAccountWithEmail);

$action_createTask = new Action("CreateTask");
$action_createTask->hasParameter($parameter_tasktitle);
$action_createTask->hasParameter($parameter_taskdescription);
$action_createTask->hasParameter($parameter_taskdate);
$action_createTask->hasParameter($parameter_taskagent);
$action_createTask->callsOperation($operation_createTask);

$output_dir = "output/";
if (!file_exists($output_dir)) {
    mkdir($output_dir, 0777, true);
}

update_version_file($output_dir);

foreach (Model::$model["Action"] as $action) {
    create_file($output_dir, "action/", "a" . $action->name . ".php", process_template("artifacts/action.php"));
}