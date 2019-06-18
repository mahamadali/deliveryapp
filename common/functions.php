<?php
require_once(BASE_PATH.'/common/database.php');
require BASE_PATH . '/vendor/autoload.php';
// require_once BASE_PATH.'/libs/html2pdf/vendor/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;
use Dompdf\Dompdf;

// Use HTML2PDF LIBRARY
// use Spipu\Html2Pdf\Html2Pdf;
// use Spipu\Html2Pdf\Exception\Html2PdfException;
// use Spipu\Html2Pdf\Exception\ExceptionFormatter;



function login($request) {
	global $db;
	$request = $db->realEscapeRequest($request);
	$sql = "SELECT id from users WHERE username='".$request['username']."' AND password='".encrypt($request['password'])."'";
	
	if($db->numRows($db->query($sql)) > 0) {
		
		$_SESSION['user_name'] = $request['username'];
		return $db->getOne($db->query($sql));
	}
	else {
		return "false";
	}
}
function get_admin_meta($id, $field) {
	global $db;
	$sql = 'SELECT '.$field.' FROM `users` WHERE id='.$id.'';
	$result = $db->query($sql);
	$row = $db->getOne($result);
	return $row->$field;
}
function get_user_meta($id, $field) {
	global $db;
	$sql = 'SELECT '.$field.' FROM `user` WHERE id='.$id.'';
	$result = $db->query($sql);
	$row = $db->getOne($result);
	return $row->$field;
}
function get_setting_meta($field) {
	global $db;
	$sql = 'SELECT `value` FROM `app_settings` WHERE `name`="'.$field.'"';
	$result = $db->query($sql);
	$row = $db->getOne($result);
	return $row->value;
}
function get_users($limited = false,$offset = 0,$limit = 0,$searchWith = array()) {
	global $db,$app;
	$limitedSql = "";
	$where = " WHERE 1=1";
	if(!empty($searchWith)) {
		extract($searchWith);
		if(!empty($searchWith['filter_phone_number'])) {
			$where.= " AND (phone_number LIKE '%".$filter_phone_number."%')";
		}
		if(!empty($searchWith['filter_university'])) {
			$where.= " AND (university LIKE '%".$filter_university."%')";
		}
		if(!empty($searchWith['filter_school_email_address'])) {
			$where.= " AND (school_email_address LIKE '%".$filter_school_email_address."%')";
		}
		if(!empty($searchWith['filter_graduate_year'])) {
			$where.= " AND (graduate_year IN (".$filter_graduate_year."))";
		}
		if(!empty($searchWith['filter_born_year'])) {
			$where.= " AND (born_year IN (".$filter_born_year."))";
		}
		if(!empty($searchWith['filter_gender'])) {
			$where.= " AND (gender IN (".$filter_gender."))";
		}
		if(!empty($searchWith['filter_zip_code_min']) || !empty($searchWith['filter_zip_code_max'])) {
			$where.= " AND (";
			if(!empty($searchWith['filter_zip_code_min'])) {
				$where.= "zip_code >= ".$filter_zip_code_min;
			}
			if(!empty($searchWith['filter_zip_code_min']) && !empty($searchWith['filter_zip_code_max'])) {
				$where.= " AND ";	
			}
			if(!empty($searchWith['filter_zip_code_max'])) {
				$where.= " zip_code <= ".$filter_zip_code_max;
			}
			$where.= ")";
		}
		if(!empty($searchWith['filter_race'])) {
			$where.= " AND (race IN (".$filter_race."))";
		}
		if(!empty($searchWith['filter_monthly_estimate_income'])) {
			$where.= " AND (monthly_estimate_income IN (".$filter_monthly_estimate_income."))";
		}
		if(!empty($searchWith['filter_most_buy_category'])) {
			$where.= " AND (most_buy_category IN (".$filter_most_buy_category."))";
		}
	}
	if($limited) {
		$limitedSql = " LIMIT ".$offset.",".$limit;
	}
	$sql = 'SELECT * FROM `user`'.$where.' ORDER BY ID DESC'.$limitedSql;
	
	$result = $db->get($db->query($sql));
	return $result;
}
function is_number_exists($phone_number) {
	global $db;
	$sql = 'SELECT * FROM `user` WHERE phone_number="'.$phone_number.'"';
	$result = $db->query($sql);
	if($db->numRows($result) == 0) {
		return false;
	}
	else {
		return true;
	}
}
function addUser($request) {
	global $db,$app;
	$request = $db->realEscapeRequest($request);
	$sql = "INSERT INTO `user`(`university`,`phone_number`,`school_email_address`,`graduate_year`,`born_year`,`gender`,`zip_code`,`race`,`monthly_estimate_income`,`most_buy_category`) VALUES('".$request['university']."','".$request['phone_number']."','".$request['school_email_address']."','".$request['graduate_year']."','".$request['born_year']."','".$request['gender']."','".$request['zip_code']."','".$request['race']."','".$request['monthly_estimate_income']."','".$request['most_buy_category']."')";
	$db->query($sql);
	return true;
}
/* Function to add delivery boy*/
function addDeliveryBoy($request) {
	global $db,$app;
	$request = $db->realEscapeRequest($request);
	$sql = "INSERT INTO `users`(`name`,`contact`,`username`,`password`,`type`) VALUES('".$request['delivery_boy_name']."','".$request['delivery_boy_contact_number']."','".$request['delivery_boy_email']."','".encrypt($request['delivery_boy_password'])."',2)";
	$db->query($sql);
	SystemLog($app->getSession('loggedin'), 0, "New Delivery Boy Added.");
	return true;
}
/* Function to updatedelivery boy informaion*/
function updateDeliveryBoy($request) {
	global $db,$app;
	$request = $db->realEscapeRequest($request);
	$sql = "UPDATE `users` SET `name`='".$request['delivery_boy_name']."',`contact`='".$request['delivery_boy_contact_number']."' WHERE id=".$request['id'];
	$db->query($sql);
	return true;
}
/* Function to delete delivery boy*/
function deleteDeliveryBoys($delivery_boy_id){
	global $db;
	$sql = "DELETE FROM `deliveryboys` WHERE id=".$delivery_boy_id;
	$db->query($sql);
}
/* Function to get information of delivery boy*/
function getDeliveryBoyInfo($delivery_boy_id) {
	global $db;
	$sql = "SELECT * FROM `users` WHERE `id`=".$delivery_boy_id;
	$deliverBoyInfo = $db->getOne($db->query($sql));
	return $deliverBoyInfo;
}
/* Function to create order */
function generateOrder($orderInfo) {
	global $db,$app;

	//Get latlong
	$latlongFrom = getLatLong($orderInfo['order_from']);
	$latlongTo = getLatLong($orderInfo['order_to']);
	//Get Distance
	$kilometers = 0;
	if(!empty($latlongFrom['lat'])) {
		$distance = getDistanceBetweenPoints($latlongFrom['lat'], $latlongFrom['long'], $latlongTo['lat'], $latlongTo['long']);
		foreach ($distance as $unit => $value) {
			if($unit == 'kilometers') {
				$kilometers = number_format($value,4);
			}
		}
	}
	$kilometers = str_replace(',', '', $kilometers);
	if($kilometers <= 3) {
		$delivery_charge = 25.00;
	}
	else{
		$delivery_charge = number_format($kilometers*3, 2);
	}
	$delivery_charge = str_replace(',', '', $delivery_charge);

	$bill_to = $db->realEscape($orderInfo['bill_to']);
	$customer_phone_number = $db->realEscape($orderInfo['customer_phone_number']);
	$order_from = $db->realEscape($orderInfo['order_from']);
	$order_to = $db->realEscape($orderInfo['order_to']);
	$orderSpecialNote = $db->realEscape($orderInfo['orderSpecialNote']);
	$delivery_boy = $db->realEscape($orderInfo['delivery_boy']);
	

	$orderItemNames = $db->realEscapeRequest($orderInfo['orderItemName']);
	$orderItemQuantities = $db->realEscapeRequest($orderInfo['orderItemQuantity']);
	$orderItemSpecialNotes = $db->realEscapeRequest($orderInfo['orderItemSpecialNote']);
	$orderItemsSet = array(
		'item' => $orderItemNames,
		'qty' => $orderItemQuantities,
		'note' => $orderItemSpecialNotes,
	);
	$order_no = generateOrderNumber();
	$sql = "INSERT INTO `orders`(`bill_to`,`customer_phone_number`,`order_from`,`order_to`,`order_no`,`delivery_charge`,`special_note`,`deliveryboy_id`) VALUES ('".$bill_to."','".$customer_phone_number."','".$order_from."','".$order_to."','".$order_no."', ".$delivery_charge.", '".$orderSpecialNote."', '".$delivery_boy."')";
	$db->query($sql);
	$latest_order_id = $db->getLastInsertedId();
	$sql = "INSERT INTO `order_items`(`items`,`order_id`) VALUES('".serialize($orderItemsSet)."','".$latest_order_id."')";
	$db->query($sql);
	$orderInfo = getOrderInfo($latest_order_id);
	generateOrderInvoice($latest_order_id, $order_no);

	//Send Notification to delivery boy
	$deliveryBoyInfo = getDeliveryBoyInfo($delivery_boy);
	$deliveryBoyName = $deliveryBoyInfo->name;
	$mobileNo = $deliveryBoyInfo->contact;
	$orderInvoicePDFFileName = "assets/order_invoice_pdfs/".$order_no.".pdf";

	$msg = "Hello ".ucfirst($deliveryBoyName).PHP_EOL.PHP_EOL;
	$msg .= "New order arrived from A2Z Delivery.".PHP_EOL.PHP_EOL;
	$msg .= "Click here to check order details. ".HOME_URL.$orderInvoicePDFFileName.PHP_EOL.PHP_EOL;
	$msg .= "Thanks,".PHP_EOL."A2Z Delivery Team.";

	sendNotificationViaSms($mobileNo, $msg);

	//Send Notification to customer
	$customerMsg = "Hello ".ucfirst($bill_to).PHP_EOL.PHP_EOL;
	$customerMsg .= "New order received from you.".PHP_EOL.PHP_EOL;
	$customerMsg .= "Click here to check order details. ".HOME_URL.$orderInvoicePDFFileName.PHP_EOL.PHP_EOL;
	$customerMsg .= "Thanks,".PHP_EOL."A2Z Delivery Team.";

	sendNotificationViaSms($customer_phone_number, $customerMsg);

	SystemLog($app->getSession('loggedin'), $latest_order_id, "Order No #".$order_no." created.");
	return $orderInfo;
}
/* Function to get order info by order id */
function getOrderInfo($order_id = null) {
	global $db,$app;
	$orderInfo = array();
	if(!empty($order_id)) {
		$sql = "SELECT * FROM `orders` o LEFT JOIN `order_items` oi ON oi.order_id = o.id WHERE o.id = ".$order_id;
		$orderInfo = $db->getOne($db->query($sql));
	}
	return $orderInfo;
}

