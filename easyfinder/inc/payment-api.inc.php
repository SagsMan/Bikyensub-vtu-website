<?php
require_once("../admin/inc/login_session.inc.php"); 
require_once("../../inc/config_exixting_admin_purchase.inc.php"); 



if(isset($_POST['make_school_management_feature_payment'])){
$_SESSION['update_features'] = $_POST['features_name'];
for($i=0; $i < count($_POST['features']); $i++){
if(EduTech\Controller\ActivityProductController::Insert_User_Ordered_Product(1,$_POST['features'][$i],$_POST['trans_id'],$_POST['subs_id'][$i],$_POST['expired_date'][$i],SCHOOL_ID) ){
  $d_school_settings->redirect('school-management-feature-confirm');
}

}


/*

if($Payment_Class->makePayment($_POST, $RefPin,$Login_std_add_no,$Login_std_class_id,SITE_CURERENT_SESSION)){

  


  $url = "https://api.paystack.co/transaction/initialize";
  $fields = [
    'email' => $Login_std_email,
    'amount' => ($_SESSION['Payment_Amount'] + 100) * 100,
    'first_name' => $Login_std_full_name,
    'reference' => $RefPin
    //SITE_CURRENCY_CODE
  ];
  $fields_string = http_build_query($fields);
  //open connection
  $ch = curl_init();
  

  //set the url, number of POST vars, POST data
  curl_setopt($ch,CURLOPT_URL, $url);
  curl_setopt($ch,CURLOPT_POST, true);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer ".SITE_PAYMENT_API,
    "Cache-Control: no-cache",
  ));
  
  //So that curl_exec returns the contents of the cURL; rather than echoing it
  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
  //execute post
 $response = curl_exec($ch);
$err = curl_error($ch);
if($err){
  // there was an error contacting the Paystack API
  die('Curl returned error: ' . $err);
}else{
$result = json_decode($response, true);
//print_r($result);
if($result['data']){
  // there was an error from the API
 $data = $result['data'];
//echo $data['authorization_url']."<br>";
//echo $data['access_code']."<br>";
//$data['reference']
$d_school_settings->redirect('school-management-feature-confirm');

}
}
}


*/

}


