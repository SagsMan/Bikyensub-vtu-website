<?php

 

require_once '../inc/user_session.inc.php';

if (isset($_POST['submitcac'])) {
    $oname = $Auth->sname;
    $email = $Auth->email;
    $balance = intval($WalletController->Get_Single_User_Wallet_Balance($email)->balance);
    $timestamp = time();
    $price = COMPANY_CAC_PRICE;
    $errors = [];
    $success = [];

    // Form validation
    if (empty($_POST['proposed_name_1'])) {
        $errors[] = "Proposed name option 1 is required.";
    }

    if (empty($_POST['proposed_name_2'])) {
        $errors[] = "Proposed name option 2 is required.";
    }

    if (empty($_POST['classification'])) {
        $errors[] = "Classification is required.";
    }

    if (empty($_POST['nature_of_company'])) {
        $errors[] = "Nature of the company is required.";
    }

    if (empty($_POST['company_address'])) {
        $errors[] = "Company address is required.";
    }

    if (empty($_POST['proprietor_1_name'])) {
        $errors[] = "Proprietor 1 name is required.";
    }

    if (empty($_POST['proprietor_1_address'])) {
        $errors[] = "Proprietor 1 address is required.";
    }

    if (empty($_POST['proprietor_1_phone']) || !ctype_digit($_POST['proprietor_1_phone'])) {
        $errors[] = "Proprietor 1 phone number is required and must contain only numbers.";
    }

    if (empty($_POST['proprietor_1_email'])) {
        $errors[] = "Proprietor 1 email is required.";
    }

    if (!isset($_FILES['proprietor_1_passport']) || $_FILES['proprietor_1_passport']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Proprietor 1 passport is required.";
    }

    if (!isset($_FILES['proprietor_1_signature']) || $_FILES['proprietor_1_signature']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Proprietor 1 signature is required.";
    }

    if (empty($_POST['proprietor_1_nin'])) {
        $errors[] = "Proprietor 1 NIN is required.";
    }

    if (empty($_POST['proprietor_2_name'])) {
        $errors[] = "Proprietor 2 name is required.";
    }

    if (empty($_POST['proprietor_2_address'])) {
        $errors[] = "Proprietor 2 address is required.";
    }

    if (empty($_POST['proprietor_2_phone']) || !ctype_digit($_POST['proprietor_2_phone'])) {
        $errors[] = "Proprietor 2 phone number is required and must contain only numbers.";
    }

    if (empty($_POST['proprietor_2_email'])) {
        $errors[] = "Proprietor 2 email is required.";
    }

    if (!isset($_FILES['proprietor_2_passport']) || $_FILES['proprietor_2_passport']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Proprietor 2 passport is required.";
    }

    if (!isset($_FILES['proprietor_2_signature']) || $_FILES['proprietor_2_signature']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Proprietor 2 signature is required.";
    }

    if (empty($_POST['proprietor_2_nin'])) {
        $errors[] = "Proprietor 2 NIN is required.";
    }

    if ($balance < $price) {
        $errors[] = "Insufficient Wallet Balance, please TopUp your wallet and try again.";
    }

    if (empty($errors) && $WalletController->Make_Tansaction_From_My_Wallet("cac_payment_{$timestamp}", $price, $email)) {
        // Handle file uploads and generate new file names
        $proprietor_1_passport = "{$oname}_proprietor_1_passport_{$timestamp}." . pathinfo($_FILES['proprietor_1_passport']['name'], PATHINFO_EXTENSION);
        $proprietor_1_signature = "{$oname}_proprietor_1_signature_{$timestamp}." . pathinfo($_FILES['proprietor_1_signature']['name'], PATHINFO_EXTENSION);
        $proprietor_2_passport = "{$oname}_proprietor_2_passport_{$timestamp}." . pathinfo($_FILES['proprietor_2_passport']['name'], PATHINFO_EXTENSION);
        $proprietor_2_signature = "{$oname}_proprietor_2_signature_{$timestamp}." . pathinfo($_FILES['proprietor_2_signature']['name'], PATHINFO_EXTENSION);

        $paths = [
            'proprietor_1_passport' => '../uploads/' . $proprietor_1_passport,
            'proprietor_1_signature' => '../uploads/' . $proprietor_1_signature,
            'proprietor_2_passport' => '../uploads/' . $proprietor_2_passport,
            'proprietor_2_signature' => '../uploads/' . $proprietor_2_signature,
        ];

        // Move uploaded files to the specified paths
        if (move_uploaded_file($_FILES['proprietor_1_passport']['tmp_name'], $paths['proprietor_1_passport']) &&
            move_uploaded_file($_FILES['proprietor_1_signature']['tmp_name'], $paths['proprietor_1_signature']) &&
            move_uploaded_file($_FILES['proprietor_2_passport']['tmp_name'], $paths['proprietor_2_passport']) &&
            move_uploaded_file($_FILES['proprietor_2_signature']['tmp_name'], $paths['proprietor_2_signature'])
        ) {
            // Update the database
            if ($AdminTask->submit_cac2($_POST, $email, $paths)) {
                $success[] = 'CAC request submitted successfully!';
            } else {
                $errors[] = 'Failed to submit CAC request. Please try again.';
            }
        } else {
            $errors[] = 'Failed to upload files. Please try again.';
        }
    }
}

