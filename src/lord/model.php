<?php
class Model
{
    public static $model = array();
}

class Action
{
    // properties
    public $name;
    // relations
    public $parameters = array();
    public $operation;

    public function __construct($name)
    {
        $this->name = $name;
        Model::$model[get_class($this)][] = $this;
    }

    function hasParameter(Parameter $parameter)
    {
        $this->parameters[] = $parameter;
    }

    function callsOperation(Operation $operation)
    {
        $this->operation = $operation;
    }

}

class Operation
{
    // properties
    public $name;
    // relations
    public $parameters = array();

    public function __construct($name)
    {
        $this->name = $name;
        Model::$model[get_class($this)][] = $this;
    }

    function hasParameter(Parameter $parameter)
    {
        $this->parameters[] = $parameter;
    }
}

class Parameter
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
        Model::$model[get_class($this)][] = $this;
    }
}