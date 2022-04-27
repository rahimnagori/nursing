<div class="inner_cont">
   <div class="container">
      <h4>Contact Us</h4>
      <p>
         <span><a href="<?= site_url(); ?>">Home</a></span>
         <span>Contact Us</span>
      </p>
   </div>
</div>
<div class="pad_sec">
   <div class="container">
      <div class="row">
         <div class="col-sm-4">
            <div class="contact_1">
               <h4>GET IN TOUCH</h4>
               <ul class="ul_set">
                  <li>
                     <span class="icon_2"><i class="fa fa-envelope"></i></span>
                     <label>Email:</label>
                     <p>
                        <a style="color: white;" href=""> contact@nursing.com</a>
                     </p>

                  </li>
                  <li>
                     <span class="icon_2"><i class="fa fa-phone"></i></span>
                     <label>Phone:</label>
                     <p><a href="" style="color: white;"> 123-456-7899</a></p>
                  </li>
                  <li>
                     <span class="icon_2"><i class="fa fa-map-marker"></i></span>
                     <label>Address:</label>
                     <p>Unit 7, Daisy Business Park, 19-35 Sylvan
                        Grove, London SE15 1PD </p>
                  </li>
               </ul>
            </div>
         </div>
         <div class="col-sm-8">
            <form id="contactForm" name="contactForm" onsubmit="send_contact_request(event);">

               <div class="contact_2 con_gett">
                  <h3 style="text-transform: uppercase;">Send Message </h3>
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Full Name </label>
                           <div class="icon_us">
                              <i class="la la-user"></i>
                              <input type="text" name="full_name" placeholder="Full Name" class="form-control" required="">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Email Address </label>
                           <div class="icon_us">
                              <i class="la la-envelope"></i>
                              <input type="email" name="email" placeholder="Email Address" class="form-control" required="">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Telephone </label>
                           <div class="icon_us">
                              <i class="la la-mobile"></i>
                              <input type="number" name="phone" placeholder="Telephone" class="form-control" required="">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Upload CV </label>
                           <div class="icon_us">
                              <i class="la la-cloud-upload"></i>
                              <input type="file" name="resumeFile" class="form-control" onchange="upload_resume(this);" accept=".pdf, .doc, .docx" >
                              <input type="hidden" name="resume" id="resume" >
                           </div>
                           <div id="preview_image"></div>
                        </div>

                     </div>
                  </div>
                  <div class="form-group tx_add">
                     <label>Message </label>
                     <div class="icon_us">
                        <i class="la la-comments-o"></i>
                        <textarea name="message" id="" class="form-control" required=""></textarea>
                     </div>
                  </div>
                  <div class="remnper">
                     <label class="checkbox-inline">
                        <input type="checkbox" name="process_policy" id="process_policy" value="1">
                        I consent to <?=$this->config->item('PROJECT');?> process and store my data,and to
                        use such data in <br> its recruitment process.
                     </label>

                  </div>
                  <div class="remnper">
                     <label class="checkbox-inline">
                        <input type="checkbox" name="collect_policy" id="collect_policy" value="1">
                        I consent to <?=$this->config->item('PROJECT');?> collecting and storing my data in
                        accordance with <br> its privacy policy.
                     </label>

                  </div>
                  <?=$this->session->flashdata('responseMessage');?>
                  <div class="responseMessage" id="responseMessage"></div>
                  <div class="btnloggib " style="margin-top: 10px;">
                     <button class="btn btn_theme2 btn-lg btn-block btn_submit" type="submit"> Send </button>
                  </div>
               </div>

            </form>
         </div>

      </div>
   </div>
</div>

<script>
   function send_contact_request(e) {
      e.preventDefault();
      $.ajax({
         type: 'POST',
         url: BASE_URL + 'Contact/Request',
         data: new FormData($('#contactForm')[0]),
         dataType: 'JSON',
         processData: false,
         contentType: false,
         cache: false,
         beforeSend: function(xhr) {
            $(".btn_submit").attr('disabled', true);
            $(".btn_submit").html(LOADING);
            $("#responseMessage").html('');
            $("#responseMessage").hide();
         },
         success: function(response) {
            $(".btn_submit").prop('disabled', false);
            $(".btn_submit").html(' Send ');
            if (response.status == 1) location.reload();
            $("#responseMessage").html(response.responseMessage);
            $("#responseMessage").show();
         }
      });
   }

   function upload_resume(element){
      let formData = new FormData();
      let oldResume = $("#resume").val();
      formData.append('resume', element.files[0]);
      formData.append('oldResume', oldResume);
      $.ajax({
         type: 'POST',
         url: BASE_URL + 'Contact/Resume',
         data: formData,
         dataType: 'JSON',
         processData: false,
         contentType: false,
         cache: false,
         beforeSend: function(xhr) {
            $(".btn_submit").attr('disabled', true);
         },
         success: function(response) {
            $(".btn_submit").attr('disabled', false);
            if(response.status == 1){
               $("#resume").val(response.resumePath);
            }
         }
      });
   }
</script>