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
    //header("location: users_form_page.php");
    //exit();
  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Users | <?php echo APP_TITLE;?></title>
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
//COMPONENT:users_form_component
//TITLE:    Users
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
$users_form_component_datasource= array();
$users_form_component_searchTerm__=array();
//$searchTerm__=array();

$users_form_component_fullname="";
$users_form_component_emailAddress="";
$users_form_component_phoneNo="";
$users_form_component_address="";
$users_form_component_isActive="";

//initialize these component level variables with their page level equivalent
//and then get them again if they are posted/or getted at component level
//HANDLE FORM LEVEL VARS
$users_form_component_errorMessage= "";
$users_form_component_id = -1;
$users_form_component_task= "";
$users_form_component_submittedComponentTitle= "";
$users_form_component_componentToShowName="";
$users_form_component_userId = "";
$users_form_component_ownerId ="";
if(isset($_SESSION[APP_SESSION_NAME]["id"])){
$users_form_component_userId = $_SESSION[APP_SESSION_NAME]["id"];
}
if(isset($_SESSION[APP_SESSION_NAME]["id"])){
$users_form_component_ownerId =$_SESSION[APP_SESSION_NAME]["ownerId"];
}
$users_form_component_searchTerm="";
$users_form_component_multipartComponentToDisplayName="";//this is needed to determine which multipart active component to display

//ini with page level values if enabled$users_form_component_errorMessage= $errorMessage;
$users_form_component_id = $id;
$users_form_component_task= $task;
$users_form_component_submittedComponentTitle= $submittedComponentTitle;
$users_form_component_searchTerm= $searchTerm;

 ?>
<?php 
/**************************************************************/
//VERSION:  
//PARTIAL:  Form Based Component Header
/**************************************************************/
?>
<?php 
  //the component might expect the following GET OR POST vars
  if (validatePOSTS(array("users_form_component_multipartComponentToDisplayName")) === true) 
  {

    $users_form_component_multipartComponentToDisplayName = sanitizeString_($_POST["users_form_component_multipartComponentToDisplayName"]);

  }elseif (validateGETS(array("users_form_component_multipartComponentToDisplayName")) === true) 
  {

    $users_form_component_multipartComponentToDisplayName = sanitizeString_($_GET["users_form_component_multipartComponentToDisplayName"]);

  }elseif(
    (!isset($users_form_component_multipartComponentToDisplayName) || empty($users_form_component_multipartComponentToDisplayName) ) && 
    -1000===0
   ){

      $users_form_component_multipartComponentToDisplayName="users_form_component";
   }
?>