/* Function to get order info by order id */
function getOrderInfoByOrderNo($order_id = null) {
	global $db,$app;
	$orderInfo = array();
	if(!empty($order_id)) {
		$sql = "SELECT * FROM `orders` o LEFT JOIN `order_items` oi ON oi.order_id = o.id WHERE o.order_no = '".$order_id."'";
		$orderInfo = $db->getOne($db->query($sql));
	}
	return $orderInfo;
}
/* Function to create unique order number */
function generateOrderNumber() {
	global $db,$app;
	$query = "SELECT id FROM `orders` ORDER BY ID DESC LIMIT 1";
	$lastOrderInfo = $db->getOne($db->query($query));
	if(empty($lastOrderInfo->id)) {
		$latest_order_id = 0;
	}
	else {
		$latest_order_id = $lastOrderInfo->id;
	}
	return ORDER_NUMBER_PREFIX.str_pad(($latest_order_id+1), 8,'0',STR_PAD_LEFT);
}
/* Function to generate order invoice */
function generateOrderInvoice($order_id, $order_no) {
	$orderInfo = getOrderInfo($order_id);
	$order_invoice_tempalte = file_get_contents(HOME_URL.'order_invoice_tpl.php?order_id='.$order_id);
	$order_invoice_built_content = buildOrderInvoiceInfo($order_invoice_tempalte,$orderInfo);
	$orderInvoicePDFFileName = "assets/order_invoice_pdfs/".$order_no.".pdf";
	generateOrderInvoicePDF($order_invoice_built_content,$orderInvoicePDFFileName);
}
/* Functin to build order invoice infomation */
function buildOrderInvoiceInfo($order_invoice_tempalte,$order_info){
	foreach ($order_info as $key => $value) {
		if($key == 'deliveryboy_id') {
			$delivery_boy_name = getDeliveryBoyInfo($value);
			$order_invoice_tempalte = str_replace("{{".$key."}}", $delivery_boy_name->name, $order_invoice_tempalte);
		}
		else{
			$order_invoice_tempalte = str_replace("{{".$key."}}", $value, $order_invoice_tempalte);
		}
	}
	$order_invoice_tempalte = str_replace("{{APP_LOGO}}","assets/img/logos/".get_setting_meta('logo'),$order_invoice_tempalte);
	$order_invoice_tempalte = str_replace("{{APP_NAME}}",get_setting_meta('app_name'),$order_invoice_tempalte);
	$order_invoice_tempalte = str_replace("{{APP_ADDRESS_LINE_1}}",get_setting_meta('app_address'),$order_invoice_tempalte);
	$order_invoice_tempalte = str_replace("{{APP_CONTACT_NUMBER}}",get_setting_meta('app_contact_number'),$order_invoice_tempalte);
	$order_invoice_built_content = $order_invoice_tempalte;
	return $order_invoice_built_content;
}
/* Function to generate order invoice pdf */
function generateOrderInvoicePDF($order_invoice_built_content,$orderInvoicePDFFileName) {
	// $html2pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF-8', array(0, 0, 0, 0));
	// $html2pdf->setDefaultFont(null);
 //    $html2pdf->pdf->SetDisplayMode('fullpage');
 //    $html2pdf->writeHTML($order_invoice_built_content);
 //    $html2pdf->output(__DIR__.'/../'.$orderInvoicePDFFileName,'F');

    // instantiate and use the dompdf class
	$dompdf = new Dompdf();
	$dompdf->loadHtml($order_invoice_built_content);

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'portrait');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	// $dompdf->stream();
	$output = $dompdf->output();
	file_put_contents(__DIR__.'/../'.$orderInvoicePDFFileName, $output);
	// echo "<script>window.open('".HOME_URL.$orderInvoicePDFFileName."', '_blank');</script>";
	echo '<script type="text/javascript" language="Javascript">window.open("'.HOME_URL.$orderInvoicePDFFileName.'");</script>';
}
function sendSMS($p_id,$phone_number,$SURVEY_LINK) {
	$invite_sms_text = get_setting_meta('invite_sms_text');
	$invite_sms_text=str_replace("{{SURVEY_LINK}}", $SURVEY_LINK, $invite_sms_text);
	$invite_sms_text=str_replace("{{PARTICIPANT_ID}}", $p_id, $invite_sms_text);
	$phone_number = str_replace(" ","",$phone_number);
	$sid = get_setting_meta('twilio_key');
	$token = get_setting_meta('twilio_secret');
	$client = new Client($sid, $token);
	try {
		$client->messages->create($phone_number, array(
			'from' => get_setting_meta('twilio_number') ,
			'body' => $invite_sms_text
		));
		return true;
	}
	catch(Exception $e) {
		return false;
	}
}
function sendMMS($phone_number,$msg,$media) {
	$phone_number = str_replace(" ","",$phone_number);
	$sid = get_setting_meta('twilio_key');
	$token = get_setting_meta('twilio_secret');
	$client = new Client($sid, $token);
	$client->messages->create(
		$phone_number,
		array(
			'from' => get_setting_meta('twilio_number'),
			'body' => $msg,
			'mediaUrl' => $media,
		)
	);
}
function updateuser($request) {
	global $db,$app;
	$request = $db->realEscapeRequest($request);
	$sql = "UPDATE `user` SET `phone_number` = '".$request['phone_number']."'  WHERE id=".$request['user_id'];
	$db->query($sql);
	return true;
}
function updateAdminDetails($request) {
	global $db,$app;
	$request = $db->realEscapeRequest($request);
	$passwordSet = "";
	if(!empty($request['password'])) {
		$passwordSet = ",`password`='".encrypt($request['password'])."'";
	}
	$sql = "UPDATE `users` SET `username` = '".$request['username']."'".$passwordSet." WHERE id=".$request['admin_id'];
	$db->query($sql);
	return true;
}
function updateSettings($request,$files = array()) {
	global $db,$app;
	$request = $db->realEscapeRequest($request);
	if(!empty($files['logo']['name']))
	{
		$path_parts = pathinfo($files['logo']['name']);
		$extension = $path_parts['extension'];
		$filename = $path_parts['filename'].'_'.uniqid().'.'.$extension;
		$destination_dir = "assets/img/logos/";
		$destination_path = $destination_dir.$filename;

		if(!in_array($extension,explode(',',APP_LOGO_ALLOWED_EXTENSIONS))) {
			return array('status' => 'failed','msg' => 'Please upload image type of file.');
		}
		else {
			foreach(glob($destination_dir.'*.*') as $file) {
				if(is_file($file))
					@unlink($file);
			}
			move_uploaded_file($files['logo']['tmp_name'],$destination_path);
			$sql = "UPDATE `app_settings` SET `value` = '".$filename."' WHERE name='logo'";
			$db->query($sql);
		}
	}

	$sql = "UPDATE `app_settings` SET `value` = '".$request['app_name']."' WHERE name='app_name'";
	$db->query($sql);
	$sql = "UPDATE `app_settings` SET `value` = '".$request['app_contact_number']."' WHERE name='app_contact_number'";
	$db->query($sql);
	$sql = "UPDATE `app_settings` SET `value` = '".$request['app_address']."' WHERE name='app_address'";
	$db->query($sql);

	$sql = "UPDATE `app_settings` SET `value` = '".$request['twilio_key']."' WHERE name='twilio_key'";
	$db->query($sql);
	$sql = "UPDATE `app_settings` SET `value` = '".$request['twilio_secret']."' WHERE name='twilio_secret'";
	$db->query($sql);
	$sql = "UPDATE `app_settings` SET `value` = '".$request['twilio_number']."' WHERE name='twilio_number'";
	$db->query($sql);

	return array('status' => 'success','msg' => 'Settings uploaded successfully.');
}
function deleteuser($id) {
	global $db;
	$sql = "DELETE FROM `user` WHERE id=".$id;
	$db->query($sql);
}
function check_user_exists($user_id) {
	global $db;
	$sql = 'SELECT * FROM `user` WHERE id='.$user_id;
	$result = $db->query($sql);
	if($db->numRows($result) == 0) {
		return false;
	}
	else {
		return true;
	}
}
function showTabActive($url,$tabs) {
	$showActive = false;
	foreach($tabs as $key => $tab) {
		if(strpos($url, $tab) !== FALSE) {
			$showActive = true;
			break;
		}
	}
	return $showActive;
}
function checkOtp($request) {
	global $db,$app;
	$client_id=$app->getSession('client_id');
	$sql = 'SELECT * FROM `clients` WHERE otp="'.$request['otp'].'" AND id="'.$client_id.'"';
	$result = $db->query($sql);
	if($db->numRows($result) == 0) {
		return false;
	}
	else {
		$pin = mt_rand(1000, 9999);
		$sql = "UPDATE `clients` SET `status` = '1', `otp` = ".$pin." WHERE id=".$client_id;
		$db->query($sql);
		$app->removeSession('otp');
		return true;
	}
}
function setQueryParamsForPagination($server_query_string) {
	$params = explode("&",$server_query_string);
	foreach ($params as $key => $param) {
		$param_pair = explode("=",$param);
		if($param_pair[0] == 'page') {
			unset($params[$key]);
		}
	}
	$prev_query_string_params = implode("&",$params);
	return $prev_query_string_params;
}

