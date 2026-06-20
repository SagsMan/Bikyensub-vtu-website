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
$page='_admin_create_donation';

if ((((($_SERVER["REQUEST_METHOD"] === "POST") && isset($_POST)) ) ) 
  ){
    if (isset($_POST["id"])) { $id = $_POST["id"];  }
    if (isset($_POST["task"])) { $task = $_POST["task"];  }
    if (isset($_POST["doSubmit"])) { 
      $submittedComponentTitle = $_POST["doSubmit"];  

    }


    }elseif ((((($_SERVER["REQUEST_METHOD"] === "GET") && isset($_GET)) ) )) {
      if (isset($_GET["id"])) { $id = $_GET["id"];  }
      if (isset($_GET["task"])) { $task = $_GET["task"];  }     
  }else{
    
  }
?>


<?php 

$admin_campaigns_form_component_datasource= array();
$admin_campaigns_form_component_searchTerm__=array();


$admin_campaigns_form_component_poster="";
$admin_campaigns_form_component_donation_title="";
$admin_campaigns_form_component_video_url="";
$admin_campaigns_form_component_category="";
$admin_campaigns_form_component_donate_goal="";
$admin_campaigns_form_component_current_amount_raised="";
$admin_campaigns_form_component_location="";
$admin_campaigns_form_component_about_the_donation="";
$admin_campaigns_form_component_isActive="";


$admin_campaigns_form_component_errorMessage= "";
$admin_campaigns_form_component_id = -1;
$admin_campaigns_form_component_task= "";
$admin_campaigns_form_component_submittedComponentTitle= "";
$admin_campaigns_form_component_componentToShowName="";
$admin_campaigns_form_component_userId = "";
$admin_campaigns_form_component_ownerId ="";
if(isset($_SESSION[APP_SESSION_NAME]["id"])){
$admin_campaigns_form_component_userId = $_SESSION[APP_SESSION_NAME]["id"];
}
if(isset($_SESSION[APP_SESSION_NAME]["id"])){
$admin_campaigns_form_component_ownerId =$_SESSION[APP_SESSION_NAME]["ownerId"];
}
$admin_campaigns_form_component_searchTerm="";
$admin_campaigns_form_component_multipartComponentToDisplayName="";

$admin_campaigns_form_component_id = $id;
$admin_campaigns_form_component_task= $task;
$admin_campaigns_form_component_submittedComponentTitle= $submittedComponentTitle;
$admin_campaigns_form_component_searchTerm= $searchTerm;

 ?>

<?php 

  if (validatePOSTS(array("admin_campaigns_form_component_multipartComponentToDisplayName")) === true) 
  {

    $admin_campaigns_form_component_multipartComponentToDisplayName = sanitizeString_($_POST["admin_campaigns_form_component_multipartComponentToDisplayName"]);

  }elseif (validateGETS(array("admin_campaigns_form_component_multipartComponentToDisplayName")) === true) 
  {

    $admin_campaigns_form_component_multipartComponentToDisplayName = sanitizeString_($_GET["admin_campaigns_form_component_multipartComponentToDisplayName"]);

  }elseif(
    (!isset($admin_campaigns_form_component_multipartComponentToDisplayName) || empty($admin_campaigns_form_component_multipartComponentToDisplayName) ) && 
    -1000===0
   ){

      $admin_campaigns_form_component_multipartComponentToDisplayName="admin_campaigns_form_component";
   }


?>


