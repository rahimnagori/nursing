<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">News <small>Management</small></h4>
  <div class="white_box">
    <?= $this->session->flashdata('responseMessage'); ?>
    <div class="card_bodym">
      <div class="table-responsive">
        <table id="extent_tbl1" class="table display">
          <thead>
            <tr>
              <th>S.No.</th>
              <th>Name</th>
              <th>Company</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Staff Required</th>
              <th>Work Location</th>
              <th>File</th>
              <th>Description</th>
              <th>Created</th>
              <!-- <th>Updated</th>
              <th>Action</th> -->
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($professionalRequests as $serialNumber => $professionalRequest) {
              $description = strip_tags(substr($professionalRequest['description'], 0, 120));
            ?>
              <tr>
                <td><?= $serialNumber + 1; ?></td>
                <td><?= $professionalRequest['name']; ?></td>
                <td><?= $professionalRequest['company']; ?></td>
                <td><?= $professionalRequest['email']; ?></td>
                <td><?= $professionalRequest['phone']; ?></td>
                <td><?= $professionalRequest['staff_required']; ?></td>
                <td><?= $professionalRequest['work_location']; ?></td>
                <td>
                    <?php
                      if($professionalRequest['resume']){
                    ?>
                        <a href="<?= site_url($professionalRequest['resume']); ?>" download > View </a>
                    <?php
                      }
                    ?>
                </td>
                <td><?= $description; ?></td>
                <td><?= date("d M, Y", strtotime($professionalRequest['created'])); ?></td>
                <!-- <td><?= date("d M, Y", strtotime($professionalRequest['updated'])); ?></td>
                <td>
                  <button onclick="edit_news(<?= $professionalRequest['id'] ?>)" class="btn btn-info btn-sm">Edit</button>
                  <button class="btn btn-danger btn-sm" onclick="open_delete_modal(<?= $professionalRequest['id'] ?>)">Delete</button>
                </td> -->
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