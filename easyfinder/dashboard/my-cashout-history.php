<?php
require_once '../inc/user_session.inc.php';

$PAGE_TITLE   = 'Cash-Out History';
$URL_NAME     = 'dashboard/my-cashout-history';
require_once("../inc/accessbility_controller.inc.php"); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <?php
   require_once 'layout/header-propt.inc.php';
   ?>

<title><?= $PAGE_TITLE." | ".SITE_TITLE ?> </title>
</head>
<body>

   <?php  require_once 'layout/preloader.inc.php'; ?>

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

      
   <?php
   require_once 'layout/header.inc.php';
   require_once 'layout/sidebar.inc.php';
   ?>





       
    <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
          <?php  include('layout/minor-top-navbar.inc.php'); ?>
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4 style="color: #003366; font-size: 20px"><?= $PAGE_TITLE ?></h4>
                            
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)"><?= SITE_TITLE ?> </a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)"><?= $PAGE_TITLE ?></a></li>
                        </ol>
                    </div>
                </div>




      
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?=$PAGE_TITLE ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                               <th>#</th>
    
                                              <th>Trans ID</th>
                                              <th>Amount</th>
                                              <th>Account Number</th>
                                              <th>Account Name</th>
                                              <th>Bank Name</th>
                                              <th>Status</th>
                                              <th>Trans Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                          if($MyCashOuts = $WalletController->Get_Request_Wallet_Money_Cash_Out($Auth->email,$Auth->admin_role)){
                            $sn=0;
                          foreach ($MyCashOuts as $MyCashOut) {
                            $sn++;
                            ?>
                                            <tr>
                                              <td><?= $sn ?></td>
                                    <td><a href="#" style="color: #003366"><?= $MyCashOut->request_id ?></a></td>
                                    <td>N<?= $MyCashOut->amount ?></td>
                                    <td><?= $MyCashOut->account_number ?></td>
                                    <td><?= strtoupper($MyCashOut->account_name) ?></td>
                                    <td><?= $WalletController->Get_Single_Bank_Info($MyCashOut->bank_code)->bank_name ?></td>
                                    
                                    <td><?= $MyCashOut->status == 1 ? '<span class="badge light badge-success">Successful</span>' : "<span class='badge light badge-info'>Pending</span>"?></td>
                                    <td><?= $MyCashOut->request_date ?></td>

                                      </tr>


                                      <?php
                                    }
                                    }
                                      ?>
                                                                                
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                              <th>Trans ID</th>
                                              <th>Amount</th>
                                              <th>Account Number</th>
                                              <th>Account Name</th>
                                              <th>Bank Name</th>
                                              <th>Status</th>
                                              <th>Trans Date</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                </div>








            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

 

    </div>
 
  <?php
  require_once 'layout/footer.inc.php';
   require_once 'layout/footer-propt.inc.php';
   ?>
  
</body>
</html>