<?php
require_once '../inc/config.inc.php';
if (!$UserAuth->is_user_logged_in()) {
    if (isset($_POST['login'])) {
        $rules = [
            'email'    => ['required', 'email'],
            'password' => ['required']
        ];
        if (isset($_POST['remember'])) {
            $remember = trim($_POST['remember']);
        }
        $validation_result = SimpleValidator\Validator::validate($_POST, $rules);
        if ($validation_result->isSuccess()) {
            if ($UserAuth->LogInUser($_POST)) {
                if (!empty($_POST['remember'])) {
                    setcookie('member_login', $_POST['email'], $cookie_expiration_time);
                    $random_password = $UserAuth->getToken(16);
                    setcookie('random_password', $random_password, $cookie_expiration_time);
                    $random_selector = $UserAuth->getToken(32);
                    setcookie('random_selector', $random_selector, $cookie_expiration_time);
                    $random_password_hash = password_hash($random_password, PASSWORD_DEFAULT);
                    $random_selector_hash = password_hash($random_selector, PASSWORD_DEFAULT);
                    $expiry_date = date('Y-m-d H:i:s', $cookie_expiration_time);
                    $userToken = $UserAuth->getTokenByUsername($_POST['email'], 0);
                    if (!empty($userToken->id)) $UserAuth->markAsExpired($userToken->id);
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
$PAGE_TITLE = 'Login';
$URL_NAME   = 'login';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title><?= $PAGE_TITLE . ' | ' . SITE_TITLE ?></title>
  <link rel="icon" type="image/png" href="images/<?= SITE_LOGO ?>"/>
  <link href="./css/style.css" rel="stylesheet"/>
  <link rel="stylesheet" href="./vendor/toastr/css/toastr.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
  <style>
    :root{--green:#10d596;--blue:#2696da;--blue2:#3061ad;--dark:#060C1A;--card:#0D1B2E}
    *{box-sizing:border-box;margin:0;padding:0}
    body{font-family:'Inter',sans-serif!important;background:var(--dark)!important;min-height:100vh;display:flex;align-items:stretch}
    .auth-wrap{min-height:100vh;width:100%;display:flex;align-items:stretch}

    /* Left panel */
    .auth-left{flex:0 0 44%;background:linear-gradient(145deg,#050c1a 0%,#0a1a3a 50%,#0d2451 100%);display:flex;flex-direction:column;align-items:center;justify-content:center;padding:52px 44px;position:relative;overflow:hidden}
    .auth-left::before{content:'';position:absolute;top:-80px;right:-80px;width:320px;height:320px;background:radial-gradient(circle,rgba(16,213,150,.12),transparent 70%);border-radius:50%}
    .auth-left::after{content:'';position:absolute;bottom:-60px;left:-60px;width:260px;height:260px;background:radial-gradient(circle,rgba(38,150,218,.1),transparent 70%);border-radius:50%}
    .auth-left-inner{position:relative;z-index:1;text-align:center;width:100%}
    .auth-logo{height:72px;border-radius:0 18px 0;border:2px solid rgba(16,213,150,.4);margin-bottom:28px;max-width:200px}
    .auth-left h2{color:#fff;font-size:1.8rem;font-weight:900;line-height:1.2;margin-bottom:10px}
    .auth-left p{color:rgba(255,255,255,.6);font-size:.9rem;line-height:1.75;margin-bottom:28px}
    .auth-feature{display:flex;align-items:center;gap:12px;text-align:left;margin-bottom:14px}
    .af-dot{width:36px;height:36px;background:rgba(16,213,150,.15);border:1px solid rgba(16,213,150,.3);border-radius:10px;display:flex;align-items:center;justify-content:center;color:var(--green);font-size:.88rem;flex-shrink:0}
    .af-text{color:rgba(255,255,255,.75);font-size:.87rem;line-height:1.4}
    .tag{display:inline-flex;align-items:center;gap:5px;background:rgba(16,213,150,.1);border:1px solid rgba(16,213,150,.3);color:var(--green);padding:4px 12px;border-radius:50px;font-size:.72rem;font-weight:600;text-transform:uppercase;letter-spacing:.05em;margin-bottom:18px}

    /* Right panel */
    .auth-right{flex:1;display:flex;align-items:center;justify-content:center;padding:40px 24px;background:linear-gradient(135deg,#07101e,#0a1628)}
    .auth-card{width:100%;max-width:420px}
    .auth-card h3{color:#fff;font-size:1.55rem;font-weight:900;margin-bottom:4px}
    .auth-card .sub{color:rgba(255,255,255,.45);font-size:.88rem;margin-bottom:28px}

    /* Alerts */
    .alert-dark{background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.3);border-radius:10px;padding:12px 16px;font-size:.85rem;color:#fca5a5;display:flex;align-items:center;gap:8px;margin-bottom:20px}
    .alert-success-dark{background:rgba(16,213,150,.1);border:1px solid rgba(16,213,150,.3);border-radius:10px;padding:12px 16px;font-size:.85rem;color:#6ee7b7;display:flex;align-items:center;gap:8px;margin-bottom:20px}

    /* Form */
    .form-lbl{font-size:.78rem;font-weight:600;color:rgba(255,255,255,.55);letter-spacing:.04em;text-transform:uppercase;display:block;margin-bottom:7px}
    .input-wrap{position:relative;margin-bottom:18px}
    .field-ico{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:rgba(255,255,255,.3);font-size:.88rem;z-index:2}
    .field-input{width:100%;height:50px;background:rgba(255,255,255,.05)!important;border:1.5px solid rgba(255,255,255,.12)!important;border-radius:12px!important;color:#fff!important;font-size:.92rem!important;padding-left:42px!important;padding-right:14px!important;transition:border .2s,box-shadow .2s;font-family:'Inter',sans-serif!important}
    .field-input::placeholder{color:rgba(255,255,255,.25)!important}
    .field-input:focus{border-color:var(--green)!important;box-shadow:0 0 0 3px rgba(16,213,150,.12)!important;outline:none!important;background:rgba(16,213,150,.04)!important}
    .eye-btn{position:absolute;right:14px;top:50%;transform:translateY(-50%);color:rgba(255,255,255,.3);cursor:pointer;font-size:.88rem;background:none;border:none;padding:0;z-index:2;transition:color .2s}
    .eye-btn:hover{color:var(--green)}
    .custom-check{display:flex;align-items:center;gap:8px;cursor:pointer}
    .custom-check input{accent-color:var(--green);width:16px;height:16px}
    .custom-check label{color:rgba(255,255,255,.55);font-size:.85rem;cursor:pointer}
    .link-green{color:var(--green);text-decoration:none;font-weight:600;font-size:.85rem;transition:color .2s}
    .link-green:hover{color:#0dc487}
    .btn-login{width:100%;height:50px;background:linear-gradient(135deg,var(--green),#059669);color:#fff;border:none;border-radius:12px;font-size:.98rem;font-weight:700;cursor:pointer;transition:all .3s;display:flex;align-items:center;justify-content:center;gap:9px;font-family:'Inter',sans-serif;box-shadow:0 6px 20px rgba(16,213,150,.3)}
    .btn-login:hover{transform:translateY(-1px);box-shadow:0 10px 28px rgba(16,213,150,.5)}
    .divider-or{display:flex;align-items:center;gap:12px;margin:20px 0;color:rgba(255,255,255,.25);font-size:.78rem}
    .divider-or::before,.divider-or::after{content:'';flex:1;height:1px;background:rgba(255,255,255,.08)}
    .reg-link{text-align:center;margin-top:18px;font-size:.88rem;color:rgba(255,255,255,.45)}
    @media(max-width:768px){.auth-left{display:none}.auth-right{padding:24px 16px}.auth-card{max-width:100%}}
  </style>
</head>
<body>
<div class="auth-wrap">

  <!-- Left Brand Panel -->
  <div class="auth-left">
    <div class="auth-left-inner">
      <img src="./images/<?= SITE_LOGO ?>" class="auth-logo" alt="<?= SITE_TITLE ?>"
        onerror="this.outerHTML='<span style=&quot;color:var(--green);font-size:1.5rem;font-weight:900;display:block;margin-bottom:24px&quot;><?= SITE_TITLE ?></span>'"/>
      <div class="tag">🇳🇬 Nigeria's #1 VTU Platform</div>
      <h2>Welcome Back!</h2>
      <p>Login to access cheap data, airtime, bill payments, and start earning commissions daily.</p>
      <div class="auth-feature">
        <div class="af-dot"><i class="fa fa-wifi"></i></div>
        <div class="af-text">Cheapest data for MTN, Airtel, GLO &amp; 9mobile</div>
      </div>
      <div class="auth-feature">
        <div class="af-dot"><i class="fa fa-tv"></i></div>
        <div class="af-text">Pay DSTV, GOTV, Startimes instantly</div>
      </div>
      <div class="auth-feature">
        <div class="af-dot"><i class="fa fa-bolt"></i></div>
        <div class="af-text">Electricity bills — PHED, PHCN, AEDC &amp; more</div>
      </div>
      <div class="auth-feature">
        <div class="af-dot"><i class="fa fa-coins"></i></div>
        <div class="af-text">Earn commissions as a data reseller</div>
      </div>
    </div>
  </div>

  <!-- Right Form Panel -->
  <div class="auth-right">
    <div class="auth-card">
      <h3>Sign In</h3>
      <p class="sub">Enter your credentials to access your account</p>

      <?php foreach ($SITE_ERRORS as $error): ?>
        <div class="alert-dark"><i class="fa fa-circle-exclamation"></i> <?= is_array($error) ? implode(', ', $error) : $error ?></div>
      <?php endforeach ?>
      <?php foreach ($SITE_SUCCESS as $good): ?>
        <div class="alert-success-dark"><i class="fa fa-circle-check"></i> <?= $good ?></div>
      <?php endforeach ?>

      <form method="POST" action="">
        <label class="form-lbl">Email Address</label>
        <div class="input-wrap">
          <i class="fa fa-envelope field-ico"></i>
          <input type="email" name="email" required placeholder="you@example.com" class="form-control field-input"
            value="<?php if (isset($_COOKIE['member_login'])) echo htmlspecialchars($_COOKIE['member_login']); ?>"/>
        </div>

        <label class="form-lbl">Password</label>
        <div class="input-wrap">
          <i class="fa fa-lock field-ico"></i>
          <input type="password" name="password" id="pwdField" required placeholder="Your password" class="form-control field-input"
            value="<?php if (isset($_COOKIE['member_password'])) echo htmlspecialchars($_COOKIE['member_password']); ?>"/>
          <button type="button" class="eye-btn" onclick="togglePwd()"><i class="fa fa-eye" id="eyeIcon"></i></button>
        </div>

        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px">
          <label class="custom-check">
            <input type="checkbox" name="remember" <?php if(isset($_COOKIE['member_login'])) echo 'checked'; ?>>
            <label>Remember Me</label>
          </label>
          <a href="forgot-password" class="link-green"><i class="fa fa-key" style="margin-right:4px"></i>Forgot Password?</a>
        </div>

        <button type="submit" name="login" class="btn-login">
          <i class="fa fa-sign-in-alt"></i> Sign Me In
        </button>
      </form>

      <div class="divider-or">or</div>
      <div class="reg-link">
        Don't have an account? <a href="register" class="link-green">Create one free</a>
      </div>
    </div>
  </div>
</div>

<script src="./vendor/global/global.min.js"></script>
<script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="./js/custom.min.js"></script>
<script src="./vendor/toastr/js/toastr.min.js"></script>
<script src="./js/plugins-init/toastr-init.js"></script>
<script>
function togglePwd(){var f=document.getElementById('pwdField'),i=document.getElementById('eyeIcon');if(f.type==='password'){f.type='text';i.className='fa fa-eye-slash'}else{f.type='password';i.className='fa fa-eye'}}
</script>
<?php foreach ($SITE_ERRORS as $e): ?><script>toastr.error("<?= addslashes(strip_tags(is_array($e)?implode(', ',$e):$e)) ?>","Login Failed",{positionClass:"toast-top-right",timeOut:5e3,closeButton:true,progressBar:true})</script><?php endforeach ?>
<?php foreach ($SITE_SUCCESS as $s): ?><script>toastr.success("<?= addslashes(strip_tags($s)) ?>","",{positionClass:"toast-top-right",timeOut:5e3,closeButton:true,progressBar:true})</script><?php endforeach ?>
</body>
</html>