<?php 
if(
    (0===0) || 
    ((0===1 && "admin_campaigns_form_component"===strtolower($admin_campaigns_form_component_multipartComponentToDisplayName)
    )) 
  ){
?>

<?php 
if(($_SERVER["REQUEST_METHOD"] === "POST") && isset($_POST)){
  
}
?>

<?php 

if (
  (((($_SERVER["REQUEST_METHOD"] === "POST") && isset($_POST)) && 
  isset($_POST["admin_campaigns_form_component_doSubmit"])) ) 
  ){

      if (isset($_POST["admin_campaigns_form_component_id"])){$admin_campaigns_form_component_id=sanitizeString_($_POST["admin_campaigns_form_component_id"]);}

      if (isset($_POST["admin_campaigns_form_component_task"])){$admin_campaigns_form_component_task=sanitizeString_($_POST["admin_campaigns_form_component_task"]);}

      if (isset($_POST["admin_campaigns_form_component_doSubmit"])){$admin_campaigns_form_component_submittedComponentTitle=sanitizeString_($_POST["admin_campaigns_form_component_doSubmit"]);}

      if (isset($_POST["admin_campaigns_form_component_poster"])) 
      { 
        $admin_campaigns_form_component_poster= $_POST["admin_campaigns_form_component_poster"];

      }

      if (isset($_POST["admin_campaigns_form_component_donation_title"])) 
      { 
        $admin_campaigns_form_component_donation_title= $_POST["admin_campaigns_form_component_donation_title"];

      }

      if (isset($_POST["admin_campaigns_form_component_video_url"])) 
      { 
        $admin_campaigns_form_component_video_url= $_POST["admin_campaigns_form_component_video_url"];

      }

      if (isset($_POST["admin_campaigns_form_component_category"])) 
      { 
        $admin_campaigns_form_component_category= $_POST["admin_campaigns_form_component_category"];

      }

      if (isset($_POST["admin_campaigns_form_component_donate_goal"])) 
      { 
        $admin_campaigns_form_component_donate_goal= $_POST["admin_campaigns_form_component_donate_goal"];

      }

      if (isset($_POST["admin_campaigns_form_component_current_amount_raised"])) 
      { 
        $admin_campaigns_form_component_current_amount_raised= $_POST["admin_campaigns_form_component_current_amount_raised"];

      }

      if (isset($_POST["admin_campaigns_form_component_location"])) 
      { 
        $admin_campaigns_form_component_location= $_POST["admin_campaigns_form_component_location"];

      }

      if (isset($_POST["admin_campaigns_form_component_about_the_donation"])) 
      { 
        $admin_campaigns_form_component_about_the_donation= $_POST["admin_campaigns_form_component_about_the_donation"];

      }

      if (isset($_POST["admin_campaigns_form_component_isActive"])) 
      { 
        $admin_campaigns_form_component_isActive= $_POST["admin_campaigns_form_component_isActive"];

      }

      if (isset($_POST["admin_campaigns_form_component_searchTerm"])){$admin_campaigns_form_component_searchTerm=sanitizeString_($_POST["admin_campaigns_form_component_searchTerm"]);}
?><?php 
}elseif (
    (((($_SERVER["REQUEST_METHOD"] === "GET") && isset($_GET)) ) ) 
    ){


      if (isset($_GET["admin_campaigns_form_component_id"])){$admin_campaigns_form_component_id=sanitizeString_($_GET["admin_campaigns_form_component_id"]);}

      if (isset($_GET["admin_campaigns_form_component_task"])){$admin_campaigns_form_component_task=sanitizeString_($_GET["admin_campaigns_form_component_task"]);}

      if (isset($_GET["admin_campaigns_form_component_doSubmit"])){$admin_campaigns_form_component_submittedComponentTitle=sanitizeString_($_GET["admin_campaigns_form_component_doSubmit"]);}

        if (isset($_GET["admin_campaigns_form_component_searchTerm"])){$admin_campaigns_form_component_searchTerm=sanitizeString_($_GET["admin_campaigns_form_component_searchTerm"]);}
?> <?php 
      }else{
      
      }

switch ($admin_campaigns_form_component_task) {
  case "top-level-form":
              try 
              {
                $stmt = $pdo->prepare("SELECT * FROM `campaigns` WHERE `userId`=? AND `ownerId`=? ");
                $stmt->execute([$userId,$ownerId]);
                $data = $stmt->fetchAll();
                if ($data) {
                  if(isset($data[0]["id"]))
                  {
                    $admin_campaigns_form_component_id= $data[0]["id"];
                  }
                  $admin_campaigns_form_component_poster= $data[0]["poster"];
                  $admin_campaigns_form_component_donation_title= $data[0]["donation_title"];
                  $admin_campaigns_form_component_video_url= $data[0]["video_url"];
                  $admin_campaigns_form_component_category= $data[0]["category"];
                  $admin_campaigns_form_component_donate_goal= $data[0]["donate_goal"];
                  $admin_campaigns_form_component_current_amount_raised= $data[0]["current_amount_raised"];
                  $admin_campaigns_form_component_location= $data[0]["location"];
                  $admin_campaigns_form_component_about_the_donation= $data[0]["about_the_donation"];
                  $admin_campaigns_form_component_isActive= $data[0]["isActive"];
                              }
                } catch (\PDOException $e) {
                    $errorMessage .= "<b>Database error loading campaigns</b><br>";
                    throw new \PDOException($e->getMessage(), (int)$e->getCode());
                }
    break;
  case "new":
    break;
  case "edit":

    if($admin_campaigns_form_component_id > 0){
        try {  
          $stmt = $pdo->prepare("SELECT * FROM `campaigns` WHERE `id`=?");
          $stmt->execute([$admin_campaigns_form_component_id]);
          $data = $stmt->fetchAll();  if ($data) {if(empty($data[0]["poster"])){}else{$admin_campaigns_form_component_poster= $data[0]["poster"];
            }
            if(empty($data[0]["donation_title"])){}else{$admin_campaigns_form_component_donation_title= $data[0]["donation_title"];
            }
            if(empty($data[0]["video_url"])){}else{$admin_campaigns_form_component_video_url= $data[0]["video_url"];
            }
            if(empty($data[0]["category"])){}else{$admin_campaigns_form_component_category= $data[0]["category"];
            }
            if(empty($data[0]["donate_goal"])){}else{$admin_campaigns_form_component_donate_goal= $data[0]["donate_goal"];
            }
            if(empty($data[0]["current_amount_raised"])){}else{$admin_campaigns_form_component_current_amount_raised= $data[0]["current_amount_raised"];
            }
            if(empty($data[0]["location"])){}else{$admin_campaigns_form_component_location= $data[0]["location"];
            }
            if(empty($data[0]["about_the_donation"])){}else{$admin_campaigns_form_component_about_the_donation= $data[0]["about_the_donation"];
            }
            if(empty($data[0]["isActive"])){}else{$admin_campaigns_form_component_isActive= $data[0]["isActive"];
            }
            }
        } catch (\PDOException $e) {
            $errorMessage .= "<b>Database error loading campaigns</b><br>";
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
      }else{
        header("location: admin_campaigns_form_page.php");
      }
    break;
  case "delete":
    try {
          $stmt = $pdo->prepare("DELETE FROM `campaigns` WHERE `id`=?");
          $stmt->execute([$admin_campaigns_form_component_id]);
          header("location: admin_campaigns_form_page.php");
          exit();
        } catch (\PDOException $e) {
            $errorMessage .= "<b>Database error deleting from campaigns</b><br>";
            
        }
    break;
  case "save":
             
              
                  if($admin_campaigns_form_component_submittedComponentTitle==="admin_campaigns_form_component")
                  {
                    if($admin_campaigns_form_component_id < 1){


             
                          $filePath = APP_UPLOADS.APP_DOCUMENTS;
                          $fileDescription="No description";
                          $fileType="";
                          $fileName="";
                          
             
                          if (isset($_FILES["admin_campaigns_form_component_poster"]) && !empty($_FILES["admin_campaigns_form_component_poster"])  && !empty($_FILES["admin_campaigns_form_component_poster"]["name"]) )
                          {
                            
                            
                            $fileName = $_SESSION[APP_SESSION_NAME]["id"]."-poster-".$_FILES["admin_campaigns_form_component_poster"]["name"];
                              $fileType = explode(".", $fileName);
                              if(count($fileType)>1){ 
                                
                                $fileType = $fileType[count($fileType)-1];
                              }
                
                              
                              copy($_FILES["admin_campaigns_form_component_poster"]["tmp_name"], $filePath."/".$fileName)
                              or die("Could not copy");

                              if (!empty($filePath)) {
                                $admin_campaigns_form_component_poster=$fileName;
                                    
                                  }
                                
                            
                          }else{
                            
                            if (isset($_POST["poster-currentname"])) { $admin_campaigns_form_component_poster= $_POST["admin_campaigns_form_component_poster-currentname"];}
                          }
                    
                            
                        try 
                        {
                          $stmt = $pdo->prepare("INSERT INTO `campaigns` (`poster`,`donation_title`,`video_url`,`category`,`donate_goal`,`current_amount_raised`,`location`,`about_the_donation`,`isActive`, `updatedBy`, `userId`, `ownerId`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)"); $stmt->execute([$admin_campaigns_form_component_poster,$admin_campaigns_form_component_donation_title,$admin_campaigns_form_component_video_url,$admin_campaigns_form_component_category,$admin_campaigns_form_component_donate_goal,$admin_campaigns_form_component_current_amount_raised,$admin_campaigns_form_component_location,$admin_campaigns_form_component_about_the_donation,$admin_campaigns_form_component_isActive,
                            $_SESSION[APP_SESSION_NAME]["fullname"]." (".$_SESSION[APP_SESSION_NAME]["id"].")",$_SESSION[APP_SESSION_NAME]["id"],$_SESSION[APP_SESSION_NAME]["ownerId"] ]);
                          $admin_campaigns_form_component_id = $pdo->lastInsertID();    
                        } catch (\PDOException $e) {
                          $errorMessage .= "<b>Error adding to campaigns</b><br>";
                          throw new \PDOException($e->getMessage(), (int)$e->getCode());
                        }

                    }else if ($admin_campaigns_form_component_id > 0 ) 
                    {
                      try 
                      {
                       
                          $filePath = APP_UPLOADS.APP_DOCUMENTS;
                            $fileDescription="No description";
                            $fileType="";
                            $fileName="";
                            
                       
                            if (isset($_FILES["admin_campaigns_form_component_poster"]) && !empty($_FILES["admin_campaigns_form_component_poster"])  && !empty($_FILES["admin_campaigns_form_component_poster"]["name"]) )
                            {
                              
                       $fileName = $_SESSION[APP_SESSION_NAME]["id"]."-poster-".$_FILES["admin_campaigns_form_component_poster"]["name"];
                              $fileType = explode(".", $fileName);
                              if(count($fileType)>1){ 
                       
                                $fileType = $fileType[count($fileType)-1];
                              }
                    
                       
                              copy($_FILES["admin_campaigns_form_component_poster"]["tmp_name"], $filePath."/".$fileName)
                              or die("Could not copy");

                              if (!empty($filePath)) 
                              {
                                $admin_campaigns_form_component_poster=$fileName; 
                              }
                              

                            }else{
                              
                              if (isset($_POST["admin_campaigns_form_component_poster-currentname"])) { $admin_campaigns_form_component_poster= $_POST["admin_campaigns_form_component_poster-currentname"];}
                            }
                    
                            
                            $stmt = $pdo->prepare("UPDATE `campaigns` SET `poster`=?,`donation_title`=?,`video_url`=?,`category`=?,`donate_goal`=?,`current_amount_raised`=?,`location`=?,`about_the_donation`=?,`isActive`=?, `updatedBy`=?,`updatedOn`=? WHERE `id`=?"); $stmt->execute([$admin_campaigns_form_component_poster,$admin_campaigns_form_component_donation_title,$admin_campaigns_form_component_video_url,$admin_campaigns_form_component_category,$admin_campaigns_form_component_donate_goal,$admin_campaigns_form_component_current_amount_raised,$admin_campaigns_form_component_location,$admin_campaigns_form_component_about_the_donation,$admin_campaigns_form_component_isActive,   $_SESSION[APP_SESSION_NAME]["fullname"]." (".$_SESSION[APP_SESSION_NAME]["id"].")", getDate_() ,$admin_campaigns_form_component_id]);                    
                      } catch (\PDOException $e) {
                                $errorMessage .= "<b>Error updating campaigns</b><br>";
                                throw new \PDOException($e->getMessage(), (int)$e->getCode());
                      }
                    }else{
                      header("location: admin_campaigns_form_page.php");
                    }
                  }else{
                    
                              if($admin_campaigns_form_component_id > 0){
                                try {
                                          $stmt = $pdo->prepare("SELECT * FROM `campaigns` WHERE `id`=?");
                                          $stmt->execute([$admin_campaigns_form_component_id]);
                                          $data = $stmt->fetchAll();
                                        if ($data) {if(empty($data[0]["poster"])){}else{$admin_campaigns_form_component_poster= $data[0]["poster"];
                    }
                    if(empty($data[0]["donation_title"])){}else{$admin_campaigns_form_component_donation_title= $data[0]["donation_title"];
                    }
                    if(empty($data[0]["video_url"])){}else{$admin_campaigns_form_component_video_url= $data[0]["video_url"];
                    }
                    if(empty($data[0]["category"])){}else{$admin_campaigns_form_component_category= $data[0]["category"];
                    }
                    if(empty($data[0]["donate_goal"])){}else{$admin_campaigns_form_component_donate_goal= $data[0]["donate_goal"];
                    }
                    if(empty($data[0]["current_amount_raised"])){}else{$admin_campaigns_form_component_current_amount_raised= $data[0]["current_amount_raised"];
                    }
                    if(empty($data[0]["location"])){}else{$admin_campaigns_form_component_location= $data[0]["location"];
                    }
                    if(empty($data[0]["about_the_donation"])){}else{$admin_campaigns_form_component_about_the_donation= $data[0]["about_the_donation"];
                    }
                    if(empty($data[0]["isActive"])){}else{$admin_campaigns_form_component_isActive= $data[0]["isActive"];
                    }
                        
                                        }} catch (\PDOException $e) {
                                            $errorMessage .= "<b>Database error loading campaigns</b><br>";
                                            throw new \PDOException($e->getMessage(), (int)$e->getCode());
                                        }
                              }else{
                                
                              }
                            
                  }   
        break;
            
            default:
              
              break;
    }

  }



 $stmt = $pdo->prepare("SELECT  *  FROM `categories`");//"  WHERE  `ownerId`=? ");
      /*Execute SQL*/
      $stmt->execute();// $ownerId ]);


    

    /*Fetch SQL result*/
    $categories_list_component_datasource = $stmt->fetchAll();





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
      rel="stylesheet"
      href="_next/static/css/03e7c516ae6f9031.css"
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
    <title>Thrift Thrust</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="/favicon.ico" type="image/x-icon" sizes="any" />
    <meta name="next-size-adjust" />
    <!--script
      src="/_next/static/chunks/polyfills-78c92fac7aa8fdd8.js"
      nomodule=""
    ></script-->


    <link href="theme/vendors/summernote/summernote.min.css" rel="stylesheet">
    <script src="theme/vendors/summernote/summernote.min.js"></script>
  </head>
  <body class="__variable_20951f __variable_9bfd88 bg-[#f98727]">
   
   <?php include_once('_header.php');?>

    <main>
      <div class="space-y-6 bg-gray-100 p-2 pb-16 md:p-8">
        <div class="flex flex-col lg:flex-row lg:space-y-0">
          
          <!--div class="mb-2 block lg:hidden">
            <div data-orientation="vertical">
              <div
                data-state="closed"
                data-orientation="vertical"
                class="border-b"
              >
                <h3
                  data-orientation="vertical"
                  data-state="closed"
                  class="flex"
                >
                  <button
                    type="button"
                    aria-controls="radix-:Rlmmja:"
                    aria-expanded="false"
                    data-state="closed"
                    data-orientation="vertical"
                    id="radix-:R5mmja:"
                    class="flex-1 hover:underline [&amp;[data-state=open]&gt;svg]:rotate-180 inline-flex items-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2 justify-start"
                    data-radix-collection-item=""
                  >
                    Menu<svg
                      width="15"
                      height="15"
                      viewBox="0 0 15 15"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-4 w-4 shrink-0 text-muted-foreground transition-transform duration-200"
                    >
                      <path
                        d="M3.13523 6.15803C3.3241 5.95657 3.64052 5.94637 3.84197 6.13523L7.5 9.56464L11.158 6.13523C11.3595 5.94637 11.6759 5.95657 11.8648 6.15803C12.0536 6.35949 12.0434 6.67591 11.842 6.86477L7.84197 10.6148C7.64964 10.7951 7.35036 10.7951 7.15803 10.6148L3.15803 6.86477C2.95657 6.67591 2.94637 6.35949 3.13523 6.15803Z"
                        fill="currentColor"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                      ></path>
                    </svg>
                  </button>
                </h3>
                <div
                  data-state="closed"
                  id="radix-:Rlmmja:"
                  hidden=""
                  role="region"
                  aria-labelledby="radix-:R5mmja:"
                  data-orientation="vertical"
                  class="overflow-hidden text-sm data-[state=closed]:animate-accordion-up data-[state=open]:animate-accordion-down"
                  style="
                    --radix-accordion-content-height: var(
                      --radix-collapsible-content-height
                    );
                    --radix-accordion-content-width: var(
                      --radix-collapsible-content-width
                    );
                  "
                ></div>
              </div>
            </div>
          </div-->
          
          <?php include_once('_aside.php');?>

          <div class="flex-1">
            <div class="h-full space-y-6 lg:pl-4">
              <div
                class="rounded-xl border bg-card text-card-foreground shadow-sm"
              >
                <div class="flex flex-col space-y-1.5 p-6">
                  <h3
                    class="font-semibold leading-none tracking-tight flex items-center"
                  >
                    <span
                      class="font-inter text-3xl font-semibold tracking-tight"
                      >Create a Donation</span
                    >
                  </h3>
                </div>
                


                <div class="p-6 pt-0 space-y-6">
                  
                  <div class="mx-auto flex max-w-lg flex-col gap-2">

                    <!-- Display Poster -->
                    <!--img alt="" width="55" src="<?php echo APP_UPLOADS.APP_DOCUMENTS;?><?php echo $admin_campaigns_form_component_poster;?>" /-->
                    <!--End-->

                    

                    <!--button
                      type="button"
                      aria-haspopup="dialog"
                      aria-expanded="false"
                      aria-controls="radix-:R1crdmmja:"
                      data-state="closed"
                    >
                      <div
                        class="rounded-xl border bg-card text-card-foreground shadow"
                      >
                        <div class="p-6">
                          <div
                            class="grid place-items-center rounded-lg border-black/30"
                          >
                            <div class="flex flex-col items-center space-y-6">
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="h-24 w-24 rounded-full bg-black/5 p-6"
                              >
                                <path
                                  d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"
                                ></path>
                                <path d="M12 12v9"></path>
                                <path d="m16 16-4-4-4 4"></path>
                              </svg>
                              <h4
                                class="scroll-m-20 font-inter text-xl font-semibold tracking-tight"
                              >
                                select an image to upload
                              </h4>
                            </div>
                          </div>
                        </div>
                      </div>
                    </button-->
                  </div>


                  <form class="grid gap-3 md:grid-cols-2 23-o--link--o-802-o--link--o-admin_campaigns_form_page.php-o--link--o-980-o--link--o-admin_campaigns_form_component-o--link--o-form"  id= "23-o--link--o-Thrift-o--link--o-802-o--link--o-admin_campaigns_form_page-o--link--o-980-o--link--o-admin_campaigns_form_component-o--link--o-form" method="POST" action=""  enctype="multipart/form-data">

                    <input type="hidden" name="task" value="save" id="task" />
              <input type="hidden" name="id" value="<?php echo $id;?>" id="id">
              <input type="hidden" name="searchTerm" value="<?php echo $searchTerm;?>" id="searchTerm">

              
              <input type="hidden" name="admin_campaigns_form_component_task" value="save" id="23-o--link--o-Thrift-o--link--o-802-o--link--o-admin_campaigns_form_page-o--link--o-980-o--link--o-admin_campaigns_form_component-o--link--o-task" />
              <input type="hidden" name="admin_campaigns_form_component_id" value="<?php echo $admin_campaigns_form_component_id;?>" id="23-o--link--o-Thrift-o--link--o-802-o--link--o-admin_campaigns_form_page-o--link--o-980-o--link--o-admin_campaigns_form_component-o--link--o-id" >
              <input type="hidden" name="admin_campaigns_form_component_searchTerm" value="<?php echo $admin_campaigns_form_component_searchTerm;?>" id="23-o--link--o-Thrift-o--link--o-802-o--link--o-admin_campaigns_form_page-o--link--o-980-o--link--o-admin_campaigns_form_component-o--link--o-searchTerm" >


              <div class="grid w-full items-center gap-1.5">
                    <label
                        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                        for="title"
                        >Donation Poster</label>
              <input type="file"  class="form-control form-control-sm" name="admin_campaigns_form_component_poster"  id="23-o--link--o-Thrift-o--link--o-802-o--link--o-admin_campaigns_form_page-o--link--o-980-o--link--o-admin_campaigns_form_component-o--link--o-poster"  idx="admin_campaigns_form_page-o--link--o-admin_campaigns_form_component-o--link--o-poster" value="<?php echo $admin_campaigns_form_component_poster;?>"  >
            </div>
            <input type="hidden" name="admin_campaigns_form_component_poster-currentname" id="poster-currentname" value="<?php echo $admin_campaigns_form_component_poster;?>" >


             

                    <div class="grid w-full items-center gap-1.5">
                      <label
                        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                        for="title"
                        >Donation Title</label
                      ><input
                        type="text"
                        class="flex h-9 w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50" 
                        required 
                        placeholder="your donation title"
                        name="admin_campaigns_form_component_donation_title"  id="23-o--link--o-Thrift-o--link--o-802-o--link--o-admin_campaigns_form_page-o--link--o-980-o--link--o-admin_campaigns_form_component-o--link--o-donation_title" 
                        value="<?php echo $admin_campaigns_form_component_donation_title;?>"
                      />
                    </div>
                    <div class="grid w-full items-center gap-1.5">
                      <label
                        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                        for="title"
                        >Video URL</label
                      ><input
                        type="url"
                        class="flex h-9 w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                        
                        placeholder="your video url" 
                        name="admin_campaigns_form_component_video_url"  id="23-o--link--o-Thrift-o--link--o-802-o--link--o-admin_campaigns_form_page-o--link--o-980-o--link--o-admin_campaigns_form_component-o--link--o-video_url"  idx="admin_campaigns_form_page-o--link--o-admin_campaigns_form_component-o--link--o-video_url" value="<?php echo $admin_campaigns_form_component_video_url;?>"
                      />
                    </div>
                    <div class="grid w-full items-center gap-1.5">
                      <label
                        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                        >Category</label
                      >
                      <!--button
                        type="button"
                        role="combobox"
                        aria-controls="radix-:Rjkrdmmja:"
                        aria-expanded="false"
                        aria-autocomplete="none"
                        dir="ltr"
                        data-state="closed"
                        data-placeholder=""
                        class="flex h-9 w-full items-center justify-between rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-1 focus:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                      >
                        <span style="pointer-events: none">Select Category</span
                        ><svg
                          width="15"
                          height="15"
                          viewBox="0 0 15 15"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                          class="h-4 w-4 opacity-50"
                          aria-hidden="true"
                        >
                          <path
                            d="M4.93179 5.43179C4.75605 5.60753 4.75605 5.89245 4.93179 6.06819C5.10753 6.24392 5.39245 6.24392 5.56819 6.06819L7.49999 4.13638L9.43179 6.06819C9.60753 6.24392 9.89245 6.24392 10.0682 6.06819C10.2439 5.89245 10.2439 5.60753 10.0682 5.43179L7.81819 3.18179C7.73379 3.0974 7.61933 3.04999 7.49999 3.04999C7.38064 3.04999 7.26618 3.0974 7.18179 3.18179L4.93179 5.43179ZM10.0682 9.56819C10.2439 9.39245 10.2439 9.10753 10.0682 8.93179C9.89245 8.75606 9.60753 8.75606 9.43179 8.93179L7.49999 10.8636L5.56819 8.93179C5.39245 8.75606 5.10753 8.75606 4.93179 8.93179C4.75605 9.10753 4.75605 9.39245 4.93179 9.56819L7.18179 11.8182C7.35753 11.9939 7.64245 11.9939 7.81819 11.8182L10.0682 9.56819Z"
                            fill="currentColor"
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                          ></path>
                        </svg>
                      </button-->
                      <select 

                        required 
                        aria-hidden="truex"
                        tabindex="-1"
                        style="
                          /*position: absolute;
                          border: 0;
                          width: 1px;
                          height: 1px;
                          padding: 0;
                          margin: -1px;
                          overflow: hidden;
                          clip: rect(0, 0, 0, 0);
                          white-space: nowrap;
                          word-wrap: normal;*/
                        "
                        class="flex h-9 w-full items-center justify-between rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-1 focus:ring-ring disabled:cursor-not-allowed disabled:opacity-50"

                         name="admin_campaigns_form_component_category"  id="23-o--link--o-Thrift-o--link--o-802-o--link--o-admin_campaigns_form_page-o--link--o-980-o--link--o-admin_campaigns_form_component-o--link--o-category"  idx="admin_campaigns_form_page-o--link--o-admin_campaigns_form_component-o--link--o-category" 
                      >
                        <option value=""></option>
                     <?php  if( (isset($categories_list_component_datasource )) && (isset($categories_list_component_datasource[0]['id']))     ){ 
                  
                  for($i=0; $i < count($categories_list_component_datasource);$i++)
                  { ?>
                        <option 
                        <?php if($admin_campaigns_form_component_category==$categories_list_component_datasource[$i]['title']){?>
                          selected
                        <?php } ?>
                            value="<?php echo $categories_list_component_datasource[$i]['title'];?>"><?php echo $categories_list_component_datasource[$i]['title'];?></option>


                        <?php } } ?>
                      </select>

                    </div>
                    <div class="grid w-full items-center gap-1.5">
                      <label
                        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                        for="title"
                        >Donate Goal (in ₦)</label
                      ><input
                        type="number"
                        class="flex h-9 w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50" 
                        required 
                        
                        placeholder="eg: 50000"

                        name="admin_campaigns_form_component_donate_goal"  id="23-o--link--o-Thrift-o--link--o-802-o--link--o-admin_campaigns_form_page-o--link--o-980-o--link--o-admin_campaigns_form_component-o--link--o-donate_goal"  idx="admin_campaigns_form_page-o--link--o-admin_campaigns_form_component-o--link--o-donate_goal" value="<?php echo $admin_campaigns_form_component_donate_goal;?>" 
                      />
                    </div>
                    <div class="grid w-full items-center gap-1.5">
                      <label
                        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                        for="location"
                        >Location</label
                      ><input
                        type="text"
                        class="flex h-9 w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50" 
                        required 
                        
                        placeholder="your location"

                        name="admin_campaigns_form_component_location"  id="23-o--link--o-Thrift-o--link--o-802-o--link--o-admin_campaigns_form_page-o--link--o-980-o--link--o-admin_campaigns_form_component-o--link--o-location"  idx="admin_campaigns_form_page-o--link--o-admin_campaigns_form_component-o--link--o-location" value="<?php echo $admin_campaigns_form_component_location;?>" 
                      />
                    </div>
                    <div class="col-span-2 grid w-full items-center gap-1.5">
                      <label
                        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                        >About the Donation</label
                      >
                      <!--$!-->
                      <!--template
                        data-dgst="NEXT_DYNAMIC_NO_SSR_CODE"
                      -->
                        <textarea   
                        required 
                        class="flex h-9 w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 animate-pulse rounded-md bg-primary/10 h-[200px] w-full" 
                        name="admin_campaigns_form_component_about_the_donation"  id="23-o--link--o-Thrift-o--link--o-802-o--link--o-admin_campaigns_form_page-o--link--o-980-o--link--o-admin_campaigns_form_component-o--link--o-about_the_donation"  idx="admin_campaigns_form_page-o--link--o-admin_campaigns_form_component-o--link--o-about_the_donation"  ><?php echo $admin_campaigns_form_component_about_the_donation;?></textarea>
                        
   

                      <!--/template-->
                      <!--div
                        class="animate-pulse rounded-md bg-primary/10 h-[200px] w-full"
                      ></div-->
                      <!--/$-->
                    </div>
                    <div>
                      <button 
                        class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 bg-brand hover:bg-brand-600"
                        type="submit" 
                        name="admin_campaigns_form_component_doSubmit" value="admin_campaigns_form_component"  id="admin_campaigns_form_component_savebutton"
                      >
                        <span class="ml-1 font-inter">Create Donation</span>
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
<?php include_once('_footer.php');?>
  </body>
</html>
