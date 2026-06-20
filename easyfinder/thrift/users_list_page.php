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
//COMPONENT:users_list_component
//TITLE:    Users
//TYPE:     tableV5
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

      $stmt = $pdo->prepare("SELECT  *  FROM `users`  WHERE  `ownerId`=?  AND `fullname` LIKE ?  OR `emailAddress` LIKE ?  OR `phoneNo` LIKE ?  OR `address` LIKE ?  OR `isActive` LIKE ? ");
      /*Execute SQL*/
      $stmt->execute([ $ownerId  , "%$users_list_component_searchTerm%","%$users_list_component_searchTerm%","%$users_list_component_searchTerm%","%$users_list_component_searchTerm%","%$users_list_component_searchTerm%",]);

    }
    else
    {

      $stmt = $pdo->prepare("SELECT  *  FROM `users`  WHERE  `ownerId`=? ");
      /*Execute SQL*/
      $stmt->execute([ $ownerId ]);

    }
    

    /*Fetch SQL result*/
    $users_list_component_datasource = $stmt->fetchAll();

    ?>

<?php 
/******************************************************************DISPLAY******************************************************************/
?>

<div class="mt-1 mb-1 col-12 col-md-12 col-lg-12 stretch-card"  style="max-height: 460px;">
  <div class="card pt-0" style="overflow-x: hidden;">
    <div class="card-body p-2">
      <div class="bg-white sticky-top animate__animated  animate__bounce  animate__delay-1s ">
        <p class="card-title mb-2">Users
        </p>
        <p class="card-description"> Manage Users </p>
      </div>
<?php 
/**************************************************************/
//VERSION:  
//PARTIAL:  Controls
/**************************************************************/
?><div class="row pull-right mt-2 animate__animated  animate__fadeIn  animate__delay-1s ">
   <div class="d-flex flex-row mb-3">
<div class="p-2">

            <!--p class="card-title">Users</p-->
            <?php /*if (strpos($_SESSION[APP_SESSION_NAME]["privileges"], Privilege_AddUsers_Enabled) !== FALSE) {*/ ?>
            <a class="btn btn-sm btn-primary btn-link text-white m-1"
                href="users_form_page.php?id=-1&task=new&users_list_component_searchTerm=<?php echo $users_list_component_searchTerm;?>">
                Add New </a><!-- Users</a-->
            </div><div class="p-2">
</div><div class="p-2">
</div><div class="p-2">
</div></div></div>
<div class="row mt-2 bg-white sticky-top">

    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-end flex-wrap">
                <div class="mr-md-3 mr-xl-5">

                    <div class="animate__animated  animate__slideInLeft  animate__delay-1s ">
                        <h1 class="display-5 font-weight-bold">
                            <?php echo count($users_list_component_datasource); ?>
                            <?php /*echo "Users(s)";*/ ?>
                            <?php echo " result(s)";?>
                            </h1>
                        <!--p class="mb-md-0"></p-->
                    </div>
                </div>
                <!--div class="d-flex">
            <i class="mdi mdi-home text-muted hover-cursor"></i>
            <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
            <p class="text-primary mb-0 hover-cursor">Analytics</p>
          </div-->
            </div><div class="d-flex justify-content-between align-items-end flex-wrap">
                <div class="col-12 ml-auto animate__animated  animate__slideInLeft  animate__delay-1s ">
                    <div class="form-group">
                        <form method="get" action="">
                            <div class="input-group animate__animated  animate__fadeIn  animate__delay-1s ">
                                <input type="text" name="users_list_component_searchTerm"
                                class="form-control" placeholder="Type here" aria-label="Type here"
                                value="<?php echo $users_list_component_searchTerm;?>">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div></div>
        <div class="table-responsive animate__animated  animate__fadeIn  animate__delay-1s" style="max-height:300px">
          <div id="recent-purchases-listing_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
            <div class="row"><div class="col-sm-12 col-md-6"></div>
            <div class="col-sm-12 col-md-6"></div>
          </div>
          <div class="row">
            <div class="col-12 table-container">
            <table id="recent-purchases-listing" class="table dataTable no-footer" role="grid">
              <thead>
                  <tr role="row">
                      <th class="text-center" style="width: 13.817px;">#</th><th class="sorting_asc" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1"  aria-label="Dated: activate to sort column descending" aria-sort="ascending"><label class="col-sm-12 col-form-label pb-0 mb-0 font-weight-bold"><?php echo(putSpaceBetweenWords("Fullname"));?></label></th>
<th class="sorting_asc" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1"  aria-label="Dated: activate to sort column descending" aria-sort="ascending"><label class="col-sm-12 col-form-label pb-0 mb-0 font-weight-bold"><?php echo(putSpaceBetweenWords("EmailAddress"));?></label></th>
<th class="sorting_asc" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1"  aria-label="Dated: activate to sort column descending" aria-sort="ascending"><label class="col-sm-12 col-form-label pb-0 mb-0 font-weight-bold"><?php echo(putSpaceBetweenWords("PhoneNo"));?></label></th>
<th class="sorting_asc" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1"  aria-label="Dated: activate to sort column descending" aria-sort="ascending"><label class="col-sm-12 col-form-label pb-0 mb-0 font-weight-bold"><?php echo(putSpaceBetweenWords("Address"));?></label></th>
<th class="sorting_asc" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1"  aria-label="Dated: activate to sort column descending" aria-sort="ascending"><label class="col-sm-12 col-form-label pb-0 mb-0 font-weight-bold"><?php echo(putSpaceBetweenWords("IsActive"));?></label></th>
<th class="text-center" style="width: 13.817px;"></th>
                  </tr>
              </thead>
