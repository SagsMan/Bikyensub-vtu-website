<?php
session_start();
include_once "ini.php";
include_once "functions.php";
include_once "functions_custom.php";

if(isset($_SESSION[APP_SESSION_NAME]))
{   
  header("location: index.php");
  exit();
}

$otpCode = "";

//$loginVariableNamesArray = array("username","password","emailAddress","fullname");
$loginVariableNamesArray = array("otpCode");
$errorMessage ="";
$pdo = getMySQLPDOLink_(false,false);

$defaultPrivileges=Privileges_Default_Enabled;

$searchTerm='';

$phoneNo='';

/*SECTION: ERRORMESSAGES*/
$error_usernameorpassword = "eioy236rufjksdmkfjioeutr8u9fj";
$error_notverified = "ouieir786378632878976dueejdhskfjshfljhk";
$error_notverifiedregisteration = "ouieir78637863euoiueouo897892878976dueejdhskfjshfljhk";


if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST))
{
  if (validatePOSTS($loginVariableNamesArray) == true) {
    
    /*$fullname=sanitizeString_($_POST["fullname"]);
    $username=sanitizeString_($_POST["username"]);
    */
    $otpCode =sanitizeString_($_POST["otpCode"]);
    $otpfb='';

    if(isset(($_POST["djjskjksdjkjkjkljhf834ekhuyyhh-----------------------------------------------------------------sdsdf"]))){
     $otpfb =sanitizeString_($_POST["djjskjksdjkjkjkljhf834ekhuyyhh-----------------------------------------------------------------sdsdf"]);
    }

    try {

      $stmt = $pdo->prepare("SELECT * FROM `owners` WHERE (`guid`  IS NOT NULL AND `isVerified`  IS NOT NULL) AND `guid`=? AND `isVerified` <> ? ");
      $stmt->execute([$otpCode , 1]);
      $data = $stmt->fetchAll();

      if ( (!isset($data[0]) ) ){//} && !empty(isset($data[0]))  ) {

        //$errorMessage = "Sorry, that phone number (<b>".$phoneNo."</b>) is not available";
        $errorMessage = "Sorry, invalid OTP Code: ".$otpCode;

      }else if ( (isset($data[0]) )   && !empty(isset($data[0])) ) {
        //create owner
        //$stmt = $pdo->prepare("INSERT INTO `owners` (`username`,`password`,`emailAddress`,`fullname`) VALUES (?,?,?,?)");
        $stmt = $pdo->prepare("UPDATE `owners` SET `isVerified`=? WHERE `guid`=? ");
        $stmt->execute([ 1, $otpCode ]);
        
        $stmt = $pdo->prepare("UPDATE `users` SET `isLocked`=? WHERE `guid`=? ");
        $stmt->execute([ 1, $otpCode ]);


        //echo "string";exit();
          header("location: index.php?t6yuy77878=5ouieir78637863euoiueouo897892878976dueejdhskfjshfljhk"); 
        
        }

      

      

      //redirect_page_to(PAGE_TO_OPEN_AFTER_SUCCESSFUL_LOGIN);
      //$stmt->execute($loginVariableNamesArray);
    } catch (\PDOException $e) {
        $errorMessage .= "<b>Database error</b><br>";
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
 
}else{
  $errorMessage = "Sorry, invalid OTP Code: ".$otpCode;
}
}else{
  if(isset(($_GET["djjskjksdjkjkjkljhf834ekhuyyhh-----------------------------------------------------------------sdsdf"]))){
     $otpCode =sanitizeString_($_GET["djjskjksdjkjkjkljhf834ekhuyyhh-----------------------------------------------------------------sdsdf"]);

     if(!empty($otpCode)){
        $stmt = $pdo->prepare("SELECT * FROM `owners` WHERE (`guid`  IS NOT NULL ) AND `guid`=? ");
      $stmt->execute([$otpCode]);
      $data = $stmt->fetchAll();

      if ( (isset($data[0]) ) ){
        $phoneNo = $data[0]['phoneNo'];
     }
   }



   }
}


if(!empty($phoneNo)){
  $cleanPhoneNo = addCountryCode(trim($phoneNo));
  if(!empty($cleanPhoneNo) && strlen($cleanPhoneNo) == 14) { 
    $phoneNo = $cleanPhoneNo;
  }else{
    //$phoneNo = $cleanPhoneNo;
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
    <title>OTP Verification - <?php echo APP_FULLNAME  ;?></title>
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
              Your account is not verified yet</div>";  } 
          if ($error==$error_notverifiedregisteration) {
            echo "<div class='alert alert-dismissible alert-success mt-3 font-weight-bold'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Account created! Your account is not verified yet.</div>";  } 
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

              <style type="text/css">
                  .p-conf, .n-conf {
    width: calc(100% - 22px);
    border: 2px solid green;
    border-radius: 4px;
    padding: 8px 10px;
    margin: 4px 0px;
    background-color: rgba(0, 249, 12, 0.5);
    display: none;
  }
  .n-conf {
    border-color: red;
    background-color: rgba(255, 0, 4, 0.5);
  }
              </style>


            <div class="p-6 pt-6">

                      
                      <b class="-4">
                        <?php if (APP_OTP_TYPE=='emailAddress') {?>
                          Enter the verification code. Check your mail for the OTP (<?php echo $otpCode;?>) 
                        <?php }else if (APP_OTP_TYPE=='phoneNo') { ?>
                          <!--Verify you are not a robot and an OTP will be sent to your phone number. -->
                        <?php }?>
                      </b>

                            <form method="post" action="" class="mt-4">
                              <input type="hidden" id="otpfb" value="<?php echo $otpCode;?>">
                                <div class="grid w-full items-center gap-8">
                                  <div class="flex flex-col space-y-1.5">
                                    
                                    <div id="sender">
                                      <b class="sm:mt-8 lg:mt-16">
                                        <?php if (APP_OTP_TYPE=='emailAddress') {?>
                                          Enter the verification code. Check your mail for the OTP (<?php echo $otpCode;?>) 
                                        <?php }else if (APP_OTP_TYPE=='phoneNo') { ?>
                                          Verify you are not a robot and an OTP will be sent to your phone number. 
                                        <?php }?>
                                        
                                      </b><br>
                                      <label for="phoneNo" class="my-2">Phone Number</label>
                                      <input type="text" 
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="phoneNo" 
                                      placeholder="+234.."  
                                      value ="<?php echo $phoneNo;?>" 
                                      required 
                                      readonly 

                                      >
                                      <div id="recaptcha-container" class="mt-2"></div>
                                      <div class="flex justify-center">
                                        <button 
                                         type="button" 
                                         id="send" 
                                         value="Send" 
                                          class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-md hover:bg-brand-600 mt-4" 
                                          onClick="phoneAuth()"
                                        >
                                          Send
                                        </button>
                                      </div>
                                    </div>
                                    <div id="verifier" style="display: none">
                                      
                                      <input 
                                      type="text" 
                                      name="otpCode"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="verificationcode" 
                                      placeholder="Enter OTP"  
                                      value ="" 
                                      required 

                                    />

                                      <div class="flex justify-center">
                                      <button 
                                         type="button" 
                                         id="verify" 
                                         value="Verify" 
                                          class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-md hover:bg-brand-600 mt-4" 
                                          onClick="codeverify()" 
                                        >
                                          Verify
                                      </button>
                                    </div>

                                      <div class="p-conf mt-2" style="font-weight: bold;color: green;text-align: center;">Number Verified</div>
                                      <div class="n-conf mt-2" style="font-weight: bold;color: green;text-align: center;">OTP ERROR</div>
                                    </div>



                                  </div>



                                  <!--div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input"  name="acknowledge" >
                      I acknowledge and accept the terms &amp; conditions of <?php echo APP_FULLNAME; ?>
                    </label>
                  </div-->

                  <div class="flex justify-center">
                                    <a
                                      class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 underline-offset-4 hover:underline h-8 rounded-md px-3 text-md text-blue-600"
                                      href="_otp.php?djjskjksdjkjkjkljhf834ekhuyyhh-----------------------------------------------------------------sdsdf=<?php echo $otpCode;?>"
                                      >Don`t get a verification code?</a
                                    >
                                  </div>
                                  

                                  <!--div class="flex justify-center">
                                  <a 
                                  href="index.php" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-md hover:bg-dark mr-2"
                                  >
                                    Cancel
                                  </a>
                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-md hover:bg-brand-600"
                                  >
                                    Confirm
                                  </button>
                                </div-->
                                  
                                </div>
                              </form>

    </div>
            
          </div>
        </div>
      </div>
    </main>
    <?php include_once('_footer.php');?>

<!--  add firebase SDK-->
<script src="https://www.gstatic.com/firebasejs/9.12.1/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.12.1/firebase-auth-compat.js"></script>
<script>
  
// Your web app's Firebase configuration

// For Firebase JS SDK v7.20.0 and later, measurementId is optional

const firebaseConfig = {
  apiKey: "AIzaSyAFyYUyI5KFFVPS24C0pU1MxLVWvVPGnDo",
  authDomain: "otps-ecfd6.firebaseapp.com",
  projectId: "otps-ecfd6",
  storageBucket: "otps-ecfd6.appspot.com",
  messagingSenderId: "492626400858",
  appId: "1:492626400858:web:bf7c036e8b5fdaf4ff2a63",
  measurementId: "G-QK00CNGN94"
};


// Initialize Firebase
firebase.initializeApp(firebaseConfig);

//const app = initializeApp(firebaseConfig);
//const analytics = getAnalytics(app);





render();




function render(){
  window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
  recaptchaVerifier.render();
}
  // function for send message
function phoneAuth(){
  var number = document.getElementById('phoneNo').value;
  firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function(confirmationResult){
    window.confirmationResult = confirmationResult;
    coderesult = confirmationResult;

    document.getElementById('sender').style.display = 'none';
    document.getElementById('verifier').style.display = 'block';
  }).catch(function(error){
    alert(error.message);
  });
}
  // function for code verify
function codeverify(){
  var code = document.getElementById('verificationcode').value;
  coderesult.confirm(code).then(function(){
    document.getElementsByClassName('p-conf')[0].style.display = 'block';
    document.getElementsByClassName('n-conf')[0].style.display = 'none';
    verifySend()
  }).catch(function(){
    document.getElementsByClassName('p-conf')[0].style.display = 'none';
    document.getElementsByClassName('n-conf')[0].style.display = 'block';
  })
}
</script>


<script type="text/javascript">
  function verifySend(){

    var code = document.getElementById('verificationcode').value;
    var otpfb = document.getElementById('otpfb').value;
    // Create a new XMLHttpRequest object
var xhr = new XMLHttpRequest();

// Configure it: POST method and the URL of the PHP script
xhr.open("POST", "_otp_verify.php", true);

// Set the content type of the request
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

// Define what happens on successful data submission
xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) {
        // Request was successful, handle the response here if needed
        console.log(xhr.responseText);

         // Parse the response (assuming it's JSON)
            var response = JSON.parse(xhr.responseText);

            // Check the response and change the page content accordingly
            if (response==1) {
                // Change the page content
                //document.body.innerHTML = "<h1>Verification Successful!</h1>";
                window.location.href = "index.php?t6yuy77878=5ouieir78637863euoiueouo897892878976dueejdhskfjshfljhk";
            } else {
                // Verification failed, show an error message or handle it as needed
                console.error("Verification failed: " + response.error);
            }




    } else {
        // Request failed with an error status, handle the error here
        console.error('Request failed with status:', xhr.status);
    }
};

// Prepare the data to be sent (assuming you want to send a key-value pair)
//var data = "otpCode="+code;
// Prepare the data to be sent (sending three values as key-value pairs)
//var data = "otpCode=" + code + "&key2=" + value2 + "&key3=" + value3;
var data = "otpCode=" + otpfb + "&djjskjksdjkjkjkljhf834ekhuyyhh-----------------------------------------------------------------sdsdf=" + code ;

// Send the request with the data
xhr.send(data);

  }


  function addCountryCode(phoneNo) {
    // Remove any non-numeric characters from the phone number
    var cleanPhoneNo = phoneNo.replace(/\D/g, '');

    // Check if the cleaned phone number is 11 digits long
    if(cleanPhoneNo.length === 11) {
        // If it starts with '0', remove '0' and add '+222'
        if(cleanPhoneNo.charAt(0) === '0') {
            cleanPhoneNo = '+222' + cleanPhoneNo.substring(1);
            return cleanPhoneNo;
        } else {
            // If it doesn't start with '0', add '+222'
            return '+222' + cleanPhoneNo;
        }
    } else {
        // If the phone number is not 11 digits long, return an error message
        return "Invalid phone number";
    }
}

// Example usage:
var phoneNo = "01234567890"; // Replace this with the phone number you want to test
var result = addCountryCode(phoneNo);
console.log(result);

</script>

  </body>
</html>


