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
                        <a class="action_button btn btn-xs" target="_blank" href="<?=site_url($message['document']);?>" data-toggle="tooltip" title="View File" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                        <i class="fa fa-file"></i>
                        <a class="action_button btn btn-xs" href="<?=site_url($message['document']);?>"  data-toggle="tooltip" title="Download File" download><i class="fa fa-download" aria-hidden="true"></i></a>
                        <a href="javascript:void(0);" class="btn btn-danger btn-xs" onclick="delete_file(<?=$message['document_id'];?>)" data-toggle="tooltip" title="Delete File"><i class="fa fa-trash" aria-hidden="true"></i></a>
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