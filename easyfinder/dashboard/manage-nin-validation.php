<?php
 

require_once '../inc/user_session.inc.php';

$PAGE_TITLE   = 'Manage NIN Validations';
$URL_NAME     = 'dashboard/manage-nin-validation';
require_once("../inc/accessbility_controller.inc.php");
$updated = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    $success = [];
    
    // Retrieve POST data
    $requestId = filter_input(INPUT_POST, 'request_id', FILTER_SANITIZE_NUMBER_INT);
    $status = filter_input(INPUT_POST, 'hidden_status', FILTER_SANITIZE_NUMBER_INT);
    $type = ucwords(str_replace('_', ' ', htmlspecialchars($_POST['type'])));

    // Check if the status and requestId are received
    if ($requestId && $status !== null) {
        $oname = "NIN_Validation_{$type}_Document"; // This could be dynamic or set to a specific name
        $timestamp = time(); // Get the current timestamp

        // File upload method
        $file = 'document';
        $extension = pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);
        $newFileName = "{$oname}_{$timestamp}.{$extension}";
        $filePath = "../uploads/" . $newFileName;

        if (move_uploaded_file($_FILES[$file]['tmp_name'], $filePath)) {
            $filePath = $filePath;
        } else {
            $filePath = null;
        }

        // Update Validation request status and the document path if a file was uploaded
        if (empty($errors) && $AdminTask->updateNINValidationRequest($requestId, $status, $filePath)) {
            $success[] = "{$type} status updated successfully!";
        } else {
            $errors[] = "Failed to update {$type} status. Please try again.";
        }
    } else {
        $errors[] = 'Request ID and status are required.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once 'layout/header-propt.inc.php';
    ?>
    <title><?= $PAGE_TITLE . " | " . SITE_TITLE ?> </title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php require_once 'layout/preloader.inc.php'; ?>
    <div id="main-wrapper">
        <?php
        require_once 'layout/header.inc.php';
        require_once 'layout/sidebar.inc.php';
        ?>
        <div class="content-body">
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
                            <li class="breadcrumb-item active"><a href="javascript:void(0)"><?= $PAGE_TITLE ?></a></li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?= $PAGE_TITLE ?></h4>
                            </div>
                            <div class="card-body">
                                <?php
                                if (!empty($errors)) {
                                    echo '<div class="alert alert-danger">';
                                    foreach ($errors as $error) {
                                        echo "<p>$error</p>";
                                    }
                                    echo '</div>';
                                }

                                if (!empty($success)) {
                                    echo '<div class="alert alert-success">';
                                    foreach ($success as $message) {
                                        echo "<p>$message</p>";
                                    }
                                    echo '</div>';
                                }
                                ?>
                                <div class="table-responsive">
                                    <table id="example5" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>NIN</th>
                                                <th>Email</th>
                                                <th>WhatsApp No</th>
                                                <th>Type</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th>Date Submitted</th>
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

                                            $sn = 0;
                                            $ValidationRequest = $AdminTask->Get_All_NIN_V_Requests();
                                            if (!empty($ValidationRequest)) {
                                                foreach ($ValidationRequest as $request) {
                                                    $sn++;
                                            ?>
                                                    <tr>
                                                        <td><?= $sn ?></td>
                                                        <td><?= $request->nin ?></td>
                                                        <td><?= $request->email ?></td>
                                                        <td><?= $request->whatsapp_no ?></td>
                                                        <td><?= $request->type ?></td>
                                                        <td><?= $request->price ?></td>
                                                        <td><?php echo getStatusLabel($request->status); ?></td>
                                                        <td><?= $request->created_at ?></td>

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
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <?php
                                                                    if (in_array(1, explode(',', $Auth->admin_role))) {
                                                                    ?>
                                                                        <a class="dropdown-item" data-toggle="modal" data-target="#modal-default_<?= $request->id ?>">View Info</a>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal for Viewing and Changing NIN Validation Info -->
                                                    <div class="modal fade" id="modal-default_<?= $request->id ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Manage: <?= ucwords(str_replace('_', ' ', $request->type)) ?> Validation Request</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="request_id" value="<?= $request->id ?>">

                                                                    <div class="form-group">
                                                                        <label>NIN:</label>
                                                                        <input class="form-control" type="text" value="<?= $request->nin ?>" readonly>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Email:</label>
                                                                        <input class="form-control" type="text" value="<?= $request->email ?>" readonly>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>WhatsApp No/Link:</label>
                                                                        <input class="form-control" type="text" value="<?= $request->whatsapp_no ?>" readonly>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Type:</label>
                                                                        <input class="form-control" type="text" value="<?= $request->type ?>" name="type" readonly>
                                                                    </div>

                                                                    <form method="POST" class="updateForm" data-sn="<?= $sn ?>" enctype="multipart/form-data">
                                                                        <input type="hidden" name="request_id" value="<?= htmlspecialchars($request->id) ?>">
                                                                        <input type="hidden" name="type" value="<?= $request->type ?>">
                                                                        <input type="hidden" class="hidden_status-<?= $sn ?>" name="hidden_status" value="<?= $request->status ?>">

                                                                        <div class="form-group">
                                                                            <label>Status:</label>
                                                                            <select class="status-select-<?= $sn ?> form-control" name="status">
                                                                                <option value="0" <?= $request->status == 0 ? 'selected' : '' ?>>Declined</option>
                                                                                <option value="1" <?= $request->status == 1 ? 'selected' : '' ?>>Submitted</option>
                                                                                <option value="2" <?= $request->status == 2 ? 'selected' : '' ?>>Processing</option>
                                                                                <option value="3" <?= $request->status == 3 ? 'selected' : '' ?>>Completed</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="mb-1"><strong>Upload Document</strong></label>
                                                                            <input type="file" name="document" class="form-control">
                                                                        </div>
                                                                        <div class="modal-footer justify-content-between">
                                                                            <button type="submit" class="btn btn-primary">Update</button>
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
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="10" class="text-center">No Validation requests found.</td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once 'layout/footer-propt.inc.php'; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.updateForm').forEach((form, i) => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                let sn = this.getAttribute('data-sn');  
        //         console.log(i);
        //         // Fetch the data attribute
        // let elem = document.querySelector(`.updateForm[data-sn="${sn}"] .status-select`);
        // console.log(elem);  // Debug: Check if element is found
                
                // Get the current form's select and hidden input
                var statusSelect = document.querySelector(`select.status-select-${sn}`)
                var hiddenStatus = document.querySelector(`.hidden_status-${sn}`);
                
                // Update hidden input value with the select value
                hiddenStatus.value = statusSelect.value;
                // Submit the form
                this.submit();
            });
        });
        });
    </script>
</body>

</html>