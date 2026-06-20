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
if ($ninDetail->type !== 'Virtual NIN Slip') {
    exit;
}

function formatDate($dateString) {
    $date = new DateTime($dateString);
    $day = $date->format('j');
    $month = strtoupper($date->format('M'));  // Short month, uppercase
    $year = $date->format('Y');
    return "{$day} {$month} {$year}";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NIMC Verification Slip</title>
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
          }
          .container {
              width: 80%;
              min-width: 930px;
              margin: 20px auto;
              border: 1px solid #ddd;
              padding: 20px;
              box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
              position: relative;
              overflow: hidden;
          }
          .watermark-numbers {
              position: absolute;
              color: rgba(0, 0, 0, 0.1);
              font-size: 64px;
              white-space: nowrap;
              z-index: 100;
          }
          .watermark-1 {
              bottom: 100px;
              left: -160px;
              transform: rotate(-45deg);
          }

          .watermark-2 {
              bottom: 120px;
              left: 10%;
              transform: rotate(-45deg);
          }

          .watermark-3 {
              bottom: 60px;
              right: -70px;
              transform: rotate(-45deg);
          }
          .header {
              text-align: center;
          }
          .header img {
              width: 120px;
          }
          .title {
              font-size: 24px;
              margin: 10px 0;
          }
          .content {
              display: grid;
              grid-template-columns: 2fr 1fr;
              gap: 20px;
              align-items: center;
          }
          .content .first-part {
              display: flex;
              justify-content: flex-start;
          }
          .id-card {
              margin: 20px 0;
              border: 1px solid #ddd;
              padding: 10px;
              position: relative;
          }
          .coat-of-arms-watermark {
              position: absolute;
              top: 50%;
              left: 50%;
              transform: translate(-50%, -50%);
              width: calc(100%, -30px);
              height: 100%;
              opacity: 0.08;
              /* background-image: url('../images/'); */
              background-size: contain;
              background-repeat: no-repeat;
              background-position: center;
              z-index: 0;
          }
          .id-card-header {
              text-align: center;
          }
          .id-card-header img {
              width: 90px;
          }
          .id-card-content {
              display: flex;
              justify-content: space-between;
              margin: 20px 0;
          }
          .photo-section img {
              width: 100%;
              min-width: 120px;
              height: 100%;
          }
          .id-card p {
              font-weight: bold;
              font-size: 12px;
              text-align: center;
              margin: 0;
          }
          .info-section {
              flex: 1;
              margin-left: 10px;
          }
          .info-section div {
              margin-bottom: 10px;
          }
          .info-section div strong {
              font-size: 0.8em;
              color: #aaa;
              white-space: nowrap;
          }
          .info-section-2 {
              margin: auto 4px;
          }
          .info-section-2 div {
              margin-bottom: 10px;
              white-space: nowrap;
          }
          .info-section-2 div span {
              font-size: 30px;
              font-weight: bolder;
              text-transform: uppercase;
          }
          .id-qrcode {
              text-align: right;
          }
          .id-qrcode b {
              margin-bottom: -15px;
              display: inline-block;
              width: 100%;
              text-align: center;
          }
          .id-qrcode img {
              width: 130px;
          }
          .table-section {
              margin-top: 5px;
          }
          table {
              width: 100%;
              border-collapse: collapse;
          }
          th, td {
              border: 1px solid #ddd;
              padding: 10px;
              text-align: left;
              white-space: nowrap;
          }
          th {
              background-color: #f4f4f4;
          }
          .qr-code {
              margin-top: 20px;
              text-align: right;
          }
          .qr-code img {
              width: 100%;
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
              th {
                  -webkit-print-color-adjust: exact;
                  print-color-adjust: exact;
                  background-color: #f4f4f4 !important;
              }

              .print-action {
                display: none;
              }
          }
    </style>
