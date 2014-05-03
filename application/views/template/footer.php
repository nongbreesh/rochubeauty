</section>
<footer>
    <section class="footer">
        <p>ลิขสิทธิ์ ©2013 - 2014 ขายน้ำมันมะพร้าว.com สงวนสิทธิ์ทั้งหมด โทร 086-379-5315 คุณนก Email : s.chanikarn@gmail.com</p>
    </section>
    <div class="footer-logo"></div>
</footer>
</body>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url('public') ?>/js/jquery.eislideshow.js"></script>
<script type="text/javascript" src="<?= base_url('public') ?>/js/jquery.easing.1.3.js"></script>

<script type="text/javascript" src="<?= base_url('public') ?>/js/jQuery.blockUI.js" ></script>
<script type="text/javascript" src="<?= base_url('public') ?>/js/index.js" ></script>
<script type="text/javascript" src="<?= base_url('public') ?>/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(function() {
        $('#ei-slider').eislideshow({
            animation: 'center',
            autoplay: true,
            slideshow_interval: 3000,
            titlesFactor: 0
        });

        $('#datepicker').datepicker();
    });

    $(document).ajaxStop($.unblockUI);

    function addCart(id) {
        var str = "id=" + id;
        var str = "id=" + id;
        var qty = document.getElementById('txtqty');
        //alert('<?= base_url() ?>cart/addcart/'+id+'/'+qty.value);
        $.ajax({
            url: '<?= base_url() ?>cart/addcart/' + id + '/' + qty.value,
            type: 'get',
            data: str,
            cache: false,
            beforeSend: function() {
                $.blockUI({
                    message: "<h1>Loading...</h1>",
                    css: {border: 'none', padding: '5px', opacity: 1, color: '#fff', backgroundColor: ''}
                });
            },
            success: function(data) {
                var parms = data.split('&');
                $.unblockUI();
                $(".basket").html("<img src=\"<?= base_url('public') ?>/img/cart.png\">&nbsp;<a href='<?= base_url('cart') ?>'><b> ชนิดสินค้า [" + parms[0] + "]</b><br></a> <b>ยอดรวม</b> : " + parms[1] + "<b> บาท</b>");


            }
        })

    }


    function dropCart(session, id) {
        var str = "id=" + id;
        str += "&session=" + session;

        $.ajax({
            url: '<?= base_url() ?>/cart/currentcart',
            type: 'get',
            data: str,
            cache: false,
            success: function(data) {
                $(".cartHead").html("<img src=\"<?= base_url('public') ?>/img/cart.png\">&nbsp;&nbsp;" + data);
            }
        })

        $.ajax({
            url: '<?= base_url() ?>/cart/dropcart',
            type: 'get',
            data: str,
            cache: false,
            success: function(data) {
                showListCart(session);
            }
        })
    }


</script>
</html>


