<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">Chat</h4>

  <div class="man_chat">
    <div class="row">
      <div class="col-sm-4">
        <div class="left_chat">
          <div class="hedadeer_left">
            <h4>Inbox</h4>
          </div>
          <div class="auto_scol_left">
            <ul class="ul_set">
              <?php
              foreach ($chats as $chat) {
              ?>
                <li>
                  <a href="#" onclick="load_new_chat(<?= $chat['id']; ?>, '<?= $chat['first_name'] . ' ' . $chat['last_name']; ?>');">
                    <span class="chat_user_img">
                      <img src="<?= site_url('assets/site/img/'); ?>logo.png">
                      <span class="chat_stas online1 "></span>
                    </span>
                    <?= $chat['first_name'] . ' ' . $chat['last_name']; ?>
                    <span class="tex_us1d"><?= $chat['email']; ?></span>
                    <!-- <p>22 Jan 2021</p> -->
                  </a>
                </li>
              <?php
              }
              ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-sm-8">
        <div class="right_messge">
          <div class="hedadeer_riht">
            <h4>Message <span class="pull-right" id="username"><?= $chatDetails['username']; ?></span></h4>
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
                <input type="hidden" name="receiver_id" value="<?= $chatDetails['receiverId']; ?>">
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

<?php include 'include/footer.php'; ?>

<script src="<?= site_url('assets/common/js/chat.js'); ?>"></script>

<script>
  function send_message(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Admin-Message/send',
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
        let message_div = new_message(message, 'recever');
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
      url: BASE_URL + 'Admin-Get-Messages',
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

  function load_new_chat(user_id, username) {
    $("#chat_id").val(user_id);
    $("#username").html(username);
  }

  fetch_new_message();
</script>