<?php
include_once('layouts/header.php'); // Include header
if(empty($app->getSession('loggedin'))) {
	$app->redirect('index.php');
}
if(!empty($_POST['btnSubmitEditDeliveryBoy'])) {
	updateDeliveryBoy($_POST);
	$message = json_encode(array('text' => 'Delivery boy successully updated to the system.','icon' => 'fa-check','type' => 'success'));
	// $app->setSession('message',$message);
	// $app->redirect('delivery_boys.php');
}
if(!empty($_GET['delivery_boy_id'])) {
	$delivery_boy_info = getDeliveryBoyInfo($_GET['delivery_boy_id']);
}
else {
	dd('Visit to this page does not make sense.');
}
?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title">Edit Delivery Boy</h4>
						<p class="category">Delivery boys panel</p>
					</div>
					<div class="content">
						<form method="post" action="">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Name</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="hidden" name="id" value="<?php echo $delivery_boy_info->id; ?>" />
										<input type="text" class="form-control border-input" placeholder="Delivery Boy Name" name="delivery_boy_name" value="<?php echo $delivery_boy_info->name; ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Cotact Number</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control border-input" placeholder="Delivery Boy Contact Number" name="delivery_boy_contact_number" value="<?php echo $delivery_boy_info->contact; ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<button type="submit" name="btnSubmitEditDeliveryBoy" value="btnSubmitEditDeliveryBoy" class="btn btn-info btn-fill btn-wd">Edit Delivery Boy</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		include_once('layouts/footer.php'); // Include header
	?>