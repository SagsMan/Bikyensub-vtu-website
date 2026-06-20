<?php 
session_start();

include_once "ini.php";
include_once "ini_custom.php";
include_once "functions.php";
include_once "functions_custom.php";
include_once "functions_customui.php";


$admin_campaigns_list_component_searchTerm='';
  /*searchTerm can be an array*/
  if (isset($_POST["admin_campaigns_list_component_searchTerm"]))
  {

    $admin_campaigns_list_component_searchTerm=$_POST["admin_campaigns_list_component_searchTerm"];
    //WIP: this line gave error but en
    //$searchTerm= unserialize( html_entity_decode($searchTerm));
    $admin_campaigns_list_component_searchTerm= unserialize( html_entity_decode($admin_campaigns_list_component_searchTerm));
    //WIP: this line gave error but en

    if(is_array($admin_campaigns_list_component_searchTerm)){
      //from form
      //searchTerm%5B%5D=4&searchTerm%5B%5D=4
    }else{
      //from anchor
      //searchTerm=%5B"6"%2C"4"%5D
      $admin_campaigns_list_component_searchTerm= urldecode( $_POST["admin_campaigns_list_component_searchTerm"] );
      try{
        //is array?
        if(is_array($admin_campaigns_list_component_searchTerm)){
          $admin_campaigns_list_component_searchTerm=json_decode($admin_campaigns_list_component_searchTerm);
        }
      } catch (\PDOException $e) { 
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
      }
    }    

    if(is_array($admin_campaigns_list_component_searchTerm)){
      //print_r($_POST["admin_campaigns_list_component_searchTerm"]);
      //$searchTerm=$_POST["admin_campaigns_list_component_searchTerm"];
      //echo -----array------."\n";
      //print_r($admin_campaigns_list_component_searchTerm);
      for($gc=0;$gc<count($admin_campaigns_list_component_searchTerm);$gc++)
      {
        $admin_campaigns_list_component_searchTerm__[]=sanitizeString_($admin_campaigns_list_component_searchTerm[$gc]);
      }
      $admin_campaigns_list_component_searchTerm= htmlentities( serialize( $admin_campaigns_list_component_searchTerm));
    }else{
      $admin_campaigns_list_component_searchTerm=sanitizeString_($admin_campaigns_list_component_searchTerm);
      //echo -----string------."\n";
      //echo $admin_campaigns_list_component_searchTerm;
    }
  }else /*searchTerm can be an array*/
  if (isset($_GET["admin_campaigns_list_component_searchTerm"]))
  {
    
    $admin_campaigns_list_component_searchTerm=$_GET["admin_campaigns_list_component_searchTerm"];
    if(is_array($admin_campaigns_list_component_searchTerm)){
      //from form
      //searchTerm%5B%5D=4&searchTerm%5B%5D=4
    }else{
      //from anchor
      //searchTerm=%5B"6"%2C"4"%5D
      $admin_campaigns_list_component_searchTerm= urldecode( $_GET["admin_campaigns_list_component_searchTerm"] );
      try{
        //is array?
        if(is_array($admin_campaigns_list_component_searchTerm)){
          $admin_campaigns_list_component_searchTerm=json_decode($admin_campaigns_list_component_searchTerm);
        }
      } catch (\PDOException $e) { 
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
      }
    }
    

    if(is_array($admin_campaigns_list_component_searchTerm)){
      //print_r($_GET["searchTerm"]);
      //$searchTerm=$_GET["searchTerm"];
      //echo -----array------."\n";
      //print_r($searchTerm);
      for($gc=0;$gc<count($admin_campaigns_list_component_searchTerm);$gc++)
      {
        $admin_campaigns_list_component_searchTerm__[]=sanitizeString_($admin_campaigns_list_component_searchTerm[$gc]);
      }

      //echo htmlentities( serialize( $admin_campaigns_list_component_searchTerm));
       $admin_campaigns_list_component_searchTerm= htmlentities( serialize( $admin_campaigns_list_component_searchTerm));

    }else{
      $admin_campaigns_list_component_searchTerm=sanitizeString_($admin_campaigns_list_component_searchTerm);
      //echo -----string------."\n";
      //echo $admin_campaigns_list_component_searchTerm;
    }
  }

  //if (isset($_POST["searchTerm"])){$searchTerm=sanitizeString_($_POST["searchTerm"]);}
  