<?php $csv_header="";$csv_row=array();$csv_rows=""; ?>
<tbody>

<?php 
/**************************************************************/
//VERSION:  
//PARTIAL:  List Data
/**************************************************************/
?>
<?php 
/**************************************************************/
//VERSION:  
//PARTIAL:  List Data
/**************************************************************/
?>
<?php 
/**************************************************************/
//VERSION:  
//PARTIAL:  List Data
/**************************************************************/
?>
<?php 
/**************************************************************/
//VERSION:  
//PARTIAL:  List Data
/**************************************************************/
?>
<?php 
/**************************************************************/
//VERSION:  
//PARTIAL:  List Data
/**************************************************************/
?>
              <?php 
                if($users_list_component_datasource){ 
                  for($i=0; $i < count($users_list_component_datasource);$i++)
                  {
              ?>

              <tr role="row" class="odd">
                <td class="font-weight-bold text-center"><?php echo ($i + 1);?></td>
                      <td class="sorting_1 font-weight-boldx"> <a href="users_form_page.php?id=<?php echo $users_list_component_datasource[$i]["id"]?>&task=edit&searchTerm=<?php if(!empty($searchTerm)){ if(is_array($searchTerm)){echo urlencode(json_encode($searchTerm));}else{echo urlencode($searchTerm);} } ?>"><?php echo $users_list_component_datasource[$i]["fullname"];   ?> </a> <?php $csv_row[] = $users_list_component_datasource[$i]["fullname"];?>

                      </td>
                      <td class="sorting_1 font-weight-boldx"> <a href="users_form_page.php?id=<?php echo $users_list_component_datasource[$i]["id"]?>&task=edit&searchTerm=<?php if(!empty($searchTerm)){ if(is_array($searchTerm)){echo urlencode(json_encode($searchTerm));}else{echo urlencode($searchTerm);} } ?>"><?php echo $users_list_component_datasource[$i]["emailAddress"];   ?> </a> <?php $csv_row[] = $users_list_component_datasource[$i]["emailAddress"];?>

                      </td>
                      <td class="sorting_1 font-weight-boldx"> <a href="users_form_page.php?id=<?php echo $users_list_component_datasource[$i]["id"]?>&task=edit&searchTerm=<?php if(!empty($searchTerm)){ if(is_array($searchTerm)){echo urlencode(json_encode($searchTerm));}else{echo urlencode($searchTerm);} } ?>"><?php echo $users_list_component_datasource[$i]["phoneNo"];   ?> </a> <?php $csv_row[] = $users_list_component_datasource[$i]["phoneNo"];?>

                      </td>
                      <td class="sorting_1 font-weight-boldx"> <a href="users_form_page.php?id=<?php echo $users_list_component_datasource[$i]["id"]?>&task=edit&searchTerm=<?php if(!empty($searchTerm)){ if(is_array($searchTerm)){echo urlencode(json_encode($searchTerm));}else{echo urlencode($searchTerm);} } ?>"><?php echo $users_list_component_datasource[$i]["address"];   ?> </a> <?php $csv_row[] = $users_list_component_datasource[$i]["address"];?>

                      </td>
                      <td class="sorting_1 font-weight-boldx"> <a href="users_form_page.php?id=<?php echo $users_list_component_datasource[$i]["id"]?>&task=edit&searchTerm=<?php if(!empty($searchTerm)){ if(is_array($searchTerm)){echo urlencode(json_encode($searchTerm));}else{echo urlencode($searchTerm);} } ?>"><?php 
              if($users_list_component_datasource[$i]["isActive"]==1){
              echo "Yes";
              }else{
              echo "No";
              }   ?> </a> <?php $csv_row[] = $users_list_component_datasource[$i]["isActive"];?>

                      </td>
                <td>
                  <form method="GET" action="helper.php"> 
                      <input type="hidden" name="id" value="<?php echo $users_list_component_datasource[$i]["id"]?>"> 
                      <input type="hidden" name="task" value="delete">
                      <input type="hidden" name="object" value="users">  
                      <input type="hidden" name="from" value="users_list_page.php"> 
                      <input type="hidden" name="to" value="users_list_page.php"> 
                      <input type="hidden" name="searchTerm" value="<?php echo $searchTerm;?>"> 
                      <button type="submit" class="btn btn-link text-danger font-weight-bold">Delete</button>
                    </form>
                  
                </td>
              </tr>
<?php $csv_rows .= $users_list_component_datasource[$i]["id"].",".implode(",",$csv_row)."\n"; unset($csv_row); ?>

              <?php }//for ?>
<?php  }//if ?>
              </tbody>
            </table>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-5"></div>
            <div class="col-sm-12 col-md-7"></div></div>
          </div>
        </div>


    </div>
  </div>
</div><?php 
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