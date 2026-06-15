<?php
require_once '../inc/config.inc.php';
if (!$UserAuth->is_user_logged_in()) {
    if (isset($_POST['login'])) {

        $rules = [
            'email' => [
                'required',
                'email'
            ],
            'password' => [
                'required'
            ]
        ];

        if (isset($_POST['remember'])) {
            $remember = trim($_POST['remember']);
        }

        $validation_result = SimpleValidator\Validator::validate($_POST, $rules);
        if ($validation_result->isSuccess()) {
            if ($UserAuth->LogInUser($_POST)) {




                if (! empty($_POST["remember"])) {
                    setcookie("member_login", $_POST['email'], $cookie_expiration_time);

                    $random_password = $UserAuth->getToken(16);
                    setcookie("random_password", $random_password, $cookie_expiration_time);

                    $random_selector = $UserAuth->getToken(32);
                    setcookie("random_selector", $random_selector, $cookie_expiration_time);

                    $random_password_hash = password_hash($random_password, PASSWORD_DEFAULT);
                    $random_selector_hash = password_hash($random_selector, PASSWORD_DEFAULT);

                    $expiry_date = date("Y-m-d H:i:s", $cookie_expiration_time);

                    // mark existing token as expired
                    $userToken = $UserAuth->getTokenByUsername($_POST['email'], 0);
                    if (! empty($userToken->id)) {
                        $UserAuth->markAsExpired($userToken->id);
                    }
                    // Insert new token
                    $UserAuth->insertToken($_POST['email'], $random_password_hash, $random_selector_hash, $expiry_date);
                }


                $UserAuth->redirect('./');
                exit();
            }
            array_push($SITE_ERRORS, 'Invalid Login Credentials');
        } else {
            array_push($SITE_ERRORS, $validation_result->getErrors());
        }
    }
} else {
    $UserAuth->redirect('./');
}



