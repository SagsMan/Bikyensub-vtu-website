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
// Note: VerificationController might set type to 'Premium NIN Slip' or similar. 
// We check for NIN types generally if we want to be flexible, but user linked to premium_nin specifically.

function formatDate($dateString) {
    if (empty($dateString)) return '';
    $date = new DateTime($dateString);
    $day = $date->format('d');
    $month = strtoupper($date->format('M'));
    $year = $date->format('Y');
    return "{$day} {$month} {$year}";
}

function formatNIN($nin) {
    $cleanNin = preg_replace('/\D/', '', $nin);
    if (strlen($cleanNin) !== 11) return $nin;
    return substr($cleanNin, 0, 4) . ' ' . substr($cleanNin, 4, 3) . ' ' . substr($cleanNin, 7);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium NIN Slip</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Charm&family=Playwrite+CO+Guides&display=swap" rel="stylesheet">
    <style>
        @media print {
            body {
                margin: 0;
                padding: 0;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .print-action { display: none !important; }
        }

        * { box-sizing: border-box; }

        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 20px;
            background: #f0f2f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .nin-card {
            position: relative;
            width: 850px;
            height: 400px; /* Estimated height for the card style */
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #c3e6cb;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            background-image: linear-gradient(135deg, #f8fff9 0%, #e8f5e9 100%);
        }

        .header-bar {
            background-color: #2e7d32; /* Deep green */
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-bar h1 {
            margin: 0;
            font-size: 18px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .header-bar p {
            margin: 0;
            font-size: 14px;
            font-weight: bold;
            opacity: 0.9;
        }

        .card-body {
            display: flex;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .photo-section {
            width: 160px;
            margin-right: 30px;
        }

        .photo-section img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border: 3px solid #2e7d32;
            border-radius: 4px;
        }

        .data-section {
            flex-grow: 1;
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .data-item {
            margin-bottom: 5px;
        }

        .data-label {
            font-size: 11px;
            color: #2e7d32;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .data-value {
            font-size: 18px;
            font-weight: 700;
            color: #1b5e20;
        }

        .qr-section {
            position: absolute;
            top: 70px;
            right: 20px;
            text-align: center;
        }

        .qr-section img {
            width: 130px;
            height: 130px;
            border: 1px solid #ddd;
            padding: 5px;
            background: white;
        }

        .nin-display {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
        }

        .nin-number {
            font-size: 64px;
            font-weight: 900;
            color: #000;
            letter-spacing: 12px;
            font-family: 'Courier New', Courier, monospace;
        }

        .issuance-info {
            position: absolute;
            bottom: 15px;
            right: 25px;
            font-size: 12px;
            color: #388e3c;
            font-weight: bold;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 55%;
            transform: translate(-50%, -50%);
            width: 350px;
            opacity: 0.05;
            z-index: 0;
            pointer-events: none;
        }

        /* Back side */
        .nin-back {
            width: 850px;
            border: 2px solid #2e7d32;
            background: white;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
        }
        
        .disclaimer-title { font-size: 24px; font-weight: 900; margin-bottom: 10px; color: #2e7d32; }
        .caution-title { font-size: 20px; font-weight: 800; margin: 15px 0 5px; color: #c62828; }
        .back-text { font-size: 14px; line-height: 1.6; color: #333; max-width: 90%; margin: 0 auto; }

        .print-action { margin-bottom: 40px; }
        .print-btn {
            background-color: #2e7d32;
            color: white;
            border: none;
            padding: 15px 40px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .print-btn:hover { background-color: #1b5e20; }
    </style>
</head>

<body>
    <div class="print-action">
        <button class="print-btn" onclick="window.print()">Print Premium NIN Slip</button>
    </div>

    <!-- Front side -->
    <div class="nin-card">
        <img src="../images/verification/nigeria-govt-icon.jpg" class="watermark" alt="">
        
        <div class="header-bar">
            <div>
                <h1>Federal Republic of Nigeria</h1>
                <p>DIGITAL NIN SLIP</p>
            </div>
            <img src="../images/verification/coat-of-arm.png" style="height: 40px;" alt="">
        </div>

        <div class="card-body">
            <div class="photo-section">
                <img src="data:image/jpeg;base64,<?= $ninDetail->photo ?>" alt="Photo">
            </div>
            
            <div class="data-section">
                <div class="data-item">
                    <div class="data-label">Surname</div>
                    <div class="data-value"><?= strtoupper($ninDetail->last_name) ?></div>
                </div>
                
                <div class="data-item">
                    <div class="data-label">Given Names</div>
                    <div class="data-value"><?= strtoupper($ninDetail->first_name . ' ' . $ninDetail->middle_name) ?></div>
                </div>
                
                <div style="display: flex; gap: 40px;">
                    <div class="data-item">
                        <div class="data-label">Date of Birth</div>
                        <div class="data-value"><?= formatDate($ninDetail->date_of_birth) ?></div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">Gender</div>
                        <div class="data-value"><?= ($ninDetail->gender == 'Female' || $ninDetail->gender == 'F') ? 'F' : 'M' ?></div>
                    </div>
                </div>
            </div>

            <div class="qr-section">
                <img src="<?= $ninDetail->qrcode ?>" alt="QR Code">
                <div style="font-size: 12px; font-weight: bold; margin-top: 5px; color: #2e7d32;">NGA</div>
            </div>
        </div>

        <div class="nin-display">
            <div class="nin-number"><?= formatNIN($ninDetail->nin) ?></div>
        </div>

        <div class="issuance-info">
            Issued: <?= date('d M Y') ?>
        </div>
    </div>

    <!-- Back side -->
    <div class="nin-back">
        <div class="disclaimer-title">DISCLAIMER</div>
        <p style="font-family: 'Charm', cursive; font-size: 18px; margin-bottom: 15px;">Trust, but verify</p>
        
        <p class="back-text">
            Kindly ensure each time this ID is presented, that you verify the credentials using a Government-APPROVED verification resource.<br>
            The details on the front of this NIN Slip must EXACTLY match the verification result.
        </p>

        <div class="caution-title">CAUTION!</div>
        <p class="back-text">
            If this NIN was not issued to the person on the front of this document, please DO NOT attempt to scan, photocopy or replicate the personal data contained herein.<br>
            You are only permitted to scan the barcode for the purpose of identity verification.<br>
            The **FEDERAL GOVERNMENT of NIGERIA** assumes no responsibility if you accept variance in the scan result or do not scan the 2D barcode overleaf.
        </p>
    </div>

</body>

</html>
