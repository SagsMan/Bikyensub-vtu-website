<?php 
session_start();

include_once "ini.php";
include_once "ini_custom.php";
include_once "functions.php";
include_once "functions_custom.php";
include_once "functions_customui.php";
if ($_SESSION[APP_SESSION_NAME]["isAdmin"] !=1 ){
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
    //header("location: admin_donations_form_page.php");
    //exit();
  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Donations | <?php echo APP_TITLE;?></title>
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
/**************************************************************/
//VERSION:  
//COMPONENT:admin_donations_form_component
//TITLE:    Donations
//TYPE:     formV5
//PARTIAL:  Component Properties
/**************************************************************/
?><!-- --------------------------------------------------------------------------------------

:
""










none
[]

< -------------------------------------------------------------------------------------- -->
<?php 
/**************************************************************/
//VERSION:  
//PARTIAL:  Component Variables
/**************************************************************/
?>
<?php 
/**VARIABLES
 * NOTES: Used for this component
*/
$admin_donations_form_component_datasource= array();
$admin_donations_form_component_searchTerm__=array();
//$searchTerm__=array();

$admin_donations_form_component_donation_date="";
$admin_donations_form_component_campaign_id="";
$admin_donations_form_component_donation_amount="";
$admin_donations_form_component_payment_method="";
$admin_donations_form_component_isActive="";

//initialize these component level variables with their page level equivalent
//and then get them again if they are posted/or getted at component level
//HANDLE FORM LEVEL VARS
$admin_donations_form_component_errorMessage= "";
$admin_donations_form_component_id = -1;
$admin_donations_form_component_task= "";
$admin_donations_form_component_submittedComponentTitle= "";
$admin_donations_form_component_componentToShowName="";
$admin_donations_form_component_userId = "";
$admin_donations_form_component_ownerId ="";
if(isset($_SESSION[APP_SESSION_NAME]["id"])){
$admin_donations_form_component_userId = $_SESSION[APP_SESSION_NAME]["id"];
}
if(isset($_SESSION[APP_SESSION_NAME]["id"])){
$admin_donations_form_component_ownerId =$_SESSION[APP_SESSION_NAME]["ownerId"];
}
$admin_donations_form_component_searchTerm="";
$admin_donations_form_component_multipartComponentToDisplayName="";//this is needed to determine which multipart active component to display

//ini with page level values if enabled$admin_donations_form_component_errorMessage= $errorMessage;
$admin_donations_form_component_id = $id;
$admin_donations_form_component_task= $task;
$admin_donations_form_component_submittedComponentTitle= $submittedComponentTitle;
$admin_donations_form_component_searchTerm= $searchTerm;

 ?>
<?php 
/**************************************************************/
//VERSION:  
//PARTIAL:  Form Based Component Header
/**************************************************************/
?>
<?php 
  //the component might expect the following GET OR POST vars
  if (validatePOSTS(array("admin_donations_form_component_multipartComponentToDisplayName")) === true) 
  {

    $admin_donations_form_component_multipartComponentToDisplayName = sanitizeString_($_POST["admin_donations_form_component_multipartComponentToDisplayName"]);

  }elseif (validateGETS(array("admin_donations_form_component_multipartComponentToDisplayName")) === true) 
  {

    $admin_donations_form_component_multipartComponentToDisplayName = sanitizeString_($_GET["admin_donations_form_component_multipartComponentToDisplayName"]);

  }elseif(
    (!isset($admin_donations_form_component_multipartComponentToDisplayName) || empty($admin_donations_form_component_multipartComponentToDisplayName) ) && 
    -1000===0
   ){

      $admin_donations_form_component_multipartComponentToDisplayName="admin_donations_form_component";
   }
?>


<?php 
if(
    (0===0) || 
    ((0===1 && "admin_donations_form_component"===strtolower($admin_donations_form_component_multipartComponentToDisplayName)
    )) 
  ){
?>

<?php 
if(($_SERVER["REQUEST_METHOD"] === "POST") && isset($_POST)){
  //echo "<pre>";
//print_r($_POST);
//echo "</pre>";
}
?>

<?php 
/**
 * POSTS/GETS
 */

//POSTS
if (
  (((($_SERVER["REQUEST_METHOD"] === "POST") && isset($_POST)) && 
  isset($_POST["admin_donations_form_component_doSubmit"])) ) 
  ){

      if (isset($_POST["admin_donations_form_component_id"])){$admin_donations_form_component_id=sanitizeString_($_POST["admin_donations_form_component_id"]);}

      if (isset($_POST["admin_donations_form_component_task"])){$admin_donations_form_component_task=sanitizeString_($_POST["admin_donations_form_component_task"]);}

      if (isset($_POST["admin_donations_form_component_doSubmit"])){$admin_donations_form_component_submittedComponentTitle=sanitizeString_($_POST["admin_donations_form_component_doSubmit"]);}

      if (isset($_POST["admin_donations_form_component_donation_date"])) 
      { 
        $admin_donations_form_component_donation_date= $_POST["admin_donations_form_component_donation_date"];

      }

      if (isset($_POST["admin_donations_form_component_campaign_id"])) 
      { 
        $admin_donations_form_component_campaign_id= $_POST["admin_donations_form_component_campaign_id"];

      }

      if (isset($_POST["admin_donations_form_component_donation_amount"])) 
      { 
        $admin_donations_form_component_donation_amount= $_POST["admin_donations_form_component_donation_amount"];

      }

      if (isset($_POST["admin_donations_form_component_payment_method"])) 
      { 
        $admin_donations_form_component_payment_method= $_POST["admin_donations_form_component_payment_method"];

      }

      if (isset($_POST["admin_donations_form_component_isActive"])) 
      { 
        $admin_donations_form_component_isActive= $_POST["admin_donations_form_component_isActive"];

      }

      if (isset($_POST["admin_donations_form_component_searchTerm"])){$admin_donations_form_component_searchTerm=sanitizeString_($_POST["admin_donations_form_component_searchTerm"]);}
?><?php 
}elseif (
    (((($_SERVER["REQUEST_METHOD"] === "GET") && isset($_GET)) ) ) 
    ){
      //$id = $_GET["id"];
      //$task = $_GET["task"];  

      if (isset($_GET["admin_donations_form_component_id"])){$admin_donations_form_component_id=sanitizeString_($_GET["admin_donations_form_component_id"]);}

      if (isset($_GET["admin_donations_form_component_task"])){$admin_donations_form_component_task=sanitizeString_($_GET["admin_donations_form_component_task"]);}

      if (isset($_GET["admin_donations_form_component_doSubmit"])){$admin_donations_form_component_submittedComponentTitle=sanitizeString_($_GET["admin_donations_form_component_doSubmit"]);}

        if (isset($_GET["admin_donations_form_component_searchTerm"])){$admin_donations_form_component_searchTerm=sanitizeString_($_GET["admin_donations_form_component_searchTerm"]);}
?> <?php 
      }else{
      }
?>
<?php 
/**************************************************************/
//VERSION:  
//PARTIAL:  Form Based Component Tasks
/**************************************************************/
?>
<?php 
//HANDLE TASKS
switch ($admin_donations_form_component_task) {
  case "top-level-form":
    try 
    {
      $stmt = $pdo->prepare("SELECT * FROM `donations` WHERE `userId`=? AND `ownerId`=? ");
      $stmt->execute([$userId,$ownerId]);
      $data = $stmt->fetchAll();
      if ($data) {
        if(isset($data[0]["id"]))
        {
          $admin_donations_form_component_id= $data[0]["id"];
        }
        $admin_donations_form_component_donation_date= $data[0]["donation_date"];
$admin_donations_form_component_campaign_id= $data[0]["campaign_id"];
$admin_donations_form_component_donation_amount= $data[0]["donation_amount"];
$admin_donations_form_component_payment_method= $data[0]["payment_method"];
$admin_donations_form_component_isActive= $data[0]["isActive"];
            }
        } catch (\PDOException $e) {
            $errorMessage .= "<b>Database error loading donations</b><br>";
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    break;
  case "new":
    break;
  case "edit":
    /*This will never execute on POST for a component that was not posted. see `save`*/
    if($admin_donations_form_component_id > 0){
        try {  $stmt = $pdo->prepare("SELECT * FROM `donations` WHERE `id`=?");
          $stmt->execute([$admin_donations_form_component_id]);
          $data = $stmt->fetchAll();  if ($data) {if(empty($data[0]["donation_date"])){}else{$admin_donations_form_component_donation_date= $data[0]["donation_date"];
}
if(empty($data[0]["campaign_id"])){}else{$admin_donations_form_component_campaign_id= $data[0]["campaign_id"];
}
if(empty($data[0]["donation_amount"])){}else{$admin_donations_form_component_donation_amount= $data[0]["donation_amount"];
}
if(empty($data[0]["payment_method"])){}else{$admin_donations_form_component_payment_method= $data[0]["payment_method"];
}
if(empty($data[0]["isActive"])){}else{$admin_donations_form_component_isActive= $data[0]["isActive"];
}
            }
        } catch (\PDOException $e) {
            $errorMessage .= "<b>Database error loading donations</b><br>";
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
      }else{
        header("location: admin_donations_form_page.php");
      }
    break;
  case "delete":
    try {
          $stmt = $pdo->prepare("DELETE FROM `donations` WHERE `id`=?");
          $stmt->execute([$admin_donations_form_component_id]);
          header("location: admin_donations_form_page.php");
          exit();
        } catch (\PDOException $e) {
            $errorMessage .= "<b>Database error deleting from donations</b><br>";
            //throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    break;
  case "save":
    /*Will only execute for a submitted component, and else for the other components$app->pages[$ipages]->components[$icomponent]->title*/
    
        if($admin_donations_form_component_submittedComponentTitle==="admin_donations_form_component")
        {
          if($admin_donations_form_component_id < 1){
            /*if theres a file to upload then try uploading*/try 
              {
                $stmt = $pdo->prepare("INSERT INTO `donations` (`donation_date`,`campaign_id`,`donation_amount`,`payment_method`,`isActive`, `updatedBy`, `userId`, `ownerId`) VALUES (?,?,?,?,?,?,?,?)"); $stmt->execute([$admin_donations_form_component_donation_date,$admin_donations_form_component_campaign_id,$admin_donations_form_component_donation_amount,$admin_donations_form_component_payment_method,$admin_donations_form_component_isActive,
                  $_SESSION[APP_SESSION_NAME]["fullname"]." (".$_SESSION[APP_SESSION_NAME]["id"].")",$_SESSION[APP_SESSION_NAME]["id"],$_SESSION[APP_SESSION_NAME]["ownerId"] ]);
              $admin_donations_form_component_id = $pdo->lastInsertID();    
            } catch (\PDOException $e) {
              $errorMessage .= "<b>Error adding to donations</b><br>";
              throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
          }elseif ($admin_donations_form_component_id > 0 ) 
          {try 
            {
              /*if theres a file to upload then try uploading*/ $stmt = $pdo->prepare("UPDATE `donations` SET `donation_date`=?,`campaign_id`=?,`donation_amount`=?,`payment_method`=?,`isActive`=?, `updatedBy`=?,`updatedOn`=? WHERE `id`=?"); $stmt->execute([$admin_donations_form_component_donation_date,$admin_donations_form_component_campaign_id,$admin_donations_form_component_donation_amount,$admin_donations_form_component_payment_method,$admin_donations_form_component_isActive,   $_SESSION[APP_SESSION_NAME]["fullname"]." (".$_SESSION[APP_SESSION_NAME]["id"].")", getDate_() ,$admin_donations_form_component_id]);                    
            } catch (\PDOException $e) {
                      $errorMessage .= "<b>Error updating donations</b><br>";
                      throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }/*end try*/
          }else{
            header("location: admin_donations_form_page.php");
          }
        }else{
          /*same as for edit this will only execute for a component that wasnt submitted on POST*/
          if($admin_donations_form_component_id > 0){
            try {
                      $stmt = $pdo->prepare("SELECT * FROM `donations` WHERE `id`=?");
                      $stmt->execute([$admin_donations_form_component_id]);
                      $data = $stmt->fetchAll();
                    if ($data) {if(empty($data[0]["donation_date"])){}else{$admin_donations_form_component_donation_date= $data[0]["donation_date"];
}
if(empty($data[0]["campaign_id"])){}else{$admin_donations_form_component_campaign_id= $data[0]["campaign_id"];
}
if(empty($data[0]["donation_amount"])){}else{$admin_donations_form_component_donation_amount= $data[0]["donation_amount"];
}
if(empty($data[0]["payment_method"])){}else{$admin_donations_form_component_payment_method= $data[0]["payment_method"];
}
if(empty($data[0]["isActive"])){}else{$admin_donations_form_component_isActive= $data[0]["isActive"];
}
    
                    }} catch (\PDOException $e) {
                        $errorMessage .= "<b>Database error loading donations</b><br>";
                        throw new \PDOException($e->getMessage(), (int)$e->getCode());
                    }
          }else{
            //header("location: admin_donations_form_page.php");
          }
        //////
        }   break;
            
            default:
              //header("location: admin_donations_form_page.php");
              break;
          }
?>

<?php 
/******************************************************************DISPLAY******************************************************************/
?>

<div class="mt-1 mb-1 col-12 col-md-12 col-lg-12 stretch-card"  style="height: ;">
  <div class="card pt-0" style="overflow-x: hidden;">
    <div class="card-body p-2 pt-0">
    <div class="bg-white sticky-top animate__animated  animate__bounce  animate__delay-1s ">
      <!--p class="card-title mb-2">Donations</p-->  <p class="card-description">Manage Donations</p></div><div class="row pull-rightx mt-2">
  <div class="col-12 ml-auto animate__animated  animate__slideInLeft  animate__delay-1s ">
  <h1 class="display-5 font-weight-bold">
  <?php /*echo count($donations);*/ ?>
   <?php echo "Donations";?></h1>
  </div></div>
      <?php 
      /**FORM*/
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
           
<?php 
/**************************************************************/
//VERSION:  
//PARTIAL:  Form Based Component Data Display
/**************************************************************/
?>
<form  class="23-o--link--o-804-o--link--o-admin_donations_form_page.php-o--link--o-982-o--link--o-admin_donations_form_component-o--link--o-form"  id= "23-o--link--o-Thrift-o--link--o-804-o--link--o-admin_donations_form_page-o--link--o-982-o--link--o-admin_donations_form_component-o--link--o-form" method="POST" action=""  enctype="multipart/form-data">
              <!--p class="card-description">
                Add/Edit
              </p-->

              <input type="hidden" name="task" value="save" id="task" />
              <input type="hidden" name="id" value="<?php echo $id;?>" id="id">
              <input type="hidden" name="searchTerm" value="<?php echo $searchTerm;?>" id="searchTerm">

              
              <input type="hidden" name="admin_donations_form_component_task" value="save" id="23-o--link--o-Thrift-o--link--o-804-o--link--o-admin_donations_form_page-o--link--o-982-o--link--o-admin_donations_form_component-o--link--o-task" />
              <input type="hidden" name="admin_donations_form_component_id" value="<?php echo $admin_donations_form_component_id;?>" id="23-o--link--o-Thrift-o--link--o-804-o--link--o-admin_donations_form_page-o--link--o-982-o--link--o-admin_donations_form_component-o--link--o-id" >
              <input type="hidden" name="admin_donations_form_component_searchTerm" value="<?php echo $admin_donations_form_component_searchTerm;?>" id="23-o--link--o-Thrift-o--link--o-804-o--link--o-admin_donations_form_page-o--link--o-982-o--link--o-admin_donations_form_component-o--link--o-searchTerm" >
              
              
              <div class="rowx"><div class=" p-1 mb-2"><div class ="row"><div class="col-12 mb-0 pb-0"><p class="mb-0 pb-0 pl-2 font-weight-bold"></p></div><div class="col-12 col-md-4">

                    <div class="form-group"><label class="col-sm-12 col-form-label pb-0 mb-0 font-weight-bold"><?php echo(putSpaceBetweenWords("Donation_date"));?></label><div class="col-12"><input type="date"  class="form-control form-control-sm" name="admin_donations_form_component_donation_date"  id="23-o--link--o-Thrift-o--link--o-804-o--link--o-admin_donations_form_page-o--link--o-982-o--link--o-admin_donations_form_component-o--link--o-donation_date"  idx="admin_donations_form_page-o--link--o-admin_donations_form_component-o--link--o-donation_date" value="<?php echo $admin_donations_form_component_donation_date;?>"  ><div class="col-12 ml-0 pl-0"><small class="help font-weight-bold text-danger ml-0"></small></div>
                           </div></div>
                      </div>
<div class="col-12 col-md-4">

                    <div class="form-group"><label class="col-sm-12 col-form-label pb-0 mb-0 font-weight-bold"><?php echo(putSpaceBetweenWords("Campaign_id"));?></label><div class="col-12"><input type="number"  class="form-control form-control-sm" name="admin_donations_form_component_campaign_id"  id="23-o--link--o-Thrift-o--link--o-804-o--link--o-admin_donations_form_page-o--link--o-982-o--link--o-admin_donations_form_component-o--link--o-campaign_id"  idx="admin_donations_form_page-o--link--o-admin_donations_form_component-o--link--o-campaign_id" value="<?php echo $admin_donations_form_component_campaign_id;?>"  ><div class="col-12 ml-0 pl-0"><small class="help font-weight-bold text-danger ml-0"></small></div>
                           </div></div>
                      </div>
<div class="col-12 col-md-4">

                    <div class="form-group"><label class="col-sm-12 col-form-label pb-0 mb-0 font-weight-bold"><?php echo(putSpaceBetweenWords("Donation_amount"));?></label><div class="col-12"><input type="decimal"  class="form-control form-control-sm" name="admin_donations_form_component_donation_amount"  id="23-o--link--o-Thrift-o--link--o-804-o--link--o-admin_donations_form_page-o--link--o-982-o--link--o-admin_donations_form_component-o--link--o-donation_amount"  idx="admin_donations_form_page-o--link--o-admin_donations_form_component-o--link--o-donation_amount" value="<?php echo $admin_donations_form_component_donation_amount;?>"  ><div class="col-12 ml-0 pl-0"><small class="help font-weight-bold text-danger ml-0"></small></div>
                           </div></div>
                      </div>
<div class="col-12 col-md-5 col-lg-5">

                    <div class="form-group"><label class="col-sm-12 col-form-label pb-0 mb-0 font-weight-bold"><?php echo(putSpaceBetweenWords("Payment_method"));?></label><div class="col-12"><input type="text"  class="form-control form-control-sm" name="admin_donations_form_component_payment_method"  id="23-o--link--o-Thrift-o--link--o-804-o--link--o-admin_donations_form_page-o--link--o-982-o--link--o-admin_donations_form_component-o--link--o-payment_method"  idx="admin_donations_form_page-o--link--o-admin_donations_form_component-o--link--o-payment_method" value="<?php echo $admin_donations_form_component_payment_method;?>"  ><div class="col-12 ml-0 pl-0"><small class="help font-weight-bold text-danger ml-0"></small></div>
                           </div></div>
                      </div>
<div class="col-12 col-md-4">

              <div class="form-group"><label class="col-sm-12 col-form-label pb-0 mb-0 font-weight-bold"><?php echo(putSpaceBetweenWords("IsActive"));?></label><div class="col-12">
              <div class="form-check"><label class="form-check-label">
              <input  type="checkbox" class="form-controlx form-control-smx form-check-input" name="admin_donations_form_component_isActive"  id="23-o--link--o-Thrift-o--link--o-804-o--link--o-admin_donations_form_page-o--link--o-982-o--link--o-admin_donations_form_component-o--link--o-isActive"  idx="admin_donations_form_page-o--link--o-admin_donations_form_component-o--link--o-isActive" value="1"                       
              <?php if ($admin_donations_form_component_isActive==1) {?>
                   checked 
                <?php }?>

              ><i class="input-helper"></i></label></div><div class="col-12 ml-0 pl-0"><small class="help font-weight-bold text-danger ml-0"></small></div>
                           </div></div>
              </div>
</div></div><!--div class ="row"-->   
        <!--Section End-->                          
        <div class="col-12 mt-2">
          <div class="col-sm-12 text-center">  <a class="btn btn-sm btn-dark" href="admin_donations_list_page.php?searchTerm=<?php echo ($searchTerm);?>" id="admin_donations_form_component_closebutton"   >Close</a>
<!--p class="card-title">Donations</p-->
<?php /*if (strpos($_SESSION[APP_SESSION_NAME]["privileges"], Privilege_AddUsers_Enabled) !== FALSE) {*/ ?>

<a class="btn btn-sm btn-primary btn-lg text-white" href="admin_donations_form_page.php?admin_donations_form_component_id=-1&admin_donations_form_component_task=new&id=<?php echo $id;?>&id=<?php echo $task;?>&searchTerm=<?php echo $searchTerm;?>"  id="admin_donations_form_component_newbutton" >
Add New </a><!-- Donations</a-->
  <button type="submit" class="btn btn-sm btn-primary mr-2" name="admin_donations_form_component_doSubmit" value="admin_donations_form_component"  id="admin_donations_form_component_savebutton" >Save</button></div>
        </div>
      </div>

       
        
      </form>

    </div>
  </div>
</div><?php } ?><?php 
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