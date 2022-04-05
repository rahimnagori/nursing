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
if (empty($messages)) {
?>
    <p class="text-center">No messages yet! Start conversation by sending a new one.
    <?php
}
    ?>