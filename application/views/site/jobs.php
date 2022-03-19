<div class="inner_cont">
  <div class="container">
    <h4>Jobs</h4>
    <p>
      <span><a href="<?= site_url(); ?>">Home</a></span>
      <span>Jobs</span>
    </p>
  </div>
</div>
<div class="pad_sec ">
  <div class="container">
    <div class="job_list">
      <div class="row">
        <div class="col-sm-4">
          <div class="white_box2 filter">
            <h4 style="margin-bottom: 20px;">Filters</h4>
            <h5>Search</h5>
            <div class="form-group">
              <div class="icon_us">
                <i class="la la-search"></i>
                <input type="text" name="" placeholder="Search" class="form-control">
              </div>
            </div>
            <h5>Location</h5>
            <div class="form-group">
              <div class="icon_us">
                <i class="la la-map-marker"></i>
                <input type="text" name="" placeholder="Locatoon" class="form-control">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <h5>Where</h5>
                <div class="form-group">
                  <select name="" id="" class="form-control">
                    <option value="">Where</option>
                    <option value="">East Midlands</option>
                    <option value="">East of England</option>
                    <option value="">North East</option>
                    <option value="">North West</option>
                    <option value="">Rest of World</option>
                    <option value="">Scotland</option>
                    <option value="">South East</option>
                    <option value="">South West</option>
                    <option value="">Wales</option>
                    <option value="">West Midlands</option>
                    <option value="">Yorkshire and the Humber</option>
                    <option value="">Work From Home / Remote Job</option>
                    <option value="">For all Irish healthcare jobs</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <h5>Level</h5>
                <div class="form-group">
                  <select name="" id="" class="form-control">
                    <option value="">Level</option>
                    <option value="">Admin - Sales - Clerical</option>
                    <option value="">Deputy Manager / Senior Staff</option>
                    <option value="">Manager</option>
                    <option value="">Newly qualified</option>
                    <option value="">Qualified (non-manager)</option>
                    <option value="">Studying / Unqualified</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <h5>Type</h5>
                <div class="form-group">
                  <select name="" id="" class="form-control">
                    <option value="">Type</option>
                    <option value="">Agency</option>
                    <option value="">Bank</option>
                    <option value="">Permanent</option>
                    <option value="">Temporary</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <h5>Time</h5>
                <div class="form-group">
                  <select name="" id="" class="form-control">
                    <option value="">Hours</option>
                    <option value="">Full time</option>
                    <option value="">Part time</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <h5>Year</h5>
                <div class="form-group">
                  <select name="" id="" class="form-control">
                    <option>£ per year</option>
                    <option value="">£10000+ </option>
                    <option value="">£15000+ </option>
                    <option value="">£20000+ </option>
                    <option value="">£25000+ </option>
                    <option value="">£30000+ </option>
                    <option value="">£35000+ </option>
                    <option value="">£40000+ </option>
                    <option value="">£45000+ </option>
                    <option value="">£50000+ </option>
                    <option value="">£55000+ </option>
                    <option value="">£60000+ </option>
                    <option value="">£65000+ </option>
                    <option value="">£70000+ </option>
                    <option value="">£75000+</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <h5>Hour</h5>
                <div class="form-group">
                  <select name="" id="" class="form-control">
                    <option>£ per hour</option>
                    <option value="">£5+</option>
                    <option value="">£6+</option>
                    <option value="">£7+</option>
                    <option value="">£8+</option>
                    <option value="">£9+</option>
                    <option value="">£10+</option>
                    <option value="">£11+</option>
                    <option value="">£12+</option>
                    <option value="">£13+</option>
                    <option value="">£14+</option>
                    <option value="">£15+</option>
                    <option value="">£16+</option>
                    <option value="">£17+</option>
                    <option value="">£18+</option>
                    <option value="">£19+</option>
                    <option value="">£20+</option>
                    <option value="">£21+</option>
                    <option value="">£22+</option>
                    <option value="">£23+</option>
                    <option value="">£24+</option>
                    <option value="">£25+</option>
                  </select>
                </div>
              </div>
            </div>
            <button class="btn btn_theme2 btn-lg btn-block">
              Search
            </button>
          </div>
        </div>
        <div class="col-sm-8">
          <div class="job_list2">
            <?php
            foreach ($jobs as $serialNumber => $job) {
            ?>
              <a class="job_com1" href="#">
                <div class="com_img">
                  <img src="<?= site_url('assets/site/'); ?>img/logo.png">
                </div>
                <div class="commodo_de">
                  <h3><?=$job['title'];?></h3>
                  <div class="star_5">
                    <span class="active fa fa-star"></span>
                    <span class="active fa fa-star"></span>
                    <span class="active fa fa-star"></span>
                    <span class="active fa fa-star"></span>
                    <span class="fa fa-star"></span>
                  </div>
                  <div class="set_losnn">
                    <h4><i class="fa fa-briefcase"></i> Nurse Practitioner</h4>
                    <h4 class="spb_m"><i class="fa fa-map-marker"></i> <?=$job['name'];?> </h4>
                    <h4 class="spb_m"><i class="fa fa-usd"></i> $ <?=$job['salary'];?> / <?=$paymentTypes[$job['payment_type']];?> </h4>
                  </div>
                </div>
              </a>
            <?php
            }
            ?>
            <?php
              if(count($jobs) == 0){
            ?>
                <img src="<?=site_url('assets/site/');?>img/no-jobs.png" >
            <?php
              }
            ?>
          </div>
          <nav aria-label="Page navigation" class="pagination_des" style="display:none;">
            <ul class="pagination">
              <li>
                <a href="#" aria-label="Previous">
                  <span aria-hidden="true">«</span>
                </a>
              </li>
              <li class="active"><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li>
                <a href="#" aria-label="Next">
                  <span aria-hidden="true">»</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>

  </div>
</div>