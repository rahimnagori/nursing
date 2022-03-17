<div class="optio_raddipo">
  <div class="form-group">
    <label> Title </label>
    <input type="text" name="title" class="form-control" required="" value="<?=$jobDetails['title'];?>" >
    <input type="hidden" name="job_id" class="form-control" required="" value="<?=$jobDetails['id'];?>" >
  </div>
  <div class="form-group">
    <label> Description </label>
    <input type="text" name="description" class="form-control" required="" value="<?=$jobDetails['description'];?>" >
  </div>
  <div class="form-group">
    <label> Job Type </label>
    <select class="form-control" name="job_type" > 
      <?php
        foreach($jobTypes as $jobType){
      ?>
          <option value="<?=$jobType['id'];?>" <?=($jobDetails['job_type'] == $jobType['id']) ? 'selected' : '';?> ><?=$jobType['name'];?></option>
      <?php
        }
      ?>
    </select>
  </div>
  <div class="row">
    <div class="col-sm-12" class="responseMessage" id="responseMessage"></div>
  </div>
  <div class="form-group">
    <button class="btn btn_theme2 btn-lg btn_submit" >Update</button>
  </div>
</div>