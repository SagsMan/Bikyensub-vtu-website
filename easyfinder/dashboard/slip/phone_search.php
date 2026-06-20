<?php
require_once '../../inc/user_session.inc.php';

if (empty($_GET['id'])) {
    exit;
}
$id = $_GET['id'];
$ninDetail = $AdminTask->Get_All_NIN_Details($Auth->email, $id);

if (empty($ninDetail)) {
    echo "No details found.";
    exit;
}

$ninDetail = $ninDetail[0];

function formatDate($dateString) {
    if (empty($dateString) || $dateString == '0000-00-00') return 'N/A';
    try {
        $date = new DateTime($dateString);
        return $date->format('d M Y');
    } catch (Exception $e) {
        return $dateString;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Search Result</title>
    <style>
        @media print {
            .print-action { display: none !important; }
            body { background: white !important; padding: 0 !important; }
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7f6;
            margin: 0;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .slip-container {
            width: 600px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }

        .header {
            background: linear-gradient(135deg, #003366 0%, #004080 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 { margin: 0; font-size: 24px; text-transform: uppercase; letter-spacing: 1px; }
        .header p { margin: 5px 0 0; opacity: 0.8; font-size: 14px; }

        .content { padding: 40px; display: flex; gap: 30px; }

        .photo-box {
            width: 150px;
            height: 180px;
            background: #f9f9f9;
            border: 2px solid #003366;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .photo-box img { width: 100%; height: 100%; object-fit: cover; }
        .no-photo { color: #ccc; font-size: 12px; text-align: center; }

        .details { flex-grow: 1; }

        .detail-row {
            margin-bottom: 20px;
            border-bottom: 1px solid #f0f0f0;
            padding-bottom: 8px;
        }

        .label { font-size: 12px; color: #888; text-transform: uppercase; font-weight: bold; margin-bottom: 4px; }
        .value { font-size: 18px; color: #333; font-weight: 600; }

        .footer {
            background: #fcfcfc;
            padding: 20px 40px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .qr-code img { width: 80px; height: 80px; }

        .verify-info { font-size: 11px; color: #999; line-height: 1.4; }

        .print-action { margin-bottom: 20px; }
        .btn {
            background: #003366;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn:hover { background: #002244; }
    </style>
</head>

<body>
    <div class="print-action">
        <button class="btn" onclick="window.print()">Print This Result</button>
    </div>

    <div class="slip-container">
        <div class="header">
            <h1>Identity Verification</h1>
            <p><?= $ninDetail->type ?></p>
        </div>

        <div class="content">
            <div class="photo-box">
                <?php if (!empty($ninDetail->photo)): ?>
                    <img src="data:image/jpeg;base64,<?= $ninDetail->photo ?>" alt="Photo">
                <?php else: ?>
                    <div class="no-photo">PHOTO NOT<br>AVAILABLE</div>
                <?php endif; ?>
            </div>

            <div class="details">
                <div class="detail-row">
                    <div class="label">Full Name</div>
                    <div class="value"><?= strtoupper($ninDetail->last_name . ' ' . $ninDetail->first_name . ' ' . $ninDetail->middle_name) ?></div>
                </div>
                <div class="detail-row">
                    <div class="label">Phone Number</div>
                    <div class="value"><?= $ninDetail->phone_number ?></div>
                </div>
                <div class="detail-row" style="display: flex; gap: 40px;">
                    <div>
                        <div class="label">Gender</div>
                        <div class="value"><?= $ninDetail->gender ?: 'N/A' ?></div>
                    </div>
                    <div>
                        <div class="label">Date of Birth</div>
                        <div class="value"><?= formatDate($ninDetail->date_of_birth) ?></div>
                    </div>
                </div>
                <?php if ($ninDetail->nin && $ninDetail->nin != 'N/A'): ?>
                <div class="detail-row">
                    <div class="label">Linked NIN</div>
                    <div class="value"><?= $ninDetail->nin ?></div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="footer">
            <div class="verify-info">
                This verification was performed on <?= date('d M Y H:i', strtotime($ninDetail->created_at)) ?><br>
                Identity details provided by authorized Government gateways.<br>
                Trust, but verify.
            </div>
            <div class="qr-code">
                <?php if (!empty($ninDetail->qrcode)): ?>
                    <img src="<?= $ninDetail->qrcode ?>" alt="QR">
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>
