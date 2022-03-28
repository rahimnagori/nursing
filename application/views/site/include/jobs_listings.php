<?php
foreach ($jobs as $serialNumber => $job) {
?>
    <a class="job_com1" href="#">
        <div class="com_img">
            <img src="<?= site_url('assets/site/'); ?>img/logo.png">
        </div>
        <div class="commodo_de">
            <h3><?= $job['title']; ?></h3>
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
                <h4 class="spb_m"><i class="fa fa-usd"></i> $ <?= $job['salary']; ?> / <?= $paymentTypes[$job['payment_type']]; ?> </h4>
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