</head>
<body>
    <div class="container">
        <div class="watermark-numbers watermark-1"><?= $ninDetail->nin ?></div>
        <div class="watermark-numbers watermark-2"><?= $ninDetail->nin ?></div>
        <div class="watermark-numbers watermark-3"><?= $ninDetail->nin ?></div>
        <div class="header">
            <img src="../images/verification/nimc-icon.png" alt="NIMC Logo">
            <h3 class="title">Verification-as-a-Service</h3>
        </div>

        <div class="content">
            <div class="first-part">
                <div class="id-card">
                    <img src="../images/verification/nigeria-govt-icon.jpg" class="coat-of-arms-watermark" />
                    <div class="id-card-header">
                        <img src="../images/verification/coat-of-arm.png" alt="Coat of Arms">
                    </div>
                    <div class="id-card-content">
                        <div class="photo-section">
                            <img src="<?= $ninDetail->photo ?>" alt="User Photo">
                        </div>
                        <div class="info-section">
                            <div><strong>Surname/Nom:</strong><br> <?= $ninDetail->last_name ?></div>
                            <div><strong>Given Names/Prénoms:</strong><br> <?= $ninDetail->first_name ?></div>
                            <div><strong>Date of Birth:</strong><br> <?= formatDate($ninDetail->date_of_birth) ?></div>
                        </div>
                        <div class="id-qrcode">
                            <b>NGA</b>
                            <img src="<?= $ninDetail->qrcode ?>" />
                        </div>
                    </div>
                    <p>This document has been verified by NIMC</p>
    
                </div>
                <div class="info-section-2">
                    <div><strong>Surname/Nom:</strong><br> <span><?= $ninDetail->last_name ?></span></div>
                    <div><strong>Given Names/Prénoms:</strong><br> <span><?= $ninDetail->first_name ?></span></div>
                </div>
            </div>
            <div class="qr-code">
                <img src="<?= $ninDetail->qrcode ?>" alt="QR Code">
            </div>
        </div>

        <div class="table-section">
            <table>
                <tr>
                    <th>TimeStamp</th>
                    <th>Transaction ID</th>
                    <th>Verification Type</th>
                    <th>Verification Status</th>
                    <th>Verification Agent ID</th>
                </tr>
                <tr>
                    <td><?= $ninDetail->ts ?></td>
                    <td><?= $ninDetail->txid ?></td>
                    <td>TOKEN</td>
                    <td>OK</td>
                    <td><?= $ninDetail->agent_id ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="print-action">
        <button onclick="window.print()">Print Slip</button>
    </div>
</body>
</html>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NIMC Verification Slip</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }
        .container {
            width: 900px;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            height: 70px;
        }
        .header h1 {
            font-size: 2.5em;
            margin: 5px 0;
        }
        .header p {
            font-size: 1.2em;
            color: #666;
        }
        .content {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 20px;
            align-items: center;
        }
        .id-card {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .id-card img {
            width: 100%;
            border-bottom: 1px solid #ddd;
            margin-bottom: 10px;
        }
        .details {
            font-size: 1em;
            line-height: 1.6;
        }
        .qr-code img {
            width: 200px;
        }
        .transaction {
            margin-top: 30px;
            width: 100%;
            border-collapse: collapse;
        }
        .transaction th, .transaction td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        .print-btn {
            text-align: center;
            margin-top: 30px;
        }
        .print-btn button {
            padding: 12px 25px;
            font-size: 1em;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .print-btn button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="nimc-logo.png" alt="NIMC Logo">
            <h1>Nimc</h1>
            <p>Verification-as-a-Service</p>
        </div>
        
        <div class="content">
            <div class="id-card">
                <img src="user-photo.png" alt="User Photo">
                <p><strong>Surname:</strong> YUSUF</p>
                <p><strong>Given Names:</strong> OLA</p>
                <p><strong>Date of Birth:</strong> 01-JAN-1979</p>
                <p>This document has been verified by NIMC</p>
            </div>

            <div class="qr-code">
                <img src="qr-code.png" alt="QR Code">
            </div>
        </div>
        
        <table class="transaction">
            <tr>
                <th>TimeStamp</th>
                <th>Transaction ID</th>
                <th>Verification Type</th>
                <th>Verification Status</th>
                <th>Verification Agent ID</th>
            </tr>
            <tr>
                <td>2023-08-09T08:58:52</td>
                <td>002c9bde-7481-4702-93a6-d47f2730e9e</td>
                <td>TOKEN</td>
                <td>OK</td>
                <td>****1235</td>
            </tr>
        </table>
        
        <div class="print-btn">
            <button onclick="window.print()">Print Slip</button>
        </div>
    </div>
</body>
</html> -->