function getDistanceBetweenPoints($lat1, $lon1, $lat2, $lon2) {
    $theta = $lon1 - $lon2;
    $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
    $miles = acos($miles);
    $miles = rad2deg($miles);
    $miles = $miles * 60 * 1.1515;
    $feet = $miles * 5280;
    $yards = $feet / 3;
    $kilometers = $miles * 1.609344;
    $meters = $kilometers * 1000;
    return compact('miles','feet','yards','kilometers','meters'); 
}

function getLatLong($address) {
	$url = "https://maps.google.com/maps/api/geocode/json?key=".MAP_API_KEY."&address=".urlencode($address);
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
	$responseJson = curl_exec($ch);
	curl_close($ch);

	$response = json_decode($responseJson);

	if ($response->status == 'OK') {
	    $latitude = $response->results[0]->geometry->location->lat;
	    $longitude = $response->results[0]->geometry->location->lng;
	    return array('status' => 'success', 'lat' => $latitude, 'long' => $longitude);
	    // echo 'Latitude: ' . $latitude;
	    // echo '<br />';
	    // echo 'Longitude: ' . $longitude;
	}
	else {
		return array('status' => 'fail', 'lat' => 0, 'long' => 0);
	    // echo $response->status;
	    // var_dump($response);
	}
}