if (!isset($_SESSION[APP_SESSION_NAME]) ){
//  echo 'iiii';exit();
      header("location: _public_campaigns.php?admin_campaigns_list_component_searchTerm=".$admin_campaigns_list_component_searchTerm);
      exit();
}

if ($_SESSION[APP_SESSION_NAME]["isAdmin"] !=1 ){
      header("location: dashboard.php");
      exit();
}

$page='_admin_campaigns';

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
    //header("location: admin_campaigns_list_page.php");
    //exit();
  }
  ?>
<?php 
/**VARIABLES
 * NOTES: Used for this component
*/
$admin_campaigns_list_component_datasource= array();
$admin_campaigns_list_component_searchTerm__=array();
//$searchTerm__=array();

$admin_campaigns_list_component_poster="";
$admin_campaigns_list_component_donation_title="";
$admin_campaigns_list_component_video_url="";
$admin_campaigns_list_component_category="";
$admin_campaigns_list_component_donate_goal="";
$admin_campaigns_list_component_current_amount_raised="";
$admin_campaigns_list_component_location="";
$admin_campaigns_list_component_about_the_donation="";
$admin_campaigns_list_component_isActive="";

//initialize these component level variables with their page level equivalent
//and then get them again if they are posted/or getted at component level
//HANDLE FORM LEVEL VARS
$admin_campaigns_list_component_errorMessage= "";
$admin_campaigns_list_component_id = -1;
$admin_campaigns_list_component_task= "";
$admin_campaigns_list_component_submittedComponentTitle= "";
$admin_campaigns_list_component_componentToShowName="";
$admin_campaigns_list_component_userId = "";
$admin_campaigns_list_component_ownerId ="";
if(isset($_SESSION[APP_SESSION_NAME]["id"])){
$admin_campaigns_list_component_userId = $_SESSION[APP_SESSION_NAME]["id"];
}
if(isset($_SESSION[APP_SESSION_NAME]["id"])){
$admin_campaigns_list_component_ownerId =$_SESSION[APP_SESSION_NAME]["ownerId"];
}
$admin_campaigns_list_component_searchTerm="";
$admin_campaigns_list_component_multipartComponentToDisplayName="";//this is needed to determine which multipart active component to display

//ini with page level values if enabled$admin_campaigns_list_component_errorMessage= $errorMessage;
$admin_campaigns_list_component_id = $id;
$admin_campaigns_list_component_task= $task;
$admin_campaigns_list_component_submittedComponentTitle= $submittedComponentTitle;
$admin_campaigns_list_component_searchTerm= $searchTerm;

 ?>




<?php 
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
  if (isset($_POST["admin_campaigns_list_component_searchTerm"]))
  {

    $admin_campaigns_list_component_searchTerm=$_POST["admin_campaigns_list_component_searchTerm"];
    //WIP: this line gave error but en
    //$searchTerm= unserialize( html_entity_decode($searchTerm));
    $admin_campaigns_list_component_searchTerm= unserialize( html_entity_decode($admin_campaigns_list_component_searchTerm));
    //WIP: this line gave error but en

    if(is_array($admin_campaigns_list_component_searchTerm)){
      //from form
      //searchTerm%5B%5D=4&searchTerm%5B%5D=4
    }else{
      //from anchor
      //searchTerm=%5B"6"%2C"4"%5D
      $admin_campaigns_list_component_searchTerm= urldecode( $_POST["admin_campaigns_list_component_searchTerm"] );
      try{
        //is array?
        if(is_array($admin_campaigns_list_component_searchTerm)){
          $admin_campaigns_list_component_searchTerm=json_decode($admin_campaigns_list_component_searchTerm);
        }
      } catch (\PDOException $e) { 
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
      }
    }    

    if(is_array($admin_campaigns_list_component_searchTerm)){
      //print_r($_POST["admin_campaigns_list_component_searchTerm"]);
      //$searchTerm=$_POST["admin_campaigns_list_component_searchTerm"];
      //echo -----array------."\n";
      //print_r($admin_campaigns_list_component_searchTerm);
      for($gc=0;$gc<count($admin_campaigns_list_component_searchTerm);$gc++)
      {
        $admin_campaigns_list_component_searchTerm__[]=sanitizeString_($admin_campaigns_list_component_searchTerm[$gc]);
      }
      $admin_campaigns_list_component_searchTerm= htmlentities( serialize( $admin_campaigns_list_component_searchTerm));
    }else{
      $admin_campaigns_list_component_searchTerm=sanitizeString_($admin_campaigns_list_component_searchTerm);
      //echo -----string------."\n";
      //echo $admin_campaigns_list_component_searchTerm;
    }
  }

  //if (isset($_POST["searchTerm"])){$searchTerm=sanitizeString_($_POST["searchTerm"]);}
  
