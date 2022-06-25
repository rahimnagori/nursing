/* 
    #This is being used at 
        admin/chat.php
        site/chat.php
*/
function new_message(message, elementClass) {
    return `<li class="${elementClass}">
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
    </li>`;
}

let load_chat = null;

function fetch_new_message() {
    load_chat = setInterval(function () {
        get_message();
    }, 1000);
}

function open_file_options() {
    clearInterval(load_chat);
    load_chat = null;
}

function scroll_to_bottom(div) {
    $("" + div).animate(
        {
            scrollTop: $("" + div)[0].scrollHeight,
        },
        1000
    );
}

function delete_file(message_id) {
    if (confirm("Are you sure want to delete this document?")) {
        $.ajax({
            type: "POST",
            url: BASE_URL + "DELETE-CHAT-DOCUMENT",
            data: {
                message_id: message_id,
            },
            dataType: "json",
            beforeSend: function (xhr) { },
            success: function (response) {
                fetch_new_message();
            },
        });
    }
}
