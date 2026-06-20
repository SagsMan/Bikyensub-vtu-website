<?php
session_start();
include_once "ini.php";
include_once "functions.php";

if(isset($_SESSION[APP_SESSION_NAME]))
{   
  header("location: index.php");
  exit();
}





$searchTerm='';


//PERSON
$fullname='';
$emailAddress='';
$phoneNo='';
$address='';
$username='';
$password='';
$createdBy='';
$logoPath='';
$updatedBy='';
$createdOn='';
$updatedOn='';
$ownerId='';
$userId='';
$appId='';
$isActive='';
$isLocked='';
$isDeleted='';
$isChanged='';
$isSynced='';
$isAdmin='';
$syncedOn='';
$oldId='';
$ownerGuid='';
$privileges='';
$guid='';
$firstName='';
$middleName='';
$lastName='';
$gender='';
$dateOfBirth='';
$addressWork='';
$qualification='';
$maritalStatus='';
$monthlyIncome='';
$bankId='';
$accountNo='';

$otpcode='';

$category='';
$govtCertificate='';
 $addressWork='';
 $regNo='';
 $companyBriefHistory='';
 $position='';
 $dateOfAssumption=null;
 $briefHistory='';

$companyFullname='';
$companyEmailAddress='';
$companyPhoneNo='';
$companyAddress='';
$companyRegNo='';
$companyBankId= -1;
$companyBankName= '';
$companyBankAccountName= '';
$companyAddress= '';

$companyPassword= '';



//JOIN FORM
$asCategory='';
$emailAddress ="";
$phoneNo='';
$acknowledge= -1;



$step=1;//hjkhj_________khjkhjkhjku75657_khjkhjkhjku75657_khjkhjkhjku75657_khjkhjkhjku75657_khjkhjkhjku75657_khjkhjkhjku75657_____________khjkhjkhjku75657---------------------------------------------------jjiuuiy7

