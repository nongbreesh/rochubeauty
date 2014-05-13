<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin Rochu</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo base_url() ?>/public/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo base_url() ?>/public/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url() ?>/public/admin/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="<?php echo base_url() ?>/public/admin/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="<?php echo base_url() ?>/public/admin/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="<?php echo base_url() ?>/public/admin/css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?php echo base_url() ?>/public/admin/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php echo base_url() ?>/public/admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url() ?>/public/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="<?php echo base_url() ?>/public/js/jquery-1.7.2.min.js" rel="stylesheet"></script>  

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>


    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?= base_url('administrator') ?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Admin Rochu
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <?php if (count($contact) > 0): ?>
                                    <span class="label label-success"><?= count($contact) ?></span>
                                <?php endif; ?>
                            </a>
                            <ul class="dropdown-menu">

                                <li class="header">You have <?= count($contact) ?> messages</li>

                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <?php foreach ($contact as $row): ?>
                                            <li><!-- start message -->
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="<?php echo base_url() ?>/public/admin/img/default_avatar.png" class="img-circle" alt="User Image"/>
                                                    </div>
                                                    <h4>
                                                        <?= $row->full_name ?>
                                                        <small><i class="fa fa-clock-o"></i> <?= time_ago($row->timestamp) ?></small>
                                                    </h4>
                                                    <p>  <?= $row->message ?></p>
                                                </a>
                                            </li><!-- end message -->
                                        <?php endforeach; ?>

                                    </ul>
                                </li>
                                <li class="footer"><a href="<?php echo base_url('administrator') ?>/message">See All Messages</a></li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <!-- <li class="dropdown notifications-menu">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                 <i class="fa fa-warning"></i>
                                 <span class="label label-warning">10</span>
                             </a>
                             <ul class="dropdown-menu">
                                 <li class="header">You have 10 notifications</li>
                                 <li>-->
                        <!-- inner menu: contains the actual data -->
                        <!--   <ul class="menu">
                            <li>
                                <a href="#">
                                    <i class="ion ion-ios7-people info"></i> 5 new members joined today
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-warning danger"></i> Very long description here that may not fit into the page and may cause design problems
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-users warning"></i> 5 new members joined
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="ion ion-ios7-cart success"></i> 25 sales made
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="ion ion-ios7-person danger"></i> You changed your username
                                </a>
                            </li>
                        </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                    </li>-->

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?= $account['admin_fullname'] ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo base_url() ?>/public/admin/img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <?= $account['admin_username'] ?>  - <?= $account['admin_fullname'] ?>
                                        <small>Lastest logout <?= time_ago($account['admin_logout']) ?></small>
                                    </p>
                                </li>

                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url() ?>logout" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>