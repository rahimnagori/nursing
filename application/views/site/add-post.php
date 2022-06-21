<div class="dasboadd">

  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <?php include 'include/sidebar.php'; ?>
      </div>
      <div class="col-sm-9">
        <div class="right_box">
          <h4 class="hedding_right">Post</h4>
          <div class="card_bodym">
            <div class="form-group">
              <label>Name of charity</label>
              <input type="text" name="" placeholder="Name of charity" class="form-control">
            </div>
            <div class="form-group">
              <label>Categories</label>
              <select class="form-control">
                <option>Category</option>
                <option>School</option>
                <option>Musjid</option>
              </select>
            </div>
            <div class="form-group">
              <label>Title</label>
              <input type="text" name="" placeholder="Title" class="form-control">
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea placeholder="Title" class="form-control" placeholder="Description"></textarea>
            </div>
            <label>Upload Image</label>
            <div class="row uuss_rowws">

              <div class="col-sm-2 ">
                <div class="image_uplod1">
                  <img src="<?= site_url('assets/site/'); ?>img/img_2.png" class="tradup_img2">
                  <div class="btttponm_psuiui">
                    <button type="button" class="btn btn-danger ">X</button>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 ">
                <div class="image_uplod1">
                  <img src="<?= site_url('assets/site/'); ?>img/img_2.png" class="tradup_img2">
                  <div class="btttponm_psuiui">
                    <button type="button" class="btn btn-danger ">X</button>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 ">
                <div class="image_uplod1">
                  <img src="<?= site_url('assets/site/'); ?>img/img_2.png" class="tradup_img2">
                  <div class="btttponm_psuiui">
                    <button type="button" class="btn btn-danger ">X</button>
                  </div>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="image_uplod1">
                  <img src="<?= site_url('assets/site/'); ?>img/icon_us2.png" class="tradup_img1">
                  <input type="file" onchange="preview_image();" name="post_doc[]" accept="image/*" id="post_doc" class="uplldui">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label>Email</label>
              <input type="text" name="" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <label>Phone</label>
              <input type="text" name="" placeholder="Phone" class="form-control">
            </div>

            <div class="form-group">
              <label><button class="btn btn_theme2 btn-lg">Submit</button></label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>