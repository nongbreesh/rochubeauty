

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?= number_format(count($order)) ?>
                        </h3>
                        <p>
                            New Orders
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="<?= base_url() ?>administrator/order" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            <?= number_format(count($contact)) ?>
                        </h3>
                        <p>
                            New Message
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-mail"></i>
                    </div>
                    <a href="<?= base_url() ?>administrator/message" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>
                            <?= $count_itemclicked->viewed_count ?>
                        </h3>
                        <p>
                            Daily items click
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-data"></i>
                    </div>
                    <a href="<?= base_url() ?>administrator/daily_items_click" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <!-- <div class="col-lg-3 col-xs-6">
                
                 <div class="small-box bg-yellow">
                     <div class="inner">
                         <h3>
            <?= number_format(count($users)) ?>
                         </h3>
                         <p>
                             User Registrations
                         </p>
                     </div>
                     <div class="icon">
                         <i class="ion ion-person-add"></i>
                     </div>
                     <a href="#" class="small-box-footer">
                         More info <i class="fa fa-arrow-circle-right"></i>
                     </a>
                 </div>
             </div>--><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>
                            <?= $count_viewed->viewed_count ?>
                        </h3>
                        <p>
                            Unique Visitors
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->

        </div><!-- /.row -->

        <!-- top row -->
        <div class="row">
            <div class="col-xs-12 connectedSortable">

            </div><!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable"> 
                <!-- Box (with bar chart) -->
                <div class="box box-danger" id="loading-example">
                    <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <!--<button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>-->
                            <button class="btn btn-danger btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-danger btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                        </div><!-- /. tools -->
                        <i class="fa fa-cloud"></i>

                        <h3 class="box-title">New Orders</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>No</th>
                                <th>Order ID</th>
                                <th>Order date</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Tools</th>
                            </tr>
                            <?php
                            $i = 1;
                            foreach ($order_list as $row):
                                ?>

                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $row->order_id ?></td>
                                    <td><?= $row->order_time ?></td>
                                    <td><?= $row->orders_ownername ?></td>
                                    <td>

                                        <?php
                                        if ($row->is_payment == 0) {
                                            echo '<span class="label label-warning">wait payment</span>  ';
                                        } else {
                                            echo '<span class="label label-success">paid</span>  ';
                                        }

                                        if ($row->is_shipping == 0) {
                                            echo '<span class="label label-warning">wait shiping</span>  ';
                                        } else {
                                            echo '<span class="label label-success">shiped</span>  ';
                                        }
                                        ?></td>
                                    <td>
                                        <div class="tools">
                                            <a href="#" onclick="load_order_detail('<?= $row->order_id ?>')" data-toggle="modal"><i class="fa fa-search"></i></a>
                                        </div>
                                    </td>
                                </tr> 
                                <?php
                                $i++;
                            endforeach;
                            ?>

                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer">

                    </div><!-- /.box-footer -->
                </div><!-- /.box -->        




            </section><!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-6 connectedSortable">


                <!-- Chat box -->
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-comments-o"></i> Message</h3>
                        <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                            <div class="btn-group" data-toggle="btn-toggle" >
                                <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button>                                            
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="box-body chat" id="chat-box">
                        <!-- chat item -->
                        <?php foreach ($contact as $row): ?>
                            <div class="item">
                                <img src="<?php echo base_url() ?>/public/admin/img/default_avatar.png" alt="user image" class="online"/>
                                <p class="message">
                                    <a href="#" class="name">
                                        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> <?= time_ago($row->timestamp) ?></small>
                                        <?= $row->full_name ?>
                                    </a>
                                    <?= $row->message ?>
                                </p>

                            </div><!-- /.item -->
                        <?php endforeach; ?>

                    </div><!-- /.chat -->

                </div><!-- /.box (chat box) -->

            </section>
            <section class="col-lg-6 connectedSortable">

                <!-- TO DO List -->
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="ion ion-clipboard"></i>
                        <h3 class="box-title">Wait for shipping List</h3>
                        <div class="box-tools pull-right">
                            <ul class="pagination pagination-sm inline">
                                <li><a href="#">&laquo;</a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">&raquo;</a></li>
                            </ul>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <ul class="todo-list">
                            <?php foreach ($orderList_wait_shipping as $row): ?>
                                <li>
                                    <!-- drag handle -->
                                    <span class="handle">
                                        <i class="fa fa-ellipsis-v"></i>
                                        <i class="fa fa-ellipsis-v"></i>
                                    </span>  
                                    <span class="text">Order : </span>                                  
                                    <!-- todo text -->
                                    <span class="text"><?= $row->order_id ?></span>
                                    <!-- Emphasis label -->
                                    <small class="label label-danger"><i class="fa fa-clock-o"></i> <?= time_ago($row->payment_time) ?></small>
                                    <!-- General tools such as edit or delete-->
                                    <div class="tools">
                                        <i class="fa fa-search" onclick="load_order_detail('<?= $row->order_id ?>');"></i>
                                    </div>
                                </li>
                            <?php endforeach; ?>

                        </ul>
                    </div><!-- /.box-body -->

                </div><!-- /.box -->
            </section>
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</aside><!-- /.right-side -->
</div><!-- ./wrapper -->
<!-- ORDER MODAL -->
<div class="modal fade" id="order-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-shopping-cart"></i> Order <span>#9123213</span></h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 table-responsive" id="order_detail_dection">


                    </div><!-- /.col -->

                    <form id="form_update_status">
                        <input type="hidden" name="item_id" id="item_id">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="input_reason">REASON</label>
                                <input name="input_reason" id="input_reason" type="text" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="input_ems">EMS TRACKING</label>
                                <input name="input_ems" id="input_ems"   type="text" class="form-control " >
                            </div>

                            <label>
                                <input type="button" name="payment" id="btn_payment" class="btn btn-default" value="ยืนยันการชำระเงิน" >
                                <input type="button" name="shipping" id="btn_shipping" class="btn btn-default" value="ยืนยันการสั่งซื้อ/จัดส่ง" >
                            </label>
                            <label></label>
                            <input type="button" name="cancel" id="btn_cancel"  class="btn btn-danger" value="ยกเลิกรายการสั่งซื้อ" >
                            <input type="button" name="update" id="btn_update" class="btn btn-default" value="อัพเดทข้อมูล" >
                        </div>
                    </form>
                </div><!-- /.row -->
            </div>

            <div class="modal-footer clearfix">

                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>

            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).ready(function() {
        $("#btn_payment").click(function() {
            if (confirm('Are you sure?')) {

                var item_id = $("#item_id").val();

                var $btn = $(this);
                $btn.button('loading');
                $.ajax({
                    url: "<?php echo base_url(); ?>" + "index.php/service/update_payment/" + item_id,
                    type: "POST",
                    data: $("#form_update_status").serialize(),
                    dataType: "json",
                    success: function(data) {
                        $.growl(data.status.message, {type: data.status.type}); //danger , info , warning
                        load_order_detail(item_id);
                        $btn.button('reset');
                    },
                    error: function(XMLHttpRequest) {
                        $.growl(XMLHttpRequest.status, {type: 'danger'}); //danger , info , warning
                        $btn.button('reset');
                    }
                });
            }
        });
        $("#btn_shipping").click(function() {
            if (confirm('Are you sure?')) {
                var item_id = $("#item_id").val();
                var $btn = $(this);
                $btn.button('loading');
                $.ajax({
                    url: "<?php echo base_url(); ?>" + "index.php/service/update_shipping/" + item_id,
                    type: "POST",
                    data: $("#form_update_status").serialize(),
                    dataType: "json",
                    success: function(data) {
                        $.growl(data.status.message, {type: data.status.type}); //danger , info , warning

                        load_order_detail(item_id);
                        $btn.button('reset');
                    },
                    error: function(XMLHttpRequest) {
                        $.growl(XMLHttpRequest.status, {type: 'danger'}); //danger , info , warning
                        $btn.button('reset');
                    }
                });
            }
        });
        $("#btn_cancel").click(function() {
            var item_id = $("#item_id").val();
            if (confirm('Are you sure?')) {
                var $btn = $(this);
                $btn.button('loading');
                $.ajax({
                    url: "<?php echo base_url(); ?>" + "index.php/service/update_ordercancel/" + item_id,
                    type: "POST",
                    data: $("#form_update_status").serialize(),
                    dataType: "json",
                    success: function(data) {
                        $.growl(data.status.message, {type: data.status.type}); //danger , info , warning

                        load_order_detail(item_id);
                        $btn.button('reset');
                    },
                    error: function(XMLHttpRequest) {
                        $.growl(XMLHttpRequest.status, {type: 'danger'}); //danger , info , warning
                        $btn.button('reset');
                    }
                });
            }
        });
        $("#btn_update").click(function() {
            var item_id = $("#item_id").val();
            if (confirm('Are you sure?')) {
                var $btn = $(this);
                $btn.button('loading');
                $.ajax({
                    url: "<?php echo base_url(); ?>" + "index.php/service/update_orderupdate/" + item_id,
                    type: "POST",
                    data: $("#form_update_status").serialize(),
                    dataType: "json",
                    success: function(data) {
                        $.growl(data.status.message, {type: data.status.type}); //danger , info , warning

                        load_order_detail(item_id);
                        $btn.button('reset');
                    },
                    error: function(XMLHttpRequest) {
                        $.growl(XMLHttpRequest.status, {type: 'danger'}); //danger , info , warning
                        $btn.button('reset');
                    }
                });
            }
        });
    });


    function load_order_detail(id) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "service/getitem_order_detail",
            data: {'id': id},
            dataType: "html",
            success: function(data) {
                $("#item_id").val(id);
                $('#order_detail_dection').html(data);
                $('#order-modal').modal('show');
            },
            error: function(XMLHttpRequest) {
                console.log(XMLHttpRequest.status);
            }
        });


        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "service/getitem_order_info",
            data: {'id': id},
            dataType: "json",
            success: function(data) {
                console.log(data);
                $('#input_reason').val(data.result.detail);
                $('#input_ems').val(data.result.emstrack);
            },
            error: function(XMLHttpRequest) {
                console.log(XMLHttpRequest.status);
            }
        });
    }

    function removedata(id) {
        if (confirm('ต้องการลบข้อมูลหรือไม่?')) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "index.php/service/getitem_order_detail",
                data: {'id': id},
                dataType: "json",
                success: function(data) {
                    if (data.status.type == 'success') {
                        load_itemlist();
                    }
                },
                error: function(XMLHttpRequest) {
                    console.log(XMLHttpRequest.status);
                }
            });
        }
    }

</script>