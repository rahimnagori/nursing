<footer class="footer">
    <div class="container ">
        <div class="row">
            <div class="col-sm-4">
                <div class="link_1">
                    <figure class="footer-logo">
                        <img src="<?= site_url('assets/site/'); ?>img/logo1.png">
                    </figure>
                    <!-- <h5>About Us</h5>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum .
                    </p> -->
                </div>
            </div>
            <div class="col-sm-2">
                <div class="link_1 ">
                    <!-- <h5>Know Link</h5> -->
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
                    <!-- <h5>Know Links</h5> -->
                    <ul class="ul_set">
                        <!-- <li><a href="<?= site_url('Terms'); ?>">Terms & Conditions </a></li> -->
                        <li><a href="<?= site_url('Privacy'); ?>">Terms of Use </a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="link_1 ">
                    <!-- <h5>Get In Touch</h5> -->
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

<div class="cokis">
    <div class="container">
        <div class="cokis2">
            <h4>This site uses cookies to enhance user experience. see <a href="#">Privacy policy</a> </h4>
            <div class="cokis3">
                <button class="btn btn_theme" type="button" onclick="accept_cookie();">Allow cookies</button> <button class="btn btn_theme2" type="button" onclick="hide_cookie_notification();">Cancel</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/owl.carousel.js"></script>
<script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/custom.js"></script>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">
                        <i class="fa fa-times"></i>
                    </span></button>
                <h4 class="modal-title" id="myModalLabel">Request a professional</h4>
            </div>
            <div class="modal-body">
                <form id="requestProfessionalForm" name="requestProfessionalForm" onsubmit="request_professional(event);">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name </label>
                                <div class="icon_us">
                                    <i class="la la-user"></i>
                                    <input type="text" placeholder="Name" class="form-control" required="" name="name">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Company Name</label>
                                <div class="icon_us">
                                    <i class="la la-building"></i>
                                    <input type="text" placeholder="Company Name" class="form-control" required="" name="company">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email</label>
                                <div class="icon_us">
                                    <i class="la la-envelope"></i>
                                    <input type="email" placeholder="Email" class="form-control" required="" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Telephone </label>
                                <div class="icon_us">
                                    <i class="la la-mobile"></i>
                                    <input type="number" placeholder="Telephone" class="form-control" required="" name="phone">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Staff Required</label>
                                <div class="icon_us">
                                    <i class="la la-users"></i>
                                    <input type="text" placeholder="Staff Required" class="form-control" required="" name="staff_required">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Work Location </label>
                                <div class="icon_us">
                                    <i class="la la-map-marker"></i>
                                    <input type="text" placeholder="Work Location" class="form-control" required="" name="work_location">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label>Attach a File </label>
                        <div class="icon_us">
                            <i class="la la-cloud-upload"></i>
                            <input type="file" class="form-control" accept=".pdf, .doc, .docx" name="resume" >
                        </div>
                        <div id="preview_image"></div>
                    </div>
                    <div class="form-group tx_add">
                        <label>Brief description of staff required </label>
                        <div class="icon_us">
                            <i class="la la-comments-o"></i>
                            <textarea name="description" id="" class="form-control" required=""></textarea>
                        </div>
                    </div>
                    <div id="responseMessage" class="responseMessage"></div>
                    <div class="btnloggib " style="margin-top: 10px;">
                        <button class="btn btn_theme2 btn-lg btn-block btn_submit" type="submit"> Submit </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
<script>
    const BASE_URL = "<?= site_url(); ?>";
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

    function accept_cookie() {
        localStorage.setItem('isCookieAccepted', true);
        hide_cookie_notification()
    }

    function hide_cookie_notification() {
        $(".cokis").hide();
    }

    function scroll_to_bottom(div) {
        $("" + div).animate({
            scrollTop: $("" + div)[0].scrollHeight
        }, 1000);
    }

    if (localStorage.getItem('isCookieAccepted')) {
        hide_cookie_notification();
    }
</script>
<script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({ pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false }, 'google_translate_element');
        }
    </script>
    <script src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"
        type="text/javascript"></script>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script>
        function translateLanguage(lang, img) {

            var $frame = $('.goog-te-menu-frame:first');
            if (!$frame.size()) {
                alert("Error: Could not find Google translate frame.");
                return false;
            }
            $("#current-selected-language").prop("src", `${BASE_URL}assets/site/img/${img}`);
            $frame.contents().find('.goog-te-menu2-item span.text:contains(' + lang + ')').get(0).click();
            return false;
        }
    </script>
<script>
    function request_professional(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'Request-Professional',
            data: new FormData($('#requestProfessionalForm')[0]),
            dataType: 'JSON',
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function(xhr) {
                $(".btn_submit").attr('disabled', true);
                $(".btn_submit").html(LOADING);
                $("#responseMessage").html('');
                $("#responseMessage").hide();
            },
            success: function(response) {
                $("#requestProfessionalForm")[0].reset();
                $(".btn_submit").prop('disabled', false);
                $(".btn_submit").html(' Submit ');
                $("#responseMessage").html(response.responseMessage);
                $("#responseMessage").show();
            }
        });
    }
</script>
</body>

</html>