if(isset($_SESSION['signuflow']['step'])){
  $step=$_SESSION['signuflow']['step'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["asCategory"])) {
        $asCategory = $_POST["asCategory"];
        // Now $selectedOption contains the value of the selected radio button
        // You can use this value for further processing
       // echo "Selected option: " . $asCategory;
    } else {
        echo "No option selected!";
    }//
}else if ($_SERVER["REQUEST_METHOD"] == "GET") {

  if (isset($_GET['hjkhj_________khjkhjkhjku75657_khjkhjkhjku75657_khjkhjkhjku75657_khjkhjkhjku75657_khjkhjkhjku75657_khjkhjkhjku75657_____________khjkhjkhjku75657---------------------------------------------------jjiuuiy7'])) {
    $step = sanitizeString_($_GET['hjkhj_________khjkhjkhjku75657_khjkhjkhjku75657_khjkhjkhjku75657_khjkhjkhjku75657_khjkhjkhjku75657_khjkhjkhjku75657_____________khjkhjkhjku75657---------------------------------------------------jjiuuiy7']);

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

        <link rel="stylesheet" type="text/css" href="theme/vendors/bootstrap-icons-1.10.5/font/bootstrap-icons.min.css">       
<link
      rel="preload"
      as="font"
      href="theme/vendors/bootstrap-icons-1.10.5/font/bootstrap-icons.woff2"
      crossorigin=""
      type="font/woff2"
    />

    <?php include_once('_css.php');?>

    
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
                .form {
   display: none;
   opacity: 0;
   transition: opacity 0.5s ease-in-out;
}

.form.show {
   display: block;
   opacity: 1;
}

              </style>

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
              <!--
              1. category
                2. institution
                  3. Non-Profit
                    4. Government
                      5. form
                    1112. NGO
                    1113. Religious
                    1114. Political
                  112.  Profit






              -->

                      

                      <!-- CATEGORY -->
                      
                            <form name="categoryForm" id="form1" idx="categoryForm" method="post" action="_join.php" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                  <div class="grid w-full items-center gap-8">

                                    <b class="-4">Select your category</b>

                                    
                                    <div class="flex flex-col space-y-1.5x items-start">
                                        <div class="form-check">
                                          <i class="bi-building text-2xl"></i> <!-- Increase icon size to 2xl -->
                                          Sign up as an <b>Institution</b>
                                            <label class="form-check-label text-muted">
                                                <input 
                                                    type="radio" 
                                                    name="asCategory"  
                                                    id="asCategory" 
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
                                                    name="asCategory"  
                                                    id="asCategory" 
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
                                                    name="asCategory"  
                                                    id="asCategory" 
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

                            <form name="institutionForm" id="form2" method="post" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                  <div class="grid w-full items-center gap-8">

                                    <b class="-4">Institutional Registration</b>

                                    
                                    <div class="flex flex-col space-y-1.5x items-start">
                                        <div class="form-check">
                                          <i class="bi-umbrella text-2xl"></i> <!-- Increase icon size to 2xl -->
                                          Non-Profit Organisation
                                            <label class="form-check-label text-muted">
                                                <input 
                                                    type="radio" 
                                                    name="asInstitution"  
                                                    id="asInstitution" 
                                                    placeholder=""  
                                                    value="Non-Profit Organisation"  
                                                    
                                                />
                                                
                                            </label>
                                        </div>
                                    </div>

                                    <div class="flex flex-col space-y-1.5x items-start">
                                        <div class="form-check">
                                            <label class="form-check-label text-muted">
                                              <i class="bi-cash text-2xl"></i>
                                              Profit Oriented Funding
                                                <input 
                                                    type="radio" 
                                                    name="asInstitution"  
                                                    id="asInstitution" 
                                                    placeholder=""  
                                                    value="Profit Oriented Funding"  
                                                    
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
                                        name="intitutionFormButton" 
                                      >
                                        Confirm
                                      </button>
                                    </div>
                                  
                                </div>
                            </form>

                            <form name="nonProfitForm" id="form3" method="post" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                  <div class="grid w-full items-center gap-8">

                                    <b class="-4">Non-Profit Organisation</b>

                                    
                                    <div class="flex flex-col space-y-1.5x items-start">
                                        <div class="form-check">
                                          <i class="bi-building text-2xl"></i> <!-- Increase icon size to 2xl -->
                                          Government
                                            <label class="form-check-label text-muted">
                                                <input 
                                                    type="radio" 
                                                    name="asNonProfit"  
                                                    id="asNonProfit" 
                                                    placeholder=""  
                                                    value="Government"  
                                                    
                                                />
                                                
                                            </label>
                                        </div>
                                    </div>

                                    <div class="flex flex-col space-y-1.5x items-start">
                                        <div class="form-check">
                                            <label class="form-check-label text-muted">
                                              <i class="bi-cash text-2xl"></i>
                                              NGO
                                                <input 
                                                    type="radio" 
                                                    name="asNonProfit"  
                                                    id="asNonProfit" 
                                                    placeholder=""  
                                                    value="NGO"  
                                                    
                                                />
                                                
                                            </label>
                                        </div>
                                    </div>

                                    <div class="flex flex-col space-y-1.5x items-start">
                                        <div class="form-check">
                                            <label class="form-check-label text-muted">
                                              <i class="bi-cash text-2xl"></i>
                                              Religious Body
                                                <input 
                                                    type="radio" 
                                                    name="asNonProfit"  
                                                    id="asNonProfit" 
                                                    placeholder=""  
                                                    value="Religious Body"  
                                                    
                                                />
                                                
                                            </label>
                                        </div>
                                    </div>


                                    <div class="flex flex-col space-y-1.5x items-start">
                                        <div class="form-check">
                                            <label class="form-check-label text-muted">
                                              <i class="bi-cash text-2xl"></i>
                                              Political Body
                                                <input 
                                                    type="radio" 
                                                    name="asNonProfit"  
                                                    id="asNonProfit" 
                                                    placeholder=""  
                                                    value="Political Body"  
                                                    
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
                                        name="nonProfitFormButton" 
                                      >
                                        Confirm
                                      </button>
                                    </div>
                                  
                                </div>
                            </form>

                      <!-- CATEGORY END -->

                          <!-- GOVT -->

                            <form name="governmentForm" id="form4" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                <div class="grid w-full items-center gap-2">

                                                        <b class="-4">Create Account</b>

                                  <input type="hidden" name="asCategory" value="<?php echo $asCategory;?>">

                                  <div class="flex flex-col space-y-1.5 text-green-500 font-bold">
                                    <?php echo ($asCategory) ? $asCategory : 'Government Organisation'; ?> Account
                                  </div>
                                  
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyFullname" class="my-2">Name of Govt. Organisation</label>
                                    <input name="companyFullname"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyFullname" 
                                      placeholder="Name of Govt. Organisation"  
                                      value ="<?php echo $companyFullname;?>" 
                                      required 

                                    />
                                    <small><b></b></small>
                                  </div>

                                  <div class="flex flex-col space-y-1.5x">
                                    <label for="companyEmailAddress" class="my-2">Work Email</label>
                                    <input name="companyEmailAddress"  
                                    type="email" 
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyEmailAddress" 
                                      placeholder="Your company email address" 
                                      value ="<?php echo $companyEmailAddress;?>"  
                                      required 
                                    />
                                  </div>

                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyRegNo" class="my-2">Reg. No</label>
                                    <input name="companyRegNo"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyRegNo" 
                                      placeholder="Your company reg no" 
                                      value ="<?php echo $companyRegNo;?>"  
                                      required 
                                    />
                                  </div>

                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyBriefHistory" class="my-2 font-bold">Brief History</label>
                                    <textarea name="companyBriefHistory"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyBriefHistory" 
                                      placeholder="Your company brief history" 
                                      
                                      required 
                                    /><?php echo $companyBriefHistory;?></textarea>
                                  </div>


                                  <hr>
                                  here
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyPassword" class="my-2 font-bold">Password</label>
                                    <input name="companyPassword" 
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyPassword"
                                      placeholder="Password" 
                                      required 
                                    />
                                  </div>
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyConfirmPassword" class="my-2 font-bold">Re-enter Password</label>
                                    <input name="companyConfirmPassword" 
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyConfirmPassword"
                                      placeholder="Re-enter password" 
                                      required 
                                    />
                                  </div>

                                 

                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-lg hover:bg-brand-600" 
                                    name="governmentFormButton" 
                                  >
                                    Confirm
                                  </button>

                                  <button 
                                    id="backBtn2" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-lg hover:bg-secondary-600" 
                                    name="joinFormButton" 
                                  >
                                    Back
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

                            <form name="governmentAddressForm" id="form5" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                <div class="grid w-full items-center gap-2">

                                                        <b class="-4">Create Account</b>

                                  <input type="hidden" name="asCategory" value="<?php echo $asCategory;?>">

                                  <div class="flex flex-col space-y-1.5 text-green-500 font-bold">
                                    <?php echo ($asCategory) ? $asCategory : 'Government Organisation'; ?> Account
                                  </div>
                                  
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyAddress" class="my-2">Address</label>
                                    <input name="companyAddress"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyAddress" 
                                      placeholder="Address"  
                                      value ="<?php echo $companyAddress;?>" 
                                      required 

                                    />
                                    <small><b>Address and Sub Addresses imcluding contact telephone number, PMB, City, State</b></small>
                                  </div>
                                                                  
                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-lg hover:bg-brand-600" 
                                    name="governmentFormButton" 
                                  >
                                    Confirm
                                  </button>

                                  <button 
                                    id="backBtn2" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-lg hover:bg-secondary-600" 
                                    name="joinFormButton" 
                                  >
                                    Back
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

                            <form name="governmentContactsForm" id="form6" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                <div class="grid w-full items-center gap-2">

                                                        <b class="-4">Principal Officers</b>

                                  
                                  <div class="flex flex-col space-y-1.5 text-green-500 font-bold">
                                    <?php echo ($asCategory) ? $asCategory : 'Government Organisation'; ?> Account
                                  </div>
                                  
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyFullname" class="my-2">
                                      <a href="" id="addContactBtn" class="bg-brand-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                      Add Contact
                                    </a>
                                    </label>

                                    <!------------------------------------------------------------------------------------------ ---->
                                      <!-- Add Button to Trigger Modal -->
                                          

                                          <!-- Table -->
                                          <div class="overflow-x-auto">
                                            <table class="min-w-full border border-collapse">
                                              <thead>
                                                <tr>
                                                  <th class="border p-2">Full Name</th>
                                                  <th class="border p-2">Position</th>
                                                  <th class="border p-2">Contact</th>
                                                  <th class="border p-2">Date of Assumption</th>
                                                  <th class="border p-2">Brief History</th>
                                                </tr>
                                              </thead>
                                              <tbody id="contactTableBody">
                                                <!-- Table rows will be added dynamically using JavaScript -->
                                              </tbody>
                                            </table>
                                            <p>Name and number of principal officers and ranking in the organisation</p>
                                          </div>
                                        
                                      <!-- Modal Form for Adding/Updating Contact -->
                                      <div id="contactModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
                                        <div class="modal-container bg-white w-96 mx-auto p-6 rounded-lg shadow-lg">
                                          <!-- Modal content will be added dynamically using JavaScript -->
                                        </div>
                                      </div>

                                      <!-- Tailwind CSS link -->
                                      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">

                                      <script type="text/javascript">
                                        
                                        let contacts = [];

                                        // Function to render the table rows
                                        function renderTable() {
                                          const tableBody = document.getElementById('contactTableBody');
                                          tableBody.innerHTML = '';

                                          contacts.forEach((contact, index) => {
                                            const row = document.createElement('tr');
                                            row.innerHTML = `
                                              <td class="border p-2">${contact.fullname}</td>
                                              <td class="border p-2">${contact.position}</td>
                                              <td class="border p-2">${contact.contact}</td>
                                              <td class="border p-2">${contact.dateOfAssumption}</td>
                                              <td class="border p-2">${contact.briefHistory}</td>
                                              <td class="border p-2">
                                                <a href="" id="editContactButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-2" onclick="editContact(${index})">Edit</a>
                                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="deleteContact(${index})">Delete</button>
                                              </td>
                                            `;
                                            tableBody.appendChild(row);
                                          });
                                        }

                                        // Function to show modal for adding/updating contact
                                        function showModal(isEditing, index) {
                                          const modal = document.getElementById('contactModal');
                                          modal.classList.remove('hidden');

                                          const selectedContact = isEditing ? contacts[index] : { fullname: '', position: '', contact: '', dateOfAssumption: '', briefHistory: '' };

                                          const modalContent = `
                                            <h2 class="text-lg font-bold mb-4">${isEditing ? 'Edit' : 'Add'} Contact</h2>
                                            <form id="contactForm">
                                              <label for="fullname" class="block mb-2">Full Name:</label>
                                              <input type="text" id="fullname" name="fullname" class="border p-2 mb-4 w-full" required value="${selectedContact.fullname}">

                                              <label for="position" class="block mb-2">Position:</label>
                                              <input type="text" id="position" name="position" class="border p-2 mb-4 w-full" required value="${selectedContact.position}">

                                              <label for="contact" class="block mb-2">Contact:</label>
                                              <input type="text" id="contact" name="contact" class="border p-2 mb-4 w-full" required value="${selectedContact.contact}">

                                              <label for="dateOfAssumption" class="block mb-2">Date of Assumption:</label>
                                              <input type="date" id="dateOfAssumption" name="dateOfAssumption" class="border p-2 mb-4 w-full" required value="${selectedContact.dateOfAssumption}">

                                              <label for="briefHistory" class="block mb-2">Brief History:</label>
                                              <textarea id="briefHistory" name="briefHistory" class="border p-2 mb-4 w-full" required>${selectedContact.briefHistory}</textarea>

                                              <div class="flex justify-end">
                                                <a id="contactFormUpdateButton" href="" class="bg-brand-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                  ${isEditing ? 'Save' : 'Add'}
                                                </a>
                                                <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" onclick="hideModal()">
                                                  Cancel
                                                </button>
                                              </div>
                                            </form>
                                          `;

                                          const modalContainer = document.querySelector('.modal-container');
                                          modalContainer.innerHTML = modalContent;

                                          //document.getElementById('contactForm').addEventListener('submit', function(event) {
                                          document.getElementById('contactFormUpdateButton').addEventListener('click', function(event) {
                                            
                                            event.preventDefault();
                                            const fullname = document.getElementById('fullname').value;
                                            const position = document.getElementById('position').value;
                                            const contact = document.getElementById('contact').value;
                                            const dateOfAssumption = document.getElementById('dateOfAssumption').value;
                                            const briefHistory = document.getElementById('briefHistory').value;

                                            if (isEditing) {
                                              contacts[index] = { fullname, position, contact, dateOfAssumption, briefHistory };
                                            } else {
                                              contacts.push({ fullname, position, contact, dateOfAssumption, briefHistory });
                                            }

                                            hideModal();
                                            renderTable();
                                          });
                                        }

                                       

                                        function editContact(index) {
                                          event.preventDefault()
                                          showModal(true, index);
                                        }

                                        function deleteContact(index) {
                                          if (confirm('Are you sure you want to delete this contact?')) {
                                            contacts.splice(index, 1);
                                            renderTable();
                                          }
                                        }

                                        function hideModal() {
                                          const modal = document.getElementById('contactModal');
                                          modal.classList.add('hidden');
                                        }

                                        document.getElementById('addContactBtn').addEventListener('click', function(event) {
                                          event.preventDefault()
                                          showModal(false);
                                        });

                                        // Initial render of the table
                                        renderTable();
                                      </script>



                                    <!----------------------------- ---------------------------------------------------------->
                                  </div>

                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-lg hover:bg-brand-600" 
                                    name="governmentContactsFormButton" 
                                  >
                                    Confirm
                                  </button>

                                  <button 
                                    id="backBtn2" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-lg hover:bg-secondary-600" 
                                    name="joinFormButton" 
                                  >
                                    Back
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

                            <form name="governmentCertificateUploadForm" id="form7" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                <div class="grid w-full items-center gap-2">

                                                        <b class="-4">Create Account</b>

                                  <input type="hidden" name="asCategory" value="<?php echo $asCategory;?>">

                                  <div class="flex flex-col space-y-1.5 text-green-500 font-bold">
                                    <?php echo ($asCategory) ? $asCategory : 'Government Organisation'; ?> Account
                                  </div>
                                  
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyFullname" class="my-2">Upload Govt. Certificate</label>
                                    <input name="companyGovtCertificate"
                                      type="file"
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyGovtCertificate"
                                      required />
                                    <small><b>All statutory documents of the organisation and its directors be downloaded here.</b></small>
                                  </div>

                                  <div id="progress-container" class="hidden mt-2">
                                    <div id="progress-bar" class="bg-blue-500 text-white py-1 rounded text-center w-0"></div>
                                    <div id="progress-text" class="text-gray-600 text-sm mt-1">0%</div>
                                  </div>
                           

                                 


                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-lg hover:bg-brand-600" 
                                    name="governmentCertificateUploadFormButton" 
                                  >
                                    Confirm
                                  </button>

                                  <button 
                                    id="backBtn2" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-lg hover:bg-secondary-600" 
                                    name="joinFormButton" 
                                  >
                                    Back
                                  </button>
                                  <!--div class="flex justify-center">
                                    <a
                                      class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 underline-offset-4 hover:underline h-8 rounded-md px-3 text-md text-blue-600"
                                      href="index.php"
                                      >Already a user? Login</a
                                    >
                                  </div-->
                                </div>
                            </form>

                            <form name="governmentBankForm" id="form8" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                <div class="grid w-full items-center gap-2">

                                                        <b class="-4">Create Account</b>

                                  <input type="hidden" name="asCategory" value="<?php echo $asCategory;?>">

                                  <div class="flex flex-col space-y-1.5 text-green-500 font-bold">
                                    <?php echo ($asCategory) ? $asCategory : 'Government Organisation'; ?> Account
                                  </div>
                                  
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyBankName" class="my-2">Bank Name</label>
                                    <input name="companyBankName"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyBankName" 
                                      placeholder="Your bank name"  
                                      value ="<?php echo $companyBankName;?>" 
                                      required 

                                    />
                                    <small><b></b></small>
                                  </div>
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyBankAccountName" class="my-2">Account Name</label>
                                    <input name="companyBankAccountName"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyBankAccountName" 
                                      placeholder="Your bank account name"  
                                      value ="<?php echo $companyBankAccountName;?>" 
                                      required 

                                    />
                                    <small><b>Details of bank Accounts from various banks.</b></small>
                                  </div>

                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-lg hover:bg-brand-600" 
                                    name="governmentBankFormButton" 
                                  >
                                    Confirm
                                  </button>

                                  <button 
                                    id="backBtn2" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-lg hover:bg-secondary-600" 
                                    name="joinFormButton" 
                                  >
                                    Back
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

                        <!-- GOVT END -->



                        <!-- NGO -->

                            <form name="NGOForm" id="form101" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                <div class="grid w-full items-center gap-2">

                                                        <b class="-4">Create Account</b>

                                  <input type="hidden" name="asCategory" value="<?php echo $asCategory;?>">

                                  <div class="flex flex-col space-y-1.5 text-green-500 font-bold">
                                    <?php echo ($asCategory) ? $asCategory : 'NGO'; ?> Account
                                  </div>
                                  
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyFullname_NGO" class="my-2">Name of Organisation</label>
                                    <input name="companyFullname_NGO"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyFullname_NGO" 
                                      placeholder="Name of Organisation"  
                                      value ="<?php echo $companyFullname;?>" 
                                      required 

                                    />
                                    <small><b></b></small>
                                  </div>


                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyRegNo_NGO" class="my-2">Reg. No</label>
                                    <input name="companyRegNo_NGO"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyRegNo_NGO" 
                                      placeholder="Your reg no" 
                                      value ="<?php echo $companyRegNo;?>"  
                                      required 
                                    />
                                  </div>

                                  <div class="flex flex-col space-y-1.5x">
                                    <label for="companyEmailAddress_NGO" class="my-2">Email (an OTP will be sent)</label>
                                    <input name="companyEmailAddress_NGO"  
                                    type="email" 
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyEmailAddress_NGO" 
                                      placeholder="Your email address" 
                                      value ="<?php echo $companyEmailAddress;?>"  
                                      required 
                                    />
                                  </div>


                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyPhoneNo_NGO" class="my-2">Phone Number</label>
                                    <input name="companyPhoneNo_NGO"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyPhoneNo_NGO" 
                                      placeholder="Your phone number e.g 08045678900"  
                                      value ="<?php echo $phoneNo;?>" 
                                      required 

                                    />
                                    <small><b>The number should be in the format 08045678900</b></small>
                                  </div>


                                  <hr>

                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyPassword_NGO" class="my-2 font-bold">Password</label>
                                    <input name="companyPassword_NGO" 
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyPassword_NGO"
                                      placeholder="Password" 
                                      required 
                                    />
                                  </div>
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyConfirmPassword_NGO" class="my-2 font-bold">Re-enter Password</label>
                                    <input name="companyConfirmPassword_NGO" 
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyConfirmPassword_NGO"
                                      placeholder="Re-enter password" 
                                      required 
                                    />
                                  </div>

                                 

                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-lg hover:bg-brand-600" 
                                    name="NGOFormButton" 
                                  >
                                    Confirm
                                  </button>

                                  <button 
                                    id="backBtn2" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-lg hover:bg-secondary-600" 
                                    name="joinFormButton" 
                                  >
                                    Back
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

                            <form name="NGOAddressForm" id="form102" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                <div class="grid w-full items-center gap-2">

                                                        <b class="-4">Create Account</b>

                                  <input type="hidden" name="asCategory" value="<?php echo $asCategory;?>">

                                  <div class="flex flex-col space-y-1.5 text-green-500 font-bold">
                                    <?php echo ($asCategory) ? $asCategory : 'NGO'; ?> Account
                                  </div>
                                  
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyAddress_NGO" class="my-2">Address</label>
                                    <input name="companyAddress_NGO"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyAddress_NGO" 
                                      placeholder="Address"  
                                      value ="<?php echo $companyAddress;?>" 
                                      required 

                                    />
                                    <small><b>Address and Sub Addresses imcluding contact telephone number, PMB, City, State</b></small>
                                  </div>
                                                                  
                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-lg hover:bg-brand-600" 
                                    name="NGOAddressFormButton" 
                                  >
                                    Confirm
                                  </button>

                                  <button 
                                    id="backBtn2" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-lg hover:bg-secondary-600" 
                                    name="joinFormButton" 
                                  >
                                    Back
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

                            <form name="NGOContactsForm" id="form103" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                <div class="grid w-full items-center gap-2">

                                                        <b class="-4">Principal Officers</b>

                                  
                                  <div class="flex flex-col space-y-1.5 text-green-500 font-bold">
                                    <?php echo ($asCategory) ? $asCategory : 'NGO'; ?> Account
                                  </div>
                                  
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="addContactBtn_NGO" class="my-2">
                                      <a href="" id="addContactBtn_NGO" class="bg-brand-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                      Add Contact
                                    </a>
                                    </label>

                                    <!------------------------------------------------------------------------------------------ ---->
                                      <!-- Add Button to Trigger Modal -->
                                          

                                          <!-- Table -->
                                          <div class="overflow-x-auto">
                                            <table class="min-w-full border border-collapse">
                                              <thead>
                                                <tr>
                                                  <th class="border p-2">Full Name</th>
                                                  <th class="border p-2">Position</th>
                                                  <th class="border p-2">Contact</th>
                                                  <th class="border p-2">Phone No</th>
                                                </tr>
                                              </thead>
                                              <tbody id="contactTableBody_NGO">
                                                <!-- Table rows will be added dynamically using JavaScript -->
                                              </tbody>
                                            </table>
                                            <p>Name and number of principal officers and ranking in the organisation</p>
                                          </div>
                                        
                                      <!-- Modal Form for Adding/Updating Contact -->
                                      <div id="contactModal_NGO" class="fixed inset-0 flex items-center justify-center z-50 hidden">
                                        <div class="modal-container_NGO bg-white w-96 mx-auto p-6 rounded-lg shadow-lg">
                                          <!-- Modal content will be added dynamically using JavaScript -->
                                        </div>
                                      </div>

                                      <!-- Tailwind CSS link -->
                                      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">

                                      <script type="text/javascript">
                                        
                                        //let contacts = [];

                                        // Function to render the table rows
                                        function renderTable_NGO() {
                                          const tableBody = document.getElementById('contactTableBody_NGO');
                                          tableBody.innerHTML = '';

                                          contacts.forEach((contact, index) => {
                                            const row = document.createElement('tr');
                                            row.innerHTML = `
                                              <td class="border p-2">${contact.fullname}</td>
                                              <td class="border p-2">${contact.position}</td>
                                              <td class="border p-2">${contact.address}</td>
                                              <td class="border p-2">${contact.phoneNo}</td>
                                              
                                              <td class="border p-2">
                                                <a href="" id="editContactButton_NGO" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-2" onclick="editContact_NGO(${index})">Edit</a>
                                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="deleteContact_NGO(${index})">Delete</button>
                                              </td>
                                            `;
                                            tableBody.appendChild(row);
                                          });
                                        }

                                        // Function to show modal for adding/updating contact
                                        function showModal_NGO(isEditing, index) {
                                          const modal = document.getElementById('contactModal_NGO');
                                          modal.classList.remove('hidden');

                                          const selectedContact = isEditing ? contacts[index] : { fullname: '', position: '', address: '', phoneNo: '' };

                                          const modalContent = `
                                            <h2 class="text-lg font-bold mb-4">${isEditing ? 'Edit' : 'Add'} Contact</h2>
                                            <form id="contactForm_NGO">
                                              <label for="fullname_NGO" class="block mb-2">Full Name:</label>
                                              <input type="text" id="fullname_NGO" name="fullname_NGO" class="border p-2 mb-4 w-full" required value="${selectedContact.fullname}">

                                              <label for="position_NGO" class="block mb-2">Position:</label>
                                              <input type="text" id="position_NGO" name="position_NGO" class="border p-2 mb-4 w-full" required value="${selectedContact.position}">

                                              <label for="address_NGO" class="block mb-2">Contact:</label>
                                              <input type="text" id="address_NGO" name="address_NGO" class="border p-2 mb-4 w-full" required value="${selectedContact.address}">

                                              <label for="phoneNo_NGO" class="block mb-2">Brief History:</label>
                                              <textarea id="phoneNo_NGO" name="phoneNo_NGO" class="border p-2 mb-4 w-full" required>${selectedContact.phoneNo}</textarea>

                                              <div class="flex justify-end">
                                                <a id="contactFormUpdateButton_NGO" href="" class="bg-brand-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                  ${isEditing ? 'Save' : 'Add'}
                                                </a>
                                                <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" onclick="hideModal_NGO()">
                                                  Cancel
                                                </button>
                                              </div>
                                            </form>
                                          `;

                                          const modalContainer = document.querySelector('.modal-container_NGO');
                                          modalContainer.innerHTML = modalContent;

                                          //document.getElementById('contactForm').addEventListener('submit', function(event) {
                                          document.getElementById('contactFormUpdateButton_NGO').addEventListener('click', function(event) {
                                            
                                            event.preventDefault();
                                            const fullname = document.getElementById('fullname_NGO').value;
                                            const position = document.getElementById('position_NGO').value;
                                            const address = document.getElementById('address_NGO').value;
                                            const phoneNo = document.getElementById('phoneNo_NGO').value;
                                            

                                            if (isEditing) {
                                              contacts[index] = { fullname, position, address, phoneNo };
                                            } else {
                                              contacts.push({ fullname, position, address, phoneNo });
                                            }

                                            hideModal_NGO();
                                            renderTable_NGO();
                                          });
                                        }

                                       

                                        function editContact_NGO(index) {
                                          event.preventDefault()
                                          showModal_NGO(true, index);
                                        }

                                        function deleteContact_NGO(index) {
                                          if (confirm('Are you sure you want to delete this contact?')) {
                                            contacts.splice(index, 1);
                                            renderTable_NGO();
                                          }
                                        }

                                        function hideModal_NGO() {
                                          const modal = document.getElementById('contactModal_NGO');
                                          modal.classList.add('hidden');
                                        }

                                        document.getElementById('addContactBtn_NGO').addEventListener('click', function(event) {
                                          event.preventDefault()
                                          showModal_NGO(false);
                                        });

                                        // Initial render of the table
                                        renderTable_NGO();
                                      </script>



                                    <!----------------------------- ---------------------------------------------------------->
                                  </div>

                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-lg hover:bg-brand-600" 
                                    name="NGOContactsFormButton" 
                                  >
                                    Confirm
                                  </button>

                                  <button 
                                    id="backBtn2" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-lg hover:bg-secondary-600" 
                                    name="joinFormButton" 
                                  >
                                    Back
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

                            <form name="NGOUploadForm" id="form104" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                <div class="grid w-full items-center gap-2">

                                                        <b class="-4">Create Account</b>

                                  <input type="hidden" name="asCategory" value="<?php echo $asCategory;?>">

                                  <div class="flex flex-col space-y-1.5 text-green-500 font-bold">
                                    <?php echo ($asCategory) ? $asCategory : 'NGO'; ?> Account
                                  </div>
                                  
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyUpload_NGO" class="my-2">Upload</label>
                                    <input name="companyUpload_NGO"
                                      type="file"
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyUpload_NGO"
                                      required />
                                    <small><b>All statutory documents of the organisation and its directors be downloaded here.</b></small>
                                  </div>

                                  <div id="progress-container" class="hidden mt-2">
                                    <div id="progress-bar" class="bg-blue-500 text-white py-1 rounded text-center w-0"></div>
                                    <div id="progress-text" class="text-gray-600 text-sm mt-1">0%</div>
                                  </div>
                           

                                 


                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-lg hover:bg-brand-600" 
                                    name="NGOUploadFormButton" 
                                  >
                                    Confirm
                                  </button>

                                  <button 
                                    id="backBtn2" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-lg hover:bg-secondary-600" 
                                    name="joinFormButton" 
                                  >
                                    Back
                                  </button>
                                  <!--div class="flex justify-center">
                                    <a
                                      class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 underline-offset-4 hover:underline h-8 rounded-md px-3 text-md text-blue-600"
                                      href="index.php"
                                      >Already a user? Login</a
                                    >
                                  </div-->
                                </div>
                            </form>

                            <form name="NGOBankForm" id="form105" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                <div class="grid w-full items-center gap-2">

                                                        <b class="-4">Create Account</b>

                                  <input type="hidden" name="asCategory" value="<?php echo $asCategory;?>">

                                  <div class="flex flex-col space-y-1.5 text-green-500 font-bold">
                                    <?php echo ($asCategory) ? $asCategory : 'NGO'; ?> Account
                                  </div>
                                  
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyBankName_NGO" class="my-2">Bank Name</label>
                                    <input name="companyBankName_NGO"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyBankName_NGO" 
                                      placeholder="Your bank name"  
                                      value ="<?php echo $companyBankName;?>" 
                                      required 

                                    />
                                    <small><b></b></small>
                                  </div>
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyBankAccountName_NGO" class="my-2">Account Name</label>
                                    <input name="companyBankAccountName_NGO"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyBankAccountName_NGO" 
                                      placeholder="Your bank account name"  
                                      value ="<?php echo $companyBankAccountName;?>" 
                                      required 

                                    />
                                    <small><b>Details of bank Accounts from various banks.</b></small>
                                  </div>

                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-lg hover:bg-brand-600" 
                                    name="NGOBankFormButton" 
                                  >
                                    Confirm
                                  </button>

                                  <button 
                                    id="backBtn2" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-lg hover:bg-secondary-600" 
                                    name="joinFormButton" 
                                  >
                                    Back
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

                        <!-- NGO END -->
            


                        <!-- RELIGIOUSBODY -->

                            <form name="RELIGIOUSBODYForm" id="form201" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                <div class="grid w-full items-center gap-2">

                                                        <b class="-4">Create Account</b>

                                  <input type="hidden" name="asCategory" value="<?php echo $asCategory;?>">

                                  <div class="flex flex-col space-y-1.5 text-green-500 font-bold">
                                    <?php echo ($asCategory) ? $asCategory : 'RELIGIOUSBODY'; ?> Account
                                  </div>
                                  
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyFullname_RELIGIOUSBODY" class="my-2">Name of Organisation</label>
                                    <input name="companyFullname_RELIGIOUSBODY"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyFullname_RELIGIOUSBODY" 
                                      placeholder="Name of Organisation"  
                                      value ="<?php echo $companyFullname;?>" 
                                      required 

                                    />
                                    <small><b></b></small>
                                  </div>


                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyRegNo_RELIGIOUSBODY" class="my-2">Reg. No</label>
                                    <input name="companyRegNo_RELIGIOUSBODY"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyRegNo_RELIGIOUSBODY" 
                                      placeholder="Your reg no" 
                                      value ="<?php echo $companyRegNo;?>"  
                                      required 
                                    />
                                  </div>

                                  <div class="flex flex-col space-y-1.5x">
                                    <label for="companyEmailAddress_RELIGIOUSBODY" class="my-2">Email (an OTP will be sent)</label>
                                    <input name="companyEmailAddress_RELIGIOUSBODY"  
                                    type="email" 
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyEmailAddress_RELIGIOUSBODY" 
                                      placeholder="Your email address" 
                                      value ="<?php echo $companyEmailAddress;?>"  
                                      required 
                                    />
                                  </div>


                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyPhoneNo_RELIGIOUSBODY" class="my-2">Phone Number</label>
                                    <input name="companyPhoneNo_RELIGIOUSBODY"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyPhoneNo_RELIGIOUSBODY" 
                                      placeholder="Your phone number e.g 08045678900"  
                                      value ="<?php echo $phoneNo;?>" 
                                      required 

                                    />
                                    <small><b>The number should be in the format 08045678900</b></small>
                                  </div>


                                  <hr>

                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyPassword_RELIGIOUSBODY" class="my-2 font-bold">Password</label>
                                    <input name="companyPassword_RELIGIOUSBODY" 
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyPassword_RELIGIOUSBODY"
                                      placeholder="Password" 
                                      required 
                                    />
                                  </div>
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyConfirmPassword_RELIGIOUSBODY" class="my-2 font-bold">Re-enter Password</label>
                                    <input name="companyConfirmPassword_RELIGIOUSBODY" 
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyConfirmPassword_RELIGIOUSBODY"
                                      placeholder="Re-enter password" 
                                      required 
                                    />
                                  </div>

                                 

                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-lg hover:bg-brand-600" 
                                    name="RELIGIOUSBODYFormButton" 
                                  >
                                    Confirm
                                  </button>

                                  <button 
                                    id="backBtn2" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-lg hover:bg-secondary-600" 
                                    name="joinFormButton" 
                                  >
                                    Back
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

                            <form name="RELIGIOUSBODYAddressForm" id="form202" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                <div class="grid w-full items-center gap-2">

                                                        <b class="-4">Create Account</b>

                                  <input type="hidden" name="asCategory" value="<?php echo $asCategory;?>">

                                  <div class="flex flex-col space-y-1.5 text-green-500 font-bold">
                                    <?php echo ($asCategory) ? $asCategory : 'RELIGIOUSBODY'; ?> Account
                                  </div>
                                  
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyAddress_RELIGIOUSBODY" class="my-2">Address</label>
                                    <input name="companyAddress_RELIGIOUSBODY"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyAddress_RELIGIOUSBODY" 
                                      placeholder="Address"  
                                      value ="<?php echo $companyAddress;?>" 
                                      required 

                                    />
                                    <small><b>Address and Sub Addresses imcluding contact telephone number, PMB, City, State</b></small>
                                  </div>
                                                                  
                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-lg hover:bg-brand-600" 
                                    name="RELIGIOUSBODYAddressFormButton" 
                                  >
                                    Confirm
                                  </button>

                                  <button 
                                    id="backBtn2" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-lg hover:bg-secondary-600" 
                                    name="joinFormButton" 
                                  >
                                    Back
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

                            <form name="RELIGIOUSBODYContactsForm" id="form203" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                <div class="grid w-full items-center gap-2">

                                                        <b class="-4">Principal Officers</b>

                                  
                                  <div class="flex flex-col space-y-1.5 text-green-500 font-bold">
                                    <?php echo ($asCategory) ? $asCategory : 'RELIGIOUSBODY'; ?> Account
                                  </div>
                                  
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="addContactBtn_RELIGIOUSBODY" class="my-2">
                                      <a href="" id="addContactBtn_RELIGIOUSBODY" class="bg-brand-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                      Add Contact
                                    </a>
                                    </label>

                                    <!------------------------------------------------------------------------------------------ ---->
                                      <!-- Add Button to Trigger Modal -->
                                          

                                          <!-- Table -->
                                          <div class="overflow-x-auto">
                                            <table class="min-w-full border border-collapse">
                                              <thead>
                                                <tr>
                                                  <th class="border p-2">Full Name</th>
                                                  <th class="border p-2">Position</th>
                                                  <th class="border p-2">Contact</th>
                                                  <th class="border p-2">Phone No</th>
                                                </tr>
                                              </thead>
                                              <tbody id="contactTableBody_RELIGIOUSBODY">
                                                <!-- Table rows will be added dynamically using JavaScript -->
                                              </tbody>
                                            </table>
                                            <p>Name and number of principal officers and ranking in the organisation</p>
                                          </div>
                                        
                                      <!-- Modal Form for Adding/Updating Contact -->
                                      <div id="contactModal_RELIGIOUSBODY" class="fixed inset-0 flex items-center justify-center z-50 hidden">
                                        <div class="modal-container_RELIGIOUSBODY bg-white w-96 mx-auto p-6 rounded-lg shadow-lg">
                                          <!-- Modal content will be added dynamically using JavaScript -->
                                        </div>
                                      </div>

                                      <!-- Tailwind CSS link -->
                                      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">

                                      <script type="text/javascript">
                                        
                                        //let contacts = [];

                                        // Function to render the table rows
                                        function renderTable_RELIGIOUSBODY() {
                                          const tableBody = document.getElementById('contactTableBody_RELIGIOUSBODY');
                                          tableBody.innerHTML = '';

                                          contacts.forEach((contact, index) => {
                                            const row = document.createElement('tr');
                                            row.innerHTML = `
                                              <td class="border p-2">${contact.fullname}</td>
                                              <td class="border p-2">${contact.position}</td>
                                              <td class="border p-2">${contact.address}</td>
                                              <td class="border p-2">${contact.phoneNo}</td>
                                              
                                              <td class="border p-2">
                                                <a href="" id="editContactButton_RELIGIOUSBODY" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-2" onclick="editContact_RELIGIOUSBODY(${index})">Edit</a>
                                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="deleteContact_RELIGIOUSBODY(${index})">Delete</button>
                                              </td>
                                            `;
                                            tableBody.appendChild(row);
                                          });
                                        }

                                        // Function to show modal for adding/updating contact
                                        function showModal_RELIGIOUSBODY(isEditing, index) {
                                          const modal = document.getElementById('contactModal_RELIGIOUSBODY');
                                          modal.classList.remove('hidden');

                                          const selectedContact = isEditing ? contacts[index] : { fullname: '', position: '', address: '', phoneNo: '' };

                                          const modalContent = `
                                            <h2 class="text-lg font-bold mb-4">${isEditing ? 'Edit' : 'Add'} Contact</h2>
                                            <form id="contactForm_RELIGIOUSBODY">
                                              <label for="fullname_RELIGIOUSBODY" class="block mb-2">Full Name:</label>
                                              <input type="text" id="fullname_RELIGIOUSBODY" name="fullname_RELIGIOUSBODY" class="border p-2 mb-4 w-full" required value="${selectedContact.fullname}">

                                              <label for="position_RELIGIOUSBODY" class="block mb-2">Position:</label>
                                              <input type="text" id="position_RELIGIOUSBODY" name="position_RELIGIOUSBODY" class="border p-2 mb-4 w-full" required value="${selectedContact.position}">

                                              <label for="address_RELIGIOUSBODY" class="block mb-2">Contact:</label>
                                              <input type="text" id="address_RELIGIOUSBODY" name="address_RELIGIOUSBODY" class="border p-2 mb-4 w-full" required value="${selectedContact.address}">

                                              <label for="phoneNo_RELIGIOUSBODY" class="block mb-2">Brief History:</label>
                                              <textarea id="phoneNo_RELIGIOUSBODY" name="phoneNo_RELIGIOUSBODY" class="border p-2 mb-4 w-full" required>${selectedContact.phoneNo}</textarea>

                                              <div class="flex justify-end">
                                                <a id="contactFormUpdateButton_RELIGIOUSBODY" href="" class="bg-brand-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                  ${isEditing ? 'Save' : 'Add'}
                                                </a>
                                                <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" onclick="hideModal_RELIGIOUSBODY()">
                                                  Cancel
                                                </button>
                                              </div>
                                            </form>
                                          `;

                                          const modalContainer = document.querySelector('.modal-container_RELIGIOUSBODY');
                                          modalContainer.innerHTML = modalContent;

                                          //document.getElementById('contactForm').addEventListener('submit', function(event) {
                                          document.getElementById('contactFormUpdateButton_RELIGIOUSBODY').addEventListener('click', function(event) {
                                            
                                            event.preventDefault();
                                            const fullname = document.getElementById('fullname_RELIGIOUSBODY').value;
                                            const position = document.getElementById('position_RELIGIOUSBODY').value;
                                            const address = document.getElementById('address_RELIGIOUSBODY').value;
                                            const phoneNo = document.getElementById('phoneNo_RELIGIOUSBODY').value;
                                            

                                            if (isEditing) {
                                              contacts[index] = { fullname, position, address, phoneNo };
                                            } else {
                                              contacts.push({ fullname, position, address, phoneNo });
                                            }

                                            hideModal_RELIGIOUSBODY();
                                            renderTable_RELIGIOUSBODY();
                                          });
                                        }

                                       

                                        function editContact_RELIGIOUSBODY(index) {
                                          event.preventDefault()
                                          showModal_RELIGIOUSBODY(true, index);
                                        }

                                        function deleteContact_RELIGIOUSBODY(index) {
                                          if (confirm('Are you sure you want to delete this contact?')) {
                                            contacts.splice(index, 1);
                                            renderTable_RELIGIOUSBODY();
                                          }
                                        }

                                        function hideModal_RELIGIOUSBODY() {
                                          const modal = document.getElementById('contactModal_RELIGIOUSBODY');
                                          modal.classList.add('hidden');
                                        }

                                        document.getElementById('addContactBtn_RELIGIOUSBODY').addEventListener('click', function(event) {
                                          event.preventDefault()
                                          showModal_RELIGIOUSBODY(false);
                                        });

                                        // Initial render of the table
                                        renderTable_RELIGIOUSBODY();
                                      </script>



                                    <!----------------------------- ---------------------------------------------------------->
                                  </div>

                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-lg hover:bg-brand-600" 
                                    name="RELIGIOUSBODYContactsFormButton" 
                                  >
                                    Confirm
                                  </button>

                                  <button 
                                    id="backBtn2" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-lg hover:bg-secondary-600" 
                                    name="joinFormButton" 
                                  >
                                    Back
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

                            <form name="RELIGIOUSBODYUploadForm" id="form204" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                <div class="grid w-full items-center gap-2">

                                                        <b class="-4">Create Account</b>

                                  <input type="hidden" name="asCategory" value="<?php echo $asCategory;?>">

                                  <div class="flex flex-col space-y-1.5 text-green-500 font-bold">
                                    <?php echo ($asCategory) ? $asCategory : 'RELIGIOUSBODY'; ?> Account
                                  </div>
                                  
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyUpload_RELIGIOUSBODY" class="my-2">Upload</label>
                                    <input name="companyUpload_RELIGIOUSBODY"
                                      type="file"
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyUpload_RELIGIOUSBODY"
                                      required />
                                    <small><b>All statutory documents of the organisation and its directors be downloaded here.</b></small>
                                  </div>

                                  <div id="progress-container" class="hidden mt-2">
                                    <div id="progress-bar" class="bg-blue-500 text-white py-1 rounded text-center w-0"></div>
                                    <div id="progress-text" class="text-gray-600 text-sm mt-1">0%</div>
                                  </div>
                           

                                 


                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-lg hover:bg-brand-600" 
                                    name="RELIGIOUSBODYUploadFormButton" 
                                  >
                                    Confirm
                                  </button>

                                  <button 
                                    id="backBtn2" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-lg hover:bg-secondary-600" 
                                    name="joinFormButton" 
                                  >
                                    Back
                                  </button>
                                  <!--div class="flex justify-center">
                                    <a
                                      class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 underline-offset-4 hover:underline h-8 rounded-md px-3 text-md text-blue-600"
                                      href="index.php"
                                      >Already a user? Login</a
                                    >
                                  </div-->
                                </div>
                            </form>

                            <form name="RELIGIOUSBODYBankForm" id="form205" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                <div class="grid w-full items-center gap-2">

                                                        <b class="-4">Create Account</b>

                                  <input type="hidden" name="asCategory" value="<?php echo $asCategory;?>">

                                  <div class="flex flex-col space-y-1.5 text-green-500 font-bold">
                                    <?php echo ($asCategory) ? $asCategory : 'RELIGIOUSBODY'; ?> Account
                                  </div>
                                  
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyBankName_RELIGIOUSBODY" class="my-2">Bank Name</label>
                                    <input name="companyBankName_RELIGIOUSBODY"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyBankName_RELIGIOUSBODY" 
                                      placeholder="Your bank name"  
                                      value ="<?php echo $companyBankName;?>" 
                                      required 

                                    />
                                    <small><b></b></small>
                                  </div>
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyBankAccountName_RELIGIOUSBODY" class="my-2">Account Name</label>
                                    <input name="companyBankAccountName_RELIGIOUSBODY"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyBankAccountName_RELIGIOUSBODY" 
                                      placeholder="Your bank account name"  
                                      value ="<?php echo $companyBankAccountName;?>" 
                                      required 

                                    />
                                    <small><b>Details of bank Accounts from various banks.</b></small>
                                  </div>

                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-lg hover:bg-brand-600" 
                                    name="RELIGIOUSBODYBankFormButton" 
                                  >
                                    Confirm
                                  </button>

                                  <button 
                                    id="backBtn2" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-lg hover:bg-secondary-600" 
                                    name="joinFormButton" 
                                  >
                                    Back
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

                        <!-- RELIGIOUSBODY END -->


                        <!-- POLITICALBODY -->

                            <form name="POLITICALBODYForm" id="form301" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                <div class="grid w-full items-center gap-2">

                                                        <b class="-4">Create Account</b>

                                  <input type="hidden" name="asCategory" value="<?php echo $asCategory;?>">

                                  <div class="flex flex-col space-y-1.5 text-green-500 font-bold">
                                    <?php echo ($asCategory) ? $asCategory : 'POLITICAL BODY'; ?> Account
                                  </div>
                                  
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyFullname_POLITICALBODY" class="my-2">Name of Organisation</label>
                                    <input name="companyFullname_POLITICALBODY"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyFullname_POLITICALBODY" 
                                      placeholder="Name of Organisation"  
                                      value ="<?php echo $companyFullname;?>" 
                                      required 

                                    />
                                    <small><b></b></small>
                                  </div>


                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyRegNo_POLITICALBODY" class="my-2">Reg. No</label>
                                    <input name="companyRegNo_POLITICALBODY"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyRegNo_POLITICALBODY" 
                                      placeholder="Your reg no" 
                                      value ="<?php echo $companyRegNo;?>"  
                                      required 
                                    />
                                  </div>

                                  <div class="flex flex-col space-y-1.5x">
                                    <label for="companyEmailAddress_POLITICALBODY" class="my-2">Email (an OTP will be sent)</label>
                                    <input name="companyEmailAddress_POLITICALBODY"  
                                    type="email" 
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyEmailAddress_POLITICALBODY" 
                                      placeholder="Your email address" 
                                      value ="<?php echo $companyEmailAddress;?>"  
                                      required 
                                    />
                                  </div>


                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyPhoneNo_POLITICALBODY" class="my-2">Phone Number</label>
                                    <input name="companyPhoneNo_POLITICALBODY"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyPhoneNo_POLITICALBODY" 
                                      placeholder="Your phone number e.g 08045678900"  
                                      value ="<?php echo $phoneNo;?>" 
                                      required 

                                    />
                                    <small><b>The number should be in the format 08045678900</b></small>
                                  </div>


                                  <hr>

                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyPassword_POLITICALBODY" class="my-2 font-bold">Password</label>
                                    <input name="companyPassword_POLITICALBODY" 
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyPassword_POLITICALBODY"
                                      placeholder="Password" 
                                      required 
                                    />
                                  </div>
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyConfirmPassword_POLITICALBODY" class="my-2 font-bold">Re-enter Password</label>
                                    <input name="companyConfirmPassword_POLITICALBODY" 
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyConfirmPassword_POLITICALBODY"
                                      placeholder="Re-enter password" 
                                      required 
                                    />
                                  </div>

                                 

                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-lg hover:bg-brand-600" 
                                    name="POLITICALBODYFormButton" 
                                  >
                                    Confirm
                                  </button>

                                  <button 
                                    id="backBtn2" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-lg hover:bg-secondary-600" 
                                    name="joinFormButton" 
                                  >
                                    Back
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

                            <form name="POLITICALBODYAddressForm" id="form302" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                <div class="grid w-full items-center gap-2">

                                                        <b class="-4">Create Account</b>

                                  <input type="hidden" name="asCategory" value="<?php echo $asCategory;?>">

                                  <div class="flex flex-col space-y-1.5 text-green-500 font-bold">
                                    <?php echo ($asCategory) ? $asCategory : 'POLITICALBODY'; ?> Account
                                  </div>
                                  
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyAddress_POLITICALBODY" class="my-2">Address</label>
                                    <input name="companyAddress_POLITICALBODY"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyAddress_POLITICALBODY" 
                                      placeholder="Address"  
                                      value ="<?php echo $companyAddress;?>" 
                                      required 

                                    />
                                    <small><b>Address and Sub Addresses imcluding contact telephone number, PMB, City, State</b></small>
                                  </div>
                                                                  
                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-lg hover:bg-brand-600" 
                                    name="POLITICALBODYAddressFormButton" 
                                  >
                                    Confirm
                                  </button>

                                  <button 
                                    id="backBtn2" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-lg hover:bg-secondary-600" 
                                    name="joinFormButton" 
                                  >
                                    Back
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

                            <form name="POLITICALBODYContactsForm" id="form303" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                <div class="grid w-full items-center gap-2">

                                                        <b class="-4">Principal Officers</b>

                                  
                                  <div class="flex flex-col space-y-1.5 text-green-500 font-bold">
                                    <?php echo ($asCategory) ? $asCategory : 'POLITICALBODY'; ?> Account
                                  </div>
                                  
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="addContactBtn_POLITICALBODY" class="my-2">
                                      <a href="" id="addContactBtn_POLITICALBODY" class="bg-brand-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                      Add Contact
                                    </a>
                                    </label>

                                    <!------------------------------------------------------------------------------------------ ---->
                                      <!-- Add Button to Trigger Modal -->
                                          

                                          <!-- Table -->
                                          <div class="overflow-x-auto">
                                            <table class="min-w-full border border-collapse">
                                              <thead>
                                                <tr>
                                                  <th class="border p-2">Full Name</th>
                                                  <th class="border p-2">Position</th>
                                                  <th class="border p-2">Contact</th>
                                                  <th class="border p-2">Phone No</th>
                                                </tr>
                                              </thead>
                                              <tbody id="contactTableBody_POLITICALBODY">
                                                <!-- Table rows will be added dynamically using JavaScript -->
                                              </tbody>
                                            </table>
                                            <p>Name and number of principal officers and ranking in the organisation</p>
                                          </div>
                                        
                                      <!-- Modal Form for Adding/Updating Contact -->
                                      <div id="contactModal_POLITICALBODY" class="fixed inset-0 flex items-center justify-center z-50 hidden">
                                        <div class="modal-container_POLITICALBODY bg-white w-96 mx-auto p-6 rounded-lg shadow-lg">
                                          <!-- Modal content will be added dynamically using JavaScript -->
                                        </div>
                                      </div>

                                      <!-- Tailwind CSS link -->
                                      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">

                                      <script type="text/javascript">
                                        
                                        //let contacts = [];

                                        // Function to render the table rows
                                        function renderTable_POLITICALBODY() {
                                          const tableBody = document.getElementById('contactTableBody_POLITICALBODY');
                                          tableBody.innerHTML = '';

                                          contacts.forEach((contact, index) => {
                                            const row = document.createElement('tr');
                                            row.innerHTML = `
                                              <td class="border p-2">${contact.fullname}</td>
                                              <td class="border p-2">${contact.position}</td>
                                              <td class="border p-2">${contact.address}</td>
                                              <td class="border p-2">${contact.phoneNo}</td>
                                              
                                              <td class="border p-2">
                                                <a href="" id="editContactButton_POLITICALBODY" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-2" onclick="editContact_POLITICALBODY(${index})">Edit</a>
                                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="deleteContact_POLITICALBODY(${index})">Delete</button>
                                              </td>
                                            `;
                                            tableBody.appendChild(row);
                                          });
                                        }

                                        // Function to show modal for adding/updating contact
                                        function showModal_POLITICALBODY(isEditing, index) {
                                          const modal = document.getElementById('contactModal_POLITICALBODY');
                                          modal.classList.remove('hidden');

                                          const selectedContact = isEditing ? contacts[index] : { fullname: '', position: '', address: '', phoneNo: '' };

                                          const modalContent = `
                                            <h2 class="text-lg font-bold mb-4">${isEditing ? 'Edit' : 'Add'} Contact</h2>
                                            <form id="contactForm_POLITICALBODY">
                                              <label for="fullname_POLITICALBODY" class="block mb-2">Full Name:</label>
                                              <input type="text" id="fullname_POLITICALBODY" name="fullname_POLITICALBODY" class="border p-2 mb-4 w-full" required value="${selectedContact.fullname}">

                                              <label for="position_POLITICALBODY" class="block mb-2">Position:</label>
                                              <input type="text" id="position_POLITICALBODY" name="position_POLITICALBODY" class="border p-2 mb-4 w-full" required value="${selectedContact.position}">

                                              <label for="address_POLITICALBODY" class="block mb-2">Contact:</label>
                                              <input type="text" id="address_POLITICALBODY" name="address_POLITICALBODY" class="border p-2 mb-4 w-full" required value="${selectedContact.address}">

                                              <label for="phoneNo_POLITICALBODY" class="block mb-2">Brief History:</label>
                                              <textarea id="phoneNo_POLITICALBODY" name="phoneNo_POLITICALBODY" class="border p-2 mb-4 w-full" required>${selectedContact.phoneNo}</textarea>

                                              <div class="flex justify-end">
                                                <a id="contactFormUpdateButton_POLITICALBODY" href="" class="bg-brand-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                  ${isEditing ? 'Save' : 'Add'}
                                                </a>
                                                <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" onclick="hideModal_POLITICALBODY()">
                                                  Cancel
                                                </button>
                                              </div>
                                            </form>
                                          `;

                                          const modalContainer = document.querySelector('.modal-container_POLITICALBODY');
                                          modalContainer.innerHTML = modalContent;

                                          //document.getElementById('contactForm').addEventListener('submit', function(event) {
                                          document.getElementById('contactFormUpdateButton_POLITICALBODY').addEventListener('click', function(event) {
                                            
                                            event.preventDefault();
                                            const fullname = document.getElementById('fullname_POLITICALBODY').value;
                                            const position = document.getElementById('position_POLITICALBODY').value;
                                            const address = document.getElementById('address_POLITICALBODY').value;
                                            const phoneNo = document.getElementById('phoneNo_POLITICALBODY').value;
                                            

                                            if (isEditing) {
                                              contacts[index] = { fullname, position, address, phoneNo };
                                            } else {
                                              contacts.push({ fullname, position, address, phoneNo });
                                            }

                                            hideModal_POLITICALBODY();
                                            renderTable_POLITICALBODY();
                                          });
                                        }

                                       

                                        function editContact_POLITICALBODY(index) {
                                          event.preventDefault()
                                          showModal_POLITICALBODY(true, index);
                                        }

                                        function deleteContact_POLITICALBODY(index) {
                                          if (confirm('Are you sure you want to delete this contact?')) {
                                            contacts.splice(index, 1);
                                            renderTable_POLITICALBODY();
                                          }
                                        }

                                        function hideModal_POLITICALBODY() {
                                          const modal = document.getElementById('contactModal_POLITICALBODY');
                                          modal.classList.add('hidden');
                                        }

                                        document.getElementById('addContactBtn_POLITICALBODY').addEventListener('click', function(event) {
                                          event.preventDefault()
                                          showModal_POLITICALBODY(false);
                                        });

                                        // Initial render of the table
                                        renderTable_POLITICALBODY();
                                      </script>



                                    <!----------------------------- ---------------------------------------------------------->
                                  </div>

                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-lg hover:bg-brand-600" 
                                    name="POLITICALBODYContactsFormButton" 
                                  >
                                    Confirm
                                  </button>

                                  <button 
                                    id="backBtn2" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-lg hover:bg-secondary-600" 
                                    name="joinFormButton" 
                                  >
                                    Back
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

                            <form name="POLITICALBODYUploadForm" id="form304" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                <div class="grid w-full items-center gap-2">

                                                        <b class="-4">Create Account</b>

                                  <input type="hidden" name="asCategory" value="<?php echo $asCategory;?>">

                                  <div class="flex flex-col space-y-1.5 text-green-500 font-bold">
                                    <?php echo ($asCategory) ? $asCategory : 'POLITICALBODY'; ?> Account
                                  </div>
                                  
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyUpload_POLITICALBODY" class="my-2">Upload</label>
                                    <input name="companyUpload_POLITICALBODY"
                                      type="file"
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyUpload_POLITICALBODY"
                                      required />
                                    <small><b>All statutory documents of the organisation and its directors be downloaded here.</b></small>
                                  </div>

                                  <div id="progress-container" class="hidden mt-2">
                                    <div id="progress-bar" class="bg-blue-500 text-white py-1 rounded text-center w-0"></div>
                                    <div id="progress-text" class="text-gray-600 text-sm mt-1">0%</div>
                                  </div>
                           

                                 


                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-lg hover:bg-brand-600" 
                                    name="POLITICALBODYUploadFormButton" 
                                  >
                                    Confirm
                                  </button>

                                  <button 
                                    id="backBtn2" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-lg hover:bg-secondary-600" 
                                    name="joinFormButton" 
                                  >
                                    Back
                                  </button>
                                  <!--div class="flex justify-center">
                                    <a
                                      class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 underline-offset-4 hover:underline h-8 rounded-md px-3 text-md text-blue-600"
                                      href="index.php"
                                      >Already a user? Login</a
                                    >
                                  </div-->
                                </div>
                            </form>

                            <form name="POLITICALBODYBankForm" id="form305" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                <div class="grid w-full items-center gap-2">

                                                        <b class="-4">Create Account</b>

                                  <input type="hidden" name="asCategory" value="<?php echo $asCategory;?>">

                                  <div class="flex flex-col space-y-1.5 text-green-500 font-bold">
                                    <?php echo ($asCategory) ? $asCategory : 'POLITICALBODY'; ?> Account
                                  </div>
                                  
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyBankName_POLITICALBODY" class="my-2">Bank Name</label>
                                    <input name="companyBankName_POLITICALBODY"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyBankName_POLITICALBODY" 
                                      placeholder="Your bank name"  
                                      value ="<?php echo $companyBankName;?>" 
                                      required 

                                    />
                                    <small><b></b></small>
                                  </div>
                                  <div class="flex flex-col space-y-1.5">
                                    <label for="companyBankAccountName_POLITICALBODY" class="my-2">Account Name</label>
                                    <input name="companyBankAccountName_POLITICALBODY"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="companyBankAccountName_POLITICALBODY" 
                                      placeholder="Your bank account name"  
                                      value ="<?php echo $companyBankAccountName;?>" 
                                      required 

                                    />
                                    <small><b>Details of bank Accounts from various banks.</b></small>
                                  </div>

                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-lg hover:bg-brand-600" 
                                    name="POLITICALBODYBankFormButton" 
                                  >
                                    Confirm
                                  </button>

                                  <button 
                                    id="backBtn2" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-lg hover:bg-secondary-600" 
                                    name="joinFormButton" 
                                  >
                                    Back
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

                        <!-- POLITICALBODY END -->















                      <!-- JOIN FORM -->

                            <form name="joinForm" id="form2x" idx="joinForm" method="post" action="" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                <div class="grid w-full items-center gap-8">

                                                        <b class="-4">Create Account</b>

                                  <input type="hidden" name="asCategory" value="<?php echo $asCategory;?>">

                                  <div class="flex flex-col space-y-1.5 text-green-500 font-bold">
                                    <?php echo $asCategory;?> Account
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

                                  <button 
                                    id="backBtn2" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-lg hover:bg-secondary-600" 
                                    name="joinFormButton" 
                                  >
                                    Back
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
                      <!-- JOIN FORM -->


                      <!-- OTP FORM --> 

                            <form id="form3X" method="post" action="" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                              <!--input type="hidden" id="otpfb" value="<?php echo $otpCode;?>"-->

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
                                      id="phoneNo_otp" 
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

                                  <div class="flex justify-center">
                                    <a
                                      class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 underline-offset-4 hover:underline h-8 rounded-md px-3 text-md text-blue-600"
                                      href="_otp.php?djjskjksdjkjkjkljhf834ekhuyyhh-----------------------------------------------------------------sdsdf=<?php echo $otpCode;?>"
                                      >Don`t get a verification code?</a
                                    >
                                  </div>
                                  
                                </div>
                            </form>

                      <!-- OTP FORM -->



                       <!-- PERSONAL FORM -->

                            <form name="personalForm" id="form4x" method="post" action="" class="form mt-4 animate__animated  animate__fadeIn  animate__delay-1sx ">
                                <div class="grid w-full items-center gap-8">

                                                        <b class="-4">Personal Information</b>

                                  <input type="hidden" name="asCategory" value="<?php echo $asCategory;?>">

                                  <div class="flex flex-col space-y-1.5 text-green-500 font-bold">
                                    <?php echo $asCategory;?> Account
                                  </div>

                                  <div class="flex flex-col space-y-1.5">
                                    <label for="fullname" class="my-2">Fullname</label>
                                    <input name="fullname"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="fullname" 
                                      placeholder="Your fullname"  
                                      value ="<?php echo $fullname;?>" 
                                      required 
                                    />
                                    <small></small>
                                  </div>

                                  <!--div class="flex flex-col space-y-1.5">
                                    <label for="emailAddress" class="my-2">Email</label>
                                    <input name="emailAddress"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="emailAddress" 
                                      placeholder="Your email address" 
                                      value ="<?php echo $emailAddress;?>"  
                                      required 
                                    />
                                  </div-->



                                  <!--div class="flex flex-col space-y-1.5">
                                    <label for="gender" class="my-2">gender</label>
                                    <input name="gender"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="gender" 
                                      placeholder="Your gender"  
                                      value ="<?php echo $gender;?>" 
                                      required 
                                    />
                                    <small></small>
                                  </div-->

                                  <div class="flex flex-col space-y-1.5">
                                      <label class="my-2 font-bold">Gender</label>
                                      <div class="flex space-x-4">
                                          <label style="margin-right: 1.5rem">
                                              <input type="radio" name="gender" value="M" id="maleRadio"> Male
                                          </label>
                                          <label>
                                              <input type="radio" name="gender" value="F" id="femaleRadio"> Female
                                          </label>
                                      </div>
                                      <input type="hidden" id="gender" value="<?php echo $gender; ?>" />
                                      <small></small>
                                  </div>
                                  <script type="text/javascript">
                                    // Get the radio buttons and hidden input field
                                  const maleRadio = document.getElementById("maleRadio");
                                  const femaleRadio = document.getElementById("femaleRadio");
                                  const genderInput = document.getElementById("gender");

                                  // Add event listeners to radio buttons
                                  maleRadio.addEventListener("click", function() {
                                      genderInput.value = "M";
                                  });

                                  femaleRadio.addEventListener("click", function() {
                                      genderInput.value = "F";
                                  });

                                  </script>


                                  <div class="flex flex-col space-y-1.5">
                                    <label for="dateOfBirth" class="my-2">dateOfBirth</label>
                                    <input name="dateOfBirth"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="dateOfBirth" 
                                      placeholder="Your dateOfBirth"  
                                      value ="<?php echo $dateOfBirth;?>" 
                                      required 
                                      type="date"
                                    />
                                    <small></small>
                                  </div>



                                  <div class="flex flex-col space-y-1.5">
                                    <label for="address" class="my-2">address</label>
                                    <input name="address"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="address" 
                                      placeholder="Your address"  
                                      value ="<?php echo $address;?>" 
                                      required 
                                    />
                                    <small></small>
                                  </div>



                                  <div class="flex flex-col space-y-1.5">
                                    <label for="addressWork" class="my-2">addressWork</label>
                                    <input name="addressWork"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="addressWork" 
                                      placeholder="Your addressWork"  
                                      value ="<?php echo $addressWork;?>" 
                                      required 
                                    />
                                    <small></small>
                                  </div>



                                  <div class="flex flex-col space-y-1.5">
                                    <label for="qualification" class="my-2">qualification</label>
                                    <input name="qualification"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="qualification" 
                                      placeholder="Your qualification"  
                                      value ="<?php echo $qualification;?>" 
                                      required 
                                    />
                                    <small></small>
                                  </div>

                                  <div class="flex flex-col space-y-1.5">
                                    <label for="maritalStatus" class="my-2">maritalStatus</label>
                                    <input name="maritalStatus"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="maritalStatus" 
                                      placeholder="Your maritalStatus"  
                                      value ="<?php echo $maritalStatus;?>" 
                                      required 
                                    />
                                    <small></small>
                                  </div>


                                  <div class="flex flex-col space-y-1.5">
                                    <label for="monthlyIncome" class="my-2">monthlyIncome</label>
                                    <input name="monthlyIncome"  
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="monthlyIncome" 
                                      placeholder="Your monthlyIncome"  
                                      value ="<?php echo $monthlyIncome;?>" 
                                      required 
                                    />
                                    <small></small>
                                  </div>
















                                  <div class="form-check">
                                    <label class="form-check-label text-muted">
                                      <input type="checkbox" class="form-check-input"  name="acknowledge_pi" id="acknowledge_pi" >
                                      I acknowledge and accept the terms &amp; conditions of <?php echo APP_FULLNAME; ?>
                                    </label>
                                  </div>

                                  

                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-lg hover:bg-brand-600" 
                                    name="completeJoinFormButton" 
                                  >
                                    Create Account
                                  </button>

                                  <a 
                                    id="backBtn3" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-lg hover:bg-secondary-600" 
                                    name="joinFormButton" 
                                    href="" 
                                  >
                                    Back
                                  </a>
                                  <div class="flex justify-center">
                                    <a
                                      class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 underline-offset-4 hover:underline h-8 rounded-md px-3 text-md text-blue-600"
                                      href="index.php"
                                      >Already a user? Login</a
                                    >
                                  </div>
                                </div>
                            </form>
                      <!-- JOIN FORM -->




            </div>
            
          </div>
        </div>
      </div>
    </main>
    <?php include_once('_footer.php');?>



    <!--  add firebase SDK-->
<script src="https://www.gstatic.com/firebasejs/9.12.1/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.12.1/firebase-auth-compat.js"></script>


    <script type="text/javascript">

        var signuflowData = {
            fullname: null,
            emailAddress: null,
            phoneNo: null,
            address: null,
            username: null,
            password: null,
            createdBy: null,
            logoPath: null,
            updatedBy: null,
            createdOn: null,
            updatedOn: null,
            ownerId: null,
            userId: null,
            appId: null,
            isActive: null,
            isLocked: null,
            isDeleted: null,
            isChanged: null,
            isSynced: null,
            isAdmin: null,
            syncedOn: null,
            oldId: null,
            ownerGuid: null,
            privileges: null,
            guid: null,
            firstName: null,
            middleName: null,
            lastName: null,
            gender: null,
            dateOfBirth: null,
            addressWork: null,
            qualification: null,
            maritalStatus: null,
            monthlyIncome: null,
            bankId: null,
            accountNo: null,
            otpcode: null,
            phoneNoFB:'',
            regNo: null,
            briefHistory:null,

            companyFullname: null,
            companyEmailAddress: null,
            companyPhoneNo: null,
            companyAddress: null,
            companyRegNo: null,
            companyBriefHistory: null,
            companyBankId: null,
            companyBankName: null,
            companyBankAccountName: null,
            companyAddress: null,
            companyPassword: null
            
        };


        let categoryCompleted = false
        let joinCompleted = true 
        let otpCompleted = false
        let personalCompleted = false
        let emailVerifyCompleted = false

        // Variables to keep track of the current form step
        let currentStep = <?php echo $step;?> ;// 6//1;
        const totalSteps = 50; // Total number of forms

          //1. CATEORY FORM
          document.getElementById('form1').addEventListener('submit', function(event) {

              event.preventDefault(); // Prevent form submission

              const radioButtons = document.getElementsByName('asCategory');
              let isRadioButtonChecked = false;

              radioButtons.forEach(radioButton => {

                  if (radioButton.checked) {
                      isRadioButtonChecked = true;

                      if (radioButton.value=='Institution') {
                        showStep(2);
                      }
                      if (radioButton.value=='Individual') {}
                      if (radioButton.value=='Group') {}

                      
                      return;

                      //categoryCompleted=true
                      
                      //signuflowData.ownerGuid = radioButton.value

                      //trackProcess(1,signuflowData,'');
                  }
              });

              if (!isRadioButtonChecked) {
                  event.preventDefault(); // Prevent form submission
                  //alert('Please select an option before submitting the form.');
                  Swal.fire({
                  icon: 'error',
                  title: 'Attention',
                  text: 'Please select a category before submitting the form.',
                  //footer: '<a href="">Why do I have this issue?</a>'
                })
              }






              //all forms will have this code
              if(categoryCompleted==true){
                //call signupflow to store
                
                //trackProcess('categoryForm','')

              }

          });


          //2. INSTITUTION FORM
          document.getElementById('form2').addEventListener('submit', function(event) {

              event.preventDefault(); // Prevent form submission

              const radioButtons = document.getElementsByName('asInstitution');
              let isRadioButtonChecked = false;

              radioButtons.forEach(radioButton => {

                  if (radioButton.checked) {
                      isRadioButtonChecked = true;

                      if (radioButton.value=='Non-Profit Organisation') {

                        showStep(3);
                      }
                      if (radioButton.value=='Profit Oriented Funding') {
                        showStep(112);
                      }


                      
                      return;

                      //categoryCompleted=true
                      
                      //signuflowData.ownerGuid = radioButton.value

                      //trackProcess(1,signuflowData,'');
                  }
              });

              if (!isRadioButtonChecked) {
                  event.preventDefault(); // Prevent form submission
                  //alert('Please select an option before submitting the form.');
                  Swal.fire({
                  icon: 'error',
                  title: 'Attention2',
                  text: 'Please select a category before submitting the form.',
                  //footer: '<a href="">Why do I have this issue?</a>'
                })
              }






              //all forms will have this code
              if(categoryCompleted==true){
                //call signupflow to store
                
                //trackProcess('categoryForm','')

              }

          });


          //NON PROFIT FORM
          document.getElementById('form3').addEventListener('submit', function(event) {

              event.preventDefault(); // Prevent form submission

              const radioButtons = document.getElementsByName('asNonProfit');
              let isRadioButtonChecked = false;

              radioButtons.forEach(radioButton => {

                  if (radioButton.checked) {
                      isRadioButtonChecked = true;

                      if (radioButton.value=='Government') {
                        
                        categoryCompleted=true
                        signuflowData.category = radioButton.value
                        trackProcess(3,signuflowData,'');

                      }
                      if (radioButton.value=='NGO') {
                        categoryCompleted=true
                        signuflowData.category = radioButton.value
                        trackProcess(3,signuflowData,'');
                      }
                       if (radioButton.value=='Religious Body') {
                        categoryCompleted=true
                        signuflowData.category = radioButton.value
                        trackProcess(3,signuflowData,'');
                      }
                       if (radioButton.value=='Political Body') {
                        categoryCompleted=true
                        signuflowData.category = radioButton.value
                        trackProcess(3,signuflowData,'');
                      }


                      
                      return;

                      
                  }
              });

              if (!isRadioButtonChecked) {
                  event.preventDefault(); // Prevent form submission
                  //alert('Please select an option before submitting the form.');
                  Swal.fire({
                  icon: 'error',
                  title: 'Attention3',
                  text: 'Please select a category before submitting the form.',
                  //footer: '<a href="">Why do I have this issue?</a>'
                })
              }






              //all forms will have this code
              if(categoryCompleted==true){
                //call signupflow to store
                
                //trackProcess('categoryForm','')

              }

          });


          //GOVERNMENT FORM
          document.getElementById('form4').addEventListener('submit', function(event) {

              event.preventDefault()
              const companyFullname = document.getElementById('companyFullname').value;
              const companyEmailAddress = document.getElementById('companyEmailAddress').value;
              const companyRegNo = document.getElementById("companyRegNo").value;
              const companyBriefHistory = document.getElementById("companyBriefHistory").value;
              

              const password = document.getElementById('companyPassword').value;
              const passconf = document.getElementById('companyConfirmPassword').value;

              var requiredCompleted = true


              // Check if the input is empty or not numeric or length is not 11
              if (companyFullname.trim() === "" ||  companyEmailAddress.trim() === "" || companyRegNo.trim() === "" || companyBriefHistory.trim() === ""   ) {
                  // Prevent the form from being submitted 
                  event.preventDefault();

                  requiredCompleted = false
                  
                  // Display an error message (you can customize this part)
                  //alert("Please enter a valid 11-digit phone number.");
                  Swal.fire({
                    icon: 'warning',
                    title: 'Attention',
                    text: 'Please enter all required information.',
                    //footer: '<a href="">Why do I have this issue?</a>'
                  })
              }


              if (password !== passconf) {
                      event.preventDefault(); // Prevent form submission
                      requiredCompleted = false
                      //alert('Passwords do not match. Please try again.');
                      Swal.fire({
                        icon: 'warning',
                        title: 'Attention',
                        text: 'Passwords do not match. Please try again.',
                        //footer: '<a href="">Why do I have this issue?</a>'
                      })
                  }

              

              if(requiredCompleted == true){

                signuflowData.companyFullname = companyFullname
                signuflowData.companyEmailAddress = companyEmailAddress
                signuflowData.companyRegNo = companyRegNo
                signuflowData.companyBriefHistory = companyBriefHistory
                

                signuflowData.companyPassword = password



                trackProcess(4,signuflowData,'');
              }

          });


          //GOVERNMENT ADDRESS FORM - AFTER VERIFY
          document.getElementById('form5').addEventListener('submit', function(event) {

              event.preventDefault()

              const companyAddress = document.getElementById("companyAddress").value;

              var requiredCompleted = true

              // Check if the input is empty or not numeric or length is not 11
              if (companyAddress.trim() === "") {
                  // Prevent the form from being submitted 
                  event.preventDefault();

                  requiredCompleted = false
                  
                  // Display an error message (you can customize this part)
                  //alert("Please enter a valid 11-digit phone number.");
                  Swal.fire({
                    icon: 'warning',
                    title: 'Attention',
                    text: 'Please enter all required information.',
                    //footer: '<a href="">Why do I have this issue?</a>'
                  })
              }
             

              if(requiredCompleted == true){

                signuflowData.companyAddress = companyAddress

                trackProcess(5,signuflowData,'');
              }

          })


          //GOVERNMENT CONTACT FORM - AFTER VERIFY
          document.getElementById('form6').addEventListener('submit', function(event) {

              event.preventDefault()

              console.log(contacts)

              const companyContacts = contacts

              var requiredCompleted = true
             

              if(requiredCompleted == true){

                signuflowData.companyContacts = contacts

                trackProcess(6,signuflowData,'');
              }

          });



          //GOVERNMENT UPLOAD FORM - AFTER VERIFY
          const form = document.getElementById('form7');
          const fileInput = document.getElementById('companyGovtCertificate');
          const progressBar = document.getElementById('progress-bar');
          const progressText = document.getElementById('progress-text');
          const progressContainer = document.getElementById('progress-container');

          form.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData();
            formData.append('companyGovtCertificate', fileInput.files[0]);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '_create_account_upload_govt_certificate_exec.php', true);

            xhr.upload.onprogress = function(e) {
              if (e.lengthComputable) {
                const percent = (e.loaded / e.total) * 100;
                progressBar.style.width = percent + '%';
                progressText.innerText = Math.round(percent) + '%';
              }
            };

            xhr.onload = function() {
              if (xhr.status === 200) {
                // Handle successful upload
                console.log('Upload successful:', xhr.responseText);
                //var responseArray = JSON.parse(xhr.responseText);
                showStep(currentStep+1);
              } else {
                // Handle upload error
                console.error('Upload failed. Status:', xhr.status);
              }
              // Reset progress bar and text
              progressBar.style.width = '0%';
              progressText.innerText = '0%';
              // Hide progress container
              progressContainer.classList.add('hidden');
            };

            xhr.onerror = function() {
              // Handle upload error
              console.error('Upload failed. Please try again later.');
              // Reset progress bar and text
              progressBar.style.width = '0%';
              progressText.innerText = '0%';
              // Hide progress container
              progressContainer.classList.add('hidden');
            };

            // Show progress container
            progressContainer.classList.remove('hidden');

            // Send form data with the file
            xhr.send(formData);
          });

          
          //GOVERNMENT BANK FORM
          document.getElementById('form8').addEventListener('submit', function(event) {

              event.preventDefault()
              const companyBankName = document.getElementById('companyBankName').value;
              const companyBankAccountName = document.getElementById('companyBankAccountName').value;
              

              var requiredCompleted = true


              // Check if the input is empty or not numeric or length is not 11
              if (companyBankName.trim() === "" ||  companyBankAccountName.trim() === "") {
                  // Prevent the form from being submitted 
                  event.preventDefault();

                  requiredCompleted = false
                  
                  // Display an error message (you can customize this part)
                  //alert("Please enter a valid 11-digit phone number.");
                  Swal.fire({
                    icon: 'warning',
                    title: 'Attention',
                    text: 'Please enter all required information.',
                    //footer: '<a href="">Why do I have this issue?</a>'
                  })
              }

              

              if(requiredCompleted == true){

                signuflowData.companyBankName = companyBankName
                signuflowData.companyBankAccountName = companyBankAccountName
                
                trackProcess(8,signuflowData,'');
              }

          });







          //NGO FORM
          document.getElementById('form101').addEventListener('submit', function(event) {

              event.preventDefault()
              const companyFullname = document.getElementById('companyFullname_NGO').value;
              const companyEmailAddress = document.getElementById('companyEmailAddress_NGO').value;
              const companyRegNo = document.getElementById("companyRegNo_NGO").value;
              const companyPhoneNo = document.getElementById("companyPhoneNo_NGO").value;
              

              const password = document.getElementById('companyPassword_NGO').value;
              const passconf = document.getElementById('companyConfirmPassword_NGO').value;

              var requiredCompleted = true


              // Check if the input is empty or not numeric or length is not 11
              if (companyFullname.trim() === "" ||  companyEmailAddress.trim() === "" || companyRegNo.trim() === "" || companyPhoneNo.trim() === ""   ) {
                  // Prevent the form from being submitted 
                  event.preventDefault();

                  requiredCompleted = false
                  
                  // Display an error message (you can customize this part)
                  //alert("Please enter a valid 11-digit phone number.");
                  Swal.fire({
                    icon: 'warning',
                    title: 'Attention',
                    text: 'Please enter all required information.',
                    //footer: '<a href="">Why do I have this issue?</a>'
                  })
              }


              if (password !== passconf) {
                      event.preventDefault(); // Prevent form submission
                      requiredCompleted = false
                      //alert('Passwords do not match. Please try again.');
                      Swal.fire({
                        icon: 'warning',
                        title: 'Attention',
                        text: 'Passwords do not match. Please try again.',
                        //footer: '<a href="">Why do I have this issue?</a>'
                      })
                  }

              

              if(requiredCompleted == true){

                signuflowData.companyFullname = companyFullname
                signuflowData.companyEmailAddress = companyEmailAddress
                signuflowData.companyRegNo = companyRegNo
                signuflowData.companyPhoneNo = companyPhoneNo
                

                signuflowData.companyPassword = password



                trackProcess(101,signuflowData,'');
              }

          });


          //NGO ADDRESS FORM - AFTER VERIFY
          document.getElementById('form102').addEventListener('submit', function(event) {

              event.preventDefault()

              const companyAddress = document.getElementById("companyAddress_NGO").value;

              var requiredCompleted = true

              // Check if the input is empty or not numeric or length is not 11
              if (companyAddress.trim() === "") {
                  // Prevent the form from being submitted 
                  event.preventDefault();

                  requiredCompleted = false
                  
                  // Display an error message (you can customize this part)
                  //alert("Please enter a valid 11-digit phone number.");
                  Swal.fire({
                    icon: 'warning',
                    title: 'Attention',
                    text: 'Please enter all required information.',
                    //footer: '<a href="">Why do I have this issue?</a>'
                  })
              }
             

              if(requiredCompleted == true){

                signuflowData.companyAddress = companyAddress

                trackProcess(102,signuflowData,'');
              }

          })


          //NGO CONTACT FORM - AFTER VERIFY
          document.getElementById('form103').addEventListener('submit', function(event) {

              event.preventDefault()

              console.log(contacts)

              const companyContacts = contacts

              var requiredCompleted = true
             

              if(requiredCompleted == true){

                signuflowData.companyContacts = contacts

                trackProcess(103,signuflowData,'');
              }

          });



          //NGO UPLOAD FORM - AFTER VERIFY
          const form_ngo = document.getElementById('form104');
          const fileInput_ngo = document.getElementById('companyUpload_NGO');
          const progressBar_ngo = document.getElementById('progress-bar');
          const progressText_ngo = document.getElementById('progress-text');
          const progressContainer_ngo = document.getElementById('progress-container');

          form_ngo.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData();
            formData.append('companyUpload_NGO', fileInput_ngo.files[0]);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '_create_account_upload_govt_certificate_exec.php', true);

            xhr.upload.onprogress = function(e) {
              if (e.lengthComputable) {
                const percent = (e.loaded / e.total) * 100;
                progressBar_ngo.style.width = percent + '%';
                progressText_ngo.innerText = Math.round(percent) + '%';
              }
            };

            xhr.onload = function() {
              if (xhr.status === 200) {
                // Handle successful upload
                console.log('Upload successful:', xhr.responseText);
                //var responseArray = JSON.parse(xhr.responseText);
                showStep(currentStep+1);
              } else {
                // Handle upload error
                console.error('Upload failed. Status:', xhr.status);
              }
              // Reset progress bar and text
              progressBar_ngo.style.width = '0%';
              progressText_ngo.innerText = '0%';
              // Hide progress container
              progressContainer_ngo.classList.add('hidden');
            };

            xhr.onerror = function() {
              // Handle upload error
              console.error('Upload failed. Please try again later.');
              // Reset progress bar and text
              progressBar_ngo.style.width = '0%';
              progressText_ngo.innerText = '0%';
              // Hide progress container
              progressContainer_ngo.classList.add('hidden');
            };

            // Show progress container
            progressContainer_ngo.classList.remove('hidden');

            // Send form data with the file
            xhr.send(formData);
          });

          
          //NGO BANK FORM
          document.getElementById('form105').addEventListener('submit', function(event) {

              event.preventDefault()
              const companyBankName = document.getElementById('companyBankName_NGO').value;
              const companyBankAccountName = document.getElementById('companyBankAccountName_NGO').value;
              

              var requiredCompleted = true


              // Check if the input is empty or not numeric or length is not 11
              if (companyBankName.trim() === "" ||  companyBankAccountName.trim() === "") {
                  // Prevent the form from being submitted 
                  event.preventDefault();

                  requiredCompleted = false
                  
                  // Display an error message (you can customize this part)
                  //alert("Please enter a valid 11-digit phone number.");
                  Swal.fire({
                    icon: 'warning',
                    title: 'Attention',
                    text: 'Please enter all required information.',
                    //footer: '<a href="">Why do I have this issue?</a>'
                  })
              }

              

              if(requiredCompleted == true){

                signuflowData.companyBankName = companyBankName
                signuflowData.companyBankAccountName = companyBankAccountName
                
                trackProcess(105,signuflowData,'');
              }

          });




          //RELIGIOUS BODY FORM
          document.getElementById('form201').addEventListener('submit', function(event) {

              event.preventDefault()
              const companyFullname = document.getElementById('companyFullname_RELIGIOUSBODY').value;
              const companyEmailAddress = document.getElementById('companyEmailAddress_RELIGIOUSBODY').value;
              const companyRegNo ='none';// document.getElementById("companyRegNo_RELIGIOUSBODY").value;
              const companyPhoneNo = document.getElementById("companyPhoneNo_RELIGIOUSBODY").value;
              

              const password = document.getElementById('companyPassword_RELIGIOUSBODY').value;
              const passconf = document.getElementById('companyConfirmPassword_RELIGIOUSBODY').value;

              var requiredCompleted = true


              // Check if the input is empty or not numeric or length is not 11
              if (companyFullname.trim() === "" ||  companyEmailAddress.trim() === "" || companyRegNo.trim() === "" || companyPhoneNo.trim() === ""   ) {
                  // Prevent the form from being submitted 
                  event.preventDefault();

                  requiredCompleted = false
                  
                  // Display an error message (you can customize this part)
                  //alert("Please enter a valid 11-digit phone number.");
                  Swal.fire({
                    icon: 'warning',
                    title: 'Attention',
                    text: 'Please enter all required information.',
                    //footer: '<a href="">Why do I have this issue?</a>'
                  })
              }


              if (password !== passconf) {
                      event.preventDefault(); // Prevent form submission
                      requiredCompleted = false
                      //alert('Passwords do not match. Please try again.');
                      Swal.fire({
                        icon: 'warning',
                        title: 'Attention',
                        text: 'Passwords do not match. Please try again.',
                        //footer: '<a href="">Why do I have this issue?</a>'
                      })
                  }

              

              if(requiredCompleted == true){

                signuflowData.companyFullname = companyFullname
                signuflowData.companyEmailAddress = companyEmailAddress
                signuflowData.companyRegNo = companyRegNo
                signuflowData.companyPhoneNo = companyPhoneNo
                

                signuflowData.companyPassword = password



                trackProcess(201,signuflowData,'');
              }

          });


          //RELIGIOUSBODY ADDRESS FORM - AFTER VERIFY
          document.getElementById('form202').addEventListener('submit', function(event) {

              event.preventDefault()

              const companyAddress = document.getElementById("companyAddress_RELIGIOUSBODY").value;

              var requiredCompleted = true

              // Check if the input is empty or not numeric or length is not 11
              if (companyAddress.trim() === "") {
                  // Prevent the form from being submitted 
                  event.preventDefault();

                  requiredCompleted = false
                  
                  // Display an error message (you can customize this part)
                  //alert("Please enter a valid 11-digit phone number.");
                  Swal.fire({
                    icon: 'warning',
                    title: 'Attention',
                    text: 'Please enter all required information.',
                    //footer: '<a href="">Why do I have this issue?</a>'
                  })
              }
             

              if(requiredCompleted == true){

                signuflowData.companyAddress = companyAddress

                trackProcess(202,signuflowData,'');
              }

          })


          //RELIGIOUSBODY CONTACT FORM - AFTER VERIFY
          document.getElementById('form203').addEventListener('submit', function(event) {

              event.preventDefault()

              console.log(contacts)

              const companyContacts = contacts

              var requiredCompleted = true
             

              if(requiredCompleted == true){

                signuflowData.companyContacts = contacts

                trackProcess(203,signuflowData,'');
              }

          });


          //RELIGIOUSBODY UPLOAD FORM - AFTER VERIFY
          const form_RELIGIOUSBODY = document.getElementById('form204');
          const fileInput_RELIGIOUSBODY = document.getElementById('companyUpload_RELIGIOUSBODY');
          const progressBar_RELIGIOUSBODY = document.getElementById('progress-bar');
          const progressText_RELIGIOUSBODY = document.getElementById('progress-text');
          const progressContainer_RELIGIOUSBODY = document.getElementById('progress-container');

          form_RELIGIOUSBODY.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData();
            formData.append('companyUpload_RELIGIOUSBODY', fileInput_RELIGIOUSBODY.files[0]);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '_create_account_upload_govt_certificate_exec.php', true);

            xhr.upload.onprogress = function(e) {
              if (e.lengthComputable) {
                const percent = (e.loaded / e.total) * 100;
                progressBar_RELIGIOUSBODY.style.width = percent + '%';
                progressText_RELIGIOUSBODY.innerText = Math.round(percent) + '%';
              }
            };

            xhr.onload = function() {
              if (xhr.status === 200) {
                // Handle successful upload
                console.log('Upload successful:', xhr.responseText);
                //var responseArray = JSON.parse(xhr.responseText);
                showStep(currentStep+1);
              } else {
                // Handle upload error
                console.error('Upload failed. Status:', xhr.status);
              }
              // Reset progress bar and text
              progressBar_RELIGIOUSBODY.style.width = '0%';
              progressText_RELIGIOUSBODY.innerText = '0%';
              // Hide progress container
              progressContainer_RELIGIOUSBODY.classList.add('hidden');
            };

            xhr.onerror = function() {
              // Handle upload error
              console.error('Upload failed. Please try again later.');
              // Reset progress bar and text
              progressBar_RELIGIOUSBODY.style.width = '0%';
              progressText_RELIGIOUSBODY.innerText = '0%';
              // Hide progress container
              progressContainer_RELIGIOUSBODY.classList.add('hidden');
            };

            // Show progress container
            progressContainer_RELIGIOUSBODY.classList.remove('hidden');

            // Send form data with the file
            xhr.send(formData);
          });

          
          //RELIGIOUSBODY BANK FORM
          document.getElementById('form205').addEventListener('submit', function(event) {

              event.preventDefault()
              const companyBankName = document.getElementById('companyBankName_RELIGIOUSBODY').value;
              const companyBankAccountName = document.getElementById('companyBankAccountName_RELIGIOUSBODY').value;
              

              var requiredCompleted = true


              // Check if the input is empty or not numeric or length is not 11
              if (companyBankName.trim() === "" ||  companyBankAccountName.trim() === "") {
                  // Prevent the form from being submitted 
                  event.preventDefault();

                  requiredCompleted = false
                  
                  // Display an error message (you can customize this part)
                  //alert("Please enter a valid 11-digit phone number.");
                  Swal.fire({
                    icon: 'warning',
                    title: 'Attention',
                    text: 'Please enter all required information.',
                    //footer: '<a href="">Why do I have this issue?</a>'
                  })
              }

              

              if(requiredCompleted == true){

                signuflowData.companyBankName = companyBankName
                signuflowData.companyBankAccountName = companyBankAccountName
                
                trackProcess(205,signuflowData,'');
              }

          });




          //POLITICALBODY FORM
          document.getElementById('form301').addEventListener('submit', function(event) {

              event.preventDefault()
              const companyFullname = document.getElementById('companyFullname_POLITICALBODY').value;
              const companyEmailAddress = document.getElementById('companyEmailAddress_POLITICALBODY').value;
              const companyRegNo ='none';// document.getElementById("companyRegNo_POLITICALBODY").value;
              const companyPhoneNo = document.getElementById("companyPhoneNo_POLITICALBODY").value;
              

              const password = document.getElementById('companyPassword_POLITICALBODY').value;
              const passconf = document.getElementById('companyConfirmPassword_POLITICALBODY').value;

              var requiredCompleted = true


              // Check if the input is empty or not numeric or length is not 11
              if (companyFullname.trim() === "" ||  companyEmailAddress.trim() === "" || companyRegNo.trim() === "" || companyPhoneNo.trim() === ""   ) {
                  // Prevent the form from being submitted 
                  event.preventDefault();

                  requiredCompleted = false
                  
                  // Display an error message (you can customize this part)
                  //alert("Please enter a valid 11-digit phone number.");
                  Swal.fire({
                    icon: 'warning',
                    title: 'Attention',
                    text: 'Please enter all required information.',
                    //footer: '<a href="">Why do I have this issue?</a>'
                  })
              }


              if (password !== passconf) {
                      event.preventDefault(); // Prevent form submission
                      requiredCompleted = false
                      //alert('Passwords do not match. Please try again.');
                      Swal.fire({
                        icon: 'warning',
                        title: 'Attention',
                        text: 'Passwords do not match. Please try again.',
                        //footer: '<a href="">Why do I have this issue?</a>'
                      })
                  }

              

              if(requiredCompleted == true){

                signuflowData.companyFullname = companyFullname
                signuflowData.companyEmailAddress = companyEmailAddress
                signuflowData.companyRegNo = companyRegNo
                signuflowData.companyPhoneNo = companyPhoneNo
                

                signuflowData.companyPassword = password



                trackProcess(301,signuflowData,'');
              }

          });


          //POLITICALBODY ADDRESS FORM - AFTER VERIFY
          document.getElementById('form302').addEventListener('submit', function(event) {

              event.preventDefault()

              const companyAddress = document.getElementById("companyAddress_POLITICALBODY").value;

              var requiredCompleted = true

              // Check if the input is empty or not numeric or length is not 11
              if (companyAddress.trim() === "") {
                  // Prevent the form from being submitted 
                  event.preventDefault();

                  requiredCompleted = false
                  
                  // Display an error message (you can customize this part)
                  //alert("Please enter a valid 11-digit phone number.");
                  Swal.fire({
                    icon: 'warning',
                    title: 'Attention',
                    text: 'Please enter all required information.',
                    //footer: '<a href="">Why do I have this issue?</a>'
                  })
              }
             

              if(requiredCompleted == true){

                signuflowData.companyAddress = companyAddress

                trackProcess(302,signuflowData,'');
              }

          })


          //POLITICALBODY CONTACT FORM - AFTER VERIFY
          document.getElementById('form303').addEventListener('submit', function(event) {

              event.preventDefault()

              console.log(contacts)

              const companyContacts = contacts

              var requiredCompleted = true
             

              if(requiredCompleted == true){

                signuflowData.companyContacts = contacts

                trackProcess(303,signuflowData,'');
              }

          });


          //POLITICALBODY UPLOAD FORM - AFTER VERIFY
          const form_POLITICALBODY = document.getElementById('form304');
          const fileInput_POLITICALBODY = document.getElementById('companyUpload_POLITICALBODY');
          const progressBar_POLITICALBODY = document.getElementById('progress-bar');
          const progressText_POLITICALBODY = document.getElementById('progress-text');
          const progressContainer_POLITICALBODY = document.getElementById('progress-container');

          form_POLITICALBODY.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData();
            formData.append('companyUpload_POLITICALBODY', fileInput_POLITICALBODY.files[0]);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '_create_account_upload_govt_certificate_exec.php', true);

            xhr.upload.onprogress = function(e) {
              if (e.lengthComputable) {
                const percent = (e.loaded / e.total) * 100;
                progressBar_POLITICALBODY.style.width = percent + '%';
                progressText_POLITICALBODY.innerText = Math.round(percent) + '%';
              }
            };

            xhr.onload = function() {
              if (xhr.status === 200) {
                // Handle successful upload
                console.log('Upload successful:', xhr.responseText);
                //var responseArray = JSON.parse(xhr.responseText);
                showStep(currentStep+1);
              } else {
                // Handle upload error
                console.error('Upload failed. Status:', xhr.status);
              }
              // Reset progress bar and text
              progressBar_POLITICALBODY.style.width = '0%';
              progressText_POLITICALBODY.innerText = '0%';
              // Hide progress container
              progressContainer_POLITICALBODY.classList.add('hidden');
            };

            xhr.onerror = function() {
              // Handle upload error
              console.error('Upload failed. Please try again later.');
              // Reset progress bar and text
              progressBar_POLITICALBODY.style.width = '0%';
              progressText_POLITICALBODY.innerText = '0%';
              // Hide progress container
              progressContainer_POLITICALBODY.classList.add('hidden');
            };

            // Show progress container
            progressContainer_POLITICALBODY.classList.remove('hidden');

            // Send form data with the file
            xhr.send(formData);
          });

          
          //POLITICALBODY BANK FORM
          document.getElementById('form305').addEventListener('submit', function(event) {

              event.preventDefault()
              const companyBankName = document.getElementById('companyBankName_POLITICALBODY').value;
              const companyBankAccountName = document.getElementById('companyBankAccountName_POLITICALBODY').value;
              

              var requiredCompleted = true


              // Check if the input is empty or not numeric or length is not 11
              if (companyBankName.trim() === "" ||  companyBankAccountName.trim() === "") {
                  // Prevent the form from being submitted 
                  event.preventDefault();

                  requiredCompleted = false
                  
                  // Display an error message (you can customize this part)
                  //alert("Please enter a valid 11-digit phone number.");
                  Swal.fire({
                    icon: 'warning',
                    title: 'Attention',
                    text: 'Please enter all required information.',
                    //footer: '<a href="">Why do I have this issue?</a>'
                  })
              }

              

              if(requiredCompleted == true){

                signuflowData.companyBankName = companyBankName
                signuflowData.companyBankAccountName = companyBankAccountName
                
                trackProcess(305,signuflowData,'');
              }

          });
















          //JOIN FORM
          document.getElementById('form2x').addEventListener('submit', function(event) {

              event.preventDefault()
              const password = document.getElementById('password').value;
              const passconf = document.getElementById('confirm_password').value;
              const phoneNoInput = document.getElementById("phoneNo");
              var phoneNoValue = phoneNoInput.value.trim();
              const checkbox = document.getElementById('acknowledge');

              // Check if the input is empty or not numeric or length is not 11
              if (phoneNoValue.trim() === "" || isNaN(phoneNoValue) || phoneNoValue.length !== 11 || phoneNoValue.charAt(0) !== '0' ) {
                  // Prevent the form from being submitted 
                  event.preventDefault();

                  joinCompleted = false

                  // Display an error message (you can customize this part)
                  //alert("Please enter a valid 11-digit phone number.");
                  Swal.fire({
                    icon: 'warning',
                    title: 'Attention',
                    text: 'Please enter a valid 11-digit phone number.',
                    //footer: '<a href="">Why do I have this issue?</a>'
                  })
              }

              if (password !== passconf) {
                      event.preventDefault(); // Prevent form submission
                      joinCompleted = false
                      //alert('Passwords do not match. Please try again.');
                      Swal.fire({
                        icon: 'warning',
                        title: 'Attention',
                        text: 'Passwords do not match. Please try again.',
                        //footer: '<a href="">Why do I have this issue?</a>'
                      })
                  }

              if (!checkbox.checked) {
                  event.preventDefault(); // Prevent form submission
                  joinCompleted = false
                  //alert('Please agree to the terms and conditions before submitting the form.');
                  Swal.fire({
                  icon: 'warning',
                  title: 'Attention',
                  text: 'Please agree to the terms and conditions before submitting the form.',
                  //footer: '<a href="">Why do I have this issue?</a>'
                })
              }

              

              if(joinCompleted == true){
                signuflowData.phoneNo = document.getElementById('phoneNo').value.trim()
                signuflowData.emailAddress = document.getElementById('emailAddress').value.trim()
                signuflowData.password = document.getElementById('password').value.trim()

                trackProcess(2,signuflowData,'');
              }

          });



          //PERSON FORM
          document.getElementById('form4x').addEventListener('submit', function(event) {

              event.preventDefault()
              
              personalCompleted =true

              

              if(personalCompleted == true){
                
                signuflowData.fullname = document.getElementById('fullname').value.trim()
                signuflowData.gender = document.getElementById('gender').value.trim()
                signuflowData.dateOfBirth = document.getElementById('dateOfBirth').value.trim()
                signuflowData.address = document.getElementById('address').value.trim()
                signuflowData.addressWork = document.getElementById('addressWork').value.trim()
                signuflowData.qualification = document.getElementById('qualification').value.trim()
                signuflowData.maritalStatus = document.getElementById('maritalStatus').value.trim()
                signuflowData.monthlyIncome = document.getElementById('monthlyIncome').value.trim()
                

                trackProcess(4,signuflowData,'');
              }

          });





          //NAVIGATION
          // Variables to keep track of the current form step
          //let currentStep = 6//1;
          //const totalSteps = 50; // Total number of forms

          // Function to show the current step
          function showStep(step) {
             // Hide all forms
             const forms = document.querySelectorAll('.form');
             forms.forEach(form => {
                form.classList.remove('show');
             });

             console.log('step: ', `form${step}`)

             // Show the current form
             const currentForm = document.getElementById(`form${step}`);
             currentForm.classList.add('show');

             currentStep =step;
          }

          // Event listener for "Next" button
          document.addEventListener('click', function(event) {
             if (event.target.matches('button[id^="nextBtn"]')) {
                // Validate the form fields (implement your validation logic here)
                const isFormValid = true; // Change this based on your validation logic
                if (isFormValid) {
                   currentStep++;
                   if (currentStep > totalSteps) {
                      currentStep = totalSteps;
                   }
                   showStep(currentStep);
                }
             } else if (event.target.matches('button[id^="backBtn"]')) {
                currentStep--;
                if (currentStep < 1) {
                   currentStep = 1;
                }
                showStep(currentStep);
             }
          });

          // Show the initial form (first step)

          showStep(currentStep);














      function trackProcess(step,p,wildcard) {

        if(wildcard=='otp'){
          signuflowData.otpcode = document.getElementById('verificationcode').value;
          p=signuflowData
          step = 3
        }

                      //console.log(p)
                       
                      var payl={
                        'step': step,
                        'payl': p
                      }

              
            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Set the request method and URL
            xhr.open("POST", "_create_account_exec.php", true);

            // Set the content type of the request
            xhr.setRequestHeader("Content-Type", "application/json");

            // Log the JSON data being sent
            console.log("Sending JSON data:", JSON.stringify(payl));

            // Define what happens on successful data submission
            xhr.onload = function() {
                console.log("Response from server:", xhr.responseText); // Log server response
                if (xhr.status >= 200 && xhr.status < 300) {
                    // Request was successful, parse the response JSON
                    console.log(xhr)
                    var responseArray = JSON.parse(xhr.responseText);


                    //console.log('step: ', step)
                  if (responseArray.status =='success'){

                    if (responseArray.task=='otp'){
                      
                       if (responseArray.phoneNo !==''){
                          document.getElementById('phoneNo_otp').value = responseArray.phoneNo.trim()
                          signuflowData.phoneNoFB = responseArray.phoneNo.trim()                          

                          if(responseArray.next_step > 100){
                            showStep(responseArray.next_step)
                          }else{
                            showStep(step+1)
                          }
                          return;
                       }

                    }else if (responseArray.task=='emailVerify'){
                      window.location.href= "_create_account_verify.php";
                      return;

                    }else if (responseArray.task=='login'){   
                      window.location.href= "index.php?t6yuy77878=5ouieir78637863euoiueouo897892878976dueejdhskfjshfljhk";
                      return;
                      
                    }else{
                      if(responseArray.next_step > 100){
                            showStep(responseArray.next_step)
                          }else{
                            showStep(step+1)
                          }
                    }
                  }else{
                    //fail
                      Swal.fire({
                        icon: 'warning',
                        title: 'Attention',
                        text: responseArray.message,
                        //footer: '<a href="">Why do I have this issue?</a>'
                      })

                  }


                    console.log("Parsed Response Array:", responseArray); // Log parsed response
                } else {
                    // Request failed with an error status
                    console.error('Request failed with status:', xhr.status);
                }
            };

            // Prepare the data to be sent as JSON
            var jsonData = JSON.stringify(payl);

            // Send the request with the JSON data
            xhr.send(jsonData);
        }

    </script>












<script>
  
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

render();


function render(){
  window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
  recaptchaVerifier.render();
}
  // function for send message
function phoneAuth(){

  //alert(signuflowData.phoneNo.trim())
  if(signuflowData.phoneNoFB.trim()==''){

       Swal.fire({
                  icon: 'warning',
                  title: 'Attention',
                  text: 'Please enter a valid phone number.',
                  //footer: '<a href="">Why do I have this issue?</a>'
                })

  }else{
    //testt
    //trackProcess('','','otp');
    //return;

  var number = signuflowData.phoneNoFB.trim();//  document.getElementById('phoneNo_otp').value;

  firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function(confirmationResult){
    window.confirmationResult = confirmationResult;
    coderesult = confirmationResult;

    document.getElementById('sender').style.display = 'none';
    document.getElementById('verifier').style.display = 'block';


  }).catch(function(error){
    //alert(error.message);
    Swal.fire({
                  icon: 'warning',
                  title: 'Attention',
                  text: error.message,
                  //footer: '<a href="">Why do I have this issue?</a>'
                })
  });

}




}
  // function for code verify
  function codeverifyccccccc(){
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

function codeverify(){
  var code = document.getElementById('verificationcode').value;
  coderesult.confirm(code).then(function(confirmationResult){
    console.log('Confirmation Result:', confirmationResult);
    document.getElementsByClassName('p-conf')[0].style.display = 'block';
    document.getElementsByClassName('n-conf')[0].style.display = 'none';
    //otpCompleted = true
    //verifySend()
    //if(otpCompleted == true){
      //signuflowData.otpcode = code.value.trim()
      
      trackProcess('','','otp');
    //}
  }).catch(function(error){
    console.error('Confirmation Error:', error);
    document.getElementsByClassName('p-conf')[0].style.display = 'none';
    document.getElementsByClassName('n-conf')[0].style.display = 'block';
  })

}



</script>





    <?php include_once('_js.php');?>
  </body>
</html>


