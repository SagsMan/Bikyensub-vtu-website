<?php
require_once '../inc/user_session.inc.php';

$PAGE_TITLE   = 'NIN Search Validation';
$URL_NAME     = 'NIN Search_validation';
// require_once "../inc/accessbility_controller.inc.php";

// $coatofarm = base64_encode(file_get_contents('./images/verification/nigeria-govt-icon.jpg'));
// $ninIcon =  base64_encode(file_get_contents('./images/verification/nimc-icon.png'));
// $helpdeskicon =  base64_encode(file_get_contents('./images/verification/helpdesk.png'));
// $explorericon =  base64_encode(file_get_contents('./images/verification/internet-explorer-icon.png'));
// $callicon =  base64_encode(file_get_contents('./images/verification/call-48.png'));
// $postalicon =  base64_encode(file_get_contents('./images/verification/postal-48.png'));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once 'layout/header-propt.inc.php';
    ?>

    <title><?= $PAGE_TITLE . " | " . SITE_TITLE ?> </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Charm&family=Playwrite+CO+Guides&display=swap" rel="stylesheet">
    <style>
        @page {
    size: A4;
    margin: 0;  /* Force no margin */
}
        @media print {
            body * {
                visibility: hidden;
            }

            .no-print {
                display: none;
            }
            #main-wrapper {
                padding: 0;
                margin: 0;
                border: none;
            }

            /* .content-body {
                visibility: hidden;
            } */

            #print-section,
            #print-section * {
                visibility: visible;
            }

            #print-section {
                position: absolute;
                left: 0;
                top: 0;
                display: block;
            }

            /* .nin-slip {
                page-break-inside: avoid;
            }

            .nin-slip .header,
            .nin-slip .content {
                page-break-inside: avoid;
            } */
        }
    </style>
</head>

