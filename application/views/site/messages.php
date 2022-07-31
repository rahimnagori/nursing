<?php
foreach ($messages as $message) {
?>
    <li class="<?= ($message['is_admin'] == 0) ? 'sender' : 'recever'; ?>">
        <div class="message-data">
            <div class="mess_dat_img">
                <!-- <img src="<?= site_url('assets/site/img/'); ?>logo.png"> -->
                <span class="name_d">
                    <?php
                    if ($message['is_admin'] == 1) {
                        echo "A";
                    } else {
                        if ($this->session->userdata('is_user_logged_in')) {
                            echo substr($userDetails['first_name'], 0, 1);
                        } else {
                            echo "U";
                        }
                    }
                    ?>
                </span>
            </div>
            <div class="messge_cont">
                <h4>
                    <?php
                    if ($this->session->userdata('is_user_logged_in')) {
                        echo ($message['is_admin'] == 1) ? 'Admin' : $userDetails['first_name'] . ' ' . $userDetails['last_name'];
                    }
                    ?>
                </h4>
                <p>
                    <span class="message_box"><?= $message['message']; ?>
                        <?php
                        if ($message['is_document'] == 1) {
                        ?>
                            <i class="fa fa-file size_m"></i>
                            <span class="user_dropp2">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="open_file_options();">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <span class="dropdown-menu">
                                    <span><a class="" target="_blank" href="<?= site_url($message['document']); ?>"><i class="fa fa-eye" aria-hidden="true"></i> View File</a></span>
                                    <span><a class="" href="<?= site_url($message['document']); ?>" download><i class="fa fa-download" aria-hidden="true"></i> Download File</a></span>
                                    <?php
                                        if($this->session->userdata('is_user_logged_in') || $this->session->userdata('is_admin_logged_in') && isset($permissions[27]) && $permissions[27]){
                                    ?>
                                            <span><a href="javascript:void(0);" class="" onclick="delete_file(<?= $message['id']; ?>)"><i class="fa fa-trash" aria-hidden="true"></i> Delete File</a></span>
                                    <?php
                                        }
                                    ?>
                                </span>
                            </span>
                        <?php
                        }
                        ?>
                    </span>
                    <?php
                        if($message['is_document'] != 1 && $message['is_deleted'] != 1){
                            if ($this->session->userdata('is_user_logged_in') && $message['is_admin'] == 0) {
                    ?>
                                <button type="button" onclick="delete_message(<?= $message['id']; ?>);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                    <?php
                            }
                            if ($this->session->userdata('is_admin_logged_in') && isset($permissions[26]) && $permissions[26]) {
                    ?>
                                <button type="button" onclick="delete_message(<?= $message['id']; ?>);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                    <?php
                            }
                        }
                    ?>
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