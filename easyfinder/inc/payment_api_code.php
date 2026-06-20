<?php
if(isset($_POST['pay_now'])){
$_SESSION['Payment_Email'] = htmlspecialchars(trim($_POST['user_email']));
$_SESSION['Payment_Amount'] = htmlspecialchars(trim(intval($_POST['amount'] + $_POST['charges'])));
$_SESSION['RefPin'] = strip_tags(trim($_POST['Trans_id']));
if(!$WalletController->Check_If_My_Payment_Transaction_Id_Exist($_SESSION['RefPin'],'payment_history_tbl')){
if($WalletController->Store_My_Wallet_Transaction($_SESSION['RefPin'] ,$_POST['amount'],$_POST['user_email'])){
  if($WalletController->Save_Add_Wallet_Money_Trans_Status($_SESSION['RefPin'] ,$_POST['amount'],$_POST['user_email'],'credit')){
  $callback_url = SITE_URL."easyfinder/dashboard/credit-wallet";
  $url = "https://api.paystack.co/transaction/initialize";
  $fields = [
    'email' => $_SESSION['Payment_Email'],
    'amount' => ($_SESSION['Payment_Amount']) * 100,
    'first_name' => $_SESSION['Payment_Email'],
    'reference' => $_SESSION['RefPin'],
    'callback_url'=> $callback_url,
    //SITE_CURRENCY_CODE
  ];
  $fields_string = http_build_query($fields);
  //open connection
  $ch = curl_init();
  

  //set the url, number of POST vars, POST data
  curl_setopt($ch,CURLOPT_URL, $url);
  curl_setopt($ch,CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, CURL_SSL_VERIFY);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer ".PAYSTACK_API,
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
if(isset($result['data'])){
  // there was an error from the API
 $data = $result['data'];
//echo $data['authorization_url']."<br>";
//echo $data['access_code']."<br>";
//$data['reference']
$site_settings->redirect($data['authorization_url']);

}
}
}
}
}
}


