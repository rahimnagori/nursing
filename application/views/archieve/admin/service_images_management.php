<?php include_once('include/header.php'); ?>

<style>
#addToolError, .editToolError, #video_section{
  display:none;
}
.pac-container{
  z-index: 1051 !important;
}
.margin-top{
  margin-top: 2%;
}
.delete-filter-btn{
  display:none;
}
.custom-multiselect .btn-group.custom-btn {
  width: 100%;
}
.custom-multiselect .multiselect {
  width: 100% !important;
  border: 1px solid #E1E1E1;
  box-shadow: none !important;
  text-align: left;
}
.custom-multiselect .dropdown-menu {
  min-height: 100%;
  width: 100%;
}
.custom-multiselect .dropdown-menu > li > a{
  padding: 8px 30px;
}
.custom-multiselect .dropdown-menu label{
  margin: 0;
}
.custom-multiselect .dropdown-menu {
  min-height: 100%;
  width: 100%;
  height: 150px;
  overflow: auto;
}

</style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Service Images
      <small>Management</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Service Images Management</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <?=$this->session->flashdata('responseMessage');?>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <span class="font-weight-bold text-uppercase">Update image for <strong><?=$serviceDetails['service_name'];?> </strong>Service</span>
            <span class="pull-right" >
              <a href="#" class="btn btn-info" data-toggle="modal" data-target="#addServiceImageModal" > Add Image </a>
              <a href="<?=site_url('Admin/Services');?>" class="btn btn-info" > <i class="fa fa-undo" aria-hidden="true"></i> </a>
            </span>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table id="boottable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>S.NO.</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach($serviceImages as $serialNumber => $serviceImage){
                  ?>
                      <tr>
                        <td><?=$serialNumber + 1; ?></td>
                        <td>
                          <img src="<?=site_url($serviceImage['service_image']);?>" width="100" >
                        </td>
                        <td>
                          <button type="button" onclick="get_service_image(<?=$serviceImage['id'];?>);" class="btn btn-info btn-xs"> Edit </button>
                          <button type="button" onclick="delete_service(<?=$serviceImage['id'];?>);" class="btn btn-danger btn-xs"> Delete </button>
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
    </div>
  </section>
</div>

<!-- Modal -->
<div id="addServiceImageModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <form id="addServiceImageForm" name="addServiceImageForm" method="POST" onsubmit="add_image(event);" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Image</h4>
        </div>
        <div class="modal-body">
          <div class="form-group" id="image_section" >
            <label> Image </label>
            <input type="hidden" name="service_id" value="<?=$serviceDetails['id'];?>" />
            <input type="file" required id="image_input" accept="image/*" name="service_image" onchange="preview_image(this, 'add_preview_image');" >
            <img id="add_preview_image" src="" width="100" >
          </div>

          <div id="responseMessage"></div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success btn-submit" > Add </button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>

  </div>
</div>

<!-- Modal -->
<div id="editServiceModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <form id="updateServiceImageForm" name="updateServiceImageForm" method="POST" onsubmit="update_service_image(event);" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Service Image</h4>
        </div>
        <div class="modal-body" id="edit-modal-body" > </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success btn-submit" > Update </button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>

  </div>
</div>

<?php include_once('include/footer.php');?>

<script>
  function preview_image(input, previewId) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#' + previewId).attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  function add_image(e){
    e.preventDefault();
    $.ajax({
      type: "POST",
      dataType: 'JSON',
      url: site_url + 'Admin_Services/Add_Image',
      data: new FormData($('#addServiceImageForm')[0]),
      processData: false,
      contentType: false,
      cache: false,
      beforeSend: function () {
        $("#responseMessage").html("");
        $(".btn-submit").prop('disabled', true);
        $(".btn-submit").html('<i class="fa fa-spin fa-spinner"></i> Processing...');
      },
      success: function (response) {
        location.reload();
        // $("#responseMessage").html(response.responseMessage);
        if (response.status == 1) {
          $('#addServiceImageForm')[0].reset();
          $('#add_preview_image').attr('src', '');
        }
        $(".btn-submit").prop('disabled', false);
        $(".btn-submit").html('Add');
      }
    })
  }

  function delete_service(service_image_id){
    if(confirm("Are you sure want to delete this service image?")){
      $.ajax({
        type: "POST",
        dataType: 'JSON',
        url: site_url + 'Admin_Services/Delete_Image',
        data: {
          'service_image_id' : service_image_id
        },
        beforeSend: function () {
        },
        success: function (response) {
          location.reload();
        }
      })
    }
  }

  function get_service_image(service_image_id){
    $.ajax({
      type: "POST",
      dataType: 'html',
      url: site_url + 'Admin_Services/Get_Image',
      data: {
        'service_image_id' : service_image_id
      },
      beforeSend: function () {
        $("#edit-modal-body").html("");
        $('#editServiceModal').modal('show');
        $('#editServiceModal').addClass('text-center');
        $("#edit-modal-body").html('<i style="font-size: 50px;" class="fa fa-spin fa-spinner"></i>');
      },
      success: function (response) {
        $('#editServiceModal').removeClass('text-center');
        $("#edit-modal-body").html("");
        $("#edit-modal-body").html(response);
      }
    })
  }

  function update_service_image(e){
    e.preventDefault();
    $.ajax({
      type: "POST",
      dataType: 'JSON',
      url: site_url + 'Admin_Services/Update_Image',
      data: new FormData($('#updateServiceImageForm')[0]),
      processData: false,
      contentType: false,
      cache: false,
      beforeSend: function () {
        $("#editResponseMessage").html("");
        $(".btn-submit").prop('disabled', true);
        $(".btn-submit").html('<i class="fa fa-spin fa-spinner"></i> Processing...');
      },
      success: function (response) {
        location.reload();
      }
    })
  }

  function update_tiny(){
    tinymce.init({
      menubar: false,
      branding: false,
      statusbar: false,
      selector: '.textarea-edit',
      height: 200,
      plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste textcolor"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor",
      setup: function (editor) {
        editor.on('change', function () {
          tinymce.triggerSave();
        });
      }
    });
  }
</script>