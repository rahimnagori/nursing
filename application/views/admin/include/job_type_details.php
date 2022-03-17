<div class="optio_raddipo">
  <div class="form-group">
    <label> Job Type </label>
    <input type="text" name="name" class="form-control" value="<?=$jobTypeDetails['name'];?>" >
    <input type="hidden" name="job_type_id" class="form-control" value="<?=$jobTypeDetails['id'];?>" required="" >
  </div>
  <div class="row">
    <div class="col-sm-12" class="responseMessage" id="responseMessageEdit"></div>
  </div>
  <div class="form-group">
    <button class="btn btn_theme2 btn-lg btn_submit" >Update</button>
  </div>
</div>