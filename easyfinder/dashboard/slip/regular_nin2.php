<?php
require_once '../../inc/user_session.inc.php';
// require_once '../../vendor/autoload.php';  // autoload dompdf

use Dompdf\Dompdf;

if (empty($_GET['id'])) {
    exit;
}

$id = $_GET['id'];
$ninDetail = $AdminTask->Get_All_NIN_Details($Auth->email, $id);

if (empty($ninDetail)) {
    echo "No NIN details found.";
    exit;
}

$ninDetail = $ninDetail[0];
if ($ninDetail->type !== 'Regular NIN Slip') {
    exit;
}

$dompdf = new Dompdf();
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NIN Slip</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #000;
        }

        .nin-slip {
            width: 710px;
            /* margin:  auto; */
            border: 3px solid #000;
            /* width: calc(100% - 0.4in); */
        }

        .header {
            text-align: center;
            padding: 5px 0 5px;
            position: relative;
        }

        .header img {
            height: 50px;
            position: absolute;
            top: 5px;
        }
        .header .nimc-icon {
            right: 10px;
        }
        .header .coat-of-arms {
            left: 10px;
        }

        .header h1 {
            font-size: 20px;
            margin: 0;
        }

        .header p {
            margin: 2px 0;
            font-size: 16px;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
        }

        .content td, .content th {
            border: 1px solid #000;
            padding: 1px 8px;
            font-size: 14px;
            white-space: nowrap
        }

        .content th {
            background-color: #f9f9f9;
            text-align: left;
        }

        .address-wrapper {
            display: table; 
            width: 100%;
            /* align-items: flex-end; */
            white-space: wrap
        }

        .address-block {
            position: relative;
            display: table-cell;
            vertical-align: top;
            width: 20%;
        }
  
        .address-block div.state, .address-block div.lga {
            margin-top: 20px;
        }
        .profile {
            display: table-cell;
            vertical-align: bottom;
            width: 40%;
            text-align: right;
        }

        .note {
            margin: 5px;
            padding: 0 1px;
            font-size: 12px;
        }

        .note .sta {
            font-style: italic;
            font-size: 14px;
        }

        .footer table {
            width: 100%;
            /* margin-top: 10px; */
            border: none;
            border-collapse: collapse;
        }

        .footer td {
            border: 1px solid #000;
            font-size: 12px;
            text-align: center;
            padding: 5px 10px;
        }

        .footer img {
            height: 20px;
            vertical-align: middle;
        }

    </style>
</head>
<body>
    <div class="nin-slip">
        <div class="header">
            <img class="coat-of-arms" src="data:image/jpeg;base64,<?= base64_encode(file_get_contents('../images/verification/nigeria-govt-icon.jpg')) ?>" alt="Coat of Arms">
            <img class="nimc-icon" src="data:image/jpeg;base64,<?= base64_encode(file_get_contents('../images/verification/nimc-icon.png')) ?>" alt="NIMC Logo">
            <h1>National Identity Management System</h1>
            <p>Federal Republic of Nigeria</p>
            <p><strong>National Identification Number Slip (NINS)</strong></p>
        </div>

        <div class="content">
            <table>
                <tr>
                    <td><strong>Tracking ID:</strong> <?= $ninDetail->tracking_id ?></td>
                    <td><strong>Surname:</strong> <?= $ninDetail->last_name ?></td>
                    <td rowspan="4">
                    <strong>Address</strong>

                        <div class="address-wrapper">
                            <div class="address-block">
                                <div><?= $ninDetail->residence_adressline ?></div>
                                <div class="lga"><?= $ninDetail->residence_lga ?></div>
                                <div class="state"><?= $ninDetail->residence_state ?></div>
                            </div>
                            <div class="profile">
                                <img src="data:image/jpeg;base64,<?= $ninDetail->photo ?>" alt="Profile Photo" style="height: 180px;">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><strong>NIN:</strong> <?= $ninDetail->nin ?></td>
                    <td><strong>First Name:</strong> <?= $ninDetail->first_name ?></td>
                </tr>
                <tr>
                    <td rowspan="2"></td>
                    <td><strong>Middle Name:</strong> <?= $ninDetail->middle_name ?></td>
                </tr>
                <tr>
                    <td><strong>Gender:</strong> <?= $ninDetail->gender == 'Male' ? 'M': 'F' ?></td>
                </tr>
            </table>

            <p class="note"><strong>Note:</strong> The <strong class="sta">National Identification Number (NIN) is your identity</strong>. It is confidential and may only be released for legitimate transactions. You will be notified when your National Identity Card is ready.</p>
        </div>

        <div class="footer">
            <table>
                <tr>
                    <td><img src="data:image/jpeg;base64,<?= base64_encode(file_get_contents('../images/verification/helpdesk.png')) ?>"> <br> <b>helpdesk@nimc.gov.ng</b></td>
                    <td><img src="data:image/jpeg;base64,<?= base64_encode(file_get_contents('../images/verification/internet-explorer-icon.png')) ?>"> <br> <b>www.nimc.gov.ng</b></td>
                    <td><img src="data:image/jpeg;base64,<?= base64_encode(file_get_contents('../images/verification/call-48.png')) ?>"> <br> <b>0700-CALL-NIMC</b> <br> <b>(0700-2255-646)</b></td>
                    <td><img src="data:image/jpeg;base64,<?= base64_encode(file_get_contents('../images/verification/postal-48.png')) ?>"> <br>
                    <b>National Identification Management Commission</b><br>
                    11, Sokode Crescent, Zone 5 Wuse, Abuja</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>

<?php
$html = ob_get_clean();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("NIN_Slip_Regular.pdf", ["Attachment" => true]);
?>
