<?php 
session_start();

include_once "ini.php";
include_once "functions.php";


if (!isset($_SESSION[APP_SESSION_NAME]) ){
  header("location: logout.php");
}
$pdo = getMySQLPDOLink_(false,false);
$id = $_SESSION[APP_SESSION_NAME]["id"];
$task= "";
$errorMessage="";


$fullname=$_SESSION[APP_SESSION_NAME]["fullname"];
$phoneNo=$_SESSION[APP_SESSION_NAME]["phoneNo"];
$emailAddress=$_SESSION[APP_SESSION_NAME]["emailAddress"];
$address=$_SESSION[APP_SESSION_NAME]["address"];
$logoPath=$_SESSION[APP_SESSION_NAME]["logoPath"];
$privileges=$_SESSION[APP_SESSION_NAME]["privileges"];
$username=$_SESSION[APP_SESSION_NAME]["username"];
$password=$_SESSION[APP_SESSION_NAME]["password"];

$owner_ = getRow($pdo, $_SESSION[APP_SESSION_NAME]["ownerId"], "SELECT * FROM `owners` WHERE `id`=?");

$ownerId = $owner_["id"];
$ownerFullname = $owner_["fullname"];
$ownerUsername=$owner_["username"];
$ownerPassword="";
$ownerPhoneNo=$owner_["phoneNo"];
$ownerEmailAddress=$owner_["emailAddress"];
$ownerAddress=$owner_["address"];
$ownerLogoPath=$owner_["logoPath"];


if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST)){
  if (isset($_POST["id"])) { $id = $_POST["id"];  }
  if (isset($_POST["task"])) { $task = $_POST["task"];  }
if (isset($_POST["fullname"])){$fullname=$_POST["fullname"];}
if (isset($_POST["phoneNo"])){$phoneNo=$_POST["phoneNo"];}
if (isset($_POST["emailAddress"])){$emailAddress=$_POST["emailAddress"];}
if (isset($_POST["address"])){$address=$_POST["address"];}
if (isset($_POST["logoPath"])){$logoPath=$_POST["logoPath"];}
if (isset($_POST["privileges"])){$privileges=$_POST["privileges"];}
if (isset($_POST["username"])){$username=$_POST["username"];}
if (isset($_POST["password"])){$password=$_POST["password"];}

if (isset($_POST["ownerId"])) { $ownerId = $_POST["ownerId"];  }
  if (isset($_POST["ownerFullname"])) { $ownerFullname = $_POST["ownerFullname"];  }
  if (isset($_POST["ownerUsername"])) { $ownerUsername = $_POST["ownerUsername"];  }
  if (isset($_POST["ownerPassword"])&& !empty($_POST["ownerPassword"])) { $ownerPassword = $_POST["ownerPassword"];  }//else{$adminPassword="";}
  if (isset($_POST["ownerPhoneNo"])) { $ownerPhoneNo = $_POST["ownerPhoneNo"];  }
  if (isset($_POST["ownerAddress"])) { $ownerAddress = $_POST["ownerAddress"];  }
  if (isset($_POST["ownerEmailAddress"])) { $ownerEmailAddress = $_POST["ownerEmailAddress"];  }
  if (isset($_POST["ownerLogoPath"])) { $ownerLogoPath = $_POST["ownerLogoPath"];  }


//handle logo
  if (isset($_FILES["admin_logo_file"]) && !empty($_FILES["admin_logo_file"])){
    if ($_FILES["admin_logo_file"]["type"] == "image/jpeg" || $_FILES["admin_logo_file"]["type"] == "image/bmp" || $_FILES["admin_logo_file"]["type"] == "image/png") {
        $newslide = $_SESSION[APP_SESSION_NAME]["id"]."-u-".$id."-logo";//. $_FILES["admin_logo_file"]["name"];
    copy($_FILES["admin_logo_file"]["tmp_name"], APP_UPLOADS.APP_USERS.$newslide)
    or die("Could not copy");

    if (!empty($newslide)) {
      if(APP_STOREUPLOADPATHINDATABASE){
      $logoPath = APP_UPLOADS.APP_USERS.$newslide;
      }else{
        $logoPath = $newslide;
      }
    }
    }
  }

   //handle logo
  if (isset($_FILES["owner_logo_file"]) && !empty($_FILES["owner_logo_file"])){
     
    if ($_FILES["owner_logo_file"]["type"] == "image/jpeg" || $_FILES["owner_logo_file"]["type"] == "image/bmp" || $_FILES["owner_logo_file"]["type"] == "image/png") {
        $newslide = $_SESSION[APP_SESSION_NAME]["id"]."-o-".$ownerId."-logo";//.$extension;//. $_FILES["owner_logo_file"]["name"];
    copy($_FILES["owner_logo_file"]["tmp_name"], APP_UPLOADS.APP_USERS.$newslide)
    or die("Could not copy");

    /*set company img as app*,/
    copy($_FILES["owner_logo_file"]["tmp_name"], APP_ROOT.APP_UI."/images/".APP_LOGO)
    or die("Could not copy");

    copy($_FILES["owner_logo_file"]["tmp_name"], APP_ROOT.APP_UI."/images/".APP_LOGO_MINI)
    or die("Could not copy");

    copy($_FILES["owner_logo_file"]["tmp_name"], APP_ROOT.APP_UI."/images/".APP_ICON)
    or die("Could not copy");
    */
    
    if (!empty($newslide)) {
      if(APP_STOREUPLOADPATHINDATABASE){
      $ownerLogoPath = APP_UPLOADS.APP_USERS.$newslide;
      }else{
        $ownerLogoPath = $newslide;
      }
    }
    }
  }

}


