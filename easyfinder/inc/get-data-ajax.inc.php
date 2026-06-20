<?php
require_once 'user_session.inc.php';
if(in_array(1,explode(',', $Auth->admin_role))){
if(isset($_POST['action']) && $_POST['action'] == 'disabled_data'){
	if($data = $AdminTask->Disabled_Data($_POST['table'],$_POST['id'])){
		echo $data;
	}
}
}

if(isset($_POST['action']) && $_POST['action'] == 'edit_School'){
	if($data = $AdminTask->update_edit_school($_POST['url'],$_POST['school_id'])){
		echo $data;
	}
}


if(isset($_POST['action']) && $_POST['action'] == 'edit_client'){
	if($data = $AdminTask->update_edit_partiner($_POST)){
		echo $data;
	}
}


if(isset($_POST['action']) && $_POST['action'] == 'fund_user_wallet'){
	if(!$WalletController->Check_If_Tran_Id_Exist($_POST['trans_id'],'wallet_history_tbl')){
	if($data = $WalletController->Admin_Credit_User_Manually($_POST['trans_id'],$_POST['email'],$_POST['amount'],"credited by ".SITE_TITLE)){
		echo '1';
	}
}else{
	echo "duplicate transaction!";
}
}

if(isset($_POST['action']) && $_POST['action'] == 'edit_dsms_product'){
	if($data = $AdminTask->update_edit_dsms_product($_POST)){
		echo $data;
	}
}

if(isset($_POST['action']) && $_POST['action'] == 'edit_plan'){
	if($data = $AdminTask->update_plan($_POST)){
		echo $data;
	}
}

if(isset($_POST['action']) && $_POST['action'] == 'edit_plan_type'){
	if($data = $AdminTask->update_plan_type($_POST)){
		echo $data;
	}
}

if(isset($_POST['action']) && $_POST['action'] == 'change_provider'){
	if($data = $AdminTask->update_provider($_POST)){
		echo $data;
	}
}


if(isset($_POST['action']) && $_POST['action'] == 'edit_sub'){
	if($data = $AdminTask->update_edit_subcription($_POST)){
		echo $data;
	}
}


if(isset($_POST['action']) && $_POST['action'] == 'edit_team'){
	if($data = $AdminTask->update_edit_team($_POST)){
		echo $data;
	}
}

if(isset($_POST['action']) && $_POST['action'] == 'edit_testimony'){
	if($data = $AdminTask->update_edit_testimony($_POST)){
		echo $data;
	}
}





if(isset($_POST['serviceID']) && !empty($_POST['verify_tv_card_num'])){

	if(isset($_POST['type'])){
		$type=$_POST['type'];
	}else{
		$type='';
	}

	if($data = $TopupController->VerifyTvSubscriptionSmartCard($_POST['verify_tv_card_num'],$_POST['serviceID'], $type)){
		$converted_array = ((array)$data->content);
		if (array_key_exists("error",$converted_array)){
		  echo '0';
		}else{
		echo json_encode($data);
			}
	}else{
	echo '0';
	}
}



