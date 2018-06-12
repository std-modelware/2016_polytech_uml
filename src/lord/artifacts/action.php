<?php
echo "<?php" . PHP_EOL;
global $action;
?>

require_once(dirname(__FILE__) . "/../shared/Session.php");
require_once(dirname(__FILE__) . "/../shared/services/Services.php");
require_once(dirname(__FILE__) . "/../shared/SmartyManager.php");

<?php
foreach ($action->parameters as $parameter) {
?>
$<?php echo $parameter->name?> = $_POST["<?php echo $parameter->name?>"];
<?php
} // foreach
?>

<?php
if ($action->operation != null) {
    $operationParameterList = array();
    foreach ($action->operation->parameters as $parameter) {
        $operationParameterList[] = "$" . $parameter->name;
    }
?>
$res = Services::getInstance()-><?php echo $action->operation->name ?>(<?php echo implode(", ", $operationParameterList) ?>);
<?php
} // if
?>