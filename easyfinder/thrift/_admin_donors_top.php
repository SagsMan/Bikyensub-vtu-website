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
$page='_admin_donors_top';
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
    //header("location: users_list_page.php");
    //exit();
  }
?>

<?php 
/**VARIABLES
 * NOTES: Used for this component
*/
$users_list_component_datasource= array();
$users_list_component_searchTerm__=array();
//$searchTerm__=array();

$users_list_component_fullname="";
$users_list_component_emailAddress="";
$users_list_component_phoneNo="";
$users_list_component_address="";
$users_list_component_isActive="";

//initialize these component level variables with their page level equivalent
//and then get them again if they are posted/or getted at component level
//HANDLE FORM LEVEL VARS
$users_list_component_errorMessage= "";
$users_list_component_id = -1;
$users_list_component_task= "";
$users_list_component_submittedComponentTitle= "";
$users_list_component_componentToShowName="";
$users_list_component_userId = "";
$users_list_component_ownerId ="";
if(isset($_SESSION[APP_SESSION_NAME]["id"])){
$users_list_component_userId = $_SESSION[APP_SESSION_NAME]["id"];
}
if(isset($_SESSION[APP_SESSION_NAME]["id"])){
$users_list_component_ownerId =$_SESSION[APP_SESSION_NAME]["ownerId"];
}
$users_list_component_searchTerm="";
$users_list_component_multipartComponentToDisplayName="";//this is needed to determine which multipart active component to display

//ini with page level values if enabled$users_list_component_errorMessage= $errorMessage;
$users_list_component_id = $id;
$users_list_component_task= $task;
$users_list_component_submittedComponentTitle= $submittedComponentTitle;
$users_list_component_searchTerm= $searchTerm;

 ?>
