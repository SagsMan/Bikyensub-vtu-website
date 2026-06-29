<?php

namespace EduTech\Controller;

use \PDO;
use EduTech\C_Base;
use EduTech\SessionHelper\Session;
use SimpleValidator\Validator;
use EduTech\Controller\WalletController;

class TopupController extends C_base
{
    private $ref_id;

    public function buyAirtime($arrayForm)
    {
        global $Auth;
        $network_slug = $arrayForm['network_slug'];
        $mobile_number = $arrayForm['mobile_num'];
        $amount = $arrayForm['amount'];
        $trans_id = $arrayForm['trans_id'];

        $apiSetting = $this->GetAPISetting();
        if (!$apiSetting) {
            return false;
        }

        // Check if we are using VTPass or a dynamic provider (Husmodata/Datastation)
        if (strpos(strtolower($apiSetting->api_url), 'vtpass') !== false) {
            $curl = curl_init();
            $params = [
                "request_id" => $trans_id,
                "billersCode" => $mobile_number,
                "serviceID" => $network_slug,
                "amount" => $amount,
                "phone" => $mobile_number,
            ];

            curl_setopt_array($curl, [
                CURLOPT_URL => VTPASS_LINK . "api/pay",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYPEER => CURL_SSL_VERIFY,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($params),
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'Accept: application/json',
                    'api-key: ' . VTPASS_API_KEY,
                'secret-key: ' . VTPASS_SECRET_KEY,
                ],
            ]);

            $response = curl_exec($curl);
            curl_close($curl);
            $res1 = json_decode($response, true);

            if (isset($res1["code"]) && isset($res1["content"]["transactions"])) {
                $res = $res1["content"]["transactions"];
                $array = [
                    "id" => $res["transactionId"],
                    "status" => ($res["status"] == "delivered" || $res["status"] == "pending") ? "Successful" : "Failed",
                    "api_response" => $res1["response_description"],
                    "plan_name" => $res["product_name"],
                    "mobile_number" => $mobile_number
                ];
                return (object)$array;
            }
            return false;
        } else {
            // Dynamic Provider (Husmodata / Datastation Style)
            // Usually the airtime URL is the base URL with /data/ replaced by /topup/ or just a base topup URL.
            // If the URL in DB is .../api/data/, we change it to .../api/topup/
            $url = str_replace('/data/', '/topup/', $apiSetting->api_url);
            
            // Map network slug to ID for dynamic providers
            $network_map = [
                'mtn' => 1,
                'glo' => 2,
                'etisalat' => 3,
                'airtel' => 4
            ];
            $network_id = $network_map[$network_slug] ?? 1;

            $payload = [
                "network" => $network_id,
                "amount" => $amount,
                "mobile_number" => $mobile_number,
                "Ported_number" => true,
                "airtime_type" => "sme"
            ];

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_POSTFIELDS => json_encode($payload),
                CURLOPT_HTTPHEADER => [
                    "Authorization: Token " . $apiSetting->api_key,
                    "Content-Type: application/json",
                    "Accept: application/json"
                ]
            ]);

            $response = curl_exec($curl);
            if (curl_errno($curl)) {
                curl_close($curl);
                return false;
            }
            curl_close($curl);

            $res = json_decode($response);
            if ($res) {
                // Add common fields expected by the UI
                if (!isset($res->plan_name)) $res->plan_name = strtoupper($network_slug) . " Airtime";
                if (!isset($res->mobile_number)) $res->mobile_number = $mobile_number;
                
                // Ensure status is set for topup.php compatibility
                if (!isset($res->status)) {
                    if (isset($res->Status) && strtolower($res->Status) == 'successful') {
                        $res->status = 'Successful';
                    } elseif (isset($res->id)) {
                        $res->status = 'Successful';
                    } else {
                        $res->status = 'Failed';
                    }
                }
                
                if (!isset($res->api_response)) $res->api_response = $res->Status ?? $res->status ?? "Transaction processed";
                return $res;
            }
            return false;
        }
    }

    public function buyTvSubscription(
        $arrayForm, $Auth
    ){
    $id = $arrayForm["serviceID"];
    $plan = $arrayForm["variation_code"];
    $number = $arrayForm["phone"];
    $amount = $arrayForm["amount"];
    $trans_id = $arrayForm["request_id"];
    if ($id != "showmax"){
        $biller = $arrayForm["billersCode"];
    }else{
        $biller = $number;
    }
    $qty = $arrayForm["quantity"];

    $url = VTPASS_LINK."api/pay";

    if (strtolower($id) == "showmax"){
        $params = [
            "request_id" => $trans_id,
            "billersCode" => $biller,
            "serviceID" => $id,
            "variation_code" => $plan,
            "amount" => $amount,
            "phone" =>  $number,
            "quantity" => $qty,
        ];
    }else{
        $params = [
            "request_id" => $trans_id,
            "billersCode" => $biller,
            "serviceID" => $id,
            "variation_code" => $plan,
            "amount" => $amount,
            "subscription_type" => "change",
            "phone" => $number,
            "quantity" => $qty,
        ];
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, CURL_SSL_VERIFY);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json',
        'api-key: ' . VTPASS_API_KEY,
                'secret-key: ' . VTPASS_SECRET_KEY,
    ]);

    $res = curl_exec($ch);

    if (curl_errno($ch)) {
        return false;
    }

    $json = json_decode($res);

    return $json;
   }

    public function GetTvSubscriptionVariations($serviceID)
    {
    $url = VTPASS_LINK."api/service-variations?serviceID={$serviceID}";
    $ch_get = curl_init();
    curl_setopt($ch_get, CURLOPT_URL, $url);
    curl_setopt($ch_get, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch_get, CURLOPT_SSL_VERIFYPEER, CURL_SSL_VERIFY);
    curl_setopt($ch_get, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json',
        'api-key: ' . VTPASS_API_KEY,
        'public-key: ' . VTPASS_PUBLIC_KEY,
    ]);
    $res = curl_exec($ch_get);
    curl_close($ch_get);
    $json = json_decode($res, true);
    if (!isset($json["response_description"]) || $json["response_description"] != "000" || isset($json["content"]["error"])){
        return [];
    }
    $variations = $json["content"]["variations"];
    if (!$variations){
        return [];
    }
    $data = [];
    foreach ($variations as $item){
            $c_fee = $json["content"]["convinience_fee"];
            $amount = (int) $item["variation_amount"];
            if (strpos($c_fee, "%") != FALSE){
                $num = (int) str_replace("%", "", $c_fee);
                $fees = ($num/100) * $amount;
                $amount += $fees;
            }else if (strpos($c_fee, "N") != FALSE || strpos($c_fee, "n") != FALSE){
                $fees = (int) str_replace("n", "", str_replace("N", "", $c_fee));
                $amount += $fees;
            }

            $data[] = [
                "id" => $item["variation_code"],
                "name" => $item["name"]." + ".$json["content"]["convinience_fee"],
                "amount" => $amount,
            ];
    }
    return $data;
}

    public function GetDataNowMerchantProducts($serviceID, $type = '')
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.datanow.ng/api/merchant',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvYXBpLmRhdGFub3cubmdcL2FwaVwvbWVyY2hhbnRcL3NpZ25pbiIsImlhdCI6MTY3NTAxNTUyMywiZXhwIjoxODkxMDE1NTIzLCJuYmYiOjE2NzUwMTU1MjMsImp0aSI6ImpnNnRRdnFpVHZHTUFISEkiLCJzdWIiOjE2MCwicHJ2IjoiOWRhNWQ1MzI2YTE4NGFmN2I0ZTRjZDZmNzJhZTU5NDFmMDUzZDIzNCJ9.BIRftpS-vphbRrcGQmlP2P_ogu2kL8ULF1TmuIPs0Vg',
            ],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        if ($serviceID == 'data_plans') {
            $resData = json_decode($response);
            return $resData->data->data_plans;
        } elseif ($serviceID == 'electric_plans') {
            $resData = json_decode($response);
            return $resData->data->electric_plans;
        } elseif ($serviceID == 'cable_plans') {
            $resData = json_decode($response);
            return $resData->data->cable_plans;
        }
    }

    public function GetDataNowSingleMerchantProducts($serviceID, $product_id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.datanow.ng/api/merchant',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvYXBpLmRhdGFub3cubmdcL2FwaVwvbWVyY2hhbnRcL3NpZ25pbiIsImlhdCI6MTY3NTAxNTUyMywiZXhwIjoxODkxMDE1NTIzLCJuYmYiOjE2NzUwMTU1MjMsImp0aSI6ImpnNnRRdnFpVHZHTUFISEkiLCJzdWIiOjE2MCwicHJ2IjoiOWRhNWQ1MzI2YTE4NGFmN2I0ZTRjZDZmNzJhZTU5NDFmMDUzZDIzNCJ9.BIRftpS-vphbRrcGQmlP2P_ogu2kL8ULF1TmuIPs0Vg',
            ],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        if ($serviceID == 'data_plans') {
            $resData = json_decode($response);
            return $resData->data->data_plans;
        } elseif ($serviceID == 'electric_plans') {
            $resData = json_decode($response);
            return $resData->data->electric_plans[$product_id + 1];
        }
    }
    public function Update_SME_Data($id, $d_price, $o_price, $bundle, $duration)
    {
        if (
            $this->data = parent::$db->run_insert(
                'UPDATE sme_data_tbl SET direct_price = ?, our_price =?, data_bundle  = ?, data_duration =?  WHERE id = ? ',
                [$d_price, $o_price, $bundle, $duration, $id]
            )
        ) {
            return true;
        }
    }

    public function Get_All_Discount()
    {
        if (
            $this->data = parent::$db->run_select(
                'SELECT * FROM discount_tbl ORDER BY id DESC'
            )
        ) {
            return $this->data;
        }
    }
    public function Get_All_SME_Data()
    {
        if (
            $this->data = parent::$db->run_select(
                'SELECT * FROM sme_data_tbl ORDER BY id DESC'
            )
        ) {
            return $this->data;
        }
    }
    public function Update_Discount_Percent(
        $id,
        $gene_discount,
        $refer_discount,
        $agent_discount
    ) {
        if (
            $this->data = parent::$db->run_insert(
                'UPDATE discount_tbl SET percentage_off = ?, referal_share =?, agent = ?  WHERE id = ? ',
                [$gene_discount, $refer_discount, $agent_discount, $id]
            )
        ) {
            return true;
        }
    }
    public function Get_Available_Bill_Payment_Services($serviceID)
    {
        $url = 'https://vtpass.com/api/services?identifier=' . $serviceID;

        $client = curl_init($url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);

        if (!empty($response)) {
            return $response;
        }
    }

    public function VerifyTvSubscriptionSmartCard(
        $card_ID,
        $serviceID,
        $type = ''
    ) {
    $iuc = $card_ID;
    $id = $serviceID;

    $url = VTPASS_LINK."api/merchant-verify";

    $params = [
    'billersCode' => $iuc,
    'serviceID' => $id,
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, CURL_SSL_VERIFY);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json',
        'api-key: ' . VTPASS_API_KEY,
                'secret-key: ' . VTPASS_SECRET_KEY,
    ]);

    $res = curl_exec($ch);

    if (curl_errno($ch)) {
        return false;
    }

    $json = json_decode($res);

    return $json;
 }

    public function Store_My_Trans(
        $trans,
        $amount,
        $real_amount,
        $email,
        $unique_element,
        $phone,
        $product_name,
        $is_bill = '0'
    ) {
        if (
            $this->data = parent::$db->run_insert(
                'INSERT INTO transactions_tbl(request_id,amount,real_amount,email,unique_element,phone,product_name,is_bill) VALUES(?,?,?,?,?,?,?,?)',
                [
                    $trans,
                    $amount,
                    $real_amount,
                    $email,
                    $unique_element,
                    $phone,
                    $product_name,
                    $is_bill,
                ]
            )
        ) {
            return true;
        }
    }

    public function Store_Buy_Token_OR_Pin($pin, $email, $trans_id)
    {
        if (
            $this->data = parent::$db->run_insert(
                'INSERT INTO save_pin_and_token_buy(pin,email,trans_id) VALUES(?,?,?)',
                [$pin, $email, $trans_id]
            )
        ) {
            return true;
        }
    }

    public function Get_Trans_Info($trans_id)
    {
        if (
            $this->data = parent::$db->run_select(
                'SELECT * FROM transactions_tbl WHERE request_id = ? LIMIT 1',
                [$trans_id]
            )
        ) {
            return $this->data[0];
        }
    }

    public function Get_Trans_Category($is_bill, $email, $role)
    {
        if (
            $this->data = parent::$db->run_select(
                "SELECT * FROM transactions_tbl WHERE is_bill = ? AND (email = ? OR super_admin IN($role))",
                [$is_bill, $email]
            )
        ) {
            return $this->data;
        }
    }

    public function Confirm_My_Trans(
        $reason,
        $trans_id,
        $transaction_id = '',
        $status = '0'
    ) {
        if (
            $this->data = parent::$db->run_insert(
                'UPDATE transactions_tbl SET response_description = ?, transaction_id =?, status =?  WHERE request_id = ?',
                [$reason, $transaction_id, $status, $trans_id]
            )
        ) {
            return true;
        }
    }

    public function GetCheapDataPlan($network_id)
    {
        if (
            $this->data = parent::$db->run_select(
                'SELECT t1.*, t2.data_type, t2.title FROM sme_data_tbl as t1 
                JOIN sme_data_type_tbl as t2 ON t1.data_type_id = t2.id
                 WHERE t1.network_id  = ?',
                [$network_id]
            )
        ) {
            return json_encode($this->data);
        }
    }

    public function GetDataPlan($network_id)
    {
        if (
            $this->data = parent::$db->run_select(
                'SELECT t1.*, t2.data_type, t2.title, t3.api_name as provider FROM plans as t1 
                JOIN plan_types as t2 ON t1.plan_type_id = t2.id
                JOIN api_settings as t3 ON t1.api_id = t3.id 
                 WHERE t1.network_id  = ? AND t3.is_active = ?',
                [$network_id, 1]
            )
        ) {
            return json_encode($this->data);
        }
    }

    public function GetDataPlanType1($network_id, $str = null)
    {
        $url = VTPASS_LINK."api/service-variations?serviceID={$network_id}";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, CURL_SSL_VERIFY);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json',
        'api-key: ' . VTPASS_API_KEY,
                'secret-key: ' . VTPASS_SECRET_KEY,
        ]);

        $res = curl_exec($ch);
        if (curl_errno($ch)) {
            return [];
        }
        $json = json_decode($res, true);
        if (!$json["response_description"] || $json["response_description"] != "000"){
            return [];
        }
        $array = [];
        $data = $json["content"];

        foreach ($data["variations"] as $variation){
            if ($str && stripos($variation["name"], $str) == FALSE){
                continue;
            }
            array_push($array, ["name" => $variation["name"], "amount" => $variation["variation_amount"], "id" => $variation["variation_code"]]);
        }
        
        return $array;
    }

    // public function GetDataPlanType($network_id)
    // {
    //     if (
    //         $this->data = parent::$db->run_select(
    //             'SELECT * FROM plan_types WHERE network_id  = ?',
    //             [$network_id]
    //         )
    //     ) {
    //         return json_encode($this->data);
    //     }
    // }
    public function GetDataPlanType($network_id)
    {
        if (
            $this->data = parent::$db->run_select(
                'SELECT DISTINCT t2.id, t2.title, t2.data_type, t1.network_id 
                 FROM plans as t1
                 JOIN plan_types as t2 ON t1.plan_type_id = t2.id
                 JOIN api_settings as t3 ON t1.api_id = t3.id
                 WHERE t1.network_id = ? AND t3.is_active = 1
                 ORDER BY t2.title',
                [$network_id]
            )
        ) {
            return json_encode($this->data);
        }
    }

    public function GetExamTypes()
    {
        $supported =  ["waec-registration" => ["id" => "waec-registration", "name" => "WAEC Reg.", "variation" => "api/service-variations?serviceID=waec-registration", "id_verify" => null, "pay" => "api/pay"], "waec" => ["id" => "waec", "name" => "WAEC Result Checker", "variation" => "api/service-variations?serviceID=waec",  "id_verify" => null, "pay" => "api/pay"], "jamb" => ["id" => "jamb", "name" => "JAMB PIN", "variation" => "api/service-variations?serviceID=jamb",  "id_verify" => "api/merchant-verify", "pay" => "api/pay"]];
        return $supported;
    }

    public function GetSingleExamType($exam_type)
    {
        $supported =  ["waec-registration" => ["id" => "waec-registration", "name" => "WAEC Reg.", "variation" => "api/service-variations?serviceID=waec-registration", "id_verify" => null, "pay" => "api/pay"], "waec" => ["id" => "waec", "name" => "WAEC Result Checker", "variation" => "api/service-variations?serviceID=waec",  "id_verify" => null, "pay" => "api/pay"], "jamb" => ["id" => "jamb", "name" => "JAMB PIN", "variation" => "api/service-variations?serviceID=jamb",  "id_verify" => "api/merchant-verify", "pay" => "api/pay"]];
        return (isset($supported[$exam_type])?$supported[$exam_type]:[]);
    }

    public function getExamTypeVariation($id){
    $exam = $this->GetSingleExamType($id);
    if (!$exam){
        return [];
    }


    $url = VTPASS_LINK.$exam["variation"];
    $ch_get2 = curl_init();
    curl_setopt($ch_get2, CURLOPT_URL, $url);
    curl_setopt($ch_get2, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch_get2, CURLOPT_SSL_VERIFYPEER, CURL_SSL_VERIFY);
    curl_setopt($ch_get2, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json',
        'api-key: ' . VTPASS_API_KEY,
        'public-key: ' . VTPASS_PUBLIC_KEY,
    ]);
    $res = curl_exec($ch_get2);
    curl_close($ch_get2);
    $json = json_decode($res, true);
    if (!isset($json["response_description"]) || $json["response_description"] != "000" || isset($json["content"]["error"])){
        return [];
    }
    $variations = $json["content"]["variations"];
    if (!$variations){
        return [];
    }

    $data = [];
    foreach ($variations as $item){
            $c_fee = $json["content"]["convinience_fee"];
            $amount = (int) $item["variation_amount"];
            if (strpos($c_fee, "%") != FALSE){
                $num = (int) str_replace("%", "", $c_fee);
                $fees = ($num/100) * $amount;
                $amount += $fees;
            }else if (strpos($c_fee, "N") != FALSE || strpos($c_fee, "n") != FALSE){
                $fees = (int) str_replace("n", "", str_replace("N", "", $c_fee));
                $amount += $fees;
            }

            $data[] = [
                "id" => $item["variation_code"],
                "name" => $item["name"]." - ".$amount,
                "amount" => $amount,
            ];
    }
    return $data;
    }

    public function verifyJambId($id, $id_num, $type){
    $exam = $this->GetSingleExamType($id);
    if (!isset($exam)){
        echo json_encode(["status" => "failed", "msg" => "unknown exam service", "data" => []]);
        return;
    }

    if ($exam["id_verify"] == null){
        echo json_encode(["status" => "failed", "msg" => "{$id} does not require profile ID verification"]);
        return;
    }

    $url = VTPASS_LINK.$exam["id_verify"];

    $params = [
    'billersCode' => $id_num,
    'serviceID' => $id,
    'type' => $type,
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, CURL_SSL_VERIFY);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json',
        'api-key: ' . VTPASS_API_KEY,
                'secret-key: ' . VTPASS_SECRET_KEY,
    ]);

    $res = curl_exec($ch);

    if (curl_errno($ch)) {
        echo json_encode(["status" => "failed", "error" => "cURL Error: " . curl_error($ch), "data" => []]);
        return;
    }

    $json = json_decode($res, true);

    if (!$json["code"] || $json["code"] != "000" || isset($json["content"]["error"])){
        echo json_encode(["status" => "failed", "msg" => "failed trying to verifying id number"]);
        return;
    }

    $data = $json["content"];
        $array = [
        "name" => $data["Customer_Name"],
        ];
    echo json_encode(["status" => "success", "data" => $array]);
    }

    public function buyExamPin($post){
    global $Auth;
    $id = $post["exam_type"];
    $plan = $post["exam_plan"];
    $number = $post["profile_id"];
    $amount = $post["amount"];
    $trans_id = $post["trans_id"];
    $qty = $post["qty"];

    $exam = $this->GetSingleExamType($id);

    if (!$exam){
        return false;
    }

    $url = VTPASS_LINK.$exam["pay"];

    if ($id == "jamb"){
        $params = [
          "request_id" => $trans_id,
          "billersCode" => $number,
          "serviceID" => $id,
          "variation_code" => $plan,
          "phone" =>  $Auth->phone,
       ];
    }else{
       $params = [
          "request_id" => $trans_id,
          "serviceID" => $id,
          "variation_code" => $plan,
          "phone" => $Auth->phone,
          "quantity" => $qty,
      ];
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, CURL_SSL_VERIFY);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json',
        'api-key: ' . VTPASS_API_KEY,
                'secret-key: ' . VTPASS_SECRET_KEY,
    ]);

    $res = curl_exec($ch);

    if (curl_errno($ch)) {
        return false;
    }

    $json = json_decode($res, true);

    if (!$json["code"] || $json["code"] != "000" || isset($json["content"]["error"])){
        return false;
    }

    $data = $json["content"];
    if (strtolower($data["transactions"]["status"]) == "delivered"){
        $array = [];
        if ($id == "jamb"){
            $pin = trim(explode(":", $json["Pin"])[1]);
            array_push($array, [$pin, ""]);
        }else if ($id == "waec-registration"){
            foreach ($json["tokens"] as $key => $tk){
                array_push($array, [$tk, ""]);
            }
        }else if ($id == "waec"){
            foreach ($json["cards"] as $key => $card){
                array_push($array, [$card["Pin"], $card["Serial"]]);
            }
        }
        return json_decode(json_encode(["success" => "true", "status" => "Successful", "reference_no" => $data["transactions"]["transactionId"],"msg" => "payment made successfully", "data" => $array]));
    }else{
        return false;
    }
    }

    public function GetCheapDataPlanDirectPrice($plan_id)
    {
        if (
            $this->data = parent::$db->run_select(
                'SELECT direct_price FROM sme_data_tbl WHERE plan_id  = ? LIMIT 1',
                [$plan_id]
            )
        ) {
            return $this->data[0];
        }
    }

    public function GetPinAndTokenTrans($email, $role)
    {
        if (
            $this->data = parent::$db->run_select(
                "SELECT * FROM save_pin_and_token_buy WHERE super_admin IN($role) OR email  = ?",
                [$email]
            )
        ) {
            return $this->data;
        }
    }

    public function GetSinglePinAndTokenTrans($trans_id)
    {
        if (
            $this->data = parent::$db->run_select(
                'SELECT save_pin_and_token_buy.*, transactions_tbl.amount,transactions_tbl.phone FROM save_pin_and_token_buy LEFT JOIN transactions_tbl ON transactions_tbl.transaction_id = save_pin_and_token_buy.trans_id  WHERE save_pin_and_token_buy.trans_id = ?',
                [$trans_id]
            )
        ) {
            return $this->data;
        }
    }

    public function GetAPISetting($status = 1)
    {
        if (
            $this->data = parent::$db->run_select(
                'SELECT * FROM api_settings  WHERE is_active = ?',
                [$status]
            )
        ) {
            return $this->data[0];
        }
    }
    
    
    
    
   public function BuyCheaperDataBundle($arrayForm = null)
   {
       // Use provided array or fallback to $_POST
       $data = $arrayForm ?? $_POST;
       
       $network_id    = (int) ($data['network_name'] ?? 0);
       $mobile_number = (string) ($data['mobile_num'] ?? '');
       $plan_id       = (string) ($data['variation_code'] ?? ''); // Variation code can be "id{BRK}price" or just "id"
       $amount        = ($data['amount'] ?? 0);
       $trans_id      = ($data['trans_id'] ?? '');
       $network_slug  = ($data['network_slug'] ?? '');

       // Get the active API provider from api_settings
       $apiSetting = $this->GetAPISetting();
       if (!$apiSetting) {
           return (object)["status" => "Failed", "api_response" => "No active API provider found"];
       }

       // Branch by provider type
       if (strpos(strtolower($apiSetting->api_url), 'vtpass') !== false) {
           // VTPass Style
           // Clean variation code
           $variation_parts = explode("{BRK}", $plan_id);
           $clean_variation_code = $variation_parts[0];

           $params = [
               "request_id" => $trans_id,
               "billersCode" => $mobile_number,
               "serviceID" => $network_slug,
               "variation_code" => $clean_variation_code,
               "amount" => $amount,
               "phone" => $mobile_number,
           ];

           $curl = curl_init();
           curl_setopt_array($curl, [
               CURLOPT_URL => VTPASS_LINK . "api/pay",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => '',
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 30,
               CURLOPT_SSL_VERIFYPEER => CURL_SSL_VERIFY,
               CURLOPT_FOLLOWLOCATION => true,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => 'POST',
               CURLOPT_POSTFIELDS => json_encode($params),
               CURLOPT_HTTPHEADER => [
                   'Content-Type: application/json',
                   'Accept: application/json',
                   'api-key: ' . VTPASS_API_KEY,
                'secret-key: ' . VTPASS_SECRET_KEY,
               ],
           ]);

           $response = curl_exec($curl);
           curl_close($curl);
           $res1 = json_decode($response, true);

           if (isset($res1["code"]) && isset($res1["content"]["transactions"])) {
               $res = $res1["content"]["transactions"];
               $array = [
                   "id" => $res["transactionId"],
                   "status" => ($res["status"] == "delivered" || $res["status"] == "pending") ? "Successful" : "Failed",
                   "api_response" => $res1["response_description"],
                   "plan_name" => $res["product_name"],
                   "mobile_number" => $mobile_number
               ];
               return (object)$array;
           }
           return (object)["status" => "Failed", "api_response" => "VTPass transaction failed"];
           
        } else {
           // Husmodata / Datastation Style
           // Trim URL and API key to remove hidden whitespace/newlines from DB
           $url = trim($apiSetting->api_url);
           $api_key = trim($apiSetting->api_key);

           // Variation code might be "id{BRK}price"
           $variation_parts = explode("{BRK}", $plan_id);
           $clean_plan_id = $variation_parts[0];

           $payload = [
               "network" => $network_id,
               "mobile_number" => $mobile_number,
               "plan" => (int)$clean_plan_id,
               "Ported_number" => true
           ];

           $json_payload = json_encode($payload);

           // Log request for debugging
           error_log("=== Data Purchase API Request ===");
           error_log("Provider: " . ($apiSetting->api_name ?? 'Unknown'));
           error_log("URL: [" . $url . "]");
           error_log("API Key length: " . strlen($api_key));
           error_log("Payload: " . $json_payload);

           $curl = curl_init();
           curl_setopt($curl, CURLOPT_URL, $url);
           curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($curl, CURLOPT_POST, true);
           curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
           curl_setopt($curl, CURLOPT_POSTFIELDS, $json_payload);
           curl_setopt($curl, CURLOPT_HTTPHEADER, [
               "Authorization: Token " . $api_key,
               "Content-Type: application/json",
               "Accept: application/json"
           ]);

           $response = curl_exec($curl);
           $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

           if (curl_errno($curl)) {
               $curl_err = curl_error($curl);
               error_log("CURL Error: " . $curl_err);
               curl_close($curl);
               return (object)["Status" => "Failed", "status" => "Failed", "api_response" => "CURL Error: " . $curl_err];
           }
           curl_close($curl);

           // Log raw response for debugging
           error_log("HTTP Code: " . $http_code);
           error_log("Raw Response: " . $response);

           $Response_result = json_decode($response);

           if (!$Response_result) {
               error_log("Failed to decode API response");
               return (object)["Status" => "Failed", "status" => "Failed", "api_response" => "Invalid API response (HTTP $http_code)"];
           }

           error_log("Decoded Response: " . print_r($Response_result, true));

           // Normalize response: detect success from various response formats
           // Husmodata typically returns: Status, id, plan_name, mobile_number, etc.
           // Datastation may use slightly different field names
           $raw_status = $Response_result->Status ?? $Response_result->status ?? '';
           $is_api_success = (strtolower($raw_status) === 'successful' || strtolower($raw_status) === 'success');

           // Also check for error indicators
           // Husmodata returns errors as array: {"error":["message here"]}
           $error_msg = '';
           if (isset($Response_result->error) && !empty($Response_result->error)) {
               $is_api_success = false;
               if (is_array($Response_result->error)) {
                   $error_msg = implode('. ', $Response_result->error);
               } else {
                   $error_msg = $Response_result->error;
               }
           }

           // Build normalized response object
           $normalized = [
               "Status" => $is_api_success ? "Successful" : "Failed",
               "status" => $is_api_success ? "Successful" : "Failed",
               "mobile_number" => $Response_result->mobile_number ?? $mobile_number,
               "api_response" => $error_msg ?: ($Response_result->api_response ?? $Response_result->Status ?? $Response_result->status ?? $Response_result->message ?? "Transaction processed"),
               "plan_name" => $Response_result->plan_name ?? $Response_result->plan_network ?? '',
           ];

           // Preserve the id if present (success indicator)
           if (isset($Response_result->id) && $is_api_success) {
               $normalized["id"] = $Response_result->id;
           }

           // Copy over any extra fields from the raw response
           if (isset($Response_result->balance_before)) $normalized["balance_before"] = $Response_result->balance_before;
           if (isset($Response_result->balance_after)) $normalized["balance_after"] = $Response_result->balance_after;
           if (isset($Response_result->plan_amount)) $normalized["plan_amount"] = $Response_result->plan_amount;

           error_log("Normalized Status: " . $normalized["Status"]);

           return (object)$normalized;
       }
   }
    // public function BuyCheaperDataBundle($arrayForm)
    // {
       
    //     $network_id = $_POST['network_name'];
    //     $mobile_number = $_POST['mobile_num'];
    //     $plan_id = $_POST['variation_code'];
    //     echo "Network Id :" .$network_id;
    //     echo "Plan Id: ".$plan_id ;
    //     $apiSetting = $this->GetAPISetting();

    //     $curl = curl_init();

    //     curl_setopt_array($curl, [
    //         CURLOPT_URL => $apiSetting->api_url,
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_SSL_VERIFYPEER => CURL_SSL_VERIFY,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'POST',
    //         CURLOPT_POSTFIELDS =>
    //         '{"network": "' .
    //             $network_id .
    //             '",
    //         "mobile_number": "' .
    //             $mobile_number .
    //             '",
    //         "plan": "' .
    //             $plan_id .
    //             '",
    //         "Ported_number":true}',
    //         CURLOPT_HTTPHEADER => [
    //             'Authorization: Token ' . $apiSetting->api_key,
    //             'Content-Type: application/json',
    //         ],
    //     ]);

    //     $response = curl_exec($curl);

    //     curl_close($curl);
        
    //     $Response_result = json_decode($response);

    //     if ($Response_result) {
    //         return $Response_result;
    //     } else {
    //         return false;
    //     }
    // }

    // public function BuyCheaperDataBundle1($arrayForm)
    // {
    //     global $Auth;
    //     $network_slug = $arrayForm["network_slug"];
    //     $variation_code = $arrayForm["variation_code"];
    //     $amount = $arrayForm["amount"];
    //     $mobile_no = $arrayForm["mobile_num"];
    //     $trans_id = $arrayForm["trans_id"];

    //     $params = [
    //         "request_id" => $trans_id,
    //         "billersCode" => $mobile_no,
    //         "serviceID" => $network_slug,
    //         "variation_code" => $variation_code,
    //         "amount" => $amount,
    //         "phone" => $mobile_no,
    //     ];

    //     //$apiSetting = $this->GetAPISetting();

    //     $curl = curl_init();

    //     curl_setopt_array($curl, [
    //         CURLOPT_URL => VTPASS_LINK."api/pay",
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_SSL_VERIFYPEER => CURL_SSL_VERIFY,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'POST',
    //         CURLOPT_POSTFIELDS => json_encode($params),
    //         CURLOPT_HTTPHEADER =>[
    //             'Content-Type: application/json',
    //             'Accept: application/json',
    //             'api-key: ' . VTPASS_API_KEY,
    //             'secret-key: ' . VTPASS_SECRET_KEY,
    //         ],
    //     ]);

    //     $response = curl_exec($curl);

    //     curl_close($curl);
    //     $res1 = json_decode($response, true);

    //     if (isset($res1["code"]) && isset($res1["content"]["transactions"])){
    //         $res = $res1["content"]["transactions"];
    //         $array = ["id" => $res["transactionId"], "status" => $res["status"] == "delivered" ||  $res["status"] == "pending"?"Successful":"Failed", "api_response" => $res1["response_description"], "plan_name" => $res["product_name"], "mobile_number" => $mobile_no];
    //         $obj = (object) $array;
    //         return $obj;
    //     }else {
    //         return false;
    //     }
    // }
    public function BuyCheaperDataBundle1($arrayForm)
    {
        global $Auth;
        $network_slug = $arrayForm["network_slug"];
        $variation_code = $arrayForm["variation_code"];
        $amount = $arrayForm["amount"];
        $mobile_no = $arrayForm["mobile_num"];
        $trans_id = $arrayForm["trans_id"];
    
        // Extract variation code properly (remove amount part if exists)
        $variation_parts = explode("{BRK}", $variation_code);
        $clean_variation_code = $variation_parts[0];
    
        $params = [
            "request_id" => $trans_id,
            "billersCode" => $mobile_no,
            "serviceID" => $network_slug,
            "variation_code" => $clean_variation_code,
            "amount" => $amount,
            "phone" => $mobile_no,
        ];
    
        $curl = curl_init();
    
        curl_setopt_array($curl, [
            CURLOPT_URL => VTPASS_LINK."api/pay",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30, // Reduced from 0 to 30 seconds
            CURLOPT_SSL_VERIFYPEER => CURL_SSL_VERIFY,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json',
                'api-key: ' . VTPASS_API_KEY,
                'secret-key: ' . VTPASS_SECRET_KEY,
            ],
        ]);
    
        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($curl);
        curl_close($curl);
    
        // Log the API response for debugging
        error_log("VTPass API Response: " . $response);
        error_log("VTPass HTTP Code: " . $http_code);
    
        if ($response === false) {
            error_log("CURL Error: " . $curl_error);
            return false;
        }
    
        $res1 = json_decode($response, true);
    
        if (isset($res1["code"]) && $res1["code"] == "000" && isset($res1["content"]["transactions"])) {
            $res = $res1["content"]["transactions"];
            $array = [
                "id" => $res["transactionId"], 
                "status" => ($res["status"] == "delivered" || $res["status"] == "pending") ? "Successful" : "Failed", 
                "api_response" => $res1["response_description"], 
                "plan_name" => $res["product_name"], 
                "mobile_number" => $mobile_no
            ];
            return (object) $array;
        } else {
            // Return detailed error information
            $error_msg = $res1["response_description"] ?? $res1["error"] ?? "Unknown API error";
            error_log("VTPass API Error: " . $error_msg);
            return false;
        }
    }

    public function BuyCheaperDataBundle_Requery(
        $mobile_number,
        $plan_id,
        $network_id,
        $trans_id
    ) {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://www.datahouse.com.ng/api/data/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>
            '{"network": "' .
                $network_id .
                '",
"mobile_number": "' .
                $mobile_number .
                '",
"plan": "' .
                $plan_id .
                '",
"Ported_number":true}',
            CURLOPT_HTTPHEADER => [
                'Authorization: Token 630e90c465df180bb0b542dc9b40a2143c65c832',
                'Content-Type: application/json',
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        $Response_result = json_decode($response);

        if (isset($Response_result->Status)) {
            if ($Response_result->Status === 'successful') {
                $status = 1;

                if (
                    $this->Confirm_My_Trans(
                        $Response_result->Status,
                        $trans_id,
                        $trans_id,
                        $status
                    )
                ) {
                    return $Response_result;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function BuyResultCheckerPin($exam_type, $qty)
    {
        switch ($exam_type) {
            case 'neco':
                $result_type = 'neco_v2';
                break;
            case 'waec':
                $result_type = 'waec_v2';
                break;
            case 'nabteb':
                $result_type = 'nabteb_v2';
                break;
            case 'nbais':
                $result_type = 'nbais_v2';
                break;
        }

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL =>
            'https://easyaccess.com.ng/api/' . $result_type . '.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => [
                'no_of_pins' => intval($qty),
            ],
            CURLOPT_HTTPHEADER => [
                'AuthorizationToken: 607bd98987afb996040bcffa261ff', //replace this with your authorization_token
                // 'AuthorizationToken: 48d95439cb3473b2c0d5de460abbf863', 
                'cache-control: no-cache',
            ],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }
}
