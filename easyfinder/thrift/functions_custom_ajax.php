<?php
//header('Content-Type: application/json');
//header('Access-Control-Allow-Origin: *');
session_start();

include_once "ini.php";
include_once "ini_custom.php";
include_once "functions.php";
include_once "functions_custom.php";
include_once "functions_customui.php";


/*SECTION: GENERAL*/
$pdo = getMySQLPDOLink_(false,false);
if (!isset($_SESSION[APP_SESSION_NAME])) {
  header("location: logout.php");
}

$pdo = getMySQLPDOLink__(false, false, 'localhost', 'kodeunit_algocode', 'kodeunit_kantoma', '@dm1n@k@r@a2Pl@tf0rm', 'utf8mb4');
$task = '';
$payback = array();

if(isset($_GET['function'])){
    $task = sanitizeString_($_GET['function']);
    //$decoded_json = json_decode($json);
    //print_r(json_encode( get($term)) );
    //exit();
}
    //file_put_contents('11.111', $task );
switch ($task) {
  case 'getObjects':
    $payback=getObjectTable($pdo);
    break;
  
  default:
    # code...
    break;   
}


print_r(json_encode($payback));
exit();



/*This function is used at the platform level field FIELDEDITOR
Fragments: <!--CUSTOM FIELD: fieldeditor--> IN _component_form_dataV5.partial
            function build_object(code), function build_code(obj),function build_ui(code) IN _js.inc
            function getObjects IN _functions_custom_ajax.php
*/
function getObjectTable ($pdo){
  $res = getTablesAndFieldsFromCode ($pdo);
  return $res;
}



?>