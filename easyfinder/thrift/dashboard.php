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
      //header("location: dashboard.php");
  }else{
    header("location: _admin_dashboard.php");
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
    //header("location: admin_dashboard_page.php");
    //exit();
  }
?>
<?php 
/**VARIABLES*/
$total =0;
 $donations=array();
?><?php try {
      $stmt = $pdo->prepare("SELECT COUNT(*) AS `total` FROM `donations`  WHERE `ownerId`=?  ");
      $stmt->execute([$_SESSION[APP_SESSION_NAME]["ownerId"]]);
      $donations = $stmt->fetchAll();     
    } catch (\PDOException $e) {
        $errorMessage .= "<b>Error loading users</b><br>";
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }?><?php 
if(count($donations)>0){
  if(isset($donations[0]["total"])){
$donations_total = $donations[0]["total"];

}
}

$total =0;
 $campaigns=array();
?><?php try {
      $stmt = $pdo->prepare("SELECT COUNT(*) AS `total` FROM `campaigns`  WHERE `ownerId`=?  ");
      $stmt->execute([$_SESSION[APP_SESSION_NAME]["ownerId"]]);
      $campaigns = $stmt->fetchAll();     
    } catch (\PDOException $e) {
        $errorMessage .= "<b>Error loading campaigns</b><br>";
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }?><?php 
if(count($campaigns)>0){
  if(isset($campaigns[0]["total"])){
$capmpaigns_total = $campaigns[0]["total"];


}
}


$total =0;
 $users=array();
?><?php try {
      $stmt = $pdo->prepare("SELECT COUNT(*) AS `total` FROM `users`  WHERE `ownerId`=?  ");
      $stmt->execute([$_SESSION[APP_SESSION_NAME]["ownerId"]]);
      $users = $stmt->fetchAll();     
    } catch (\PDOException $e) {
        $errorMessage .= "<b>Error loading users</b><br>";
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }?><?php 
if(count($users)>0){
  if(isset($users[0]["total"])){
$users_total = $users[0]["total"];

}
}


$total =0;
 $deposits=array();
?><?php try {
      $stmt = $pdo->prepare("SELECT COUNT(*) AS `total` FROM `deposits`  WHERE `ownerId`=?  ");
      $stmt->execute([$_SESSION[APP_SESSION_NAME]["ownerId"]]);
      $deposits = $stmt->fetchAll();     
    } catch (\PDOException $e) {
        $errorMessage .= "<b>Error loading deposits</b><br>";
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }?><?php 
if(count($deposits)>0){
  if(isset($deposits[0]["total"])){
$deposits_total = $deposits[0]["total"];

}}


$total =0;
 $withdrawals=array();
