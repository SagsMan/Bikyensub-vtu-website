<?php
require_once '../inc/user_session.inc.php';
$PAGE_TITLE = 'Referral Program';
$URL_NAME   = 'referral';

$conn = mysqli_connect('localhost','eduowrav_bikyensub','YOUR_DB_PASSWORD','eduowrav_bikyensub');

// Ensure referal_token exists for this user
$email_esc = mysqli_real_escape_string($conn, $Auth->email);
$user_q = mysqli_query($conn, "SELECT referal_token FROM users_tbl WHERE email='$email_esc' LIMIT 1");
$user_r = mysqli_fetch_assoc($user_q);
if (empty($user_r['referal_token'])) {
    $new_token = md5($Auth->email . time() . rand());
    mysqli_query($conn, "UPDATE users_tbl SET referal_token='$new_token' WHERE email='$email_esc'");
    $referral_code = $new_token;
} else {
    $referral_code = $user_r['referal_token'];
}

$site_url     = 'https://bikyensub.com.ng/easyfinder/dashboard/register?join_with_referal=' . $referral_code;

// Count referred users
$ref_q = mysqli_query($conn, "SELECT COUNT(*) as total FROM users_tbl WHERE referal='$email_esc'");
$ref_r = mysqli_fetch_assoc($ref_q);
$total_referred = intval($ref_r['total'] ?? 0);

// Get referred users list
$refs = [];
$rlist = mysqli_query($conn, "SELECT sname,oname,email,date_join FROM users_tbl WHERE referal='$email_esc' ORDER BY date_join DESC LIMIT 50");
if ($rlist) while ($row = mysqli_fetch_assoc($rlist)) $refs[] = $row;

// Earnings from referal_earn_transaction_tbl
$earn = 0;
$earn_q = mysqli_query($conn, "SELECT SUM(earn_amount) as total FROM referal_earn_transaction_tbl WHERE referal_email='$email_esc' AND status=1");
if ($earn_q && $earn_r = mysqli_fetch_assoc($earn_q)) $earn = floatval($earn_r['total'] ?? 0);

mysqli_close($conn);
$share_msg = "Join Bikyensub and save on data, airtime & more! Use my referral code: $referral_code — Sign up: $site_url";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <?php require_once 'layout/header-propt.inc.php'; ?>
  <title><?= $PAGE_TITLE . ' | ' . SITE_TITLE ?></title>
  <style>
    .ref-card{background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);color:#fff;border-radius:16px;padding:30px;text-align:center;margin-bottom:20px}
    .ref-code{font-size:1.6rem;font-weight:900;letter-spacing:4px;color:#10d596;background:rgba(16,213,150,.1);border:2px dashed #10d596;border-radius:10px;padding:14px 24px;display:inline-block;margin:14px 0}
    .stat-box{background:#fff;border-radius:14px;padding:20px;text-align:center;box-shadow:0 2px 12px rgba(0,0,0,.07)}
    .stat-num{font-size:2.2rem;font-weight:900;color:#10d596}
    .copy-btn{background:#10d596;color:#fff;border:none;border-radius:8px;padding:10px 24px;cursor:pointer;font-weight:600}
    .copy-btn:hover{background:#0db882}
  </style>
</head>
<body>
<?php require_once 'layout/preloader.inc.php'; ?>
<div id="main-wrapper">
  <?php require_once 'layout/header.inc.php'; require_once 'layout/sidebar.inc.php'; ?>

  <div class="content-body">
    <div class="container-fluid">

      <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
          <div class="welcome-text">
            <h4>Referral Program <span style="color:#10d596">💰</span></h4>
            <p class="mb-0">Earn by inviting friends to Bikyensub</p>
          </div>
        </div>
      </div>

      <!-- Referral Card -->
      <div class="row">
        <div class="col-12">
          <div class="ref-card">
            <h5>Your Referral Code</h5>
            <div class="ref-code" id="refCode"><?= htmlspecialchars($referral_code) ?></div>
            <br>
            <button class="copy-btn mr-2" onclick="copyCode()"><i class="fa fa-copy mr-1"></i>Copy Code</button>
            <button class="copy-btn" onclick="copyLink()"><i class="fa fa-link mr-1"></i>Copy Link</button>
            <p class="mt-3 mb-0" style="font-size:.85rem;opacity:.8">Share your link and earn on every friend who registers</p>
          </div>
        </div>
      </div>

      <!-- Stats -->
      <div class="row mb-4">
        <div class="col-md-4 col-6 mb-3">
          <div class="stat-box">
            <div class="stat-num"><?= $total_referred ?></div>
            <p class="mb-0 text-muted">Friends Invited</p>
          </div>
        </div>
        <div class="col-md-4 col-6 mb-3">
          <div class="stat-box">
            <div class="stat-num">₦<?= number_format($earn, 2) ?></div>
            <p class="mb-0 text-muted">Total Earned</p>
          </div>
        </div>
        <div class="col-md-4 col-12 mb-3">
          <div class="stat-box">
            <p class="mb-1 font-weight-bold">Share Your Link</p>
            <div class="input-group">
              <input type="text" class="form-control" id="refLink" value="<?= htmlspecialchars($site_url) ?>" readonly>
              <div class="input-group-append">
                <button class="btn btn-success" onclick="copyLink()"><i class="fa fa-copy"></i></button>
              </div>
            </div>
            <div class="mt-2">
              <a href="https://wa.me/?text=<?= urlencode($share_msg) ?>" target="_blank" class="btn btn-success btn-sm mr-1">
                <i class="fab fa-whatsapp"></i> WhatsApp
              </a>
              <a href="https://t.me/share/url?url=<?= urlencode($site_url) ?>&text=<?= urlencode('Join Bikyensub! Use my code: '.$referral_code) ?>" target="_blank" class="btn btn-primary btn-sm">
                <i class="fab fa-telegram"></i> Telegram
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Referred Users Table -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title"><i class="fa fa-users mr-2" style="color:#10d596"></i>Friends You Referred (<?= $total_referred ?>)</h4>
            </div>
            <div class="card-body">
              <?php if (empty($refs)): ?>
                <div class="text-center py-4 text-muted">
                  <i class="fa fa-user-friends fa-3x mb-3 d-block" style="color:#10d596;opacity:.4"></i>
                  <p>No referrals yet. Share your link to start earning!</p>
                </div>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Date Joined</th></tr></thead>
                    <tbody>
                      <?php foreach ($refs as $i => $r): ?>
                      <tr>
                        <td><?= $i+1 ?></td>
                        <td><?= htmlspecialchars($r['sname'].' '.$r['oname']) ?></td>
                        <td><?= htmlspecialchars($r['email']) ?></td>
                        <td><?= $r['date_join'] ?></td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <?php require_once 'layout/footer-propt.inc.php'; ?>
</div>

<script>
function copyCode() {
  navigator.clipboard.writeText('<?= $referral_code ?>').then(function(){
    alert('Referral code copied!');
  });
}
function copyLink() {
  navigator.clipboard.writeText('<?= $site_url ?>').then(function(){
    alert('Referral link copied!');
  });
}
</script>
</body>
</html>