//Get Orders
function getOrders() {
	global $db,$app;
	$orderInfo = array();
	$where = " WHERE 1=1";
	if(getUserRole($app->getSession('loggedin')) == 'deliveryboy') {
		$where = " WHERE deliveryboy_id=".$app->getSession('loggedin')."";
	}
	$sql = "SELECT * FROM `orders` o LEFT JOIN `order_items` oi ON oi.order_id = o.id ".$where." ORDER BY o.id DESC";
	$orderInfo = $db->get($db->query($sql));
	return $orderInfo;
}

//Update Order Status
function changeOrderStatus($order_id, $status) {
	global $db,$app;
	$sql = "UPDATE `orders` SET `order_status` = '".$status."'  WHERE id=".$order_id;
	if($db->query($sql)) {
		SystemLog($app->getSession('loggedin'), $order_id, "Order status changed to $status.");
	}
	return true;
}

function uploadChatAttachment($files) {
	global $db,$app;
	if(!empty($files['chat-attachment']['name']))
	{
		$path_parts = pathinfo($files['chat-attachment']['name']);
		$extension = $path_parts['extension'];
		$filename = $path_parts['filename'].'_'.uniqid().'.'.$extension;
		$destination_dir = "assets/img/chat-attachments/";
		$destination_path = $destination_dir.$filename;

		$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
		if(!move_uploaded_file($files['chat-attachment']['tmp_name'],$destination_path)) {
			return '';
		}
		else {
			// return $protocol.$_SERVER['SERVER_NAME']."/".$destination_path;
			return $destination_path;
		}
	}
	else {
		return '';
	}
}

