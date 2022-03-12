<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">Document Types</h4>
  <h4 class="text-right"><button type="button" class="btn btn_theme2 btn-md" data-toggle="modal" data-target="#addDocumentModal">Add Document</button></h4>
  <div class="white_box">
    <div class="card_bodym">
      <div class="table-responsive">
        <table id="extent_tbl1" class="table display">
          <thead>
            <tr>
              <th>S.No.</th>
              <th>Document Name</th>
              <th>Mandatory</th>
              <th>Created By</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach($documentTypes as $serialNumber => $documentType){
                $mandatoryStatus = ($documentType['is_mandatory'] == 1) ? 'Mandatory' : 'Not mandatory';
            ?>
                <tr>
                  <td><?=$serialNumber + 1;?></td>
                  <td><?=$documentType['document_name'];?></td>
                  <td><?=$mandatoryStatus;?></td>
                  <td><?=$documentType['created_by'];?></td>
                  <td>
                    <a href="#" class="btn btn_theme2 btn-sm">Edit</a>
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

<!-- Modal -->
<div class="modal fade " id="addDocumentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Document Type</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
      </div>
      <div class="modal-body">
        <div class="optio_raddipo">
          <div class="form-group">
            <label>Document Type</label>
            <input type="text" class="form-control" placeholder="" required />
          </div>

          <div class="form-group">
            <label class="check ">Mandatory
            <input type="checkbox" name="Scheduling_dtae">
            <span class="checkmark"></span>
            </label>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn_theme2 btn-lg">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'include/footer.php'; ?>