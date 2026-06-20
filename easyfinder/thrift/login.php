
<?php
/*SECTION: SESSION*/
session_start();

/*SECTION: INCLUDES*/
include_once "ini.php";
include_once "functions.php";

/*SECTION: CHECKISUSERLOGGEDIN*/
if(isset($_SESSION[APP_SESSION_NAME]))
{ header("location: dashboard.php");  
  exit();
}

/*SECTION: VARIABLES*/
$username = "";
$password = "";
$errorMessage ="";
$loginVariableNamesArray = array("username","password");

/*SECTION: GETDATABASECONNECTION*/
$pdo = getMySQLPDOLink_(false,false);

/*SECTION: ERRORMESSAGES*/
$error_usernameorpassword = "eioy236rufjksdmkfjioeutr8u9fj";
$error_notverified = "ouieir786378632878976dueejdhskfjshfljhk";
$error_notverifiedregisteration = "ouieir78637863euoiueouo897892878976dueejdhskfjshfljhk";

/*SECTION: CHECKIFPOSTCALL*/
if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST))
{
  if (validatePOSTS($loginVariableNamesArray) == true) {
    
    $username=sanitizeString_($_POST["username"]);
    $password= md5( sanitizeString_($_POST["password"]) );  
    $password= $password.APP_X;

    try {
      //get user
      $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `username`=?");
      $stmt->execute([$username]);
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
            header("location: login.php?t6yuy77878=ouieir786378632878976dueejdhskfjshfljhk");
            exit();
           } 
        }
        //check if not verified then send error
          
        if(password_verify($password, $data[0]["password"])){
           session_regenerate_id();
           $_SESSION[APP_SESSION_NAME] = $data[0];           
           $_SESSION[APP_SESSION_NAME]["owner"] = $ownerdata[0];
           session_write_close(); header("location: dashboard.php");     exit();
          }else{header("location: login.php?t6yuy77878=eioy236rufjksdmkfjioeutr8u9fj");}
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
<html lang="en" ng-app="myApp" ng-controller="myController">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo APP_TITLE;?> | Login</title>
  <!-- plugins:css -->
  <?php include_once "css.php";?>
  <!-- endinject -->
  <!--link rel="shortcut icon" href="<?php echo APP_ROOT.APP_UI;?>/images/<?php echo APP_ICON;?>" /-->
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0 bg-white">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-center py-5 px-4 px-sm-5">
              <div class="brand-logo">
              <a href="index.php">
                <img src="<?php echo APP_ROOT.APP_UI;?>/images/<?php echo APP_LOGO;?>" alt="">
                </a>
              </div>
              <h4><?php echo APP_TITLE;?></h4>
              <h6 class="font-weight-light">Sign in</h6>
              <!--a style="text-align: right !important;" class="font-weight-bold" href="javascript:void(0);" onclick="startIntro();">
              <i class="mdi mdi-help-circle"> </i> Play Help</a-->
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
              <form class="pt-3" method="post" action="">
                <div class="form-group">
                  <input autofocus id="step1" name="username" type="text" class="form-control form-control-sm" placeholder="Username">
                </div>
                <div class="form-group">
                  <input id="step2" name="password" type="password" class="form-control form-control-sm" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>
                <!--div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="mdi mdi-facebook mr-2"></i>Connect using facebook
                  </button>
                </div-->
                <div class="text-center mt-4 font-weight-bold">
                  Don`t have an account? <a id="step3" href="join.php" class="text-primary">Create</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <?php include_once "js.php";?>
  <!-- endinject -->

</body>

</html>
