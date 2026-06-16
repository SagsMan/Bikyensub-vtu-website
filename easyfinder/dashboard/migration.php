<?php
/**
 * Bikyensub — One-Time Notification System Migration
 * Run this file once from your browser, then DELETE it for security.
 * URL: https://bikyensub.com.ng/easyfinder/dashboard/migration.php
 */
if (!defined('MIGRATION_SAFE')) {
    // Simple secret key check — change this to anything private
    if (($_GET['key'] ?? '') !== 'biky2026setup') {
        die('<h2 style="font-family:sans-serif;color:red">Access Denied. Append ?key=biky2026setup to the URL.</h2>');
    }
}

$conn = mysqli_connect('localhost', 'eduowrav_bikyensub', 'bikyensub12345678', 'eduowrav_bikyensub');
if (!$conn) {
    die('<h2 style="color:red">DB connection failed: ' . mysqli_connect_error() . '</h2>');
}

$results = [];

// ── Table 1: admin_notifications_tbl ──────────────────────────────────────────
$sql1 = "CREATE TABLE IF NOT EXISTS admin_notifications_tbl (
    id                INT AUTO_INCREMENT PRIMARY KEY,
    title             VARCHAR(255) NOT NULL,
    message           TEXT NOT NULL,
    notif_type        ENUM('general','update','important','promotion','system_alert') DEFAULT 'general',
    target_audience   ENUM('all','new_users','active_users','resellers') DEFAULT 'all',
    send_via_app      TINYINT(1) DEFAULT 1,
    send_via_email    TINYINT(1) DEFAULT 0,
    send_via_sms      TINYINT(1) DEFAULT 0,
    status            ENUM('draft','pending','sent','failed') DEFAULT 'draft',
    created_by        VARCHAR(255) NULL,
    scheduled_at      DATETIME NULL,
    sent_at           DATETIME NULL,
    total_recipients  INT DEFAULT 0,
    delivered_count   INT DEFAULT 0,
    legacy_notif_id   INT NULL,
    created_at        TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
$results[] = ['table' => 'admin_notifications_tbl', 'ok' => mysqli_query($conn, $sql1), 'err' => mysqli_error($conn)];

// ── Table 2: admin_notif_delivery_tbl ─────────────────────────────────────────
$sql2 = "CREATE TABLE IF NOT EXISTS admin_notif_delivery_tbl (
    id                INT AUTO_INCREMENT PRIMARY KEY,
    notification_id   INT NOT NULL,
    user_id           INT NOT NULL,
    user_name         VARCHAR(255) NULL,
    user_email        VARCHAR(255) NULL,
    user_phone        VARCHAR(20) NULL,
    delivery_status   ENUM('pending','sent','failed','read') DEFAULT 'pending',
    sent_at           DATETIME NULL,
    read_at           DATETIME NULL,
    created_at        TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_notif_id (notification_id),
    INDEX idx_user_id (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
$results[] = ['table' => 'admin_notif_delivery_tbl', 'ok' => mysqli_query($conn, $sql2), 'err' => mysqli_error($conn)];

// ── Table 3: admin_notif_api_settings ─────────────────────────────────────────
$sql3 = "CREATE TABLE IF NOT EXISTS admin_notif_api_settings (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    setting_key   VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT NULL,
    updated_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
$results[] = ['table' => 'admin_notif_api_settings', 'ok' => mysqli_query($conn, $sql3), 'err' => mysqli_error($conn)];

// ── Table 4: notifications_tbl (user-facing) ───────────────────────────────────
$sql4 = "CREATE TABLE IF NOT EXISTS notifications_tbl (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    title         VARCHAR(255) NOT NULL,
    message       TEXT NOT NULL,
    type          ENUM('info','success','warning','danger') DEFAULT 'info',
    target        ENUM('all','specific') DEFAULT 'all',
    target_email  VARCHAR(255) NULL,
    created_by    VARCHAR(255) NULL,
    is_read_by    LONGTEXT NULL DEFAULT '[]',
    status        TINYINT(1) DEFAULT 1,
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
$results[] = ['table' => 'notifications_tbl', 'ok' => mysqli_query($conn, $sql4), 'err' => mysqli_error($conn)];

// ── Insert default API settings if not exist ──────────────────────────────────
$defaults = [
    ['resend_api_key', ''],
    ['resend_from_email', 'notifications@bikyensub.com.ng'],
    ['resend_from_name', 'Bikyensub'],
    ['bulksms_api_token', ''],
    ['bulksms_sender_id', 'Bikyensub'],
    ['bulksms_gateway', '0'],
    ['sms_enabled', '0'],
    ['email_enabled', '0'],
];
foreach ($defaults as [$key, $val]) {
    mysqli_query($conn, "INSERT IGNORE INTO admin_notif_api_settings (setting_key, setting_value) VALUES ('$key', '$val')");
}
$results[] = ['table' => 'admin_notif_api_settings defaults', 'ok' => true, 'err' => ''];

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<title>Bikyensub Migration</title>
<style>
body{font-family:'Segoe UI',sans-serif;background:#060C1A;color:#fff;padding:40px;margin:0}
h1{color:#10d596;margin-bottom:8px}p.sub{color:rgba(255,255,255,.5);margin-bottom:32px}
.card{background:#0D1B2E;border:1px solid rgba(16,213,150,.2);border-radius:12px;padding:20px 24px;margin-bottom:12px;display:flex;align-items:center;justify-content:space-between}
.ok{color:#10d596;font-weight:700;font-size:.88rem}.fail{color:#ef4444;font-weight:700;font-size:.88rem}
.table-name{font-weight:600;font-size:.95rem}
.err{font-size:.8rem;color:#ef4444;margin-top:4px}
.warn{background:#1a1000;border-color:rgba(245,158,11,.4);border-radius:12px;padding:16px 24px;margin-top:24px;color:#F59E0B;font-size:.88rem}
.btn{display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,#10d596,#059669);color:#fff;text-decoration:none;padding:12px 24px;border-radius:10px;font-weight:700;margin-top:20px}
</style>
</head>
<body>
<h1>&#127381; Bikyensub Notification Migration</h1>
<p class="sub">One-time setup to create notification database tables.</p>

<?php foreach ($results as $r): ?>
<div class="card">
  <div>
    <div class="table-name"><?= htmlspecialchars($r['table']) ?></div>
    <?php if (!$r['ok'] && $r['err']): ?><div class="err"><?= htmlspecialchars($r['err']) ?></div><?php endif ?>
  </div>
  <?php if ($r['ok']): ?>
    <span class="ok">&#10003; Done</span>
  <?php else: ?>
    <span class="fail">&#10007; Failed</span>
  <?php endif ?>
</div>
<?php endforeach ?>

<div class="warn">
  &#9888; <strong>Important:</strong> Delete this file immediately after running it. It contains your database credentials and should not remain publicly accessible.
  <br>Path to delete: <code>/bikyensub.com.ng/easyfinder/dashboard/migration.php</code>
</div>
<a href="./" class="btn">&#8592; Go to Dashboard</a>
</body>
</html>
