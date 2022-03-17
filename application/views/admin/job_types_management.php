<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">Job Types <small>Management</small><span><button class="btn btn_theme2" data-toggle="modal" data-target="#addJobTypeModal">Add</button></span></h4>
  <div class="white_box">
    <?=$this->session->flashdata('responseMessage');?>
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
                  <td><?=$jobType['name'];?></td>
                  <td>
                    <button onclick="edit_job_type(<?=$jobType['id']?>)" class="btn btn-info btn-sm">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="open_delete_modal(<?=$jobType['id']?>)" >Delete</button>
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
<div class="modal fade" id="addJobTypeModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="addForm" name="addForm" onsubmit="add_job_type(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Job Type</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
        </div>

        <div class="modal-body">
          <div class="optio_raddipo">
            <div class="form-group">
              <label> Job Type </label>
              <input type="text" name="name" class="form-control" required="" >
            </div>
            <div class="row">
              <div class="col-sm-12" class="responseMessage" id="responseMessage"></div>
            </div>
            <div class="form-group">
              <button class="btn btn_theme2 btn-lg btn_submit" >Add</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Modal close-->

<!-- Modal -->
<div class="modal fade" id="deleteJobTypeModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="deleteForm" name="deleteForm" onsubmit="delete_job_type(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirmation</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
        </div>

        <div class="modal-body">
          <div class="optio_raddipo">
            <div class="form-group">
              <label> Are you sure you want to delete this Job Type? </label>
              <input type="hidden" name="delete_job_type_id" id="delete_job_type_id" />
            </div>
            <div class="row">
              <div class="col-sm-12" class="responseMessage" id="responseMessage"></div>
            </div>
            <div class="form-group">
              <button class="btn btn_theme2 btn-lg btn_submit" >Yes</button>
              <button class="btn btn-lg btn-info" class="close" data-dismiss="modal" aria-label="Close" >No</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Modal close-->

<!-- Modal -->
<div class="modal fade" id="editJobTypeModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="editForm" name="editForm" onsubmit="update_job_type(event);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Job Type</h4>
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
  function add_job_type(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Job-Type/Add',
      data: new FormData($('#addForm')[0]),
      dataType:'JSON',
      processData: false,
      contentType: false,
      cache: false,
      beforeSend: function( xhr ) {
        $(".btn_submit").attr('disabled' , true);
        $(".btn_submit").html(LOADING);
        $("#responseMessage").html('');
        $("#responseMessage").hide();
      },
      success:function(response){
        $(".submit-btn").prop('disabled', false);
        $(".submit-btn").html(' Add ');
        if(response.status == 1) location.reload();
      }
    });
  }

  function open_delete_modal(id){
    $("#delete_job_type_id").val(id);
    $("#deleteJobTypeModal").modal("show");
  }

  function delete_job_type(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Job-Type/delete',
      data: new FormData($('#deleteForm')[0]),
      dataType:'JSON',
      processData: false,
      contentType: false,
      cache: false,
      beforeSend: function( xhr ) {
        $(".btn_submit").attr('disabled' , true);
        $(".btn_submit").html(LOADING);
        $("#responseMessage").html('');
        $("#responseMessage").hide();
      },
      success:function(response){
        $(".submit-btn").prop('disabled', false);
        $(".submit-btn").html(' Yes ');
        if(response.status == 1) location.reload();
      }
    });
  }

  function edit_job_type(job_type_id){
    $.ajax({
      type: 'GET',
      url: BASE_URL + 'Job-Type/Get/' + job_type_id,
      dataType: 'HTML',
      beforeSend: function( xhr ) {
        $("#editModal").html("<i class='fa fa-spin fa-spinner' aria-hidden='true'></i>")
        $("#editJobTypeModal").modal("show");
      },
      success:function(response){
        $("#editModal").html(response)
      }
    });
  }
  function update_job_type(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Job-Type/Update',
      data: new FormData($('#editForm')[0]),
      dataType:'JSON',
      processData: false,
      contentType: false,
      cache: false,
      beforeSend: function( xhr ) {
        $(".btn_submit").attr('disabled' , true);
        $(".btn_submit").html(LOADING);
        $("#responseMessage").html('');
        $("#responseMessage").hide();
      },
      success:function(response){
        $(".submit-btn").prop('disabled', false);
        $(".submit-btn").html(' Update ');
        if(response.status == 1) location.reload();
      }
    });
  }
</script>