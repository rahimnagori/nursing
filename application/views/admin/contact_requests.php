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

<!-- Modal -->
<div class="modal fade" id="addJobModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="addForm" name="addForm" onsubmit="add_job(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Job</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
        </div>

        <div class="modal-body">
          <div class="optio_raddipo">
            <div class="form-group">
              <label> Title </label>
              <input type="text" name="title" class="form-control" required="">
            </div>
            <div class="form-group">
              <label> Location </label>
              <select class="form-control" name="job_type" onchange="update_location(this.value);">
                <?php
                foreach ($jobTypes as $jobType) {
                ?>
                  <option value="<?= $jobType['id']; ?>"><?= $jobType['name']; ?></option>
                <?php
                }
                ?>
                <option value="other">Other</option>
              </select>
            </div>
            <div class="responseMessage" id="addLocationHtml">

            </div>
            <div class="form-group">
              <label> Salary </label>
              <div class="input-group">
                <span class="input-group-addon">$</span>
                <input type="number" name="salary" class="form-control" required="">
              </div>
            </div>
            <div class="form-group">
              <label> Description </label>
              <textarea class="form-control textarea" name="description" required=""></textarea>
            </div>
            <div class="form-group">
              <label> Qualification </label>
              <input type="text" name="qualification" class="form-control" required="">
            </div>
            <div class="form-group">
              <label> Employment Type </label>
              <label class="radio"> Permanent
                <input type="radio" value="1" checked="checked" name="employment_type">
                <span class="checkround"></span>
              </label>
              <label class="radio"> Temporary
                <input type="radio" value="0" name="employment_type">
                <span class="checkround"></span>
              </label>
            </div>
            <div class="form-group">
              <label> Last Date </label>
              <input type="date" name="last_date" class="form-control" required="">
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
<div class="modal fade" id="deleteJobModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="deleteForm" name="deleteForm" onsubmit="delete_job(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirmation</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
        </div>

        <div class="modal-body">
          <div class="optio_raddipo">
            <div class="form-group">
              <label> Are you sure you want to delete this Job? </label>
              <input type="hidden" name="delete_job_id" id="delete_job_id" />
            </div>
            <div class="row">
              <div class="col-sm-12" class="responseMessage" id="responseMessage"></div>
            </div>
            <div class="form-group">
              <button class="btn btn_theme2 btn-lg btn_submit">Yes</button>
              <button class="btn btn-lg btn-info" class="close" data-dismiss="modal" aria-label="Close">No</button>
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
<?php include 'include/tinymce.php'; ?>

<script>
  function add_job(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Admin-Jobs/Add',
      data: new FormData($('#addForm')[0]),
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

  function open_delete_modal(id) {
    $("#delete_job_id").val(id);
    $("#deleteJobModal").modal("show");
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

  function update_location(locationType) {
    if (locationType == 'other') {
      $("#addLocationHtml").html(`<input type="text" name="name" id="location" class="form-control" required="" placeholder="Add other..." />`);
      $("#addLocationHtml").show();
    } else {
      $("#addLocationHtml").hide();
      $("#addLocationHtml").html("");
    }
  }
</script>