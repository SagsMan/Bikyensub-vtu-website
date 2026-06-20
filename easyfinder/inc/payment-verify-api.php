<?php
$curl = curl_init();
$reference = isset($_GET['reference']) ? $_GET['reference'] : '';
if(!$reference){
   array_push($SITE_ERRORS, 'No reference supplied');
}

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => [
    "accept: application/json",
    "authorization: Bearer ".PAYSTACK_API,
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
    // there was an error contacting the Paystack API
  array_push($SITE_ERRORS, 'Curl returned error: ' . $err);
}else{

$tranx = json_decode($response);


if($tranx->status){

if($tranx->data->status == 'success'){

if(!$row = $WalletController->Get_Pending_Trans_Id($_GET['reference'])){

array_push($SITE_SUCCESS, "Your Payment Already Confirm!");

}else{

if($WalletController->Update_Successful_Transaction($tranx->data->status,$_GET['reference'])){
 if($WalletController->Update_Successful_Wallet_Money_Trans_Status($_GET['reference'],$Auth->email)){
if($WalletController->Credit_My_Wallet($row->amount,$Auth->email)){

 array_push($SITE_SUCCESS, "Payment is Successful !"); 
}

}
}
}



}else{


if(EduTech\Controller\ActivityProductController::validate_failed_payment($_GET['reference'],$tranx->data->status)){
array_push($SITE_ERRORS, 'Your payment was not successful. Reason: '.$tranx->data->status);
 }
  
}
}else{
$GetSiteRepsonseStatus = $site_settings-> GetSiteRepsonseStatus(['Invalide reference ID supplied']);
}


}
