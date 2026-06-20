<?php
require_once '../inc/user_session.inc.php';

$PAGE_TITLE   = 'Manage Plan Type';
$URL_NAME     = 'dashboard/manage-plan-type';
require_once("../inc/accessbility_controller.inc.php");
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'delete') {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        if ($AdminTask->DeleteDataPlanType($id)) {
            array_push($SITE_SUCCESS, 'Plan Type has been deleted successfully');
        } else {
            array_push($SITE_ERRORS, 'Failed to delete plan');
        }
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


                                <div class="float-end">
                                    <a href="add-plan-type" class="btn btn-primary btn-sm">Add New Plan Type</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>

                                                <th>S/N</th>
                                                <th>Data Type</th>
                                                <th>Title</th>
                                                <th>Network ID</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sn = 0;
                                            if ($planTypes = $AdminTask->Get_Plan_Types()) {
                                                foreach ($planTypes as $planType) {

                                                    $sn++;

                                            ?>
                                                    <tr>
                                                        <td><?= $sn ?></td>
                                                        <td><?= $planType->data_type  ?></td>
                                                        <td><?= $planType->title  ?></td>
                                                        <td><?= $planType->network_id ?></td>

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
                                                                        <a class="dropdown-item" data-toggle="modal" data-target="#modal-default_<?= $planType->id ?>">Edit</a>
                                                                        <form action="" method="post">
                                                                            <input type="hidden" name="action" value="delete">
                                                                            <input type="hidden" name="id" value="<?= $planType->id ?>">
                                                                            <button class="dropdown-item">
                                                                                Delete
                                                                            </button>
                                                                        </form>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>


                                                    <div class="modal fade" id="modal-default_<?= $planType->id ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Update Plan Type </h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form id="frmCart<?= $planType->id ?>" onsubmit="edit_data_ajax('edit_plan_type', 'table', '<?php echo $planType->id; ?>', this)">
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label>Data Type: </label>
                                                                            <input type="text" name="data_type" class="form-control" placeholder="Data Type" value="<?= $planType->data_type ?>" required="">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Plan Title:</label>
                                                                            <input type="text" name="title" class="form-control" placeholder="Plan Title" value="<?= $planType->title ?>" required="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                        <button type="submit" id="addc_<?php echo $planType->id; ?>" class="btn btn-primary">Save Changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.modal -->
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

            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

    </div>

    <?php
    require_once 'layout/footer-propt.inc.php';
    ?>

    <script>
        function edit_data_ajax(action, table, code, form) {
            event.preventDefault();
            $('#addc_' + code).attr('disabled', true);
            $("#addc_" + code).text('Processing...');
            let data, modal;

            if (action !== "") {
                switch (action) {
                    case "edit_plan_type":
                        data = new FormData(form);
                        data.append('id', code);
                        data.append('action', action);
                        modal = `#modal-default_${code}`;

                        break;
                }
            }

            jQuery.ajax({
                url: "../inc/get-data-ajax.inc",
                data: data,
                type: "POST",
                contentType: false,
                processData: false,
                success: function(response) {
                    $(modal).modal('hide');
                    if (response == 1) {
                        toastr.success("Your data was updated successfully");

                        // $('#example5').DataTable().ajax.reload(null, false); // Reload without resetting pagination
                    } else {
                        toastr.error(response);
                    }

                    // Reset the button state
                    $("#addc_" + code).text('Save Changes');
                    $("#addc_" + code).attr('disabled', false);
                },
                error: function(xhr, status, error) {
                    toastr.error('Network error. Please try again!');
                    $("#addc_" + code).text('Save changes');
                    $("#addc_" + code).attr('disabled', false);
                }
            });

        }

        function valid(code) {
            var valid = true;
            $(".demoInputBox").css('background-color', '');
            $(".info").html('');

            if ($("#company_name_" + code).val().length < 3) {
                toastr.error('Please Enter Company Name!');
                $("#company_name_" + code).css('background-color', '#FFF0DF');
                valid = false;
            }

            if ($("#means_of_id_" + code).val().length < 3) {
                toastr.error('Please Enter Means of ID!');
                $("#means_of_id_" + code).css('background-color', '#FFF0DF');
                valid = false;
            }

            if ($("#town_" + code).val().length < 3) {
                toastr.error('Please Enter town !');
                $("#town_" + code).css('background-color', '#FFF0DF');
                valid = false;
            }

            if ($("#state_" + code).val().length < 3) {
                toastr.error('Please Enter State Of Origin!');
                $("#state_" + code).css('background-color', '#FFF0DF');
                valid = false;
            }

            return valid;
        }
    </script>
</body>

</html>