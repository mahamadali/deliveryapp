<?php
	include_once('layouts/header.php'); // Include header
	if(empty($app->getSession('loggedin'))) {
		$app->redirect('login.php');
	}
	if(empty($message['text']) && !empty($app->getSession('message'))) {
		$message = $app->getSession('message');
		$app->removeSession('message');
	}
	$searchWith = '';
	if(!empty($_GET['filter_keyword'])) {
		$searchWith = trim($_GET['filter_keyword']);
	}
	if(!empty($_GET['delete_id'])) {
		deleteDeliveryBoys($_GET['delete_id']);
		$message = json_encode(array('text' => 'Delivery boy successfully deleted.','icon' => 'fa-check','type' => 'danger'));
		$app->setSession('message',$message);
		$app->redirect('delivery_boys.php');
	}
	$deliveryboy_details = get_deliveryboy_details(false,NULL,NULL,$searchWith);
	$rec_count = count($deliveryboy_details);
	include_once('layouts/pagination-top.php');
	$deliveryboy_details = get_deliveryboy_details(true,$offset,$rec_limit,$searchWith);
?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<div class="row">
							<div class="col-sm-9">
								<h4 class="title">Delivery Boy Details</h4>
								<p class="category">Delivery Boy details list</p>
							</div>
							<div class="col-sm-3 pull-right">
								<a href="add_delivery_boy.php" class="btn btn-fill btn-primary pull-right"><span><i class="fa fa-plus"></i></span>&nbsp; Add New Delivery Boy </a>
							</div>
						</div>
					</div>
					<div class="content table-responsive table-full-width">
						<div class="row">
							<form method="" action="">
								<div class="col-md-3 ml-1">
									<input type="text" class="form-control border-input" name="filter_keyword" value="<?php if(!empty($_GET['filter_keyword'])) { echo $_GET['filter_keyword']; } else { echo ''; } ?>" placeholder="Filter by Name" />
								</div>
								<div class="col-md-3">
									<div class="form-grooup">
										<input type="submit" name="btnFilter" value="Search" class="btn btn-success" />
									</div>
								</div>
							</form>
						</div>
						<table class="table table-striped mt-2">
							<thead>
								<th>#</th>
								<th>Name</th>
								<th>Contact</th>
								<th>Email</th>
								<th>Action</th>
							</thead>
							<tbody>
								<?php
								if(count($deliveryboy_details) == 0) {
								?>
								<tr>
									<td colspan="4">No records found</td>
								</tr>
								<?php
								}
								else {
								$i=1;
								foreach ($deliveryboy_details as $key => $test_detail) {
								?>
								<tr>
									<td>
										<?php echo $i; ?>
									</td>
									<td>
										<?php echo $test_detail->name ?>
									</td>
									<td>
										<?php
											echo $test_detail->contact;
										?>
									</td>
									<td>
										<?php
											echo $test_detail->username;
										?>
									</td>
									<td>
										<a href="edit_delivery_boy.php?delivery_boy_id=<?php echo $test_detail->id; ?>" class="btn btn-info">Edit</a>
										<a href="?delete_id=<?php echo $test_detail->id; ?>" class="btn btn-danger confirm">Delete</a>
									</td>
								</tr>
								<?php
								$i++;
								}
								}
								?>
							</tbody>
						</table>
					</div>
					<?php include_once('layouts/pagination-links.php'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	include_once('layouts/footer.php'); // Include header
?>