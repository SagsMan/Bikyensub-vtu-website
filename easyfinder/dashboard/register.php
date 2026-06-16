<?php
require_once '../inc/config.inc.php';
if (!$UserAuth->is_user_logged_in()) {
    if (isset($_POST['signup'])) {
        $rules = [
            'email'    => ['required','email'],
            'password' => ['required','equals(:cpassword)'],
            'cpassword'=> ['required'],
            'sname'    => ['required'],
            'oname'    => ['required'],
            'phone'    => ['required','numeric'],
            'pin'      => ['required','numeric'],
            'state'    => ['required']
        ];
        $validation_result = SimpleValidator\Validator::validate($_POST, $rules);
        if ($validation_result->isSuccess()) {
            if ($UserAuth->Apply($_POST)) {
                $UserAuth->redirect('./');
            } else {
                array_push($SITE_ERRORS, 'This email has already been registered');
            }
        } else {
            array_push($SITE_ERRORS, $validation_result->getErrors());
        }
    }
} else {
    $UserAuth->redirect('./');
}
$PAGE_TITLE = 'Register';
$URL_NAME   = 'register';
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
  <link rel="stylesheet" href="./vendor/jquery-validation/jquery.validate.min.js" as="script"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
  <style>
    :root{--green:#10d596;--blue:#2696da;--blue2:#3061ad;--dark:#060C1A;--card:#0D1B2E}
    *{box-sizing:border-box;margin:0;padding:0}
    body{font-family:'Inter',sans-serif!important;background:var(--dark)!important;min-height:100vh;display:flex;align-items:stretch}
    .auth-wrap{min-height:100vh;width:100%;display:flex;align-items:stretch}
    .auth-left{flex:0 0 38%;background:linear-gradient(145deg,#050c1a 0%,#0a1a3a 55%,#0d2451 100%);display:flex;flex-direction:column;align-items:center;justify-content:center;padding:52px 40px;position:relative;overflow:hidden}
    .auth-left::before{content:'';position:absolute;top:-80px;right:-80px;width:300px;height:300px;background:radial-gradient(circle,rgba(16,213,150,.12),transparent 70%);border-radius:50%}
    .auth-left::after{content:'';position:absolute;bottom:-60px;left:-60px;width:240px;height:240px;background:radial-gradient(circle,rgba(38,150,218,.1),transparent 70%);border-radius:50%}
    .auth-left-inner{position:relative;z-index:1;text-align:center;width:100%}
    .auth-logo{height:68px;border-radius:0 18px 0;border:2px solid rgba(16,213,150,.4);margin-bottom:24px;max-width:190px}
    .auth-left h2{color:#fff;font-size:1.7rem;font-weight:900;line-height:1.2;margin-bottom:8px}
    .auth-left p{color:rgba(255,255,255,.55);font-size:.88rem;line-height:1.75;margin-bottom:24px}
    .step-item{display:flex;align-items:flex-start;gap:10px;margin-bottom:14px;text-align:left}
    .step-num{width:28px;height:28px;background:rgba(16,213,150,.2);border:1px solid rgba(16,213,150,.35);border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--green);font-size:.8rem;font-weight:800;flex-shrink:0}
    .step-text{color:rgba(255,255,255,.7);font-size:.85rem;line-height:1.5}
    .tag{display:inline-flex;align-items:center;gap:5px;background:rgba(16,213,150,.1);border:1px solid rgba(16,213,150,.3);color:var(--green);padding:4px 12px;border-radius:50px;font-size:.72rem;font-weight:600;text-transform:uppercase;letter-spacing:.05em;margin-bottom:18px}
    .auth-right{flex:1;display:flex;align-items:center;justify-content:center;padding:32px 24px;background:linear-gradient(135deg,#07101e,#0a1628);overflow-y:auto}
    .auth-card{width:100%;max-width:500px}
    .auth-card h3{color:#fff;font-size:1.45rem;font-weight:900;margin-bottom:3px}
    .auth-card .sub{color:rgba(255,255,255,.4);font-size:.87rem;margin-bottom:24px}
    .alert-dark{background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.3);border-radius:10px;padding:11px 14px;font-size:.84rem;color:#fca5a5;display:flex;align-items:center;gap:7px;margin-bottom:18px}
    .form-row{display:grid;grid-template-columns:1fr 1fr;gap:14px}
    .form-lbl{font-size:.75rem;font-weight:600;color:rgba(255,255,255,.5);letter-spacing:.04em;text-transform:uppercase;display:block;margin-bottom:6px}
    .input-wrap{position:relative;margin-bottom:16px}
    .field-ico{position:absolute;left:13px;top:50%;transform:translateY(-50%);color:rgba(255,255,255,.3);font-size:.85rem;z-index:2}
    .field-input{width:100%;height:47px;background:rgba(255,255,255,.05)!important;border:1.5px solid rgba(255,255,255,.1)!important;border-radius:11px!important;color:#fff!important;font-size:.9rem!important;padding-left:40px!important;padding-right:12px!important;transition:border .2s,box-shadow .2s;font-family:'Inter',sans-serif!important}
    .field-input::placeholder{color:rgba(255,255,255,.2)!important}
    .field-input:focus{border-color:var(--green)!important;box-shadow:0 0 0 3px rgba(16,213,150,.1)!important;outline:none!important;background:rgba(16,213,150,.03)!important}
    .eye-btn{position:absolute;right:12px;top:50%;transform:translateY(-50%);color:rgba(255,255,255,.3);cursor:pointer;font-size:.85rem;background:none;border:none;padding:0;z-index:2;transition:color .2s}
    .eye-btn:hover{color:var(--green)}
    .sec-divider{color:rgba(255,255,255,.25);font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;display:flex;align-items:center;gap:10px;margin:18px 0 14px}
    .sec-divider::before,.sec-divider::after{content:'';flex:1;height:1px;background:rgba(255,255,255,.07)}
    .opt-badge{color:var(--green);font-size:.72rem;font-weight:600;background:rgba(16,213,150,.1);padding:2px 8px;border-radius:4px;margin-left:6px}
    .btn-reg{width:100%;height:50px;background:linear-gradient(135deg,var(--green),#059669);color:#fff;border:none;border-radius:12px;font-size:.97rem;font-weight:700;cursor:pointer;transition:all .3s;display:flex;align-items:center;justify-content:center;gap:9px;font-family:'Inter',sans-serif;box-shadow:0 6px 20px rgba(16,213,150,.3)}
    .btn-reg:hover{transform:translateY(-1px);box-shadow:0 10px 28px rgba(16,213,150,.5)}
    .login-link{text-align:center;margin-top:16px;font-size:.88rem;color:rgba(255,255,255,.4)}
    .link-green{color:var(--green);text-decoration:none;font-weight:600}
    .link-green:hover{color:#0dc487}
    @media(max-width:768px){.auth-left{display:none}.auth-right{padding:20px 14px}.form-row{grid-template-columns:1fr}}
  </style>
</head>
<body>
<div class="auth-wrap">
  <!-- Left Brand Panel -->
  <div class="auth-left">
    <div class="auth-left-inner">
      <img src="./images/<?= SITE_LOGO ?>" class="auth-logo" alt="<?= SITE_TITLE ?>"
        onerror="this.outerHTML='<span style=&quot;color:var(--green);font-size:1.4rem;font-weight:900;display:block;margin-bottom:20px&quot;><?= SITE_TITLE ?></span>'"/>
      <div class="tag">🚀 Free Account</div>
      <h2>Join Bikyensub</h2>
      <p>Start buying cheap data, paying bills, and earning commissions as a reseller.</p>
      <div class="step-item"><div class="step-num">1</div><div class="step-text">Fill in your personal details below</div></div>
      <div class="step-item"><div class="step-num">2</div><div class="step-text">Create a secure password &amp; 4-digit PIN</div></div>
      <div class="step-item"><div class="step-num">3</div><div class="step-text">Fund your wallet and start buying instantly</div></div>
      <div class="step-item"><div class="step-num">4</div><div class="step-text">Earn commissions on every transaction daily</div></div>
    </div>
  </div>

  <!-- Right Form Panel -->
  <div class="auth-right">
    <div class="auth-card">
      <h3>Create Account</h3>
      <p class="sub">Fill in your details to get started — it's completely free!</p>

      <?php foreach ($SITE_ERRORS as $error): ?>
        <div class="alert-dark"><i class="fa fa-circle-exclamation"></i> <?= is_array($error) ? implode(', ', $error) : $error ?></div>
      <?php endforeach ?>
      <?php foreach ($SITE_SUCCESS as $good): ?>
        <div class="alert-dark" style="background:rgba(16,213,150,.1);border-color:rgba(16,213,150,.3);color:#6ee7b7"><i class="fa fa-circle-check"></i> <?= $good ?></div>
      <?php endforeach ?>

      <form action="" method="POST" class="form-valide-with-icon">

        <div class="sec-divider">Personal Information</div>
        <div class="form-row">
          <div>
            <label class="form-lbl">Surname</label>
            <div class="input-wrap">
              <i class="fa fa-user field-ico"></i>
              <input type="text" name="sname" required placeholder="Your surname" class="form-control field-input"/>
            </div>
          </div>
          <div>
            <label class="form-lbl">Other Names</label>
            <div class="input-wrap">
              <i class="fa fa-user field-ico"></i>
              <input type="text" name="oname" required placeholder="Other names" class="form-control field-input"/>
            </div>
          </div>
        </div>

        <div class="form-row">
          <div>
            <label class="form-lbl">State of Origin</label>
            <div class="input-wrap">
              <i class="fa fa-map-marker-alt field-ico"></i>
              <input type="text" name="state" required placeholder="e.g. Lagos" class="form-control field-input"/>
            </div>
          </div>
          <div>
            <label class="form-lbl">Phone Number</label>
            <div class="input-wrap">
              <i class="fa fa-phone field-ico"></i>
              <input type="tel" name="phone" required placeholder="08012345678" class="form-control field-input"/>
            </div>
          </div>
        </div>

        <label class="form-lbl">Email Address</label>
        <div class="input-wrap">
          <i class="fa fa-envelope field-ico"></i>
          <input type="email" name="email" required placeholder="you@example.com" class="form-control field-input"/>
        </div>

        <div class="sec-divider">Security</div>
        <div class="form-row">
          <div>
            <label class="form-lbl">Password</label>
            <div class="input-wrap">
              <i class="fa fa-lock field-ico"></i>
              <input type="password" name="password" id="pwd1" required placeholder="Create password" class="form-control field-input"/>
              <button type="button" class="eye-btn" onclick="togglePwd('pwd1','eye1')"><i class="fa fa-eye" id="eye1"></i></button>
            </div>
          </div>
          <div>
            <label class="form-lbl">Confirm Password</label>
            <div class="input-wrap">
              <i class="fa fa-lock field-ico"></i>
              <input type="password" name="cpassword" id="pwd2" required placeholder="Repeat password" class="form-control field-input"/>
              <button type="button" class="eye-btn" onclick="togglePwd('pwd2','eye2')"><i class="fa fa-eye" id="eye2"></i></button>
            </div>
          </div>
        </div>

        <label class="form-lbl">Transaction PIN <span style="color:rgba(255,255,255,.3);font-size:.72rem;font-weight:400">(4 digits)</span></label>
        <div class="input-wrap">
          <i class="fa fa-key field-ico"></i>
          <input type="password" name="pin" required placeholder="4-digit PIN" minlength="4" maxlength="4" inputmode="numeric" class="form-control field-input"/>
        </div>

        <label class="form-lbl">Referral Code <span class="opt-badge">Optional</span></label>
        <div class="input-wrap">
          <i class="fa fa-tag field-ico"></i>
          <input type="text" name="referal" placeholder="Referral code (if any)" class="form-control field-input" readonly
            <?php if (isset($_GET['join_with_referal'])) echo 'value="'.htmlspecialchars($_GET['join_with_referal']).'"'; ?>/>
        </div>

        <button type="submit" name="signup" value="Submit" class="btn-reg">
          <i class="fa fa-user-plus"></i> Create My Account
        </button>
      </form>

      <div class="login-link">Already have an account? <a href="login" class="link-green">Sign in here</a></div>
    </div>
  </div>
</div>

<script src="./vendor/global/global.min.js"></script>
<script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="./js/custom.min.js"></script>
<script src="./js/deznav-init.js"></script>
<script src="./vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="./js/plugins-init/jquery.validate-init.js"></script>
<script src="./vendor/toastr/js/toastr.min.js"></script>
<script src="./js/plugins-init/toastr-init.js"></script>
<script>
function togglePwd(id,eyeId){var f=document.getElementById(id),i=document.getElementById(eyeId);if(f.type==='password'){f.type='text';i.className='fa fa-eye-slash'}else{f.type='password';i.className='fa fa-eye'}}
</script>
<?php foreach ($SITE_ERRORS as $e): ?><script>toastr.error("<?= addslashes(strip_tags(is_array($e)?implode(', ',$e):$e)) ?>","Registration Error",{positionClass:"toast-top-right",timeOut:5e3,closeButton:true,progressBar:true})</script><?php endforeach ?>
<?php foreach ($SITE_SUCCESS as $s): ?><script>toastr.success("<?= addslashes(strip_tags($s)) ?>","",{positionClass:"toast-top-right",timeOut:5e3,closeButton:true,progressBar:true})</script><?php endforeach ?>
</body>
</html>
