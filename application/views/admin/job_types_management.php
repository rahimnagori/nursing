<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">Job Types <small>Management</small></h4>
  <div class="white_box">
    <div class="card_bodym">
      <div class="table-responsive">
        <table id="extent_tbl1" class="table display">
          <thead>
            <tr>
              <th>S.No.</th>
              <th>Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach($jobTypes as $serialNumber => $jobType){
            ?>
                <tr>
                  <td><?=$serialNumber + 1;?></td>
                  <td><?=$jobType['phone'];?></td>
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