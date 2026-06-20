<?php
require_once '../inc/user_session.inc.php';

if (isset($_POST['change'])) {

    $rules = [
        'sname' => [
            'required',
            'alpha'
        ],
        'oname' => [
            'required',
            'alpha'
        ],
        'phone' => [
            'required',
            'numeric'
        ],
        'means_of_id_type' => [
            'required',
        ],
        'means_of_id' => [
            'required',
        ]
    ];

    $validation_result = SimpleValidator\Validator::validate($_POST, $rules);
    if ($validation_result->isSuccess()) {

        if ($AdminTask->update_profile($_POST, $Auth->email)) {
            array_push($SITE_SUCCESS, 'Your Profile is Succesful updated');
        }
    } else {
        array_push($SITE_ERRORS, $validation_result->getErrors());
    }
}



$PAGE_TITLE   = 'Update Profile';
$URL_NAME     = 'dashboard/change-password';
require_once("../inc/accessbility_controller.inc.php");
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
                            <li class="breadcrumb-item active"><a href="javascript:void(0)"><?= $PAGE_TITLE ?></a></li>
                        </ol>
                    </div>
                </div>







                <!-- row -->
                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?= $PAGE_TITLE  ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">


                                    <form action="" method="POST" class="form-valide-with-icon">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="mb-1"><strong>Surname </strong></label>
                                                <div class="input-group">
                                                    <input type="text" name="sname" value="<?= $Auth->sname ?>" required="" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="mb-1"><strong>OtherNames </strong></label>
                                                <div class="input-group">
                                                    <input type="text" name="oname" value="<?= $Auth->oname ?>" required="" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="form-group col-md-6">
                                                <label class="mb-1"><strong>Select Identity Type</strong></label>
                                                <div class="input-group">
                                                    <select class="form-control" name="means_of_id_type" required="">
                                                        <option hidden value="">Selete Identity Type</option>
                                                        <option <?php echo $Auth->means_of_id_type == 'bvn' ? 'selected' : '' ?> value="bvn">BVN</option>
                                                        <option <?php echo $Auth->means_of_id_type == 'nin' ? 'selected' : '' ?> value="nin">National ID Card</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">

                                                <label class="mb-1"><strong>Enter Selected ID Number</strong></label>
                                                <div class="input-group">
                                                    <input type="text" name="means_of_id" required="" 
                                                        value="<?= $Auth->means_of_id_type == 'nin' ? $Auth->nin : $Auth->bvn ?>" 
                                                        class="form-control"
                                                        pattern="\d{11}" maxlength="11"
                                                        >
                                                </div>
                                            </div>

                                        </div>


                                        <div class="row">

                                            <div class="form-group col-md-6">
                                                <label class="mb-1"><strong>Phone Number </strong></label>
                                                <div class="input-group">
                                                    <input type="tel" name="phone" value="<?= $Auth->phone ?>" required="" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">

                                                <label class="mb-1"><strong>Email</strong></label>
                                                <div class="input-group">
                                                    <input type="email" readonly="" required="" value="<?= $Auth->email ?>" class="form-control">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="form-group col-md-6">
                                                <label class="mb-1"><strong> State Of Origin </strong></label>
                                                <div class="input-group">
                                                    <select class="form-control selectpicker" name="state" required="" value="<?= $Auth->state ?>">

                                                        <option value="Abia">Abia</option>
                                                        <option value="Adamawa">Adamawa</option>
                                                        <option value="Akwa Ibom">Akwa Ibom</option>
                                                        <option value="Anambra">Anambra</option>
                                                        <option value="Bauchi">Bauchi</option>
                                                        <option value="Bayelsa">Bayelsa</option>
                                                        <option value="Benue">Benue</option>
                                                        <option value="Borno">Borno</option>
                                                        <option value="Cross River">Cross River</option>
                                                        <option value="Delta">Delta</option>
                                                        <option value="Ebonyi">Ebonyi</option>
                                                        <option value="Edo">Edo</option>
                                                        <option value="Ekiti">Ekiti</option>
                                                        <option value="Enugu">Enugu</option>
                                                        <option value="Federal Capital Territory">Federal Capital Territory</option>
                                                        <option value="Gombe">Gombe</option>
                                                        <option value="Imo">Imo</option>
                                                        <option value="Jigawa">Jigawa</option>
                                                        <option value="Kaduna">Kaduna</option>
                                                        <option value="Kano">Kano</option>
                                                        <option value="Katsina">Katsina</option>
                                                        <option value="Kebbi">Kebbi</option>
                                                        <option value="Kogi">Kogi</option>
                                                        <option value="Kwara">Kwara</option>
                                                        <option value="Lagos">Lagos</option>
                                                        <option value="Nasarawa">Nasarawa</option>
                                                        <option value="Niger">Niger</option>
                                                        <option value="Ogun">Ogun</option>
                                                        <option value="Ondo">Ondo</option>
                                                        <option value="Osun">Osun</option>
                                                        <option value="Oyo">Oyo</option>
                                                        <option value="Plateau">Plateau</option>
                                                        <option value="Rivers">Rivers</option>
                                                        <option value="Sokoto">Sokoto</option>
                                                        <option value="Taraba">Taraba</option>
                                                        <option value="Yobe">Yobe</option>
                                                        <option value="Zamfara">Zamfara</option>
                                                    </select>

                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">

                                                <label class="mb-1"><strong>Town </strong></label>
                                                <div class="input-group">
                                                    <input type="text" name="town" value="<?= $Auth->town ?>" required="" class="form-control">
                                                </div>
                                            </div>

                                        </div>



                                        <div class="form-group ">
                                            <label class="mb-1"><strong> Your Company Name</strong></label>
                                            <div class="input-group">
                                                <input type="text" placeholder="Eg: Utiplus Digital Solution" name="school" value="<?= $Auth->school ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <label class="mb-1"><strong> Your Company Address : </strong></label>
                                            <div class="input-group">
                                                <textarea name="address" required="" class="form-control"> <?= $Auth->address ?> </textarea>
                                            </div>
                                        </div>



                                        <div class="text-center mt-4">
                                            <button name="change" type="submit" value="Profile" class="btn btn-primary ">Update now</button>
                                        </div>
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

    </div>

    <?php
    require_once 'layout/footer.inc.php';
    require_once 'layout/footer-propt.inc.php';
    ?>

</body>

</html>