$PAGE_TITLE   = 'LogIn';
$URL_NAME     = 'login';
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= $PAGE_TITLE . " | " . SITE_TITLE ?></title>
  <link rel="icon" type="image/png" sizes="16x16" href="images/<?= SITE_LOGO ?>">
  <link href="./css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="vendor/toastr/css/toastr.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    *{box-sizing:border-box}
    body.h-100{font-family:'Inter',sans-serif!important;background:#f0f4f8!important;margin:0;padding:0}
    .auth-wrapper{min-height:100vh;display:flex;align-items:stretch}
    /* Left panel */
    .auth-left{flex:0 0 45%;background:linear-gradient(145deg,#0d1b2a 0%,#3061ad 60%,#2696da 100%);display:flex;flex-direction:column;align-items:center;justify-content:center;padding:48px 40px;position:relative;overflow:hidden}
    .auth-left::before{content:'';position:absolute;top:-80px;right:-80px;width:300px;height:300px;background:radial-gradient(circle,rgba(255,255,255,.06),transparent 70%);border-radius:50%}
    .auth-left::after{content:'';position:absolute;bottom:-60px;left:-60px;width:250px;height:250px;background:radial-gradient(circle,rgba(16,213,150,.1),transparent 70%);border-radius:50%}
    .auth-left-inner{position:relative;z-index:1;text-align:center;width:100%}
    .auth-left .logo-wrap img{height:70px;border-radius:0 18px 0;border:2px solid rgba(255,255,255,.25);margin-bottom:32px}
    .auth-left h2{color:#fff;font-size:1.9rem;font-weight:800;line-height:1.2;margin-bottom:12px}
    .auth-left p{color:rgba(255,255,255,.7);font-size:.95rem;line-height:1.7;margin-bottom:28px}
    .auth-features{display:flex;flex-direction:column;gap:14px;text-align:left;margin-top:8px}
    .auth-feature-item{display:flex;align-items:center;gap:12px;color:rgba(255,255,255,.85);font-size:.9rem}
    .auth-feature-icon{width:36px;height:36px;background:rgba(16,213,150,.2);border-radius:10px;display:flex;align-items:center;justify-content:center;color:#10d596;font-size:.9rem;flex-shrink:0}
    /* Right panel */
    .auth-right{flex:1;display:flex;align-items:center;justify-content:center;padding:40px 24px;background:#f0f4f8}
    .auth-card{background:#fff;border-radius:20px;padding:40px 36px;width:100%;max-width:440px;box-shadow:0 8px 40px rgba(48,97,173,.1)}
    .auth-card h4{font-size:1.55rem;font-weight:800;color:#1a2744;margin-bottom:6px}
    .auth-card .auth-desc{color:#888;font-size:.9rem;margin-bottom:28px}
    .form-label-modern{font-size:.82rem;font-weight:600;color:#555;letter-spacing:.03em;text-transform:uppercase;margin-bottom:6px;display:block}
    .input-icon-wrap{position:relative}
    .input-icon-wrap .field-icon{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#aaa;font-size:.9rem;z-index:2}
    .input-icon-wrap .input-modern{padding-left:40px!important;height:48px;border-radius:10px!important;border:1.5px solid #e0e6ef!important;font-size:.93rem;transition:border .2s,box-shadow .2s;width:100%}
    .input-icon-wrap .input-modern:focus{border-color:#3061ad!important;box-shadow:0 0 0 3px rgba(48,97,173,.1)!important;outline:none}
    .eye-toggle{position:absolute;right:14px;top:50%;transform:translateY(-50%);color:#aaa;cursor:pointer;font-size:.9rem;z-index:2;background:none;border:none;padding:0}
    .eye-toggle:hover{color:#3061ad}
    .btn-login{width:100%;height:50px;background:linear-gradient(135deg,#3061ad,#2696da);color:#fff;border:none;border-radius:10px;font-size:1rem;font-weight:700;letter-spacing:.02em;cursor:pointer;transition:all .25s;display:flex;align-items:center;justify-content:center;gap:10px}
    .btn-login:hover{background:linear-gradient(135deg,#2552a0,#1e84c8);box-shadow:0 8px 20px rgba(48,97,173,.35);transform:translateY(-1px)}
    .divider-text{display:flex;align-items:center;gap:12px;margin:18px 0;color:#bbb;font-size:.82rem}
    .divider-text::before,.divider-text::after{content:'';flex:1;height:1px;background:#e8edf5}
    .link-accent{color:#10d596!important;font-weight:600}
    .link-accent:hover{color:#0dc487!important}
    .checkbox-modern .custom-control-label{font-size:.88rem;color:#666}
    .checkbox-modern .custom-control-input:checked~.custom-control-label::before{background-color:#10d596!important;border-color:#10d596!important}
    .auth-bottom-link{text-align:center;margin-top:20px;font-size:.9rem;color:#888}
    @media(max-width:768px){.auth-left{display:none}.auth-right{padding:24px 16px}}
  </style>
</head>
<body class="h-100">
<div class="auth-wrapper">
  <!-- Left Panel -->
  <div class="auth-left">
    <div class="auth-left-inner">
      <div class="logo-wrap"><img src="./images/<?= SITE_LOGO ?>" alt="<?= SITE_TITLE ?>" /></div>
      <h2>Welcome Back!</h2>
      <p>Nigeria's topmost enterprise solution for Airtime, Data, Cable TV &amp; Bill Payments.</p>
      <div class="auth-features">
        <div class="auth-feature-item"><div class="auth-feature-icon"><i class="fa fa-wifi"></i></div><span>Buy cheap data &amp; airtime across all networks</span></div>
        <div class="auth-feature-item"><div class="auth-feature-icon"><i class="fa fa-tv"></i></div><span>Pay DSTV, GOTV, Startimes instantly</span></div>
        <div class="auth-feature-item"><div class="auth-feature-icon"><i class="fa fa-bolt"></i></div><span>Electricity bill payments — PHED, PHCN, AEDC</span></div>
        <div class="auth-feature-item"><div class="auth-feature-icon"><i class="fa fa-coins"></i></div><span>Earn commissions as a reseller</span></div>
      </div>
    </div>
  </div>
  <!-- Right Panel -->
  <div class="auth-right">
    <div class="auth-card">
      <h4>Sign In</h4>
      <p class="auth-desc">Enter your credentials to access your account</p>

      <div id="response_status">
        <?php if (count($SITE_ERRORS) > 0): ?>
          <?php foreach ($SITE_ERRORS as $error): ?>
            <div class="alert alert-danger d-flex align-items-center gap-2 mb-3" style="border-radius:10px;font-size:.88rem">
              <i class="fa fa-circle-exclamation"></i> <?= $error ?>
            </div>
          <?php endforeach ?>
        <?php endif ?>
        <?php if (count($SITE_SUCCESS) > 0): ?>
          <?php foreach ($SITE_SUCCESS as $good): ?>
            <div class="alert alert-success d-flex align-items-center gap-2 mb-3" style="border-radius:10px;font-size:.88rem">
              <i class="fa fa-circle-check"></i> <?= $good ?>
            </div>
          <?php endforeach ?>
        <?php endif ?>
      </div>

      <form method="POST" action="">
        <div class="form-group mb-3">
          <label class="form-label-modern">Email Address</label>
          <div class="input-icon-wrap">
            <i class="fa fa-envelope field-icon"></i>
            <input type="email" name="email" required class="form-control input-modern" placeholder="you@example.com"
              value="<?php if (isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>">
          </div>
        </div>
        <div class="form-group mb-3">
          <label class="form-label-modern">Password</label>
          <div class="input-icon-wrap">
            <i class="fa fa-lock field-icon"></i>
            <input type="password" name="password" id="loginPassword" required class="form-control input-modern" placeholder="Your password"
              value="<?php if (isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>">
            <button type="button" class="eye-toggle" onclick="togglePwd('loginPassword',this)"><i class="fa fa-eye"></i></button>
          </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-4">
          <div class="custom-control custom-checkbox checkbox-modern">
            <input type="checkbox" checked class="custom-control-input" name="remember" id="remember_me"
              <?php if (isset($_COOKIE["member_login"])) { ?>checked<?php } ?>>
            <label class="custom-control-label" for="remember_me">Remember Me</label>
          </div>
          <a href="forgot-password" class="link-accent" style="font-size:.88rem"><i class="fa fa-key" style="margin-right:4px"></i>Forgot Password?</a>
        </div>
        <button name="login" type="submit" class="btn-login">
          <i class="fa fa-sign-in-alt"></i> Sign Me In
        </button>
      </form>

      <div class="auth-bottom-link">
        Don't have an account? <a href="register" class="link-accent">Create one free</a>
      </div>
    </div>
  </div>
</div>

<script src="./vendor/global/global.min.js"></script>
<script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="./js/custom.min.js"></script>
<script src="./js/deznav-init.js"></script>
<script src="./vendor/toastr/js/toastr.min.js"></script>
<script src="./js/plugins-init/toastr-init.js"></script>
<script>
function togglePwd(id,btn){var f=document.getElementById(id);var i=btn.querySelector('i');if(f.type==='password'){f.type='text';i.className='fa fa-eye-slash'}else{f.type='password';i.className='fa fa-eye'}}
</script>
<?php if (count($SITE_ERRORS) > 0): ?>
  <?php foreach ($SITE_ERRORS as $error): ?>
    <script>toastr.error("<?= strip_tags($error) ?>","Login Failed!",{positionClass:"toast-top-right",timeOut:5e3,closeButton:!0,progressBar:!0,newestOnTop:!0})</script>
  <?php endforeach ?>
<?php endif ?>
<?php if (count($SITE_SUCCESS) > 0): ?>
  <?php foreach ($SITE_SUCCESS as $good): ?>
    <script>toastr.success("<?= strip_tags($good) ?>","Success!",{positionClass:"toast-top-right",timeOut:5e3,closeButton:!0,progressBar:!0,newestOnTop:!0})</script>
  <?php endforeach ?>
<?php endif ?>
</body>
</html>
