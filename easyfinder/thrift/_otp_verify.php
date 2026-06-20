<?php

include_once "ini.php";
include_once "functions.php";


$pdo = getMySQLPDOLink_(false,false);


if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST))
{
    $otpCode =sanitizeString_($_POST["otpCode"]);
    $otpfb='';

    if(isset(($_POST["djjskjksdjkjkjkljhf834ekhuyyhh-----------------------------------------------------------------sdsdf"]))){
     $otpfb =sanitizeString_($_POST["djjskjksdjkjkjkljhf834ekhuyyhh-----------------------------------------------------------------sdsdf"]);
    }

    try {

      $stmt = $pdo->prepare("SELECT * FROM `owners` WHERE (`guid`  IS NOT NULL AND `isVerified`  IS NOT NULL) AND `guid`=? AND `isVerified` <> ? ");
      $stmt->execute([$otpCode , 1]);
      $data = $stmt->fetchAll();

      if ( (!isset($data[0]) ) ){

      }else if ( (isset($data[0]) )   && !empty(isset($data[0])) ) {
        
        $stmt = $pdo->prepare("UPDATE `owners` SET `isVerified`=? WHERE `guid`=? ");
        $stmt->execute([ 1, $otpCode ]);
        
        $stmt = $pdo->prepare("UPDATE `users` SET `isLocked`=? WHERE `guid`=? ");
        $stmt->execute([ 1, $otpCode ]);

        echo true;exit();
        
      }

    } catch (\PDOException $e) {

        echo false;exit();
    
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
 
  }else{

    echo false;exit();
    
}


echo false;exit();


?>
