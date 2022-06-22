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
                <?php
                    if($message['is_document'] == 1){
                ?>
                        <a target="_blank" href="<?=site_url($message['document']);?>">View</a><i class="fa fa-file"></i><a href="<?=site_url($message['document']);?>" download>Download</a>
                <?php
                    }
                    ?>
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