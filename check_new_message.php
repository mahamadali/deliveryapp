<?php

include(dirname(__FILE__).'/include.php');

echo $current_total_messages = count(get_client_chat($_POST['order_id']));
exit;

?>
