<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">Job <small>Applications</small><span><button class="btn btn_theme2" data-toggle="modal" data-target="#addNewsModal">Add</button></span></h4>
  <div class="white_box">
    <?= $this->session->flashdata('responseMessage'); ?>
    <div class="card_bodym">
      <div class="table-responsive">
        <table id="extent_tbl1" class="table display">
          <thead>
            <tr>
              <th>S.No.</th>
              <th>Title</th>
              <th>Description</th>
              <th>User</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($jobApplications as $serialNumber => $jobApplication) {
              $description = strip_tags(substr($jobApplication['description'], 0, 120));
            ?>
              <tr>
                <td><?= $serialNumber + 1; ?></td>
                <td>
                    <a href="<?=site_url('Job-Details/') .$jobApplication['job_id'];?>" target="_blank"><?= $jobApplication['title']; ?></a>
                </td>
                <td><?= $description; ?></td>
                <td><?= $jobApplication['first_name'] .' ' .$jobApplication['last_name']; ?></td>
                <td>
                  <button class="btn btn-info btn-sm" onclick="alert('Coming Soon');" >Action</button>
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