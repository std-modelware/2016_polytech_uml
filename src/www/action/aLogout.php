<?php

require_once(dirname(__FILE__) . "/../shared/Session.php");

Session::getInstance()->reset();

$result = array(
    "RedirectUrl" => "start.php",
);

header('Content-Type: application/json');
echo json_encode($result);