<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">Dasboard</h4>
  <div class="white_box">
    <div class="card_bodym">
      <div class="table-responsive">
        <table id="extent_tbl1" class="table display">
          <thead>
            <tr>
              <th>S.No.</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Last Login</th>
              <th>Created</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach($organizations as $serialNumber => $organization){
                $emailStatus = ($organization['is_email_verified'] == 1) ? 'Verified' : 'Not verified';
                $statusClass = ($organization['is_email_verified'] == 1) ? 'success' : 'danger';
            ?>
                <tr>
                  <td><?=$serialNumber + 1;?></td>
                  <td><?=$organization['first_name'] .' ' .$organization['last_name'];?></td>
                  <td>
                    <?=$organization['email'];?> 
                    <strong><span class="text-<?=$statusClass;?>">
                      (<?=$emailStatus;?>)
                    </span></strong>
                  </td>
                  <td><?=$organization['phone'];?></td>
                  <td><?=date("d M, Y", strtotime($organization['last_login']));?></td>
                  <td><?=date("d M, Y", strtotime($organization['created']));?></td>
                  <td>
                    <a href="#" class="btn btn-info btn-sm">Send Mail</a>
                    <a href="#" class="btn btn-info btn-sm">Edit</a>
                    <a href="#" class="btn btn-danger btn-sm">Delete</a>
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