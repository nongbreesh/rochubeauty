

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Orders
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Orders</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <section class="col-lg-12 connectedSortable"> 
                <!-- Box (with bar chart) -->
                <div class="box box-body" id="loading-example">
                    <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button  onclick="location.reload();" class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                            <button class="btn btn-danger btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-danger btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                        </div><!-- /. tools -->
                        <i class="fa fa-shopping-cart"></i>

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
                            <?php $i = 1;
                            foreach ($order_list as $row):
                                ?>

                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><a href="#" onclick="load_order_detail('<?= $row->order_id ?>');"><?= $row->order_id ?></a></td>
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
                                            <a href="#" ><i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                                </tr> 
                                <?php $i++;
                            endforeach;
                            ?>

                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer">

                    </div><!-- /.box-footer -->
                </div><!-- /.box -->        




            </section><!-- /.Left col -->
        </div>
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

    });


    function load_order_detail(id) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "service/getitem_order_detail",
            data: {'id': id},
            dataType: "html",
            success: function(data) {
                $('#order_detail_dection').html(data);
                $('#order-modal').modal('show');
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