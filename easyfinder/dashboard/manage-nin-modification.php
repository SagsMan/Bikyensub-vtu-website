<?php
require_once '../inc/user_session.inc.php';

$PAGE_TITLE   = 'Manage NIN Modification';
$URL_NAME     = 'dashboard/manage-nin-modification';
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
    if ($requestId && $status != null) {
        $oname = "NIN_Modification_{$type}_Document"; // This could be dynamic or set to a specific name
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
        if (empty($errors) && $AdminTask->updateNINModificationRequest($requestId, $status, $filePath)) {
            $success[] = "{$type} modification status updated successfully!";
        } else {
            $errors[] = "Failed to update {$type} modification status. Please try again.";
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
                                                <th>State</th>
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
                                            $modificationRequest = $AdminTask->Get_All_NIN_M_Requests();
                                            if (!empty($modificationRequest)) {
                                                foreach ($modificationRequest as $request) {
                                                    $sn++;
                                            ?>
                                                    <tr>
                                                        <td><?= $sn ?></td>
                                                        <td><?= $request->nin ?></td>
                                                        <td><?= $request->state ?></td>
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
                                                                    <h4 class="modal-title">Manage: <?= ucwords(str_replace('_', ' ', $request->type)) ?> Modification Request</h4>
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
                                                                    <?php if ($request->type == 'name'): ?>
                                                                        <div class="form-group">
                                                                            <label>First Name:</label>
                                                                            <input class="form-control" type="text" value="<?= $request->first_name ?>" readonly>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Middle Name:</label>
                                                                            <input class="form-control" type="text" value="<?= $request->middle_name ?>" readonly>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Last Name:</label>
                                                                            <input class="form-control" type="text" value="<?= $request->last_name ?>" readonly>
                                                                        </div>
                                                                    <?php endif; ?>

                                                                    <?php if ($request->type == 'dob'): ?>
                                                                        <div class="form-group">
                                                                            <label>Date of Birth:</label>
                                                                            <input class="form-control" type="date" value="<?= $request->dob ?>" readonly>
                                                                        </div>
                                                                    <?php endif; ?>

                                                                    <div class="form-group">
                                                                        <label>City:</label>
                                                                        <input class="form-control" type="text" value="<?= $request->city ?>" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>State:</label>
                                                                        <input class="form-control" type="text" value="<?= $request->state ?>" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Local Gov't Area:</label>
                                                                        <input class="form-control" type="text" value="<?= $request->lga ?>" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Address:</label>
                                                                        <input class="form-control" type="text" value="<?= $request->address ?>" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Price:</label>
                                                                        <input class="form-control" type="text" value="<?= $request->price ?>" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Type:</label>
                                                                        <input class="form-control" id="type" type="text" value="<?= $request->type ?>" name="type">
                                                                    </div>

                                                                    <form method="POST" class="updateForm">
                                                                        <input type="hidden" id="request_id" name="request_id" value="<?= htmlspecialchars($request->id) ?>">
                                                                        <input type="hidden" name="type" value="<?= $request->type ?>">
                                                                        <input type="hidden" class="hidden_status" name="hidden_status" value="<?= $request->status ?>">

                                                                        <div class="form-group">
                                                                            <label>Status:</label>
                                                                            <select name="status" class="form-control status">
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
                                                    <td colspan="10" class="text-center">No Modification requests found.</td>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.querySelectorAll(".status");
            statusSelect.forEach((status) => {
                status.addEventListener('change', function() {
                    // Find the closest container and then locate the hidden status input
                    const hiddenStatus = this.closest('.modal-body').querySelector('.hidden_status');
                    
                    if (hiddenStatus) {
                        hiddenStatus.value = this.value;
                    }
                });
            });
        });
    </script>
    <?php require_once 'layout/footer-propt.inc.php'; ?>
</body>

</html>