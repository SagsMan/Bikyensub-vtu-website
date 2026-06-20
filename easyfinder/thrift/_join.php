<?php
session_start();
include_once "ini.php";
include_once "functions.php";
include_once "functions_custom.php";

if(isset($_SESSION[APP_SESSION_NAME]))
{   
  header("location: dashboard.php");
  exit();
}

$fullname = "";
$username = "";
$password = "";
$emailAddress ="";
$phoneNo='';
$acknowledge= -1;
//$loginVariableNamesArray = array("username","password","emailAddress","fullname");
$loginVariableNamesArray = array("phoneNo","password","emailAddress");
$errorMessage ="";
$pdo = getMySQLPDOLink_(false,false);

$defaultPrivileges=Privileges_Default_Enabled;

$searchTerm='';

$asInstitutionOrIndividualOrGroup='';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["asInstitutionOrIndividualOrGroup"])) {
        $asInstitutionOrIndividualOrGroup = $_POST["asInstitutionOrIndividualOrGroup"];
        // Now $selectedOption contains the value of the selected radio button
        // You can use this value for further processing
       // echo "Selected option: " . $asInstitutionOrIndividualOrGroup;
    } else {
        echo "No option selected!";
    }//
}
//exit();

if(empty($asInstitutionOrIndividualOrGroup)){
  header('location: _join_category.php');
}


if (isset($_POST["acknowledge"])) { $acknowledge = $_POST["acknowledge"];  }