//save logic

switch ($task) {
  case "save":
    if($id == -1){
        
    }elseif ($id > 0 ) {
      try {
          /*admin*/
          $stmt = $pdo->prepare("UPDATE `users` SET  `oldId`=?,`fullname`=?,`phoneNo`=?,`emailAddress`=?,`address`=?,`logoPath`=?,`privileges`=?,`username`=?, `updatedBy`=?,`updatedOn`=? WHERE `id`=?");
          $stmt->execute([$id,$fullname,$phoneNo,$emailAddress,$address,$logoPath,$privileges,$username, $_SESSION[APP_SESSION_NAME]["fullname"]." (".$_SESSION[APP_SESSION_NAME]["id"].")", getDate_() ,$id]);
          if (!empty($password)) {
            $encryptedPass= md5(sanitizeString_($password));  
            $encryptedPass= $encryptedPass.APP_X;
            $encryptedPass = password_hash($encryptedPass, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("UPDATE `users` SET  `password`=? WHERE `id`=?");
            $stmt->execute([$encryptedPass,$id]);
          }

          //reload administrator SESSION
          $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `id`=?");
          $stmt->execute([$id]);
          $data = $stmt->fetchAll();
          if ($data) {

            //get owner
            $ownerdata =array();
            $stmt = $pdo->prepare("SELECT * FROM `owners` WHERE `id`=?");
            $stmt->execute([$data[0]["ownerId"]]);
            $ownerdata = $stmt->fetchAll();

           session_regenerate_id();
           $_SESSION[APP_SESSION_NAME] = $data[0];    
           $_SESSION[APP_SESSION_NAME]["owner"] = $ownerdata[0];       
           session_write_close();
          }

          /*company*/
          $stmt = $pdo->prepare("UPDATE `owners` SET  `oldId`=?,`logoPath`=?, `address`=?,`emailAddress`=?,`phoneNo`=?, `fullname`=?,`username`=?, `updatedBy`=?,`updatedOn`=? WHERE `id`=?");
          $stmt->execute([$ownerId, $ownerLogoPath, $ownerAddress, $ownerEmailAddress, $ownerPhoneNo, $ownerFullname,$ownerUsername,$_SESSION[APP_SESSION_NAME]["fullname"]." (".$_SESSION[APP_SESSION_NAME]["id"].")", getDate_() ,$ownerId]);
          if (!empty($ownerPassword)) {
            $encryptedPass= md5(sanitizeString_($ownerPassword));  
            $encryptedPass= $encryptedPass.APP_X;//"$2y$10$wc6yej4vLGZo0pyTejPGAO280c8VV3zsjM8MspBcGT/P.cUU1pzTi";
            $encryptedPass = password_hash($encryptedPass, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("UPDATE `owners` SET  `password`=? WHERE `id`=?");
            $stmt->execute([$encryptedPass,$id]);
          }
          
        } catch (\PDOException $e) {
            $errorMessage .= "<b>Error updating user</b><br>";
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
      }else{
        //header("location: employees.php");
      }
    break;
  
  default:
    
    break;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Profile | <?php echo APP_TITLE;?></title>
  <!-- plugins:css -->
  <?php include "css.php";?>
  <!-- endinject -->
  <link rel="shortcut icon" href="theme/images/favicon.png" />
</head>
<body>
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

          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
              <div class="card-body p-2">
                  <h4 class="card-title">Profile</h4>
                  <?php //echo "id:".$id."/task:".$task;?>
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
                  <form class="form-sample" method="POST" action=""   enctype="multipart/form-data">
                    <p class="card-description">
                      Add/Edit
                    </p>

                    <input type="hidden" name="task" value="save" />
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="hidden" name="ownerId" value="<?php echo $ownerId;?>">
                    

                    <input type="hidden" name="privileges" value="<?php echo $privileges;?>">

                    

                    <div class="row">
                      <div class="col-12">
                      <h4 class="card-title">Administrator</h4>
                      </div>

                       <div class="col-md-3">
                          <div class="form-group rowx">
                              <label class="col-sm-3 col-form-label">Logo</label>
                              <div class="col-sm-12">
                              <?php if(APP_STOREUPLOADPATHINDATABASE !=true){?>
                                  <img style="width: 36px;height: 36px;border-radius: 100%;" src="<?php if(!empty($logoPath)){ echo APP_UPLOADS.APP_USERS.$logoPath;}?>">
                                <?php }else{?>
                                  <img style="width: 36px;height: 36px;border-radius: 100%;" src="<?php if(!empty($logoPath)){ echo $logoPath;}?>">
                                <?php }?>
                                  <input class="custom-file-inputs" id="admin_logo_file" name="admin_logo_file" type="file" style="text-overflow: ellipsis;">
                              </div>
                          </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group rowx">
                          <label class="col-sm-12 col-form-label">Name</label>
                          <div class="col-sm-12">
                            <input type="text" class="form-control form-control-sm" name="fullname" placeholder="Name" value="<?php echo $fullname ;?>" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group rowx">
                          <label class="col-sm-12 col-form-label">Phone No</label>
                          <div class="col-sm-12">
                            <input type="text" class="form-control form-control-sm" name="phoneNo" placeholder="Phone No" value="<?php echo $phoneNo ;?>" >
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group rowx">
                          <label class="col-sm-12 col-form-label">Email</label>
                          <div class="col-sm-12">
                            <input type="email" class="form-control form-control-sm" name="emailAddress" placeholder="Email Address" value="<?php echo $emailAddress ;?>" >
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group rowx">
                          <label class="col-sm-12 col-form-label">Address</label>
                          <div class="col-sm-12">
                            <input type="text" class="form-control form-control-sm" name="address" placeholder="Address" value="<?php echo $address ;?>" >
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group rowx">
                          <label class="col-sm-12 col-form-label">Username</label>
                          <div class="col-sm-12">
                            <input type="text" class="form-control form-control-sm" name="username" placeholder="Username" value="<?php echo $username ;?>"  readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group rowx">
                          <label class="col-sm-12 col-form-label">Password</label>
                          <div class="col-sm-12">
                            <?php //if(empty($adminPassword)){?>
                            <!--input type="text" class="form-control form-control-sm" name="adminPassword" placeholder="Password" required-->
                            <?php //}else{?>
                            <input type="text" class="form-control form-control-sm" name="password" placeholder="Password" >
                            <small>Leave blank, unless you want to change it.</small>
                            <?php //}?>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group rowx">
                           <?php if (strpos($_SESSION[APP_SESSION_NAME]["privileges"], Privilege_ManagePrivileges_Enabled) !== FALSE && APP_FEATURE_ENFORCE_PRIVILEGES==true) {?>
                                                      <label class="col-sm-12 col-form-label">Privileges</label>
                      <div class="col-sm-12">
                        <?php
                          $privileges_ = explode(",", $privileges);
                          if (count($privileges_)>0) {?>
                          <div class="btn-group">
                            <button type="button" class="font-weight-bold btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Privileges</button>
                            <div class="dropdown-menu mt-5" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;border: 1px solid gray !important;">
                              <?php 
                                for ($i=0; $i < count($privileges_) ; $i++) { ?>
                                  <a class="dropdown-item bold small" href="user-privileges-exec.php?yuyr6uuu=<?php echo $id;?>&74yery=<?php echo $privileges_[$i];?>">
                                    
                                    <?php echo $privileges_[$i];?>
                                    <?php 
                                      if (strpos($privileges_[$i], "_") > 0) {?>
                                        
                                    <?php }else{?>
                                      <i class="mdi mdi-check-circle text-primary mx-2"></i>
                                    <?php } ?>   
                                  </a>
                            <?php  } ?>
                            </div>                          
                              </div>

                          <?php }
                            ?>
                      </div>
                      <?php }?>
                        </div>
                      </div>

                     


                    </div>                  
<hr>
<?php if($_SESSION[APP_SESSION_NAME]["isAdmin"]==1){?>
                    <div class="row">
                      <div class="col-12"><h4 class="card-title">Company</h4></div>

                      <div class="col-md-3">
                          <div class="form-group rowx">
                              <label class="col-sm-3 col-form-label">Logo</label>
                              <div class="col-sm-12">
                                  <!--input autofocus name="code" type="text" class="form-control form-control-sm" placeholder="Code" value="<?php echo $code ;?>"-->
                                  <?php if(APP_STOREUPLOADPATHINDATABASE !=true){?>
                                  <img style="width: 36px;height: 36px;border-radius: 100%;" src="<?php if(!empty($ownerLogoPath)){ echo APP_UPLOADS.APP_USERS.$ownerLogoPath;}?>" >
                                  <?php }else{?>
                                  <img style="width: 36px;height: 36px;border-radius: 100%;" src="<?php if(!empty($ownerLogoPath)){ echo $ownerLogoPath;}?>">
                                  <?php }?>
                                  <input class="custom-file-inputs" id="owner_logo_file" name="owner_logo_file" type="file" style="text-overflow: ellipsis;">
                              </div>
                          </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group rowx">
                          <label class="col-sm-12 col-form-label">Name</label>
                          <div class="col-sm-12">
                            <input type="text" class="form-control form-control-sm" name="ownerFullname" placeholder="Name" value="<?php echo $ownerFullname ;?>" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group rowx">
                          <label class="col-sm-12 col-form-label">Phone No</label>
                          <div class="col-sm-12">
                            <input type="text" class="form-control form-control-sm" name="ownerPhoneNo" placeholder="Phone No" value="<?php echo $ownerPhoneNo ;?>" >
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group rowx">
                          <label class="col-sm-12 col-form-label">Email</label>
                          <div class="col-sm-12">
                            <input type="email" class="form-control form-control-sm" name="ownerEmailAddress" placeholder="Email Address" value="<?php echo $ownerEmailAddress ;?>" >
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group rowx">
                          <label class="col-sm-12 col-form-label">Address</label>
                          <div class="col-sm-12">
                            <input type="text" class="form-control form-control-sm" name="ownerAddress" placeholder="Address" value="<?php echo $ownerAddress ;?>" >
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group rowx">
                          <label class="col-sm-12 col-form-label">Username</label>
                          <div class="col-sm-12">
                            <input type="text" class="form-control form-control-sm" name="ownerUsername" placeholder="Username" value="<?php echo $ownerUsername ;?>"  readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group rowx">
                          <label class="col-sm-12 col-form-label">Password</label>
                          <div class="col-sm-12">
                            <?php //if(empty($ownerPassword)){?>
                            <!--input type="text" class="form-control form-control-sm" name="ownerPassword" placeholder="Password" required-->
                            <?php //}else{?>
                            <input type="text" class="form-control form-control-sm" name="ownerPassword" placeholder="Password" value="">
                            <small>Leave blank, unless you want to change it.</small>
                            <?php //}?>
                          </div>
                        </div>
                      </div>
                     

                    </div> 
<?php }?>
                    <div class="row mt-2">
                      <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-sm btn-primary mr-2">Save</button>
                        <a class="btn btn-sm btn-dark" href="dashboard.php">Close</a>
                      </div>
                    </div>

                   
                    
                  </form>
                </div>
              </div>
            </div>
          </div>
          
          

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



