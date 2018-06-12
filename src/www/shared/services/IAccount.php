<?php

interface IAccount
{
    public function getAccountByEmailAndPassword($email, $pass);
    public function checkAccountWithEmail($email);
    public function registerAccountWithEmailAndPassword($email, $pass);
    public function getAccountList();
}

// Account info
class Account
{
    public $id;
    public $email;
}

// Account's Count with special email
class AccountChecker
{
    public $count;
}