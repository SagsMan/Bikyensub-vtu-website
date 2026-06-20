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
    //header("location: campaigns_form_page.php");
    //exit();
  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Campaigns | <?php echo APP_TITLE;?></title>
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
//COMPONENT:campaigns_form_component
//TITLE:    Campaigns
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
$campaigns_form_component_datasource= array();
$campaigns_form_component_searchTerm__=array();
//$searchTerm__=array();

$campaigns_form_component_poster="";
$campaigns_form_component_donation_title="";
$campaigns_form_component_video_url="";
$campaigns_form_component_category="";
$campaigns_form_component_donate_goal="";
$campaigns_form_component_current_amount_raised="";
$campaigns_form_component_location="";
$campaigns_form_component_about_the_donation="";
$campaigns_form_component_isActive="";

//initialize these component level variables with their page level equivalent
//and then get them again if they are posted/or getted at component level
//HANDLE FORM LEVEL VARS
$campaigns_form_component_errorMessage= "";
$campaigns_form_component_id = -1;
$campaigns_form_component_task= "";
$campaigns_form_component_submittedComponentTitle= "";
$campaigns_form_component_componentToShowName="";
$campaigns_form_component_userId = "";
$campaigns_form_component_ownerId ="";
if(isset($_SESSION[APP_SESSION_NAME]["id"])){
$campaigns_form_component_userId = $_SESSION[APP_SESSION_NAME]["id"];
}
if(isset($_SESSION[APP_SESSION_NAME]["id"])){
$campaigns_form_component_ownerId =$_SESSION[APP_SESSION_NAME]["ownerId"];
}
$campaigns_form_component_searchTerm="";
$campaigns_form_component_multipartComponentToDisplayName="";//this is needed to determine which multipart active component to display

//ini with page level values if enabled$campaigns_form_component_errorMessage= $errorMessage;
$campaigns_form_component_id = $id;
$campaigns_form_component_task= $task;
$campaigns_form_component_submittedComponentTitle= $submittedComponentTitle;
$campaigns_form_component_searchTerm= $searchTerm;

 ?>
<?php 
/**************************************************************/
//VERSION:  
//PARTIAL:  Form Based Component Header
/**************************************************************/
?>
<?php 
  //the component might expect the following GET OR POST vars
  if (validatePOSTS(array("campaigns_form_component_multipartComponentToDisplayName")) === true) 
  {

    $campaigns_form_component_multipartComponentToDisplayName = sanitizeString_($_POST["campaigns_form_component_multipartComponentToDisplayName"]);

  }elseif (validateGETS(array("campaigns_form_component_multipartComponentToDisplayName")) === true) 
  {

    $campaigns_form_component_multipartComponentToDisplayName = sanitizeString_($_GET["campaigns_form_component_multipartComponentToDisplayName"]);

  }elseif(
    (!isset($campaigns_form_component_multipartComponentToDisplayName) || empty($campaigns_form_component_multipartComponentToDisplayName) ) && 
    -1000===0
   ){

      $campaigns_form_component_multipartComponentToDisplayName="campaigns_form_component";
   }
?>


