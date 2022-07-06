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
            <form id="searchForm" name="searchForm" method="post" onsubmit="submit_form(event);">
              <h4 style="margin-bottom: 20px;">Filters</h4>
              <h5>Search</h5>
              <div class="form-group">
                <div class="icon_us">
                  <i class="la la-search"></i>
                  <input type="text" name="searchQuery" placeholder="Search" class="form-control">
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <h5>Where</h5>
                  <div class="form-group">
                    <select name="locations" class="form-control">
                      <option value="0">Any</option>
                      <?php
                      foreach ($jobLocations as $jobLocation) {
                      ?>
                        <option value="<?= $jobLocation['id']; ?>" <?= ($searchParams['types'] == $jobLocation['id']) ? 'selected' : ''; ?>><?= $jobLocation['name']; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <h5>Payment Type</h5>
                  <div class="form-group">
                    <select name="payment_type" class="form-control">
                      <option value="0">Any</option>
                      <option value="1">Hourly</option>
                      <option value="2">Weekly</option>
                      <option value="3">Monthly</option>
                    </select>
                  </div>
                </div>
              </div>
              <button class="btn btn_theme2 btn-lg btn-block btn_submit" type="button" onclick="search_jobs()">
                Search
              </button>
            </form>
          </div>
        </div>
        <div class="col-sm-8">
          <?= $this->session->flashdata('responseMessage'); ?>
          <div class="job_list2" id="job-listings">
            <?php
            if (false) {
              /* Not in use */
              /* Use at site/include/jobs_listings.php */
            ?>
              <a target="_blank" class="job_com1" href="<?= site_url('Job-Details/' . $job['id']) ?>">
                <div class="com_img">
                  <img src="<?= site_url('assets/site/'); ?>img/logo.png">
                </div>
                <div class="commodo_de">
                  <h3><?= $job['title']; ?></h3>
                  <h2>#1245545</h2>
                  <div class="star_5">
                    <span class="active fa fa-star"></span>
                    <span class="active fa fa-star"></span>
                    <span class="active fa fa-star"></span>
                    <span class="active fa fa-star"></span>
                    <span class="fa fa-star"></span>
                  </div>
                  <div class="set_losnn">
                    <h4><i class="fa fa-briefcase"></i> <?= $job['qualification']; ?> </h4>
                    <h4 class="spb_m"><i class="fa fa-map-marker"></i> <?= $job['name']; ?> </h4>
                    <h4 class="spb_m"><?= $this->config->item('CURRENCY'); ?> <?= $job['salary']; ?> / <?= $paymentTypes[$job['payment_type']]; ?> </h4>
                    <h4 class="spb_m"><i class="fa fa-calendar"></i> <?= date("d M, Y", strtotime($job['last_date'])); ?> </h4>

                  </div>
                </div>
              </a>
            <?php
            }
            ?>
            <?php
            if (count($jobs) == 0) {
            ?>
              <img src="<?= site_url('assets/site/'); ?>img/no-jobs.png" class="img_r">
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

<?php include('include/footer.php'); ?>

<script src="<?= site_url('assets/site/js/jobs.js'); ?>"></script>