<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">Users <small>Management</small></h4>
  <div class="white_box">
    <div class="card_bodym">
      <div class="table-responsive">
        <table id="extent_tbl1" class="table display">
          <thead>
            <tr>
              <th>S.No.</th>
              <th>Name</th>
              <!-- <th>Username</th> -->
              <th>Email</th>
              <th>Job Title</th>
              <th>Address</th>
              <th>Phone</th>
              <th>National Insurance Number</th>
              <th>UK Work Permit</th>
              <th>Last Login</th>
              <th>Created</th>
              <!-- <th>Updated</th> -->
              <?php
              if (isset($permissions[5]) && $permissions[5]) {
              ?>
                <th>Action</th>
              <?php
              }
              ?>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($users as $serialNumber => $user) {
              $emailStatus = ($user['is_email_verified'] == 1) ? 'Verified' : 'Not verified';
              $statusClass = ($user['is_email_verified'] == 1) ? 'success' : 'danger';
            ?>
              <tr>
                <td><?= $serialNumber + 1; ?></td>
                <td>
                  <?= $user['first_name'] . ' ' . $user['last_name']; ?>
                  [<?= $user['username']; ?>]
                </td>
                <!-- <td><?= $user['username']; ?></td> -->
                <td>
                  <?= $user['email']; ?>
                  <strong><span class="text-<?= $statusClass; ?>">
                      (<?= $emailStatus; ?>)
                    </span></strong>
                </td>
                <td>Job Title</td>
                <td><?= $user['address']; ?></td>
                <td><?= $user['phone']; ?></td>
                <td><?= $user['national_insurance_number']; ?></td>
                <td><?= ($user['uk_work_permit']) ? 'Yes' : 'No'; ?></td>

                <td><?= ($user['last_login']) ? date("d M, Y", strtotime($user['last_login'])) : 'Not logged in yet'; ?></td>
                <td><?= date("d M, Y", strtotime($user['created'])); ?></td>
                <?php
                if (isset($permissions[5]) && $permissions[5]) {
                ?>
                  <td>
                    <!-- <a href="#" class="btn btn-info btn-xs">Send Mail</a>
                    <a href="#" class="btn btn-info btn-xs">Edit</a>
                    <a href="#" class="btn btn-danger btn-xs">Delete</a> -->
                    <a href="#" data-toggle="modal" data-target="#view_desss_<?= $user['id']; ?>" class="btn btn-info btn-xs">Documents</a>
                  </td>

                  <!-- Modal -->
                  <div class="modal fade " id="view_desss_<?= $user['id']; ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                      <form id="addForm" name="addForm" onsubmit="add_job_type(event);">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Details</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
                          </div>

                          <div class="modal-body">
                            <div class="box_n1">
                              <ul class="ul_set">
                                <li>
                                  <img src="<?= site_url('assets/admin/'); ?>img/img_2.png" alt=""> Resume File
                                  <span>
                                    <?php
                                    if (!empty($user['resume'])) {
                                    ?>
                                      <a href="<?= site_url($user['resume']); ?>" target="_blank"> <i class='fa fa-eye'></i> </a>
                                      <?php
                                      if (isset($permissions[6]) && $permissions[6]) {
                                      ?>
                                        <a href="<?= site_url($user['resume']); ?>"><i class="fa fa-download"></i></a>
                                        <!-- <a href="javascript:void(0);"><i class="fa fa-trash"></i></a> -->
                                      <?php
                                      }
                                      ?>
                                    <?php
                                    } else {
                                    ?>
                                      <span class="text-danger pull-right"> No resume uploaded yet. </span>
                                    <?php
                                    }
                                    ?>
                                  </span>
                                </li>
                                <?php
                                foreach ($user['userDocuments'] as $userDoc) {
                                ?>
                                  <li>
                                    <?= ($userDoc['doc_type'] == 2) ? '<i class="fa fa-comment" aria-hidden="true"></i>' : ''; ?>
                                    <img src="<?= site_url('assets/admin/'); ?>img/img_2.png" alt=""> <?= ($userDoc['doc_name']) ? $userDoc['doc_name'] : "<i>(No name)</i>"; ?>
                                    <span>
                                      <a href="<?= site_url($userDoc['document']); ?>" target="_blank"><i class="fa fa-eye"></i></a>
                                      <?php
                                      if (isset($permissions[6]) && $permissions[6]) {
                                      ?>
                                        <a href="<?= site_url($userDoc['document']); ?>" download><i class="fa fa-download"></i></a>
                                        <!-- <a href="javascript:void(0);"><i class="fa fa-trash"></i></a> -->
                                      <?php
                                      }
                                      ?>
                                    </span>
                                  </li>
                                <?php
                                }
                                ?>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <!-- Modal close-->
                <?php
                }
                ?>
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