<body>

    <?php require_once 'layout/preloader.inc.php'; ?>

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
        <div class="content-body no-print">
            <?php include('layout/minor-top-navbar.inc.php'); ?>
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4 style="color: #003366; font-size: 20px"><?= $PAGE_TITLE ?></h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)"><?= SITE_TITLE ?></a></li>
                            <li class="breadcrumb-item"><a href="./verifications">Verifications</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)"><?= $PAGE_TITLE ?></a></li>
                        </ol>
                    </div>
                </div>






                <div id="result"></div>
                <!-- row -->
                <div class="row">

                    <div class="col-xl-4 col-lg-6 col-xxl-4 col-sm-6">
                        <div class="card text-white verification-card shadow py-4">
                            <button data-toggle="modal" data-target="#NRSModal">
                                <div class="d-flex flex-sm-row flex-column align-items-center" style="row-gap: 10px">
                                    <img src="./images/verification/regular_nin_slip.jpg" class="validation-image mr-2" alt="">
                                    <div>
                                        <h5 class="text-white">NIN Regular Slip</h5>
                                        <p class="fs-14" style="color: #7e7e7e">
                                            You'll be charge <span class="badge badge-warning p-1">
                                                ₦ 0
                                            </span> if No record found.
                                        </p>
                                        <div>
                                            <span class="font-weight-bold">Price: </span>
                                            <span class="badge badge-danger p-1"> ₦ <?= NIN_SEARCH_REGULAR_PRICE ?></span>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-xxl-4 col-sm-6">
                        <div class="card text-white verification-card shadow py-4">
                            <button data-toggle="modal" data-target="#NISModal">
                                <div class="d-flex align-items-center">
                                    <img src="./images/verification/improved.png" class="validation-image mr-2" alt="">
                                    <div>
                                        <h5 class="text-white">Improved NIN Slip</h5>
                                        <p class="fs-14" style="color: #7e7e7e">
                                            You'll be charge <span class="badge badge-warning p-1">
                                                ₦ 0
                                            </span> if No record found.
                                        </p>
                                        <div>
                                            <span class="font-weight-bold">Price: </span>
                                            <span class="badge badge-danger p-1"> ₦ <?= NIN_SEARCH_IMPROVE_PRICE ?></span>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-xxl-4 col-sm-6">
                        <div class="card text-white verification-card shadow py-4">
                            <button data-toggle="modal" data-target="#NPSModal">
                                <div class="d-flex align-items-center">
                                    <img src="./images/verification/premium.png" class="validation-image mr-2" alt="">
                                    <div>
                                        <h5 class="text-white">Premium NIN Slip</h5>
                                        <p class="fs-14" style="color: #7e7e7e">
                                            You'll be charge <span class="badge badge-warning p-1">
                                                ₦ 0
                                            </span> if No record found.
                                        </p>
                                        <div>
                                            <span class="font-weight-bold">Price: </span>
                                            <span class="badge badge-danger p-1"> ₦ 320</span>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-xxl-4 col-sm-6">
                        <div class="card text-white verification-card shadow py-4">
                            <button data-toggle="modal" data-target="#VNSModal">
                                <div class="d-flex align-items-center">
                                    <img src="./images/verification/vnin_v_slip.png" class="validation-image mr-2" alt="">
                                    <div>
                                        <h5 class="text-white">VNIN Verification Slip</h5>
                                        <p class="fs-14" style="color: #7e7e7e">
                                            You'll be charge <span class="badge badge-warning p-1">
                                                ₦ 0
                                            </span> if No record found.
                                        </p>
                                        <div>
                                            <span class="font-weight-bold">Price: </span>
                                            <span class="badge badge-danger p-1"> ₦ <?= VIRTUAL_NIN_SEARCH_PRICE ?></span>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-xxl-4 col-sm-6">
                        <div class="card text-white verification-card shadow py-4">
                            <button data-toggle="modal" data-target="#NINBasicModal">
                                <div class="d-flex align-items-center">
                                    <img src="./images/verification/basic-verification-slip.png" class="validation-image mr-2" alt="">
                                    <div>
                                        <h5 class="text-white">Basic Verification Slip</h5>
                                        <p class="fs-14" style="color: #7e7e7e">
                                            You'll be charge <span class="badge badge-warning p-1">
                                                ₦ 0
                                            </span> if No record found.
                                        </p>
                                        <div>
                                            <span class="font-weight-bold">Price: </span>
                                            <span class="badge badge-danger p-1"> ₦ <?= NIN_SEARCH_BASIC_PRICE ?></span>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <h4 class="card-title fs-16">All Recent Services Perform </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Service Type</th>
                                                <th>Photo</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($ninDetails = $AdminTask->Get_All_NIN_Details($Auth->email)) {

                                                $i = 0;
                                                foreach ($ninDetails as $ninDetail) {
                                                    $i++; ?>
                                                    
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $ninDetail->type ?></td>
                                                        <td><img src="data:image/jpeg;base64,<?= $ninDetail->photo ?>" width="100" alt=""></td>
                                                        <td>₦ <?php echo $ninDetail->price ?></td>
                                                        <td><?php echo $ninDetail->created_at ?></td>
                                                        <td>
                                                            <?php if ($ninDetail->type == 'Regular NIN Slip'): ?>
                                                                <button class="btn btn-info" onclick="printRegularNINSlip(<?php echo htmlspecialchars(json_encode($ninDetail)); ?>)">Print</button>
                                                                <?php elseif ($ninDetail->type == 'Improved NIN Slip'):?>
                                                                    <button class="btn btn-info" onclick="printImprovedNINSlip(<?php echo htmlspecialchars(json_encode($ninDetail)); ?>)">Print</button>
                                                                <?php elseif ($ninDetail->type == 'Virtual NIN Slip'):?>
                                                                    <button class="btn btn-info" onclick="printVirtualNINSlip(<?php echo htmlspecialchars(json_encode($ninDetail)); ?>)">Print</button>
                                                                <?php elseif ($ninDetail->type == 'Premium NIN Slip'):?>
                                                                    <button class="btn btn-info" onclick="printPremiumNINSlip(<?php echo htmlspecialchars(json_encode($ninDetail)); ?>)">Print</button>
                                                                <?php elseif ($ninDetail->type == 'Phone Search Slip'):?>
                                                                    <button class="btn btn-info" onclick="printPhoneSearchSlip(<?php echo htmlspecialchars(json_encode($ninDetail)); ?>)">Print</button>
                                                            <?php else: ?>
                                                                <button class="btn btn-info" onclick="printNINSlip(<?php echo htmlspecialchars(json_encode($ninDetail)); ?>)">Print</button>
                                                            <?php endif;?>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modals -->
                <div class="modal fade" id="NRSModal">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Regular NIN Slip > NIN Search</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="basic-form">
                                    <form id="nrs-form">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>NIN Number</label>
                                                <input type="text" class="form-control" placeholder="0020229898838"
                                                    id="nin_regular" name="nin">
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-success w-100">
                                            <span class="spinner-grow spinner-grow-sm text-light d-none" id="spinner" role="status" aria-hidden="true"></span>
                                            Verify <span class="badge badge-danger p-1">₦ <?= NIN_SEARCH_REGULAR_PRICE ?></span>
                                        </button>
                                        <a href="#" class="fs-12 mt-1">
                                            <i class="ti-help-alt mr-1"></i> Help?
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="NISModal">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Improved NIN Slip > NIN Search</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="basic-form">
                                    <form id="nis-form">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>NIN Number</label>
                                                <input type="text" class="form-control" placeholder="0020229898838"
                                                    id="nin_improve" name="nin">
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-success w-100">
                                            <span class="spinner-grow spinner-grow-sm text-light d-none" id="spinner" role="status" aria-hidden="true"></span>
                                            Verify <span class="badge badge-danger p-1">₦ <?= NIN_SEARCH_IMPROVE_PRICE ?></span>
                                        </button>
                                        <a href="#" class="fs-12 mt-1">
                                            <i class="ti-help-alt mr-1"></i> Help?
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="NPSModal">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Premium NIN Slip > NIN Search</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="basic-form">
                                    <form id="nps-form">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>NIN Number</label>
                                                <input type="text" class="form-control" placeholder="0020229898838"
                                                    id="nin" name="nin">
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-success w-100">
                                            <span class="spinner-grow spinner-grow-sm text-light d-none" id="spinner" role="status" aria-hidden="true"></span>
                                            Verify <span class="badge badge-danger p-1">₦ 320</span>
                                        </button>
                                        <a href="#" class="fs-12 mt-1">
                                            <i class="ti-help-alt mr-1"></i> Help?
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="VNSModal">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">VNIN Verification Slip > NIN Search</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="basic-form">
                                    <form id="vns-form">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>VNIN Number</label>
                                                <input type="text" class="form-control" placeholder="0020229898838"
                                                    id="vnin_1" name="vnin">
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-success w-100">
                                            <span class="spinner-grow spinner-grow-sm text-light d-none" id="spinner" role="status" aria-hidden="true"></span>
                                            Verify <span class="badge badge-danger p-1">₦ <?= VIRTUAL_NIN_SEARCH_PRICE ?></span>
                                        </button>
                                        <a href="#" class="fs-12 mt-1">
                                            <i class="ti-help-alt mr-1"></i> Help?
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="NINBasicModal">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Basic NIN Slip > NIN Search</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="basic-form">
                                    <form id="bns-form">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>NIN Number</label>
                                                <input type="text" class="form-control" placeholder="0020229898838"
                                                    id="nin_basic" name="nin">
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-success w-100">
                                            <span class="spinner-grow spinner-grow-sm text-light d-none" id="spinner" role="status" aria-hidden="true"></span>
                                            Verify <span class="badge badge-danger p-1">₦ <?= NIN_SEARCH_BASIC_PRICE ?></span>
                                        </button>
                                        <a href="#" class="fs-12 mt-1">
                                            <i class="ti-help-alt mr-1"></i> Help?
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="BVNModal">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">BVN Slip > BVN Verification V2</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="basic-form">
                                    <form id="bvn-form">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>BVN</label>
                                                <input type="text" class="form-control" placeholder="0020229898838"
                                                    id="bvn" name="bvn">
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-success w-100">
                                            <span class="spinner-grow spinner-grow-sm text-light d-none" id="spinner" role="status" aria-hidden="true"></span>
                                            Verify <span class="badge badge-danger p-1">₦ 150</span>
                                        </button>
                                        <a href="#" class="fs-12 mt-1">
                                            <i class="ti-help-alt mr-1"></i> Help?
                                        </a>
                                    </form>
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

        <?php
        require_once 'layout/footer.inc.php';
        ?>
    </div>

    <div id="print-section"></div>


    <?php
    require_once 'layout/footer-propt.inc.php';
    ?>

    <script src="./js/dashboard/validation.js?<?php echo time(); ?>"></script>
</body>

</html>