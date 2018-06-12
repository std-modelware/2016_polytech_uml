<?php

require_once(dirname(__FILE__) . "/../shared/Session.php");
require_once(dirname(__FILE__) . "/../shared/services/Services.php");
require_once(dirname(__FILE__) . "/../shared/SmartyManager.php");
require_once(dirname(__FILE__) . "/../viewModel/StartVM.php");

// TODO: Получить данные из request и проверить их

$email = $_POST["email"];
$password = $_POST["password"];

$res = Services::getInstance()->getAccountByEmailAndPassword($email, $password);

$smarty = SmartyManager::GetInstance();

if ($res->hasError) {
    Session::getInstance()->reset();

    $startFormVM = new StartFormVM();
    $startFormVM->email = $email;
    $startFormVM->message = $res->errorMessage;

    $smarty->assign("startFormVM", $startFormVM);

    $result = array(
        "Views" => array(
            array(
                "Selector" => "#StartForm",
                "Html" => $smarty->fetch("../view/start/wStartForm.tpl")
            ),
        ));
    
} else {
    if ($res->result["rows"] === 1) {

        $account = $res->result["data"][0];

        // DO: Заполнить сессию
        $accountSessionData = new AccountSessionData();
        $accountSessionData->id = $account->id;
        $accountSessionData->email = $account->email;

        Session::getInstance()->setValueByKey(AccountSessionData::KEY, $accountSessionData);

        $result = array(
            "RedirectUrl" => "author.php",
        );

    } else if ($res->result["rows"] === 0) {

        $startFormVM = new StartFormVM();
        $startFormVM->email = $email;
        $startFormVM->message = "Неверно введено имя пользователя или пароль";

        $smarty->assign("startFormVM", $startFormVM);

        $result = array(
            "Views" => array(
                array(
                    "Selector" => "#StartForm",
                    "Html" => $smarty->fetch("../view/start/wStartForm.tpl")
                ),
            ));
    } else {
        // TODO: Окно обращения по почте с возникшей проблемой

        Session::getInstance()->reset();

        $result = array(
            "RedirectUrl" => "start.php",
        );
    }

    header('Content-Type: application/json');
    echo json_encode($result);
}