if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST))
{

  if(isset($_POST["joinFormButton"]) &&  $acknowledge==true  ){


        if (validatePOSTS($loginVariableNamesArray) == true) {
          
          /*$fullname=sanitizeString_($_POST["fullname"]);
          $username=sanitizeString_($_POST["username"]);
          */
          $emailAddress =sanitizeString_($_POST["emailAddress"]);
          $phoneNo=sanitizeString_($_POST["phoneNo"]);
          $password= md5(sanitizeString_($_POST["password"]));  
          $password= $password.APP_X;

          $otpCode= generateOTP('');

          try {

            $stmt = $pdo->prepare("SELECT * FROM `owners` WHERE `username`=? OR `phoneNo`=? OR `emailAddress`=?");
            $stmt->execute([$phoneNo,$phoneNo,$emailAddress]);
            $data = $stmt->fetchAll();
            if ($data) {
              //$errorMessage = "Sorry, that phone number (<b>".$phoneNo."</b>) is not available";
              $errorMessage = "Sorry, that phone number/email (<b>".$phoneNo." or ".$emailAddress."</b>) is not available";
            }else{
              //create owner
              //$stmt = $pdo->prepare("INSERT INTO `owners` (`username`,`password`,`emailAddress`,`fullname`) VALUES (?,?,?,?)");
              $stmt = $pdo->prepare("INSERT INTO `owners` (`username`,`phoneNo`,`emailAddress`,`password`,`guid`,`category`) VALUES (?,?,?,?,?,?)");
              $encryptedPass = password_hash($password, PASSWORD_BCRYPT);
              //$stmt->execute([$username, $encryptedPass, $emailAddress , $fullname]);
              $stmt->execute([$phoneNo,$phoneNo,$emailAddress, $encryptedPass, $otpCode,$asInstitutionOrIndividualOrGroup]);
              $id = $pdo->lastInsertID();
              if ($id > 0) {
                //create admin user
                $stmt = $pdo->prepare("INSERT INTO `users` (`emailAddress`,`username`,`phoneNo`,`password`,`ownerId`,`isActive`,`isAdmin`,`guid`,`ownerGuid`) VALUES (?,?,?,?,?,?,?,?,?)");
                $encryptedPass = password_hash($password, PASSWORD_BCRYPT);
                $stmt->execute([$emailAddress,$phoneNo,$phoneNo, $encryptedPass, $id, 1, 1 , $otpCode ,$asInstitutionOrIndividualOrGroup]);
                //$stmt->execute([$defaultPrivileges,$phoneNo,$username, $encryptedPass, $emailAddress, $id, 1,1 ]);
                $userId = $pdo->lastInsertID();

                if ($userId > 0) {

                  if(APP_OTP_TYPE=='emailAddress'){

                    if (isEmailValid($emailAddress) ) {
                        $recipientEmail = $emailAddress; 
                        $subject = APP_FULLNAME. ' OTP';
                        
                        $message = '<h1>Hello,</h1><p>Here is your OTP: '.$otpCode.'</p>';

                        try
                        {

                          sendEmail($recipientEmail, $subject, $message) ;
                          header("location: _otp_mail.php?djjskjksdjkjkjkljhf834ekhuyyhh-----------------------------------------------------------------sdsdf=".$otpCode);  

                        } catch (\PDOException $e) {
                              //$errorMessage .= "<b>Database error</b><br>";
                             throw new \PDOException($e->getMessage(), (int)$e->getCode());
                        }

                    } else {
                        //echo "Invalid email address.";
                    }

                  }else if(APP_OTP_TYPE=='phoneNo'){
                    header("location: _otp.php?djjskjksdjkjkjkljhf834ekhuyyhh-----------------------------------------------------------------sdsdf=".$otpCode);  
                    exit();
                  }

                }



              }

              

            }

            //redirect_page_to(PAGE_TO_OPEN_AFTER_SUCCESSFUL_LOGIN);
            //$stmt->execute($loginVariableNamesArray);
          } catch (\PDOException $e) {
              $errorMessage .= "<b>Database error</b><br>";
               throw new \PDOException($e->getMessage(), (int)$e->getCode());
          }
       
      }else{
        $errorMessage .= "<b>One or more required input is empty.</b><br>";
      }


  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link
      rel="preload"
      as="font"
      href="_next/static/media/02205c9944024f15-s.p.woff2"
      crossorigin=""
      type="font/woff2"
    />
    <link
      rel="preload"
      as="font"
      href="_next/static/media/0e4fe491bf84089c-s.p.woff2"
      crossorigin=""
      type="font/woff2"
    />
    <link
      rel="preload"
      as="font"
      href="_next/static/media/2aaf0723e720e8b9-s.p.woff2"
      crossorigin=""
      type="font/woff2"
    />
    <link
      rel="preload"
      as="font"
      href="_next/static/media/627622453ef56b0d-s.p.woff2"
      crossorigin=""
      type="font/woff2"
    />
    <link
      rel="preload"
      as="font"
      href="_next/static/media/7d8c9b0ca4a64a5a-s.p.woff2"
      crossorigin=""
      type="font/woff2"
    />
    <link
      rel="preload"
      as="font"
      href="_next/static/media/8db47a8bf03b7d2f-s.p.woff2"
      crossorigin=""
      type="font/woff2"
    />
    <link
      rel="preload"
      as="font"
      href="_next/static/media/934c4b7cb736f2a3-s.p.woff2"
      crossorigin=""
      type="font/woff2"
    />
    <link
      rel="stylesheet"
      href="_next/static/css/728058cd7dfd0a0f.css"
      data-precedence="next"
    />
    <!--link
      rel="preload"
      href="_next/static/chunks/webpack-75b5ab2f82d002e4.js"
      as="script"
    />
    <link
      rel="preload"
      href="_next/static/chunks/20e9c529-6a72704995d09ef7.js"
      as="script"
    />
    <link
      rel="preload"
      href="_next/static/chunks/340-2537b03c70e9a4f9.js"
      as="script"
    />
    <link
      rel="preload"
      href="_next/static/chunks/main-app-252078edd4a12174.js"
      as="script"
    /-->
    <title>Create Account - <?php echo APP_FULLNAME  ;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="favicon.ico" type="image/x-icon" sizes="any" />
    <meta name="next-size-adjust" />
    
  </head>
  <body class="__variable_20951f __variable_9bfd88 bg-[#f98727]">

    <?php include_once('_header.php');?>

    <main>
      <div
        class="mx-auto my-8 max-w-7xl px-6 md:px-12 lg:px-24 min-h-[50vh] lg:my-16"
      >
        <div
          class="grid place-items-center gap-6 py-12 md:grid-cols-1 lg:gap-12"
        >
         

          <div
            class="rounded-xl border bg-card text-card-foreground min-w-half max-w-[520px] px-4 py-6 shadow-xl md:px-8 md:py-10"
          >


            <?php
                  if (!empty($_GET["t6yuy77878"])) {
                    $error = $_GET["t6yuy77878"];
               /*?>
              <?php*/ 

          if ($error==$error_usernameorpassword) {
            echo "<div class='alert alert-dismissible alert-danger mt-3 font-weight-bold  bg-gradient-danger'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Incorrect Username or Password.</div>";
          }
          if ($error==$error_notverified) {
              echo "<div class='alert alert-dismissible alert-danger mt-3 font-weight-bold'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Your account is not verified yet, please ask your administrator to verify you.</div>";  } 
          if ($error==$error_notverifiedregisteration) {
            echo "<div class='alert alert-dismissible alert-success mt-3 font-weight-bold'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Account created! Your account is not verified yet, please ask your administrator to verify you.</div>";  } 
          }
          ?>  
               <?php if (!empty($errorMessage)) {?>
                <div class="col-md-12 grid-margin">
              <div class="card bg-dark border-0">
                <div class="card-body py-3 px-4 d-flex align-items-center justify-content-between flex-wrap">
                  <p class="mb-0 text-danger font-weight-medium"><?php echo $errorMessage; ?></p>
                  <div class="d-flex">
                    <button id="bannerClose" class="btn border-0 p-0">
                      <i class="mdi mdi-close text-white"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
              <?php }?>


            <div class="p-6 pt-6">

                      
                      <b class="-4">Create Account</b>

                            <form name="joinForm" id="joinForm" method="post" action="" class="mt-4">
                                <div class="grid w-full items-center gap-8">

                                  <input type="hidden" name="asInstitutionOrIndividualOrGroup" value="<?php echo $asInstitutionOrIndividualOrGroup;?>">

                                  <div class="flex flex-col space-y-1.5 text-green-500 font-bold">
                                    <?php echo $asInstitutionOrIndividualOrGroup;?> Account
                                  </div>
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="phoneNo" class="my-2">Phone Number (an OTP will be sent)</label>
                                    <input name="phoneNo"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="phoneNo" 
                                      placeholder="Your phone number e.g 08045678900"  
                                      value ="<?php echo $phoneNo;?>" 
                                      required 

                                    />
                                    <small><b>The number should be in the format 08045678900</b></small>
                                  </div>
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="emailAddress" class="my-2">Email</label>
                                    <input name="emailAddress"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="emailAddress" 
                                      placeholder="Your email address" 
                                      value ="<?php echo $emailAddress;?>"  
                                      required 
                                    />
                                  </div>
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="password" class="my-2">Password</label>
                                    <input name="password" 
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="password"
                                      placeholder="Password" 
                                      required 
                                    />
                                  </div>
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="confirm_password" class="my-2">Re-enter Password</label>
                                    <input name="confirm_password" 
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="confirm_password"
                                      placeholder="Re-enter password" 
                                      required 
                                    />
                                  </div>

                                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input"  name="acknowledge" id="acknowledge" >
                      I acknowledge and accept the terms &amp; conditions of <?php echo APP_FULLNAME; ?>
                    </label>
                  </div>

                                  

                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-lg hover:bg-brand-600" 
                                    name="joinFormButton" 
                                  >
                                    Create Account
                                  </button>
                                  <div class="flex justify-center">
                                    <a
                                      class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 underline-offset-4 hover:underline h-8 rounded-md px-3 text-md text-blue-600"
                                      href="index.php"
                                      >Already a user? Login</a
                                    >
                                  </div>
                                </div>
                              </form>
                              <script type="text/javascript">
                                document.getElementById('joinForm').addEventListener('submit', function(event) {
    const checkbox = document.getElementById('acknowledge');

    if (!checkbox.checked) {
        event.preventDefault(); // Prevent form submission
        alert('Please agree to the terms and conditions before submitting the form.');
    }
});

                              </script>
                              <script>
    const form = document.getElementById('joinForm');

    form.addEventListener('submit', function(event) {
        const password = document.getElementById('password').value;
        const passconf = document.getElementById('confirm_password').value;

        if (password !== passconf) {
            event.preventDefault(); // Prevent form submission
            alert('Passwords do not match. Please try again.');
        }

        const phoneNoInput = document.getElementById("phoneNo");
        var phoneNoValue = phoneNoInput.value.trim();

        // Check if the input is empty or not numeric or length is not 11
        if (phoneNoValue.trim() === "" || isNaN(phoneNoValue) || phoneNoValue.length !== 11 || phoneNoValue.charAt(0) !== '0' ) {
            // Prevent the form from being submitted 
            event.preventDefault();

            // Display an error message (you can customize this part)
            alert("Please enter a valid 11-digit phone number.");
        }

    });
</script>

    </div>
            
          </div>
        </div>
      </div>
    </main>
    <?php include_once('_footer.php');?>
  </body>
</html>


