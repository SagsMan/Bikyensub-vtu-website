<?php
require_once '../inc/user_session.inc.php';

$PAGE_TITLE   = 'NIN Modification';
$URL_NAME     = 'nin_modification';
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
                <div class="row justify-content-center">

                    <div class="col-xl-8 col-lg-8 col-12">
                        <div class="basic-form bg-white p-5 rounded mb-5">
                            <h4 class="mb-4 text-center">DOB MODIFICATION
                                <br> NAME MODIFICATION
                                <br> PHONE NUMBER MODIFICATION DURATION 1 TO 7 DAYS
                            </h4>
                            <form id="nin-modification-form">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="bvn">Select Option <span class="text-danger">*</span></label>
                                        <select class="form-control" id="select-option" name="type" aria-label="Default select example">
                                            <option selected>Choose option</option>
                                            <option value="dob">DOB</option>
                                            <option value="name">Name</option>
                                        </select>
                                    </div>


                                    <div class="form-group col-md-12 all-option">
                                        <label>NIN <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="ENter NIN"
                                            id="nin" name="nin">
                                        <input type="hidden" name="action" value="nin_modification">
                                    </div>


                                    <div class="form-group col-md-12 name-option">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control"
                                            id="first_name" name="first_name">
                                    </div>
                                    <div class="form-group col-md-12 name-option">
                                        <label>Middle Name <small>(optional)</small></label>
                                        <input type="text" class="form-control"
                                            id="middle_name" name="middle_name">
                                    </div>

                                    <div class="form-group col-md-12 name-option">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control"
                                            id="last_name" name="last_name">
                                    </div>

                                    <div class="form-group col-md-12 dob-option">
                                        <label>Date Of Birth <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control"
                                            id="dob" name="dob">
                                    </div>
                                    <div class="form-group col-md-12 all-option">
                                        <label>Town/City <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control"
                                            id="city" name="city">
                                    </div>
                                    <div class="form-group col-md-12 all-option">
                                        <label>State <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control"
                                            id="state" name="state">
                                    </div>
                                    <div class="form-group col-md-12 all-option">
                                        <label>Local Government Area <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control"
                                            id="lga" name="lga">
                                    </div>
                                    <div class="form-group col-md-12 all-option">
                                        <label>Address <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control"
                                            id="address" name="address">
                                    </div>
                                    <div class="form-group col-md-12 all-option">
                                        <label>Price</label>
                                        <input type="text" class="form-control"
                                            id="price" name="price" value="<?= NIN_NAME_MODIFICATION_PRICE ?>" disabled>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success w-100" id="bvn-form button">
                                    <span class="spinner-grow spinner-grow-sm text-light d-none" id="spinner" role="status" aria-hidden="true"></span>
                                    Submit
                                </button>
                            </form>
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
                                                <th>NIN</th>
                                                <th>State</th>
                                                <th>Type</th>
                                                <th>Price</th>
                                                <th>Date Submitted</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            function getStatusLabel($status)
                                            {
                                                switch ($status) {
                                                    case 0:
                                                        return 'Declined';
                                                    case 1:
                                                        return 'Submitted';
                                                    case 2:
                                                        return 'Processing';
                                                    case 3:
                                                        return 'Completed';
                                                    default:
                                                        return 'Unknown';
                                                }
                                            }

                                            if ($verifications = $AdminTask->Get_All_NIN_M_Requests()) {

                                                $i = 0;
                                                foreach ($verifications as $verification) {
                                                    $i++; ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $verification->nin ?></td>
                                                        <td><?php echo $verification->state ?></td>
                                                        <td><?php echo $verification->type ?></td>
                                                        <td>₦ <?php echo $verification->price ?></td>
                                                        <td><?php echo $verification->created_at ?></td>
                                                        <td>
                                                            <?php
                                                            $bg = 'info';
                                                            $icon = 'check';
                                                            if ($verification->status == 0) {
                                                                $bg = 'danger';
                                                                $icon = 'times';
                                                            } elseif ($verification->status == 2) {
                                                                $bg = 'warning';
                                                            } elseif ($verification->status == 3) {
                                                                $bg = 'success';
                                                            }
                                                            ?>
                                                            <span class="badge bg-<?= $bg ?> text-white">
                                                                <i class="fa fa-<?= $icon ?>"></i>
                                                                <?= getStatusLabel($verification->status) ?>
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
                                                                if ($verification->status == 3) { // Use '==' or '===' for comparison
                                                                ?>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <a class="dropdown-item" href="<?= htmlspecialchars($verification->document) ?>">Download Document</a>
                                                                    </div>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <a class="dropdown-item" data-toggle="modal" data-target="#modal-default_<?= $verification->id ?>">View Modification Info</a>
                                                                    </div>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal for Viewing and Changing NIN Validation Info -->
                                                    <div class="modal fade" id="modal-default_<?= $verification->id ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Manage: <?= ucwords(str_replace('_', ' ', $verification->type)) ?> Modification Request</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="request_id" value="<?= $verification->id ?>">

                                                                    <div class="form-group">
                                                                        <label>NIN:</label>
                                                                        <input class="form-control" type="text" value="<?= $verification->nin ?>" readonly>
                                                                    </div>
                                                                    <?php if ($verification->type == 'name'): ?>
                                                                        <div class="form-group">
                                                                            <label>First Name:</label>
                                                                            <input class="form-control" type="text" value="<?= $verification->first_name ?>" readonly>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Middle Name:</label>
                                                                            <input class="form-control" type="text" value="<?= $verification->middle_name ?>" readonly>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Last Name:</label>
                                                                            <input class="form-control" type="text" value="<?= $verification->last_name ?>" readonly>
                                                                        </div>
                                                                    <?php endif; ?>

                                                                    <?php if ($verification->type == 'dob'): ?>
                                                                        <div class="form-group">
                                                                            <label>Date of Birth:</label>
                                                                            <input class="form-control" type="date" value="<?= $verification->dob ?>" readonly>
                                                                        </div>
                                                                    <?php endif; ?>

                                                                    <div class="form-group">
                                                                        <label>City:</label>
                                                                        <input class="form-control" type="text" value="<?= $verification->city ?>" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>State:</label>
                                                                        <input class="form-control" type="text" value="<?= $verification->state ?>" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Local Gov't Area:</label>
                                                                        <input class="form-control" type="text" value="<?= $verification->lga ?>" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Address:</label>
                                                                        <input class="form-control" type="text" value="<?= $verification->address ?>" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Price:</label>
                                                                        <input class="form-control" type="text" value="<?= $verification->price ?>" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Type:</label>
                                                                        <input class="form-control" id="type" type="text" value="<?= $verification->type ?>" name="type" readonly>
                                                                    </div>

                                                                    <form method="POST" class="updateForm">
                                                                        <input type="hidden" id="request_id" name="request_id" value="<?= htmlspecialchars($verification->id) ?>">
                                                                        <input type="hidden" name="type" value="<?= $verification->type ?>">
                                                                        <input type="hidden" class="hidden_status" name="hidden_status" value="<?= $verification->status ?>">

                                                                        <div class="form-group">
                                                                            <label>Status:</label>
                                                                            <input class="form-control" type="text" value="<?php echo getStatusLabel($verification->status) ?>" readonly>
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

                                        <button type="submit" class="btn btn-success w-100" id="bvn-form button">
                                            <span class="spinner-grow spinner-grow-sm text-light d-none" id="spinner" role="status" aria-hidden="true"></span>
                                            Verify <span class="badge badge-danger p-1">₦ <?= BVN_VERIFICATION_PRICE ?></span>
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
    <script>
        $(document).ready(function() {
            $('.all-option').hide();
            $('.name-option').hide();
            $('.dob-option').hide();

            $('#select-option').change(function() {
                var selectedOption = $(this).val();

                $('.name-option').hide();
                $('.dob-option').hide();
                $('.' + selectedOption + '-option').show();
                $('.all-option').show();

                if (selectedOption == 'name') {
                    $('#price').val('<?= NIN_NAME_MODIFICATION_PRICE ?>');
                } else {
                    $('#price').val('<?= NIN_DOB_MODIFICATION_PRICE ?>');
                }
            });
        });
    </script>
</body>

</html>