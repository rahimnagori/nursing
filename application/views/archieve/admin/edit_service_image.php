<div class="form-group" id="edit_image_section" >
  <label> Image </label>
  <input type="hidden" required name="service_image_id" value="<?=$serviceImageDetails['id'];?>" >
  <input type="file" accept="image/*" name="service_image_update" onchange="preview_image(this, 'edit_preview_image');" id="edit_image_input" >
  <input type="hidden" name="thumbnail_old" value="<?=$serviceImageDetails['service_image'];?>" >
  <img id="edit_preview_image" src="<?=site_url($serviceImageDetails['service_image']);?>" width="100" >
</div>

<div id="editResponseMessage"></div>