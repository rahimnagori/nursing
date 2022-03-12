<div class="inner_cont">
    <div class="container">
        <h4>News</h4>
        <p>
            <span><a href="<?=site_url();?>">Home</a></span>
            <span>News</span>
        </p>
    </div>
</div>
<div class="pad_sec blog_list">
    <div class="container">
        <div class="row d_flex">
 <?php
  for($i = 0; $i <= 1; $i++){
?>

            <div class="col-sm-4">
           
                <div class="blog_3">
                    <div class="blog_img">
                    <a href="<?=site_url('Blog/1');?>"><img src="<?=site_url('assets/site/');?>img/img_11.jpg" class="img_r"></a>
                    </div>
                    <div class="blog_2">
                        <div class="date_me">
                            <span>08 March 2022</span>
                        </div>
                        <h6>By Admin</h6>
                        <h4>Medical and Love Have 4 Things In Common </h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna</p>
                        <a href="<?=site_url('Blog/1');?>" class="btn btn_theme3 btn_lg">Read More</a>
                    </div>
                </div>
            
            </div>
            <div class="col-sm-4">
                <div class="blog_3">
                    <div class="blog_img">
                         <a href="<?=site_url('Blog/1');?>"><img src="<?=site_url('assets/site/');?>img/img_12.jpg" class="img_r"></a>
                    </div>
                    <div class="blog_2">
                        <div class="date_me">
                            <span>08 March 2022</span>
                        </div>
                        <h6>By Admin</h6>
                        <h4>Medical and Love Have 4 Things In Common </h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna</p>
                        <a href="<?=site_url('Blog/1');?>" class="btn btn_theme3 btn_lg">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="blog_3">
                    <div class="blog_img">
                         <a href="<?=site_url('Blog/1');?>"><img src="<?=site_url('assets/site/');?>img/img_13.jpg" class="img_r"></a>
                    </div>
                    <div class="blog_2">
                        <div class="date_me">
                            <span>08 March 2022</span>
                        </div>
                        <h6>By Admin</h6>
                        <h4>Medical and Love Have 4 Things In Common </h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna</p>
                        <a href="<?=site_url('Blog/1');?>" class="btn btn_theme3 btn_lg">Read More</a>
                    </div>
                </div>
            </div>

            
<?php
  }
?>
            
        </div>
        <nav aria-label="Page navigation" class="pagination_des">
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