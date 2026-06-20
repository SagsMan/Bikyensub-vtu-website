<?php
require_once '../inc/user_session.inc.php';

$PAGE_TITLE   = 'NIN Personalization';
$URL_NAME     = 'NIN Personalization';
// require_once "../inc/accessbility_controller.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once 'layout/header-propt.inc.php';
    ?>

    <title><?= $PAGE_TITLE . " | " . SITE_TITLE ?> </title>
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
        <div class="content-body">
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
                            <button data-toggle="modal" data-target="#NPModal">
                                <div class="d-flex align-items-center">
                                    <img src="./images/verification/validate_new.png" class="validation-image mr-2" alt="">
                                    <div>
                                        <h5 class="text-white">NIN Personalization</h5>
                                        <!-- <p class="fs-14" style="color: #7e7e7e">
                                            You'll be charge <span class="badge badge-warning p-1">
                                                ₦ 50
                                            </span> if No record found.
                                        </p> -->
                                        <div>
                                            <span class="font-weight-bold">Price: </span>
                                            <span class="badge badge-danger p-1"> ₦ <?= NIN_PERSONALIZATION_PRICE ?></span>
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
                                                <th>Email</th>
                                                <th>WhatsApp No</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            function getStatusLabel($status)
                                            {
                                                return [
                                                    'text' => match ($status) {
                                                        0 => 'Declined',
                                                        1 => 'Submitted',
                                                        2 => 'Processing',
                                                        3 => 'Completed',
                                                        default => 'Unknown',
                                                    },
                                                    'bg' => match ($status) {
                                                        0 => 'badge badge-danger',
                                                        1 => 'badge badge-warning',
                                                        2 => 'badge badge-info',
                                                        3 => 'badge badge-success',
                                                        default => 'badge badge-secondary',
                                                    },
                                                ];
                                            }
                                            if ($ninPersonalizations = $AdminTask->Get_All_NIN_Personalizations($Auth->email)) {

                                                $i = 0;
                                                foreach ($ninPersonalizations as $ninPersonalization) {
                                                    $i++; 
                                                    $status = getStatusLabel($ninPersonalization->status);
                                                    ?>
                                                    
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $ninPersonalization->email ?></td>
                                                        <td><?php echo $ninPersonalization->whatsapp_no ?></td>
                                                        <td>₦ <?php echo $ninPersonalization->price ?></td>
                                                        <td><?php echo $ninPersonalization->created_at ?></td>
                                                        <td>
                                                           <span class="<?= $status['bg']; ?>">
                                                            <?= $status['text']; ?>
                                                           </span> 
                                                        </td>
                                                        <td>
                                                            <div class="dropdown ml-auto text-right">
                                                                <div class="btn-link" data-toggle="dropdown">
                                                                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                                            <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                                            <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                            <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                                        </g>
                                                                    </svg>
                                                                </div>

                                                                <?php
                                                                if ($ninPersonalization->status == 3) { // Use '==' or '===' for comparison
                                                                ?>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <a class="dropdown-item" href="<?= htmlspecialchars($ninPersonalization->document) ?>">Download Document</a>
                                                                    </div>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <a class="dropdown-item" data-toggle="modal" data-target="#modal-default_<?= $ninPersonalization->id ?>">View Personalization Info</a>
                                                                    </div>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal for Viewing and Changing NIN Validation Info -->
                                                    <div class="modal fade" id="modal-default_<?= $ninPersonalization->id ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">View: Personalization Request</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="request_id" value="<?= $ninPersonalization->id ?>">

                                                                    <div class="form-group">
                                                                        <label>Tracking ID:</label>
                                                                        <input class="form-control" type="text" value="<?= $ninPersonalization->tracking_id ?>" readonly>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Email:</label>
                                                                        <input class="form-control" type="text" value="<?= $ninPersonalization->email ?>" readonly>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>WhatsApp No/Link:</label>
                                                                        <input class="form-control" type="text" value="<?= $ninPersonalization->whatsapp_no ?>" readonly>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Type:</label>
                                                                        <input class="form-control" type="text" value="<?= $ninPersonalization->type ?>" name="type" readonly>
                                                                    </div>

                                                                    <form method="POST" class="updateForm" data-sn="<?= $sn ?>" enctype="multipart/form-data">
                                                                        <input type="hidden" name="request_id" value="<?= htmlspecialchars($ninPersonalization->id) ?>">
                                                                        <input type="hidden" name="type" value="<?= $ninPersonalization->type ?>">
                                                                        <input type="hidden" class="hidden_status-<?= $sn ?>" name="hidden_status" value="<?= $ninPersonalization->status ?>">

                                                                        <div class="form-group">
                                                                            <label>Status:</label>
                                                                            <input class="form-control" type="text" value="<?php echo $status['text'] ?>" readonly>
                                                                        </div>
                                                                        <div class="modal-footer justify-content-between">
                                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End of Modal -->
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
                <div class="modal fade" id="NPModal">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">NIN Personalization > NIN Personalization</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="basic-form">
                                    <form id="nin-personalization-form">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Tracking ID</label>
                                                <input type="text" class="form-control" placeholder="0020229898838"
                                                    id="tracking_id" name="tracking_id">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Email</label>
                                                <input type="text" class="form-control" placeholder="email"
                                                    id="email" name="email">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Whatsapp NO./link</label>
                                                <input type="text" class="form-control"
                                                    id="whatsapp_no" name="whatsapp_no">
                                            </div>
                                        </div>

                                        <i>Waiting time: 48 hours</i> <br />
                                        <button type="submit" class="btn btn-success w-100">
                                            <span class="spinner-grow spinner-grow-sm text-light d-none" id="spinner" role="status" aria-hidden="true"></span>
                                            Verify <span class="badge badge-danger p-1">₦ <?= NIN_PERSONALIZATION_PRICE ?></span>
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

    <?php
    require_once 'layout/footer-propt.inc.php';
    ?>

    <script src="./js/dashboard/validation.js?<?php echo time(); ?>"></script>
</body>

</html>