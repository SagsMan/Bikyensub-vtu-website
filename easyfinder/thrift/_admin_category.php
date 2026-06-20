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
    //header("location: categories_form_page.php");
    //exit();
  }
  ?>


<?php 
/**************************************************************/
//VERSION:  
//COMPONENT:categories_form_component
//TITLE:    Categories
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
$categories_form_component_datasource= array();
$categories_form_component_searchTerm__=array();
//$searchTerm__=array();

$categories_form_component_title="";
$categories_form_component_icon="";
$categories_form_component_isActive="";

//initialize these component level variables with their page level equivalent
//and then get them again if they are posted/or getted at component level
//HANDLE FORM LEVEL VARS
$categories_form_component_errorMessage= "";
$categories_form_component_id = -1;
$categories_form_component_task= "";
$categories_form_component_submittedComponentTitle= "";
$categories_form_component_componentToShowName="";
$categories_form_component_userId = "";
$categories_form_component_ownerId ="";
if(isset($_SESSION[APP_SESSION_NAME]["id"])){
$categories_form_component_userId = $_SESSION[APP_SESSION_NAME]["id"];
}
if(isset($_SESSION[APP_SESSION_NAME]["id"])){
$categories_form_component_ownerId =$_SESSION[APP_SESSION_NAME]["ownerId"];
}
$categories_form_component_searchTerm="";
$categories_form_component_multipartComponentToDisplayName="";//this is needed to determine which multipart active component to display

//ini with page level values if enabled$categories_form_component_errorMessage= $errorMessage;
$categories_form_component_id = $id;
$categories_form_component_task= $task;
$categories_form_component_submittedComponentTitle= $submittedComponentTitle;
$categories_form_component_searchTerm= $searchTerm;

 ?>
<?php 
/**************************************************************/
//VERSION:  
//PARTIAL:  Form Based Component Header
/**************************************************************/
?>
<?php 
  //the component might expect the following GET OR POST vars
  if (validatePOSTS(array("categories_form_component_multipartComponentToDisplayName")) === true) 
  {

    $categories_form_component_multipartComponentToDisplayName = sanitizeString_($_POST["categories_form_component_multipartComponentToDisplayName"]);

  }elseif (validateGETS(array("categories_form_component_multipartComponentToDisplayName")) === true) 
  {

    $categories_form_component_multipartComponentToDisplayName = sanitizeString_($_GET["categories_form_component_multipartComponentToDisplayName"]);

  }elseif(
    (!isset($categories_form_component_multipartComponentToDisplayName) || empty($categories_form_component_multipartComponentToDisplayName) ) && 
    -1000===0
   ){

      $categories_form_component_multipartComponentToDisplayName="categories_form_component";
   }
?>