?>

<?php 
  }elseif (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET)){ ?>
<?php 
/**************************************************************/
//VERSION:  
//PARTIAL:  Component GET Search
/**************************************************************/
?><?php 
  /*searchTerm can be an array*/
  if (isset($_GET["admin_campaigns_list_component_searchTerm"]))
  {
    
    $admin_campaigns_list_component_searchTerm=$_GET["admin_campaigns_list_component_searchTerm"];
    if(is_array($admin_campaigns_list_component_searchTerm)){
      //from form
      //searchTerm%5B%5D=4&searchTerm%5B%5D=4
    }else{
      //from anchor
      //searchTerm=%5B"6"%2C"4"%5D
      $admin_campaigns_list_component_searchTerm= urldecode( $_GET["admin_campaigns_list_component_searchTerm"] );
      try{
        //is array?
        if(is_array($admin_campaigns_list_component_searchTerm)){
          $admin_campaigns_list_component_searchTerm=json_decode($admin_campaigns_list_component_searchTerm);
        }
      } catch (\PDOException $e) { 
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
      }
    }
    

    if(is_array($admin_campaigns_list_component_searchTerm)){
      //print_r($_GET["searchTerm"]);
      //$searchTerm=$_GET["searchTerm"];
      //echo -----array------."\n";
      //print_r($searchTerm);
      for($gc=0;$gc<count($admin_campaigns_list_component_searchTerm);$gc++)
      {
        $admin_campaigns_list_component_searchTerm__[]=sanitizeString_($admin_campaigns_list_component_searchTerm[$gc]);
      }

      //echo htmlentities( serialize( $admin_campaigns_list_component_searchTerm));
       $admin_campaigns_list_component_searchTerm= htmlentities( serialize( $admin_campaigns_list_component_searchTerm));

    }else{
      $admin_campaigns_list_component_searchTerm=sanitizeString_($admin_campaigns_list_component_searchTerm);
      //echo -----string------."\n";
      //echo $admin_campaigns_list_component_searchTerm;
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

    if(1==9){
    /*Prepare SQL*/
    if(!empty($admin_campaigns_list_component_searchTerm))
    {

      $stmt = $pdo->prepare("SELECT  *  FROM `campaigns`  WHERE  `ownerId`=? AND `donation_title` LIKE ?  OR `category` LIKE ?  OR `donate_goal` LIKE ?  OR `location` LIKE ?  OR `about_the_donation` LIKE ?   ");
      /*Execute SQL*/
      $stmt->execute([ $ownerId  , "%$admin_campaigns_list_component_searchTerm%","%$admin_campaigns_list_component_searchTerm%","%$admin_campaigns_list_component_searchTerm%","%$admin_campaigns_list_component_searchTerm%","%$admin_campaigns_list_component_searchTerm%"]);

    }
    else
    {

      $stmt = $pdo->prepare("SELECT  *  FROM `campaigns`  WHERE  `ownerId`=? ");
      /*Execute SQL*/
      $stmt->execute([ $ownerId ]);

    }
    

    /*Fetch SQL result*/
    $admin_campaigns_list_component_datasource = $stmt->fetchAll();
}
    ?>


    <?php 
/**************************************************************/
//PAGINATION
//
/**************************************************************/

// Number of rows to fetch per page
$rowsPerPage = 4;

// Get current page number from URL, default to 1 if not set
$pageNumber = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset for the query
$offset = ($pageNumber - 1) * $rowsPerPage;

// Fetch data from MySQL database
$stmt = $pdo->prepare("SELECT  *  FROM `campaigns`  WHERE  `ownerId`=?  LIMIT $offset, $rowsPerPage ");
$stmt->execute([ $ownerId ]);
$admin_campaigns_list_component_datasource = $stmt->fetchAll();

// Get total number of rows in the table
$totalRows=0;
$stmt = $pdo->prepare("SELECT COUNT(*) as `count` from `campaigns`  WHERE  `ownerId`=?");
$stmt->execute([ $ownerId ]);
$totalRows_ = $stmt->fetchAll();
if($totalRows_){
  $totalRows = $totalRows_[0]['count'];
}

// Calculate total number of pages
$totalPages = ceil($totalRows / $rowsPerPage);

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
    <title>Campaigns - <?php echo APP_FULLNAME;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="/favicon.ico" type="image/x-icon" sizes="any" />
    <meta name="next-size-adjust" />
    <!--script
      src="/_next/static/chunks/polyfills-78c92fac7aa8fdd8.js"
      nomodule=""
    ></script-->

    <link rel="stylesheet" type="text/css" href="theme/vendors/bootstrap-icons-1.10.5/font/bootstrap-icons.min.css">       
<link
      rel="preload"
      as="font"
      href="theme/vendors/bootstrap-icons-1.10.5/font/bootstrap-icons.woff2"
      crossorigin=""
      type="font/woff2"
    />

<style type="text/css">
  .embla__viewport {
    padding: 1rem 0;
    overflow: hidden;
}

.embla {
  overflow: hidden;
}
.embla__container {
  display: flex;
}
.embla__slidex {
  flex: 0 0 100%;
  min-width: 0;
}

</style>


<script src="https://unpkg.com/embla-carousel/embla-carousel.umd.js"></script>
<script src="https://unpkg.com/embla-carousel-autoplay/embla-carousel-autoplay.umd.js"></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {

  var emblaNode = document.querySelector('.embla')
  var options = { loop: true, dragFree: true }
  var plugins = [EmblaCarouselAutoplay()] // Plugins

  var embla = EmblaCarousel(emblaNode, options, plugins)

   // Embla Carousel Dots Initialization
            const dotsContainer = document.querySelector('.embla__dots');
            const dots = Array.from(embla.scrollSnapList()).map(() => {
                const dot = document.createElement('button');
                dot.classList.add('embla__dot');
                dotsContainer.appendChild(dot);
                return dot;
            });

            // Update dot styling on scroll
            embla.on('select', () => {
                dots.forEach((dot, index) => {
                    index === embla.selectedScrollSnap()
                        ? dot.classList.add('is-selected')
                        : dot.classList.remove('is-selected');
                });
            });

              // Add click event listener to dots
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            embla.scrollTo(index); // Scroll to the corresponding slide
        });
    });

  });



