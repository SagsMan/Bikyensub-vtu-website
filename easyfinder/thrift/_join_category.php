<?php
session_start();
include_once "ini.php";
include_once "functions.php";

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
    <link
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
    />
    <title>Create Account - <?php echo APP_FULLNAME  ;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="favicon.ico" type="image/x-icon" sizes="any" />
    <meta name="next-size-adjust" />

        <link rel="stylesheet" type="text/css" href="theme/vendors/bootstrap-icons-1.10.5/font/bootstrap-icons.min.css">       
<link
      rel="preload"
      as="font"
      href="theme/vendors/bootstrap-icons-1.10.5/font/bootstrap-icons.woff2"
      crossorigin=""
      type="font/woff2"
    />
    
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


            <div class="p-6 pt-6">

                      
                      <b class="-4">Select your category</b>

                            <form name="categoryForm" id="categoryForm" method="post" action="_join.php" class="mt-4">
                                <div class="grid w-full items-center gap-8">

                                  
                                  <div class="flex flex-col space-y-1.5x items-start">
                                      <div class="form-check">
                                        <i class="bi-building text-2xl"></i> <!-- Increase icon size to 2xl -->
                                        Sign up as an <b>Institution</b>
                                          <label class="form-check-label text-muted">
                                              <input 
                                                  type="radio" 
                                                  name="asInstitutionOrIndividualOrGroup"  
                                                  id="asInstitutionOrIndividualOrGroup" 
                                                  placeholder=""  
                                                  value="Institution"  
                                                  
                                              />
                                              
                                          </label>
                                      </div>
                                  </div>

                                  <div class="flex flex-col space-y-1.5x items-start">
                                      <div class="form-check">
                                          <label class="form-check-label text-muted">
                                            <i class="bi-person text-2xl"></i>
                                            Sign up as an <b>Individual</b>
                                              <input 
                                                  type="radio" 
                                                  name="asInstitutionOrIndividualOrGroup"  
                                                  id="asInstitutionOrIndividualOrGroup" 
                                                  placeholder=""  
                                                  value="Individual"  
                                                  
                                              />
                                              
                                          </label>
                                      </div>
                                  </div>

                                  <div class="flex flex-col space-y-1.5x items-start justify-content-between">
                                      <div class="form-check">
                                          <label class="form-check-label text-muted">
                                            <i class="bi-people text-2xl"></i>
                                              Sign up as a <b>Group</b>
                                              <input 
                                                  type="radio" 
                                                  name="asInstitutionOrIndividualOrGroup"  
                                                  id="asInstitutionOrIndividualOrGroup" 
                                                  placeholder=""  
                                                  value="Group" 
                                                  
                                              />

                                          </label>
                                      </div>
                                  </div>                            


                                  <div class="flex justify-center">
                                  <a 
                                  href="index.php" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-md hover:bg-dark mr-2"
                                  >
                                    Cancel
                                  </a>
                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-md hover:bg-brand-600" 
                                    name="categoryFormButton" 
                                  >
                                    Confirm
                                  </button>
                                </div>
                                  
                                </div>
                              </form>
                              <script type="text/javascript">
                                document.getElementById('categoryForm').addEventListener('submit', function(event) {
                                    const radioButtons = document.getElementsByName('asInstitutionOrIndividualOrGroup');
                                    let isRadioButtonChecked = false;

                                    radioButtons.forEach(radioButton => {
                                        if (radioButton.checked) {
                                            isRadioButtonChecked = true;
                                        }
                                    });

                                    if (!isRadioButtonChecked) {
                                        event.preventDefault(); // Prevent form submission
                                        alert('Please select an option before submitting the form.');
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