<?php 
if(
    (0===0) || 
    ((0===1 && "users_form_component"===strtolower($users_form_component_multipartComponentToDisplayName)
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
  isset($_POST["users_form_component_doSubmit"])) ) 
  ){

      if (isset($_POST["users_form_component_id"])){$users_form_component_id=sanitizeString_($_POST["users_form_component_id"]);}

      if (isset($_POST["users_form_component_task"])){$users_form_component_task=sanitizeString_($_POST["users_form_component_task"]);}

      if (isset($_POST["users_form_component_doSubmit"])){$users_form_component_submittedComponentTitle=sanitizeString_($_POST["users_form_component_doSubmit"]);}

      if (isset($_POST["users_form_component_fullname"])) 
      { 
        $users_form_component_fullname= $_POST["users_form_component_fullname"];

      }

      if (isset($_POST["users_form_component_emailAddress"])) 
      { 
        $users_form_component_emailAddress= $_POST["users_form_component_emailAddress"];

      }

      if (isset($_POST["users_form_component_phoneNo"])) 
      { 
        $users_form_component_phoneNo= $_POST["users_form_component_phoneNo"];

      }

      if (isset($_POST["users_form_component_address"])) 
      { 
        $users_form_component_address= $_POST["users_form_component_address"];

      }

      if (isset($_POST["users_form_component_isActive"])) 
      { 
        $users_form_component_isActive= $_POST["users_form_component_isActive"];

      }

      if (isset($_POST["users_form_component_searchTerm"])){$users_form_component_searchTerm=sanitizeString_($_POST["users_form_component_searchTerm"]);}
?><?php 
}elseif (
    (((($_SERVER["REQUEST_METHOD"] === "GET") && isset($_GET)) ) ) 
    ){
      //$id = $_GET["id"];
      //$task = $_GET["task"];  

      if (isset($_GET["users_form_component_id"])){$users_form_component_id=sanitizeString_($_GET["users_form_component_id"]);}

      if (isset($_GET["users_form_component_task"])){$users_form_component_task=sanitizeString_($_GET["users_form_component_task"]);}

      if (isset($_GET["users_form_component_doSubmit"])){$users_form_component_submittedComponentTitle=sanitizeString_($_GET["users_form_component_doSubmit"]);}

        if (isset($_GET["users_form_component_searchTerm"])){$users_form_component_searchTerm=sanitizeString_($_GET["users_form_component_searchTerm"]);}
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
switch ($users_form_component_task) {
  case "top-level-form":
    try 
    {
      $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `userId`=? AND `ownerId`=? ");
      $stmt->execute([$userId,$ownerId]);
      $data = $stmt->fetchAll();
      if ($data) {
        if(isset($data[0]["id"]))
        {
          $users_form_component_id= $data[0]["id"];
        }
        $users_form_component_fullname= $data[0]["fullname"];
$users_form_component_emailAddress= $data[0]["emailAddress"];
$users_form_component_phoneNo= $data[0]["phoneNo"];
$users_form_component_address= $data[0]["address"];
$users_form_component_isActive= $data[0]["isActive"];
            }
        } catch (\PDOException $e) {
            $errorMessage .= "<b>Database error loading users</b><br>";
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    break;
  case "new":
    break;
  case "edit":
    /*This will never execute on POST for a component that was not posted. see `save`*/
    if($users_form_component_id > 0){
        try {  $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `id`=?");
          $stmt->execute([$users_form_component_id]);
          $data = $stmt->fetchAll();  if ($data) {if(empty($data[0]["fullname"])){}else{$users_form_component_fullname= $data[0]["fullname"];
}
if(empty($data[0]["emailAddress"])){}else{$users_form_component_emailAddress= $data[0]["emailAddress"];
}
if(empty($data[0]["phoneNo"])){}else{$users_form_component_phoneNo= $data[0]["phoneNo"];
}
if(empty($data[0]["address"])){}else{$users_form_component_address= $data[0]["address"];
}
if(empty($data[0]["isActive"])){}else{$users_form_component_isActive= $data[0]["isActive"];
}
            }
        } catch (\PDOException $e) {
            $errorMessage .= "<b>Database error loading users</b><br>";
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
      }else{
        header("location: users_form_page.php");
      }
    break;
  case "delete":
    try {
          $stmt = $pdo->prepare("DELETE FROM `users` WHERE `id`=?");
          $stmt->execute([$users_form_component_id]);
          header("location: users_form_page.php");
          exit();
        } catch (\PDOException $e) {
            $errorMessage .= "<b>Database error deleting from users</b><br>";
            //throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    break;
  case "save":
    /*Will only execute for a submitted component, and else for the other components$app->pages[$ipages]->components[$icomponent]->title*/
    
        if($users_form_component_submittedComponentTitle==="users_form_component")
        {
          if($users_form_component_id < 1){
            /*if theres a file to upload then try uploading*/try 
              {
                $stmt = $pdo->prepare("INSERT INTO `users` (`fullname`,`emailAddress`,`phoneNo`,`address`,`isActive`, `updatedBy`, `userId`, `ownerId`) VALUES (?,?,?,?,?,?,?,?)"); $stmt->execute([$users_form_component_fullname,$users_form_component_emailAddress,$users_form_component_phoneNo,$users_form_component_address,$users_form_component_isActive,
                  $_SESSION[APP_SESSION_NAME]["fullname"]." (".$_SESSION[APP_SESSION_NAME]["id"].")",$_SESSION[APP_SESSION_NAME]["id"],$_SESSION[APP_SESSION_NAME]["ownerId"] ]);
              $users_form_component_id = $pdo->lastInsertID();    
            } catch (\PDOException $e) {
              $errorMessage .= "<b>Error adding to users</b><br>";
              throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
          }elseif ($users_form_component_id > 0 ) 
          {try 
            {
              /*if theres a file to upload then try uploading*/ $stmt = $pdo->prepare("UPDATE `users` SET `fullname`=?,`emailAddress`=?,`phoneNo`=?,`address`=?,`isActive`=?, `updatedBy`=?,`updatedOn`=? WHERE `id`=?"); $stmt->execute([$users_form_component_fullname,$users_form_component_emailAddress,$users_form_component_phoneNo,$users_form_component_address,$users_form_component_isActive,   $_SESSION[APP_SESSION_NAME]["fullname"]." (".$_SESSION[APP_SESSION_NAME]["id"].")", getDate_() ,$users_form_component_id]);                    
            } catch (\PDOException $e) {
                      $errorMessage .= "<b>Error updating users</b><br>";
                      throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }/*end try*/
          }else{
            header("location: users_form_page.php");
          }
        }else{
          /*same as for edit this will only execute for a component that wasnt submitted on POST*/
          if($users_form_component_id > 0){
            try {
                      $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `id`=?");
                      $stmt->execute([$users_form_component_id]);
                      $data = $stmt->fetchAll();
                    if ($data) {if(empty($data[0]["fullname"])){}else{$users_form_component_fullname= $data[0]["fullname"];
}
if(empty($data[0]["emailAddress"])){}else{$users_form_component_emailAddress= $data[0]["emailAddress"];
}
if(empty($data[0]["phoneNo"])){}else{$users_form_component_phoneNo= $data[0]["phoneNo"];
}
if(empty($data[0]["address"])){}else{$users_form_component_address= $data[0]["address"];
}
if(empty($data[0]["isActive"])){}else{$users_form_component_isActive= $data[0]["isActive"];
}
    
                    }} catch (\PDOException $e) {
                        $errorMessage .= "<b>Database error loading users</b><br>";
                        throw new \PDOException($e->getMessage(), (int)$e->getCode());
                    }
          }else{
            //header("location: users_form_page.php");
          }
        //////
        }   break;
            
            default:
              //header("location: users_form_page.php");
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
      <!--p class="card-title mb-2">Users</p-->  <p class="card-description">Manage Users</p></div><div class="row pull-rightx mt-2">
  <div class="col-12 ml-auto animate__animated  animate__slideInLeft  animate__delay-1s ">
  <h1 class="display-5 font-weight-bold">
  <?php /*echo count($users);*/ ?>
   <?php echo "Users";?></h1>
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
<form  class="23-o--link--o-790-o--link--o-users_form_page.php-o--link--o-970-o--link--o-users_form_component-o--link--o-form"  id= "23-o--link--o-Thrift-o--link--o-790-o--link--o-users_form_page-o--link--o-970-o--link--o-users_form_component-o--link--o-form" method="POST" action=""  enctype="multipart/form-data">
              <!--p class="card-description">
                Add/Edit
              </p-->

              <input type="hidden" name="task" value="save" id="task" />
              <input type="hidden" name="id" value="<?php echo $id;?>" id="id">
              <input type="hidden" name="searchTerm" value="<?php echo $searchTerm;?>" id="searchTerm">

              
              <input type="hidden" name="users_form_component_task" value="save" id="23-o--link--o-Thrift-o--link--o-790-o--link--o-users_form_page-o--link--o-970-o--link--o-users_form_component-o--link--o-task" />
              <input type="hidden" name="users_form_component_id" value="<?php echo $users_form_component_id;?>" id="23-o--link--o-Thrift-o--link--o-790-o--link--o-users_form_page-o--link--o-970-o--link--o-users_form_component-o--link--o-id" >
              <input type="hidden" name="users_form_component_searchTerm" value="<?php echo $users_form_component_searchTerm;?>" id="23-o--link--o-Thrift-o--link--o-790-o--link--o-users_form_page-o--link--o-970-o--link--o-users_form_component-o--link--o-searchTerm" >
              
              
              <div class="rowx"><div class=" p-1 mb-2"><div class ="row"><div class="col-12 mb-0 pb-0"><p class="mb-0 pb-0 pl-2 font-weight-bold"></p></div><div class="col-12 col-md-4 col-lg-4">

                    <div class="form-group"><label class="col-sm-12 col-form-label pb-0 mb-0 font-weight-bold"><?php echo(putSpaceBetweenWords("Fullname"));?></label><div class="col-12"><input type="text"  class="form-control form-control-sm" name="users_form_component_fullname"  id="23-o--link--o-Thrift-o--link--o-790-o--link--o-users_form_page-o--link--o-970-o--link--o-users_form_component-o--link--o-fullname"  idx="users_form_page-o--link--o-users_form_component-o--link--o-fullname" value="<?php echo $users_form_component_fullname;?>"  ><div class="col-12 ml-0 pl-0"><small class="help font-weight-bold text-danger ml-0"></small></div>
                           </div></div>
                      </div>
<div class="col-12 col-md-12 col-lg-12">

                    <div class="form-group"><label class="col-sm-12 col-form-label pb-0 mb-0 font-weight-bold"><?php echo(putSpaceBetweenWords("EmailAddress"));?></label><div class="col-12"><input type="text"  class="form-control form-control-sm" name="users_form_component_emailAddress"  id="23-o--link--o-Thrift-o--link--o-790-o--link--o-users_form_page-o--link--o-970-o--link--o-users_form_component-o--link--o-emailAddress"  idx="users_form_page-o--link--o-users_form_component-o--link--o-emailAddress" value="<?php echo $users_form_component_emailAddress;?>"  ><div class="col-12 ml-0 pl-0"><small class="help font-weight-bold text-danger ml-0"></small></div>
                           </div></div>
                      </div>
<div class="col-12 col-md-5 col-lg-5">

                    <div class="form-group"><label class="col-sm-12 col-form-label pb-0 mb-0 font-weight-bold"><?php echo(putSpaceBetweenWords("PhoneNo"));?></label><div class="col-12"><input type="text"  class="form-control form-control-sm" name="users_form_component_phoneNo"  id="23-o--link--o-Thrift-o--link--o-790-o--link--o-users_form_page-o--link--o-970-o--link--o-users_form_component-o--link--o-phoneNo"  idx="users_form_page-o--link--o-users_form_component-o--link--o-phoneNo" value="<?php echo $users_form_component_phoneNo;?>"  ><div class="col-12 ml-0 pl-0"><small class="help font-weight-bold text-danger ml-0"></small></div>
                           </div></div>
                      </div>
<div class="col-12 col-md-12 col-lg-12">

                    <div class="form-group"><label class="col-sm-12 col-form-label pb-0 mb-0 font-weight-bold"><?php echo(putSpaceBetweenWords("Address"));?></label><div class="col-12"><input type="text"  class="form-control form-control-sm" name="users_form_component_address"  id="23-o--link--o-Thrift-o--link--o-790-o--link--o-users_form_page-o--link--o-970-o--link--o-users_form_component-o--link--o-address"  idx="users_form_page-o--link--o-users_form_component-o--link--o-address" value="<?php echo $users_form_component_address;?>"  ><div class="col-12 ml-0 pl-0"><small class="help font-weight-bold text-danger ml-0"></small></div>
                           </div></div>
                      </div>
<div class="col-12 col-md-4">

              <div class="form-group"><label class="col-sm-12 col-form-label pb-0 mb-0 font-weight-bold"><?php echo(putSpaceBetweenWords("IsActive"));?></label><div class="col-12">
              <div class="form-check"><label class="form-check-label">
              <input  type="checkbox" class="form-controlx form-control-smx form-check-input" name="users_form_component_isActive"  id="23-o--link--o-Thrift-o--link--o-790-o--link--o-users_form_page-o--link--o-970-o--link--o-users_form_component-o--link--o-isActive"  idx="users_form_page-o--link--o-users_form_component-o--link--o-isActive" value="1"                       
              <?php if ($users_form_component_isActive==1) {?>
                   checked 
                <?php }?>

              ><i class="input-helper"></i></label></div><div class="col-12 ml-0 pl-0"><small class="help font-weight-bold text-danger ml-0"></small></div>
                           </div></div>
              </div>
</div></div><!--div class ="row"-->   
        <!--Section End-->                          
        <div class="col-12 mt-2">
          <div class="col-sm-12 text-center">  <a class="btn btn-sm btn-dark" href="users_list_page.php?searchTerm=<?php echo ($searchTerm);?>" id="users_form_component_closebutton"   >Close</a>
<!--p class="card-title">Users</p-->
<?php /*if (strpos($_SESSION[APP_SESSION_NAME]["privileges"], Privilege_AddUsers_Enabled) !== FALSE) {*/ ?>

<a class="btn btn-sm btn-primary btn-lg text-white" href="users_form_page.php?users_form_component_id=-1&users_form_component_task=new&id=<?php echo $id;?>&id=<?php echo $task;?>&searchTerm=<?php echo $searchTerm;?>"  id="users_form_component_newbutton" >
Add New </a><!-- Users</a-->
  <button type="submit" class="btn btn-sm btn-primary mr-2" name="users_form_component_doSubmit" value="users_form_component"  id="users_form_component_savebutton" >Save</button></div>
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