<?php include_once('include/header.php'); ?>

<div class="innerer_banner">
  <div class="container">
    <div class="box_us16">
      <h1>Contact Us</h1>
    </div>
  </div>
</div>
<div class="box_us18 sec_pad">
  <div class="container">
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1">
        <div class="box_us17">
          <div class="headding wow fadeInDown"  data-wow-delay="0.5s">
            <h1>get in touch</h1>
            <p>
              Send us your queries, quotation or any other inquiry, we'll read them all and try to answer each of them ASAP.
            </p>
          </div>
          <div class="img_us_contt wow fadeInLeft"  data-wow-delay="0.5s" style="display:none;">
            <img src="<?=site_url('assets/site/img/');?>img_14.png" class="img_r">    
          </div>
          <form id="contactForm" name="contactForm" onsubmit="" action="<?=site_url('Request');?>" method="post" >
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" id="name" name="name" required />
                </div>
              </div>
              <div class="col-sm-6 col-sm-offset-3">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" id="email" name="email" required />
                </div>
              </div>
              <div class="col-sm-6 col-sm-offset-3">
                <div class="form-group">
                  <label>Phone</label>
                  <input type="number" class="form-control" id="phone" name="phone" required />
                </div>
              </div>
              <div class="col-sm-6 col-sm-offset-3">
                <div class="form-group">
                  <label>Message</label>
                  <textarea type="text" class="form-control" id="message" name="query" required></textarea>
                </div>
              </div>
            </div>
            <div class="form-group text-center">
              <button type="submit" class="btn btn_theme btn-lg">Send</button>
            </div>
            <?=$this->session->flashdata('formResponse');?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="massp"  data-wow-delay="0.5s">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3499.0805057585194!2d77.11939601550044!3d28.717139986996546!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d015cd99a3105%3A0x308f527e6d2b09a4!2z4KS44KSk4KWN4KSv4KSuIOCktuCkv-CkteCkriDgpLjgpYHgpKjgpY3gpKbgpLDgpK4g4KSu4KSC4KSm4KS_4KSw!5e0!3m2!1sen!2sin!4v1595687257865!5m2!1sen!2sin" width="100%" height="470" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>

<?php include_once('include/footer.php'); ?>

<script>
  // $("#name").val('Rahim');
  // $("#email").val('rahim.nagori@gmail.com');
  // $("#phone").val('9425987350');
  // $("#message").val('This is a common message.');
</script>