<div class="inner_cont">
    <div class="container">
        <h4>News</h4>
        <p>
            <span><a href="<?= site_url(); ?>">Home</a></span>
            <span>News</span>
        </p>
    </div>
</div>
<div class="pad_sec blog_list">
    <div class="container">
        <div class="row d_flex">
            <?php
            foreach ($newses as $news) {
                $description = strip_tags(substr($news['description'], 0, 120));
            ?>
                <div class="col-sm-4">
                    <div class="blog_3">
                        <div class="blog_img">
                            <a href="<?= site_url('News/' . $news['id']); ?>"><img src="<?= site_url('assets/site/'); ?>img/img_11.jpg" class="img_r"></a>
                        </div>
                        <div class="blog_2">
                            <div class="date_me">
                                <span><?= date("d M, Y", strtotime($news['created'])); ?></span>
                            </div>
                            <h6>By Admin</h6>
                            <h4><?= substr($news['title'], 0, 25); ?></h4>
                            <p><?= $description; ?></p>
                            <a href="<?= site_url('News/' . $news['id']); ?>" class="btn btn_theme3 btn_lg">Read More</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <?php
            if (!count($newses)) {
            ?>
                <img src="<?= site_url('assets/site/'); ?>img/no-post.png">
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