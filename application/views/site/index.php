<style>
   .lahhh #google_translate_element {
	margin-top: 22px;
}
</style>
<div class="banner_top">
   <div class="owl-carousel owl-theme slider_arrrw " id="slider1">
      <?php
      for ($i = 0; $i <= 2; $i++) {
      ?>
         <div class="item col">
            <div class="banner">
               <img src="<?= site_url('assets/site/'); ?>img/img_1.png">
               <div class="banter_text">
                  <div class="container">
                     <div class="row">
                        <div class="col-sm-6">
                           <h1><span>Work with us</span></h1>
                           <!-- <p>
                              Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                           </p> -->
                           <div class="btn_bot3">
                              <a href="<?= site_url('Sign-Up'); ?>" class="btn btn_theme2 btn-lg">Sign Up</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      <?php
      }
      ?>
   </div>
</div>
<section class="sec1 pad_bottom">
   <div class="container">
      <div class="box_white">
         <div class="row">
            <div class="col-sm-4">
               <div class="box_icon">
                  <a href="<?= site_url('Jobs') ?>">
                  <div class="icon_1">
                     <img src="<?= site_url('assets/site/'); ?>img/hospital.png">
                  </div>
                  <h4>HOSPITAL</h4>
                  </a>
                  <!-- <p>
                     Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been.
                  </p> -->
               </div>
            </div>
            <div class="col-sm-4">
               <div class="box_icon">
               <a href="<?= site_url('Jobs') ?>">
                  <div class="icon_1">
                     <img src="<?= site_url('assets/site/'); ?>img/home(1).png">
                  </div>
                  <h4>CARE HOME</h4>
               </a>
                  <!-- <p>
                     Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been.
                  </p> -->
               </div>
            </div>
            <div class="col-sm-4">
               <div class="box_icon">
               <a href="<?= site_url('Jobs') ?>">
                  <div class="icon_1">
                     <img src="<?= site_url('assets/site/'); ?>img/home(2).png">
                  </div>
                  <h4>OTHER INSTITUTIONS</h4>
               </a>
                  <!-- <p>
                     Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been.
                  </p> -->
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="sec2 pad_sec ">
   <div class="container">
      <div class="row d_flex item_center">
         <div class="col-sm-8">
            <div class="row d_flex">
               <div class="col-sm-6">
                  <div class="imv_im1">
                     <img src="<?= site_url('assets/site/'); ?>img/img_5.png" class="img_r">
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="imv_im2">
                     <img src="<?= site_url('assets/site/'); ?>img/img_6.png" class="img_r">
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-4">
            <div class="abot_cont">
               <div class="headding cles_p">
                  <h2>About us</h2>
                  <p>
                      <?=$this->config->item('PROJECT');?>  is a Healthcare recruitment agency
                     registered in England and Wales, and we specialise in providing Nurses,
                     Health Care Assistants, Support workers...
                  </p>
               </div>
               <a href="<?= site_url('About'); ?>" class="btn btn_theme2 btn-lg">Read More</a>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="bant_s">
   <div class="container">
      <div class="Place_d1">
         <div class="row d_flex">
            <div class="col-sm-6">
               <div>
                  <div class="headding">
                     <h2>
                        Experienced in Home Care & Private <?=$this->config->item('PROJECT');?>
                     </h2>
                     <!-- <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                     </p> -->
                  </div>
                  <div class="row">
                     <div class="col-sm-4 col-xs-4">
                        <div class="box_icon">
                           <div class="icon_1">
                              <img src="<?= site_url('assets/site/'); ?>img/img_8.png">
                           </div>
                           <h4>Satisfaction Guarantee</h4>
                        </div>
                     </div>
                     <div class="col-sm-4 col-xs-4">
                        <div class="box_icon">
                           <div class="icon_1">
                              <img src="<?= site_url('assets/site/'); ?>img/img_9.png">
                           </div>
                           <h4>Senior Care</h4>
                        </div>
                     </div>
                     <div class="col-sm-4 col-xs-4">
                        <div class="box_icon">
                           <div class="icon_1">
                              <img src="<?= site_url('assets/site/'); ?>img/img_10.png">
                           </div>
                           <h4>Health Consultation</h4>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="box_c1">
                  <img src="<?= site_url('assets/site/'); ?>img/img_7.png" class="img_r">
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="sec4 pad_sec">
   <div class="container">
      <div class="row d_flex" style="justify-content: center; text-align: center">
         <div class="col-sm-9">
            <div class="img_abot2">
               <img src="<?= site_url('assets/site/'); ?>img/img_7.png" class="img_r">
            </div>
            <a href="<?= site_url('Contact'); ?>" class="btn btn_theme2 btn-lg" style="margin-top: 30px;">Contact Us</a>
         </div>
         <div class="col-sm-5">
            <div class="abot_cont">
               <!-- <div class="headding">
                  <h2>We Are Available For Home Care Consultation </h2>
               </div>
               <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
               </p> -->
               <!-- <a href="<?= site_url('Contact'); ?>" class="btn btn_theme2 btn-lg">Contact Us</a> -->
            </div>
         </div>
      </div>
   </div>
