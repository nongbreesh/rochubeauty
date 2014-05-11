

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Category
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Category</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <section class="col-lg-4 connectedSortable">
                <div class="box box-info" id="loading-example">
                    <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-danger btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-danger btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                        </div><!-- /. tools -->
                        <i class="fa  fa-plus"></i>

                        <h3 class="box-title">New category</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">

                        <form role="form" action="" method="post">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" class="form-control" id="input_catename" name="input_catename" placeholder="Enter category name">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Parent</label>

                                    <select class="form-control"  id="input_catemaster" name="input_catemaster" >
                                        <option value="">--- Select one ----</option>';
                                        <?php foreach ($categody_list as $each) { ?>
                                            <option value="<?php echo $each->id; ?>"><?php echo $each->value; ?></option>';
                                        <?php } ?>
                                    </select>
                                    <p class="help-block">หมวดหมู่ ไม่เหมือนป้ายกำกับ สามารถมีลำดับขั้นได้ คุณอาจจะมีหมวดหมู่แจ๊ช และภายใต้หมวดหมู่แจ๊ชก็สามารถมีหมวดหมู่ย่อยสำหรับ Bebop และ Big Band ได้ สามารถเลือกได้ทั้งนั้น.</p>
                                </div>

                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
            </section>
            <section class="col-lg-8 connectedSortable"> 
                <!-- Box (with bar chart) -->
                <div class="box box-body" id="loading-example">
                    <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools">

                            <button class="btn btn-danger btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-danger btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                        </div><!-- /. tools -->
                        <i class="fa fa-bars"></i>

                        <h3 class="box-title">Category list</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover todo-list ">
                            <thead>
                                <tr>
                                    <th><strong>No</strong></th>
                                    <th><strong>Name</strong></th>
                                    <th><strong>Products</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($categody_list as $row):
                                    ?>

                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $row->value ?>
                                            <br>
                                        <div class="tools"><span class="edit"><a href="#">Edit</a> | </span><span class="delete"><a class="delete-tag" href="#">Delete</a></div></td>
                                        <td> <?= $this->get_data->getCateused($row->id); ?> </td>
                                    </tr> 
                                    <?php
                                    $i++;
                                endforeach;
                                ?>
                            </tbody>
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