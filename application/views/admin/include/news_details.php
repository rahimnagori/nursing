<div class="optio_raddipo">
  <div class="form-group">
    <label> Title </label>
    <input type="text" name="title" class="form-control" required="" value="<?=$newsDetails['title'];?>" >
    <input type="hidden" name="news_id" required="" value="<?=$newsDetails['id'];?>" >
  </div>
  <div class="form-group">
    <label> Description </label>
    <textarea class="form-control textarea-edit" name="description" required="" ><?=$newsDetails['description'];?></textarea>
  </div>
  <div class="row">
    <div class="col-sm-12" class="responseMessage" id="editResponseMessage"></div>
  </div>
  <div class="form-group">
    <button class="btn btn_theme2 btn-lg btn_submit" >Update</button>
  </div>
</div>