<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">Admins <small>Management</small><span><button class="btn btn_theme2" data-toggle="modal" data-target="#addAdminModal">Add</button></span></h4>
  <div class="white_box">
    <?= $this->session->flashdata('responseMessage'); ?>
    <div class="card_bodym">
      <div class="table-responsive">
        <table id="extent_tbl1" class="table display">
          <thead>
            <tr>
              <th>S.No.</th>
              <th>Name</th>
              <th>Email</th>
              <th>Type</th>
              <th>Phone</th>
              <th>Last Login</th>
              <th>Created</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($admins as $serialNumber => $admin) {
              $emailStatus = ($admin['is_email_verified'] == 1) ? 'Verified' : 'Not verified';
              $statusClass = ($admin['is_email_verified'] == 1) ? 'success' : 'danger';
            ?>
              <tr>
                <td><?= $serialNumber + 1; ?></td>
                <td>
                  <?= $admin['first_name'] . ' ' . $admin['last_name']; ?>
                </td>
                <td>
                  <?= $admin['email']; ?>
                  <strong>
                    <span class="text-<?= $statusClass; ?>">(<?= $emailStatus; ?>)</span>
                  </strong>
                </td>
                <td><?= ($admin['admin_type'] == 1) ? 'Super Admin' : 'Admin'; ?></td>
                <td><?= $admin['phone']; ?></td>
                <td><?= ($admin['last_login']) ? date("d M, Y", strtotime($admin['last_login'])) : 'Not logged in yet'; ?></td>
                <td><?= date("d M, Y", strtotime($admin['created'])); ?></td>
                <td>
                  Actions
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

<!-- Modal -->
<div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="addAdminForm" name="addAdminForm" onsubmit="add_admin(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Admin</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
        </div>

        <div class="modal-body">
          <div class="optio_raddipo">
            <div class="form-group">
              <label> First Name </label>
              <input type="text" name="first_name" class="form-control" required="">
            </div>
            <div class="form-group">
              <label> Last Name </label>
              <input type="text" name="last_name" class="form-control" required="">
            </div>
            <div class="form-group">
              <label> Phone </label>
              <input type="number" name="phone" class="form-control" required="">
            </div>
            <div class="form-group">
              <label> Email </label>
              <input type="email" name="email" class="form-control" required="">
            </div>
            <div class="form-group">
              <label> Admin Type </label>
              <select class="form-control" name="admin_type" required="">
                <option value="1">Super Admin</option>
                <option value="2">Admin</option>
              </select>
            </div>
            <div class="row">
              <div class="col-sm-12" class="responseMessage" id="responseMessage"></div>
            </div>
            <div class="form-group">
              <button class="btn btn_theme2 btn-lg btn_submit">Add</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Modal close-->

<!-- Modal -->
<div class="modal fade" id="editJobModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="editForm" name="editForm" onsubmit="update_job(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Job</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
        </div>

        <div class="modal-body" id="editModal">
          <i class='fa fa-spin fa-spinner' aria-hidden='true'></i>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Modal close-->

<?php include 'include/footer.php'; ?>

<script>
  function add_admin(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Create-Admin',
      data: new FormData($('#addAdminForm')[0]),
      dataType: 'JSON',
      processData: false,
      contentType: false,
      cache: false,
      beforeSend: function(xhr) {
        $(".btn_submit").attr('disabled', true);
        $(".btn_submit").html(LOADING);
        $("#responseMessage").html('');
        $("#responseMessage").hide();
      },
      success: function(response) {
        $(".btn_submit").prop('disabled', false);
        $(".btn_submit").html(' Add ');
        if (response.status == 1) location.reload();
      }
    });
  }

  function delete_job(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Admin-Jobs/delete',
      data: new FormData($('#deleteForm')[0]),
      dataType: 'JSON',
      processData: false,
      contentType: false,
      cache: false,
      beforeSend: function(xhr) {
        $(".btn_submit").attr('disabled', true);
        $(".btn_submit").html(LOADING);
        $("#responseMessage").html('');
        $("#responseMessage").hide();
      },
      success: function(response) {
        $(".btn_submit").prop('disabled', false);
        $(".btn_submit").html(' Yes ');
        if (response.status == 1) location.reload();
      }
    });
  }

  function edit_job(job_id) {
    $.ajax({
      type: 'GET',
      url: BASE_URL + 'Admin-Jobs/Get/' + job_id,
      dataType: 'HTML',
      beforeSend: function(xhr) {
        $("#editModal").html("<i class='fa fa-spin fa-spinner' aria-hidden='true'></i>")
        $("#editJobModal").modal("show");
      },
      success: function(response) {
        $("#editModal").html(response);
        update_tiny('textarea-edit');
      }
    });
  }

  function update_job(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Admin-Jobs/Update',
      data: new FormData($('#editForm')[0]),
      dataType: 'JSON',
      processData: false,
      contentType: false,
      cache: false,
      beforeSend: function(xhr) {
        $(".btn_submit").attr('disabled', true);
        $(".btn_submit").html(LOADING);
        $("#responseMessage").html('');
        $("#responseMessage").hide();
      },
      success: function(response) {
        $(".btn_submit").prop('disabled', false);
        $(".btn_submit").html(' Update ');
        if (response.status == 1) location.reload();
      }
    });
  }
</script>