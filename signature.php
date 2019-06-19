<?php
	include_once('layouts/header.php'); // Include header
	if(empty($app->getSession('loggedin'))) {
		$app->redirect('login.php');
	}
$sign = '';
if(isset($_POST['hdnSignature']))
{
$sign = $_POST['hdnSignature'];
$path = "assets/img/chat-attachments/".$_GET['order_id']."_".date('Ymdhis').".png";
$sign = base64_decode($sign); //convert base64
file_put_contents($path, $sign); //save to file
//all done
$message = array(
'body' => 'Signature',
'MediaUrl' => $path
);
if($app->getSession('loggedin') == 1) {
$receiver = getOrderInfoByOrderNo($_GET['order_id'])->deliveryboy_id;
}
else {
$receiver = 1;
}
add_chat_message($_GET['order_id'],$app->getSession('loggedin'), $receiver, $message);
$message = json_encode(array('text' => 'Message has been successfully sent.','icon' => 'fa-check','type' => 'success'));
$app->redirect('chat.php?order_id='.$_GET['order_id']);
// header('location:chat.php?order_id="'.$_GET['order_id'].'"');
}
?>
<style type="text/css">
	div {
		margin-top:1em;
		margin-bottom:1em;
	}
	input {
		padding: .5em;
		margin: .5em;
	}
	select {
		padding: .5em;
		margin: .5em;
	}
	
	#signatureparent {
		color:white;
		background-color:darkgrey;
		/*max-width:600px;*/
		padding:20px;
	}
	
	/*This is the div within which the signature canvas is fitted*/
	#signature {
		border: 2px dotted black;
		background-color:darkslategrey;
	}
	/* Drawing the 'gripper' for touch-enabled devices */
	html.touch #content {
		float:left;
		width:92%;
	}
	html.touch #scrollgrabber {
		float:right;
		width:4%;
		margin-right:2%;
		background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAAFCAAAAACh79lDAAAAAXNSR0IArs4c6QAAABJJREFUCB1jmMmQxjCT4T/DfwAPLgOXlrt3IwAAAABJRU5ErkJggg==)
	}
	html.borderradius #scrollgrabber {
		border-radius: 1em;
	}
	
</style>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<div class="row">
							<div class="col-sm-12">
								<h4 class="title">Signature </h4>
								
								<div>
									<div id="content">
										<div id="signatureparent">
											
											<form method="post">
												<div id="signature"></div>
												<input type="hidden" name="hdnSignature" id="hdnSignature" />
												<input type="button" id="btn_submit" class="btn btn-primary btn-fill" value="Upload Custemer Signature" />
												<input type="button" class="btn btn-default" id="reset_btn" value="Reset" />
												<a class='btn btn-danger pull-right' target='_blank' href="<?php echo HOME_URL ?>chat.php?order_id=<?php echo $_GET['order_id']; ?>">Back to chat</a>
											</form>

										</div>
										<div id="tools"></div>
										
									</div>
									<div id="scrollgrabber"></div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
<script src="assets/jSignature-master/libs/jquery.js"></script>
<?php
include_once('layouts/footer.php');
?>
<script src="assets/jSignature-master/libs/jSignature.min.noconflict.js"></script>
<script type="text/javascript">
jQuery.noConflict()
</script>
<script>
(function($){
var $sigdiv = $("#signature");
$sigdiv.jSignature();
$('#btn_submit').click(function () {
var datapair = $sigdiv.jSignature("getData", "image");
$('#hdnSignature').val(datapair[1]);

document.forms[0].submit();
});
$('#reset_btn').click(function () {
	$sigdiv.jSignature("reset")
});
})(jQuery)
</script>