<?php 
session_start();

include_once "ini.php";
include_once "ini_custom.php";
include_once "functions.php";
include_once "functions_custom.php";
include_once "functions_customui.php";
    if (!isset($_SESSION[APP_SESSION_NAME]) ){
      header("location: logout.php");
    }
if ($_SESSION[APP_SESSION_NAME]["isAdmin"] ==1 ){
header("location: dashboard.php");
}



/*SECTION: GENERAL*/
$pdo = getMySQLPDOLink_(false,false);
$errorMessage="";
$id =-1;
$task= "";
$submittedComponentTitle="";
$componentToShowName="";
$userId= -1;
$ownerId= -1;

if (isset($_SESSION[APP_SESSION_NAME]) ){
$userId =$_SESSION[APP_SESSION_NAME]["id"];
$ownerId =$_SESSION[APP_SESSION_NAME]["ownerId"];
}

$searchTerm="";

/**
 * POSTS/GETS
 */
//echo $_POST["doSubmit"];
//if ((((($_SERVER["REQUEST_METHOD"] === "POST") && isset($_POST)) &&  isset($_POST["doSubmit"])) ) 
if ((((($_SERVER["REQUEST_METHOD"] === "POST") && isset($_POST)) ) ) 
  ){
    if (isset($_POST["id"])) { $id = $_POST["id"];  }
    if (isset($_POST["task"])) { $task = $_POST["task"];  }
    if (isset($_POST["doSubmit"])) { 
      $submittedComponentTitle = $_POST["doSubmit"];  
      /*$y = explode(":newlyInsertedId:", $submittedComponentTitle);
      $submittedComponentTitle=trim($y[0]);
      print_r($y);*/
    }
    //if (isset($_POST["doSubmit"])) { $newlyInsertedId = $_POST["newlyInsertedId"];  }

    }elseif ((((($_SERVER["REQUEST_METHOD"] === "GET") && isset($_GET)) ) )) {
      if (isset($_GET["id"])) { $id = $_GET["id"];  }
      if (isset($_GET["task"])) { $task = $_GET["task"];  }     
  }else{
    //header("location: dashboard_page.php");
    //exit();
  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard | <?php echo APP_TITLE;?></title>
  <!-- plugins:css -->
  <?php include "css.php";?>
  <!-- endinject -->
  <!--link rel="shortcut icon" href="theme/images/<?php echo APP_ICON;?>" /-->
</head>
<body  class="" >
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include "navbar.php";?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php include "sidebar.php";?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper" style="padding: 0 0 0 .1rem !important;">

        <!--SECTION: COMPONENTS--><div class="row"><div class="col-12 container">
<div class ="row">

<?php 
/**VARIABLES*/
$total =0;
 $campaigns=array();
?><?php try {
      $stmt = $pdo->prepare("SELECT COUNT(*) AS `total` FROM `campaigns`  WHERE `userId`=?  ");
      $stmt->execute([$_SESSION[APP_SESSION_NAME]["userId"]]);
      $campaigns = $stmt->fetchAll();     
    } catch (\PDOException $e) {
        $errorMessage .= "<b>Error loading campaigns</b><br>";
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }?><?php 
if(count($campaigns)>0){
  if(isset($campaigns[0]["total"])){
$total = $campaigns[0]["total"];

}}
?>
<?php 
/*DISPLAY*/
?>

<?php 
/**************************************************************/
//COMPONENT:show-total-records-on-dashboard_page-auto127
//TITLE: Campaigns
//TYPE: show-total-records
/**************************************************************/
?><div class="mt-1 mb-1 col-12 col-md-4 col-lg-3 stretch-card">
<div class="card border-left-primary shadow h-100 py-2" style="border-radius: .35rem;">
<div class="card-body p-2">
  <!--p class="card-title">Campaigns</p--><?php //}?><div class="d-flex justify-content-between align-items-baseline">
      <h6 class="card-title mb-0">Campaigns</h6>
    </div>
    <div class="row">
      <div class="col-12">
        <h1 class="mb-2  font-weight-bold text-gray-800"><?php echo $total;?></h1>
        <div class="d-flex align-items-baseline">
          <p class="text-success">
            <span></span>
          </p>
        </div>
      </div>
      
</div>
    </div>
  </div>
</div><?php 
/**************************************************************/
//COMPONENT END: 
/**************************************************************/
?>
<?php 
/**VARIABLES*/
$total =0;
 $donations=array();
?><?php try {
      $stmt = $pdo->prepare("SELECT COUNT(*) AS `total` FROM `donations`  WHERE `userId`=?  ");
      $stmt->execute([$_SESSION[APP_SESSION_NAME]["userId"]]);
      $donations = $stmt->fetchAll();     
    } catch (\PDOException $e) {
        $errorMessage .= "<b>Error loading donations</b><br>";
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }?><?php 
if(count($donations)>0){
  if(isset($donations[0]["total"])){
$total = $donations[0]["total"];

}}
?>
<?php 
/*DISPLAY*/
?>

<?php 
/**************************************************************/
//COMPONENT:show-total-records-on-dashboard_page-auto128
//TITLE: Donations
//TYPE: show-total-records
/**************************************************************/
?><div class="mt-1 mb-1 col-12 col-md-4 col-lg-3 stretch-card">
<div class="card border-left-primary shadow h-100 py-2" style="border-radius: .35rem;">
<div class="card-body p-2">
  <!--p class="card-title">Donations</p--><?php //}?><div class="d-flex justify-content-between align-items-baseline">
      <h6 class="card-title mb-0">Donations</h6>
    </div>
    <div class="row">
      <div class="col-12">
        <h1 class="mb-2  font-weight-bold text-gray-800"><?php echo $total;?></h1>
        <div class="d-flex align-items-baseline">
          <p class="text-success">
            <span></span>
          </p>
        </div>
      </div>
      
</div>
    </div>
  </div>
</div><?php 
/**************************************************************/
//COMPONENT END: 
/**************************************************************/
?>
<?php 
/**VARIABLES*/
$total =0;
 $deposits=array();
?><?php try {
      $stmt = $pdo->prepare("SELECT COUNT(*) AS `total` FROM `deposits`  WHERE `userId`=?  ");
      $stmt->execute([$_SESSION[APP_SESSION_NAME]["userId"]]);
      $deposits = $stmt->fetchAll();     
    } catch (\PDOException $e) {
        $errorMessage .= "<b>Error loading deposits</b><br>";
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }?><?php 
if(count($deposits)>0){
  if(isset($deposits[0]["total"])){
$total = $deposits[0]["total"];

}}
?>
<?php 
/*DISPLAY*/
?>

<?php 
/**************************************************************/
//COMPONENT:show-total-records-on-dashboard_page-auto129
//TITLE: Deposits
//TYPE: show-total-records
/**************************************************************/
?><div class="mt-1 mb-1 col-12 col-md-4 col-lg-3 stretch-card">
<div class="card border-left-primary shadow h-100 py-2" style="border-radius: .35rem;">
<div class="card-body p-2">
  <!--p class="card-title">Deposits</p--><?php //}?><div class="d-flex justify-content-between align-items-baseline">
      <h6 class="card-title mb-0">Deposits</h6>
    </div>
    <div class="row">
      <div class="col-12">
        <h1 class="mb-2  font-weight-bold text-gray-800"><?php echo $total;?></h1>
        <div class="d-flex align-items-baseline">
          <p class="text-success">
            <span></span>
          </p>
        </div>
      </div>
      
</div>
    </div>
  </div>
</div><?php 
/**************************************************************/
//COMPONENT END: 
/**************************************************************/
?>
<?php 
/**VARIABLES*/
$total =0;
 $withdrawals=array();
?><?php try {
      $stmt = $pdo->prepare("SELECT COUNT(*) AS `total` FROM `withdrawals`  WHERE `userId`=?  ");
      $stmt->execute([$_SESSION[APP_SESSION_NAME]["userId"]]);
      $withdrawals = $stmt->fetchAll();     
    } catch (\PDOException $e) {
        $errorMessage .= "<b>Error loading withdrawals</b><br>";
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }?><?php 
if(count($withdrawals)>0){
  if(isset($withdrawals[0]["total"])){
$total = $withdrawals[0]["total"];

}}
?>
<?php 
/*DISPLAY*/
?>

<?php 
/**************************************************************/
//COMPONENT:show-total-records-on-dashboard_page-auto130
//TITLE: Withdrawals
//TYPE: show-total-records
/**************************************************************/
?><div class="mt-1 mb-1 col-12 col-md-4 col-lg-3 stretch-card">
<div class="card border-left-primary shadow h-100 py-2" style="border-radius: .35rem;">
<div class="card-body p-2">
  <!--p class="card-title">Withdrawals</p--><?php //}?><div class="d-flex justify-content-between align-items-baseline">
      <h6 class="card-title mb-0">Withdrawals</h6>
    </div>
    <div class="row">
      <div class="col-12">
        <h1 class="mb-2  font-weight-bold text-gray-800"><?php echo $total;?></h1>
        <div class="d-flex align-items-baseline">
          <p class="text-success">
            <span></span>
          </p>
        </div>
      </div>
      
</div>
    </div>
  </div>
</div><?php 
/**************************************************************/
//COMPONENT END: 
/**************************************************************/
?></div></div><!--div class ="row"-->   
          <!--Section End--></div>
        <!--SECTION: COMPONENTS-->

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php include_once "footer.php";?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <?php include_once "js.php";?>
  
  <!-- End custom js for this page-->
  
</body>

</html>