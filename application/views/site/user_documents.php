<style>
   .tradup_img2 {
	object-fit: contain;
	padding: 10px;
}
</style>
<h4 class="hedding_right">Documents <small>You can add up to 8 documents at max.</small></h4>
<div class="card_bodym">
   <div id="responseMessage"></div>
   <label>Upload Support Document</label>
   <div class="row uuss_rowws d_flex" id="document_div">
      <?php
      foreach ($userDocuments as $userDocument) {
      ?>
         <div class="col-sm-3" id="document_div_index_<?= $userDocument['id']; ?>">
            <div class="image_uplod1">
               <img src="<?= site_url('assets/site/'); ?>img/doc.svg" class="tradup_img2">
               <div class="btttponm_psuiui">
                  <a href="<?= site_url($userDocument['document']); ?>" class="btn btn_theme" data-toggle="tooltip" data-placement="left" title="View" target="_blank"><i class="fa fa-eye"></i></a>
                  <a href="<?= site_url($userDocument['document']); ?>" class="btn btn_theme" data-toggle="tooltip" data-placement="left" title="Download" download><i class="fa fa-download"></i></a>
                  <button type="button" onclick="delete_document(<?= $userDocument['id']; ?>);" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Delete">
                     <i class="fa fa-trash"></i>
                  </button>
               </div>
            </div>
            <?= ($userDocument['doc_name']) ? "<p>" . $userDocument['doc_name'] . "</p>" : ''; ?>
         </div>
      <?php
      }
      ?>
      <div class="col-sm-3" id="add_new_document" <?= (count($userDocuments) >= 8) ? 'style="display:none;"' : ''; ?>>
         <div class="image_uplod1">
            <img src="<?= site_url('assets/site/'); ?>img/icon_us2.png" class="tradup_img1">
            <form id="documentForm" name="documentForm" onsubmit="upload_document(event);">
               <input type="text" id="doc_name" name="doc_name" class="form-control fon_text" required="" placeholder="Name of Document">
               <input type="file" id="upload_file_input" onchange="check_files();" name="document" accept=".doc, .docx, .pdf" class="uplldui">
            </form>
         </div>
      </div>
   </div>
</div>

<script>
   function upload_document(e) {
      e.preventDefault();
      $.ajax({
         type: 'POST',
         url: BASE_URL + 'Update-Document',
         data: new FormData($('#documentForm')[0]),
         dataType: 'JSON',
         processData: false,
         contentType: false,
         cache: false,
         beforeSend: function(xhr) {
            $("#responseMessage").html('');
            $("#responseMessage").hide();
         },
         success: function(response) {
            if (response.status == 1) {
               $("#doc_name").val('');
               $("#document_div").prepend(documentDiv(response.document));
            }
            if (response.totalDocuments > 8) {
               $("#add_new_document").hide();
            }
            $("#responseMessage").html(response.responseMessage);
            $("#responseMessage").show();
            $("#upload_file_input").val('');
         }
      });
   }

   function delete_document(document_id) {
      if (confirm("Are you sure want to delete this document?")) {
         $.ajax({
            type: 'POST',
            url: BASE_URL + 'Delete-Document',
            data: {
               document_id: document_id
            },
            dataType: 'JSON',
            beforeSend: function(xhr) {
               $("#responseMessage").html('');
               $("#responseMessage").hide();
            },
            success: function(response) {
               if (response.status == 1) {
                  $("#document_div_index_" + document_id).remove();
               }
               if (response.totalDocuments <= 8) {
                  $("#add_new_document").show();
               }
               $("#responseMessage").html(response.responseMessage);
               $("#responseMessage").show();
            }
         });
      }
   }

   function check_files() {
      let inputFile = $("#upload_file_input")[0].files[0];
      if (inputFile != undefined) {
         $('#documentForm').submit();
      }
   }

   const documentDiv = (document) => {
      return `<div class="col-sm-3" id="document_div_index_${document.id}">
         <div class="image_uplod1">
            <img src="<?= site_url('assets/site/'); ?>img/doc.svg" class="tradup_img2">
            <div class="btttponm_psuiui">
               <a href="${BASE_URL + document.path}" class="btn btn_theme" data-toggle="tooltip" data-placement="left" title="View" target="_blank" ><i class="fa fa-eye"></i></a>
               <a href="${BASE_URL + document.path}" class="btn btn_theme" data-toggle="tooltip" data-placement="left" title="Download" download ><i class="fa fa-download"></i></a>
               <button type="button" onclick="delete_document(${document.id});" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Delete">
               <i class="fa fa-trash"></i>
            </button>
            </div>
         </div>
         <p>${document.name}</p>
      </div>`
   }
</script>