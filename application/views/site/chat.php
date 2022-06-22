<div class="pad_sec">
   <div class="container">
      <div class="man_chat">
         <div class="row">
            <div class="col-sm-12">
               <div class="right_messge">
                  <div class="hedadeer_riht">
                     <h4><a href="<?=site_url('Profile');?>"><i class="fa fa-arrow-left"></i></a> Message</h4>
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
                           <span class="input-group-btn">
                              <button class="btn btn_theme2 btn_submit" type="submit"><i class="la la-paper-plane"></i> Send</button>
                              <input type="file" id="chat_file" name="chat_file" onchange="check_file();" accept=".doc, .docx, .pdf, image/*" />
                              <button class="btn btn_upload" type="button" id="upload_button" ><i class="fa fa-upload"></i></button>
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
            let message_div = new_message(message);
            $(".append_new_message").append(message_div);
         },
         success: function(response) {
            $("#message").val('');
            $(".btn_submit").prop('disabled', false);
            $(".btn_submit").html(' Send ');
            scroll_to_bottom(".cha_magge_us2");
         }
      });
   }

   function new_message(message) {
      return `<li class="sender">
         <div class="message-data">
            <div class="mess_dat_img">
               <img src="${BASE_URL}assets/site/img/logo.png">
            </div>
            <div class="messge_cont">
               <p>
                  <span class="message_box">${message}</span>
               </p>
               <span class="time"><i class="fa fa-clock-o"></i> Just now</span>
            </div>
         </div>
      </li>`
   }

   function scroll_to_bottom(div) {
      $("" + div).animate({
         scrollTop: $("" + div)[0].scrollHeight
      }, 1000);
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
            scroll_to_bottom(".cha_magge_us2");
         }
      });
   }

   let load_chat = setInterval(function() {
      get_message();
   }, 5000);

   
   function check_file(){
      let inputFile = $("#chat_file")[0].files[0];
      if(inputFile != undefined){
         send_file(inputFile);
      }
   }

   function send_file(inputFile){
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
            $("#upload_button").attr('disabled', true);
            $("#upload_button").html("<i class='fa fa-spin fa-spinner'></i>");
         },
         success: function(response) {
            $("#upload_button").attr('disabled', false);
            $("#upload_button").html("<i class='fa fa-upload'></i>");
         }
      });
   }

   function delete_file(document_id){
      $.ajax({
         type: 'PUT',
         url: BASE_URL + 'DELETE-CHAT-DOCUMENT',
         data: {
            document_id: document_id
         },
         dataType: 'json',
         beforeSend: function(xhr) {
            $(".action_button").attr('disabled', true);
            $(".action_button").html("<i class='fa fa-spin fa-spinner'></i>");
         },
         success: function(response) {
            $(".action_button").attr('disabled', false);
            $(".action_button").html("<i class='fa fa-upload'></i>");
         }
      });
   }
</script>