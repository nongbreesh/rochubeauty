<div class="col-lg-9 shelf">
    <div class="topic"><h1><?= $catename->categories_name ?></h1></div>
    <?php foreach ($Product_cate as $items) : ?>
        <section class="col-lg-3 item">
            <div class="row">

                <img src="<?= base_url('public/uploads') ?>/<?= $items->pic ?>" title="<?= $items->title ?>" alt="<?= $items->title ?>"    height="200"/>


            </div>
            <h1><?= $items->title ?></h1>
            <p class="price"><?= number_format($items->price, 2, '.', ',') ?> บาท</p>
            <!--<div class="div_buy_bg"></div>
            <div class="div_buy">
                <p><?= word_limiter($items->wordwrap, 5) ?></p>
                <a href="#">ซื้อเลย</a> | <a href="<?= base_url('item') ?>/detail/<?= $items->id ?>/<?= $this->_data->checkword($items->title) ?>">ดูเพิ่มเติม</a>
            </div>-->
            <div class="div_price"><?= number_format($items->price, 2, '.', ',') ?> บาท</div>
            <div class="buyzone">
                <div class="fb-share-button" data-href="<?= base_url() ?>item/detail/<?= $items->id ?>" data-type="button_count" style="position: absolute;right: 0;top:-20px;z-index: 800;"></div>

                <a href="javascript:;" onClick="addCart('<?= $items->id ?>');">ซื้อเลย</a> | <a href="<?= base_url('item') ?>/detail/<?= $items->id ?>/<?= $this->_data->checkword($items->title) ?>">ดูเพิ่มเติม</a>
                <p><?= word_limiter($items->wordwrap, 5) ?></p>
            </div>
        </section>
    <?php endforeach; ?>

</div>


<div style="display:none">  <input name="txtqty" type="text" id="txtqty" style="width:40px;" value="1" /></div> 