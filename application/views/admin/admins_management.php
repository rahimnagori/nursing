<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">
    Admins <small>Management</small>
    <?php
    if (isset($permissions[2]) && $permissions[2]) {
    ?>
      <span><button class="btn btn_theme2" data-toggle="modal" data-target="#addAdminModal">Add</button></span>
    <?php
    }
    ?>
  </h4>
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
              <!-- <th>Type</th> -->
              <th>Phone</th>
              <th>Last Login</th>
              <th>Created</th>
              <?php
              if (isset($permissions[3]) && $permissions[3]) {
              ?>
                <th>Action</th>
              <?php
              }
              ?>
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
                <!-- <td><?= ($admin['admin_type'] == 1) ? 'Super Admin' : 'Admin'; ?></td> -->
                <td><?= $admin['phone']; ?></td>
                <td><?= ($admin['last_login']) ? date("d M, Y", strtotime($admin['last_login'])) : 'Not logged in yet'; ?></td>
                <td><?= date("d M, Y", strtotime($admin['created'])); ?></td>
                <?php
                if (isset($permissions[3]) && $permissions[3]) {
                ?>
                  <td>
                    <button type="button" onclick="delete_admin(<?= $admin['id']; ?>);" class="btn btn-danger btn-xs">Delete</button>
                    <button type="button" onclick="block_unblock_admin(<?= $admin['id']; ?>, <?= ($admin['status']) ? 0 : 1; ?>);" class="btn btn-warning btn-xs"><?= ($admin['status']) ? 'Block' : 'Unblock'; ?></button>
                    <button type="button" onclick="get_admin_permissions(<?= $admin['id']; ?>);" class="btn btn-secondary btn-xs">Permissions</button>
                  </td>
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
            <!-- <div class="form-group">
              <label> Admin Type </label>
              <select class="form-control" name="admin_type" required="">
                <option value="1">Super Admin</option>
                <option value="2">Admin</option>
              </select>
            </div> -->
            <!-- Only one Super Admin is possible -->
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
<div class="modal fade " id="admin_permissions_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="updatePermissionForm" name="updatePermissionForm" onsubmit="update_admin_permissions(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update permissions</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
        </div>

        <div class="modal-body" id="admin-permission-element">
          <!-- Dynamic permissions from permissions.php -->
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success btn_submit">Update</button>
          <button type="button" data-dismiss="modal" class="btn btn-info">Close</button>
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

  function get_admin_permissions(adminId) {
    $.ajax({
      type: 'GET',
      url: BASE_URL + 'Get-Permissions',
      data: {
        admin_id: adminId
      },
      dataType: 'HTML',
      beforeSend: function(xhr) {
        $("#admin-permission-element").html("<i class='fa fa-spin fa-spinner' aria-hidden='true'></i>");
        $("#admin_permissions_modal").modal("show");
      },
      success: function(response) {
        $("#admin-permission-element").html(response);
      }
    });
  }

  function update_admin_permissions(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Update-Permissions',
      data: new FormData($('#updatePermissionForm')[0]),
      dataType: 'JSON',
      processData: false,
      contentType: false,
      cache: false,
      beforeSend: function(xhr) {
        $(".btn_submit").attr('disabled', true);
        $(".btn_submit").html(LOADING);
        $("#permissionResponseMessage").html('');
        $("#permissionResponseMessage").hide();
      },
      success: function(response) {
        $(".btn_submit").prop('disabled', false);
        $(".btn_submit").html('Update');
        $("#permissionResponseMessage").html(response.responseMessage);
        $("#permissionResponseMessage").show();
      }
    });
  }

  function delete_admin(admin_id) {
    if (confirm("Are you sure want to delete this Admin? This action cannot be undone.")) {
      $.ajax({
        type: 'POST',
        url: BASE_URL + 'Delete-Admin',
        data: {
          admin_id: admin_id
        },
        dataType: 'JSON',
        success: function(response) {
          location.reload();
        }
      });
    }
  }

  function block_unblock_admin(admin_id, status) {
    let statusMessage = status ? 'unblock' : 'block';
    if (confirm(`Are you sure want to ${statusMessage} this Admin?`)) {
      $.ajax({
        type: 'POST',
        url: BASE_URL + 'Block-Unblock-Admin',
        data: {
          admin_id: admin_id,
          status: status
        },
        dataType: 'JSON',
        success: function(response) {
          location.reload();
        }
      });
    }
  }
</script>