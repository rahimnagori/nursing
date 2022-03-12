<div class="form-group">
  <label> Service Name </label>
  <input type="text" class="form-control" required name="service_name" value="<?=$serviceDetails['service_name'];?>" >
  <input type="hidden" required name="service_id" value="<?=$serviceDetails['id'];?>" >
</div>

<div class="form-group">
  <label> Service Description </label>
  <textarea class="form-control textarea-edit" id="edit-description" required name="service_description" ><?=$serviceDetails['service_description'];?></textarea>
</div>

<div class="form-group">
  <label> Service Details </label>
  <textarea class="form-control textarea-edit textarea-edit-two" id="edit-details" required name="service_details" ><?=$serviceDetails['service_details'];?></textarea>
</div>

<div class="form-group" id="edit_image_section" >
  <label> Image </label>
  <input type="file" accept="image/*" name="service_image_update" onchange="preview_image(this, 'edit_preview_image');" id="edit_image_input" >
  <input type="hidden" name="thumbnail_old" value="<?=$serviceDetails['service_image'];?>" >
  <img id="edit_preview_image" src="<?=site_url($serviceDetails['service_image']);?>" width="100" >
</div>

<div id="editResponseMessage"></div>