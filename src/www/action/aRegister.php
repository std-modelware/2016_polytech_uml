<?php

require_once(dirname(__FILE__) . "/../shared/Session.php");
require_once(dirname(__FILE__) . "/../shared/services/Services.php");
require_once(dirname(__FILE__) . "/../shared/SmartyManager.php");
require_once(dirname(__FILE__) . "/../viewModel/StartVM.php");

// TODO: Получить данные из request и проверить их

$email = $_POST["email"];
$password = $_POST["password"];

$res = Services::getInstance()->checkAccountWithEmail($email);

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
    $accountChecker = $res->result["data"][0];

    if ($accountChecker->count === "0") {

        $res = Services::getInstance()->registerAccountWithEmailAndPassword($email, $password);

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
            $account = $res->result["data"];

            // DO: Заполнить сессию
            $accountSessionData = new AccountSessionData();
            $accountSessionData->id = $account->id;
            $accountSessionData->email = $account->email;

            Session::getInstance()->setValueByKey(AccountSessionData::KEY, $accountSessionData);

            $result = array(
                "RedirectUrl" => "author.php",
            );
        }
    } else {

        $startFormVM = new StartFormVM();
        $startFormVM->email = $email;
        $startFormVM->message = "Пользователь с таким email уже существует";

        $smarty->assign("startFormVM", $startFormVM);

        $result = array(
            "Views" => array(
                array(
                    "Selector" => "#StartForm",
                    "Html" => $smarty->fetch("../view/start/wStartForm.tpl")
                ),
            ));
    }
}

header('Content-Type: application/json');
echo json_encode($result);
