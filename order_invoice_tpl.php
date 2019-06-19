<?php
	include_once('include.php'); // Include required core files
	if(empty($_GET['order_id'])) {
		dd('Invalid access');
	}
	else {
		$order_id = $_GET['order_id'];
		$orderInfo = getOrderInfo($order_id);
		$order_items = unserialize($orderInfo->items);
		// dump($order_items);
	}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $orderInfo->order_no; ?> for <?php echo $orderInfo->bill_to; ?></title>
		
		<style>
			body {
				font-family: 'times';
			}
			.invoice-table {
				padding: 10px;
				border-collapse: collapse;
			}
			.rtl {
				float: right;
			}
			.mt-1 {
				margin-top: 1em !important;
			}
			.no-border {
				border-color: transparent;
			}
		</style>
	</head>
	<body>
		<div class="">

			<table align="center" cellpadding="10" cellspacing="10" class="invoice-table" style="width: 100%;padding: 10px;">
				<tr class="">
					<td colspan="3">
						<table style="width: 100%">
							<tr class="mt-1">
								<td class="" style="width: 60%">
									<img src="assets/img/logos/<?php echo get_setting_meta('logo'); ?>" style="height: 70px">
								</td>
								<td class="rtl" valign="top">
									Order #: <?php echo $orderInfo->order_no; ?><br>
									Created: <?php echo $orderInfo->created_at; ?><br>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				
				<tr class="">
					<td colspan="3">
						<table style="width: 100%;">
							<tr>
								<td>
									{{APP_NAME}}<br>
									{{APP_ADDRESS_LINE_1}}<br>
									{{APP_CONTACT_NUMBER}}
								</td>
								
								<td class="rtl">
									{{bill_to}}<br>
									{{order_from}} to {{order_to}}<br>
									<?php echo $orderInfo->customer_phone_number; ?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td><b>Delivery Boy : </b>{{deliveryboy_id}} ( <a href="tel:+ {{deliveryboy_contact}}">{{deliveryboy_contact}}</a>  )</td>
				</tr>
				<tr>
					<td><h4>Order Items</h4></td>
				</tr>
				<tr>
					<td colspan="3">
						<table width="100%" cellpadding="10" cellspacing="10" class="invoice-table" style="text-align: center;border-collapse: collapse;" border="1">
							<tr>
								<th>#</th>
								<th>Item</th>
								<th>Quantity</th>
								<th>Note</th>
							</tr>
							<?php
							$index = 0;
							$counter = 1;
							foreach ($order_items['item'] as $key => $value) {
								echo "<tr>
										<td>".$counter."</td>
										<td>".$value."</td>
										<td>".$order_items['qty'][$index]."</td>
										<td>".$order_items['note'][$index]."</td>
									</tr>";
								$counter++;
								$index++;
							}
							?>
						</table>
					</td>
				</tr>
				<tr class="">
					<td class="no-border" colspan="2"></td>
					<td class="rtl">
						Delivery Charge: {{delivery_charge}} <span>	INR </span>
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>