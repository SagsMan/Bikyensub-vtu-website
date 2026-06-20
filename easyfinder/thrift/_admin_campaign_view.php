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
$task= "edit";
$submittedComponentTitle="";
$componentToShowName="";
$userId= -1;
$ownerId= -1;

if (isset($_SESSION[APP_SESSION_NAME]) ){
$userId =$_SESSION[APP_SESSION_NAME]["id"];
$ownerId =$_SESSION[APP_SESSION_NAME]["ownerId"];
}

$searchTerm="";
$page='_admin_campaign_view';

if ((((($_SERVER["REQUEST_METHOD"] === "POST") && isset($_POST)) ) ) 
  ){
    if (isset($_POST["hkj476hkjhjk655665hkhjkhkty55343233444445778hjklhjgcvdfxsesfdfgjkhkljlljljl"])) { $id = $_POST["hkj476hkjhjk655665hkhjkhkty55343233444445778hjklhjgcvdfxsesfdfgjkhkljlljljl"];  }
    if (isset($_POST["task"])) { $task = $_POST["task"];  }
    if (isset($_POST["doSubmit"])) { 
      $submittedComponentTitle = $_POST["doSubmit"];  

    }


    }elseif ((((($_SERVER["REQUEST_METHOD"] === "GET") && isset($_GET)) ) )) {
      if (isset($_GET["hkj476hkjhjk655665hkhjkhkty55343233444445778hjklhjgcvdfxsesfdfgjkhkljlljljl"])) { $id = $_GET["hkj476hkjhjk655665hkhjkhkty55343233444445778hjklhjgcvdfxsesfdfgjkhkljlljljl"];  }
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
        //header("location: admin_campaigns_form_page.php");
      }
    break;
  case "delete":
    try {
          $stmt = $pdo->prepare("DELETE FROM `campaigns` WHERE `id`=?");
          $stmt->execute([$admin_campaigns_form_component_id]);
          //header("location: admin_campaigns_form_page.php");
          //exit();
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
?>

<?php  $current_amount_raised=getTotalDonationForProject($pdo,$admin_campaigns_form_component_id);  ?>

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
    <title>Campaign - <?php echo APP_FULLNAME;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="/favicon.ico" type="image/x-icon" sizes="any" />
    <meta name="next-size-adjust" />
    <script
      src="/_next/static/chunks/polyfills-78c92fac7aa8fdd8.js"
      nomodule=""
    ></script>
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


          


          <?php if(2==2){?>
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
                      >Campaign Details</span
                    >
                  </h3>
                </div>
                
                <?php  $current_amount_raised=getTotalDonationForProject($pdo,$admin_campaigns_form_component_id);  ?>

                <div class="p-6 pt-0 space-y-6">
                  
                  <div class="mx-autox flex max-w-lg flex-col gap-2">

                    <!-- Display Poster -->
                      <div
                        class="rounded-xl border bg-card text-card-foreground shadow"
                      >
                        <div class="p-6">
                          <div
                            class="grid place-items-center rounded-lg border-black/30"
                          >
                            <div class="flex flex-col items-center space-y-6">
                               <img alt="" width="100%" src="<?php echo APP_UPLOADS.APP_DOCUMENTS;?><?php echo $admin_campaigns_form_component_poster;?>" />
                            </div>
                          </div>
                        </div>
                      </div>
                    
                  </div>

                    <!-- Category -->
                    <div class="flex flex-col space-y-1.5 p-6 border-b py-2">
                        <h3
                          class="font-semibold leading-none tracking-tight flex items-center"
                        >
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
                            class="lucide lucide-umbrella"
                          >
                            <path d="M22 12a10.06 10.06 1 0 0-20 0Z"></path>
                            <path d="M12 12v8a2 2 0 0 0 4 0"></path>
                            <path d="M12 2v1"></path></svg
                          ><span class="ml-2 font-inter text-2xl"><?php echo $admin_campaigns_form_component_category;   ?></span>
                        </h3>
                    </div>

                    <div class="p-6 pt-4">
                        <h3
                          class="mb-2 scroll-m-20 font-inter text-xl font-semibold tracking-tight"
                        >
                          <?php echo $admin_campaigns_form_component_donation_title;   ?>
                        </h3>
                        <p
                          class="mb-1 font-inter text-sm font-medium leading-5 text-gray-500"
                        >
                          ₦<?php echo number_format( $admin_campaigns_form_component_donate_goal,2);   ?>
                        </p>
                        <p
                          class="mb-1 font-inter text-sm font-medium leading-5 text-gray-500"
                        >
                          raised ₦<?php echo number_format( $current_amount_raised, 2);   ?>
                        </p>
                        <p
                          class="font-inter text-sm font-medium leading-5 text-gray-500"
                        >
                        <?php  
                        $percentageCovered = calculatePerc($admin_campaigns_form_component_donate_goal, $current_amount_raised);
                        echo $percentageCovered;
                      ?>%
                        </p>

                          <p
                          class="mb-1 font-inter text-sm font-medium leading-5 text-gray-500"
                        >
                          <?php echo  $admin_campaigns_form_component_location;   ?>
                        </p>

                        <br>
                        <label
                        class=" text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                        >About the Donation</label
                      >
                      <p class="lead mt-1">
                       <?php echo $admin_campaigns_form_component_about_the_donation;?>
                      </p>

                        
                    </div>


                      <div class="flexx items-center p-6 pt-0 pb-0">
                          <p for="donateAmountValue" class="pb-0">Enter the amount to date and click <b>Donate Now</b></p>
                          
                          <input type="text" 
                                      class="flex w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 h-14"
                                      id="donateAmountValue" 
                                      placeholder="e.g 5000"  
                                      value ="" 
                                      required 

                                      >
                        </div>
                        <div class="flex items-center p-6 pt-0">
                        <a onclick ="pay()"
                        
                          class="inline-flex items-center justify-center rounded-md text-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 w-full bg-brand hover:bg-brand-600"
                        >
                          Donate Now
                        </a>
                      </div>

                      </div>
                      <script type="text/javascript">
                        function pay(){

                                  const amount_ = document.getElementById("donateAmountValue").value
                                  var amountValue = amount_;

                                  // Check if the input is not empty and is a number
                                  if (amountValue.trim() !== "" && !isNaN(amountValue)) {
                                      // Input is not empty and is a number
                                      console.log("Valid amount: " + amountValue);
                                  } else {
                                      // Input is empty or not a number
                                      console.log("Invalid amount");
                                       alert ('Please enter a valid amount, thank you')
                                       //return false;
                                  }

                                  var donation = {
                                        "id": -1,
                                        "donation_date":'' ,
                                        "campaign_id": <?php echo $admin_campaigns_form_component_id;?>,
                                        "donation_amount": amountValue,
                                        "payment_method": '',
                                        "createdBy": '<?php echo $_SESSION[APP_SESSION_NAME]['fullname'];?>',
                                        "updatedBy":'',
                                        "createdOn":'',
                                        "updatedOn":'',
                                        "ownerId": '<?php echo $_SESSION[APP_SESSION_NAME]['ownerId'];?>',
                                        "userId": '<?php echo $_SESSION[APP_SESSION_NAME]['userId'];?>',
                                        "appId":'',
                                        "isActive":'',
                                        "isLocked":'',
                                        "isDeleted":'',
                                        "isChanged":'',
                                        "isSynced":'',
                                        "isAdmin":'',
                                        "syncedOn":'',
                                        "oldId":'',
                                        "ownerGuid":'',
                                        "privileges":'',
                                        "guid":'',
                                        "gateway": null
                                };

                                //console.log(donation);
                                //return;

                                //SUCCESS
                                /*
                                        {
                                            "reference": "3389411",
                                            "trans": "3177520975",
                                            "status": "success",
                                            "message": "Approved",
                                            "transaction": "3177520975",
                                            "trxref": "3389411",
                                            "redirecturl": "?trxref=3389411&reference=3389411"
                                          }
                                */

                                    // Make an AJAX request to get the API key from a PHP file
                                  var xhr = new XMLHttpRequest();
                                  xhr.open("GET", "_get_api_key.php", true);
                                  xhr.onreadystatechange = function() {
                                      if (xhr.readyState == 4 && xhr.status == 200) {
                                          // Parse the API key from the response
                                          var apiKey = xhr.responseText.trim();
                                          
                                          // Use the retrieved API key in the Paystack setup
                                          let handler = PaystackPop.setup({
                                              key: apiKey, // Use the retrieved API key
                                              email: '<?php echo $_SESSION[APP_SESSION_NAME]['emailAddress'];?>',// document.getElementById("email-address").value,
                                              amount: amountValue * 100,
                                              ref: '<?php echo APP_TRANS_REF;?>'+donation.campaign_id+'-'+Math.floor((Math.random() * 1000000000) + 1),
                                              custom_fields: {
                                                                "metadata": {
                                                                  "campaign_id": donation.campaign_id,
                                                                  "custom_fields": [
                                                                    {
                                                                      "campaign_title": '<?php echo $admin_campaigns_form_component_donation_title;?>',
                                                                      "campaign_location": '<?php echo $admin_campaigns_form_component_location;?>'
                                                                    }
                                                                  ]
                                                                }
                                                              },
                                              onClose: function(){
                                                  alert('Window closed.');
                                              },
                                              callback: function(response){
                                                  let message = 'Payment complete! Reference: ' + response.reference;
                                                  if(response.status=='success'){
                                                    //donation.donation_date = new getDate()
                                                    donation.donation_amount = amountValue
                                                    donation.isActive = true
                                                    donation.guid = response.reference
                                                    donation.ownerGuid = response.trans
                                                    donation.privileges = JSON.stringify(response)
                                                    
                                                    updateDonations(donation)

                                                  }
                                                  console.log(response)
                                                  console.log(donation);
                                                  //alert(message);
                                                  
                                              }
                                          });

                                          // Open the Paystack payment iframe
                                          handler.openIframe();
                                      }
                                  };
                                  xhr.send();
                              }
                      


                            function updateDonations(donation) {
    

    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    // Set the request method and URL
    xhr.open("POST", "_admin_create_donation_payment_gateway.php", true);
    // Set the content type of the request
    xhr.setRequestHeader("Content-Type", "application/json");

    // Define what happens on successful data submission
    xhr.onreadystatechange = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            // Request was successful, parse the response JSON
            console.log(xhr)
            var responseArray = JSON.parse(xhr.responseText);
            console.log(responseArray); // Do something with the response array
            //alert('iuiouiouoiu')
        } else {
            // Request failed with an error status, handle the error here
            console.error('Request failed with status:', xhr.status);
        }
    };

    // Prepare the data to be sent as JSON
    var jsonData = JSON.stringify(donation);

    // Send the request with the JSON data
    xhr.send(jsonData);
    


}



                      </script>



                    
                   		<!-- href="_admin_donate_now.php?hkj476hkjhjk655665hkhjkhkty55343233444445778hjklhjgcvdfxsesfdfgjkhkljlljljl=<?php echo $admin_campaigns_list_component_datasource[$i]["id"];?>&admin_campaigns_list_component_searchTerm=<?php echo $admin_campaigns_list_component_searchTerm;?>"  -->










                </div>


              </div>
            </div>
          </div>
        <?php } ?>

        </div>
      </div>
    </main>
<?php include_once('_footer.php');?>

<script src="https://js.paystack.co/v1/inline.js"></script>

  </body>
</html>
