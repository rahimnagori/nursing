<div class="pad_sec">
   <div class="container">
      <div class="back_bk">
         <a href="<?= site_url('Profile'); ?>"><i class="fa fa-arrow-left"></i> Back</a>
      </div>
      <div class="man_chat">
         <div class="row">
            <div class="col-sm-12">
               <div class="right_messge">
                  <div class="hedadeer_riht">
                     <h4> Message</h4>
                  </div>
                  <div class="cha_magge_us2">
                     <ul class="ul_set append_new_message">
                        <!-- Messages are added here dynamically -->
                        <!-- views -> site -> messages.php -->
                     </ul>
                  </div>
                  <div class="messge_send">
                     <form id="messageForm" name="messageForm" onsubmit="send_message(event);">
                        <div class="input-group">
                           <input type="text" name="message" id="message" placeholder="Message" class="form-control" required>
                           <input type="hidden" name="chat_id" id="chat_id" value="<?= $chatDetails['id']; ?>">

                           <span class="fil_upload">
                              <span class="fil_1">
                                 <i class="fa fa-paperclip" aria-hidden="true" id="upload_button"></i>
                                 <input type="file" id="chat_file" name="chat_file" onchange="check_file();" accept=".doc, .docx, .pdf, image/*" />
                              </span>
                           </span>
                           <span class="input-group-btn">
                              <button class="btn btn_theme2 btn_submit" type="submit"><i class="la la-paper-plane"></i> Send</button>
                              <!-- <button class="btn btn_upload" type="button" id="upload_button" ><i class="fa fa-upload"></i></button> -->
                           </span>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script src="<?= site_url('assets/common/js/chat.js'); ?>"></script>

<script>
   function send_message(e) {
      e.preventDefault();
      $.ajax({
         type: 'POST',
         url: BASE_URL + 'Message/send',
         data: new FormData($('#messageForm')[0]),
         dataType: 'JSON',
         processData: false,
         contentType: false,
         cache: false,
         beforeSend: function(xhr) {
            $(".btn_submit").attr('disabled', true);
            $(".btn_submit").html(LOADING);
            $("#responseMessage").html('');
            $("#responseMessage").hide();
            let message = $("#message").val();
            let message_div = new_message(message, 'sender');
            $(".append_new_message").append(message_div);
         },
         success: function(response) {
            if (!load_chat) {
               fetch_new_message();
            }
            $("#message").val('');
            $(".btn_submit").prop('disabled', false);
            $(".btn_submit").html(' Send ');
            scroll_to_bottom(".cha_magge_us2");
         }
      });
   }

   function get_message() {
      $.ajax({
         type: 'POST',
         url: BASE_URL + 'Get-Messages',
         data: {
            chat_id: $("#chat_id").val()
         },
         dataType: 'html',
         beforeSend: function(xhr) {

         },
         success: function(response) {
            $(".append_new_message").html(response);
         }
      });
   }

   function check_file() {
      let inputFile = $("#chat_file")[0].files[0];
      if (inputFile != undefined) {
         send_file(inputFile);
      }
   }

   function send_file(inputFile) {
      let formData = new FormData();
      formData.append('chat_file', inputFile);
      formData.append('chat_id', $("#chat_id").val());
      $.ajax({
         type: 'POST',
         url: BASE_URL + 'Send-File',
         data: formData,
         processData: false,
         contentType: false,
         dataType: 'json',
         beforeSend: function(xhr) {
            $("#upload_button").removeClass("fa-paperclip");
            $("#upload_button").addClass("fa-spin fa-spinner");
         },
         success: function(response) {
            $("#upload_button").removeClass("fa-spin fa-spinner");
            $("#upload_button").addClass("fa-paperclip");
            scroll_to_bottom(".cha_magge_us2");
         }
      });
   }

   fetch_new_message();
</script>