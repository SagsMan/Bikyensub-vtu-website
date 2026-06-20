<?php
require_once '../inc/user_session.inc.php';

$PAGE_TITLE = 'Airtime VTU';
$URL_NAME = 'dashboard/topup';
require_once '../inc/accessbility_controller.inc.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'layout/header-propt.inc.php'; ?>

    <title><?= $PAGE_TITLE . ' | ' . SITE_TITLE ?> </title>
    <style type="text/css">
        table {
            width: 100%
        }

        #table th,
        #table td {
            border: none;
            padding: 7px;
        }
    </style>
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
            <?php include 'layout/minor-top-navbar.inc.php'; ?>
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4 style="color: #003366; font-size: 20px"><?= $PAGE_TITLE ?></h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)"><?= SITE_TITLE ?> </a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)"><?= $PAGE_TITLE ?></a></li>
                        </ol>
                    </div>
                </div>





                <div class="row ">
                    <div class="col-12">
                        <div class="card  text-white bg-secondary">
                            <div class="card-body ">
                                <?php if (
                                    isset($_POST['buy_airtime']) &&
                                    !empty($_POST['amount'])
                                ) {
                                    $trans_id = trim($_POST['trans_id']);
                                    if (
                                        !$WalletController->Check_If_My_Transaction_Id_Exist(
                                            $trans_id,
                                            'transactions_tbl'
                                        )
                                    ) {
                                        if (
                                            $TopupController->Store_My_Trans(
                                                $trans_id,
                                                $_POST['amount'],
                                                $_POST['amount'],
                                                $Auth->email,
                                                $_POST['mobile_num'],
                                                $Auth->phone,
                                                strtoupper(str_replace("-", " ", $_POST['network_slug'])),
                                                1
                                            )
                                        ) {
                                            if (
                                                $WalletController->Check_Available_Balance_From_Wallet_To_Make_Transaction(
                                                    $_POST['amount'],
                                                    $Auth->email
                                                )
                                            ) {
                                                if (
                                                    $WalletController->Make_Tansaction_From_My_Wallet(
                                                        $trans_id,
                                                        $_POST['amount'],
                                                        $Auth->email
                                                    )
                                                ) {
                                                    if (
                                                        $Airtime_result = $TopupController->BuyAirtime(
                                                            $_POST
                                                        )
                                                    ) {
                                                        ?>
                                                        <?php if (
                                                            $Airtime_result->status == 'Successful' ||
                                                            isset($Airtime_result->id)
                                                        ) {
                                                            $status = 1;
                                                            if (
                                                                $WalletController->Update_Successful_Remove_Wallet_Money_Trans_Status(
                                                                    'topup',
                                                                    $_POST['amount'],
                                                                    $trans_id,
                                                                    $Auth->email
                                                                )
                                                            ) {
                                                                if (
                                                                    $TopupController->Confirm_My_Trans(
                                                                        $Airtime_result->status,
                                                                        $trans_id,
                                                                        $Airtime_result->id,
                                                                        $status
                                                                    )
                                                                ) {
                                                                    if (
                                                                        $trans_info = $TopupController->Get_Trans_Info(
                                                                            $trans_id
                                                                        )
                                                                    ) { ?>

                                                                        <div class="col-xl-12">
                                                                            <div class="card text-white bg-success">
                                                                                <div class="card-header">
                                                                                    <h5 class="card-title text-white">Transaction Successful :
                                                                                        <?= $Airtime_result->api_response ?> </h5>
                                                                                </div>
                                                                                <div class="card-body mb-0">


                                                                                    <div class="table-responsive">
                                                                                        <table class="table text-white" id="table">

                                                                                            <tr>
                                                                                                <th>Product Name</th>
                                                                                                <td><?= $Airtime_result->plan_name ?>
                                                                                                <td>
                                                                                            </tr>

                                                                                            <tr>
                                                                                                <th>Phone Number</th>
                                                                                                <td><?= $Airtime_result->mobile_number ?>
                                                                                                <td>
                                                                                            </tr>


                                                                                            <tr>
                                                                                                <th>Amount</th>
                                                                                                <td><?= $trans_info->amount ?>
                                                                                                <td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th>Email : </th>
                                                                                                <td><?= $trans_info->email ?>
                                                                                                <td>
                                                                                            </tr>

                                                                                            <tr>
                                                                                                <th>Transaction ID</th>
                                                                                                <td><?= $trans_info->request_id ?>
                                                                                                <td>
                                                                                            </tr>

                                                                                            <tr>
                                                                                                <th>Request ID</th>
                                                                                                <td><?= $trans_info->request_id ?>
                                                                                                <td>
                                                                                            </tr>

                                                                                            <tr>
                                                                                                <th>Status</th>
                                                                                                <td><?= $trans_info->response_description ?>
                                                                                                <td>
                                                                                            </tr>
                                                                                        </table>


                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                    <?php }
                                                                }
                                                            }
                                                        } else {
                                                            $status = 2;

                                                            if (
                                                                $trans_info = $TopupController->Get_Trans_Info(
                                                                    $trans_id
                                                                )
                                                            ) {
                                                                if (
                                                                    $TopupController->Confirm_My_Trans(
                                                                        'Transaction Failed',
                                                                        $trans_info->request_id,
                                                                        $trans_info->request_id,
                                                                        $status
                                                                    )
                                                                ) {
                                                                    if (
                                                                        $WalletController->Update_Refund_failed_Wallet_Money_Trans_Status(
                                                                            $trans_info->request_id,
                                                                            $Auth->email,
                                                                            $trans_info->amount
                                                                        )
                                                                    ) {
                                                                        array_push(
                                                                            $SITE_ERRORS,
                                                                            'TRANSACTION FAILED'
                                                                        ); ?>

                                                                        <div class="col-xl-12">
                                                                            <div class="card text-white bg-danger">
                                                                                <div class="card-header">
                                                                                    <h5 class="card-title text-white"><?= strtoupper(
                                                                                                                            $trans_info->product_name
                                                                                                                        ) ?> : Transaction Failed </h5>
                                                                                </div>
                                                                                <div class="card-body mb-0">


                                                                                    <div class="table-responsive">
                                                                                        <table class="table text-white" id="table">

                                                                                            <tr>
                                                                                                <th>Product Name</th>
                                                                                                <td><?= $trans_info->product_name ?>
                                                                                                <td>
                                                                                            </tr>

                                                                                            <tr>
                                                                                                <th>Phone Number</th>
                                                                                                <td><?= $trans_info->unique_element ?>
                                                                                                <td>
                                                                                            </tr>

                                                                                            <tr>
                                                                                                <th>Amount</th>
                                                                                                <td><?= $trans_info->amount ?>
                                                                                                <td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th>Email : </th>
                                                                                                <td><?= $trans_info->email ?>
                                                                                                <td>
                                                                                            </tr>

                                                                                            <tr>
                                                                                                <th>Transaction ID</th>
                                                                                                <td><?= $trans_info->request_id ?>
                                                                                                <td>
                                                                                            </tr>

                                                                                            <tr>
                                                                                                <th>Request ID</th>
                                                                                                <td><?= $trans_info->request_id ?>
                                                                                                <td>
                                                                                            </tr>


                                                                                            <tr>
                                                                                                <th>Status</th>
                                                                                                <td>Failed
                                                                                                <td>
                                                                                            </tr>
                                                                                        </table>


                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                <?php
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            } else {
                                                if (
                                                    $TopupController->Confirm_My_Trans(
                                                        'Insuficient Balance',
                                                        $trans_id
                                                    )
                                                ) {
                                                    array_push(
                                                        $SITE_ERRORS,
                                                        'Insuficient Balance. Please fund your wallet and try again!'
                                                    );
                                                } ?>
                                                <div class="alert alert-danger" style="text-align:center">Insuficient Balance. Please <a
                                                        href="<?= SITE_URL ?>easyfinder/dashboard/credit-wallet">Click Here</a> To Fund Your
                                                    Wallet</div>
                                                <a href="<?= SITE_URL ?>easyfinder/dashboard/topup" class="btn btn-primary">Re-try again</a>

                                        <?php
                                            }
                                        }
                                    } else {
                                        array_push(
                                            $SITE_ERRORS,
                                            'Duplicate Transaction Id or Key!'
                                        ); ?>

                                        <div class="alert alert-danger" style="text-align:center">Duplicate Transaction Id or
                                            Key</div>
                                        <a href="<?= SITE_URL ?>easyfinder/dashboard/topup" class="btn btn-primary">Re-try again</a>

                                    <?php
                                    }
                                } elseif (
                                    isset($_GET['phone']) &&
                                    is_numeric(strip_tags(trim($_GET['phone'])))
                                ) {
                                    $trans_id = $WalletController->Generate_Trans_id();
                                    $phone_num = strip_tags(
                                        htmlspecialchars($_GET['phone'])
                                    );
                                    if (
                                        $Operator = $Reloadly_API->AutoDectedOperatorNumber(
                                            $phone_num,
                                            'NG',
                                            RELOADLY_API
                                        )
                                    ) {
                                        if (isset($Operator->name)){
                                        switch (strtolower($Operator?->name) ?? '') {
                                            case 'mtn nigeria':
                                                $network_id = '1';
                                                $network_slug = 'mtn';
                                                $network_data_name =
                                                    'MTN Airtime';

                                                break;

                                            case 'airtel nigeria':
                                                $network_id = '4';
                                                $network_slug = 'airtel';
                                                $network_data_name =
                                                    'Airtel Airtime';
                                                break;

                                            case 'glo nigeria':
                                                $network_id = '2';
                                                $network_slug = 'glo';
                                                $network_data_name =
                                                    'Glo Airtime';
                                                break;

                                            case '9mobile (etisalat) nigeria':
                                                $network_id = '3';
                                                $network_slug = 'etisalat';
                                                $network_data_name =
                                                    '9Mobile Airtime';
                                                break;

                                            default:
                                                $network_id = '6';
                                                $network_slug = 'smile';
                                                $network_data_name =
                                                    'Smile Airtime';
                                        }  
                                        ?>

                                        <div class="card-header">
                                            <h5 class="card-title text-white">Phone No.: <?= $phone_num ?></h5>
                                        </div>
                                        <div class="card-body mb-0">


                                            <div class="bootstrap-media">
                                                <div class="media">
                                                    <?php if (isset($Operator->errorCode)): ?>
                                                        <p class="text-warning"><?= $Operator->message; ?></p>
                                                    <?php else: ?>
                                                        <img src="<?= $Operator
                                                                        ->logoUrls[1] ?>" alt="<?= $Operator
                                                                                                    ->logoUrls[1] ?>" class="img-responsive" style="max-width: 70px">
                                                </div>
                                            <?php endif; ?>

                                            <div class="media-body">
                                                <h3 class="text-white" style="padding: 10px;"><?= $Operator?->name ?? '' ?>
                                                </h3>

                                            </div>
                                            </div>
                                        </div>
                                        <hr />
                                        <form class="form-valide-with-icon" method="POST" action="">
                                            <div class="col-md-12 form-group">
                                                <label>Enter Amount : </label><br>
                                                <span style="color: red">(Minimum: ₦50 - Maximum: ₦50000)</span>
                                                <div class="input-group">
                                                    <input type="Number" class="form-control" placeholder="Enter Amount"
                                                        id="s_amount" name="amount" required="">

                                                    <input type="hidden" name="buy_airtime">
                                                    <input type="hidden" id="mobile_num" name="mobile_num" value="<?= $phone_num ?>">
                                                    <input type="hidden" id="network_slug" name="network_slug" value="<?= $network_slug ?>">
                                                    <input type="hidden" id="trans_id" name="trans_id" value="<?= $trans_id ?>">

                                                </div>
                                            </div>
                                            <a href="data-topup" class="btn btn-danger btn-sm pull-left light">Cancel</a>
                                            <span onclick="initiate_buy_airtime()" class="btn btn-danger btn-sm pull-right" id="btn-continue">Buy Now</span>

                                        </form>




                            </div>


                        <?php
                                    }else{
                                        array_push(
                                            $SITE_ERRORS,
                                            'Invalid Phone Number!'
                                        ); ?>

                                        <div class="alert alert-danger" style="text-align:center">Invalid Phone Number!</div>
                                        <a href="<?= SITE_URL ?>easyfinder/dashboard/topup" class="btn btn-primary">Re-try again</a>

                                    <?php
                                    }
                                }
                                } else {
                        ?>

                        <div class="card-header">
                            <h4 class="card-title text-white">Buy Airtime</h4>
                        </div>
                        <div class="card-body">

                            <form action="topup" method="GET" class="form-valide-with-icon">

                                <div class="form-group">
                                    <label class="text-label">Phone Number : </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> +234 </span>
                                        </div>
                                        <input type="tel" name="phone" required="" class="form-control"
                                            autocomplete="off" placeholder="Eg: 08060989901">
                                    </div>
                                </div>

                                <button class="btn btn-danger">Continue</button>



                            </form>

                        </div>






                    <?php
                                } ?>



                        </div>
                    </div>

                </div>








            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalpopover">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Authentication PIN</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="mb-1"><strong>Enter Your Pass PIN : </strong></label>
                        <div class="input-group">
                            <input type="password" name="pass" value="" required="" id="s_pin"
                                class="form-control" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <a href="#" class="btn btn-primary" id="btn-submit" onclick="buy_airtime()" data-dismiss="modal">Continue</a>
                </div>

            </div>
        </div>


    </div>
    <?php
    require_once 'layout/footer.inc.php';
    require_once 'layout/footer-propt.inc.php';
    ?>



    <script type="text/javascript">
        var bURL = "<?= SITE_URL."easyfinder/".$URL_NAME ?>";

        const initiate_buy_airtime = () => {
            let amount = document.querySelector("#s_amount").value;
            if (amount && amount > 50 && amount < 50000){
                const myModalElement = document.getElementById('exampleModalpopover');
                const myModal = new bootstrap.Modal(myModalElement);
                myModal.show();
            }
        };

        const buy_airtime = () => {
            let amount = document.querySelector("#s_amount").value, num = document.querySelector("#mobile_num").value, network_slug = document.querySelector("#network_slug").value, trans_id = document.querySelector("#trans_id").value, pin = document.querySelector("#s_pin").value;
            if (amount && num && network_slug && trans_id && pin){
            if (md5(pin) != "<?= $Auth->pin ?>"){
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Incorrect PIN. Please try again!",
                });
                return;
               }
                params = {
                    buy_airtime: true,
                    amount: amount,
                    mobile_num: num,
                    network_slug: network_slug,
                    trans_id: trans_id,
                    pin: pin,
                };

                const form = document.createElement("form");
                form.method = "POST";
                form.action = bURL;

               for (const key in params) {
                if (Object.prototype.hasOwnProperty.call(params, key)) {
                  const hiddenField = document.createElement("input");
                  hiddenField.type = "hidden";
                  hiddenField.name = key;
                  hiddenField.value = params[key];
                  form.appendChild(hiddenField);
                }
               }

               document.body.appendChild(form);
               form.submit();
            }
        }
    </script>



</body>

</html>