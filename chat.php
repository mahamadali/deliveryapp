<?php 
	include_once('layouts/header.php'); // Include header
	if(empty($app->getSession('loggedin'))) {
		$app->redirect('login.php');
	}

  $order_id=getOrderId($_GET['order_id']);

	if(empty($message['text']) && !empty($app->getSession('message'))) {
		$message = $app->getSession('message');
		$app->removeSession('message');
	}

  if(!empty($_POST['message']) || !empty($_FILES['chat-attachment']['name'])) {
    $_POST['message'] = (empty($_POST['message']))?'':$_POST['message'];
    $mediaUrl = uploadChatAttachment($_FILES);
    $message = array(
      'body' => $_POST['message'],
      'MediaUrl' => $mediaUrl
    );

    if($app->getSession('loggedin') == 1) {
      $receiver = getOrderInfoByOrderNo($_GET['order_id'])->deliveryboy_id;
    }
    else {
      $receiver = 1;
    }
    add_chat_message($_GET['order_id'],$app->getSession('loggedin'), $receiver, $message);
    $message = json_encode(array('text' => 'Message has been successfully sent.','icon' => 'fa-check','type' => 'success'));
  }

  $client_chat = get_client_chat($_GET['order_id']);

  if(isset($_POST['btnordercomplete'])) {
   changeOrderStatus($order_id,'D');
   $message = json_encode(array('text' => 'Order has been successully delivered.','icon' => 'fa-check','type' => 'success'));
  }
  if(isset($_POST['btnordercancel'])) {
   changeOrderStatus($order_id,'C');
   $message = json_encode(array('text' => 'Order has been been cancelled from customer.','icon' => 'fa-check','type' => 'success'));
  }
  if(isset($_POST['btnorderreturn'])) {
   changeOrderStatus($order_id,'R');
   $message = json_encode(array('text' => 'Order has been returned back from customer.','icon' => 'fa-check','type' => 'success'));
  }

 $orderInfo = getOrderInfo($order_id);

 ?>
 <link rel="stylesheet" type="text/css" href="assets/css/chat.css">
 <div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="header">
            <div class="row">
              <div class="col-sm-9">
                <h4 class="title">Chat (
                  <?php
                  if(getUserRole($app->getSession('loggedin')) == 'admin') {
                    echo ucfirst(getDeliveryBoyInfo(getOrderInfoByOrderNo($_GET['order_id'])->deliveryboy_id)->name); 
                  ?> , <a href="tel:+ <?php echo getDeliveryBoyInfo(getOrderInfoByOrderNo($_GET['order_id'])->deliveryboy_id)->contact; ?>"><?php echo getDeliveryBoyInfo(getOrderInfoByOrderNo($_GET['order_id'])->deliveryboy_id)->contact; ?></a>

                  <?php 
                   }
                  else {
                    echo get_admin_meta(1, 'contact');
                  }

                  ?>
                )</h4>
                <!--    <p class="category">Client chat</p> -->
              </div>
            </div>
          </div>
          <div class="content table-responsive table-full-width">
            <div class="chat-container">
              <?php 
              foreach ($client_chat as $key => $messageInfo) {
                $body = $messageInfo->message;
                $mediaUrl = $messageInfo->mediaUrl;
                ?>
                <div class="row">
                  <?php 
                  $bubbleDirection = (!empty($messageInfo->user_from) && $messageInfo->user_from == $app->getSession('loggedin'))?'right':'left';
                  $bubbleDirectionTop = (!empty($messageInfo->user_from) && $messageInfo->user_from == $app->getSession('loggedin'))?'right':'left';
                  $sender = (!empty($messageInfo->user_from) && $messageInfo->user_from == $app->getSession('loggedin'))?'sender':'';
                  ?>
                  <div class="talk-bubble tri-right <?php echo $bubbleDirection; ?>-in <?php echo $sender; ?> chat-block col-md-6 ml-3 pull-<?php echo $bubbleDirection; ?>">
                    <div class="talktext">
                      <p>
                        <?php echo $body; ?>
                      </p>
                      <?php 
                      if(!empty($mediaUrl)) {
                        ?>
                        <p>
                          <?php
                          echo "<img src='".$mediaUrl."' width='190px' /><br /><a href='".$mediaUrl."' target='_blank'><i class='ti-link'></i> Click here to open</a>";
                          ?>
                        </p>
                      <?php } ?>
                      <br />
                      <p class="date"><?php echo date('d M Y h:i:s',strtotime($messageInfo->created_at)); ?></p>
                    </div>
                  </div>
                </div>
                <?php
              }
              ?>
            </div>
            <div class="mt-1">
              <hr class="chat-seperator">
            </div>
            <?php 
              if($orderInfo->order_status == 'P') {
            ?>
            <form method="post" action="" enctype="multipart/form-data">
              <div class="row ml-1 mr-1">
                <div class="col-md-7">
                  <input type="text" autocomplete="off" name="message" class="form-control border-input" placeholder="Send Reply" />
                </div>
                <div class="col-md-1">
                  <div style="height:0px;overflow:hidden">
                    <input type="file" name="chat-attachment" id="chat-attachment" accept="image/*" />
                  </div>
                  <span class="chat-attachment-link" onclick="chooseFile();"><i class="ti-link"></i></span>
                </div>
                <div class="col-md-2 mr-1">
                  <a href=<?php echo HOME_URL ?>signature.php?order_id=<?php echo $_GET["order_id"]; ?>  class="btn btn-success btn-fill border-input">Signature&nbsp;&nbsp;<i class="ti-arrow-circle-right"></i></a>
                </div>
                <div class="col-md-1 mr-1">
                  <button type="submit" name="sendMsg" class="btn btn-success btn-fill border-input">Send&nbsp;&nbsp;<i class="ti-arrow-circle-right"></i></button>
                </div>
                
              </div>
              <div class="mt-1">
                <hr class="chat-seperator">
              </div>
              <div class="row">
                <div class="col-md-12 text-center">
                  <button type="submit" name="btnordercomplete" onclick="return confirm('Are you sure want to complete order #<?php echo $_GET['order_id'] ?>?')" class="btn btn-success btn-fill border-input order_complete">COMPLETE</button>
                  <button type="submit" name="btnordercancel" onclick="return confirm('Are you sure want to cancel order #<?php echo $_GET['order_id'] ?>?')" class="btn btn-danger btn-fill border-input order_complete">CANCEL</button>
                  <button type="submit" name="btnorderreturn" onclick="return confirm('Are you sure want to return order #<?php echo $_GET['order_id'] ?>?')" class="btn btn-default btn-fill border-input order_complete">RETURN</button>
                </div>
              </div>
            </form>
            <?php } else if($orderInfo->order_status == 'D') {
              ?>
              <div class="row">
                  <div class="col-md-12 text-center">
                  <button type="button" class="btn btn-default btn-fill border-input order_complete btn-lg">ORDER DELIVERED</button>
                </div>
              </div>
              <?php
            } else if($orderInfo->order_status == 'C') { ?>
              <div class="row">
                  <div class="col-md-12 text-center">
                  <button type="button" class="btn btn-default btn-fill border-input order_complete btn-lg">ORDER CANCELLED</button>
                </div>
              </div>
            <?php } else if($orderInfo->order_status == 'R') { ?>
            <div class="row">
                  <div class="col-md-12 text-center">
                  <button type="button" class="btn btn-default btn-fill border-input order_complete btn-lg">ORDER RETURNED</button>
                </div>
              </div>
            <?php } ?>
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
    $(document).ready(function() {

     $('#order_complete').click(function () {
      $sigdiv.jSignature("reset")
    });


     var current_total_messages = '<?php echo count($client_chat); ?>';
     var order_id = '<?php echo $_GET["order_id"]; ?>';
     setInterval(function() {
      checkForNewMessage(current_total_messages,order_id)
    },2000);
     var d = $('.chat-container');
     d.scrollTop(d.prop("scrollHeight"));
   });
    function chooseFile() {
      $("#chat-attachment").click();
    }
    function checkForNewMessage(current_total_messages,order_id) {
      $.ajax({
        url : 'check_new_message.php',
        type : 'POST',
        data : {'current_total_messages':current_total_messages,'order_id':order_id},
        success : function(latest_total_messages) {
          if(latest_total_messages > current_total_messages) {
            window.location.href = 'chat.php?order_id='+order_id;
          }
        },
        error : function(error) {
          console.log(error); 
        }
      });
    }
  </script>