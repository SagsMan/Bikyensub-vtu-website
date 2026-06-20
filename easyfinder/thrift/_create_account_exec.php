<?php 
include_once ('ini_custom.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log received data
//file_put_contents('1', print_r($_POST, true));

// Assuming you have a database connection established already
session_start();

include_once "ini.php";
include_once "ini_custom.php";
include_once "functions.php";
include_once "functions_custom.php";
include_once "functions_customui.php";


$pdo = getMySQLPDOLink_(false,false);

if(isset($_SESSION['signuflow'])){}else{

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

$_SESSION['signuflow']['companyId']= -1;
$_SESSION['signuflow']['companyFullname']=null;
$_SESSION['signuflow']['companyEmailAddress']=null;
$_SESSION['signuflow']['companyRegNo']=null;
$_SESSION['signuflow']['companyPhoneNo']=null;
$_SESSION['signuflow']['companyAddress']=null;
$_SESSION['signuflow']['companyContacts']=null;
$_SESSION['signuflow']['companyBankId']=null;
$_SESSION['signuflow']['companyBankName']=null;
$_SESSION['signuflow']['companyBankAccountName']=null;

$_SESSION['signuflow']['companyPassword']=null;

$_SESSION['signuflow']['step']=1;

}

// Get the raw POST data
$data = file_get_contents("php://input");

// Decode the JSON data into a PHP array
$requestData = json_decode($data, true);

//file_put_contents('1', $requestData);
//file_put_contents('1', $data);

// Validate and sanitize the received data as needed
$step = intval($requestData['step']); // Assuming 'id' is an integer
//$donationDate = sanitizeString_($requestData['donation_date']); // Sanitize using mysqli_real_escape_string

if($step==3){
 //TEST
                $stmt = $pdo->prepare("DELETE FROM `owners` WHERE `emailAddress`= 'itineryconsults@gmail.com'");
                $stmt->execute();

                $stmt = $pdo->prepare("DELETE FROM `users` WHERE `emailAddress` = 'itineryconsults@gmail.com'");
                $stmt->execute();
}




switch ($step) {
    case 3:
        $_SESSION['signuflow']['category']= sanitizeString_($requestData['payl']['category']);
        $_SESSION['signuflow']['step'] =$step;

        $next_step = $step+1;

        if ($requestData['payl']['category']=='Government') {          }
        if ($requestData['payl']['category']=='NGO') { $next_step = 101;         }
        if ($requestData['payl']['category']=='Religious Body') { $next_step = 201;         }
        if ($requestData['payl']['category']=='Political Body') { $next_step = 301;         }

         $responseArray = array('status' => 'success', 'message' => '','task'=>'','phoneNo'=>'','next_step'=> $next_step );
        break;
    case 4: 

        $_SESSION['signuflow']['companyFullname']= sanitizeString_($requestData['payl']['companyFullname']);
        $_SESSION['signuflow']['companyEmailAddress']= sanitizeString_($requestData['payl']['companyEmailAddress']);
        $_SESSION['signuflow']['companyRegNo']= sanitizeString_($requestData['payl']['companyRegNo']);
        $_SESSION['signuflow']['companyBriefHistory']= sanitizeString_($requestData['payl']['companyBriefHistory']);
        //$_SESSION['signuflow']['companyAddress']= sanitizeString_($requestData['payl']['companyAddress']);
        $_SESSION['signuflow']['step'] =$step;

        $password= md5(sanitizeString_($requestData['payl']['companyPassword']));  
        //$password= md5($requestData['payl']['companyPassword']);  
        $password= $password.APP_X;
        $encryptedPass = password_hash($password, PASSWORD_BCRYPT);


       
         

        try {

            $stmt = $pdo->prepare("SELECT * FROM `owners` WHERE `emailAddress`=?");
            $stmt->execute([ $_SESSION['signuflow']['companyEmailAddress'] ]);
            $data = $stmt->fetchAll();
            if ($data) {
              //$errorMessage = "Sorry, that phone number (<b>".$phoneNo."</b>) is not available";
              $errorMessage = "Sorry, that email (<b>".$_SESSION['signuflow']['companyEmailAddress']."</b>) is not available";
              $responseArray = array('status' => 'fail', 'message' => "Sorry, that email (<b>".$_SESSION['signuflow']['companyEmailAddress']."</b>) is not available",'task'=>'','phoneNo'=>'');
            }else{

                $_SESSION['signuflow']['otpcode']= generateOTP('');
              //create owner
              $stmt = $pdo->prepare("INSERT INTO `owners` (`password`  ,`fullname`,`emailAddress`,`regNo`,`briefHistory`,`otpcode`,`category`) VALUES (?,?,?,?,?,?,?)");
              $stmt->execute([ $encryptedPass ,$_SESSION['signuflow']['companyFullname'], $_SESSION['signuflow']['companyEmailAddress'], $_SESSION['signuflow']['regNo'],$_SESSION['signuflow']['briefHistory'], $_SESSION['signuflow']['otpcode'],$_SESSION['signuflow']['category'] ]);
              $id = $pdo->lastInsertID();
              if ($id > 0) {
                $_SESSION['signuflow']['companyId'] = $id;
                //create admin user
                $stmt = $pdo->prepare("INSERT INTO `users` (`password` ,`fullname`,`emailAddress`,`regNo`,`companyBriefHistory`,`otpcode`,`category`,`ownerId`,`isActive`,`isAdmin`) VALUES (?,?,?,?,?,?,?,?,?,?)");

                $stmt->execute([  $encryptedPass ,$_SESSION['signuflow']['companyFullname'],$_SESSION['signuflow']['companyEmailAddress'],$_SESSION['signuflow']['companyRegNo'], $_SESSION['signuflow']['companyBriefHistory'], $_SESSION['signuflow']['otpcode'] ,$_SESSION['signuflow']['category'],  $id,1,1
            ]);
                
                $userId = $pdo->lastInsertID();

                if ($userId > 0) {
                    $_SESSION['signuflow']['id']=$userId;

                    //clear session here

                    if (isEmailValid($_SESSION['signuflow']['companyEmailAddress']) ) {
                        $recipientEmail = $_SESSION['signuflow']['companyEmailAddress']; 
                        $subject = APP_FULLNAME. ' Email Verification';
                        
                        //$message = '<h1>Hello,</h1><p>Here is your OTP: '.$_SESSION['signuflow']['otpcode'].'</p>';
                        //$mail->Body    = file_get_contents('path/to/email-template.html'); // Load the HTML content from a file

                        $message ='<!DOCTYPE html>
                            <html lang="en">

                            <head>
                                <meta charset="UTF-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <title>Welcome to '.APP_FULLNAME.'</title>
                                <style>
                                    body {
                                        font-family: Arial, sans-serif;
                                        background-color: #f4f4f4;
                                        margin: 0;
                                        padding: 0;
                                    }

                                    .container {
                                        max-width: 600px;
                                        margin: 0 auto;
                                        padding: 20px;
                                        background-color: white;
                                        border-radius: 10px;
                                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                    }

                                    .header {
                                        text-align: center;
                                        margin-bottom: 30px;
                                    }

                                    .verification-link {
                                        text-decoration: none;
                                        color: #ffffff;
                                        background-color: #4caf50;
                                        padding: 10px 20px;
                                        border-radius: 5px;
                                    }

                                    .footer {
                                        margin-top: 30px;
                                        text-align: center;
                                        color: #777777;
                                    }
                                </style>
                            </head>

                            <body>
                                <div class="container">
                                    <div class="header">
                                        <h1>Welcome to '.APP_FULLNAME.'</h1>
                                    </div>
                                    <p>Dear '.$_SESSION['signuflow']['companyFullname'].',</p>
                                    <p>We`re excited to have you on board. To get started, please verify your email address by clicking the button below:</p>
                                    <a class="verification-link" href="'.APP_COMPANYURL.'/_create_account_verify_exec.php?djjskjksdjk-------------------------------------jkjkljhf834ekhuyyhh-----------------------------------------------------------------sdsdf='.$_SESSION['signuflow']['otpcode'].'">Verify Your Account</a>
                                    <p>If the button above doesn`t work, you can also verify your account by copying and pasting the following link into your browser:</p>
                                    <p><a href="'.APP_COMPANYURL.'/_create_account_verify_exec.php?djjskjksdjk-------------------------------------jkjkljhf834ekhuyyhh-----------------------------------------------------------------sdsdf='.$_SESSION['signuflow']['otpcode'].'">'.APP_COMPANYURL.'/_create_account_verify_exec.php?djjskjksdjk-------------------------------------jkjkljhf834ekhuyyhh-----------------------------------------------------------------sdsdf='.$_SESSION['signuflow']['otpcode'].'</a></p>
                                    <p>By verifying your email, you`ll gain full access to all the amazing features of '.APP_FULLNAME.'.</p>
                                    <p>If you have any questions or need assistance, our support team is here to help. Just reply to this email, and we`ll be happy to assist you.</p>
                                    <div class="footer">
                                        <p>Thank you for choosing '.APP_FULLNAME.' We look forward to helping you achieve your goals.</p>
                                        <p>The '.APP_FULLNAME.' Team</p>
                                    </div>
                                </div>
                            </body>

                            </html>
                            ';

                        

                        try
                        {

                          sendEmail($recipientEmail, $subject, $message) ;
                          
                          $responseArray = array('status' => 'success', 'message' => '','task'=>'emailVerify','phoneNo'=>'','next_step'=> $step+1 );

                        } catch (\PDOException $e) {
                              //$errorMessage .= "<b>Database error</b><br>";
                             throw new \PDOException($e->getMessage(), (int)$e->getCode());
                        }

                    } else {
                        //echo "Invalid email address.";
                    }

                  


                }//user > 0



              }

              

            }

            //redirect_page_to(PAGE_TO_OPEN_AFTER_SUCCESSFUL_LOGIN);
            //$stmt->execute($loginVariableNamesArray);
          } catch (\PDOException $e) {
              $errorMessage = "<b>Database error</b><br>";
               throw new \PDOException($e->getMessage(), (int)$e->getCode());
          }




    break;

    case 5:
    case 102:
    case 202:
    case 302:
        $_SESSION['signuflow']['companyAddress']= $requestData['payl']['companyAddress'];//sanitizeString_( $requestData['payl']['companyContacts'] );
        $_SESSION['signuflow']['step'] =$step;

        $stmt = $pdo->prepare("UPDATE `owners` SET `address`= ? WHERE `id`=? AND `otpcode`=? ");
        $stmt->execute([ json_encode( $_SESSION['signuflow']['companyAddress'] ), $_SESSION['signuflow']['companyId'], $_SESSION['signuflow']['otpcode'] ] );

        $stmt = $pdo->prepare("UPDATE `users` SET `address`= ? WHERE `ownerId`=? AND `otpcode`=? ");
        $stmt->execute([ json_encode( $_SESSION['signuflow']['companyAddress'] ), $_SESSION['signuflow']['companyId'], $_SESSION['signuflow']['otpcode'] ] );


        $responseArray = array('status' => 'success', 'message' => '','task'=>'','phoneNo'=>'','next_step'=> $step+1 );
        break;

    case 6:
    case 103:
    case 203:
    case 303:
        $_SESSION['signuflow']['companyContacts']= $requestData['payl']['companyContacts'];//sanitizeString_( $requestData['payl']['companyContacts'] );
        $_SESSION['signuflow']['step'] =$step;

        $stmt = $pdo->prepare("UPDATE `owners` SET `contacts`= ? WHERE `id`=? AND `otpcode`=? ");
        $stmt->execute([ json_encode( $_SESSION['signuflow']['companyContacts'] ), $_SESSION['signuflow']['companyId'], $_SESSION['signuflow']['otpcode'] ] );
         $responseArray = array('status' => 'success', 'message' => '','task'=>'','phoneNo'=>'','next_step'=> $step+1 );
        break;

    case 8:
    case 105:
    case 205:
    case 305:
        $_SESSION['signuflow']['companyBankName']= sanitizeString_( $requestData['payl']['companyBankName'] );
        $_SESSION['signuflow']['companyBankAccountName']= sanitizeString_( $requestData['payl']['companyBankAccountName'] );
        $_SESSION['signuflow']['step'] =$step;

        $stmt = $pdo->prepare("UPDATE `owners` SET `bankName`= ?,`bankAccountName`=? WHERE `id`=? AND `otpcode`=? ");
        $stmt->execute([ $_SESSION['signuflow']['companyBankName'] , $_SESSION['signuflow']['companyBankAccountName'], 
               $_SESSION['signuflow']['companyId']  ,$_SESSION['signuflow']['otpcode'] 
        ] );
         $responseArray = array('status' => 'success', 'message' => 'Successfully created an account','task'=>'login','phoneNo'=>'','next_step'=> $step+1 );


        break;




    case 101: 
    case 201: 
    case 301: 

        $_SESSION['signuflow']['companyFullname']= sanitizeString_($requestData['payl']['companyFullname']);
        $_SESSION['signuflow']['companyEmailAddress']= sanitizeString_($requestData['payl']['companyEmailAddress']);
        $_SESSION['signuflow']['companyRegNo']= sanitizeString_($requestData['payl']['companyRegNo']);
        $_SESSION['signuflow']['companyPhoneNo']= sanitizeString_($requestData['payl']['companyPhoneNo']);
        //$_SESSION['signuflow']['companyAddress']= sanitizeString_($requestData['payl']['companyAddress']);
        $_SESSION['signuflow']['step'] =$step;

        $password= md5(sanitizeString_($requestData['payl']['companyPassword']));  
        //$password= md5($requestData['payl']['companyPassword']);  
        $password= $password.APP_X;
        $encryptedPass = password_hash($password, PASSWORD_BCRYPT);
     

        try {

            $stmt = $pdo->prepare("SELECT * FROM `owners` WHERE `emailAddress`=?");
            $stmt->execute([ $_SESSION['signuflow']['companyEmailAddress'] ]);
            $data = $stmt->fetchAll();
            if ($data) {
              //$errorMessage = "Sorry, that phone number (<b>".$phoneNo."</b>) is not available";
              $errorMessage = "Sorry, that email (<b>".$_SESSION['signuflow']['companyEmailAddress']."</b>) is not available";
              $responseArray = array('status' => 'fail', 'message' => "Sorry, that email (<b>".$_SESSION['signuflow']['companyEmailAddress']."</b>) is not available",'task'=>'','phoneNo'=>'');
            }else{

                $_SESSION['signuflow']['otpcode']= generateOTP('');
              //create owner
              $stmt = $pdo->prepare("INSERT INTO `owners` (`password`  ,`fullname`,`emailAddress`,`regNo`,`phoneNo`,`otpcode`,`category`) VALUES (?,?,?,?,?,?,?)");
              $stmt->execute([ $encryptedPass ,$_SESSION['signuflow']['companyFullname'], $_SESSION['signuflow']['companyEmailAddress'], $_SESSION['signuflow']['regNo'],$_SESSION['signuflow']['phoneNo'], $_SESSION['signuflow']['otpcode'],$_SESSION['signuflow']['category'] ]);
              $id = $pdo->lastInsertID();
              if ($id > 0) {
                $_SESSION['signuflow']['companyId'] = $id;
                //create admin user
                $stmt = $pdo->prepare("INSERT INTO `users` (`password` ,`fullname`,`emailAddress`,`regNo`,`phoneNo`,`otpcode`,`category`,`ownerId`,`isActive`,`isAdmin`) VALUES (?,?,?,?,?,?,?,?,?,?)");

                $stmt->execute([  $encryptedPass ,$_SESSION['signuflow']['companyFullname'],$_SESSION['signuflow']['companyEmailAddress'],$_SESSION['signuflow']['companyRegNo'], $_SESSION['signuflow']['phoneNo'], $_SESSION['signuflow']['otpcode'] ,$_SESSION['signuflow']['category'],  $id,1,1
            ]);
                
                $userId = $pdo->lastInsertID();

                if ($userId > 0) {
                    $_SESSION['signuflow']['id']=$userId;

                    //clear session here

                    if (isEmailValid($_SESSION['signuflow']['companyEmailAddress']) ) {
                        $recipientEmail = $_SESSION['signuflow']['companyEmailAddress']; 
                        $subject = APP_FULLNAME. ' Email Verification';
                        
                        //$message = '<h1>Hello,</h1><p>Here is your OTP: '.$_SESSION['signuflow']['otpcode'].'</p>';
                        //$mail->Body    = file_get_contents('path/to/email-template.html'); // Load the HTML content from a file

                        $message ='<!DOCTYPE html>
                            <html lang="en">

                            <head>
                                <meta charset="UTF-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <title>Welcome to '.APP_FULLNAME.'</title>
                                <style>
                                    body {
                                        font-family: Arial, sans-serif;
                                        background-color: #f4f4f4;
                                        margin: 0;
                                        padding: 0;
                                    }

                                    .container {
                                        max-width: 600px;
                                        margin: 0 auto;
                                        padding: 20px;
                                        background-color: white;
                                        border-radius: 10px;
                                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                    }

                                    .header {
                                        text-align: center;
                                        margin-bottom: 30px;
                                    }

                                    .verification-link {
                                        text-decoration: none;
                                        color: #ffffff;
                                        background-color: #4caf50;
                                        padding: 10px 20px;
                                        border-radius: 5px;
                                    }

                                    .footer {
                                        margin-top: 30px;
                                        text-align: center;
                                        color: #777777;
                                    }
                                </style>
                            </head>

                            <body>
                                <div class="container">
                                    <div class="header">
                                        <h1>Welcome to '.APP_FULLNAME.'</h1>
                                    </div>
                                    <p>Dear '.$_SESSION['signuflow']['companyFullname'].',</p>
                                    <p>We`re excited to have you on board. To get started, please verify your email address by clicking the button below:</p>
                                    <a class="verification-link" href="'.APP_COMPANYURL.'/_create_account_verify_exec.php?djjskjksdjk-------------------------------------jkjkljhf834ekhuyyhh-----------------------------------------------------------------sdsdf='.$_SESSION['signuflow']['otpcode'].'">Verify Your Account</a>
                                    <p>If the button above doesn`t work, you can also verify your account by copying and pasting the following link into your browser:</p>
                                    <p><a href="'.APP_COMPANYURL.'/_create_account_verify_exec.php?djjskjksdjk-------------------------------------jkjkljhf834ekhuyyhh-----------------------------------------------------------------sdsdf='.$_SESSION['signuflow']['otpcode'].'">'.APP_COMPANYURL.'/_create_account_verify_exec.php?djjskjksdjk-------------------------------------jkjkljhf834ekhuyyhh-----------------------------------------------------------------sdsdf='.$_SESSION['signuflow']['otpcode'].'</a></p>
                                    <p>By verifying your email, you`ll gain full access to all the amazing features of '.APP_FULLNAME.'.</p>
                                    <p>If you have any questions or need assistance, our support team is here to help. Just reply to this email, and we`ll be happy to assist you.</p>
                                    <div class="footer">
                                        <p>Thank you for choosing '.APP_FULLNAME.' We look forward to helping you achieve your goals.</p>
                                        <p>The '.APP_FULLNAME.' Team</p>
                                    </div>
                                </div>
                            </body>

                            </html>
                            ';

                        

                        try
                        {

                          sendEmail($recipientEmail, $subject, $message) ;
                          
                          $responseArray = array('status' => 'success', 'message' => '','task'=>'emailVerify','phoneNo'=>'','next_step'=> $step+1 );

                        } catch (\PDOException $e) {
                              //$errorMessage .= "<b>Database error</b><br>";
                             throw new \PDOException($e->getMessage(), (int)$e->getCode());
                        }

                    } else {
                        //echo "Invalid email address.";
                    }

                  


                }//user > 0



              }

              

            }

            //redirect_page_to(PAGE_TO_OPEN_AFTER_SUCCESSFUL_LOGIN);
            //$stmt->execute($loginVariableNamesArray);
          } catch (\PDOException $e) {
              $errorMessage = "<b>Database error</b><br>";
               throw new \PDOException($e->getMessage(), (int)$e->getCode());
          }




    break;

    default:
        // code...
        break;
}

//file_put_contents('2', json_encode($_SESSION['signuflow']) );


// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($responseArray);


?>