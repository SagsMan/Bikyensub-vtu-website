<?php
require_once '../inc/user_session.inc.php';

$PAGE_TITLE = 'Cash Out Your Wallet Money ';
$URL_NAME = 'dashboard/request-cashout';
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

    <?php
//require_once 'layout/preloader.inc.php';
?>

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
                        <div class="card">
                            <div class="card-body ">
                                <?php if (
                                    isset($_POST['make_payment']) &&
                                    is_numeric(
                                        strip_tags(trim($_POST['amount']))
                                    )
                                ) {
                                    $rules = [
                                        'account_no' => ['required', 'numeric'],
                                        'amount' => ['required', 'numeric'],
                                    ];

                                    $validation_result = SimpleValidator\Validator::validate(
                                        $_POST,
                                        $rules
                                    );
                                    if ($validation_result->isSuccess()) {
                                        $amount = htmlspecialchars(
                                            intval($_POST['amount'])
                                        );
                                        if (
                                            $WalletController->Check_Available_Balance_From_Wallet_To_Make_Transaction(
                                                $amount,
                                                $Auth->email
                                            )
                                        ) {
                                            $trans_id = $WalletController->Generate_Trans_id();
                                            if (
                                                $acc_info = $WalletController->Verify_User_Cash_Out_Acc_No(
                                                    $_POST,
                                                    PAYSTACK_API
                                                )
                                            ) {
                                                if (
                                                    isset(
                                                        $acc_info->data
                                                            ->account_number
                                                    )
                                                ) { ?>
                                <div class="col-md-10 offset-md-1">
                                    <div class="card-header">
                                        <h5 class="card-title"> Cash-Out Summary</h5>
                                    </div>
                                    <div class="card-body mb-0">

                                        <div class="table-responsive">
                                            <table class="table" id="table">

                                                <tr>
                                                    <th>Amount </th>
                                                    <td>₦ <?= number_format(
                                                        $amount
                                                    ) ?>
                                                    <td>
                                                </tr>

                                                <tr>
                                                    <th>Account Number </th>
                                                    <td><?= $acc_info->data
                                                        ->account_number ?>
                                                    <td>
                                                </tr>

                                                <tr>
                                                    <th>Account Name </th>
                                                    <td><?= $acc_info->data
                                                        ->account_name ?>
                                                    <td>
                                                </tr>


                                                <tr>
                                                    <th>Bank Name </th>
                                                    <td><?= $WalletController->Get_Single_Bank_Info(
                                                        $_POST['bank_code']
                                                    )->bank_name ?>
                                                    <td>
                                                </tr>

                                                <tr>
                                                    <th>Email </th>
                                                    <td><?= $Auth->email ?>
                                                    <td>
                                                </tr>

                                                <tr>
                                                    <th>Transaction ID </th>
                                                    <td><?= $trans_id ?>
                                                    <td>
                                                </tr>


                                                <tr>
                                                    <th>Status</th>
                                                    <td>Initial
                                                    <td>
                                                </tr>

                                            </table>
                                        </div>
                                        <hr style="">



                                        <form class="form-valide-with-icon" method="POST" action="">
                                            <input type="hidden" name="user_email" value="<?= $Auth->email ?>">
                                            <input type="hidden" name="amount" id="amount" value="<?= $amount ?>">
                                            <input type="hidden" name="Trans_id" value="<?= $trans_id ?>">
                                            <input type="hidden" name="cashOut" value="cashOut">
                                            <input type="hidden" name="bank_code" value="<?= $_POST[
                                                'bank_code'
                                            ] ?>">
                                            <input type="hidden" name="account_no" value="<?= $acc_info
                                                ->data->account_number ?>">
                                            <input type="hidden" name="account_name" value="<?= $acc_info
                                                ->data->account_name ?>">



                                            <a href="<?= SITE_URL ?>dashboard"
                                                class="btn btn-danger light btn-sm pull-left">Cancel</a>
                                            <span class="btn btn-primary btn-sm pull-right" data-toggle="modal"
                                                data-target="#exampleModalpopover" id="btn-continue">Continue</span>

                                        </form>



                                    </div>
                                </div>



                                <?php } else {array_push(
                                                        $SITE_ERRORS,
                                                        'Invalid Account Number!'
                                                    ); ?>

                                <div class="alert alert-danger" style="text-align:center">The Account Number You Entered
                                    is Invalid! </div>
                                <a href="<?= SITE_URL ?>/dashboard/request-cashout" class="btn btn-primary">Re-try
                                    again</a>

                                <?php }
                                            }
                                        } else {
                                            array_push(
                                                $SITE_ERRORS,
                                                'Insuficient Balance. Please fund your wallet and try again!'
                                            ); ?>
                                <div class="alert alert-danger" style="text-align:center">Insuficient Balance. Please <a
                                        href="<?= SITE_URL ?>/dashboard/credit-wallet">Click Here</a> To Fund Your
                                    Wallet</div>
                                <a href="<?= SITE_URL ?>/dashboard/topup" class="btn btn-primary">Re-try again</a>


                                <?php
                                        }
                                    }
                                } elseif (
                                    isset($_POST['cashOut']) &&
                                    !empty($_POST['amount'])
                                ) {
                                    if (
                                        !$WalletController->Check_If_My_Transaction_Id_Exist(
                                            $_POST['Trans_id'],
                                            'cash_out_tbl'
                                        )
                                    ) {
                                        if (
                                            $WalletController->Check_Available_Balance_From_Wallet_To_Make_Transaction(
                                                intval($_POST['amount']),
                                                $Auth->email
                                            )
                                        ) {
                                            if (
                                                $transfar_reciept_callback = $WalletController->Generate_Cash_Out_Wallet_Transfer_Reciept(
                                                    $_POST,
                                                    PAYSTACK_API
                                                )
                                            ) {
                                                if (
                                                    $TransferWalletMoneyToBank = $WalletController->Request_For_Cash_Out(
                                                        $_POST['Trans_id'],
                                                        intval(
                                                            $_POST['amount']
                                                        ),
                                                        $Auth->email,
                                                        $_POST['account_no'],
                                                        $_POST['account_name'],
                                                        $_POST['bank_code'],
                                                        $transfar_reciept_callback
                                                            ->data
                                                            ->recipient_code,
                                                        $transfar_reciept_callback
                                                            ->data->integration,
                                                        $transfar_reciept_callback
                                                            ->data->id,
                                                        PAYSTACK_API
                                                    )
                                                ) {
                                                    if (
                                                        $TransferWalletMoneyToBank
                                                            ->data->status ==
                                                            'success' ||
                                                        $TransferWalletMoneyToBank
                                                            ->data->status ==
                                                            'pending'
                                                    ) { ?>

                                <div class="col-md-10 offset-md-1">
                                    <div class="card-header">
                                        <h5 class="card-title">Your Cash Out Is Successful</h5>
                                    </div>
                                    <div class="card-body mb-0">

                                        <div class="table-responsive">
                                            <table class="table" id="table">

                                                <tr>
                                                    <th>Amount </th>
                                                    <td>₦ <?= number_format(
                                                        $_POST['amount']
                                                    ) ?>
                                                    <td>
                                                </tr>

                                                <tr>
                                                    <th>Account Number </th>
                                                    <td><?= $transfar_reciept_callback
                                                        ->data->details
                                                        ->account_number ?>
                                                    <td>
                                                </tr>

                                                <tr>
                                                    <th>Account Name </th>
                                                    <td><?= $_POST[
                                                        'account_name'
                                                    ] ?>
                                                    <td>
                                                </tr>


                                                <tr>
                                                    <th>Bank Name </th>
                                                    <td><?= $WalletController->Get_Single_Bank_Info(
                                                        $transfar_reciept_callback
                                                            ->data->details
                                                            ->bank_code
                                                    )->bank_name ?>
                                                    <td>
                                                </tr>

                                                <tr>
                                                    <th>Email </th>
                                                    <td><?= $Auth->email ?>
                                                    <td>
                                                </tr>

                                                <tr>
                                                    <th>Status</th>
                                                    <td><?= $TransferWalletMoneyToBank
                                                        ->data->status ?>
                                                    <td>
                                                </tr>

                                            </table>
                                        </div>




                                    </div>
                                </div>


                                <?php } else { ?>


                                <div class="col-md-10 offset-md-1">
                                    <div class="card-header">
                                        <h5 class="card-title">Your Cash Out Is Queue - Pending</h5>
                                    </div>
                                    <div class="card-body mb-0">

                                        <div class="table-responsive">
                                            <table class="table" id="table">

                                                <tr>
                                                    <th>Amount </th>
                                                    <td>₦ <?= number_format(
                                                        $_POST['amount']
                                                    ) ?>
                                                    <td>
                                                </tr>

                                                <tr>
                                                    <th>Account Number </th>
                                                    <td><?= $transfar_reciept_callback
                                                        ->data->details
                                                        ->account_number ?>
                                                    <td>
                                                </tr>

                                                <tr>
                                                    <th>Account Name </th>
                                                    <td><?= $_POST[
                                                        'account_name'
                                                    ] ?>
                                                    <td>
                                                </tr>


                                                <tr>
                                                    <th>Bank Name </th>
                                                    <td><?= $WalletController->Get_Single_Bank_Info(
                                                        $transfar_reciept_callback
                                                            ->data->details
                                                            ->bank_code
                                                    )->bank_name ?>
                                                    <td>
                                                </tr>

                                                <tr>
                                                    <th>Email </th>
                                                    <td><?= $Auth->email ?>
                                                    <td>
                                                </tr>

                                                <tr>
                                                    <th>Status</th>
                                                    <td>Pending
                                                    <td>
                                                </tr>

                                            </table>
                                        </div>




                                    </div>
                                </div>



                                <?php }
                                                } else {
                                                    array_push(
                                                        $SITE_ERRORS,
                                                        'Error Occurs While Cashing Out ! Pls. Try Again'
                                                    );
                                                }
                                            }
                                        }
                                    } else {
                                        array_push(
                                            $SITE_ERRORS,
                                            'Duplicate Transaction Id or Key!'
                                        ); ?>

                                <div class="alert alert-danger" style="text-align:center">Duplicate Transaction Id or
                                    Key</div>
                                <a href="<?= SITE_URL ?>/dashboard/" class="btn btn-primary">Re-try again</a>


                                <?php
                                    }
                                } else {
                                     ?>


                                <div class="card-header">
                                    <h4 class="card-title">Cash Out Your Wallet Money </h4>
                                </div>
                                <div class="card-body">

                                    <form action="" method="POST" class="form-valide-with-icon">
                                        <div class="form-group">
                                            <label> Select Bank: </label>
                                            <select data-shb-product-option="data-shb-product-option"
                                                data-live-search="true" name="bank_code" class="form-control"
                                                required="">
                                                <option value="">Choose Bank</option>
                                                <?php if (
                                                    $banks = $WalletController->Get_All_Bank_Names()
                                                ) {
                                                    foreach (
                                                        $banks
                                                        as $bank
                                                    ) { ?>

                                                <option value="<?= trim(
                                                    $bank->bank_code
                                                ) ?>"><?= $bank->bank_name ?></option>

                                                <?php }
                                                } ?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-label">Enter Your Account Number: </label>
                                            <div class="input-group">

                                                <input type="number" name="account_no" required="" class="form-control"
                                                    autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="text-label">Enter Amount: </label><br>
                                            <span style="color: red">(Minimum: ₦500 - Maximum: ₦5000)</span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"> ₦</span>
                                                </div>
                                                <input type="number" name="amount" required="" id="amount"
                                                    class="form-control" autocomplete="off"
                                                    onkeyup="checkAmount(this.value)">
                                            </div>
                                        </div>




                                        <button class="btn btn-primary" name="make_payment" id="btn-cashout"
                                            value="make_payment">Continue</button>



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
                            <label class="mb-1"><strong>Enter Your Pass Pin : </strong></label>
                            <div class="input-group">
                                <input type="password" name="pass" value="" required="" id="ss_amount"
                                    class="form-control" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                        <a href="#" class="btn btn-primary" id="btn-submit" data-dismiss="modal">Continue</a>
                    </div>

                </div>
            </div>


        </div>

        <?php
        require_once 'layout/footer.inc.php';
        require_once 'layout/footer-propt.inc.php';
        ?>



        <script type="text/javascript">
        if ($('#amount').val() < 1 || $('#amount').val() > 5000) {
            $('#btn-cashout').prop("disabled", true);
        } else {
            $('#btn-cashout').prop("disabled", false);
        }

        function checkAmount(val) {
            if (val < 1 || val > 5000) {
                $('#btn-cashout').prop("disabled", true);
            } else {
                $('#btn-cashout').prop("disabled", false);
            }
        }
        </script>
        <script type="text/javascript">
        $('#btn-submit').on('click', function(e) {
            e.preventDefault();
            var form = $('form');
            var send_to_confirm = "<?= $Auth->pin ?>";
            var send_to_confirm_entered = $('#ss_amount').val();
            var ss_amount = md5(send_to_confirm_entered);
            if (send_to_confirm === ss_amount) {
                swal.fire({
                    title: "<br><span style='font-size: 20px; color:red'>Please confirm your Cash-Out request? </span> <br> <p style='font-size:18px; font-weight:1px'>Account Number : <?= $acc_info
                        ->data
                        ->account_number ?> <br> Account Name : <?= $acc_info
     ->data
     ->account_name ?> <br> Amount : ₦" + document.getElementById('amount').value + " <br> Charges Amount : ₦" + (1 /
                        100) * document.getElementById('amount').value + "</p>",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#003366",
                    confirmButtonText: "Confirm",
                }).then(function(result) {
                    if (result.value === true) {
                        //console.log("Submitted");
                        form.submit();
                    }
                });
            } else {
                toastr.error("Invalid Pass Pin. Please try again !", "Error Occurs!", {
                    positionClass: "toast-top-right",
                    timeOut: 5e3,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })
            }
        });
        </script>

</body>

</html>