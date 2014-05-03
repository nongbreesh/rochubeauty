

            <div class="col-lg-12">
                <h1>Rochu ครีมพิษงู จำหน่ายครีมบำรุงผิวหน้า ครีมหน้าเด้ง ครีมหน้าขาวใส Syn-Ake</h1>
                <p>
                    <img  src="<?php echo base_url('public'); ?>/images/presenter2.jpg"  width="100"   style="float: left; margin: 10px;" /> 
                    "SYN-AKE®" หรือ สารสกัด "เลียนแบบ" การทำงานของพิษงู (ไม่ใช่พิษงูจริงๆ)เป็นสุดยอดนวัตกรรมระดับโลกของสารสกัดในเครื่องสำอางค์ในกลุ่ม Anti-Aging ที่จะช่วยฟื้นบำรุงผิวหน้าให้ขาวใส อ่อนวัยและช่วยลดเลือนริ้วรอยแห่งวัยได้อย่างเห็นผลชัดเจน! การันตีด้วยรางวัล "SWISS TECHNOLOGY AWARD" ซึ่งมีคุณสมบัติในการทำงานโดยเลียนแบบการทำงานของ Protine Polypeptide ที่พบในพิษของงู ที่จะช่วยในการลดการหดเกร็งของกล้ามเนื้อบนใบหน้า ลดการเกิดริ้วรอยก่อนวัยและลดรอยตีนกา ช่วยให้ใบหน้าหน้าตึงกระชับ และดูเด็กลงอย่างชัดเจน
                    *ปลอดภัย มี อย. ทุกตัว* 
                    SKINCARE SET ครีมบำรุงผิวหน้าจากสารสกัดพิษงู! สุด Exclusive ด้วยสารสกัดนำเข้าจากต่างประเทศในระดับ Hi-End ที่เราได้คัดสรรสารสกัดจากทั่วทุกมุมโลกมาเป็นสกินแคร์ชั้นเลิศ กับครีมบำรุงผิวหน้าขาวใส ครีมหน้าเด้งที่จะมาช่วยฟื้นฟูดูแลผิวของคุณให้สวยใสอ่อนเยาว์ราวกับต้องมนต์! ได้รับการพิสูจน์แล้วจากลูกค้าที่ใช้จริงและเห็นผลจริงว่า Rochu "ครีมพิษงู" เป็นครีมบำรุงหน้าขาวใสที่ดีที่สุด เพราะเห็นผลอย่างรวดเร็วและปลอดภัย
                </p>
            </div>

            <div class="col-lg-9 shelf">

                <div class="topic col-lg-12"><h1>สินค้าพรีเมี่ยม // กำลังได้รับความนิยมและขายดีที่สุด</h1></div>
                <?php foreach ($ProductHit_list as $items) : ?>
                    <section class="col-lg-3 item">
                        <div class="row">
                            
                            <img src="<?= base_url('admin/uploads')?>/<?=$items->pic?>" title="<?=$items->title?>" alt="<?=$items->title?>"    height="200"/>


                        </div>
                        <h1><?=$items->title?></h1>
                        <p class="price"><?= number_format($items->price, 2, '.',',')?> บาท</p>
                        <div class="div_buy_bg"></div>
                        <div class="div_buy">
                            <p><?= word_limiter($items->wordwrap,5)?></p>
                            <a href="javascript:;" onClick="addCart('<?=$items->id?>');">ซื้อเลย</a> | <a href="<?= base_url('item') ?>/detail/<?= $items->id ?>/<?= $this->_data->checkword($items->title) ?>">ดูเพิ่มเติม</a>
                        </div>
                        <div class="div_price"><?= number_format($items->price, 2, '.',',')?> บาท</div>
                    </section>
                <?php endforeach; ?>

            </div>
 <div style="display:none">  <input name="txtqty" type="text" id="txtqty" style="width:40px;" value="1" /></div> 