<footer class="footer">
    <div class="container ">
        <div class="row">
            <div class="col-sm-4">
                <div class="link_1">
                    <figure class="footer-logo">
                        <img src="<?= site_url('assets/site/'); ?>img/logo1.png">
                    </figure>
                    <h5>About Us</h5>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum .
                    </p>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="link_1 ">
                    <h5>Know Link</h5>
                    <ul class="ul_set">
                        <li><a href="<?= site_url(); ?>">Home</a></li>
                        <li><a href="<?= site_url('About'); ?>">About Us</a></li>
                        <li><a href="<?= site_url('News'); ?>">News</a></li>
                        <li><a href="<?= site_url('Jobs'); ?>">Job Search</a></li>
                        <li><a href="#">Work With Us</a></li>
                        <li><a href="<?= site_url('Contact'); ?>">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="link_1 ">
                    <h5>Know Links</h5>
                    <ul class="ul_set">
                        <li><a href="<?= site_url('Terms'); ?>">Terms & Conditions </a></li>
                        <li><a href="<?= site_url('Privacy'); ?>">Privacy Policy </a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="link_1 ">
                    <h5>Get In Touch</h5>
                    <ul class="ul_set conttss">
                        <li>
                            <i class="fa fa-phone  "></i>
                            <span class="">
                                <a href="#"> 123-456-7899</a>
                            </span>
                        </li>
                        <li>
                            <i class="fa fa-envelope-o  "></i>
                            <a href="#"> contact@nursing.com</a>
                        </li>

                    </ul>
                    <div class="follooss">
                        <h5>Follow us</h5>
                        <ul class="company-social ul_set ">
                            <li class="social-facebook "><a href="#" target="_blank"><i class="fa fa-facebook "></i></a></li>
                            <li class="social-twitter "><a href="#" target="_blank"><i class="fa fa-twitter "></i></a></li>
                            <li class="social-vimeo "><a href="#" target="_blank"><i class="fa fa-instagram "></i></a></li>
                            <li class="social-instagram"><a href="#" target="_blank"><i class="fa fa-youtube-play"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copy_rightt">
        <div class="container">
            <div class="text-center">
                <p>Copyright © Pambron Nursing Limited 2022</p>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/owl.carousel.js"></script>
<script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/custom.js"></script>
<script>
    const BASE_URL = "<?=site_url();?>";
    const LOADING = "<i class='fa fa-spin fa-spinner' aria-hidden='true'></i> Processing ... ";

    function preview_image(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                let previewImg = $('<img />', {
                    src: e.target.result,
                    alt: 'Resume',
                    width: '50px'
                });
                $('#' + previewId).html(previewImg);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>
</html>