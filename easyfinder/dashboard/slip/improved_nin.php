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
if ($ninDetail->type !== 'Improved NIN Slip') {
    exit;
}
function formatDate($dateString) {
    $date = new DateTime($dateString);
    $day = $date->format('j');
    $month = strtoupper($date->format('M'));  // Short month, uppercase
    $year = $date->format('Y');
    return "{$day} {$month} {$year}";
}

function formatNIN($nin) {
    // Remove non-digit characters
    $cleanNin = preg_replace('/\D/', '', $nin);
    // Ensure NIN is exactly 11 digits
    if (strlen($cleanNin) !== 11) {
        return $nin;  // Return as is if not 11 digits
    }
    // Format as 4-3-4 (e.g., 1234 567 8901)
    return substr($cleanNin, 0, 4) . ' ' . substr($cleanNin, 4, 3) . ' ' . substr($cleanNin, 7);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NIN Slip</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Charm&family=Playwrite+CO+Guides&display=swap" rel="stylesheet">
    <style>
        @media print {
            body {
                margin: 0;
                padding: 20px;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family:'Times New Roman', Times, serif;
            margin: 0;
            padding: 20px;
            background: #f5f5f5;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 12px;
            min-height: 100vh;
        }

        .nin-card {
            position: relative;
            display: grid;
            grid-template-rows: auto 1fr auto;
            max-width: 700px;
            width: 90%;
            background: white;
            padding: 7px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;
        }

        .nin-back {
            font-family: Arial, Helvetica, sans-serif;
            max-width: 700px;
            width: 90%;
            border: 2px solid #000;
            padding: 10px 15px;
            text-align: center;
            transform: rotate(180deg);
        }

        .nin-back .trust {
            font-family: "Charm", serif;
            font-weight: 400;
            font-style: normal;
        }

        .nin-back h1, .nin-back h2 {
            margin: 0;
        }

        .watermark-numbers {
            position: absolute;
            color: rgba(0, 0, 0, 0.1);
            font-size: 18px;
            white-space: nowrap;
            z-index: 100;
        }

        .watermark-left-1 {
            bottom: 100px;
            left: -10px;
            transform: rotate(-45deg);
        }

        .watermark-left-2 {
            bottom: 43px;
            left: 0;
            transform: rotate(-45deg);
        }

        .watermark-right {
            bottom: 60px;
            right: 10px;
            transform: rotate(45deg);
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

        .coat-of-arms {
            text-align: center;
        }

        .coat-of-arms img {
            width: 100px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: 1fr 2fr 1fr;
            gap: 20px;
            align-items: center;
            margin-top: -23px;
        }

        .photo-placeholder {
            width: 150px;
            height: 165px;
        }

        .details {
            display: flex;
            flex-direction: column;
        }

        .qr-code {
            width: 150px;
            height: 150px;
        }

        .nga-number {
            text-align: center;
            margin-top: 10px;
        }

        /* .nga-number {
            position: absolute;
            right: 60px;
            top: 75px;
            text-align: center;
            z-index: 1;
        } */
        .nga-number span:first-child {
            font-size: 22px;
            font-weight: bold;
        }
        .nga-number span:last-child {
            display: inline-block;
            transform: scale(-1, -1);
            color: rgba(0, 0, 0, 0.1);
        }

        .label {
            color: #666;
            font-size: 14px;
        }

        .value {
            font-size: 18px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .nin-number {
            text-align: center;
            font-size: 55px;
            font-weight: bold;
            letter-spacing: 3px;
        }

        .title {
            text-align: center;
            font-size: 16px;
        }

        .note {
            font-size: 9px;
            text-align: center;
            color: rgba(0, 0, 0, 0.5);
            font-style: italic;
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

        /* Mobile Adjustments */
        @media (max-width: 600px) {
            body {
                zoom: 0.2;
            }
            .grid-container {
                grid-template-columns: 1fr;
                text-align: center;
                margin-top: 0;
            }

            .photo-placeholder,
            .qr-code {
                margin: 0 auto;
            }
        }

        @media print {
            .print-action {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="nin-card">
        <img src="../images/verification/nigeria-govt-icon.jpg" class="coat-of-arms-watermark" />
        <div class="watermark-numbers watermark-left-1"><?= $ninDetail->nin ?></div>
        <div class="watermark-numbers watermark-left-2"><?= $ninDetail->nin ?></div>
        <div class="watermark-numbers watermark-right"><?= $ninDetail->nin ?></div>
        <div class="coat-of-arms">
            <img src="../images/verification/coat-of-arm.png" alt="Coat of Arms">
        </div>

        <div class="grid-container">
            <img src="data:image/jpeg;base64,<?= $ninDetail->photo ?>" class="photo-placeholder" alt="User Photo">
            <div class="details">
                <div class="label">Surname/Nom</div>
                <div class="value"><?= $ninDetail->last_name ?></div>

                <div class="label">Given Names/Prénoms</div>
                <div class="value"><?= $ninDetail->first_name . ', ' . $ninDetail->middle_name ?></div>

                <div class="label">Date of Birth</div>
                <div class="value"><?= formatDate($ninDetail->date_of_birth); ?></div>
            </div>

            <div style="margin-top: -30px">
                <div class="nga-number"><span>NGA</span><br> <span><?= $ninDetail->nin ?></span></div>
                <img src="<?= $ninDetail->qrcode ?>" class="qr-code" alt="QR Code">
            </div>
        </div>

        <div class="title">National Identification Number (NIN)</div>
        <div class="nin-number"><?= formatNIN($ninDetail->nin); ?></div>

        <p class="note">
            Kindly ensure you scan the barcode to verify the credentials
        </p>
    </div>
    <div class="nin-back">
        <h1>DISCLAIMER</h1>
        <p class="trust">Trust, but verify</p>

        <p>Kindly ensure each time this ID is presented, that you verify the credentials 
            using a Government-APPROVED verification resource.</p>
        <p>The details on the front of this NIN Slip must EXACTLY match the verification result.</p>

        <h2>CAUTION!</h2>
        <p>If this NIN was not issued to the person on the front of this document, please DO NOt 
            attempt to scan, photocopy or replicate the personal data contained herein.</p>
        <p>You are only permitted to scan the barcode for the purpose of identity verification.</p>
        <p>The FEDERAL GOVERNMENT of NIGERIA assumes no responsibility if you accept variance in the 
            scan result or do not scan the 2D barcode overleaf
        </p>
    </div>

    <div class="print-action">
        <button onclick="window.print()">Print Slip</button>
    </div>
</body>

</html>