<?php 
/**************************************************************/
//VERSION:  
//PARTIAL:  List Based Component Header
/**************************************************************/
?><?php 
  /**
   * POSTS/GETS
   */
  if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST)){?>
<?php 
/**************************************************************/
//VERSION:  
//PARTIAL:  Component POST Search
/**************************************************************/
?><?php 
  /*searchTerm can be an array*/
  if (isset($_POST["users_list_component_searchTerm"]))
  {

    $users_list_component_searchTerm=$_POST["users_list_component_searchTerm"];
    //WIP: this line gave error but en
    //$searchTerm= unserialize( html_entity_decode($searchTerm));
    $users_list_component_searchTerm= unserialize( html_entity_decode($users_list_component_searchTerm));
    //WIP: this line gave error but en

    if(is_array($users_list_component_searchTerm)){
      //from form
      //searchTerm%5B%5D=4&searchTerm%5B%5D=4
    }else{
      //from anchor
      //searchTerm=%5B"6"%2C"4"%5D
      $users_list_component_searchTerm= urldecode( $_POST["users_list_component_searchTerm"] );
      try{
        //is array?
        if(is_array($users_list_component_searchTerm)){
          $users_list_component_searchTerm=json_decode($users_list_component_searchTerm);
        }
      } catch (\PDOException $e) { 
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
      }
    }    

    if(is_array($users_list_component_searchTerm)){
      //print_r($_POST["users_list_component_searchTerm"]);
      //$searchTerm=$_POST["users_list_component_searchTerm"];
      //echo -----array------."\n";
      //print_r($users_list_component_searchTerm);
      for($gc=0;$gc<count($users_list_component_searchTerm);$gc++)
      {
        $users_list_component_searchTerm__[]=sanitizeString_($users_list_component_searchTerm[$gc]);
      }
      $users_list_component_searchTerm= htmlentities( serialize( $users_list_component_searchTerm));
    }else{
      $users_list_component_searchTerm=sanitizeString_($users_list_component_searchTerm);
      //echo -----string------."\n";
      //echo $users_list_component_searchTerm;
    }
  }

  //if (isset($_POST["searchTerm"])){$searchTerm=sanitizeString_($_POST["searchTerm"]);}
  
?><?php 
  }elseif (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET)){ ?>
<?php 
/**************************************************************/
//VERSION:  
//PARTIAL:  Component GET Search
/**************************************************************/
?><?php 
  /*searchTerm can be an array*/
  if (isset($_GET["users_list_component_searchTerm"]))
  {
    
    $users_list_component_searchTerm=$_GET["users_list_component_searchTerm"];
    if(is_array($users_list_component_searchTerm)){
      //from form
      //searchTerm%5B%5D=4&searchTerm%5B%5D=4
    }else{
      //from anchor
      //searchTerm=%5B"6"%2C"4"%5D
      $users_list_component_searchTerm= urldecode( $_GET["users_list_component_searchTerm"] );
      try{
        //is array?
        if(is_array($users_list_component_searchTerm)){
          $users_list_component_searchTerm=json_decode($users_list_component_searchTerm);
        }
      } catch (\PDOException $e) { 
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
      }
    }
    

    if(is_array($users_list_component_searchTerm)){
      //print_r($_GET["searchTerm"]);
      //$searchTerm=$_GET["searchTerm"];
      //echo -----array------."\n";
      //print_r($searchTerm);
      for($gc=0;$gc<count($users_list_component_searchTerm);$gc++)
      {
        $users_list_component_searchTerm__[]=sanitizeString_($users_list_component_searchTerm[$gc]);
      }

      //echo htmlentities( serialize( $users_list_component_searchTerm));
       $users_list_component_searchTerm= htmlentities( serialize( $users_list_component_searchTerm));

    }else{
      $users_list_component_searchTerm=sanitizeString_($users_list_component_searchTerm);
      //echo -----string------."\n";
      //echo $users_list_component_searchTerm;
    }
  }

  

  //if (isset($_GET["searchTerm"])){$searchTerm=sanitizeString_($_GET["searchTerm"]);}

?>
<?php 
}
?>
<?php 
/**************************************************************/
//VERSION:  
//PARTIAL:  Data Source
//TYPE:     table
/**************************************************************/
?>

    <?php 
    /*Prepare SQL*/
    if(!empty($users_list_component_searchTerm))
    {

      $stmt = $pdo->prepare("SELECT  `users`.*, SUM(`donations`.`donation_amount`) AS `donation_total`  FROM `users`  
        INNER JOIN `donations` ON `users`.`id`=`donations`.`userId`  
        WHERE  `users`.`ownerId`=?  AND ( `users`.`fullname` LIKE ?  OR `users`.`emailAddress` LIKE ?  OR `users`.`phoneNo` LIKE ?  OR `users`.`address` LIKE ?  ");
      /*Execute SQL*/
      $stmt->execute([ $ownerId  , "%$users_list_component_searchTerm%","%$users_list_component_searchTerm%","%$users_list_component_searchTerm%","%$users_list_component_searchTerm%"]);

    }
    else
    {

       $stmt = $pdo->prepare("SELECT  `users`.*, SUM(`donations`.`donation_amount`) AS `donation_total`  FROM `users`  
         JOIN `donations` ON `users`.`id`=`donations`.`userId`  
        WHERE  `users`.`ownerId`=? AND `donations`.`ownerId`=? ");
      /*Execute SQL*/
      $stmt->execute([ $ownerId, $ownerId ]);

    }
    

    /*Fetch SQL result*/
    $users_list_component_datasource = $stmt->fetchAll();


    //print_r($users_list_component_datasource);

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
    <title>Thrift Thrust</title>
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
                    aria-controls="radix-:Rlmja:"
                    aria-expanded="false"
                    data-state="closed"
                    data-orientation="vertical"
                    id="radix-:R5mja:"
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
                  id="radix-:Rlmja:"
                  hidden=""
                  role="region"
                  aria-labelledby="radix-:R5mja:"
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
                    <span class="ml-2 font-inter text-2xl">Top 100 Donors</span>
                  </h3>
                </div>
                <div class="p-6 pt-0">
                  <div>
                    <div class="rounded-md border">
                      <div class="w-full overflow-auto">
                        <table class="w-full caption-bottom text-sm">
                          <thead class="[&amp;_tr]:border-b">
                            <tr
                              class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted"
                            >
                              <th
                                class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <div class="sr-only">Image</div>

                              </th>
                              <th
                                class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                Name
                              </th>
                              <th
                                class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                Email
                              </th>
                              <th
                                class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <div class="text-right">Amount</div>
                              </th>
                              <th
                                class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              ></th>
                            </tr>
                          </thead>
                          <tbody class="[&amp;_tr:last-child]:border-0">


                              <?php 
                if( (isset($users_list_component_datasource)) && (isset($users_list_component_datasource[0]['id']))     ){ 
                  for($i=0; $i < count($users_list_component_datasource);$i++)
                  {
              ?>

                            <tr
                              class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted"
                              data-state="false"
                            >
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <div class="flex justify-end">
                                  <span
                                    class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full"
                                    ><span
                                      class="flex h-full w-full items-center justify-center rounded-full bg-muted"
                                      >
                                           <img style="width: 36px;height: 36px;border-radius: 100%;" src="<?php if(!empty($users_list_component_datasource[$i]["logoPath"])){ echo APP_UPLOADS.APP_USERS.$users_list_component_datasource[$i]["logoPath"];}?>">
                                      </span
                                    ></span
                                  >
                                </div>
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <?php echo $users_list_component_datasource[$i]["fullname"];   ?>
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <?php echo $users_list_component_datasource[$i]["emailAddress"];   ?>
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <div class="text-right font-medium">
                                  ₦<?php echo number_format( $users_list_component_datasource[$i]["donation_total"],2);   ?>
                                </div>
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <button
                                  class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-8 w-8 p-0"
                                  type="button"
                                  id="radix-:Ra6crdmja:"
                                  aria-haspopup="menu"
                                  aria-expanded="false"
                                  data-state="closed"
                                >
                                  <span class="sr-only">Open menu</span
                                  ><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="h-4 w-4"
                                  >
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                  </svg>
                                </button>
                              </td>
                            </tr>

                          <?php } 
                        }
                          ?>

                            <!--tr
                              class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted"
                              data-state="false"
                            >
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <div class="flex justify-end">
                                  <span
                                    class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full"
                                    ><span
                                      class="flex h-full w-full items-center justify-center rounded-full bg-muted"
                                      >CN</span
                                    ></span
                                  >
                                </div>
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                Liam Johnson
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                liam.johnson@example.com
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <div class="text-right font-medium">
                                  ₦1,000.00
                                </div>
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <button
                                  class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-8 w-8 p-0"
                                  type="button"
                                  id="radix-:Raacrdmja:"
                                  aria-haspopup="menu"
                                  aria-expanded="false"
                                  data-state="closed"
                                >
                                  <span class="sr-only">Open menu</span
                                  ><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="h-4 w-4"
                                  >
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                  </svg>
                                </button>
                              </td>
                            </tr>
                            <tr
                              class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted"
                              data-state="false"
                            >
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <div class="flex justify-end">
                                  <span
                                    class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full"
                                    ><span
                                      class="flex h-full w-full items-center justify-center rounded-full bg-muted"
                                      >CN</span
                                    ></span
                                  >
                                </div>
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                Ethan Thompson
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                ethan.thompson@fakemail.net
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <div class="text-right font-medium">
                                  ₦1,500.00
                                </div>
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <button
                                  class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-8 w-8 p-0"
                                  type="button"
                                  id="radix-:Raecrdmja:"
                                  aria-haspopup="menu"
                                  aria-expanded="false"
                                  data-state="closed"
                                >
                                  <span class="sr-only">Open menu</span
                                  ><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="h-4 w-4"
                                  >
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                  </svg>
                                </button>
                              </td>
                            </tr>
                            <tr
                              class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted"
                              data-state="false"
                            >
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <div class="flex justify-end">
                                  <span
                                    class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full"
                                    ><span
                                      class="flex h-full w-full items-center justify-center rounded-full bg-muted"
                                      >CN</span
                                    ></span
                                  >
                                </div>
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                Liam Johnson
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                liam.johnson@example.com
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <div class="text-right font-medium">
                                  ₦1,000.00
                                </div>
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <button
                                  class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-8 w-8 p-0"
                                  type="button"
                                  id="radix-:Raicrdmja:"
                                  aria-haspopup="menu"
                                  aria-expanded="false"
                                  data-state="closed"
                                >
                                  <span class="sr-only">Open menu</span
                                  ><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="h-4 w-4"
                                  >
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                  </svg>
                                </button>
                              </td>
                            </tr>
                            <tr
                              class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted"
                              data-state="false"
                            >
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <div class="flex justify-end">
                                  <span
                                    class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full"
                                    ><span
                                      class="flex h-full w-full items-center justify-center rounded-full bg-muted"
                                      >CN</span
                                    ></span
                                  >
                                </div>
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                Noah Rodriguez
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                noah.rodriguez@emailservice.com
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <div class="text-right font-medium">
                                  ₦180.00
                                </div>
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <button
                                  class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-8 w-8 p-0"
                                  type="button"
                                  id="radix-:Ramcrdmja:"
                                  aria-haspopup="menu"
                                  aria-expanded="false"
                                  data-state="closed"
                                >
                                  <span class="sr-only">Open menu</span
                                  ><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="h-4 w-4"
                                  >
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                  </svg>
                                </button>
                              </td>
                            </tr>
                            <tr
                              class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted"
                              data-state="false"
                            >
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <div class="flex justify-end">
                                  <span
                                    class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full"
                                    ><span
                                      class="flex h-full w-full items-center justify-center rounded-full bg-muted"
                                      >CN</span
                                    ></span
                                  >
                                </div>
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                Liam Johnson
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                liam.johnson@example.com
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <div class="text-right font-medium">
                                  ₦1,000.00
                                </div>
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <button
                                  class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-8 w-8 p-0"
                                  type="button"
                                  id="radix-:Raqcrdmja:"
                                  aria-haspopup="menu"
                                  aria-expanded="false"
                                  data-state="closed"
                                >
                                  <span class="sr-only">Open menu</span
                                  ><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="h-4 w-4"
                                  >
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                  </svg>
                                </button>
                              </td>
                            </tr>
                            <tr
                              class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted"
                              data-state="false"
                            >
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <div class="flex justify-end">
                                  <span
                                    class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full"
                                    ><span
                                      class="flex h-full w-full items-center justify-center rounded-full bg-muted"
                                      >CN</span
                                    ></span
                                  >
                                </div>
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                Noah Rodriguez
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                noah.rodriguez@emailservice.com
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <div class="text-right font-medium">
                                  ₦180.00
                                </div>
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <button
                                  class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-8 w-8 p-0"
                                  type="button"
                                  id="radix-:Raucrdmja:"
                                  aria-haspopup="menu"
                                  aria-expanded="false"
                                  data-state="closed"
                                >
                                  <span class="sr-only">Open menu</span
                                  ><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="h-4 w-4"
                                  >
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                  </svg>
                                </button>
                              </td>
                            </tr>
                            <tr
                              class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted"
                              data-state="false"
                            >
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <div class="flex justify-end">
                                  <span
                                    class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full"
                                    ><span
                                      class="flex h-full w-full items-center justify-center rounded-full bg-muted"
                                      >CN</span
                                    ></span
                                  >
                                </div>
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                Noah Rodriguez
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                noah.rodriguez@emailservice.com
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <div class="text-right font-medium">
                                  ₦180.00
                                </div>
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <button
                                  class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-8 w-8 p-0"
                                  type="button"
                                  id="radix-:Rb2crdmja:"
                                  aria-haspopup="menu"
                                  aria-expanded="false"
                                  data-state="closed"
                                >
                                  <span class="sr-only">Open menu</span
                                  ><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="h-4 w-4"
                                  >
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                  </svg>
                                </button>
                              </td>
                            </tr>
                            <tr
                              class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted"
                              data-state="false"
                            >
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <div class="flex justify-end">
                                  <span
                                    class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full"
                                    ><span
                                      class="flex h-full w-full items-center justify-center rounded-full bg-muted"
                                      >CN</span
                                    ></span
                                  >
                                </div>
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                Noah Rodriguez
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                noah.rodriguez@emailservice.com
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <div class="text-right font-medium">
                                  ₦180.00
                                </div>
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <button
                                  class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-8 w-8 p-0"
                                  type="button"
                                  id="radix-:Rb6crdmja:"
                                  aria-haspopup="menu"
                                  aria-expanded="false"
                                  data-state="closed"
                                >
                                  <span class="sr-only">Open menu</span
                                  ><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="h-4 w-4"
                                  >
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                  </svg>
                                </button>
                              </td>
                            </tr>
                            <tr
                              class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted"
                              data-state="false"
                            >
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <div class="flex justify-end">
                                  <span
                                    class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full"
                                    ><span
                                      class="flex h-full w-full items-center justify-center rounded-full bg-muted"
                                      >CN</span
                                    ></span
                                  >
                                </div>
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                Liam Johnson
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                liam.johnson@example.com
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <div class="text-right font-medium">
                                  ₦1,000.00
                                </div>
                              </td>
                              <td
                                class="p-2 align-middle [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]"
                              >
                                <button
                                  class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-8 w-8 p-0"
                                  type="button"
                                  id="radix-:Rbacrdmja:"
                                  aria-haspopup="menu"
                                  aria-expanded="false"
                                  data-state="closed"
                                >
                                  <span class="sr-only">Open menu</span
                                  ><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="h-4 w-4"
                                  >
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                  </svg>
                                </button>
                              </td>
                            </tr-->
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="flex items-center justify-end space-x-2 py-4">
                      <button
                        class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-8 rounded-md px-3 text-xs"
                        disabled=""
                      >
                        Previous</button
                      ><button
                        class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-8 rounded-md px-3 text-xs"
                      >
                        Next
                      </button>
                    </div>
                  </div>
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
