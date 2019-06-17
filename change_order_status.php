<?php
include_once('include.php');
if(isset($_POST['order_id'])) {
	$updated = changeOrderStatus($_POST['order_id'], $_POST['status']);
	if($updated) {
		echo json_encode(array('status' => 'success'));
	}
}