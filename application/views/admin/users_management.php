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
              <th>Username</th>
              <th>Email</th>
              <th>Name</th>
              <th>Job Title</th>
              <th>Address</th>
              <th>Phone</th>
              <th>National Insurance Number</th>
              <th>UK Work Permit</th>
              <th>Resume</th>
              <th>Last Login</th>
              <th>Created</th>
              <th>Updated</th>
              <th>Action</th>
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
                <td><?= $user['username']; ?></td>
                <td>
                  <?= $user['email']; ?>
                  <strong><span class="text-<?= $statusClass; ?>">
                      (<?= $emailStatus; ?>)
                    </span></strong>
                </td>
                <td><?= $user['first_name'] . ' ' . $user['last_name']; ?></td>
                <td>Job Title</td>
                <td><?= $user['address']; ?></td>
                <td><?= $user['phone']; ?></td>
                <td><?= $user['national_insurance_number']; ?></td>
                <td><?= $user['uk_work_permit']; ?></td>
                <td>
                  <?php
                  $resume = 'No resume uploaded yet';
                  if (!empty($user['resume'])) {
                    $resume = "<a href='" .$user['resume'] ."' download> View </a>";
                  }
                  ?>
                  <?= $resume; ?>
                </td>
                <td><?= ($user['last_login']) ? date("d M, Y", strtotime($user['last_login'])) : 'Not logged in yet'; ?></td>
                <td><?= date("d M, Y", strtotime($user['created'])); ?></td>
                <td><?= date("d M, Y", strtotime($user['updated'])); ?></td>
                <td>
                  <a href="#" class="btn btn-info btn-xs">Send Mail</a>
                  <a href="#" class="btn btn-info btn-xs">Edit</a>
                  <a href="#" class="btn btn-danger btn-xs">Delete</a>
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