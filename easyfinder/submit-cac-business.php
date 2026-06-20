<?php

 

require_once '../inc/user_session.inc.php';

if(isset($_POST['submitcac'])){
    $oname = $Auth->sname;
    $email = $Auth->email;
    $balance = intval($WalletController->Get_Single_User_Wallet_Balance($email)->balance);
    $timestamp = time();
    $price = BUSINESS_CAC_PRICE;
    $errors = [];
    $success = [];

    // Basic validations
    if (empty($_POST['proprietor_name'])) {
        $errors[] = "Proprietor Name is required.";
    }

    if (empty($_POST['proprietor_phone']) || !ctype_digit($_POST['proprietor_phone'])) {
        $errors[] = "Proprietor Phone Number is required and must contain only numbers.";
    }

    if (empty($_POST['proprietor_email']) || !filter_var($_POST['proprietor_email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid Proprietor Email is required.";
    }

    if (empty($_POST['business_address'])) {
        $errors[] = "Business Address is required.";
    }

    if (empty($_POST['nature_of_business'])) {
        $errors[] = "Nature of Business is required.";
    }

    // File uploads validation
    $requiredFiles = ['proprietor_passport', 'proprietor_signature', 'nin'];
    foreach ($requiredFiles as $file) {
        if (!isset($_FILES[$file]) || $_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
            $errors[] = ucfirst(str_replace('_', ' ', $file)) . " is required.";
        }
    }

    if ($balance < $price) {
        $errors[] = "Insufficient Wallet Balance, please TopUp your wallet and try again.";
    }

    if (empty($errors)) {
        if ($WalletController->Make_Tansaction_From_My_Wallet("cac_payment_{$timestamp}", $price, $email)) {
            $filePaths = [];
            foreach ($requiredFiles as $file) {
                $extension = pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);
                $newFileName = "{$oname}_{$file}_{$timestamp}.{$extension}";
                $filePath = "../uploads/" . $newFileName;
                if (move_uploaded_file($_FILES[$file]['tmp_name'], $filePath)) {
                    $filePaths[$file] = $filePath;
                } else {
                    $errors[] = "Failed to upload " . ucfirst(str_replace('_', ' ', $file)) . ".";
                }
            }

            if (empty($errors)) {
                $submitData = [
                    'proposed_name_1' => $_POST['proposed_name_1'],
                    'proposed_name_2' => $_POST['proposed_name_2'],
                    'business_address' => $_POST['business_address'],
                    'nature_of_business' => $_POST['nature_of_business'],
                    'proprietor_name' => $_POST['proprietor_name'],
                    'proprietor_address' => $_POST['proprietor_address'],
                    'proprietor_phone' => $_POST['proprietor_phone'],
                    'proprietor_email' => $_POST['proprietor_email'],
                    'proprietor_passport' => $filePaths['proprietor_passport'],
                    'proprietor_signature' => $filePaths['proprietor_signature'],
                    'nin' => $filePaths['nin'],
                    'type' => 'Business Name Registration'
                ];

                if ($AdminTask->submit_cac($submitData, $email)) {
                    $success[] = 'Business Name Registration request submitted successfully!';
                } else {
                    $errors[] = 'Failed to submit Business Name Registration request. Please try again.';
                }
            }
        } else {
            $errors[] = 'Transaction failed. Please try again.';
        }
    }
}

$PAGE_TITLE = 'Submit Business Name CAC Request';
$URL_NAME = 'dashboard/submit-cac-business';
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
   <?php require_once 'layout/preloader.inc.php'; ?>
    <div id="main-wrapper">
   <?php
   require_once 'layout/header.inc.php';
   require_once 'layout/sidebar.inc.php';
   ?>
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
                                    <p>This Business Name Registration will cost you ₦<?=BUSINESS_CAC_PRICE ?>.</p>
                                    </div>
                                <div class="basic-form">
                                   <form method="POST" class="form-valide-with-icon" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="mb-1"><strong>Proposed Name Option 1</strong></label>
                                            <input type="text" name="proposed_name_1" class="form-control" required="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="mb-1"><strong>Proposed Name Option 2</strong></label>
                                            <input type="text" name="proposed_name_2" class="form-control" required="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="mb-1"><strong>Nature of Business</strong></label>
                                            <input type="text" name="nature_of_business" class="form-control" required="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="mb-1"><strong>Business Address</strong></label>
                                            <input type="text" name="business_address" class="form-control" required="">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="mb-1"><strong>Name of Proprietor</strong></label>
                                            <input type="text" name="proprietor_name" class="form-control" required="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="mb-1"><strong>Proprietor Address</strong></label>
                                            <input type="text" name="proprietor_address" class="form-control" required="">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="mb-1"><strong>Proprietor Phone No.</strong></label>
                                            <input type="tel" name="proprietor_phone" class="form-control" required="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="mb-1"><strong>Proprietor Email</strong></label>
                                            <input type="email" name="proprietor_email" class="form-control" required="">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="mb-1"><strong>Proprietor Passport</strong></label>
                                            <input type="file" name="proprietor_passport" class="form-control" required="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="mb-1"><strong>Proprietor Signature</strong></label>
                                            <input type="file" name="proprietor_signature" class="form-control" required="">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="mb-1"><strong>NIN Upload</strong></label>
                                            <input type="file" name="nin" class="form-control" required="">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" name="submitcac" class="btn btn-primary btn-block">Submit Request</button>
                                    </div>
                                </form>
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
	
    </div>
</body>
</html>
