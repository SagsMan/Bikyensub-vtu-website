<?php
require_once '../../inc/user_session.inc.php';

if (empty($_GET['id'])) {
    exit;
}
$id = $_GET['id'];
$bvnDetail = $VerificationController->Get_All_Verifications_By_Type(userEmail: $Auth->email, id: $id);

if (empty($bvnDetail)) {
    echo "No NIN details found.";
    exit;
}

$bvnDetail = $bvnDetail[0];
if ($bvnDetail->type !== 'Basic BVN Slip' && $bvnDetail->type !== 'Advanced BVN Slip') exit;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        @media print {
            body {
                margin: 0;
                padding: 20px;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .print-action {
                display: none;
            }
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            align-items: center;
            /* padding: 10px; */
            background: white;
            border: 1px solid #000;
            box-shadow: 0 0 2px rgb(0, 0, 0);
        }

        .header-logo {
            width: 150px;
            height: 40px;
        }

        .header-message {
            margin-left: 20px;
            font-size: 15px;
            text-align: center;
            width: 90%;
            font-weight: bold;
        }

        .date {
            text-align: right;
            padding: 15px 10px 2px 0;
            font-size: 14px;
        }

        .content {
            display: flex;
            gap: 20px;
        }

        .photo {
            width: 200px;
            height: 250px;
            background: #eee;
            border: 1px solid #ccc;
        }

        .info-table {
            flex: 1;
        }

        .info-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table th {
            padding: 5px;
            text-align: left;
            font-weight: normal;
            border: 1px solid #ccc;
            width: 32%;
            font-weight: bold;
        }

        .info-table td {
            padding: 5px;
            border: 1px solid #ccc;
        }

        .table-header {
            padding: 8px;
            border: 1px solid #ccc;
            color: #9e9e9e;
            font-weight: bold;
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
            margin-top: 20px;
        }

        .print-action button:hover {
            background-color: #0fd17e;
        }

        @media (max-width: 600px) {
            .content {
                flex-direction: column;
            }

            .photo {
                margin-inline: auto;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="../images/verification/bvn-logo.jpeg" class="header-logo" alt="Lock icon">
            <div class="header-message">
                The Bank Verification Number has successfully been verified.
            </div>
        </div>

        <div class="date">
            Date: <?= (new DateTime())->format('Y-m-d\TH:i:sP'); ?>
        </div>

        <div class="content">
            <img src="data:image/jpeg;base64,<?= $bvnDetail->photo ?>" class="photo" />
            <div class="info-table">
                <div class="table-header">Personal Information</div>
                <table>
                    <tr>
                        <th>BVN</th>
                        <td><?= $bvnDetail->search_query ?></td>
                    </tr>
                    <?php if ($bvnDetail->type == 'Advanced BVN Slip') : ?>
                    <tr>
                        <th>NIN</th>
                        <td><?= $bvnDetail->nin ?></td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <th>First Name</th>
                        <td><?= $bvnDetail->first_name ?></td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td><?= $bvnDetail->last_name ?></td>
                    </tr>
                    <tr>
                        <th>Middle Name</th>
                        <td><?= $bvnDetail->middle_name ?></td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td><?= $bvnDetail->phone_number ?></td>
                    </tr>
                    <?php if ($bvnDetail->type == 'Advanced BVN Slip') : ?>
                    <tr>
                        <th>Email</th>
                        <td><?= $bvnDetail->owner_email ?></td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <th>Date of birth</th>
                        <td><?= $bvnDetail->date_of_birth ?></td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td><?= $bvnDetail->gender ?></td>
                    </tr>
                    <?php if ($bvnDetail->type == 'Advanced BVN Slip') : ?>
                    <tr>
                        <th>Enrollment Bank</th>
                        <td><?= $bvnDetail->enrollment_bank ?></td>
                    </tr>
                    <tr>
                        <th>Enrollment Branch</th>
                        <td><?= $bvnDetail->enrollment_branch ?></td>
                    </tr>
                    <tr>
                        <th>Registration Date</th>
                        <td><?= $bvnDetail->registration_date ?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><?= $bvnDetail->residential_address ?></td>
                    </tr>
                    <?php endif; ?>
                    
                </table>
            </div>
        </div>
    </div>
    <div class="print-action">
        <button onclick="window.print()">Print Slip</button>
    </div>
</body>

</html>