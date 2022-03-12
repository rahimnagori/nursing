<footer class="footer wow fadeInLeft"  data-wow-delay="0.5s">
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <div class="box_us12">
          <div class="icon_2">
            <i class="fa fa-envelope"></i>
            <h4>Email Address</h4>
            <p>
              <?=$businessData['business_email'];?>
            </p>
            <p>
              <?=$businessData['business_email_1'];?>
            </p>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="box_us12">
          <div class="icon_2">
            <i class="fa fa-phone"></i>
            <h4>Phone Number</h4>
            <p>
              <?=$businessData['business_phone'];?>
            </p>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="box_us12">
          <div class="icon_2">
            <i class="fa fa-map-marker"></i>
            <h4>Location</h4>
            <p>
              <?=$businessData['business_address'];?>
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="sosilam">
      <ul class="ul_set">
        <li><a href="https://www.facebook.com/pg/SIMS-Group-of-company-105106981243155/services/" target="_blank"><i class="fa fa-facebook"></i></a></li>
        <li><a href="https://www.youtube.com/channel/UCZpgIeeQ0AkcD3wqRETyKMA"><i class="fa fa-youtube"></i></a></li>
        <li><a href="https://www.indiamart.com/shastriinteriormaintenanceservices/"><img src="<?=site_url('assets/site/img/');?>indiamart.png" width="40" ></a></li>
      </ul>
    </div>
    <div class="coppy">
      Copyright SIMS GROUP 0F COMPANY © <?=date('Y');?>. All Rights Reserved. 
    </div>
  </div>
</footer>

<script type="text/javascript" src="<?=site_url('assets/site/js/');?>jquery.min.js"></script>
<script type="text/javascript" src="<?=site_url('assets/site/js/');?>bootstrap.min.js"></script>
<script type="text/javascript" src="<?=site_url('assets/site/js/');?>jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=site_url('assets/site/js/');?>owl.carousel.js"></script>
<script type="text/javascript" src="<?=site_url('assets/site/js/');?>wow.min.js"></script>
<script type="text/javascript" src="<?=site_url('assets/site/js/');?>custom.js"></script>
<script type="text/javascript" src="<?=site_url('assets/site/js/');?>typed.min.js"> </script>

<!-- GetButton.io widget -->
<script type="text/javascript">
  (function () {
    var options = {
      whatsapp: "<?=$businessData['business_phone'];?>", // WhatsApp number
      call_to_action: "", // Call to action
      position: "right", // Position may be 'right' or 'left'
    };
    var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
    var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
    s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
    var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
  })();
</script>
<!-- /GetButton.io widget -->

</body>
</html>