<?php 
if(
    (0===0) || 
    ((0===1 && "categories_form_component"===strtolower($categories_form_component_multipartComponentToDisplayName)
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
  isset($_POST["categories_form_component_doSubmit"])) ) 
  ){

      if (isset($_POST["categories_form_component_id"])){$categories_form_component_id=sanitizeString_($_POST["categories_form_component_id"]);}

      if (isset($_POST["categories_form_component_task"])){$categories_form_component_task=sanitizeString_($_POST["categories_form_component_task"]);}

      if (isset($_POST["categories_form_component_doSubmit"])){$categories_form_component_submittedComponentTitle=sanitizeString_($_POST["categories_form_component_doSubmit"]);}

      if (isset($_POST["categories_form_component_title"])) 
      { 
        $categories_form_component_title= $_POST["categories_form_component_title"];

      }

      if (isset($_POST["categories_form_component_icon"])) 
      { 
        $categories_form_component_icon= $_POST["categories_form_component_icon"];

      }

      if (isset($_POST["categories_form_component_isActive"])) 
      { 
        $categories_form_component_isActive= $_POST["categories_form_component_isActive"];

      }

      if (isset($_POST["categories_form_component_searchTerm"])){$categories_form_component_searchTerm=sanitizeString_($_POST["categories_form_component_searchTerm"]);}
?><?php 
}elseif (
    (((($_SERVER["REQUEST_METHOD"] === "GET") && isset($_GET)) ) ) 
    ){
      //$id = $_GET["id"];
      //$task = $_GET["task"];  

      if (isset($_GET["categories_form_component_id"])){$categories_form_component_id=sanitizeString_($_GET["categories_form_component_id"]);}

      if (isset($_GET["categories_form_component_task"])){$categories_form_component_task=sanitizeString_($_GET["categories_form_component_task"]);}

      if (isset($_GET["categories_form_component_doSubmit"])){$categories_form_component_submittedComponentTitle=sanitizeString_($_GET["categories_form_component_doSubmit"]);}

        if (isset($_GET["categories_form_component_searchTerm"])){$categories_form_component_searchTerm=sanitizeString_($_GET["categories_form_component_searchTerm"]);}
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
switch ($categories_form_component_task) {
  case "top-level-form":
    try 
    {
      $stmt = $pdo->prepare("SELECT * FROM `categories` WHERE `userId`=? AND `ownerId`=? ");
      $stmt->execute([$userId,$ownerId]);
      $data = $stmt->fetchAll();
      if ($data) {
        if(isset($data[0]["id"]))
        {
          $categories_form_component_id= $data[0]["id"];
        }
        $categories_form_component_title= $data[0]["title"];
$categories_form_component_icon= $data[0]["icon"];
$categories_form_component_isActive= $data[0]["isActive"];
            }
        } catch (\PDOException $e) {
            $errorMessage .= "<b>Database error loading categories</b><br>";
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    break;
  case "new":
    break;
  case "edit":
    /*This will never execute on POST for a component that was not posted. see `save`*/
    if($categories_form_component_id > 0){
        try {  $stmt = $pdo->prepare("SELECT * FROM `categories` WHERE `id`=?");
          $stmt->execute([$categories_form_component_id]);
          $data = $stmt->fetchAll();  if ($data) {if(empty($data[0]["title"])){}else{$categories_form_component_title= $data[0]["title"];
}
if(empty($data[0]["icon"])){}else{$categories_form_component_icon= $data[0]["icon"];
}
if(empty($data[0]["isActive"])){}else{$categories_form_component_isActive= $data[0]["isActive"];
}
            }
        } catch (\PDOException $e) {
            $errorMessage .= "<b>Database error loading categories</b><br>";
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
      }else{
        header("location: categories_form_page.php");
      }
    break;
  case "delete":
    try {
          $stmt = $pdo->prepare("DELETE FROM `categories` WHERE `id`=?");
          $stmt->execute([$categories_form_component_id]);
          header("location: categories_form_page.php");
          exit();
        } catch (\PDOException $e) {
            $errorMessage .= "<b>Database error deleting from categories</b><br>";
            //throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    break;
  case "save":
    /*Will only execute for a submitted component, and else for the other components$app->pages[$ipages]->components[$icomponent]->title*/
    
        if($categories_form_component_submittedComponentTitle==="categories_form_component")
        {
          if($categories_form_component_id < 1){
            /*if theres a file to upload then try uploading*/try 
              {
                $stmt = $pdo->prepare("INSERT INTO `categories` (`title`,`icon`,`isActive`, `updatedBy`, `userId`, `ownerId`) VALUES (?,?,?,?,?,?)"); $stmt->execute([$categories_form_component_title,$categories_form_component_icon,$categories_form_component_isActive,
                  $_SESSION[APP_SESSION_NAME]["fullname"]." (".$_SESSION[APP_SESSION_NAME]["id"].")",$_SESSION[APP_SESSION_NAME]["id"],$_SESSION[APP_SESSION_NAME]["ownerId"] ]);
              $categories_form_component_id = $pdo->lastInsertID();    
            } catch (\PDOException $e) {
              $errorMessage .= "<b>Error adding to categories</b><br>";
              throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
          }elseif ($categories_form_component_id > 0 ) 
          {try 
            {
              /*if theres a file to upload then try uploading*/ $stmt = $pdo->prepare("UPDATE `categories` SET `title`=?,`icon`=?,`isActive`=?, `updatedBy`=?,`updatedOn`=? WHERE `id`=?"); $stmt->execute([$categories_form_component_title,$categories_form_component_icon,$categories_form_component_isActive,   $_SESSION[APP_SESSION_NAME]["fullname"]." (".$_SESSION[APP_SESSION_NAME]["id"].")", getDate_() ,$categories_form_component_id]);                    
            } catch (\PDOException $e) {
                      $errorMessage .= "<b>Error updating categories</b><br>";
                      throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }/*end try*/
          }else{
            header("location: categories_form_page.php");
          }
        }else{
          /*same as for edit this will only execute for a component that wasnt submitted on POST*/
          if($categories_form_component_id > 0){
            try {
                      $stmt = $pdo->prepare("SELECT * FROM `categories` WHERE `id`=?");
                      $stmt->execute([$categories_form_component_id]);
                      $data = $stmt->fetchAll();
                    if ($data) {if(empty($data[0]["title"])){}else{$categories_form_component_title= $data[0]["title"];
}
if(empty($data[0]["icon"])){}else{$categories_form_component_icon= $data[0]["icon"];
}
if(empty($data[0]["isActive"])){}else{$categories_form_component_isActive= $data[0]["isActive"];
}
    
                    }} catch (\PDOException $e) {
                        $errorMessage .= "<b>Database error loading categories</b><br>";
                        throw new \PDOException($e->getMessage(), (int)$e->getCode());
                    }
          }else{
            //header("location: categories_form_page.php");
          }
        //////
        }   break;
            
            default:
              //header("location: categories_form_page.php");
              break;
          }

        }
?>

<?php 
/******************************************************************DISPLAY******************************************************************/
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
    <title>Category - <?php echo APP_FULLNAME  ;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="favicon.ico" type="image/x-icon" sizes="any" />
    <meta name="next-size-adjust" />
    
  </head>
  <body class="__variable_20951f __variable_9bfd88 bg-[#f98727]c">

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

                      
                      <b class="-4">Category</b>

                            <form method="post" action="" class="mt-4"  id= "23-o--link--o-Thrift-o--link--o-810-o--link--o-categories_form_page-o--link--o-997-o--link--o-categories_form_component-o--link--o-form" method="POST" action=""  enctype="multipart/form-data"
                            >


                            <input type="hidden" name="task" value="save" id="task" />
                            <input type="hidden" name="id" value="<?php echo $id;?>" id="id">
                            <input type="hidden" name="searchTerm" value="<?php echo $searchTerm;?>" id="searchTerm">

                            
                            <input type="hidden" name="categories_form_component_task" value="save" id="23-o--link--o-Thrift-o--link--o-810-o--link--o-categories_form_page-o--link--o-997-o--link--o-categories_form_component-o--link--o-task" />
                            <input type="hidden" name="categories_form_component_id" value="<?php echo $categories_form_component_id;?>" id="23-o--link--o-Thrift-o--link--o-810-o--link--o-categories_form_page-o--link--o-997-o--link--o-categories_form_component-o--link--o-id" >
                            <input type="hidden" name="categories_form_component_searchTerm" value="<?php echo $categories_form_component_searchTerm;?>" id="23-o--link--o-Thrift-o--link--o-810-o--link--o-categories_form_page-o--link--o-997-o--link--o-categories_form_component-o--link--o-searchTerm" >





                                <div class="grid w-full items-center gap-8">
                                  <div class="flex flex-col space-y-1.5">
                                    <input 
                                    name="categories_form_component_title"  
                                    id="23-o--link--o-Thrift-o--link--o-810-o--link--o-categories_form_page-o--link--o-997-o--link--o-categories_form_component-o--link--o-title"  
                                    value="<?php echo $categories_form_component_title;?>"   
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="phoneNo" 
                                      placeholder="Category"  
                                      
                                      required 

                                    />
                                    
                                  </div>


                                  <div class="flex justify-center">
                                  <a 
                                  href="_admin_categories.php" 
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-md hover:bg-dark mr-2"
                                  >
                                    Close
                                  </a>
                                  <a 
                                  href="_admin_category.php?categories_form_component_id=-1&categories_form_component_task=new&id=<?php echo $id;?>&id=<?php echo $task;?>&searchTerm=<?php echo $searchTerm;?>"  id="categories_form_component_newbutton"
                                  
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-secondary-foreground shadow h-14 rounded-md px-10 bg-secondary text-md hover:bg-dark mr-2"
                                  >
                                    New
                                  </a>
                                  <button
                                    class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-14 rounded-md px-10 bg-brand text-md hover:bg-brand-600" 
                                    type="submit" 
                                     name="categories_form_component_doSubmit" value="categories_form_component"  id="categories_form_component_savebutton"
                                  >
                                    Save
                                  </button>
                                  
                                </div>
                                  
                                </div>
                              </form>

    </div>
            
          </div>
        </div>
      </div>
    </main>
    <?php include_once('_footer.php');?>
  </body>
</html>