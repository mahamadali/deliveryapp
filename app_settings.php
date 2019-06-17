	
<?php
include_once('layouts/header.php'); // Include header

if(empty($app->getSession('loggedin'))) {
	$app->redirect('login.php');
}

if(empty($message['text']) && !empty($app->getSession('message'))) {
	$message = $app->getSession('message');
	$app->removeSession('message');
}

if(!empty($_POST['btnSubmitEditAppSettings'])) {
	$settingsResponse = updateSettings($_POST,$_FILES);
	
	if(!empty($settingsResponse) && $settingsResponse['status'] == 'failed') {
		$message = json_encode(array('text' => $settingsResponse['msg'],'icon' => 'fa-check','type' => 'danger'));
	}
	else {
		$message = json_encode(array('text' => $settingsResponse['msg'],'icon' => 'fa-check','type' => 'success'));
		$app->setSession('message',$message);
		$app->redirect('app_settings.php');
	}
}

?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title">Edit Setting</h4>
						<p class="category"><?php echo ucfirst(strtolower(SITE_TITLE)); ?> settings panel</p>
					</div>
					<div class="content">
						<form method="post" action="" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-3">
									<img src="assets/img/logos/<?php echo get_setting_meta('logo'); ?>" class="img-responsive" id="app_logo" />
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Update Logo</label>
										<input type="file" class="form-control border-input" placeholder="Select logo" name="logo">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>App Name</label>
										<input type="text" class="form-control border-input" value="<?php echo get_setting_meta('app_name'); ?>"  name="app_name">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>App Address</label>
										<input type="text" class="form-control border-input" value="<?php echo get_setting_meta('app_address'); ?>"  name="app_address">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>App Contact Number</label>
										<input type="text" class="form-control border-input" value="<?php echo get_setting_meta('app_contact_number'); ?>"  name="app_contact_number">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Twilio Key</label>
										<input type="text" class="form-control border-input" value="<?php echo get_setting_meta('twilio_key'); ?>"  name="twilio_key">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Twilio Secret</label>
										<input type="text" class="form-control border-input" value="<?php echo get_setting_meta('twilio_secret'); ?>" name="twilio_secret">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Twilio Number</label>
										<input type="text" class="form-control border-input" value="<?php echo get_setting_meta('twilio_number'); ?>" name="twilio_number">
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-3">
									<br />
									<button type="submit" name="btnSubmitEditAppSettings" value="btnSubmitEditAppSettings" class="btn btn-info btn-fill btn-wd">Edit Settings</button>
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