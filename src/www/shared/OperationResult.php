<?php
class OperationResult
{
    public $result;
    public $hasError;
    public $errorMessage;

    public function good($result)
    {
        $this->result = $result;
        $this->hasError = false;
        return $this;
    }

    public function bad($errorMessage)
    {
        $this->hasError = true;
        $this->errorMessage = $errorMessage;
        return $this;
    }

}