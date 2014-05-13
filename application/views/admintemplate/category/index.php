

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

                        <form role="form" id="form_add_cate">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" class="form-control" id="input_catename" name="input_catename" placeholder="Enter category name">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Parent</label>

                                    <select class="form-control"  id="input_cateparent" name="input_cateparent" >
                                        <option value="">--- Select one ----</option>';
                                        <?php foreach ($categody_list as $each) { ?>
                                            <option value="<?php echo $each->id; ?>"><?php echo $each->value; ?></option>';
                                        <?php } ?>
                                    </select>
                                    <p class="help-block">หมวดหมู่ ไม่เหมือนป้ายกำกับ สามารถมีลำดับขั้นได้ คุณอาจจะมีหมวดหมู่แจ๊ช และภายใต้หมวดหมู่แจ๊ชก็สามารถมีหมวดหมู่ย่อยสำหรับ Bebop และ Big Band ได้ สามารถเลือกได้ทั้งนั้น.</p>
                                </div>

                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary" id="input_addcate">Submit</button>
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
                                    <th><strong>Parent</strong></th>
                                    <th><strong>Products</strong></th>
                                </tr>
                            </thead>
                            <tbody id="cate_list">

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
<div class="modal fade" id="category-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-sm">
        <div class="modal-content">
            <form role="form" id="form_edit_cate">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-shopping-cart"></i> <span>Update category</span></h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 table-responsive" >


                            <input type="hidden" name="input_hddcate" id="input_hddcate" />
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" class="form-control" id="inputedit_catename" name="inputedit_catename" placeholder="Enter category name">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Parent</label>

                                    <select class="form-control"  id="inputedit_cateparent" name="inputedit_cateparent" >
                                        <option value="">--- Select one ----</option>';
                                        <?php foreach ($categody_list as $each) { ?>
                                            <option value="<?php echo $each->id; ?>"><?php echo $each->value; ?></option>';
                                        <?php } ?>
                                    </select>
                                    <p class="help-block">หมวดหมู่ ไม่เหมือนป้ายกำกับ สามารถมีลำดับขั้นได้ คุณอาจจะมีหมวดหมู่แจ๊ช และภายใต้หมวดหมู่แจ๊ชก็สามารถมีหมวดหมู่ย่อยสำหรับ Bebop และ Big Band ได้ สามารถเลือกได้ทั้งนั้น.</p>
                                </div>

                            </div><!-- /.box-body -->


                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div>

                <div class="modal-footer clearfix">

                    <button type="submit" class="btn btn-primary pull-left" id="input_editcate"><i class="fa  fa-save"></i> Save change</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>

                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    $(document).ready(function() {
        load_cate_list();
        $("#form_add_cate").on('submit', function(e) {
            e.preventDefault();
            var $btn = $("#input_addcate");
            $btn.button('loading');
            $.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/service/add_category",
                type: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(data) {
                    $.growl(data.status.message, {type: data.status.type}); //danger , info , warning
                    load_cate_list();
                    load_category();
                    $btn.button('reset');
                },
                error: function(XMLHttpRequest) {
                    $.growl(XMLHttpRequest.status, {type: 'danger'}); //danger , info , warning
                    $btn.button('reset');
                }
            });
        });
        $("#form_edit_cate").on('submit', function(e) {
            e.preventDefault();
            var $btn = $("#input_editcate");
            $btn.button('loading');
            var id = $("#input_hddcate").val();
            $.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/service/update_cate/" + id,
                type: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(data) {
                    $.growl(data.status.message, {type: data.status.type}); //danger , info , warning
                    $btn.button('reset');
                    $("#category-modal").modal("hide");
                    load_cate_list();
                },
                error: function(XMLHttpRequest) {
                    $.growl(XMLHttpRequest.status, {type: 'danger'}); //danger , info , warning
                    $btn.button('reset');
                }
            });
        });
    });
    function load_cate_list() {
        $('#cate_list').html('<tr><td colspan="7"><center><img src="<?php echo base_url(); ?>public/img/loading.gif"  width="50"/></center></td></tr>');
        setTimeout(
                function()
                {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "service/load_cate_list",
                        dataType: "html",
                        success: function(data) {
                            $('#cate_list').html(data);
                        },
                        error: function(XMLHttpRequest) {
                            console.log(XMLHttpRequest.status);
                        }
                    });
                }
        , 1000);
    }

    function editdata(id) {

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "service/load_cate_detail",
            data: {'id': id},
            dataType: "json",
            success: function(data) {

                $("#input_hddcate").val(data.result.categories_id);
                $("#inputedit_catename").val(data.result.categories_name);
                $("#inputedit_cateparent").val(data.result.parent_id);
            },
            error: function(XMLHttpRequest) {
                console.log(XMLHttpRequest.status);
            }
        });
        $("#category-modal").modal("show");
    }

    function removedata(id) {
        if (confirm('ต้องการลบข้อมูลหรือไม่?')) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "index.php/service/delete_cate",
                data: {'id': id},
                dataType: "json",
                success: function(data) {
                    if (data.status.type == 'success') {
                        $.growl(data.status.message, {type: data.status.type}); //danger , info , warning
                        load_cate_list();
                        load_category();

                    }
                },
                error: function(XMLHttpRequest) {
                    $.growl(XMLHttpRequest.status, {type: 'danger'}); //danger , info , warning
                }
            });
        }
    }

    function load_category() {

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/service/get_category",
            dataType: "json",
            success: function(data) {
                console.log(data.result[0]);

                var listItems = '<option value="">--- Select one ----</option>';
                $.each(data.result, function(i, data) {
                    listItems += "<option value=" + data.val1 + ">" + data.val2 + "</option>";
                });
                $("#input_cateparent").html(listItems);
                $("#input_cateparent").val("");
                $("#input_catename").val("");

            },
            error: function(XMLHttpRequest) {
                $.growl(XMLHttpRequest.status, {type: 'danger'}); //danger , info , warning
            }
        });
    }

</script>