<?php
class StartVM
{
    public $startFormVM;

    public function __construct()
    {
        $this->startFormVM = new StartFormVM();
    }
}

class StartFormVM
{
    public $email;
//    public $password; !!! не часть ViewModel
    public $message;
}