</script>



    
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
                  <h3 class="font-semibold tracking-tight font-inter text-2xl">
                    Campaigns
                  </h3>
                </div>
                <div class="p-6 pt-0">
                  <p
                    class="font-inter leading-7 [&amp;:not(:first-child)]:mt-6"
                  >
                    All donations made to campaigns are sent directly to the
                    campaign
                  </p>
                  <div
                    class="mt-4 grid gap-4 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4"
                  >

                   <?php 
                if($admin_campaigns_list_component_datasource){ 
                  for($i=0; $i < count($admin_campaigns_list_component_datasource);$i++)
                  {
                     $current_amount_raised=getTotalDonationForProject($pdo,$admin_campaigns_list_component_datasource[$i]["id"]); 
              ?>

                    <div
                      class="rounded-xl border bg-card text-card-foreground overflow-hidden shadow-md"
                    >
                      <div class="h-36 w-full overflow-hidden">
                        <img
                          alt=""
                          loading="lazy"
                          width="300"
                          height="100"
                          decoding="async"
                          data-nimg="1"
                          class="w-full bg-cover"
                          style="color: transparent"
                         
                          src="<?php echo APP_UPLOADS.APP_DOCUMENTS.$admin_campaigns_list_component_datasource[$i]["poster"];?>"
                        />
                      </div>
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
                          ><span class="ml-2 font-inter text-2xl"><?php echo $admin_campaigns_list_component_datasource[$i]["category"];   ?></span>
                        </h3>
                      </div>

                      <div class="p-6 pt-4">
                        <h3
                          class="mb-2 scroll-m-20 font-inter text-xl font-semibold tracking-tight"
                        >
                          <?php 
                          echo limitCharacters( $admin_campaigns_list_component_datasource[$i]["donation_title"],15);   
                          ?>
                        </h3>
                        <p
                          class="font-inter text-sm font-medium leading-5 text-gray-500"
                        >
                          ₦<?php echo number_format( $admin_campaigns_list_component_datasource[$i]["donate_goal"],2);   ?>
                        </p>
                        <p
                          class="font-inter text-sm font-medium leading-5 text-gray-500"
                        >
                          raised ₦<?php echo number_format( $current_amount_raised, 2);   ?>
                        </p>
                        <!--p
                          class="font-inter text-sm font-medium leading-5 text-gray-500"
                        >
                          20%
                        </p-->
                      </div>
                      <?php if ($_SESSION[APP_SESSION_NAME]['id']==$admin_campaigns_list_component_datasource[$i]["userId"]) {?>
                      <div class="flexx items-center p-6 pt-0">
                        <a 
                        href="_admin_campaign_view.php?hkj476hkjhjk655665hkhjkhkty55343233444445778hjklhjgcvdfxsesfdfgjkhkljlljljl=<?php echo $admin_campaigns_list_component_datasource[$i]["id"];?>&admin_campaigns_list_component_searchTerm=<?php echo $admin_campaigns_list_component_searchTerm;?>" 
                          class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 my-2 w-full bg-brand hover:bg-brand-600"
                        >
                          Check it now
                        </a>
                        <a 
                        href="_admin_create_donation.php?id=<?php echo $admin_campaigns_list_component_datasource[$i]["id"];?>&admin_campaigns_list_component_searchTerm=<?php echo $admin_campaigns_list_component_searchTerm;?>&task=edit" 
                          class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 w-full bg-brand hover:bg-brand-600"
                        >
                          Edit
                        </a>
                        </div>
                      <?php }else {?>

                        <div class="flex items-center p-6 pt-0">
                        <a 
                        href="_admin_campaign_view.php?hkj476hkjhjk655665hkhjkhkty55343233444445778hjklhjgcvdfxsesfdfgjkhkljlljljl=<?php echo $admin_campaigns_list_component_datasource[$i]["id"];?>&admin_campaigns_list_component_searchTerm=<?php echo $admin_campaigns_list_component_searchTerm;?>" 
                          class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 w-full bg-brand hover:bg-brand-600"
                        >
                          Check it now
                        </a>
                        
                        </div>

                      <?php } ?>
                      
                    </div>

                  <?php }
                }

                  ?>
                   
                  </div>
                </div>


                
                <!-- Pagination -->

                <div class="items-center p-6 pt-0 flex justify-center">
                  <div class="flex items-center gap-2">
                    <button
                      class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-9 w-9"
                      disabled=""
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
                        class="lucide lucide-chevron-left"
                      >
                        <path d="m15 18-6-6 6-6"></path>
                      </svg>
                    </button>

                       <?php
                          // Generate pagination buttons
                          for ($i = 1; $i <= $totalPages; $i++) {
                $activeClass = $i == $pageNumber ? 'bg-brand-500 text-white' : 'bg-background hover:bg-accent hover:text-accent-foreground';
                echo "<a href='?page=$i' class='px-4 py-2 mx-2 rounded-md text-sm font-medium transition-colors focus:outline-none focus:ring focus:ring-brand-200 $activeClass'>$i</a>";
            }
            ?>

                    <!--button
                      class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-input shadow-sm h-9 w-9 user-select-none bg-brand-500 text-white hover:bg-brand-600 hover:text-white"
                    >
                      1
                    </button-->

                    <button
                      class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-9 w-9"
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
                        class="lucide lucide-chevron-right"
                      >
                        <path d="m9 18 6-6-6-6"></path>
                      </svg>
                    </button>
                  </div>
                </div>

                <!-- Pagination -->

              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <?php include_once('_footer.php');?>
  </body>
</html>