$PAGE_TITLE = 'Submit Company CAC Request';
$URL_NAME = 'dashboard/submit-cac-company';
require_once("../inc/accessbility_controller.inc.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'layout/header-propt.inc.php'; ?>
    <title><?= $PAGE_TITLE . " | " . SITE_TITLE ?> </title>
</head>

<body>
    <?php require_once 'layout/preloader.inc.php'; ?>

    <div id="main-wrapper">
        <?php require_once 'layout/header.inc.php'; ?>
        <?php require_once 'layout/sidebar.inc.php'; ?>

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
                            <li class="breadcrumb-item active"><a href="javascript:void(0)"><?= $PAGE_TITLE ?></a></li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
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
                                <div class="alert alert-warning">
                                    <p>This Company Registration will cost you ₦<?= COMPANY_CAC_PRICE ?>.</p>
                                </div>
                                <div class="basic-form">
                                    <form method="POST" class="form-valide-with-icon" enctype="multipart/form-data">
                                        <h5>Company Details</h5>
                                        <div class="form-group">
                                            <label><strong>Proposed Name Option 1*</strong></label>
                                            <input type="text" name="proposed_name_1" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Proposed Name Option 2*</strong></label>
                                            <input type="text" name="proposed_name_2" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Classification*</strong></label>
                                            <select class="form-control" name="classification" required>
                                                <option value="">Select Classification</option>
                                                <option value="private">Private</option>
                                                <option value="public">Public</option>
                                                <option value="partnership">Partnership</option>
                                                <option value="joint_venture">Joint Venture</option>
                                                <option value="limited_liability">Limited Liability</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Nature of the Company*</strong></label>
                                            <input type="text" name="nature_of_company" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Company Address*</strong></label>
                                            <textarea name="company_address" class="form-control" rows="4" required=""></textarea>
                                        </div>

                                        <h5>Proprietor 1 Details</h5>
                                        <div class="form-group">
                                            <label><strong>Proprietor Name*</strong></label>
                                            <input type="text" name="proprietor_1_name" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Proprietor Address*</strong></label>
                                            <textarea name="proprietor_1_address" class="form-control" rows="4" required=""></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Proprietor Phone Number*</strong></label>
                                            <input type="text" name="proprietor_1_phone" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Proprietor Email*</strong></label>
                                            <input type="email" name="proprietor_1_email" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Proprietor Passport*</strong></label>
                                            <input type="file" name="proprietor_1_passport" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Proprietor Signature*</strong></label>
                                            <input type="file" name="proprietor_1_signature" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Proprietor NIN*</strong></label>
                                            <input type="text" name="proprietor_1_nin" class="form-control" required="">
                                        </div>

                                        <h5>Proprietor 2 Details</h5>
                                        <div class="form-group">
                                            <label><strong>Proprietor Name*</strong></label>
                                            <input type="text" name="proprietor_2_name" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Proprietor Address*</strong></label>
                                            <textarea name="proprietor_2_address" class="form-control" rows="4" required=""></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Proprietor Phone Number*</strong></label>
                                            <input type="text" name="proprietor_2_phone" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Proprietor Email*</strong></label>
                                            <input type="email" name="proprietor_2_email" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Proprietor Passport*</strong></label>
                                            <input type="file" name="proprietor_2_passport" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Proprietor Signature*</strong></label>
                                            <input type="file" name="proprietor_2_signature" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Proprietor NIN*</strong></label>
                                            <input type="text" name="proprietor_2_nin" class="form-control" required="">
                                        </div>

                                        <button type="submit" name="submitcac" class="btn btn-primary">Submit CAC Request</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<?php
    require_once 'layout/footer.inc.php';
    require_once 'layout/footer-propt.inc.php';
   ?>
</body>

</html>
