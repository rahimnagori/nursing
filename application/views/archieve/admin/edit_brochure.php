<div class="form-group" >
  <label> Preview </label>
  <iframe src="<?=site_url($brochureDetails['brochure']);?>" width="100%" height="400px"></iframe>
</div>

<div class="form-group" >
  <label> Brochure </label>
  <input type="hidden" required name="brochure_id" value="<?=$brochureDetails['id'];?>" >
  <input type="file" accept=".pdf" name="brochure_update" >
  <input type="hidden" name="brochure_old" value="<?=$brochureDetails['brochure'];?>" >
</div>

<div id="editResponseMessage"></div>