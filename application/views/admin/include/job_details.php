<div class="optio_raddipo">
  <div class="form-group">
    <label> Title </label>
    <input type="text" name="title" class="form-control" required="" value="<?=$jobDetails['title'];?>" >
    <input type="hidden" name="job_id" required="" value="<?=$jobDetails['id'];?>" >
  </div>
  <div class="form-group">
    <label> Location </label>
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
  <div class="form-group">
    <label> Address </label>
    <input type="text" name="address" class="form-control" required="" value="<?=$jobDetails['address'];?>" >
  </div>
  <div class="form-group">
    <label> Salary </label>
    <div class="input-group">
      <span class="input-group-addon"><?=$this->config->item('CURRENCY');?></span>
      <input type="number" name="salary" class="form-control" required="" value="<?=$jobDetails['salary'];?>" >
    </div>
  </div>
  <div class="form-group">
    <label> Description </label>
    <textarea class="form-control textarea-edit" name="description" required="" ><?=$jobDetails['description'];?></textarea>
  </div>
  <div class="form-group">
    <label> Qualification </label>
    <input type="text" name="qualification" class="form-control" required="" value="<?=$jobDetails['qualification'];?>" >
  </div>
  <div class="form-group">
    <label> Employment Type </label>
    <label class="radio"> Permanent
      <input type="radio" value="1" <?=($jobDetails['employment_type'] == 1) ? 'checked="checked"' : '';?> name="employment_type">
      <span class="checkround"></span>
    </label>
    <label class="radio"> Temporary
      <input type="radio" value="0" <?=($jobDetails['employment_type'] == 0) ? 'checked="checked"' : '';?> name="employment_type">
      <span class="checkround"></span>
    </label>
  </div>
  <div class="form-group">
    <label> Payment Type </label>
    <?php
      foreach($paymentTypes as $key => $paymentType){
    ?>
        <label class="radio"> <?=$paymentType;?>
          <input type="radio" value="<?=$key;?>" <?=($jobDetails['payment_type'] == $key) ? 'checked="checked"' : '';?> name="payment_type">
          <span class="checkround"></span>
        </label>
    <?php
      }
    ?>
  </div>
  <div class="form-group">
    <label> Last Date </label>
    <input type="date" name="last_date" class="form-control" required="" value="<?=date("Y-m-d", strtotime($jobDetails['last_date']));?>" >
  </div>
  <div class="row">
    <div class="col-sm-12" class="responseMessage" id="editResponseMessage"></div>
  </div>
  <div class="form-group">
    <button class="btn btn_theme2 btn-lg btn_submit" >Update</button>
  </div>
</div>