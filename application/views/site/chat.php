<div class="pad_sec">
   <div class="container">
      <div class="man_chat">
         <div class="row">
            <div class="col-sm-12">
               <div class="right_messge">
                  <div class="hedadeer_riht">
                     <h4>Message</h4>
                  </div>
                  <div class="cha_magge_us2">
                     <ul class="ul_set append_new_message">
                        <?php
                        foreach ($messages as $message) {
                        ?>
                           <li class="<?= ($message['is_admin'] == 0) ? 'sender' : 'recever'; ?>">
                              <div class="message-data">
                                 <div class="mess_dat_img">
                                    <img src="<?= site_url('assets/site/img/'); ?>logo.png">
                                 </div>
                                 <div class="messge_cont">
                                    <p>
                                       <span class="message_box"><?= $message['message']; ?></span>
                                    </p>
                                    <span class="time"><i class="fa fa-clock-o"></i> <?= date("d M,Y h:i A", strtotime($message['created'])); ?></span>
                                 </div>
                              </div>
                           </li>
                        <?php
                        }
                        ?>
                     </ul>
                  </div>
                  <div class="messge_send">
                     <form id="messageForm" name="messageForm" onsubmit="send_message(event);">
                        <div class="input-group">
                           <input type="text" name="message" id="message" placeholder="Message" class="form-control" required>
                           <input type="hidden" name="chat_id" value="<?= $chatDetails['id']; ?>">
                           <span class="input-group-btn">
                              <button class="btn btn_theme2 btn_submit" type="submit"><i class="la la-paper-plane"></i> Send</button>
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
</script>