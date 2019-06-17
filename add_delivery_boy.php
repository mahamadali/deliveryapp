<?php
include_once('layouts/header.php'); // Include header
if(empty($app->getSession('loggedin'))) {
	$app->redirect('index.php');
}
if(!empty($_POST['btnSubmitAddDeliveryBoy'])) {
	addDeliveryBoy($_POST);
	$message = json_encode(array('text' => 'Delivery boy successully added to the system.','icon' => 'fa-check','type' => 'success'));
	$app->setSession('message',$message);
	$app->redirect('delivery_boys.php');
}
?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title">Add Delivery Boy</h4>
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
										<input type="text" class="form-control border-input" placeholder="Delivery Boy Name" name="delivery_boy_name">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Contact Number</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control border-input" placeholder="Delivery Boy Contact Number" name="delivery_boy_contact_number">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Email</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control border-input" placeholder="Delivery Boy Email" name="delivery_boy_email">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Password</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control border-input" placeholder="Delivery Boy Password" name="delivery_boy_password">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<button type="submit" name="btnSubmitAddDeliveryBoy" value="btnSubmitAddDeliveryBoy" class="btn btn-info btn-fill btn-wd">Add Delivery Boy</button>
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