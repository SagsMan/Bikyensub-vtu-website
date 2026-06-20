<?php 

session_start();
include_once "ini.php";
include_once "functions.php";
    if (!isset($_SESSION[APP_SESSION_NAME]) ){
        header("location: logout.php");
    }

    $pdo = getMySQLPDOLink_(false,false);
    $errorMessage="";
    $id =-1;
    $task= "";
    $object='';
    $from='';
    $to='';
    $searchTerm='';

    $urlparams='';


   /* echo "<pre>";
    print_r($_GET);
    echo "</pre>";

    echo urlencode($searchTerm);
    exit();*/

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST)
        ){
        
      
      }elseif (
          isset($_GET["id"]) && isset($_GET["task"]) 
          && isset($_GET["object"]) && isset($_GET["from"]) 
          && isset($_GET["to"])
      )  {
        $id = sanitizeString_($_GET["id"]);
        $task = sanitizeString_($_GET["task"]);  
        $object = sanitizeString_($_GET["object"]); 
        $from = sanitizeString_($_GET["from"]); 
        $to = sanitizeString_($_GET["to"]); 

        if(isset($_GET["searchTerm"])){$searchTerm=$_GET["searchTerm"];
          if(!empty($searchTerm)){$urlparams='?searchTerm='.urlencode($searchTerm);}
          //if(!empty($searchTerm)){$urlparams='?searchTerm='.($searchTerm);}
        }

        
      }else{
        header("location: dashboard.php");
        exit();
      }

      switch ($task) {
          case 'delete':

             //if page is to be deleted from pages table then delete its file from disk
             if($object=='pages'){
              //page name from table
              $stmt_ = $pdo->prepare('SELECT `fullname` FROM `'.$object.'` WHERE `id`=?');
              $stmt_->execute([$id]);
              $res=$stmt_->fetchAll();
              if($res){
                //file_put_contents('1del',json_encode($res));
                //file_put_contents('1del',($appsourcePath . $app->fullname . '/' . $res[0]['fullname']);
              }
            }
            try {
                $stmt = $pdo->prepare('DELETE FROM `'.$object.'` WHERE `id`=?');
                $stmt->execute([$id]);
                //header("location: frameworx-update-form-xxxxxxxxx.php");
                //exit();
              } catch (\PDOException $e) {
                  //$errorMessage .= "<b>Database error deleting from frameworks</b><br>";
                  throw new \PDOException($e->getMessage(), (int)$e->getCode());
              }
              break;
          
          default:
              # code...
              break;
      }

      header('location: '.$to.$urlparams);
      exit();
?>