<?php 
	include_once('layouts/header.php'); // Include header
	if(empty($app->getSession('loggedin'))) {
		$app->redirect('index.php');
	}
	if(!empty($_POST['btnSubmitEditAdminSettings'])) {
		$updateAdminDetails = updateAdminDetails($_POST);
		$message = json_encode(array('text' => 'Admin details have been successfully updated.','icon' => 'fa-check','type' => 'success'));
			$app->setSession('message',$message);
	}
?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title">Hello <?php echo ucfirst(get_admin_meta($app->getSession('loggedin'), 'username')); ?></h4>
						<p class="category">Adminstration panel</p>
					</div>
					<div class="content">
						<form method="post" action="" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Admin Email</label>
										<input type="text" class="form-control border-input" value="<?php echo get_admin_meta($app->getSession('loggedin'),'username'); ?>" name="username">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Admin Password</label>
										<input type="password" class="form-control border-input" value="" name="password">
										<input type="hidden" name="admin_id" value="<?php echo $app->getSession('loggedin'); ?>" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<br />
									<button type="submit" name="btnSubmitEditAdminSettings" value="btnSubmitEditAdminSettings" class="btn btn-info btn-fill btn-wd">Edit Settings</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	include_once('layouts/footer.php'); // Include header
?>