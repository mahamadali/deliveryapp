<?php
	include_once('layouts/header.php'); // Include header
	if(empty($app->getSession('loggedin'))) {
		$app->redirect('index.php');
	}
	if(!empty($_POST['btnGenerateOrder'])) {
		$orderInfo = generateOrder($_POST);
		$message = json_encode(array('text' => 'Order with '.$orderInfo->order_no.' has been successuly created.','icon' => 'fa-check','type' => 'success'));
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
							<p class="category">Create Order</p>
						</div>
						<div class="content">
							<form method="post" action="" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Customer name</label>
											<input type="text" name="bill_to" class="form-control border-input" />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Customer phone number</label>
											<input type="text" name="customer_phone_number" class="form-control border-input" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Order From</label>
											<input type="text" name="order_from" class="form-control border-input" id="fromAddress" onFocus="geolocate()" />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Order To</label>
											<input type="text" name="order_to" class="form-control border-input" id="toAddress" onFocus="geolocate()" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Special note</label>
											<textarea class="form-control border-input" rows="6" name="orderSpecialNote"></textarea>
										</div>
									</div>
								</div>
								<table class="table table-striped orderTable">
									<caption>Order Items</caption>
									<tr class="item-row">
										<td>
											<input type="text" name="orderItemName[]" class="form-control border-input" placeholder="Item Name" />
										</td>
										<td>
											<input type="text" name="orderItemQuantity[]" class="form-control border-input" placeholder="Quantity" />
										</td>
										<td>
											<input type="text" name="orderItemSpecialNote[]" class="form-control border-input" placeholder="Item Special Note">
										</td>
										<td>
											<button type="button" class="btn btn-fill btn-xs btn-info btn-add-item"><i class="ti-plus"></i></button>
										</td>
									</tr>
									<tr>
										<td colspan="3">
											<input type="submit" name="btnGenerateOrder" class="btn btn-primary btn-fill pull-right" value="Generate Order" />
										</td>
									</tr>
								</table>
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
	<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo MAP_API_KEY ?>&libraries=places&sensor=false"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/geocomplete/1.7.0/jquery.geocomplete.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('body').on('click','.btn-add-item',function() {
				var clone = $(".item-row:first").clone();
				$(clone).find('td input').val('');
				clone.insertAfter('.item-row:last');
			});

			$("#fromAddress").geocomplete();
			$("#toAddress").geocomplete();

			$(window).keydown(function(event){
			    if(event.keyCode == 13) {
			      event.preventDefault();
			      return false;
			    }
			});
		});
	</script>