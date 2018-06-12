<?php
require_once(dirname(__FILE__) . "/SharedVM.php");

class AgentTaskListVM
{
    public $agentTaskListVM; // TaskInfo from shared
    public $headerVM; // Header from shared

    public function __construct()
    {
        $this->agentTaskListVM = array();
        $this->headerVM = new HeaderVM();
    }
}