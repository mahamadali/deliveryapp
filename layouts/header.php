<?php
    include_once('include.php'); // Include all included files
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo SITE_TITLE; ?></title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <!-- Bootstrap core CSS     -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <!-- Animation library for notifications   -->
        <link href="assets/css/animate.min.css" rel="stylesheet"/>
        <!--  Paper Dashboard core CSS    -->
        <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>
        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="assets/css/demo.css" rel="stylesheet" />
        <!--  Fonts and icons     -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
        <link href="assets/css/themify-icons.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    </head>
    <body>
        <div class="wrapper">
            <div class="sidebar" data-background-color="white" data-active-color="danger">
                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a href="<?php echo SITE_URL; ?>" class="simple-text">
                            <img src="assets/img/logos/<?php echo get_setting_meta('logo'); ?>" class="img-responsive" /><?php echo get_setting_meta('app_name'); ?>
                        </a>
                    </div>
                    <ul class="nav">
                        <li class="<?php if(showTabActive($_SERVER['REQUEST_URI'],array('admin','index'))) { echo "active"; } ?>">
                            <a href="admin.php">
                                <i class="ti-panel"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <?php if(getUserRole($app->getSession('loggedin')) == 'admin'): ?>
                            <li class="<?php if(showTabActive($_SERVER['REQUEST_URI'],array('delivery_boys','add_delivery_boy','edit_delivery_boy'))) { echo "active"; } ?>">
                                <a href="delivery_boys.php">
                                    <i class="fa fa-motorcycle"></i>
                                    <p>Delivery Boys</p>
                                </a>
                            </li>
                        
                            <li class="<?php if(showTabActive($_SERVER['REQUEST_URI'],array('create_order','edit_order','chat'))) { echo "active"; } ?>">
                                <a href="create_order.php">
                                    <i class="fa fa-shopping-cart"></i>
                                    <p>Create Order</p>
                                </a>
                            </li>
                        <?php endif ?>
                        <li class="<?php if(showTabActive($_SERVER['REQUEST_URI'],array('orders'))) { echo "active"; } ?>">
                            <a href="orders.php">
                                <i class="fa fa-list"></i>
                                <p>Orders</p>
                            </a>
                        </li>
                        <?php if(getUserRole($app->getSession('loggedin')) == 'admin'): ?>
                            <li class="<?php if(showTabActive($_SERVER['REQUEST_URI'],array('app_settings'))) { echo "active"; } ?>">
                                <a href="app_settings.php">
                                    <i class="ti-settings"></i>
                                    <p>App settings</p>
                                </a>
                            </li>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
            <div class="main-panel">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar bar1"></span>
                            <span class="icon-bar bar2"></span>
                            <span class="icon-bar bar3"></span>
                            </button>
                            <a class="navbar-brand" href="#">Dashboard</a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="ti-settings"></i>
                                        <p>Settings</p>
                                        <ul class="dropdown-menu">
                                            <li><a href="logout.php">Logout</a></li>
                                        </ul>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>