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
                    <span class="message_box"><?= $message['message']; ?>
                    <?php
                    if($message['is_document'] == 1){
                ?>
                    <i class="fa fa-file size_m"></i>
                
                    <span class="user_dropp2">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-ellipsis-v"></i>
                </a>
                <span class="dropdown-menu">
                  <span><a class="" target="_blank" href="<?=site_url($message['document']);?>"   ><i class="fa fa-eye" aria-hidden="true"></i> View File</a></span>
                  <span><a class="" href="<?=site_url($message['document']);?>"    download><i class="fa fa-download" aria-hidden="true"></i> Download File</a></span>
                <span><a href="javascript:void(0);" class="" onclick="delete_file(<?=$message['document_id'];?>)"  ><i class="fa fa-trash" aria-hidden="true"></i> Delete File</a></span>
                </span>
              </span>
              <?php
                    }
                    ?>
                </span> 


                  


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