<?php 
session_start();

/*SECTION: INCLUDES*/
include_once "ini.php";
include_once "functions.php";

if(isset($_SESSION['signuflow'])){
            unset($_SESSION['signuflow']);
}

/*SECTION: CHECKISUSERLOGGEDIN*/
if(isset($_SESSION[APP_SESSION_NAME]))
{ 

  if ($_SESSION[APP_SESSION_NAME]["isAdmin"] !=1 ){
      header("location: dashboard.php");
  }elseif ($_SESSION[APP_SESSION_NAME]["isAdmin"] ==1 ){
      header("location: _admin_dashboard.php");

  }

}
$page='index';

/*SECTION: VARIABLES*/
$username = "";
$password = "";
$errorMessage ="";
$loginVariableNamesArray = array("username","password");

/*SECTION: GETDATABASECONNECTION*/
$pdo = getMySQLPDOLink_(false,false);

$searchTerm='';

/*SECTION: ERRORMESSAGES*/
$error_usernameorpassword = "eioy236rufjksdmkfjioeutr8u9fj";
$error_notverified = "ouieir786378632878976dueejdhskfjshfljhk";
$error_notverifiedregisteration = "ouieir78637863euoiueouo897892878976dueejdhskfjshfljhk";
$error_verifiedregisteration = "5ouieir78637863euoiueouo897892878976dueejdhskfjshfljhk";

/*SECTION: CHECKIFPOSTCALL*/
if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST))
{
  if (validatePOSTS($loginVariableNamesArray) == true) {
    
    $username=sanitizeString_($_POST["username"]);
    $password= md5( sanitizeString_($_POST["password"]) );  
    $password= $password.APP_X;

    try {
      //get user
      $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `username`=? OR `phoneNo`=?  OR `emailAddress`=?");
      $stmt->execute([$username,$username,$username]);
      $data = $stmt->fetchAll();

      if ($data) {

        //get owner
        $ownerdata =array();
        $stmt = $pdo->prepare("SELECT * FROM `owners` WHERE `id`=?");
        $stmt->execute([$data[0]["ownerId"]]);
        $ownerdata = $stmt->fetchAll();
        
        //todo:
        //check if not verified then send error
        if (APP_FEATURE_ENFORCE_ISVERIFIED==true) {           
          if ($data[0]["isVerified"] !=1) {
            //echo 'sdsdjhdsjhjsdhjkhsdjkhkhjkhkjsd';exit();
            //header("location: _otp.php?t6yuy77878=ouieir786378632878976dueejdhskfjshfljhk");
            header("location: _create_account_verify.php");
            exit();
           } 
        }
        //check if not verified then send error
          
        if(password_verify($password, $data[0]["password"])){
           session_regenerate_id();
           $_SESSION[APP_SESSION_NAME] = $data[0];           
           $_SESSION[APP_SESSION_NAME]["owner"] = $ownerdata[0];
           session_write_close(); header("location: dashboard.php");     exit();
          }else{header("location: index.php?t6yuy77878=eioy236rufjksdmkfjioeutr8u9fj");}
      }

    } catch (\PDOException $e) {
        $errorMessage .= "<b>Incorrect Account</b><br>";
         //throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
 
}else{
  $errorMessage .= "<b>One or more required input is empty.</b><br>";
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
    <title>Login - Thrift Thrust</title>
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
          class="grid place-items-center gap-6 py-12 md:grid-cols-2 lg:gap-12"
        >
          <div class="flex flex-col font-inter md:gap-2">
            <h1
              class="scroll-m-20 text-4xl font-extrabold tracking-tight text-[#0e538e] lg:text-6xl"
            >
              Welcome to
            </h1>
            <h1
              class="scroll-m-20 text-4xl font-extrabold tracking-tight text-[#0e538e] lg:text-6xl"
            >
              Thrift Thrust
            </h1>
            <p
              class="text-xl leading-7 text-white [&amp;:not(:first-child)]:mt-6"
            >
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid
              atque molestiae magnam hic vel iste ipsa quae corporis, modi ea.
            </p>
          </div>
          <div
            class="rounded-xl border bg-card text-card-foreground min-w-full max-w-[520px] px-4 py-6 shadow-xl md:px-8 md:py-10"
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
                  
                  if ($error==$error_verifiedregisteration) {
                    echo "<div style='color: darkgreen' class='alert alert-dismissible alert-success mt-3 font-weight-bold'>
                      <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      Your account is successfully verified, please log in.</div>";  } 
                  }

                  
                  ?>  
               <?php if (!empty($errorMessage)) {?>
                <div class="col-md-12 grid-margin">
              <div class="card bg-gradient-danger border-0">
                <div class="card-body py-3 px-4 d-flex align-items-center justify-content-between flex-wrap">
                  <p class="mb-0 text-white font-weight-medium"><?php echo $errorMessage; ?></p>
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
              <form method="post" action="">
                <div class="grid w-full items-center gap-8">
                  <div class="flex flex-col space-y-1.5">
                    <input name="username"  
                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                      id="text"
                      placeholder="Phone number or email address" 
                      required 
                    />
                  </div>
                  <div class="flex flex-col space-y-1.5">
                    <input name="password" 
                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                      id="password"
                      placeholder="password" 
                      required  
                    />
                  </div>
                  <button
                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-lg hover:bg-brand-600"
                  >
                    Log in
                  </button>
                  <div class="flex justify-center">
                    <a
                      class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 underline-offset-4 hover:underline h-8 rounded-md px-3 text-xs text-blue-600"
                      href=""
                      >Forgot Password</a
                    >
                  </div>
                </div>
              </form>
            </div>
            <div class="flex p-6 pt-0 flex-col items-stretch">
              <div
                data-orientation="horizontal"
                role="none"
                class="shrink-0 bg-border h-[1px] w-full mb-4"
              ></div>
              <!--a href="_join_category.php"  -->
              <a href="_create_account.php"  
                class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-[#2da573] text-base hover:bg-[#278d62]"
              >
                Create new account
              </a>
            </div>
          </div>
        </div>
      </div>
    </main>
    <?php include_once('_footer.php');?>
  </body>
</html>
