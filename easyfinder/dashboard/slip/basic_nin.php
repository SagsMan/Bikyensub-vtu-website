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
if ($ninDetail->type !== 'Basic NIN Slip') {
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
        }
        body {
              font-family: sans-serif;
              margin: 20px;
          }
          .nin-slip {
              border: 2px solid #000;
              padding: 2px;
              width: calc(100%, -13px);
              min-width: 731px;
              max-width: 935px;
              margin: 30px 12px;
              text-align: center;
          }
          .nin-slip .slip-header {
              display: flex;
              flex-wrap: wrap;
              align-items: center;
              justify-content: space-between;
          }
          .nin-slip .slip-header .header-text {
              flex: 0 0 82%;
              max-width: 82%;
          }
          .nin-slip .slip-header .header-text h1, 
          .nin-slip .slip-header .header-text h3,
          .nin-slip .slip-header .header-text p {
              color: #000;
          }
          .nin-slip .slip-header .header-text p {
              font-weight: 500;
          }
          .nin-slip .m-0 {
              margin: 0;
          }
          .nin-slip .p-0 {
              padding: 0;
          }
          .nin-slip .slip-header img {
              /* max-width: 100px; */
              margin-bottom: 10px;
              margin-right: auto;
          }
          .nin-slip .content {
              display: flex;
          }
          .nin-slip .content .details {
              flex: 0 0 75%;
              max-width: 75%;
              /* margin-left: auto; */
          }
          .nin-slip .content .image{
              /* flex: 0 0 32%; */
              max-width: 32%;
          }
          .nin-slip .content .image img{
              width: 100%;
          }
          .nin-slip h1 {
              font-size: 24px;
              /* margin-bottom: 10px; */
          }
          .nin-slip p {
              margin: 5px 0;
              font-size: 16px;
          }
          .nin-slip .info {
              text-align: left;
              margin-top: 20px;
          }
          .nin-slip .info p {
              margin: 5px 0;
          }

          table {
              width: 100%;
              border-collapse: collapse;
              font-family: Arial, sans-serif;
              font-size: 16px;
              color: #575353;
          }

          table thead tr th {
              /* background-color: #f4f4f4; */
              text-align: center;
              padding: 10px;
              font-size: 18px;
              font-weight: bold;
              border: 1px solid #ddd;
          }

          table tbody tr td {
              border: 1px solid #ddd;
              padding: 10px;
          }

          /* table tbody tr:nth-child(even) {
              background-color: #f9f9f9;
          }

          table tbody tr:hover {
              background-color: #f1f1f1;
          } */

          table tbody tr td:first-child {
              font-weight: bold;
              text-align: left;
          }

          table tbody tr td:last-child {
              text-align: center;
          }

          .print-action {text-align: center;}

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
        <div class="slip-header">
            <div class="header-text">
                <h1 class="m-0 p-0">National Identity Management System</h1>
                <h3 class="m-0 p-0">federal Rebulic Of Nigeria</h3>
                <p class="m-0 p-0">National Identification Number Slip (NINS)</p>
            </div>
            <img src="data:image/jpeg;base64,<?= base64_encode(file_get_contents('../images/verification/nigeria-govt-icon.jpg')) ?>" width="100" alt="Coat of Arms">
        </div>
        <div class="content">
            <div class="image">
                <img src="data:image/jpeg;base64,<?= $ninDetail->photo ?>" alt="NIN Photo">
            </div>
            <div class="details">
                <table>
                    <thead>
                        <tr>
                            <th colspan="2">Personal Information</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>National Identification Number (NIN)</td>
                            <td><?= $ninDetail->nin ?></td>
                        </tr>
                        <tr>
                            <td>First Name</td>
                            <td><?= $ninDetail->first_name ?></td>
                        </tr>
                        <tr>
                            <td>Middle Name</td>
                            <td><?= $ninDetail->middle_name ?></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td><?= $ninDetail->last_name ?></td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td><?= $ninDetail->phone_number ?></td>
                        </tr>
                        <tr>
                            <td>Date of Birth</td>
                            <td><?= $ninDetail->date_of_birth ?></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td><?= $ninDetail->gender ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="print-action">
        <button onclick="window.print()">Print Slip</button>
    </div>
</body>
</html>
