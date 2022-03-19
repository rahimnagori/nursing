<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">Contact Requests <small>Management</small></h4>
  <div class="white_box">
    <?= $this->session->flashdata('responseMessage'); ?>
    <div class="card_bodym">
      <div class="table-responsive">
        <table id="extent_tbl1" class="table display">
          <thead>
            <tr>
              <th>S.No.</th>
              <th>Full Name</th>
              <th>Email</th>
              <th>Telephone</th>
              <th>Message</th>
              <th>Resume</th>
              <th>Use of Data Consent</th>
              <th>Privacy Consent</th>
              <th>Created</th>
              <th>Updated</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($contactRequests as $serialNumber => $contactRequest) {
            ?>
              <tr>
                <td><?=$serialNumber + 1;?></td>
                <td><?=$contactRequest['full_name'];?></td>
                <td><?=$contactRequest['email'] ?></td>
                <td><?=$contactRequest['phone'];?></td>
                <td><?=$contactRequest['message'];?></td>
                <td>
                  <a href="<?=site_url($contactRequest['resume']);?>" download> Download <a>
                </td>
                <td><?=($contactRequest['process_policy']) ? 'Yes' : 'No';?></td>
                <td><?=($contactRequest['collect_policy']) ? 'Yes' : 'No';?></td>
                <td><?=date("d M, Y", strtotime( $contactRequest['created']));?></td>
                <td><?=date("d M, Y", strtotime( $contactRequest['updated']));?></td>
                <td>
                  <!-- <button onclick="edit_job(<?=  $contactRequest['id'] ?>)" class="btn btn-info btn-sm">Edit</button>
                  <button class="btn btn-danger btn-sm" onclick="open_delete_modal(<?=  $contactRequest['id'] ?>)">Delete</button> -->
                  Actions ?
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include 'include/footer.php'; ?>