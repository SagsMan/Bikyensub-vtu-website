<?php 

include_once ('ini_custom.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log received data
file_put_contents('1', print_r($_POST, true));

// Assuming you have a database connection established already
session_start();

include_once "ini.php";
include_once "ini_custom.php";
include_once "functions.php";
include_once "functions_custom.php";
include_once "functions_customui.php";


$pdo = getMySQLPDOLink_(false,false);



function verifyy(){
                
            $reference_paystack= json_decode($requestData['privileges'],true);
            //$reference_paystack= $reference_paystack['reference'];
            $reference_paystack= $reference_paystack['transaction'];

            file_put_contents('2', $reference_paystack);

            //verify
            /*
            {

              "status": true,

              "message": "Verification successful",

              "data": {

                "id": 690075529,

                "domain": "test",

                "status": "success",

                "reference": "nms6uvr1pl",

                "amount": 20000,

                "message": null,

                "gateway_response": "Successful",

                "paid_at": "2020-05-19T12:30:56.000Z",

                "created_at": "2020-05-19T12:26:44.000Z",

                "channel": "card",

                "currency": "NGN",

                "ip_address": "154.118.28.239",

                "metadata": "",

                "log": {

                  "start_time": 1589891451,

                  "time_spent": 6,

                  "attempts": 1,

                  "errors": 0,

                  "success": true,

                  "mobile": false,

                  "input": [],

                  "history": [

                    {

                      "type": "action",

                      "message": "Attempted to pay with card",

                      "time": 5

                    },

                    {

                      "type": "success",

                      "message": "Successfully paid with card",

                      "time": 6

                    }

                  ]

                },

                "fees": 300,

                "fees_split": {

                  "paystack": 300,

                  "integration": 40,

                  "subaccount": 19660,

                  "params": {

                    "bearer": "account",

                    "transaction_charge": "",

                    "percentage_charge": "0.2"

                  }

                },

                "authorization": {

                  "authorization_code": "AUTH_xxxxxxxxxx",

                  "bin": "408408",

                  "last4": "4081",

                  "exp_month": "12",

                  "exp_year": "2020",

                  "channel": "card",

                  "card_type": "visa DEBIT",

                  "bank": "Test Bank",

                  "country_code": "NG",

                  "brand": "visa",

                  "reusable": true,

                  "signature": "SIG_xxxxxxxxxxxxxxx",

                  "account_name": null

                },

                "customer": {

                  "id": 24259516,

                  "first_name": null,

                  "last_name": null,

                  "email": "customer@email.com",

                  "customer_code": "CUS_xxxxxxxxxxx",

                  "phone": null,

                  "metadata": null,

                  "risk_action": "default"

                },

                "plan": null,

                "order_id": null,

                "paidAt": "2020-05-19T12:30:56.000Z",

                "createdAt": "2020-05-19T12:26:44.000Z",

                "requested_amount": 20000,

                "transaction_date": "2020-05-19T12:26:44.000Z",

                "plan_object": {},

                "subaccount": {

                  "id": 37614,

                  "subaccount_code": "ACCT_xxxxxxxxxx",

                  "business_name": "Cheese Sticks",

                  "description": "Cheese Sticks",

                  "primary_contact_name": null,

                  "primary_contact_email": null,

                  "primary_contact_phone": null,

                  "metadata": null,

                  "percentage_charge": 0.2,

                  "settlement_bank": "Guaranty Trust Bank",

                  "account_number": "0123456789"

                }

              }

            }
            */

              $curl = curl_init();  
            //CURLOPT_URL => "https://api.paystack.co/transaction/verify/:reference",
              curl_setopt_array($curl, array(

                CURLOPT_URL => "https://api.paystack.co/transaction/verify/:".$reference_paystack,

                CURLOPT_RETURNTRANSFER => true,

                CURLOPT_ENCODING => "",

                CURLOPT_MAXREDIRS => 10,

                CURLOPT_TIMEOUT => 30,

                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

                CURLOPT_CUSTOMREQUEST => "GET",

                CURLOPT_HTTPHEADER => array(

                  "Authorization: Bearer ".APP_PAYSTACK_PK,

                  "Cache-Control: no-cache",

                ),

              ));

              

              $response = curl_exec($curl);

              $err = curl_error($curl);


              curl_close($curl);

              

              if ($err) {

                //echo "cURL Error #:" . $err;

              } else {

                //echo $response;
                
                /*file_put_contents('1-paystaclverify', $response);
                $response_ = json_decode($response);
                $payment_method = $response_->channel;
                $donationDate = $response_->paid_at;*/
              }




}

// Get the raw POST data
$data = file_get_contents("php://input");

// Decode the JSON data into a PHP array
$requestData = json_decode($data, true);

file_put_contents('2', $requestData);

// Validate and sanitize the received data as needed
$id = intval($requestData['id']); // Assuming 'id' is an integer
$donationDate = sanitizeString_($requestData['donation_date']); // Sanitize using mysqli_real_escape_string
$campaign_id = intval($requestData['campaign_id']); 
$donation_amount = $requestData['donation_amount']; 
$payment_method = sanitizeString_($requestData['payment_method']); 
$createdBy = sanitizeString_($requestData['createdBy']); 
$createdOn = sanitizeString_( $requestData['createdOn']); 
$ownerId = intval($requestData['ownerId']); 
$userId = intval($requestData['userId']); 
$guid = sanitizeString_( $requestData['guid']); //reference
$ownerGuid = sanitizeString_( $requestData['ownerGuid']); 
$privileges = sanitizeString_( $requestData['privileges']); 




// Perform necessary operations (e.g., database insertion, update, etc.)
// Use prepared statements to prevent SQL injection
//INSERT INTO `donations`(`donation_date`, `campaign_id`, `donation_amount`, `payment_method`, `createdBy`,`createdOn`, `ownerId`, `userId`,  `guid`, `ownerGuid`, `privileges`,`isActive`) VALUES ($donationDate, $campaign_id, $donation_amount, $payment_method, $createdBy, $createdOn,$ownerId, $userId, $guid, $ownerGuid,$privileges,1);
$stmt = $pdo->prepare("INSERT INTO `donations`(`donation_date`, `campaign_id`, `donation_amount`, `payment_method`, `createdBy`,`createdOn`, `ownerId`, `userId`,  `guid`, `ownerGuid`, `privileges`,`isActive`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?);");

$stmt->execute([$donationDate, $campaign_id, $donation_amount, $payment_method, $createdBy, $createdOn,
$ownerId, $userId, $guid, $ownerGuid,$privileges,1]);


$id = $pdo->lastInsertID();  

// Execute the prepared statement
if ($id> 0) {
    $responseArray = array('status' => 'success', 'message' => 'Donation record added successfully');
} else {
    $responseArray = array('status' => 'error', 'message' => 'Failed to add donation record');
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($responseArray);
?>
