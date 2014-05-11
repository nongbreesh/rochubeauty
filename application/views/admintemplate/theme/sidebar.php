
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo base_url() ?>/public/admin/img/avatar3.png" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>Hello, <?= $account['admin_username'] ?></p>

                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search..."/>
                    <span class="input-group-btn">
                        <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li <?= is_menu_active($menu, "home"); ?>>
                    <a href="<?= base_url('administrator') ?>">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li  <?= is_menu_active($menu, "items", "treeview"); ?>  class="treeview">
                    <a href="#">
                        <i class="fa fa-bars"></i>
                        <span>Items</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= base_url('administrator') ?>/category"><i class="fa fa-angle-double-right"></i> Categories</a></li>
                        <li><a href="<?= base_url('administrator') ?>/product"><i class="fa fa-angle-double-right"></i> Products</a></li>
                       <!-- <li><a href="<?= base_url('administrator') ?>/recycle"><i class="fa fa-trash-o"></i> Recycle bin</a></li> -->
                    </ul>
                </li>

                <li <?= is_menu_active($menu, "order"); ?>>
                    <a href="<?= base_url('administrator') ?>/order">
                        <i class="fa fa-shopping-cart"></i> <span>Orders</span>
                        <?php if (count($order) > 0): ?>
                            <small class="badge pull-right bg-red"><?= count($order) ?></small>
                        <?php endif; ?>

                    </a>
                </li>

                <li <?= is_menu_active($menu, "payment"); ?>>
                    <a href="<?= base_url('administrator') ?>/payment">
                        <i class="fa fa-money"></i> <span>Payment</span> 
                        <?php if (count($payment) > 0): ?>
                            <small class="badge pull-right bg-light-blue"><?= count($payment) ?></small>
                        <?php endif; ?>
                    </a>
                </li>

                <li <?= is_menu_active($menu, "task_pending"); ?>>
                    <a href="<?= base_url('administrator') ?>/task_pending">
                        <i class="fa  fa-laptop"></i> <span>Task pending</span> 

                        <?php if (count($orderList_wait_shipping) > 0): ?>
                            <small class="badge pull-right bg-yellow"><?= count($orderList_wait_shipping) ?></small>
                        <?php endif; ?>
                    </a>
                </li>
                <li <?= is_menu_active($menu, "summary_report"); ?>>
                    <a href="<?= base_url('administrator') ?>/summary_report">
                        <i class="fa  fa-trophy"></i> <span>Summary report</span> 
                    </a>
                </li>

                <li <?= is_menu_active($menu, "message"); ?>>
                    <a href="<?= base_url('administrator') ?>/message">
                        <i class="fa fa-comments-o"></i> <span>Message</span>
                        <?php if (count($contact) > 0): ?>
                            <small class="badge pull-right bg-yellow"><?= count($contact) ?></small>
                        <?php endif; ?>
                    </a>
                </li>




                <!-- <li class="treeview">
                     <a href="#">
                         <i class="fa fa-cogs"></i>
                         <span>Content manager</span>
                         <i class="fa  pull-right"></i>
                     </a>
                     <ul class="treeview-menu">
                         <li><a href="#"><i class="fa fa-angle-double-right"></i> Article list</a></li>
                         <li><a href="#"><i class="fa fa-angle-double-right"></i> Add Article</a></li>
                         <li><a href="#"><i class="fa fa-angle-double-right"></i> Home Article</a></li>
                     </ul>
                 </li>-->
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>