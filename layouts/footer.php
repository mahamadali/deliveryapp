<footer class="footer">
    <div class="container-fluid">
        <nav class="pull-left">
            <ul>
                <li>
                    <a href="/">
                        <?php echo SITE_TITLE; ?>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="copyright pull-right">
            &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="/"><?php echo SITE_TITLE; ?></a>
        </div>
    </div>
</footer>
</div>
</div>
</body>
<!--   Core JS Files   -->
<script src="assets/js/jquery.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<!--  Checkbox, Radio & Switch Plugins -->
<!-- <script src="assets/js/bootstrap-checkbox-radio.js"></script> -->
<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>
<!--  Google Maps Plugin    -->
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> -->
<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="assets/js/paper-dashboard.js"></script>
<!-- App methods -->
<script src="assets/js/app.js"></script>
<script type="text/javascript">
$(document).ready(function(){
var message = JSON.parse('<?php echo $message; ?>');
if(message.text != '') {
app.showNotification('top','center',message.text,message.icon,message.type);
}
$(".confirm").on('click',function() {
if(!confirm('Are you sure want to delete?')) {
return false;
}
});
});
</script>
</html>