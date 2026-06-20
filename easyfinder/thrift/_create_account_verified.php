<?php
session_start();
include_once "ini.php";
include_once "functions.php";
include_once "functions_custom.php";

if(isset($_SESSION[APP_SESSION_NAME]))
{   
  header("location: index.php");
  exit();
}

if(isset($_SESSION['signuflow'])){
unset($_SESSION['signuflow']);
//session_destroy();
}

$searchTerm='';
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
    <title>OTP Verification - <?php echo APP_FULLNAME  ;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="favicon.ico" type="image/x-icon" sizes="any" />
    <meta name="next-size-adjust" />

    <?php include_once('_css.php');?>
    
  </head>
  <body class="__variable_20951f __variable_9bfd88 bg-[#f98727]">

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

            <div class="p-6 pt-6x">

                <form class="mt-4">
                  
                    <div class="grid w-full items-center gap-8">
                      <div class="flex flex-col space-y-1.5">

                      <h3 class="font-semibold leading-none tracking-tight flex items-center justify-center align-center">
    <i class="bi bi-check-circle   animate__animated animate__  animate__bounce  animate__delay-1s " style="font-size: 3.5rem; color: green;"></i>
</h3>

                        
                          <b class="sm:mt-8 lg:mt-16 text-center">
                            Your account has been verified, please <a href="index.php">log in</a>, thank you.                            
                          </b>
                        </div>
                    </div>


                    <!--div class="flex justify-center">
                        <a
                          class="inline-flex items-center justify-center font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 underline-offset-4 hover:underline h-8 rounded-md px-3 text-md text-blue-600"
                          href="_otp.php?djjskjksdjkjkjkljhf834ekhuyyhh-----------------------------------------------------------------sdsdf=<?php echo $otpCode;?>"
                          >Don`t get a verification code?</a
                        >
                    </div-->
                      
                </form>
            </div>
            
          </div>
        </div>
      </div>
    </main>
    <?php include_once('_footer.php');?>


  </body>
</html>