function get_client_chat($order_id) {
	global $db,$app;
	$sql = "SELECT * FROM `chat` WHERE order_id = '$order_id' ORDER BY ID ASC";
	$result = $db->get($db->query($sql));
	return $result;
}

function add_chat_message($order_id = '',$user_from,$user_to,$message = array('body' => '','MediaUrl' => ''),$sendable = TRUE) {
	global $db,$app;
	
	$body = $db->realEscape($message['body']);
	$MediaUrl = $db->realEscape($message['MediaUrl']);

	$sql = "INSERT INTO `chat`(`order_id`,`user_to`,`user_from`,`message`,`mediaUrl`) VALUES('".$order_id."','".$user_to."', '".$user_from."','".$body."','".$MediaUrl."')";
	$db->query($sql);
}

function get_order_username($order_id, $field) {

	global $db;
	$sql = "SELECT bill_to FROM `orders` WHERE order_no ='$order_id'";
	$result = $db->query($sql);
	$row = $db->getOne($result);
	return $row->$field;
}

function get_deliveryboy_details($limited = false,$offset = 0,$limit = 0,$searchWith = '') {
		global $db,$app;
		$limitedSql = "";
		//$where = "";
		 $where = " WHERE type=2";
		if(!empty($searchWith)) {
			$where.= " AND name LIKE '%".$searchWith."%'";
		}
		if($limited) {
			$limitedSql = " LIMIT ".$offset.",".$limit;
		}

		$sql = 'SELECT * FROM `users` '.$where.' ORDER BY id DESC'.$limitedSql;
		
		$result = $db->get($db->query($sql));
		
		return $result;
}

/* GEt user type */
function getUserRole($userId) {
	global $db,$app;
	$sql = "SELECT type FROM `users` WHERE id=".$userId."";
	$result = $db->getOne($db->query($sql));
	if($result->type == 1) {
		return 'admin';
	} else {
		return 'deliveryboy';
	}
}

/* Add System Log */
function SystemLog($userId,$orderId,$msg) {
	global $db,$app;
	$sql = "INSERT INTO `deliveryboys_logs` (userid,orderid,message) VALUES (".$userId.", ".$orderId.", '".$msg."')";
	$db->query($sql);
}

/* Send Notification */
function sendNotificationViaSms($phone_number,$msg) {
	$invite_sms_text = $msg;
	$phone_number = str_replace(" ","",$phone_number);
	$sid = get_setting_meta('twilio_key');
	$token = get_setting_meta('twilio_secret');
	$client = new Client($sid, $token);
	try {
		$client->messages->create("+91".$phone_number, array(
			'from' => get_setting_meta('twilio_number'),
			'body' => $invite_sms_text
		));
		return true;
	}
	catch(Exception $e) {
		return false;
	}
}
?>