</section>
<section class="sec5 pad_sec ">
   <!-- <div class="container">
      <div class="don_box1 ">
         <div class="row">
            <div class="col-sm-3 col-xs-6">
               <div class="box_icon">
                  <div class="icon_1">
                     <img src="<?= site_url('assets/site/'); ?>img/img_15.png">
                  </div>
                  <h1><span class="counter" data-count="1000">0</span></h1>
                  <h4> Happy Patients </h4>
               </div>
            </div>
            <div class="col-sm-3 col-xs-6">
               <div class="box_icon">
                  <div class="icon_1">
                     <img src="<?= site_url('assets/site/'); ?>img/img_8.png">
                  </div>
                  <h1><span class="counter" data-count="3000">0</span></h1>
                  <h4>Successful Home Care</h4>
               </div>
            </div>
            <div class="col-sm-3 col-xs-6">
               <div class="box_icon">
                  <div class="icon_1">
                     <img src="<?= site_url('assets/site/'); ?>img/img_2.png">
                  </div>
                  <h1><span class="counter" data-count="8000">0</span></h1>
                  <h4>Years Of Experience</h4>
               </div>
            </div>
            <div class="col-sm-3 col-xs-6">
               <div class="box_icon">
                  <div class="icon_1">
                     <img src="<?= site_url('assets/site/'); ?>img/img_9.png">
                  </div>
                  <h1><span class="counter" data-count="8000">0</span></h1>
                  <h4>Professional Nurses</h4>
               </div>
            </div>
         </div>
      </div>
   </div> -->
</section>
<?php
if (count($newses)) {
?>
   <section class="sec3 pad_sec">
      <div class="container">
         <div class="headding">
            <h2> Latest News & Tips </h2>
            <p>
               Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
            </p>
         </div>
         <div class="slider_corse top_arrow">
            <div class="owl-carousel owl-theme slider_arrrw " id="slider2">
               <?php
               foreach ($newses as $news) {
                  $description = strip_tags(substr($news['description'], 0, 120));
               ?>
                  <div class="item">
                     <div class="blog_1">
                        <div class="blog_3">
                           <div class="blog_img">
                              <a href="<?= site_url('News/' . $news['id']); ?>"><img src="<?= site_url('assets/site/'); ?>img/img_11.jpg" class="img_r"></a>
                           </div>
                           <div class="blog_2">
                              <div class="date_me">
                                 <span><?= date("d M, Y", strtotime($news['created'])); ?></span>
                              </div>
                              <h6>By Admin</h6>
                              <h4><?= substr($news['title'], 0, 25); ?></h4>
                              <p><?= $description; ?></p>
                              <a href="<?= site_url('News/' . $news['id']); ?>" class="btn btn_theme3 btn_lg">Read More</a>
                           </div>
                        </div>
                     </div>
                  </div>
               <?php
               }
               ?>
            </div>
         </div>
      </div>
   </section>
<?php
}
?>