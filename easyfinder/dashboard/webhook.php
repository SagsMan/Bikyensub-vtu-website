<?php
/**
 * Bikyensub Website — PaymentPoint Webhook
 * Replaces Monnify. Set this URL in PaymentPoint dashboard:
 * https://bikyensub.com.ng/easyfinder/dashboard/webhook.php
 */

$raw   = file_get_contents('php://input');
$data  = json_decode($raw, true);

if (!$data) { http_response_code(400); echo "INVALID"; exit; }

// Reject if not a successful payment event
$status = strtolower($data['transaction_status'] ?? $data['notification_status'] ?? '');
if (!in_array($status, ['success', 'successful', 'payment_successful'])) {
    echo "IGNORED"; exit;
}

// Extract fields (PaymentPoint payload structure)
$amount_paid  = floatval($data['amount_paid'] ?? $data['settlement_amount'] ?? 0);
$reference    = $data['transaction_id'] ?? $data['reference'] ?? '';
$email        = $data['customer']['email'] ?? $data['receiver']['email'] ?? '';

if (empty($email) || empty($reference) || $amount_paid <= 0) {
    http_response_code(400); echo "MISSING_FIELDS"; exit;
}

// Connect to the website DB (same as API)
$conn = mysqli_connect('localhost','eduowrav_bikyensub','YOUR_DB_PASSWORD','eduowrav_bikyensub');
if (!$conn) { http_response_code(503); echo "DB_ERROR"; exit; }

// Idempotency — skip if already processed
$ref_esc = mysqli_real_escape_string($conn, $reference);
$exist   = mysqli_query($conn, "SELECT id FROM payment_history_tbl WHERE reference='$ref_esc' LIMIT 1");
if ($exist && mysqli_num_rows($exist) > 0) {
    mysqli_close($conn); echo "OK_DUPLICATE"; exit;
}

// Fallback to wallet_history_tbl if payment_history_tbl doesn't exist
$has_payment_tbl = mysqli_query($conn, "SHOW TABLES LIKE 'payment_history_tbl'");
if (!$has_payment_tbl || mysqli_num_rows($has_payment_tbl) === 0) {
    $exist2 = mysqli_query($conn, "SELECT id FROM wallet_history_tbl WHERE trans_id='$ref_esc' LIMIT 1");
    if ($exist2 && mysqli_num_rows($exist2) > 0) {
        mysqli_close($conn); echo "OK_DUPLICATE"; exit;
    }
}

$email_esc = mysqli_real_escape_string($conn, $email);

// Verify user exists
$user_q = mysqli_query($conn, "SELECT id,email,sname,oname FROM users_tbl WHERE email='$email_esc' LIMIT 1");
if (!$user_q || mysqli_num_rows($user_q) === 0) {
    mysqli_close($conn); http_response_code(404); echo "USER_NOT_FOUND"; exit;
}
$user = mysqli_fetch_assoc($user_q);
$name = trim($user['sname'].' '.$user['oname']);

// Credit wallet
mysqli_query($conn, "UPDATE wallet_tbl SET balance = balance + $amount_paid WHERE user_id='$email_esc'");

// Log in wallet_history_tbl
mysqli_query($conn,
    "INSERT INTO wallet_history_tbl (trans_id,email,trans_amount,trans_date,status,wallet_status)
     VALUES ('$ref_esc','$email_esc','$amount_paid',NOW(),'0','credit')");

// Log in payment_history_tbl if it exists
if ($has_payment_tbl && mysqli_num_rows($has_payment_tbl) > 0) {
    $sender_name = mysqli_real_escape_string($conn, $data['sender']['name'] ?? 'PaymentPoint');
    $sender_bank = mysqli_real_escape_string($conn, $data['sender']['bank'] ?? '');
    mysqli_query($conn,
        "INSERT INTO payment_history_tbl (reference,email,amount,sender_name,sender_bank,status,created_at)
         VALUES ('$ref_esc','$email_esc','$amount_paid','$sender_name','$sender_bank','success',NOW())");
}

// Get new balance
$bal_q = mysqli_query($conn, "SELECT balance FROM wallet_tbl WHERE user_id='$email_esc' LIMIT 1");
$balance = $bal_q ? (float)(mysqli_fetch_assoc($bal_q)['balance'] ?? 0) : 0;

// Save in-app notification
$notif_title = mysqli_real_escape_string($conn, "Wallet Credited \u{2705}");
$notif_msg   = mysqli_real_escape_string($conn,
    sprintf('₦%s has been added to your wallet. New balance: ₦%s.',
        number_format($amount_paid, 2), number_format($balance, 2)));
mysqli_query($conn,
    "INSERT INTO notifications_tbl (title,message,type,target,target_email,created_by,status)
     VALUES ('$notif_title','$notif_msg','success','specific','$email_esc','system',1)");

mysqli_close($conn);

// Send FCM push to user's device
$push_url  = 'https://api.bikyensub.com.ng/sendPushToUser.php';
$push_data = json_encode([
    'admin_key' => 'YOUR_ADMIN_KEY',
    'email'     => $email,
    'title'     => "Wallet Credited \u{2705}",
    'body'      => "₦" . number_format($amount_paid, 2) . " added. Balance: ₦" . number_format($balance, 2),
    'data'      => ['screen' => 'Wallet', 'amount' => $amount_paid],
]);
$ch = curl_init($push_url);
curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => $push_data,
    CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT        => 8,
    CURLOPT_SSL_VERIFYPEER => false,
]);
curl_exec($ch);
curl_close($ch);

echo "OK";
