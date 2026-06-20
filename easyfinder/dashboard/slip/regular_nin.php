<?php
require_once '../../inc/user_session.inc.php';

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NIN Slip</title>
    <style>
        @media screen {
            body {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 12px;
                min-height: 100vh;
            }

            .nin-slip {
                max-width: 1000px;
            }
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #000;
        }

        .nin-slip {
            /* width: 710px; */
            /* margin:  auto; */
            border: 3px solid #000;
            width: calc(100%, -23px);
            min-width: 900px;
            margin: 30px 10px;
        }

        .nin-slip .header {
            text-align: center;
            padding: 5px 0 5px;
            position: relative;
        }

        .nin-slip .header img {
            height: 50px;
            position: absolute;
            top: 5px;
        }

        .nin-slip .header .nimc-icon {
            right: 10px;
        }

        .nin-slip .header .coat-of-arms {
            left: 10px;
        }

        .nin-slip .header h1 {
            font-size: 20px;
            margin: 0;
        }

        .nin-slip .header p {
            margin: 2px 0;
            font-size: 16px;
        }

        .nin-slip .content table {
            width: 100%;
            border-collapse: collapse;
        }

        .nin-slip .content td,
        .content th {
            border: 1px solid #000;
            padding: 6px 8px;
            font-size: 14px;
            white-space: nowrap
        }

        .nin-slip .content th {
            background-color: #f9f9f9;
            text-align: left;
        }

        .nin-slip .address-wrapper {
            position: relative;
            display: flex;
            justify-content: space-between;
            /* align-items: flex-end; */
        }

        .nin-slip .address-block {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            /* height: 120px; */
            white-space: wrap;

        }

        .nin-slip .profile {
            height: 180px;
            align-self: flex-end;
        }

        .nin-slip .address-block div:nth-child(2) {
            position: absolute;
            bottom: 20px;
        }

        .nin-slip .address-block div:last-child {
            position: absolute;
            bottom: 0;
        }

        .nin-slip .note {
            margin: 5px;
            padding: 0 1px;
            line-height: 1.5em;
        }

        .nin-slip .note strong:nth-child(2) {
            font-style: italic;
        }

        .nin-slip .footer table {
            width: 100%;
            /* margin-top: 10px; */
            border: none;
            border-collapse: collapse;
        }

        .nin-slip .footer td {
            border: 1px solid #000;
            font-size: 12px;
            text-align: center;
            padding: 5px 10px;
        }

        .nin-slip .footer img {
            height: 20px;
            vertical-align: middle;
        }

        .print-action {
            text-align: center;
        }

        .print-action button {
            padding: 14px;
            background-color: #10d596;
            color: #fff;
            font-size: 18px;
            border: none;
            border-radius: 4px;
            text-align: center;
            margin-inline: auto;
            cursor: pointer;
        }

        .print-action button:hover {
            background-color: #0fd17e;
        }

        @media print {
            .print-action {
                display: none;
            }
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
                        <div class="address-wrapper">
                            <div>
                                <strong>Address</strong>
                                <div class="address-block">
                                    <div><?= $ninDetail->residence_adressline ?></div>
                                    <div><?= $ninDetail->residence_lga ?></div>
                                    <div><?= $ninDetail->residence_state ?></div>
                                </div>
                            </div>
                            <img class="profile" src="data:image/jpeg;base64,<?= $ninDetail->photo ?>" alt="Profile Photo">
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
                    <td><strong>Gender:</strong> <?= $ninDetail->gender == 'Male' ? 'M' : 'F' ?></td>
                </tr>
            </table>

            <p class="note"><strong>Note:</strong> The <strong>National Identification Number (NIN) is your identity</strong>. It is confidential and may only be released for legitimate transactions. You will be notified when your National Identity Card is ready.</p>
        </div>

        <div class="footer">
            <table>
                <tr>
                    <td><img src="data:image/jpeg;base64,<?= base64_encode(file_get_contents('../images/verification/helpdesk.png')) ?>"> <br> <b>helpdesk@nimc.gov.ng</b></td>
                    <td><img src="data:image/jpeg;base64,<?= base64_encode(file_get_contents('../images/verification/internet-explorer-icon.png')) ?>"> <br> <b>www.nimc.gov.ng</b></td>
                    <td><img src="data:image/jpeg;base64,<?= base64_encode(file_get_contents('../images/verification/call-48.png')) ?>"> <br> <b>0700-CALL-NIMC</b> <br> <b>(0700-2255-646)</b></td>
                    <td><img src="data:image/jpeg;base64,<?= base64_encode(file_get_contents('../images/verification/postal-48.png')) ?>"> <br>
                        <b>National Identification Management Commission</b><br>
                        11, Sokode Crescent, Zone 5 Wuse, Abuja
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="print-action">
        <button onclick="window.print()">Print Slip</button>
    </div>
</body>

</html>