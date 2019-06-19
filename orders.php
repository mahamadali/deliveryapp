<?php
	include_once('layouts/header.php'); // Include header
	if(empty($app->getSession('loggedin'))) {
		$app->redirect('index.php');
	}
	$orders = getOrders();
?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title">Hello <?php echo ucfirst(get_admin_meta($app->getSession('loggedin'), 'username')); ?></h4>
						<p class="category">Orders</p>
					</div>
					<div class="content table-responsive table-full-width">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Order No</th>
									<th>Customer</th>
									<th>Address</th>
									<th>Order Items</th>
									<th>Delivery Charge</th>
									<th>Order placed time</th>
									<th>Delivery Boy</th>
									<th>Status</th>
									<th>Processing</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$counter = 1;
								foreach ($orders as $key => $order) {
									$pSelected = '';
									$dSelected = '';
									$rSelected = '';
									$cSelected = '';
									if($order->order_status == 'P') {
										$pSelected = 'selected';
									} else if($order->order_status == 'D') {
										$dSelected = 'selected';
									} else if($order->order_status == 'R') {
										$rSelected = 'selected';
									} else {
										$cSelected = 'selected';
									}
									echo "<tr>
											<td>".$counter."</td>
											<td>".$order->order_no."</td>
											<td>".$order->bill_to."</td>
											<td>".$order->order_from." - ".$order->order_to."</td>
											<td><a class='btn btn-sm btn-warning' target='_blank' href='".HOME_URL."assets/order_invoice_pdfs/".$order->order_no.".pdf'>View</a></td>
											<td>".$order->delivery_charge." INR</td>
											<td>".$order->created_at."</td>
											<td>".(!empty(getDeliveryBoyInfo($order->deliveryboy_id)->name) ? getDeliveryBoyInfo($order->deliveryboy_id)->name : '-')."</td>
											<td>
											<select class='order_status' data-id='".$order->id."'>
											<option ".$pSelected." value='P'>Pending</option>
											<option ".$dSelected." value='D'>Delivered</option>
											<option ".$rSelected." value='R'>Returned</option>
											<option ".$cSelected." value='C'>Cancelled</option>
											</select
											</td>
											<td><a class='btn btn-sm btn-info' target='_blank' href='".HOME_URL."chat.php?order_id=".$order->order_no."'>View process</a></td>
										</tr>";
									$counter++;
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include_once('layouts/footer.php'); // Include header
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.order_status').change(function(){
			var order_id = $(this).data('id');
			var status = $(this).val();
			$.ajax({
			  type: "POST",
			  url: "change_order_status.php",
			  data: {
			  	order_id: order_id,
			  	status: status
			  },
			  cache: false,
			  success: function(data){
			     app.showNotification('top','center','Order status updated','info','info');
			  }
			});
		});
	});
</script>