<?php 
if(
    (0===0) || 
    ((0===1 && "campaigns_form_component"===strtolower($campaigns_form_component_multipartComponentToDisplayName)
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
  isset($_POST["campaigns_form_component_doSubmit"])) ) 
  ){

      if (isset($_POST["campaigns_form_component_id"])){$campaigns_form_component_id=sanitizeString_($_POST["campaigns_form_component_id"]);}

      if (isset($_POST["campaigns_form_component_task"])){$campaigns_form_component_task=sanitizeString_($_POST["campaigns_form_component_task"]);}

      if (isset($_POST["campaigns_form_component_doSubmit"])){$campaigns_form_component_submittedComponentTitle=sanitizeString_($_POST["campaigns_form_component_doSubmit"]);}

      if (isset($_POST["campaigns_form_component_poster"])) 
      { 
        $campaigns_form_component_poster= $_POST["campaigns_form_component_poster"];

      }

      if (isset($_POST["campaigns_form_component_donation_title"])) 
      { 
        $campaigns_form_component_donation_title= $_POST["campaigns_form_component_donation_title"];

      }

      if (isset($_POST["campaigns_form_component_video_url"])) 
      { 
        $campaigns_form_component_video_url= $_POST["campaigns_form_component_video_url"];

      }

      if (isset($_POST["campaigns_form_component_category"])) 
      { 
        $campaigns_form_component_category= $_POST["campaigns_form_component_category"];

      }

      if (isset($_POST["campaigns_form_component_donate_goal"])) 
      { 
        $campaigns_form_component_donate_goal= $_POST["campaigns_form_component_donate_goal"];

      }

      if (isset($_POST["campaigns_form_component_current_amount_raised"])) 
      { 
        $campaigns_form_component_current_amount_raised= $_POST["campaigns_form_component_current_amount_raised"];

      }

      if (isset($_POST["campaigns_form_component_location"])) 
      { 
        $campaigns_form_component_location= $_POST["campaigns_form_component_location"];

      }

      if (isset($_POST["campaigns_form_component_about_the_donation"])) 
      { 
        $campaigns_form_component_about_the_donation= $_POST["campaigns_form_component_about_the_donation"];

      }

      if (isset($_POST["campaigns_form_component_isActive"])) 
      { 
        $campaigns_form_component_isActive= $_POST["campaigns_form_component_isActive"];

      }

      if (isset($_POST["campaigns_form_component_searchTerm"])){$campaigns_form_component_searchTerm=sanitizeString_($_POST["campaigns_form_component_searchTerm"]);}
?><?php 
}elseif (
    (((($_SERVER["REQUEST_METHOD"] === "GET") && isset($_GET)) ) ) 
    ){
      //$id = $_GET["id"];
      //$task = $_GET["task"];  

      if (isset($_GET["campaigns_form_component_id"])){$campaigns_form_component_id=sanitizeString_($_GET["campaigns_form_component_id"]);}

      if (isset($_GET["campaigns_form_component_task"])){$campaigns_form_component_task=sanitizeString_($_GET["campaigns_form_component_task"]);}

      if (isset($_GET["campaigns_form_component_doSubmit"])){$campaigns_form_component_submittedComponentTitle=sanitizeString_($_GET["campaigns_form_component_doSubmit"]);}

        if (isset($_GET["campaigns_form_component_searchTerm"])){$campaigns_form_component_searchTerm=sanitizeString_($_GET["campaigns_form_component_searchTerm"]);}
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
switch ($campaigns_form_component_task) {
  case "top-level-form":
    try 
    {
      $stmt = $pdo->prepare("SELECT * FROM `campaigns` WHERE `userId`=? AND `ownerId`=? ");
      $stmt->execute([$userId,$ownerId]);
      $data = $stmt->fetchAll();
      if ($data) {
        if(isset($data[0]["id"]))
        {
          $campaigns_form_component_id= $data[0]["id"];
        }
        $campaigns_form_component_poster= $data[0]["poster"];
$campaigns_form_component_donation_title= $data[0]["donation_title"];
$campaigns_form_component_video_url= $data[0]["video_url"];
$campaigns_form_component_category= $data[0]["category"];
$campaigns_form_component_donate_goal= $data[0]["donate_goal"];
$campaigns_form_component_current_amount_raised= $data[0]["current_amount_raised"];
$campaigns_form_component_location= $data[0]["location"];
$campaigns_form_component_about_the_donation= $data[0]["about_the_donation"];
$campaigns_form_component_isActive= $data[0]["isActive"];
            }
        } catch (\PDOException $e) {
            $errorMessage .= "<b>Database error loading campaigns</b><br>";
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    break;
  case "new":
    break;
  case "edit":
    /*This will never execute on POST for a component that was not posted. see `save`*/
    if($campaigns_form_component_id > 0){
        try {  $stmt = $pdo->prepare("SELECT * FROM `campaigns` WHERE `id`=?");
          $stmt->execute([$campaigns_form_component_id]);
          $data = $stmt->fetchAll();  if ($data) {if(empty($data[0]["poster"])){}else{$campaigns_form_component_poster= $data[0]["poster"];
}
if(empty($data[0]["donation_title"])){}else{$campaigns_form_component_donation_title= $data[0]["donation_title"];
}
if(empty($data[0]["video_url"])){}else{$campaigns_form_component_video_url= $data[0]["video_url"];
}
if(empty($data[0]["category"])){}else{$campaigns_form_component_category= $data[0]["category"];
}
if(empty($data[0]["donate_goal"])){}else{$campaigns_form_component_donate_goal= $data[0]["donate_goal"];
}
if(empty($data[0]["current_amount_raised"])){}else{$campaigns_form_component_current_amount_raised= $data[0]["current_amount_raised"];
}
if(empty($data[0]["location"])){}else{$campaigns_form_component_location= $data[0]["location"];
}
if(empty($data[0]["about_the_donation"])){}else{$campaigns_form_component_about_the_donation= $data[0]["about_the_donation"];
}
if(empty($data[0]["isActive"])){}else{$campaigns_form_component_isActive= $data[0]["isActive"];
}
            }
        } catch (\PDOException $e) {
            $errorMessage .= "<b>Database error loading campaigns</b><br>";
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
      }else{
        header("location: campaigns_form_page.php");
      }
    break;
  case "delete":
    try {
          $stmt = $pdo->prepare("DELETE FROM `campaigns` WHERE `id`=?");
          $stmt->execute([$campaigns_form_component_id]);
          header("location: campaigns_form_page.php");
          exit();
        } catch (\PDOException $e) {
            $errorMessage .= "<b>Database error deleting from campaigns</b><br>";
            //throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    break;
  case "save":
    /*Will only execute for a submitted component, and else for the other components$app->pages[$ipages]->components[$icomponent]->title*/
    
        if($campaigns_form_component_submittedComponentTitle==="campaigns_form_component")
        {
          if($campaigns_form_component_id < 1){
            /*if theres a file to upload then try uploading*/  
                /*handle doc*/
                $filePath = APP_UPLOADS.APP_DOCUMENTS;
                $fileDescription="No description";
                $fileType="";
                $fileName="";
                
                /*if file was submitted*/
                if (isset($_FILES["campaigns_form_component_poster"]) && !empty($_FILES["campaigns_form_component_poster"])  && !empty($_FILES["campaigns_form_component_poster"]["name"]) ){
                  
                  /*/if ($_FILES["varfile1"]["type"] == "image/jpeg" || $_FILES["varfile1"]["type"] == "image/bmp" || $_FILES["varfile1"]["type"] == "image/png") {*/
                  /*get extension*/
                  /*$fileType = $_FILES["poster"]["type"];*/$fileName = $_SESSION[APP_SESSION_NAME]["id"]."-poster-".$_FILES["campaigns_form_component_poster"]["name"];
                    $fileType = explode(".", $fileName);
                    if(count($fileType)>1){ 
                      //echo $fileType[count($fileType)-1];exit();
                      $fileType = $fileType[count($fileType)-1];
                    }
      
                    /*rename
                    $fileName = $_SESSION[APP_SESSION_NAME]["id"]."-o-".$campaigns_form_component_poster.".".$fileType;
                    echo $fileName;exit();*/
      
                    copy($_FILES["campaigns_form_component_poster"]["tmp_name"], $filePath."/".$fileName)
                    or die("Could not copy");

                    if (!empty($filePath)) {
                      $campaigns_form_component_poster=$fileName;/*$filePath.$fileName;*/

                          /*
                          if (isset($_POST["vartype1"])) { $type_= $_POST["vartype1"];}
                          if (isset($_POST["vardescription1"])) { $vardescription1= $_POST["vardescription1"];}
                          */                
                          /*
                          $stmt = $pdo->prepare("INSERT INTO `documents` (`applicationId`,`description`,`productGuid`,`docPath`,`ownerId`,`userId`) VALUES (?,?,?,?,?,?)");
                          $description = $vardescription1;
                          $stmt->execute([ $varfield1, $description, $type_, $docPath, $_SESSION[APP_SESSION_NAME]["ownerId"], $_SESSION[APP_SESSION_NAME]["id"] ] );
                          */
                          
                        }
                      /*}*/
                  
                }else{
                  /*use old filename*/
                  if (isset($_POST["poster-currentname"])) { $campaigns_form_component_poster= $_POST["campaigns_form_component_poster-currentname"];}
                }
          
                  /*end upload*/try 
              {
                $stmt = $pdo->prepare("INSERT INTO `campaigns` (`poster`,`donation_title`,`video_url`,`category`,`donate_goal`,`current_amount_raised`,`location`,`about_the_donation`,`isActive`, `updatedBy`, `userId`, `ownerId`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)"); $stmt->execute([$campaigns_form_component_poster,$campaigns_form_component_donation_title,$campaigns_form_component_video_url,$campaigns_form_component_category,$campaigns_form_component_donate_goal,$campaigns_form_component_current_amount_raised,$campaigns_form_component_location,$campaigns_form_component_about_the_donation,$campaigns_form_component_isActive,
                  $_SESSION[APP_SESSION_NAME]["fullname"]." (".$_SESSION[APP_SESSION_NAME]["id"].")",$_SESSION[APP_SESSION_NAME]["id"],$_SESSION[APP_SESSION_NAME]["ownerId"] ]);
              $campaigns_form_component_id = $pdo->lastInsertID();    
            } catch (\PDOException $e) {
              $errorMessage .= "<b>Error adding to campaigns</b><br>";
              throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
          }elseif ($campaigns_form_component_id > 0 ) 
          {try 
            {
              /*if theres a file to upload then try uploading*/  
                /*handle doc*/
                $filePath = APP_UPLOADS.APP_DOCUMENTS;
                  $fileDescription="No description";
                  $fileType="";
                  $fileName="";
                  
                  //if new file submitted
                  if (isset($_FILES["campaigns_form_component_poster"]) && !empty($_FILES["campaigns_form_component_poster"])  && !empty($_FILES["campaigns_form_component_poster"]["name"]) )
                  {
                    
                    /*/if ($_FILES["varfile1"]["type"] == "image/jpeg" || $_FILES["varfile1"]["type"] == "image/bmp" || $_FILES["varfile1"]["type"] == "image/png") {*/ 
                    /*get extension*/
                    /*$fileType = $_FILES["poster"]["type"];*/$fileName = $_SESSION[APP_SESSION_NAME]["id"]."-poster-".$_FILES["campaigns_form_component_poster"]["name"];
                    $fileType = explode(".", $fileName);
                    if(count($fileType)>1){ 
                      //echo $fileType[count($fileType)-1];exit();
                      $fileType = $fileType[count($fileType)-1];
                    }
          
                    /*rename
                    $fileName = $_SESSION[APP_SESSION_NAME]["id"]."-o-".$campaigns_form_component_poster.".".$fileType;
                    echo $fileName;exit();*/
      
                    copy($_FILES["campaigns_form_component_poster"]["tmp_name"], $filePath."/".$fileName)
                    or die("Could not copy");

                    if (!empty($filePath)) 
                    {
                      $campaigns_form_component_poster=$fileName;/*$filePath.$fileName;*/

                      /*
                      if (isset($_POST["vartype1"])) { $type_= $_POST["vartype1"];}
                      if (isset($_POST["vardescription1"])) { $vardescription1= $_POST["vardescription1"];}
                      */                
                      /*
                      $stmt = $pdo->prepare("INSERT INTO `documents` (`applicationId`,`description`,`productGuid`,`docPath`,`ownerId`,`userId`) VALUES (?,?,?,?,?,?)");
                      $description = $vardescription1;
                      $stmt->execute([ $varfield1, $description, $type_, $docPath, $_SESSION[APP_SESSION_NAME]["ownerId"], $_SESSION[APP_SESSION_NAME]["id"] ] );
                      */  
                    }
                    /*}*/

                  }else{
                    //use old filename
                    if (isset($_POST["campaigns_form_component_poster-currentname"])) { $campaigns_form_component_poster= $_POST["campaigns_form_component_poster-currentname"];}
                  }
          
                  /*end upload*/ $stmt = $pdo->prepare("UPDATE `campaigns` SET `poster`=?,`donation_title`=?,`video_url`=?,`category`=?,`donate_goal`=?,`current_amount_raised`=?,`location`=?,`about_the_donation`=?,`isActive`=?, `updatedBy`=?,`updatedOn`=? WHERE `id`=?"); $stmt->execute([$campaigns_form_component_poster,$campaigns_form_component_donation_title,$campaigns_form_component_video_url,$campaigns_form_component_category,$campaigns_form_component_donate_goal,$campaigns_form_component_current_amount_raised,$campaigns_form_component_location,$campaigns_form_component_about_the_donation,$campaigns_form_component_isActive,   $_SESSION[APP_SESSION_NAME]["fullname"]." (".$_SESSION[APP_SESSION_NAME]["id"].")", getDate_() ,$campaigns_form_component_id]);                    
            } catch (\PDOException $e) {
                      $errorMessage .= "<b>Error updating campaigns</b><br>";
                      throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }/*end try*/
          }else{
            header("location: campaigns_form_page.php");
          }
        }else{
          /*same as for edit this will only execute for a component that wasnt submitted on POST*/
          if($campaigns_form_component_id > 0){
            try {
                      $stmt = $pdo->prepare("SELECT * FROM `campaigns` WHERE `id`=?");
                      $stmt->execute([$campaigns_form_component_id]);
                      $data = $stmt->fetchAll();
                    if ($data) {if(empty($data[0]["poster"])){}else{$campaigns_form_component_poster= $data[0]["poster"];
}
if(empty($data[0]["donation_title"])){}else{$campaigns_form_component_donation_title= $data[0]["donation_title"];
}
if(empty($data[0]["video_url"])){}else{$campaigns_form_component_video_url= $data[0]["video_url"];
}
if(empty($data[0]["category"])){}else{$campaigns_form_component_category= $data[0]["category"];
}
if(empty($data[0]["donate_goal"])){}else{$campaigns_form_component_donate_goal= $data[0]["donate_goal"];
}
if(empty($data[0]["current_amount_raised"])){}else{$campaigns_form_component_current_amount_raised= $data[0]["current_amount_raised"];
}
if(empty($data[0]["location"])){}else{$campaigns_form_component_location= $data[0]["location"];
}
if(empty($data[0]["about_the_donation"])){}else{$campaigns_form_component_about_the_donation= $data[0]["about_the_donation"];
}
if(empty($data[0]["isActive"])){}else{$campaigns_form_component_isActive= $data[0]["isActive"];
}
    
                    }} catch (\PDOException $e) {
                        $errorMessage .= "<b>Database error loading campaigns</b><br>";
                        throw new \PDOException($e->getMessage(), (int)$e->getCode());
                    }
          }else{
            //header("location: campaigns_form_page.php");
          }
        //////
        }   break;
            
            default:
              //header("location: campaigns_form_page.php");
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
      <!--p class="card-title mb-2">Campaigns</p-->  <p class="card-description">Manage Campaigns</p></div><div class="row pull-rightx mt-2">
  <div class="col-12 ml-auto animate__animated  animate__slideInLeft  animate__delay-1s ">
  <h1 class="display-5 font-weight-bold">
  <?php /*echo count($campaigns);*/ ?>
   <?php echo "Campaigns";?></h1>
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
<form  class="23-o--link--o-792-o--link--o-campaigns_form_page.php-o--link--o-972-o--link--o-campaigns_form_component-o--link--o-form"  id= "23-o--link--o-Thrift-o--link--o-792-o--link--o-campaigns_form_page-o--link--o-972-o--link--o-campaigns_form_component-o--link--o-form" method="POST" action=""  enctype="multipart/form-data">
              <!--p class="card-description">
                Add/Edit
              </p-->

              <input type="hidden" name="task" value="save" id="task" />
              <input type="hidden" name="id" value="<?php echo $id;?>" id="id">
              <input type="hidden" name="searchTerm" value="<?php echo $searchTerm;?>" id="searchTerm">

              
              <input type="hidden" name="campaigns_form_component_task" value="save" id="23-o--link--o-Thrift-o--link--o-792-o--link--o-campaigns_form_page-o--link--o-972-o--link--o-campaigns_form_component-o--link--o-task" />
              <input type="hidden" name="campaigns_form_component_id" value="<?php echo $campaigns_form_component_id;?>" id="23-o--link--o-Thrift-o--link--o-792-o--link--o-campaigns_form_page-o--link--o-972-o--link--o-campaigns_form_component-o--link--o-id" >
              <input type="hidden" name="campaigns_form_component_searchTerm" value="<?php echo $campaigns_form_component_searchTerm;?>" id="23-o--link--o-Thrift-o--link--o-792-o--link--o-campaigns_form_page-o--link--o-972-o--link--o-campaigns_form_component-o--link--o-searchTerm" >
              
              
              <div class="rowx"><div class=" p-1 mb-2"><div class ="row"><div class="col-12 mb-0 pb-0"><p class="mb-0 pb-0 pl-2 font-weight-bold"></p></div><div class="col-12 col-md-4">

                    <div class="form-group"><label class="col-sm-12 col-form-label pb-0 mb-0 font-weight-bold"><?php echo(putSpaceBetweenWords("Poster"));?></label><div class="col-12"><input type="file"  class="form-control form-control-sm" name="campaigns_form_component_poster"  id="23-o--link--o-Thrift-o--link--o-792-o--link--o-campaigns_form_page-o--link--o-972-o--link--o-campaigns_form_component-o--link--o-poster"  idx="campaigns_form_page-o--link--o-campaigns_form_component-o--link--o-poster" value="<?php echo $campaigns_form_component_poster;?>"  ><small class="font-weight-bold"><a target="_blank" href="<?php echo APP_UPLOADS.APP_DOCUMENTS;?><?php echo $campaigns_form_component_poster;?>"><?php echo $campaigns_form_component_poster;?>
                      <!-- show file works only for images -->
                      <div class="mt-1">
                      <img alt="" width="55" src="<?php echo APP_UPLOADS.APP_DOCUMENTS;?><?php echo $campaigns_form_component_poster;?>" />
                      </div>
                      <!-- show file end --></a></small>
                      <input type="hidden" name="campaigns_form_component_poster-currentname" id="poster-currentname" value="<?php echo $campaigns_form_component_poster;?>" ><div class="col-12 ml-0 pl-0"><small class="help font-weight-bold text-danger ml-0"></small></div>
                           </div></div>
                      </div>
<div class="col-12 col-md-12 col-lg-12">

                    <div class="form-group"><label class="col-sm-12 col-form-label pb-0 mb-0 font-weight-bold"><?php echo(putSpaceBetweenWords("Donation_title"));?></label><div class="col-12"><input type="text"  class="form-control form-control-sm" name="campaigns_form_component_donation_title"  id="23-o--link--o-Thrift-o--link--o-792-o--link--o-campaigns_form_page-o--link--o-972-o--link--o-campaigns_form_component-o--link--o-donation_title"  idx="campaigns_form_page-o--link--o-campaigns_form_component-o--link--o-donation_title" value="<?php echo $campaigns_form_component_donation_title;?>"  ><div class="col-12 ml-0 pl-0"><small class="help font-weight-bold text-danger ml-0"></small></div>
                           </div></div>
                      </div>
<div class="col-12 col-md-12 col-lg-12">

                    <div class="form-group"><label class="col-sm-12 col-form-label pb-0 mb-0 font-weight-bold"><?php echo(putSpaceBetweenWords("Video_url"));?></label><div class="col-12"><input type="text"  class="form-control form-control-sm" name="campaigns_form_component_video_url"  id="23-o--link--o-Thrift-o--link--o-792-o--link--o-campaigns_form_page-o--link--o-972-o--link--o-campaigns_form_component-o--link--o-video_url"  idx="campaigns_form_page-o--link--o-campaigns_form_component-o--link--o-video_url" value="<?php echo $campaigns_form_component_video_url;?>"  ><div class="col-12 ml-0 pl-0"><small class="help font-weight-bold text-danger ml-0"></small></div>
                           </div></div>
                      </div>
<div class="col-12 col-md-3 col-lg-3">

                    <div class="form-group"><label class="col-sm-12 col-form-label pb-0 mb-0 font-weight-bold"><?php echo(putSpaceBetweenWords("Category"));?></label><div class="col-12"><input type="text"  class="form-control form-control-sm" name="campaigns_form_component_category"  id="23-o--link--o-Thrift-o--link--o-792-o--link--o-campaigns_form_page-o--link--o-972-o--link--o-campaigns_form_component-o--link--o-category"  idx="campaigns_form_page-o--link--o-campaigns_form_component-o--link--o-category" value="<?php echo $campaigns_form_component_category;?>"  ><div class="col-12 ml-0 pl-0"><small class="help font-weight-bold text-danger ml-0"></small></div>
                           </div></div>
                      </div>
<div class="col-12 col-md-4">

                    <div class="form-group"><label class="col-sm-12 col-form-label pb-0 mb-0 font-weight-bold"><?php echo(putSpaceBetweenWords("Donate_goal"));?></label><div class="col-12"><input type="decimal"  class="form-control form-control-sm" name="campaigns_form_component_donate_goal"  id="23-o--link--o-Thrift-o--link--o-792-o--link--o-campaigns_form_page-o--link--o-972-o--link--o-campaigns_form_component-o--link--o-donate_goal"  idx="campaigns_form_page-o--link--o-campaigns_form_component-o--link--o-donate_goal" value="<?php echo $campaigns_form_component_donate_goal;?>"  ><div class="col-12 ml-0 pl-0"><small class="help font-weight-bold text-danger ml-0"></small></div>
                           </div></div>
                      </div>
<div class="col-12 col-md-4">

                    <div class="form-group"><label class="col-sm-12 col-form-label pb-0 mb-0 font-weight-bold"><?php echo(putSpaceBetweenWords("Current_amount_raised"));?></label><div class="col-12"><input type="decimal"  class="form-control form-control-sm" name="campaigns_form_component_current_amount_raised"  id="23-o--link--o-Thrift-o--link--o-792-o--link--o-campaigns_form_page-o--link--o-972-o--link--o-campaigns_form_component-o--link--o-current_amount_raised"  idx="campaigns_form_page-o--link--o-campaigns_form_component-o--link--o-current_amount_raised" value="<?php echo $campaigns_form_component_current_amount_raised;?>"  ><div class="col-12 ml-0 pl-0"><small class="help font-weight-bold text-danger ml-0"></small></div>
                           </div></div>
                      </div>
<div class="col-12 col-md-12 col-lg-12">

                    <div class="form-group"><label class="col-sm-12 col-form-label pb-0 mb-0 font-weight-bold"><?php echo(putSpaceBetweenWords("Location"));?></label><div class="col-12"><input type="text"  class="form-control form-control-sm" name="campaigns_form_component_location"  id="23-o--link--o-Thrift-o--link--o-792-o--link--o-campaigns_form_page-o--link--o-972-o--link--o-campaigns_form_component-o--link--o-location"  idx="campaigns_form_page-o--link--o-campaigns_form_component-o--link--o-location" value="<?php echo $campaigns_form_component_location;?>"  ><div class="col-12 ml-0 pl-0"><small class="help font-weight-bold text-danger ml-0"></small></div>
                           </div></div>
                      </div>
<div class="col-12 col-md-4">

                    <div class="form-group"><label class="col-sm-12 col-form-label pb-0 mb-0 font-weight-bold"><?php echo(putSpaceBetweenWords("About_the_donation"));?></label><div class="col-12"><textarea  class="form-control form-control-sm" name="campaigns_form_component_about_the_donation"  id="23-o--link--o-Thrift-o--link--o-792-o--link--o-campaigns_form_page-o--link--o-972-o--link--o-campaigns_form_component-o--link--o-about_the_donation"  idx="campaigns_form_page-o--link--o-campaigns_form_component-o--link--o-about_the_donation"  ><?php echo $campaigns_form_component_about_the_donation;?></textarea><div class="col-12 ml-0 pl-0"><small class="help font-weight-bold text-danger ml-0"></small></div>
                           </div></div>
                      </div>
<div class="col-12 col-md-4">

              <div class="form-group"><label class="col-sm-12 col-form-label pb-0 mb-0 font-weight-bold"><?php echo(putSpaceBetweenWords("IsActive"));?></label><div class="col-12">
              <div class="form-check"><label class="form-check-label">
              <input  type="checkbox" class="form-controlx form-control-smx form-check-input" name="campaigns_form_component_isActive"  id="23-o--link--o-Thrift-o--link--o-792-o--link--o-campaigns_form_page-o--link--o-972-o--link--o-campaigns_form_component-o--link--o-isActive"  idx="campaigns_form_page-o--link--o-campaigns_form_component-o--link--o-isActive" value="1"                       
              <?php if ($campaigns_form_component_isActive==1) {?>
                   checked 
                <?php }?>

              ><i class="input-helper"></i></label></div><div class="col-12 ml-0 pl-0"><small class="help font-weight-bold text-danger ml-0"></small></div>
                           </div></div>
              </div>
</div></div><!--div class ="row"-->   
        <!--Section End-->                          
        <div class="col-12 mt-2">
          <div class="col-sm-12 text-center">  <a class="btn btn-sm btn-dark" href="campaigns_list_page.php?searchTerm=<?php echo ($searchTerm);?>" id="campaigns_form_component_closebutton"   >Close</a>
<!--p class="card-title">Campaigns</p-->
<?php /*if (strpos($_SESSION[APP_SESSION_NAME]["privileges"], Privilege_AddUsers_Enabled) !== FALSE) {*/ ?>

<a class="btn btn-sm btn-primary btn-lg text-white" href="campaigns_form_page.php?campaigns_form_component_id=-1&campaigns_form_component_task=new&id=<?php echo $id;?>&id=<?php echo $task;?>&searchTerm=<?php echo $searchTerm;?>"  id="campaigns_form_component_newbutton" >
Add New </a><!-- Campaigns</a-->
  <button type="submit" class="btn btn-sm btn-primary mr-2" name="campaigns_form_component_doSubmit" value="campaigns_form_component"  id="campaigns_form_component_savebutton" >Save</button></div>
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