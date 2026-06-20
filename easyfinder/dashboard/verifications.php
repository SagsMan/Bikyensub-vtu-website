<?php
require_once '../inc/user_session.inc.php';

$PAGE_TITLE   = 'Verifications';
$URL_NAME     = 'verifications';
require_once "../inc/accessbility_controller.inc.php";
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

                    <div class="col-xl-4 col-lg-6 col-xxl-4 col-sm-6">
                        <div class="card text-white verification-card shadow">
                            <a href="./nin_verifications" class="link-reset card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded bg-white p-2 w--2.5 h--2.5 mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #0f5132;transform: ;msFilter:;">
                                                <path d="m2.394 13.742 4.743 3.62 7.616-8.704-1.506-1.316-6.384 7.296-3.257-2.486zm19.359-5.084-1.506-1.316-6.369 7.279-.753-.602-1.25 1.562 2.247 1.798z">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="font-weight-bold">NIN Verifications</span>
                                    </div>
                                    <div class="text-right">
                                        <span class="bg-light text-success-2 fs-12 px-2 py-1 rounded text-nowrap">
                                            Service Available
                                        </span>
                                    </div>
                                </div>
                                <p class="fs-12 mb-3">
                                Verify people using their National Identity Number.
                                </p>
                                <div class="d-flex justify-content-between">
                                    <span class="bg-white text-dark fs-12 p-2 rounded">
                                        Use Service
                                    </span>

                                    <!-- <div>
                                        <span class="bg-light text-success-2 fs-12 p-1 rounded">
                                        ₦ 150
                                        </span>
                                    </div> -->
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-xxl-4 col-sm-6">
                        <div class="card text-white verification-card shadow">
                            <a href="./bvn_validation" class="link-reset card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded bg-white p-2 w--2.5 h--2.5 mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #0f5132;transform: ;msFilter:;">
                                                <path d="m2.394 13.742 4.743 3.62 7.616-8.704-1.506-1.316-6.384 7.296-3.257-2.486zm19.359-5.084-1.506-1.316-6.369 7.279-.753-.602-1.25 1.562 2.247 1.798z">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="font-weight-bold">BVN Verification V2</span>
                                    </div>
                                    <div class="text-right">
                                        <span class="bg-light text-success-2 fs-12 px-2 py-1 rounded text-nowrap">
                                            Service Available
                                        </span>
                                    </div>
                                </div>
                                <p class="fs-12 mb-3">
                                    Verify people using their provided Bank Verification Numbers.
                                </p>
                                <div class="d-flex justify-content-between">
                                    <span class="bg-white text-dark fs-12 p-2 rounded">
                                        Use Service
                                    </span>

                                    <!-- <div>
                                        <span class="bg-light text-success-2 fs-12 p-1 rounded">
                                        ₦ 150
                                        </span>
                                    </div> -->
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-xxl-4 col-sm-6">
                        <div class="card text-white verification-card shadow">
                            <a href="./validation_services" class="link-reset card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded bg-white p-2 w--2.5 h--2.5 mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #0f5132;transform: ;msFilter:;">
                                                <path d="m2.394 13.742 4.743 3.62 7.616-8.704-1.506-1.316-6.384 7.296-3.257-2.486zm19.359-5.084-1.506-1.316-6.369 7.279-.753-.602-1.25 1.562 2.247 1.798z">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="font-weight-bold">NIN validation & IPE clearing</span>
                                    </div>
                                    <div class="text-right">
                                        <span class="bg-light text-success-2 fs-12 px-2 py-1 rounded text-nowrap">
                                            Service Available
                                        </span>
                                    </div>
                                </div>
                                <p class="fs-12 mb-3">
                                NIN validation and IPE clearing
                                </p>
                                <div class="d-flex justify-content-between">
                                    <span class="bg-white text-dark fs-12 p-2 rounded">
                                        Use Service
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-xxl-4 col-sm-6">
                        <div class="card text-white verification-card shadow">
                            <a href="./nin_modification" class="link-reset card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded bg-white p-2 w--2.5 h--2.5 mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #0f5132;transform: ;msFilter:;">
                                                <path d="m2.394 13.742 4.743 3.62 7.616-8.704-1.506-1.316-6.384 7.296-3.257-2.486zm19.359-5.084-1.506-1.316-6.369 7.279-.753-.602-1.25 1.562 2.247 1.798z">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="font-weight-bold">NIN Modification</span>
                                    </div>
                                    <div class="text-right">
                                        <span class="bg-light text-success-2 fs-12 px-2 py-1 rounded text-nowrap">
                                            Service Available
                                        </span>
                                    </div>
                                </div>
                                <p class="fs-12 mb-3">
                                NIN Modification
                                </p>
                                <div class="d-flex justify-content-between">
                                    <span class="bg-white text-dark fs-12 p-2 rounded">
                                        Use Service
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-xxl-4 col-sm-6">
                        <div class="card text-white verification-card shadow">
                            <a href="./nin_personalization" class="link-reset card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded bg-white p-2 w--2.5 h--2.5 mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #0f5132;transform: ;msFilter:;">
                                                <path d="m2.394 13.742 4.743 3.62 7.616-8.704-1.506-1.316-6.384 7.296-3.257-2.486zm19.359-5.084-1.506-1.316-6.369 7.279-.753-.602-1.25 1.562 2.247 1.798z">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="font-weight-bold">NIN Personalization</span>
                                    </div>
                                    <div class="text-right">
                                        <span class="bg-light text-success-2 fs-12 px-2 py-1 rounded text-nowrap">
                                            Service Available
                                        </span>
                                    </div>
                                </div>
                                <p class="fs-12 mb-3">
                                NIN Personalization
                                </p>
                                <div class="d-flex justify-content-between">
                                    <span class="bg-white text-dark fs-12 p-2 rounded">
                                        Use Service
                                    </span>
                                </div>
                            </a>
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

</body>

</html>