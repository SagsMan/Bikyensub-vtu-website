<?php

 

require_once '../inc/user_session.inc.php';
$bvn_verification_price = BVN_VERIFICATION_PRICE;
$bvn_advance_verification_price = BVN_ADVANCE_VERIFICATION_PRICE;
$nin_search_basic_price = NIN_SEARCH_BASIC_PRICE;
$nin_search_regular_price = NIN_SEARCH_REGULAR_PRICE;
$nin_search_improve_price = NIN_SEARCH_IMPROVE_PRICE;
$ipe_clearing_price = IPE_CLEARING_PRICE;
$nin_name_modification_price = NIN_NAME_MODIFICATION_PRICE;
$nin_dob_modification_price = NIN_DOB_MODIFICATION_PRICE;
$virtual_nin_search_price = VIRTUAL_NIN_SEARCH_PRICE;
$nin_personalization_price = NIN_PERSONALIZATION_PRICE;
$nin_validation_price = NIN_VALIDATION_PRICE;
if(isset($_POST['update_prices'])){

    $verification_prices = ['bvn_verification_price', 'bvn_advance_verification_price', 'nin_search_basic_price', 'nin_search_regular_price', 
    'nin_search_improve_price', 'ipe_clearing_price', 'nin_name_modification_price', 'nin_dob_modification_price', 'virtual_nin_search_price', 
    'nin_personalization_price', 'nin_validation_price'];
    $errors = [];
    $success = [];
    $settings_data = [];

    // Validate and collect prices
    foreach ($verification_prices as $verification_price) {
        if (empty($_POST[$verification_price]) || !ctype_digit($_POST[$verification_price])) {
            $errors[] = ucfirst(str_replace('_', ' ', $verification_price)) . " price is required and must be a valid number.";
        } else {
            $settings_data[$verification_price] = $_POST[$verification_price];
        }
        $$verification_price = $_POST[$verification_price];
    }

    // Update settings if no errors
    if (empty($errors)) {
        $updated = $AdminTask->update_general_settings_arr($settings_data);

        if ($updated) {
            $success[] = "Prices updated successfully!";
        } else {
            $errors[] = "Failed to update prices. Please try again.";
        }
    }

    // // Output messages
    // if (!empty($success)) {
    //     foreach ($success as $message) {
    //         echo "<p class='text-success'>$message</p>";
    //     }
    // }

    // if (!empty($errors)) {
    //     foreach ($errors as $error) {
    //         echo "<p class='text-danger'>$error</p>";
    //     }
    // }

}

$PAGE_TITLE   = 'Verification Settings';
$URL_NAME     = 'dashboard/verification-settings';

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
                                <div class="basic-form">
                                   <form method="POST" class="form-valide-with-icon">
                                       <div class="form-group">
                                            <label class="mb-1"><strong>BVN Verification Price</strong></label>
                                            <div class="input-group">
                                               <input type="text" name="bvn_verification_price" value="<?= $bvn_verification_price ?>" required="" class="form-control" placeholder="Enter BVN Verification Price">
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <label class="mb-1"><strong>Advance BVN Verification Price</strong></label>
                                            <div class="input-group">
                                               <input type="text" name="bvn_advance_verification_price" value="<?= $bvn_advance_verification_price ?>" required="" class="form-control" placeholder="Enter BVN Verification Price">
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <label class="mb-1"><strong>NIN Basic Search Price</strong></label>
                                            <div class="input-group">
                                               <input type="text" name="nin_search_basic_price" value="<?= $nin_search_basic_price ?>" required="" class="form-control" placeholder="Enter NIN Validation Price">
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <label class="mb-1"><strong>NIN Regular Search Price</strong></label>
                                            <div class="input-group">
                                               <input type="text" name="nin_search_regular_price" value="<?= $nin_search_regular_price ?>" required="" class="form-control" placeholder="Enter NIN Validation Price">
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <label class="mb-1"><strong>NIN Improve Search Price</strong></label>
                                            <div class="input-group">
                                               <input type="text" name="nin_search_improve_price" value="<?= $nin_search_improve_price ?>" required="" class="form-control" placeholder="Enter NIN Validation Price">
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <label class="mb-1"><strong>IPE Clearing Price</strong></label>
                                            <div class="input-group">
                                               <input type="text" name="ipe_clearing_price" value="<?= $ipe_clearing_price ?>" required="" class="form-control" placeholder="Enter IPE Clearing Price">
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <label class="mb-1"><strong>NIN Validation Price</strong></label>
                                            <div class="input-group">
                                               <input type="text" name="nin_validation_price" value="<?= $nin_validation_price ?>" required="" class="form-control" placeholder="Enter NIN Validation Price">
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <label class="mb-1"><strong>NIN Personalization Price</strong></label>
                                            <div class="input-group">
                                               <input type="text" name="nin_personalization_price" value="<?= $nin_personalization_price ?>" required="" class="form-control" placeholder="Enter NIN Name Modification Price">
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <label class="mb-1"><strong>NIN Name Modification Price</strong></label>
                                            <div class="input-group">
                                               <input type="text" name="nin_name_modification_price" value="<?= $nin_name_modification_price ?>" required="" class="form-control" placeholder="Enter NIN Name Modification Price">
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <label class="mb-1"><strong>NIN DOB Modification Price</strong></label>
                                            <div class="input-group">
                                               <input type="text" name="nin_dob_modification_price" value="<?= $nin_dob_modification_price ?>" required="" class="form-control" placeholder="Enter NIN DOB Modification Price">
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <label class="mb-1"><strong>Virtual NIN Search Price</strong></label>
                                            <div class="input-group">
                                               <input type="text" name="virtual_nin_search_price" value="<?= $virtual_nin_search_price ?>" required="" class="form-control" placeholder="Enter NIN DOB Modification Price">
                                            </div>
                                        </div>

                                    <div class="text-center mt-4">
                                        <button name="update_prices" type="submit" value="Update Prices" class="btn btn-primary">Update Prices</button>
                                    </div>
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
