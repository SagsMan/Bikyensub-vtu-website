<?php 
session_start();

include_once "ini.php";
include_once "ini_custom.php";
include_once "functions.php";
include_once "functions_custom.php";
include_once "functions_customui.php";

//echo $_SESSION[APP_SESSION_NAME]["isAdmin"];
//exit();


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
$page='_admin_dashboard';
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
$donations_total =0;
$donations_amount_total=0;

 $donations=array();
?><?php try {
      //$stmt = $pdo->prepare("SELECT COUNT(*) AS `total`, SUM (`donation_amount`) AS `total_amount` FROM `donations`  WHERE `ownerId`=?  ");
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

$donations_amount_total = getTotalDonationsAmount($pdo);


}

$campaigns_total =0;
$campaigns_amount_total=0;

 $campaigns=array();
?><?php try {
      //$stmt = $pdo->prepare("SELECT COUNT(*) AS `total`, SUM (`donate_goal`) AS `total_amount` FROM `campaigns`  WHERE `ownerId`=?  ");
      $stmt = $pdo->prepare("SELECT COUNT(*) AS `total` FROM `campaigns`  WHERE `ownerId`=?  ");
      $stmt->execute([$_SESSION[APP_SESSION_NAME]["ownerId"]]);
      $campaigns = $stmt->fetchAll();     
    } catch (\PDOException $e) {
        $errorMessage .= "<b>Error loading campaigns</b><br>";
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }?><?php 
if(count($campaigns)>0){
  if(isset($campaigns[0]["total"])){
$campaigns_total = $campaigns[0]["total"];
}

$campaigns_amount_total =  getTotalCampaignsAmount($pdo);


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





$stmt = $pdo->prepare("SELECT  *  FROM `campaigns`  WHERE  `ownerId` =? LIMIT  4 ");
      /*Execute SQL*/
      $stmt->execute([ $ownerId ]);

    $admin_campaigns_list_component_datasource = $stmt->fetchAll();


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


<!--script>
        document.addEventListener('DOMContentLoaded', function () {
            const emblaNode = document.querySelector('.embla');
            const embla = EmblaCarousel(emblaNode, {
                loop: true,
                dragFree: true,
                containScroll: 'trimSnaps',
            });

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
        });
    </script-->





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
              <div class="grid gap-2 lg:grid-cols-2 lg:grid-rows-2">
               

                <!-- CHARTS -->
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <div
                  class="rounded-xl border bg-card text-card-foreground row-span-2 shadow-sm"
                >
                  <div class="p-4">
                    <canvas  id="myPieChart"  
                      class="recharts-responsive-container"
                      style="width: 100%; height: 350px; min-width: 0"
                    ></canvas>
                    <!--canvas id="myPieChart" width="400" height="400"></canvas-->
                  </div>
                </div>
                <script>
                var ctx = document.getElementById('myPieChart').getContext('2d');
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                        datasets: [{
                            data: [12, 19, 3, 5, 2, 3],
                            backgroundColor: [
                                'red',
                                'blue',
                                'yellow',
                                'green',
                                'purple',
                                'orange'
                            ],
                        }]
                    },
                    options: {
                        // Additional options go here
                    }
                });
            </script>


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
                        style="fill: red;" 
                        src="theme/vendors/bootstrap-icons-1.10.5/people-fill.svg"
                      /-->
                      <i class="bi bi-people-fill" style="font-size: 3.5rem; color: #f97216;"></i>
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
                      <img
                        alt="Svg Icon"
                        loading="lazy"
                        width="50"
                        height="50"
                        decoding="async"
                        data-nimg="1"
                        style="color: transparent"
                        src="svgs/donation-2.svg"
                      />
                      <i class="mdi mdi-mdi mdi-pig menu-icon"></i>
                      <span class="ml-2 font-inter text-2xl"><?php echo $campaigns_total ;?></span><br><br>
                      <span class="ml-2 font-inter text-2xlx small">N<?php echo number_format($campaigns_amount_total,2) ;?></span>
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
                      <img
                        alt="Svg Icon"
                        loading="lazy"
                        width="50"
                        height="50"
                        decoding="async"
                        data-nimg="1"
                        style="color: transparent"
                        src="svgs/donation-1.svg"
                      />
                      <i class="mdi mdi-mdi mdi-pig menu-icon"></i>
                      <span class="ml-2 font-inter text-2xl"><?php echo $donations_total ;?></span><br><br>
                      <span class="ml-2 font-inter text-2xlx small">N<?php echo number_format($donations_amount_total,2) ;?></span>
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
                        src="svgs/donation-2.svg"
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
                  <a href="_admin_create_donation.php"  
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


                <!-- EMBLA -->
                <div class="p-6 pt-0">
                  <div class="embla">
                    <!--div class="embla__viewport"-->
                      <div class="embla__container">

                        <?php 
                          if($admin_campaigns_list_component_datasource){ 
                            for($i=0; $i < count($admin_campaigns_list_component_datasource);$i++)
                            {
                               $current_amount_raised=getTotalDonationForProject($pdo,$admin_campaigns_list_component_datasource[$i]["id"]); 
                        ?>
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
                               
                               src="<?php echo APP_UPLOADS.APP_DOCUMENTS.$admin_campaigns_list_component_datasource[$i]["poster"];?>"
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
                                  ><?php echo $admin_campaigns_list_component_datasource[$i]["category"];   ?></span
                                >
                              </h3>
                            </div>
                            <div class="p-6 pt-4">
                              <h3
                                class="mb-2 scroll-m-20 font-inter text-xl font-semibold tracking-tight"
                              >
                                <?php echo $admin_campaigns_list_component_datasource[$i]["donation_title"];   ?>
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
                            <div class="flex items-center p-6 pt-0">
                              <a 
                              href="_admin_campaign_view.php?hkj476hkjhjk655665hkhjkhkty55343233444445778hjklhjgcvdfxsesfdfgjkhkljlljljl=<?php echo $admin_campaigns_list_component_datasource[$i]["id"];?>&admin_campaigns_list_component_searchTerm=<?php echo $searchTerm;?>" 
                        
                                class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 w-full bg-brand hover:bg-brand-600"
                              >
                                Check it now
                              </a>
                            </div>
                          </div>
                          <div class="embla__slide__number"><span>1</span></div>
                        </div>
                        <?php } } ?>
                        
                      </div>
                    <!--/div--><!-- view poert -->
                    <div class="embla__dots"></div>
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
