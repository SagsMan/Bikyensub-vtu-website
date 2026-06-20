<?php
session_start();
include_once "ini.php";
include_once "functions.php";


$pdo = getMySQLPDOLink_(false,false);


if (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET))
{
   $otpCode='';
    if(isset(($_GET["djjskjksdjk-------------------------------------jkjkljhf834ekhuyyhh-----------------------------------------------------------------sdsdf"]))){
    $otpCode =sanitizeString_($_GET["djjskjksdjk-------------------------------------jkjkljhf834ekhuyyhh-----------------------------------------------------------------sdsdf"]);
    }

    try {

      $stmt = $pdo->prepare("SELECT * FROM `owners` WHERE (`otpcode` IS NOT NULL AND `isVerified`  IS NOT NULL) AND `otpcode`=? AND `isVerified` <> ? ");
      $stmt->execute([$otpCode , 1]);
      $data = $stmt->fetchAll();

      if ( (!isset($data[0]) ) ){

      }else if ( (isset($data[0]) )   && !empty(isset($data[0])) ) {
        
        $stmt = $pdo->prepare("UPDATE `owners` SET `isVerified`=? WHERE `otpcode`=? ");
        $stmt->execute([ 1, $otpCode ]);
        
        $stmt = $pdo->prepare("UPDATE `users` SET `isVerified`=? WHERE `otpcode`=? ");
        $stmt->execute([ 1, $otpCode ]);

        $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `otpcode`=? AND `ownerId` = ? ");
        $stmt->execute([$otpCode , $data[0]['id'] ]);
        $data_ = $stmt->fetchAll();

        // Assuming $data_[0] contains your data
        $data_ = $data_[0];

        // List of keys to match and copy from $data_ to $_SESSION['xxx']
        $keysToMatch = [
            'id', 'fullname', 'emailAddress', 'phoneNo', 'address', 'username', 'password', 'createdBy',
            'logoPath', 'updatedBy', 'createdOn', 'updatedOn', 'ownerId', 'userId', 'appId', 'isActive',
            'isLocked', 'isDeleted', 'isChanged', 'isSynced', 'isAdmin', 'syncedOn', 'oldId', 'ownerGuid',
            'privileges', 'guid', 'firstName', 'middleName', 'lastName', 'gender', 'dateOfBirth',
            'addressWork', 'qualification', 'maritalStatus', 'monthlyIncome', 'bankId', 'accountNo',
            'otpcode','category','regNo','isVerified'
        ];

        // Loop through the keys and assign values from $data_ to $_SESSION['xxx']
        foreach ($keysToMatch as $key) {
            // Check if the key exists in $data_, if not, assign null to the session
            $_SESSION['signuflow'][$key] = isset($data_[$key]) ? $data_[$key] : null;
        }

        // After this loop, $_SESSION['xxx'] will have matching values from $data_[0]


        //update sign up flow session
        /*
        $_SESSION['signuflow']['id']= -1;
        $_SESSION['signuflow']['fullname']= null;
        $_SESSION['signuflow']['emailAddress']= null;
        $_SESSION['signuflow']['phoneNo']= null;
        $_SESSION['signuflow']['address']= null;
        $_SESSION['signuflow']['username']= null;
        $_SESSION['signuflow']['password']= null;
        $_SESSION['signuflow']['createdBy']= null;
        $_SESSION['signuflow']['logoPath']= null;
        $_SESSION['signuflow']['updatedBy']= null;
        $_SESSION['signuflow']['createdOn']= null;
        $_SESSION['signuflow']['updatedOn']= null;
        $_SESSION['signuflow']['ownerId']= null;
        $_SESSION['signuflow']['userId']= null;
        $_SESSION['signuflow']['appId']= null;
        $_SESSION['signuflow']['isActive']= null;
        $_SESSION['signuflow']['isLocked']= null;
        $_SESSION['signuflow']['isDeleted']= null;
        $_SESSION['signuflow']['isChanged']= null;
        $_SESSION['signuflow']['isSynced']= null;
        $_SESSION['signuflow']['isAdmin']= null;
        $_SESSION['signuflow']['syncedOn']= null;
        $_SESSION['signuflow']['oldId']= null;
        $_SESSION['signuflow']['ownerGuid']= null;
        $_SESSION['signuflow']['privileges']= null;
        $_SESSION['signuflow']['guid']= null;
        $_SESSION['signuflow']['firstName']= null;
        $_SESSION['signuflow']['middleName']= null;
        $_SESSION['signuflow']['lastName']= null;
        $_SESSION['signuflow']['gender']= null;
        $_SESSION['signuflow']['dateOfBirth']= null;
        $_SESSION['signuflow']['addressWork']= null;
        $_SESSION['signuflow']['qualification']= null;
        $_SESSION['signuflow']['maritalStatus']= null;
        $_SESSION['signuflow']['monthlyIncome']= null;
        $_SESSION['signuflow']['bankId']= null;
        $_SESSION['signuflow']['accountNo']= null;

        $_SESSION['signuflow']['otpcode']= null;

        $_SESSION['signuflow']['category']=null;
        $_SESSION['signuflow']['govtCertificate']=null;
        $_SESSION['signuflow']['addressWork']=null;
        $_SESSION['signuflow']['regNo']=null;
        $_SESSION['signuflow']['companyBriefHistory']=null;
        $_SESSION['signuflow']['position']=null;
        $_SESSION['signuflow']['dateOfAssumption']=null;
        $_SESSION['signuflow']['briefHistory']=null;
        */
        $_SESSION['signuflow']['companyId']= $data[0]['id'];
        $_SESSION['signuflow']['companyFullname']=$data[0]['fullname'];
        $_SESSION['signuflow']['companyEmailAddress']=$data[0]['emailAddress'];
        $_SESSION['signuflow']['companyRegNo']=$data[0]['regNo'];
        $_SESSION['signuflow']['companyPhoneNo']=$data[0]['phoneNo'];
        $_SESSION['signuflow']['companyAddress']=$data[0]['address'];
        $_SESSION['signuflow']['companyContacts']=$data[0]['contacts'];
        $_SESSION['signuflow']['companyBankId']=$data[0]['bankId'];
        $_SESSION['signuflow']['companyBankName']=$data[0]['bankName'];
        $_SESSION['signuflow']['companyBankAccountName']=$data[0]['bankAccountName'];
        $_SESSION['signuflow']['companyCategory']=$data[0]['category'];

        $_SESSION['signuflow']['step']=5;


        if ($data[0]['category']=='Government') {          }
        if ($data[0]['category']=='NGO') { $_SESSION['signuflow']['step']=102;        }
        if ($data[0]['category']=='Religious Body') { $_SESSION['signuflow']['step']=202;         }
        if ($data[0]['category']=='Political Body') { $_SESSION['signuflow']['step']=302;         }


        

        //file_put_contents('3', json_encode($_SESSION['signuflow']));

        //end


        switch ($data[0]['category']) {
          case 'Government':
          case 'NGO':
          case 'Religious Body':
          case 'Political Body':
              header('location: _create_account.php?hjkhj_________khjkhjkhjku75657_khjkhjkhjku75657_khjkhjkhjku75657_khjkhjkhjku75657_khjkhjkhjku75657_khjkhjkhjku75657_____________khjkhjkhjku75657---------------------------------------------------jjiuuiy7='.$_SESSION['signuflow']['step']);
              exit();
            break;
          
          default:
              header('location: _create_account_verified.php');
              exit();
            break;
        }


        /*if($data[0]['category']=='Government'){
          header('location: _create_account.php?hjkhj_________khjkhjkhjku75657_khjkhjkhjku75657_khjkhjkhjku75657_khjkhjkhjku75657_khjkhjkhjku75657_khjkhjkhjku75657_____________khjkhjkhjku75657---------------------------------------------------jjiuuiy7='.$_SESSION['signuflow']['step']);
          exit();

        }else{
          header('location: _create_account_verified.php');
          exit();
        }*/

        
        
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
