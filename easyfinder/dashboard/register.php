<?php
require_once '../inc/config.inc.php';
if(!$UserAuth->is_user_logged_in()){
if(isset($_POST['signup'])){

$rules = [
    'email' => ['required','email'],
    'password' => ['required','equals(:cpassword)'],
    'cpassword' => ['required'],
    'sname' => ['required'],
    'oname' => ['required'],
    'phone' => ['required','numeric'],
    'pin' => ['required','numeric'],
    'state' => ['required']
];

$validation_result = SimpleValidator\Validator::validate($_POST, $rules);
if ($validation_result->isSuccess()) {
if($UserAuth->Apply($_POST)){
 $UserAuth->redirect('./');
}else{
array_push($SITE_ERRORS, 'This email has been registered');
}
} else {
array_push($SITE_ERRORS, $validation_result->getErrors());
}

}
}else{
  $UserAuth->redirect('./');
}

$PAGE_TITLE   = 'Register Now';
$URL_NAME     = 'register';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= $PAGE_TITLE." | ".SITE_TITLE ?></title>
  <link rel="icon" type="image/png" sizes="16x16" href="images/<?=SITE_LOGO?>">
  <link href="./css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="./vendor/toastr/css/toastr.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    *{box-sizing:border-box}
    body{font-family:'Inter',sans-serif!important;background:#f0f4f8!important;margin:0;padding:0;min-height:100vh}
    .auth-wrapper{min-height:100vh;display:flex;align-items:stretch}
    .auth-left{flex:0 0 40%;background:linear-gradient(145deg,#0d1b2a 0%,#3061ad 60%,#2696da 100%);display:flex;flex-direction:column;align-items:center;justify-content:center;padding:48px 36px;position:relative;overflow:hidden}
    .auth-left::before{content:'';position:absolute;top:-80px;right:-80px;width:300px;height:300px;background:radial-gradient(circle,rgba(255,255,255,.06),transparent 70%);border-radius:50%}
    .auth-left::after{content:'';position:absolute;bottom:-60px;left:-60px;width:250px;height:250px;background:radial-gradient(circle,rgba(16,213,150,.1),transparent 70%);border-radius:50%}
    .auth-left-inner{position:relative;z-index:1;text-align:center;width:100%}
    .auth-left .logo-wrap img{height:70px;border-radius:0 18px 0;border:2px solid rgba(255,255,255,.25);margin-bottom:28px}
    .auth-left h2{color:#fff;font-size:1.8rem;font-weight:800;line-height:1.2;margin-bottom:10px}
    .auth-left p{color:rgba(255,255,255,.7);font-size:.93rem;line-height:1.7;margin-bottom:24px}
    .step-list{display:flex;flex-direction:column;gap:12px;text-align:left}
    .step-item{display:flex;align-items:flex-start;gap:12px;color:rgba(255,255,255,.85);font-size:.88rem}
    .step-num{width:28px;height:28px;background:rgba(16,213,150,.25);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#10d596;font-size:.8rem;font-weight:700;flex-shrink:0}
    .auth-right{flex:1;display:flex;align-items:center;justify-content:center;padding:32px 24px;background:#f0f4f8;overflow-y:auto}
    .auth-card{background:#fff;border-radius:20px;padding:36px 32px;width:100%;max-width:520px;box-shadow:0 8px 40px rgba(48,97,173,.1)}
    .auth-card h4{font-size:1.5rem;font-weight:800;color:#1a2744;margin-bottom:4px}
    .auth-desc{color:#888;font-size:.88rem;margin-bottom:24px}
    .form-label-modern{font-size:.8rem;font-weight:600;color:#555;letter-spacing:.03em;text-transform:uppercase;margin-bottom:5px;display:block}
    .input-icon-wrap{position:relative}
    .input-icon-wrap .field-icon{position:absolute;left:13px;top:50%;transform:translateY(-50%);color:#aaa;font-size:.85rem;z-index:2}
    .input-icon-wrap .input-modern{padding-left:38px!important;height:46px;border-radius:10px!important;border:1.5px solid #e0e6ef!important;font-size:.9rem;transition:border .2s,box-shadow .2s;width:100%}
    .input-icon-wrap .input-modern:focus{border-color:#3061ad!important;box-shadow:0 0 0 3px rgba(48,97,173,.1)!important;outline:none}
    .eye-toggle{position:absolute;right:12px;top:50%;transform:translateY(-50%);color:#aaa;cursor:pointer;font-size:.88rem;z-index:2;background:none;border:none;padding:0}
    .eye-toggle:hover{color:#3061ad}
    .btn-register{width:100%;height:50px;background:linear-gradient(135deg,#3061ad,#2696da);color:#fff;border:none;border-radius:10px;font-size:1rem;font-weight:700;cursor:pointer;transition:all .25s;display:flex;align-items:center;justify-content:center;gap:10px}
    .btn-register:hover{background:linear-gradient(135deg,#2552a0,#1e84c8);box-shadow:0 8px 20px rgba(48,97,173,.35);transform:translateY(-1px)}
    .link-accent{color:#10d596!important;font-weight:600}
    .link-accent:hover{color:#0dc487!important}
    .optional-badge{color:#10d596;font-size:.78rem;font-weight:600;margin-left:6px;background:rgba(16,213,150,.1);padding:2px 8px;border-radius:4px}
    .section-divider{color:#bbb;font-size:.78rem;font-weight:600;text-transform:uppercase;letter-spacing:.08em;margin:20px 0 14px;display:flex;align-items:center;gap:10px}
    .section-divider::before,.section-divider::after{content:'';flex:1;height:1px;background:#e8edf5}
    @media(max-width:768px){.auth-left{display:none}.auth-right{padding:20px 14px}}
  </style>
</head>
<body>
<div class="auth-wrapper">
  <!-- Left Panel -->
  <div class="auth-left">
    <div class="auth-left-inner">
      <div class="logo-wrap"><img src="./images/<?=SITE_LOGO?>" alt="<?= SITE_TITLE ?>" /></div>
      <h2>Join Bikyensub</h2>
      <p>Start buying cheap data, airtime &amp; paying bills while earning commissions as a reseller.</p>
      <div class="step-list">
        <div class="step-item"><div class="step-num">1</div><span>Fill in your personal details below</span></div>
        <div class="step-item"><div class="step-num">2</div><span>Create a secure password &amp; transaction PIN</span></div>
        <div class="step-item"><div class="step-num">3</div><span>Fund your wallet and start buying instantly</span></div>
        <div class="step-item"><div class="step-num">4</div><span>Earn commissions on every transaction</span></div>
      </div>
    </div>
  </div>
  <!-- Right Panel -->
  <div class="auth-right">
    <div class="auth-card">
      <h4>Create Account</h4>
      <p class="auth-desc">Fill in your details to get started — it's free!</p>

      <div id="response_status">
        <?php if (count($SITE_ERRORS) > 0): ?>
          <?php foreach ($SITE_ERRORS as $error): ?>
            <div class="alert alert-danger d-flex align-items-center mb-3" style="border-radius:10px;font-size:.87rem;gap:8px">
              <i class="fa fa-circle-exclamation"></i> <?= $error ?>
            </div>
          <?php endforeach ?>
        <?php endif ?>
        <?php if (count($SITE_SUCCESS) > 0): ?>
          <?php foreach ($SITE_SUCCESS as $good): ?>
            <div class="alert alert-success d-flex align-items-center mb-3" style="border-radius:10px;font-size:.87rem;gap:8px">
              <i class="fa fa-circle-check"></i> <?= $good ?>
            </div>
          <?php endforeach ?>
        <?php endif ?>
      </div>

      <form action="" method="POST" class="form-valide-with-icon">

        <div class="section-divider">Personal Information</div>

        <div class="row">
          <div class="col-md-6 form-group mb-3">
            <label class="form-label-modern">Surname</label>
            <div class="input-icon-wrap">
              <i class="fa fa-user field-icon"></i>
              <input type="text" name="sname" required class="form-control input-modern" placeholder="Your surname">
            </div>
          </div>
          <div class="col-md-6 form-group mb-3">
            <label class="form-label-modern">Other Names</label>
            <div class="input-icon-wrap">
              <i class="fa fa-user field-icon"></i>
              <input type="text" name="oname" required class="form-control input-modern" placeholder="Other names">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 form-group mb-3">
            <label class="form-label-modern">State of Origin</label>
            <div class="input-icon-wrap">
              <i class="fa fa-map-marker-alt field-icon"></i>
              <input type="text" name="state" required class="form-control input-modern" placeholder="e.g. Lagos">
            </div>
          </div>
          <div class="col-md-6 form-group mb-3">
            <label class="form-label-modern">Phone Number</label>
            <div class="input-icon-wrap">
              <i class="fa fa-phone field-icon"></i>
              <input type="tel" name="phone" required class="form-control input-modern" placeholder="08012345678">
            </div>
          </div>
        </div>

        <div class="form-group mb-3">
          <label class="form-label-modern">Email Address</label>
          <div class="input-icon-wrap">
            <i class="fa fa-envelope field-icon"></i>
            <input type="email" name="email" required class="form-control input-modern" placeholder="you@example.com">
          </div>
        </div>

        <div class="section-divider">Security</div>

        <div class="row">
          <div class="col-md-6 form-group mb-3">
            <label class="form-label-modern">Password</label>
            <div class="input-icon-wrap">
              <i class="fa fa-lock field-icon"></i>
              <input type="password" name="password" id="regPassword" required class="form-control input-modern" placeholder="Create password">
              <button type="button" class="eye-toggle" onclick="togglePwd('regPassword',this)"><i class="fa fa-eye"></i></button>
            </div>
          </div>
          <div class="col-md-6 form-group mb-3">
            <label class="form-label-modern">Confirm Password</label>
            <div class="input-icon-wrap">
              <i class="fa fa-lock field-icon"></i>
              <input type="password" name="cpassword" id="regCPassword" required class="form-control input-modern" placeholder="Confirm password">
              <button type="button" class="eye-toggle" onclick="togglePwd('regCPassword',this)"><i class="fa fa-eye"></i></button>
            </div>
          </div>
        </div>

        <div class="form-group mb-3">
          <label class="form-label-modern">Transaction / Pass PIN <span style="color:#888;font-weight:400">(4 digits)</span></label>
          <div class="input-icon-wrap">
            <i class="fa fa-key field-icon"></i>
            <input type="password" name="pin" required class="form-control input-modern" minlength="4" maxlength="4" placeholder="4-digit PIN" inputmode="numeric">
          </div>
        </div>

        <div class="form-group mb-4">
          <label class="form-label-modern">Referral Token <span class="optional-badge">Optional</span></label>
          <div class="input-icon-wrap">
            <i class="fa fa-tag field-icon"></i>
            <input type="text" name="referal" readonly class="form-control input-modern" placeholder="Referral code (if any)"
              <?php if(isset($_GET['join_with_referal'])){?> value="<?= $_GET['join_with_referal'] ?>" <?php } ?>>
          </div>
        </div>

        <button name="signup" type="submit" value="Submit" class="btn-register">
          <i class="fa fa-user-plus"></i> Create My Account
        </button>
      </form>

      <p class="text-center mt-3" style="font-size:.9rem;color:#888">
        Already have an account? <a href="login" class="link-accent">Sign in</a>
      </p>
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
function togglePwd(id,btn){var f=document.getElementById(id);var i=btn.querySelector('i');if(f.type==='password'){f.type='text';i.className='fa fa-eye-slash'}else{f.type='password';i.className='fa fa-eye'}}
</script>
<?php if (count($SITE_ERRORS) > 0): ?>
  <?php foreach ($SITE_ERRORS as $error): ?>
    <script>toastr.error("<?= strip_tags($error) ?>","Registration Error!",{positionClass:"toast-top-right",timeOut:5e3,closeButton:!0,progressBar:!0,newestOnTop:!0})</script>
  <?php endforeach ?>
<?php endif ?>
<?php if (count($SITE_SUCCESS) > 0): ?>
  <?php foreach ($SITE_SUCCESS as $good): ?>
    <script>toastr.success("<?= strip_tags($good) ?>","Success!",{positionClass:"toast-top-right",timeOut:5e3,closeButton:!0,progressBar:!0,newestOnTop:!0})</script>
  <?php endforeach ?>
<?php endif ?>
</body>
</html>