?><?php try {
      $stmt = $pdo->prepare("SELECT COUNT(*) AS `total` FROM `withdrawals`  WHERE `ownerId`=?  ");
      $stmt->execute([$_SESSION[APP_SESSION_NAME]["ownerId"]]);
      $withdrawals = $stmt->fetchAll();     
    } catch (\PDOException $e) {
        $errorMessage .= "<b>Error loading withdrawals</b><br>";
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }?><?php 
if(count($withdrawals)>0){
  if(isset($withdrawals[0]["total"])){
$withdrawals_total = $withdrawals[0]["total"];

}}




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
    <title>Thrift Thrust</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="/favicon.ico" type="image/x-icon" sizes="any" />
    <meta name="next-size-adjust" />
    <!--script
      src="_next/static/chunks/polyfills-78c92fac7aa8fdd8.js"
      nomodule=""
    ></script-->
  </head>
  <body class="__variable_20951f __variable_9bfd88 bg-[#f98727]">

    <header class="z-40 w-full border-b bg-white">
      <div
        class="mx-auto flex h-20 max-w-7xl items-center gap-6 px-6 md:h-24 lg:gap-12 lg:px-24"
      >
        <a href="/"
          ><h2
            class="scroll-m-20 pb-2 font-inter text-xl font-semibold md:text-2xl"
          >
            <?php echo APP_TITLE;?>
          </h2></a
        >
        <div class="hidden px-6 lg:block">
          <input
            class="flex h-9 w-full rounded-md border border-input px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 max-w-[550px] bg-slate-50"
            placeholder="Search here..."
          />
        </div>
        <button
          class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-9 w-9 ml-auto"
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
            class="lucide lucide-menu"
          >
            <line x1="4" x2="20" y1="12" y2="12"></line>
            <line x1="4" x2="20" y1="6" y2="6"></line>
            <line x1="4" x2="20" y1="18" y2="18"></line>
          </svg>
        </button>
      </div>
    </header>
    <main>
      <div class="space-y-6 bg-gray-100 p-2 pb-16 md:p-8">
        <div class="flex flex-col lg:flex-row lg:space-y-0">
          <div class="mb-2 block lg:hidden">
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
          </div>
          <aside
            class="hidden rounded-lg border bg-white p-2 shadow-sm md:p-4 lg:block lg:w-1/4"
          >
            <nav class="flex flex-col flex-nowrap lg:space-y-2">
              <a
                class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 h-9 px-4 py-2 bg-orange-500 text-white hover:bg-orange-400 hover:text-white justify-start text-[15px]"
                href="/dashboard"
                >Dashboard</a
              ><a
                class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 hover:bg-muted hover:underline justify-start text-[15px]"
                href="/donors"
                >Donors</a
              >
              <div class="flex flex-col">
                <a
                  class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 hover:bg-muted hover:underline justify-start text-[15px]"
                  href="donations_list_page.php"
                  >Donations</a
                >
                
                <div class="flex flex-col pl-6">
                  <a
                    class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 rounded-l-none border-l border-gray-300 hover:bg-muted hover:underline justify-start text-[15px]"
                    href="campaigns_list_page.php"
                    >Create Donation</a
                  >
                </div>
              </div>
              <div class="flex flex-col">
                <a
                  class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 hover:bg-muted hover:underline justify-start text-[15px]"
                  href="withdrawals_list_page.php"
                  >Withdrawals</a
                >
                <div class="flex flex-col pl-6">
                  <a
                    class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 rounded-l-none border-l border-gray-300 hover:bg-muted hover:underline justify-start text-[15px]" 
                    href="" 
                    onlick="alets();"
                    >Withdrawals Configure</a
                  ><script type="text/javascript">function alets(event){event.preventDefault();alert('Work in Progress');}</script>
                </div>
              </div>
              <a
                class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 hover:bg-muted hover:underline justify-start text-[15px]"
                href="/campaigns"
                >Campaigns</a
              ><a
                class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 hover:bg-muted hover:underline justify-start text-[15px]"
                href="/organization/about"
                >About Organization</a
              ><a
                class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 hover:bg-muted hover:underline justify-start text-[15px]"
                href="/organization/status"
                >Status</a
              ><a
                class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 hover:bg-muted hover:underline justify-start text-[15px]"
                href="/docs"
                >Documentation</a
              ><a
                class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 hover:bg-muted hover:underline justify-start text-[15px]"
                href="/account"
                >Account</a
              ><a
                class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 hover:bg-muted hover:underline justify-start text-[15px]"
                href="/account/settings"
                >Settings</a
              >
            </nav>
          </aside>
          <div class="flex-1">
            <div class="h-full space-y-6 lg:pl-4">
              <div class="grid gap-2 lg:grid-cols-2 lg:grid-rows-2">
               

                <!-- CHARTS -->
                <!--div
                  class="rounded-xl border bg-card text-card-foreground row-span-2 shadow-sm"
                >
                  <div class="p-4">
                    <div
                      class="recharts-responsive-container"
                      style="width: 100%; height: 350px; min-width: 0"
                    ></div>
                  </div>
                </div-->


                <!--USERS-->
                <div
                  class="rounded-xl border bg-card text-card-foreground shadow-sm"
                >
                  <div class="flex flex-col space-y-1.5 p-6">
                    <h3
                      class="font-semibold leading-none tracking-tight flex items-center"
                    >
                      <!--img
                        alt="Svg Icon"
                        loading="lazy"
                        width="50"
                        height="50"
                        decoding="async"
                        data-nimg="1"
                        style="color: transparent"
                        src="/donation-1.svg"
                      /-->
                      <i class="mdi mdi-mdi mdi-pig menu-icon"></i>
                      <span class="ml-2 font-inter text-2xl"><?php echo $users_total ;?></span>
                    </h3>
                  </div>
                  <div class="p-6 pt-0">
                    <p class="font-inter text-xl font-bold">Users</p>
                  </div>
                </div>


                <!--CAMPAIGNS-->
                <div
                  class="rounded-xl border bg-card text-card-foreground shadow-sm"
                >
                  <div class="flex flex-col space-y-1.5 p-6">
                    <h3
                      class="font-semibold leading-none tracking-tight flex items-center"
                    >
                      <!--img
                        alt="Svg Icon"
                        loading="lazy"
                        width="50"
                        height="50"
                        decoding="async"
                        data-nimg="1"
                        style="color: transparent"
                        src="/donation-1.svg"
                      /-->
                      <i class="mdi mdi-mdi mdi-pig menu-icon"></i>
                      <span class="ml-2 font-inter text-2xl">N<?php echo number_format($capmpaigns_total,2) ;?></span>
                    </h3>
                  </div>
                  <div class="p-6 pt-0">
                    <p class="font-inter text-xl font-bold">Campaigns</p>
                  </div>
                </div>





                <!-- DONATIONS -->
                <div
                  class="rounded-xl border bg-card text-card-foreground shadow-sm"
                >
                  <div class="flex flex-col space-y-1.5 p-6">
                    <h3
                      class="font-semibold leading-none tracking-tight flex items-center"
                    >
                      <!--img
                        alt="Svg Icon"
                        loading="lazy"
                        width="50"
                        height="50"
                        decoding="async"
                        data-nimg="1"
                        style="color: transparent"
                        src="/donation-1.svg"
                      /-->
                      <i class="mdi mdi-mdi mdi-pig menu-icon"></i>
                      <span class="ml-2 font-inter text-2xl">N<?php echo number_format($donations_total,2) ;?></span>
                    </h3>
                  </div>
                  <div class="p-6 pt-0">
                    <p class="font-inter text-xl font-bold">Donations</p>
                  </div>
                </div>




                <div
                  class="rounded-xl border bg-card text-card-foreground shadow-sm"
                >
                  <div class="flex flex-col space-y-1.5 p-6">
                    <h3
                      class="font-semibold leading-none tracking-tight flex items-center"
                    >
                      <img
                        alt="Svg Icon"
                        loading="lazy"
                        width="50"
                        height="50"
                        decoding="async"
                        data-nimg="1"
                        style="color: transparent"
                        src="/donation-2.svg"
                      /><span class="ml-2 font-inter text-2xl">100,000</span>
                    </h3>
                  </div>
                  <div class="p-6 pt-0">
                    <p class="font-inter text-xl font-bold">Earnings Net</p>
                  </div>
                </div>
              </div>





              <div class="rounded-xl border bg-orange-400 text-white shadow-sm">
                <div class="flex flex-col space-y-1.5 p-6 pb-0">
                  <h3
                    class="scroll-m-20 font-inter text-3xl font-semibold tracking-tight"
                  >
                    Donations
                  </h3>
                </div>
                <div class="p-6 pt-0 flex flex-col items-start gap-6">
                  <p class="mt-3 max-w-lg font-inter text-sm leading-5">
                    Let&#x27;s create a technological revolution where
                    innovation knows no bounds, cutting-edge advancements in
                    every field.
                  </p>
                  <a href="campaigns_list_page.php"  
                    class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 bg-brand hover:bg-brand-600"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="18"
                      height="18"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      class="lucide lucide-plus"
                    >
                      <line x1="12" x2="12" y1="5" y2="19"></line>
                      <line x1="5" x2="19" y1="12" y2="12"></line></svg
                    ><span class="ml-1 font-inter">Create Donation</span>
                  </a>
                </div>
              </div>
              <div
                class="rounded-xl border bg-card text-card-foreground shadow-sm"
              >
                <div class="flex flex-col space-y-1.5 p-6 pb-0">
                  <h3
                    class="scroll-m-20 font-inter text-3xl font-semibold tracking-tight"
                  >
                    Recent Donations
                  </h3>
                  <p class="leading-7">history of donations you have created</p>
                </div>
                <div class="p-6 pt-0">
                  <div class="embla">
                    <div class="embla__viewport">
                      <div class="embla__container">
                        <div class="embla__slide">
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
                                srcset="
                                  _next/image?url=%2Ftemplate-card-image.jpg&amp;w=384&amp;q=75 1x,
                                  _next/image?url=%2Ftemplate-card-image.jpg&amp;w=640&amp;q=75 2x
                                "
                                src="_next/image?url=%2Ftemplate-card-image.jpg&amp;w=640&amp;q=75"
                              />
                            </div>
                            <div
                              class="flex flex-col space-y-1.5 p-6 border-b py-2"
                            >
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
                                  class="lucide lucide-home"
                                >
                                  <path
                                    d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"
                                  ></path>
                                  <polyline
                                    points="9 22 9 12 15 12 15 22"
                                  ></polyline></svg
                                ><span class="ml-2 font-inter text-2xl"
                                  >Charity</span
                                >
                              </h3>
                            </div>
                            <div class="p-6 pt-4">
                              <h3
                                class="mb-2 scroll-m-20 font-inter text-xl font-semibold tracking-tight"
                              >
                                Community Help
                              </h3>
                              <p
                                class="font-inter text-sm font-medium leading-5 text-gray-500"
                              >
                                ₦20,000
                              </p>
                              <p
                                class="font-inter text-sm font-medium leading-5 text-gray-500"
                              >
                                raised of ₦100,000
                              </p>
                              <p
                                class="font-inter text-sm font-medium leading-5 text-gray-500"
                              >
                                20%
                              </p>
                            </div>
                            <div class="flex items-center p-6 pt-0">
                              <button
                                class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 w-full bg-brand hover:bg-brand-600"
                              >
                                Check it now
                              </button>
                            </div>
                          </div>
                          <div class="embla__slide__number"><span>1</span></div>
                        </div>
                        <div class="embla__slide">
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
                                srcset="
                                  _next/image?url=%2Ftemplate-card-image.jpg&amp;w=384&amp;q=75 1x,
                                  _next/image?url=%2Ftemplate-card-image.jpg&amp;w=640&amp;q=75 2x
                                "
                                src="_next/image?url=%2Ftemplate-card-image.jpg&amp;w=640&amp;q=75"
                              />
                            </div>
                            <div
                              class="flex flex-col space-y-1.5 p-6 border-b py-2"
                            >
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
                                  class="lucide lucide-cloud"
                                >
                                  <path
                                    d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"
                                  ></path></svg
                                ><span class="ml-2 font-inter text-2xl"
                                  >Construct</span
                                >
                              </h3>
                            </div>
                            <div class="p-6 pt-4">
                              <h3
                                class="mb-2 scroll-m-20 font-inter text-xl font-semibold tracking-tight"
                              >
                                Community Help
                              </h3>
                              <p
                                class="font-inter text-sm font-medium leading-5 text-gray-500"
                              >
                                ₦20,000
                              </p>
                              <p
                                class="font-inter text-sm font-medium leading-5 text-gray-500"
                              >
                                raised of ₦100,000
                              </p>
                              <p
                                class="font-inter text-sm font-medium leading-5 text-gray-500"
                              >
                                20%
                              </p>
                            </div>
                            <div class="flex items-center p-6 pt-0">
                              <button
                                class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 w-full bg-brand hover:bg-brand-600"
                              >
                                Check it now
                              </button>
                            </div>
                          </div>
                          <div class="embla__slide__number"><span>1</span></div>
                        </div>
                        <div class="embla__slide">
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
                                srcset="
                                  _next/image?url=%2Ftemplate-card-image.jpg&amp;w=384&amp;q=75 1x,
                                  _next/image?url=%2Ftemplate-card-image.jpg&amp;w=640&amp;q=75 2x
                                "
                                src="_next/image?url=%2Ftemplate-card-image.jpg&amp;w=640&amp;q=75"
                              />
                            </div>
                            <div
                              class="flex flex-col space-y-1.5 p-6 border-b py-2"
                            >
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
                                  <path
                                    d="M22 12a10.06 10.06 1 0 0-20 0Z"
                                  ></path>
                                  <path d="M12 12v8a2 2 0 0 0 4 0"></path>
                                  <path d="M12 2v1"></path></svg
                                ><span class="ml-2 font-inter text-2xl"
                                  >Helping</span
                                >
                              </h3>
                            </div>
                            <div class="p-6 pt-4">
                              <h3
                                class="mb-2 scroll-m-20 font-inter text-xl font-semibold tracking-tight"
                              >
                                Community Help
                              </h3>
                              <p
                                class="font-inter text-sm font-medium leading-5 text-gray-500"
                              >
                                ₦20,000
                              </p>
                              <p
                                class="font-inter text-sm font-medium leading-5 text-gray-500"
                              >
                                raised of ₦100,000
                              </p>
                              <p
                                class="font-inter text-sm font-medium leading-5 text-gray-500"
                              >
                                20%
                              </p>
                            </div>
                            <div class="flex items-center p-6 pt-0">
                              <button
                                class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 w-full bg-brand hover:bg-brand-600"
                              >
                                Check it now
                              </button>
                            </div>
                          </div>
                          <div class="embla__slide__number"><span>1</span></div>
                        </div>
                        <div class="embla__slide">
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
                                srcset="
                                  _next/image?url=%2Ftemplate-card-image.jpg&amp;w=384&amp;q=75 1x,
                                  _next/image?url=%2Ftemplate-card-image.jpg&amp;w=640&amp;q=75 2x
                                "
                                src="_next/image?url=%2Ftemplate-card-image.jpg&amp;w=640&amp;q=75"
                              />
                            </div>
                            <div
                              class="flex flex-col space-y-1.5 p-6 border-b py-2"
                            >
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
                                  class="lucide lucide-home"
                                >
                                  <path
                                    d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"
                                  ></path>
                                  <polyline
                                    points="9 22 9 12 15 12 15 22"
                                  ></polyline></svg
                                ><span class="ml-2 font-inter text-2xl"
                                  >Charity</span
                                >
                              </h3>
                            </div>
                            <div class="p-6 pt-4">
                              <h3
                                class="mb-2 scroll-m-20 font-inter text-xl font-semibold tracking-tight"
                              >
                                Community Help
                              </h3>
                              <p
                                class="font-inter text-sm font-medium leading-5 text-gray-500"
                              >
                                ₦20,000
                              </p>
                              <p
                                class="font-inter text-sm font-medium leading-5 text-gray-500"
                              >
                                raised of ₦100,000
                              </p>
                              <p
                                class="font-inter text-sm font-medium leading-5 text-gray-500"
                              >
                                20%
                              </p>
                            </div>
                            <div class="flex items-center p-6 pt-0">
                              <button
                                class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 w-full bg-brand hover:bg-brand-600"
                              >
                                Check it now
                              </button>
                            </div>
                          </div>
                          <div class="embla__slide__number"><span>1</span></div>
                        </div>
                        <div class="embla__slide">
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
                                srcset="
                                  _next/image?url=%2Ftemplate-card-image.jpg&amp;w=384&amp;q=75 1x,
                                  _next/image?url=%2Ftemplate-card-image.jpg&amp;w=640&amp;q=75 2x
                                "
                                src="_next/image?url=%2Ftemplate-card-image.jpg&amp;w=640&amp;q=75"
                              />
                            </div>
                            <div
                              class="flex flex-col space-y-1.5 p-6 border-b py-2"
                            >
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
                                  class="lucide lucide-cloud"
                                >
                                  <path
                                    d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"
                                  ></path></svg
                                ><span class="ml-2 font-inter text-2xl"
                                  >Construct</span
                                >
                              </h3>
                            </div>
                            <div class="p-6 pt-4">
                              <h3
                                class="mb-2 scroll-m-20 font-inter text-xl font-semibold tracking-tight"
                              >
                                Community Help
                              </h3>
                              <p
                                class="font-inter text-sm font-medium leading-5 text-gray-500"
                              >
                                ₦20,000
                              </p>
                              <p
                                class="font-inter text-sm font-medium leading-5 text-gray-500"
                              >
                                raised of ₦100,000
                              </p>
                              <p
                                class="font-inter text-sm font-medium leading-5 text-gray-500"
                              >
                                20%
                              </p>
                            </div>
                            <div class="flex items-center p-6 pt-0">
                              <button
                                class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 w-full bg-brand hover:bg-brand-600"
                              >
                                Check it now
                              </button>
                            </div>
                          </div>
                          <div class="embla__slide__number"><span>1</span></div>
                        </div>
                        <div class="embla__slide">
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
                                srcset="
                                  _next/image?url=%2Ftemplate-card-image.jpg&amp;w=384&amp;q=75 1x,
                                  _next/image?url=%2Ftemplate-card-image.jpg&amp;w=640&amp;q=75 2x
                                "
                                src="_next/image?url=%2Ftemplate-card-image.jpg&amp;w=640&amp;q=75"
                              />
                            </div>
                            <div
                              class="flex flex-col space-y-1.5 p-6 border-b py-2"
                            >
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
                                  <path
                                    d="M22 12a10.06 10.06 1 0 0-20 0Z"
                                  ></path>
                                  <path d="M12 12v8a2 2 0 0 0 4 0"></path>
                                  <path d="M12 2v1"></path></svg
                                ><span class="ml-2 font-inter text-2xl"
                                  >Helping</span
                                >
                              </h3>
                            </div>
                            <div class="p-6 pt-4">
                              <h3
                                class="mb-2 scroll-m-20 font-inter text-xl font-semibold tracking-tight"
                              >
                                Community Help
                              </h3>
                              <p
                                class="font-inter text-sm font-medium leading-5 text-gray-500"
                              >
                                ₦20,000
                              </p>
                              <p
                                class="font-inter text-sm font-medium leading-5 text-gray-500"
                              >
                                raised of ₦100,000
                              </p>
                              <p
                                class="font-inter text-sm font-medium leading-5 text-gray-500"
                              >
                                20%
                              </p>
                            </div>
                            <div class="flex items-center p-6 pt-0">
                              <button
                                class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 w-full bg-brand hover:bg-brand-600"
                              >
                                Check it now
                              </button>
                            </div>
                          </div>
                          <div class="embla__slide__number"><span>1</span></div>
                        </div>
                      </div>
                    </div>
                    <div class="embla__dots"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <footer class="border-t bg-white pt-6">
      <div class="mx-auto w-full max-w-7xl px-6 md:px-12 lg:px-24">
        <div
          class="grid grid-cols-1 gap-8 py-6 sm:grid-cols-2 md:grid-cols-4 lg:py-8"
        >
          <div>
            <div class="mb-6 md:mb-0">
              <a href="https://flowbite.com/" class="flex items-center pb-4"
                ><span
                  class="self-center whitespace-nowrap text-2xl font-semibold dark:text-white"
                  >Thrift Thrust</span
                ></a
              >
              <div class="mt-4 flex flex-wrap space-x-5">
                <a class="text-gray-400 hover:text-gray-900" href="#"
                  ><svg
                    class="h-5 w-5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 8 19"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                      clip-rule="evenodd"
                    ></path></svg
                  ><span class="sr-only">Facebook page</span></a
                ><a class="text-gray-400 hover:text-gray-900" href="#"
                  ><svg
                    class="h-5 w-5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 21 16"
                  >
                    <path
                      d="M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z"
                    ></path></svg
                  ><span class="sr-only">Discord community</span></a
                ><a class="text-gray-400 hover:text-gray-900" href="#"
                  ><svg
                    class="h-5 w-5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 20 17"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z"
                      clip-rule="evenodd"
                    ></path></svg
                  ><span class="sr-only">Twitter page</span></a
                ><a class="text-gray-400 hover:text-gray-900" href="#"
                  ><svg
                    class="h-5 w-5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z"
                      clip-rule="evenodd"
                    ></path></svg
                  ><span class="sr-only">GitHub account</span></a
                >
              </div>
            </div>
          </div>
          <div>
            <h2 class="mb-6 text-sm font-semibold uppercase text-gray-900">
              Company
            </h2>
            <ul class="font-medium text-gray-500">
              <li class="mb-4">
                <a class="hover:underline" href="#">About</a>
              </li>
              <li class="mb-4">
                <a class="hover:underline" href="#">Careers</a>
              </li>
              <li class="mb-4">
                <a class="hover:underline" href="#">Brand Center</a>
              </li>
              <li class="mb-4"><a class="hover:underline" href="#">Blog</a></li>
            </ul>
          </div>
          <div>
            <h2 class="mb-6 text-sm font-semibold uppercase text-gray-900">
              Help center
            </h2>
            <ul class="font-medium text-gray-500">
              <li class="mb-4">
                <a class="hover:underline" href="#">Discord Server</a>
              </li>
              <li class="mb-4">
                <a class="hover:underline" href="#">Twitter</a>
              </li>
              <li class="mb-4">
                <a class="hover:underline" href="#">Facebook</a>
              </li>
              <li class="mb-4">
                <a class="hover:underline" href="#">Contact Us</a>
              </li>
            </ul>
          </div>
          <div>
            <h2 class="mb-6 text-sm font-semibold uppercase text-gray-900">
              Legal
            </h2>
            <ul class="font-medium text-gray-500">
              <li class="mb-4">
                <a class="hover:underline" href="#">Privacy Policy</a>
              </li>
              <li class="mb-4">
                <a class="hover:underline" href="#">Licensing</a>
              </li>
              <li class="mb-4">
                <a class="hover:underline" href="#">Terms &amp; Conditions</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="bg-gray-100 py-6">
        <div
          class="mx-auto w-full max-w-7xl px-16 md:flex md:flex-col md:items-center md:justify-center md:gap-6 lg:px-24"
        >
          <span class="text-sm text-gray-500 sm:text-center"
            >Copyright © <a href="">Thrift Trust</a> | All
            Right Reserved 2023</span
          >
        </div>
      </div>
    </footer>
    <!--script
      src="_next/static/chunks/webpack-75b5ab2f82d002e4.js"
      async=""
    ></script>
    <script
      src="_next/static/chunks/20e9c529-6a72704995d09ef7.js"
      async=""
    ></script>
    <script
      src="_next/static/chunks/340-2537b03c70e9a4f9.js"
      async=""
    ></script>
    <script
      src="_next/static/chunks/main-app-252078edd4a12174.js"
      async=""
    ></script-->
    <!--script>
      (self.__next_f = self.__next_f || []).push([0]);
    </script>
    <script>
      self.__next_f.push([
        1,
        '1:HL["_next/static/media/02205c9944024f15-s.p.woff2",{"as":"font","type":"font/woff2"}]\n2:HL["_next/static/media/0e4fe491bf84089c-s.p.woff2",{"as":"font","type":"font/woff2"}]\n3:HL["_next/static/media/2aaf0723e720e8b9-s.p.woff2",{"as":"font","type":"font/woff2"}]\n4:HL["_next/static/media/627622453ef56b0d-s.p.woff2",{"as":"font","type":"font/woff2"}]\n5:HL["_next/static/media/7d8c9b0ca4a64a5a-s.p.woff2",{"as":"font","type":"font/woff2"}]\n6:HL["_next/static/media/8db47a8bf03b7d2f-s.p.woff2",{"as":"font",',
      ]);
    </script>
    <script>
      self.__next_f.push([
        1,
        '"type":"font/woff2"}]\n7:HL["_next/static/media/934c4b7cb736f2a3-s.p.woff2",{"as":"font","type":"font/woff2"}]\n8:HL["_next/static/css/728058cd7dfd0a0f.css",{"as":"style"}]\n0:"$L9"\n',
      ]);
    </script>
    <script>
      self.__next_f.push([
        1,
        'a:I{"id":56452,"chunks":["272:static/chunks/webpack-75b5ab2f82d002e4.js","227:static/chunks/20e9c529-6a72704995d09ef7.js","340:static/chunks/340-2537b03c70e9a4f9.js"],"name":"default","async":false}\nc:I{"id":49728,"chunks":["272:static/chunks/webpack-75b5ab2f82d002e4.js","227:static/chunks/20e9c529-6a72704995d09ef7.js","340:static/chunks/340-2537b03c70e9a4f9.js"],"name":"GlobalError","async":false}\nd:I{"id":36608,"chunks":["608:static/chunks/608-ed2db8fc173478d2.js","185:static/chunks/app/layout-ba40228b9d9',
      ]);
    </script>
    <script>
      self.__next_f.push([
        1,
        'ac32d.js"],"name":"","async":false}\ne:I{"id":35612,"chunks":["272:static/chunks/webpack-75b5ab2f82d002e4.js","227:static/chunks/20e9c529-6a72704995d09ef7.js","340:static/chunks/340-2537b03c70e9a4f9.js"],"name":"default","async":false}\nf:I{"id":65120,"chunks":["272:static/chunks/webpack-75b5ab2f82d002e4.js","227:static/chunks/20e9c529-6a72704995d09ef7.js","340:static/chunks/340-2537b03c70e9a4f9.js"],"name":"default","async":false}\n10:I{"id":85169,"chunks":["545:static/chunks/f923c8e2-1f52a3522ebccc37.js","89',
      ]);
    </script>
    <script>
      self.__next_f.push([
        1,
        '3:static/chunks/893-6f82810396ea99d5.js","608:static/chunks/608-ed2db8fc173478d2.js","187:static/chunks/187-f74dd2fbb99f2097.js","566:static/chunks/566-fb8e22aa79f64100.js","663:static/chunks/app/dashboard/layout-66b71523898fa393.js"],"name":"Accordion","async":false}\n11:I{"id":85169,"chunks":["545:static/chunks/f923c8e2-1f52a3522ebccc37.js","893:static/chunks/893-6f82810396ea99d5.js","608:static/chunks/608-ed2db8fc173478d2.js","187:static/chunks/187-f74dd2fbb99f2097.js","566:static/chunks/566-fb8e22aa79f64',
      ]);
    </script>
    <script>
      self.__next_f.push([
        1,
        '100.js","663:static/chunks/app/dashboard/layout-66b71523898fa393.js"],"name":"AccordionItem","async":false}\n12:I{"id":85169,"chunks":["545:static/chunks/f923c8e2-1f52a3522ebccc37.js","893:static/chunks/893-6f82810396ea99d5.js","608:static/chunks/608-ed2db8fc173478d2.js","187:static/chunks/187-f74dd2fbb99f2097.js","566:static/chunks/566-fb8e22aa79f64100.js","663:static/chunks/app/dashboard/layout-66b71523898fa393.js"],"name":"AccordionTrigger","async":false}\n13:I{"id":85169,"chunks":["545:static/chunks/f923c',
      ]);
    </script>
    <script>
      self.__next_f.push([
        1,
        '8e2-1f52a3522ebccc37.js","893:static/chunks/893-6f82810396ea99d5.js","608:static/chunks/608-ed2db8fc173478d2.js","187:static/chunks/187-f74dd2fbb99f2097.js","566:static/chunks/566-fb8e22aa79f64100.js","663:static/chunks/app/dashboard/layout-66b71523898fa393.js"],"name":"AccordionContent","async":false}\n14:I{"id":28244,"chunks":["545:static/chunks/f923c8e2-1f52a3522ebccc37.js","893:static/chunks/893-6f82810396ea99d5.js","608:static/chunks/608-ed2db8fc173478d2.js","187:static/chunks/187-f74dd2fbb99f2097.js","',
      ]);
    </script>
    <script>
      self.__next_f.push([
        1,
        '566:static/chunks/566-fb8e22aa79f64100.js","663:static/chunks/app/dashboard/layout-66b71523898fa393.js"],"name":"SidebarNav","async":false}\n15:I{"id":64527,"chunks":["335:static/chunks/335-ed7dcde75d044829.js","195:static/chunks/195-5546f6f2c0dd0383.js","521:static/chunks/521-9aaaa81a33c4f169.js","885:static/chunks/885-438989d004e47681.js","702:static/chunks/app/dashboard/page-dd41c5732c9f33a5.js"],"name":"Overview","async":false}\n16:I{"id":47335,"chunks":["335:static/chunks/335-ed7dcde75d044829.js","195:st',
      ]);
    </script>
    <script>
      self.__next_f.push([
        1,
        'atic/chunks/195-5546f6f2c0dd0383.js","521:static/chunks/521-9aaaa81a33c4f169.js","885:static/chunks/885-438989d004e47681.js","702:static/chunks/app/dashboard/page-dd41c5732c9f33a5.js"],"name":"Image","async":false}\n17:I{"id":92893,"chunks":["335:static/chunks/335-ed7dcde75d044829.js","195:static/chunks/195-5546f6f2c0dd0383.js","521:static/chunks/521-9aaaa81a33c4f169.js","885:static/chunks/885-438989d004e47681.js","702:static/chunks/app/dashboard/page-dd41c5732c9f33a5.js"],"name":"Carousel","async":false}\n18',
      ]);
    </script>
    <script>
      self.__next_f.push([
        1,
        ':I{"id":92893,"chunks":["335:static/chunks/335-ed7dcde75d044829.js","195:static/chunks/195-5546f6f2c0dd0383.js","521:static/chunks/521-9aaaa81a33c4f169.js","885:static/chunks/885-438989d004e47681.js","702:static/chunks/app/dashboard/page-dd41c5732c9f33a5.js"],"name":"CarouselSlide","async":false}\n',
      ]);
    </script>
    <script>
      self.__next_f.push([
        1,
        '9:[[["$","link","0",{"rel":"stylesheet","href":"_next/static/css/728058cd7dfd0a0f.css","precedence":"next"}]],["$","$La",null,{"buildId":"mTPBSK97kAgfdJrZNRdKf","assetPrefix":"","initialCanonicalUrl":"/dashboard","initialTree":["",{"children":["dashboard",{"children":["__PAGE__",{}]}]},"$undefined","$undefined",true],"initialHead":"$Lb","globalErrorComponent":"$c","children":[["$","html",null,{"lang":"en","children":["$","body",null,{"className":"__variable_20951f __variable_9bfd88 bg-[#f98727]","children":[["$","header",null,{"className":"z-40 w-full border-b bg-white","children":["$","div",null,{"className":"mx-auto flex h-20 max-w-7xl items-center gap-6 px-6 md:h-24 lg:gap-12 lg:px-24","children":[["$","$Ld",null,{"href":"/","children":["$","h2",null,{"className":"scroll-m-20 pb-2 font-inter text-xl font-semibold md:text-2xl","children":"Thrift Thrust"}]}],["$","div",null,{"className":"hidden px-6 lg:block","children":["$","input",null,{"type":"$undefined","className":"flex h-9 w-full rounded-md border border-input px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 max-w-[550px] bg-slate-50","placeholder":"Search here..."}]}],["$","button",null,{"className":"inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-9 w-9 ml-auto","children":["$","svg",null,{"xmlns":"http://www.w3.org/2000/svg","width":24,"height":24,"viewBox":"0 0 24 24","fill":"none","stroke":"currentColor","strokeWidth":2,"strokeLinecap":"round","strokeLinejoin":"round","className":"lucide lucide-menu","children":[["$","line","1e0a9i",{"x1":"4","x2":"20","y1":"12","y2":"12"}],["$","line","1owob3",{"x1":"4","x2":"20","y1":"6","y2":"6"}],["$","line","yk5zj1",{"x1":"4","x2":"20","y1":"18","y2":"18"}],"$undefined"]}]}]]}]}],["$","main",null,{"children":["$","$Le",null,{"parallelRouterKey":"children","segmentPath":["children"],"error":"$undefined","errorStyles":"$undefined","loading":"$undefined","loadingStyles":"$undefined","hasLoading":false,"template":["$","$Lf",null,{}],"templateStyles":"$undefined","notFound":"$undefined","notFoundStyles":"$undefined","childProp":{"current":[["$","div",null,{"className":"space-y-6 bg-gray-100 p-2 pb-16 md:p-8","children":["$","div",null,{"className":"flex flex-col lg:flex-row lg:space-y-0","children":[["$","div",null,{"className":"mb-2 block lg:hidden","children":["$","$L10",null,{"type":"single","collapsible":true,"children":["$","$L11",null,{"value":"navmenu","children":[["$","$L12",null,{"className":"inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2 justify-start","children":"Menu"}],["$","$L13",null,{"children":["$","aside",null,{"className":"rounded-lg border bg-white p-2 shadow-sm md:p-4","children":["$","$L14",null,{"items":[{"title":"Dashboard","href":"/dashboard"},{"title":"Donors","href":"/donors"},{"title":"Donations","href":"/donations","items":[{"title":"Create Donation","href":"/donations/create"}]},{"title":"Withdrawals","href":"/withdrawals","items":[{"title":"Withdrawals Configure","href":"/withdrawals/configure"}]},{"title":"Campaigns","href":"/campaigns"},{"title":"About Organization","href":"/organization/about"},{"title":"Status","href":"/organization/status"},{"title":"Documentation","href":"/docs"},{"title":"Account","href":"/account"},{"title":"Settings","href":"/account/settings"}]}]}]}]]}]}]}],["$","aside",null,{"className":"hidden rounded-lg border bg-white p-2 shadow-sm md:p-4 lg:block lg:w-1/4","children":["$","$L14",null,{"items":[{"title":"Dashboard","href":"/dashboard"},{"title":"Donors","href":"/donors"},{"title":"Donations","href":"/donations","items":[{"title":"Create Donation","href":"/donations/create"}]},{"title":"Withdrawals","href":"/withdrawals","items":[{"title":"Withdrawals Configure","href":"/withdrawals/configure"}]},{"title":"Campaigns","href":"/campaigns"},{"title":"About Organization","href":"/organization/about"},{"title":"Status","href":"/organization/status"},{"title":"Documentation","href":"/docs"},{"title":"Account","href":"/account"},{"title":"Settings","href":"/account/settings"}]}]}],["$","div",null,{"className":"flex-1","children":["$","$Le",null,{"parallelRouterKey":"children","segmentPath":["children","dashboard","children"],"error":"$undefined","errorStyles":"$undefined","loading":"$undefined","loadingStyles":"$undefined","hasLoading":false,"template":["$","$Lf",null,{}],"templateStyles":"$undefined","notFound":"$undefined","notFoundStyles":"$undefined","childProp":{"current":[["$","div",null,{"className":"h-full space-y-6 lg:pl-4","children":[["$","div",null,{"className":"grid gap-2 lg:grid-cols-2 lg:grid-rows-2","children":[["$","div",null,{"className":"rounded-xl border bg-card text-card-foreground row-span-2 shadow-sm","children":["$","div",null,{"className":"p-4","children":["$","$L15",null,{}]}]}],["$","div",null,{"className":"rounded-xl border bg-card text-card-foreground shadow-sm","children":[["$","div",null,{"className":"flex flex-col space-y-1.5 p-6","children":["$","h3",null,{"className":"font-semibold leading-none tracking-tight flex items-center","children":[["$","$L16",null,{"src":"/donation-1.svg","alt":"Svg Icon","width":50,"height":50}],["$","span",null,{"className":"ml-2 font-inter text-2xl","children":"50"}]]}]}],["$","div",null,{"className":"p-6 pt-0","children":["$","p",null,{"className":"font-inter text-xl font-bold","children":"Donations"}]}]]}],["$","div",null,{"className":"rounded-xl border bg-card text-card-foreground shadow-sm","children":[["$","div",null,{"className":"flex flex-col space-y-1.5 p-6","children":["$","h3",null,{"className":"font-semibold leading-none tracking-tight flex items-center","children":[["$","$L16",null,{"src":"/donation-2.svg","alt":"Svg Icon","width":50,"height":50}],["$","span",null,{"className":"ml-2 font-inter text-2xl","children":"100,000"}]]}]}],["$","div",null,{"className":"p-6 pt-0","children":["$","p",null,{"className":"font-inter text-xl font-bold","children":"Earnings Net"}]}]]}]]}],["$","div",null,{"className":"rounded-xl border bg-orange-400 text-white shadow-sm","children":[["$","div",null,{"className":"flex flex-col space-y-1.5 p-6 pb-0","children":["$","h3",null,{"className":"scroll-m-20 font-inter text-3xl font-semibold tracking-tight","children":"Donations"}]}],["$","div",null,{"className":"p-6 pt-0 flex flex-col items-start gap-6","children":[["$","p",null,{"className":"mt-3 max-w-lg font-inter text-sm leading-5","children":"Let\'s create a technological revolution where innovation knows no bounds, cutting-edge advancements in every field."}],["$","button",null,{"className":"inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 bg-brand hover:bg-brand-600","children":[["$","svg",null,{"xmlns":"http://www.w3.org/2000/svg","width":18,"height":18,"viewBox":"0 0 24 24","fill":"none","stroke":"currentColor","strokeWidth":2,"strokeLinecap":"round","strokeLinejoin":"round","className":"lucide lucide-plus","children":[["$","line","pwfkuu",{"x1":"12","x2":"12","y1":"5","y2":"19"}],["$","line","13b5wn",{"x1":"5","x2":"19","y1":"12","y2":"12"}],"$undefined"]}],["$","span",null,{"className":"ml-1 font-inter","children":"Create Donation"}]]}]]}]]}],["$","div",null,{"className":"rounded-xl border bg-card text-card-foreground shadow-sm","children":[["$","div",null,{"className":"flex flex-col space-y-1.5 p-6 pb-0","children":[["$","h3",null,{"className":"scroll-m-20 font-inter text-3xl font-semibold tracking-tight","children":"Recent Donations"}],["$","p",null,{"className":"leading-7","children":"history of donations you have created"}]]}],["$","div",null,{"className":"p-6 pt-0","children":["$","$L17",null,{"options":{"dragFree":true,"containScroll":"trimSnaps","align":"start"},"children":[["$","$L18",null,{"children":["$","div",null,{"className":"rounded-xl border bg-card text-card-foreground overflow-hidden shadow-md","children":[["$","div",null,{"className":"h-36 w-full overflow-hidden","children":["$","$L16",null,{"src":"/template-card-image.jpg","width":300,"height":100,"alt":"","className":"w-full bg-cover"}]}],["$","div",null,{"className":"flex flex-col space-y-1.5 p-6 border-b py-2","children":["$","h3",null,{"className":"font-semibold leading-none tracking-tight flex items-center","children":[["$","svg",null,{"xmlns":"http://www.w3.org/2000/svg","width":24,"height":24,"viewBox":"0 0 24 24","fill":"none","stroke":"currentColor","strokeWidth":2,"strokeLinecap":"round","strokeLinejoin":"round","className":"lucide lucide-home","children":[["$","path","y5dka4",{"d":"m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"}],["$","polyline","e2us08",{"points":"9 22 9 12 15 12 15 22"}],"$undefined"]}],["$","span",null,{"className":"ml-2 font-inter text-2xl","children":"Charity"}]]}]}],["$","div",null,{"className":"p-6 pt-4","children":[["$","h3",null,{"className":"mb-2 scroll-m-20 font-inter text-xl font-semibold tracking-tight","children":"Community Help"}],["$","p",null,{"className":"font-inter text-sm font-medium leading-5 text-gray-500","children":"₦20,000"}],["$","p",null,{"className":"font-inter text-sm font-medium leading-5 text-gray-500","children":"raised of ₦100,000"}],["$","p",null,{"className":"font-inter text-sm font-medium leading-5 text-gray-500","children":"20%"}]]}],["$","div",null,{"className":"flex items-center p-6 pt-0","children":["$","button",null,{"className":"inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 w-full bg-brand hover:bg-brand-600","children":"Check it now"}]}]]}]}],["$","$L18",null,{"children":["$","div",null,{"className":"rounded-xl border bg-card text-card-foreground overflow-hidden shadow-md","children":[["$","div",null,{"className":"h-36 w-full overflow-hidden","children":["$","$L16",null,{"src":"/template-card-image.jpg","width":300,"height":100,"alt":"","className":"w-full bg-cover"}]}],["$","div",null,{"className":"flex flex-col space-y-1.5 p-6 border-b py-2","children":["$","h3",null,{"className":"font-semibold leading-none tracking-tight flex items-center","children":[["$","svg",null,{"xmlns":"http://www.w3.org/2000/svg","width":24,"height":24,"viewBox":"0 0 24 24","fill":"none","stroke":"currentColor","strokeWidth":2,"strokeLinecap":"round","strokeLinejoin":"round","className":"lucide lucide-cloud","children":[["$","path","p7xjir",{"d":"M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"}],"$undefined"]}],["$","span",null,{"className":"ml-2 font-inter text-2xl","children":"Construct"}]]}]}],["$","div",null,{"className":"p-6 pt-4","children":[["$","h3",null,{"className":"mb-2 scroll-m-20 font-inter text-xl font-semibold tracking-tight","children":"Community Help"}],["$","p",null,{"className":"font-inter text-sm font-medium leading-5 text-gray-500","children":"₦20,000"}],["$","p",null,{"className":"font-inter text-sm font-medium leading-5 text-gray-500","children":"raised of ₦100,000"}],["$","p",null,{"className":"font-inter text-sm font-medium leading-5 text-gray-500","children":"20%"}]]}],["$","div",null,{"className":"flex items-center p-6 pt-0","children":["$","button",null,{"className":"inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 w-full bg-brand hover:bg-brand-600","children":"Check it now"}]}]]}]}],["$","$L18",null,{"children":["$","div",null,{"className":"rounded-xl border bg-card text-card-foreground overflow-hidden shadow-md","children":[["$","div",null,{"className":"h-36 w-full overflow-hidden","children":["$","$L16",null,{"src":"/template-card-image.jpg","width":300,"height":100,"alt":"","className":"w-full bg-cover"}]}],["$","div",null,{"className":"flex flex-col space-y-1.5 p-6 border-b py-2","children":["$","h3",null,{"className":"font-semibold leading-none tracking-tight flex items-center","children":[["$","svg",null,{"xmlns":"http://www.w3.org/2000/svg","width":24,"height":24,"viewBox":"0 0 24 24","fill":"none","stroke":"currentColor","strokeWidth":2,"strokeLinecap":"round","strokeLinejoin":"round","className":"lucide lucide-umbrella","children":[["$","path","1teyop",{"d":"M22 12a10.06 10.06 1 0 0-20 0Z"}],["$","path","ulpmoc",{"d":"M12 12v8a2 2 0 0 0 4 0"}],["$","path","11qlp1",{"d":"M12 2v1"}],"$undefined"]}],["$","span",null,{"className":"ml-2 font-inter text-2xl","children":"Helping"}]]}]}],["$","div",null,{"className":"p-6 pt-4","children":[["$","h3",null,{"className":"mb-2 scroll-m-20 font-inter text-xl font-semibold tracking-tight","children":"Community Help"}],["$","p",null,{"className":"font-inter text-sm font-medium leading-5 text-gray-500","children":"₦20,000"}],["$","p",null,{"className":"font-inter text-sm font-medium leading-5 text-gray-500","children":"raised of ₦100,000"}],["$","p",null,{"className":"font-inter text-sm font-medium leading-5 text-gray-500","children":"20%"}]]}],["$","div",null,{"className":"flex items-center p-6 pt-0","children":["$","button",null,{"className":"inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 w-full bg-brand hover:bg-brand-600","children":"Check it now"}]}]]}]}],["$","$L18",null,{"children":["$","div",null,{"className":"rounded-xl border bg-card text-card-foreground overflow-hidden shadow-md","children":[["$","div",null,{"className":"h-36 w-full overflow-hidden","children":["$","$L16",null,{"src":"/template-card-image.jpg","width":300,"height":100,"alt":"","className":"w-full bg-cover"}]}],["$","div",null,{"className":"flex flex-col space-y-1.5 p-6 border-b py-2","children":["$","h3",null,{"className":"font-semibold leading-none tracking-tight flex items-center","children":[["$","svg",null,{"xmlns":"http://www.w3.org/2000/svg","width":24,"height":24,"viewBox":"0 0 24 24","fill":"none","stroke":"currentColor","strokeWidth":2,"strokeLinecap":"round","strokeLinejoin":"round","className":"lucide lucide-home","children":[["$","path","y5dka4",{"d":"m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"}],["$","polyline","e2us08",{"points":"9 22 9 12 15 12 15 22"}],"$undefined"]}],["$","span",null,{"className":"ml-2 font-inter text-2xl","children":"Charity"}]]}]}],["$","div",null,{"className":"p-6 pt-4","children":[["$","h3",null,{"className":"mb-2 scroll-m-20 font-inter text-xl font-semibold tracking-tight","children":"Community Help"}],["$","p",null,{"className":"font-inter text-sm font-medium leading-5 text-gray-500","children":"₦20,000"}],["$","p",null,{"className":"font-inter text-sm font-medium leading-5 text-gray-500","children":"raised of ₦100,000"}],["$","p",null,{"className":"font-inter text-sm font-medium leading-5 text-gray-500","children":"20%"}]]}],["$","div",null,{"className":"flex items-center p-6 pt-0","children":["$","button",null,{"className":"inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 w-full bg-brand hover:bg-brand-600","children":"Check it now"}]}]]}]}],["$","$L18",null,{"children":["$","div",null,{"className":"rounded-xl border bg-card text-card-foreground overflow-hidden shadow-md","children":[["$","div",null,{"className":"h-36 w-full overflow-hidden","children":["$","$L16",null,{"src":"/template-card-image.jpg","width":300,"height":100,"alt":"","className":"w-full bg-cover"}]}],["$","div",null,{"className":"flex flex-col space-y-1.5 p-6 border-b py-2","children":["$","h3",null,{"className":"font-semibold leading-none tracking-tight flex items-center","children":[["$","svg",null,{"xmlns":"http://www.w3.org/2000/svg","width":24,"height":24,"viewBox":"0 0 24 24","fill":"none","stroke":"currentColor","strokeWidth":2,"strokeLinecap":"round","strokeLinejoin":"round","className":"lucide lucide-cloud","children":[["$","path","p7xjir",{"d":"M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"}],"$undefined"]}],["$","span",null,{"className":"ml-2 font-inter text-2xl","children":"Construct"}]]}]}],["$","div",null,{"className":"p-6 pt-4","children":[["$","h3",null,{"className":"mb-2 scroll-m-20 font-inter text-xl font-semibold tracking-tight","children":"Community Help"}],["$","p",null,{"className":"font-inter text-sm font-medium leading-5 text-gray-500","children":"₦20,000"}],["$","p",null,{"className":"font-inter text-sm font-medium leading-5 text-gray-500","children":"raised of ₦100,000"}],["$","p",null,{"className":"font-inter text-sm font-medium leading-5 text-gray-500","children":"20%"}]]}],["$","div",null,{"className":"flex items-center p-6 pt-0","children":["$","button",null,{"className":"inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 w-full bg-brand hover:bg-brand-600","children":"Check it now"}]}]]}]}],["$","$L18",null,{"children":["$","div",null,{"className":"rounded-xl border bg-card text-card-foreground overflow-hidden shadow-md","children":[["$","div",null,{"className":"h-36 w-full overflow-hidden","children":["$","$L16",null,{"src":"/template-card-image.jpg","width":300,"height":100,"alt":"","className":"w-full bg-cover"}]}],["$","div",null,{"className":"flex flex-col space-y-1.5 p-6 border-b py-2","children":["$","h3",null,{"className":"font-semibold leading-none tracking-tight flex items-center","children":[["$","svg",null,{"xmlns":"http://www.w3.org/2000/svg","width":24,"height":24,"viewBox":"0 0 24 24","fill":"none","stroke":"currentColor","strokeWidth":2,"strokeLinecap":"round","strokeLinejoin":"round","className":"lucide lucide-umbrella","children":[["$","path","1teyop",{"d":"M22 12a10.06 10.06 1 0 0-20 0Z"}],["$","path","ulpmoc",{"d":"M12 12v8a2 2 0 0 0 4 0"}],["$","path","11qlp1",{"d":"M12 2v1"}],"$undefined"]}],["$","span",null,{"className":"ml-2 font-inter text-2xl","children":"Helping"}]]}]}],["$","div",null,{"className":"p-6 pt-4","children":[["$","h3",null,{"className":"mb-2 scroll-m-20 font-inter text-xl font-semibold tracking-tight","children":"Community Help"}],["$","p",null,{"className":"font-inter text-sm font-medium leading-5 text-gray-500","children":"₦20,000"}],["$","p",null,{"className":"font-inter text-sm font-medium leading-5 text-gray-500","children":"raised of ₦100,000"}],["$","p",null,{"className":"font-inter text-sm font-medium leading-5 text-gray-500","children":"20%"}]]}],["$","div",null,{"className":"flex items-center p-6 pt-0","children":["$","button",null,{"className":"inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 w-full bg-brand hover:bg-brand-600","children":"Check it now"}]}]]}]}]]}]}]]}]]}],null],"segment":"__PAGE__"},"styles":[]}]}]]}]}],null],"segment":"dashboard"},"styles":[]}]}],["$","footer",null,{"className":"border-t bg-white pt-6","children":[["$","div",null,{"className":"mx-auto w-full max-w-7xl px-6 md:px-12 lg:px-24","children":["$","div",null,{"className":"grid grid-cols-1 gap-8 py-6 sm:grid-cols-2 md:grid-cols-4 lg:py-8","children":[["$","div",null,{"children":["$","div",null,{"className":"mb-6 md:mb-0","children":[["$","a",null,{"href":"https://flowbite.com/","className":"flex items-center pb-4","children":["$","span",null,{"className":"self-center whitespace-nowrap text-2xl font-semibold dark:text-white","children":"Thrift Thrust"}]}],["$","div",null,{"className":"mt-4 flex flex-wrap space-x-5","children":[["$","$Ld",null,{"href":"#","className":"text-gray-400 hover:text-gray-900","children":[["$","svg",null,{"className":"h-5 w-5","aria-hidden":"true","xmlns":"http://www.w3.org/2000/svg","fill":"currentColor","viewBox":"0 0 8 19","children":["$","path",null,{"fillRule":"evenodd","d":"M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z","clipRule":"evenodd"}]}],["$","span",null,{"className":"sr-only","children":"Facebook page"}]]}],["$","$Ld",null,{"href":"#","className":"text-gray-400 hover:text-gray-900 ","children":[["$","svg",null,{"className":"h-5 w-5","aria-hidden":"true","xmlns":"http://www.w3.org/2000/svg","fill":"currentColor","viewBox":"0 0 21 16","children":["$","path",null,{"d":"M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z"}]}],["$","span",null,{"className":"sr-only","children":"Discord community"}]]}],["$","$Ld",null,{"href":"#","className":"text-gray-400 hover:text-gray-900 ","children":[["$","svg",null,{"className":"h-5 w-5","aria-hidden":"true","xmlns":"http://www.w3.org/2000/svg","fill":"currentColor","viewBox":"0 0 20 17","children":["$","path",null,{"fillRule":"evenodd","d":"M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z","clipRule":"evenodd"}]}],["$","span",null,{"className":"sr-only","children":"Twitter page"}]]}],["$","$Ld",null,{"href":"#","className":"text-gray-400 hover:text-gray-900 ","children":[["$","svg",null,{"className":"h-5 w-5","aria-hidden":"true","xmlns":"http://www.w3.org/2000/svg","fill":"currentColor","viewBox":"0 0 20 20","children":["$","path",null,{"fillRule":"evenodd","d":"M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z","clipRule":"evenodd"}]}],["$","span",null,{"className":"sr-only","children":"GitHub account"}]]}]]}]]}]}],["$","div",null,{"children":[["$","h2",null,{"className":"mb-6 text-sm font-semibold uppercase text-gray-900","children":"Company"}],["$","ul",null,{"className":"font-medium text-gray-500","children":[["$","li",null,{"className":"mb-4","children":["$","$Ld",null,{"href":"#","className":" hover:underline","children":"About"}]}],["$","li",null,{"className":"mb-4","children":["$","$Ld",null,{"href":"#","className":"hover:underline","children":"Careers"}]}],["$","li",null,{"className":"mb-4","children":["$","$Ld",null,{"href":"#","className":"hover:underline","children":"Brand Center"}]}],["$","li",null,{"className":"mb-4","children":["$","$Ld",null,{"href":"#","className":"hover:underline","children":"Blog"}]}]]}]]}],["$","div",null,{"children":[["$","h2",null,{"className":"mb-6 text-sm font-semibold uppercase text-gray-900","children":"Help center"}],["$","ul",null,{"className":"font-medium text-gray-500","children":[["$","li",null,{"className":"mb-4","children":["$","$Ld",null,{"href":"#","className":"hover:underline","children":"Discord Server"}]}],["$","li",null,{"className":"mb-4","children":["$","$Ld",null,{"href":"#","className":"hover:underline","children":"Twitter"}]}],["$","li",null,{"className":"mb-4","children":["$","$Ld",null,{"href":"#","className":"hover:underline","children":"Facebook"}]}],["$","li",null,{"className":"mb-4","children":["$","$Ld",null,{"href":"#","className":"hover:underline","children":"Contact Us"}]}]]}]]}],["$","div",null,{"children":[["$","h2",null,{"className":"mb-6 text-sm font-semibold uppercase text-gray-900 ","children":"Legal"}],["$","ul",null,{"className":"font-medium text-gray-500","children":[["$","li",null,{"className":"mb-4","children":["$","$Ld",null,{"href":"#","className":"hover:underline","children":"Privacy Policy"}]}],["$","li",null,{"className":"mb-4","children":["$","$Ld",null,{"href":"#","className":"hover:underline","children":"Licensing"}]}],["$","li",null,{"className":"mb-4","children":["$","$Ld",null,{"href":"#","className":"hover:underline","children":"Terms \u0026 Conditions"}]}]]}]]}]]}]}],["$","div",null,{"className":"bg-gray-100 py-6","children":["$","div",null,{"className":"mx-auto w-full max-w-7xl px-16 md:flex md:flex-col md:items-center md:justify-center md:gap-6 lg:px-24","children":["$","span",null,{"className":"text-sm text-gray-500 sm:text-center","children":["Copyright © ",["$","$Ld",null,{"href":"https://flowbite.com/","children":"Thrift Trust"}]," | All Right Reserved 2023"]}]}]}]]}]]}]}],null]}]]\n',
      ]);
    </script>
    <script>
      self.__next_f.push([
        1,
        'b:[["$","meta","0",{"charSet":"utf-8"}],["$","title","1",{"children":"Thrift Thrust"}],["$","meta","2",{"name":"viewport","content":"width=device-width, initial-scale=1"}],["$","link","3",{"rel":"icon","href":"/favicon.ico","type":"image/x-icon","sizes":"any"}],["$","meta","4",{"name":"next-size-adjust"}]]\n',
      ]);
    </script-->
  </body>
</html>
