</section>
<footer>
    <section class="footer">
        <p>ลิขสิทธิ์ ©2013 - 2014 Rochubeauty.com สงวนสิทธิ์ทั้งหมด โทร 086-379-5315 คุณนก Email : s.chanikarn@gmail.com</p>
    </section>
    <!-- <div class="footer-logo"></div> -->
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
                $(".cart_mini_count").html(parms[0]);
                location.href = '<?= base_url('cart') ?>';
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
<!-- Start of StatCounter Code for Default Guide -->
<script type="text/javascript">
    var sc_project = 9781507;
    var sc_invisible = 1;
    var sc_security = "04b06291";
    var scJsHost = (("https:" == document.location.protocol) ?
            "https://secure." : "http://www.");
    document.write("<sc" + "ript type='text/javascript' src='" +
            scJsHost +
            "statcounter.com/counter/counter.js'></" + "script>");
</script>
<noscript><div class="statcounter"><a title="hit counter"
                                      href="http://statcounter.com/" target="_blank"><img
            class="statcounter"
            src="http://c.statcounter.com/9781507/0/04b06291/1/"
            alt="hit counter"></a></div></noscript>
<!-- End of StatCounter Code for Default Guide -->

<script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-39217117-2', 'rochubeauty.com');
    ga('send', 'pageview');

</script>
</html>


