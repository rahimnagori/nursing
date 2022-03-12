<?php include 'include/header.php'; ?>
<link href="css/lightgallery.css" rel="stylesheet">
<style type="text/css">

/*owl start*/

#big img{
  border-radius: 10px;
}
.igm_owl img {
  height: 100%;
  width: 100%;
}

#thumbs .item .igm_owl {
  background: #fff none repeat scroll 0 0;
  border: 1px solid #333;
  overflow: hidden;
  
}
#thumbs .owl-item.active.current .igm_owl{
border: 1px solid var(--red);
}
#thumbs .item {
  background: #fff none repeat scroll 0 0;
  padding: 3px;
}
#thumbs .item .igm_owl img{
  height: 100px;
  object-fit: cover;
}
#thumbs .owl-dots{
  display: none;
}


#thumbs .owl-next,
.slider_gallery #big .owl-next,
#thumbs .owl-prev,
.slider_gallery #big .owl-prev
{
  position: absolute;
  
  top: 50%;
  transform: translateY(-50%);
  margin: 0;
  width: 40px;
  height: 40px;
  background: rgba(0,0,0,0.6);
  color: #fff !important;
  opacity: 1 !important; 
  line-height: 40px;
}

#thumbs .owl-next:hover,
.slider_gallery #big .owl-next:hover,
#thumbs .owl-prev:hover,
.slider_gallery #big .owl-prev:hover{
  background: rgba(0,0,0,0.8);
}

#thumbs .owl-next,
.slider_gallery #big .owl-next{
 right: 15px; 
}

#thumbs .owl-prev,
.slider_gallery #big .owl-prev{
  left: 15px;
}
/*owl close*/


    .lg-thumb-outer.lg-grab {
  display: none;
}
  .validation-msg{
        color: red;
    font-weight: bold;
  }
  .show_phone{
    text-align: center;
  }
  #html_element_number{
    text-align: center;
    margin-left: 100px;
    margin-right: 100px;  
  }
  .show_phone a{
      cursor: pointer; 
  }
    .copy-to-clipboard input {
  border: none;
  background: transparent;
}

.copied {
position: relative;
    background: var(--red);
    color: #fff;
    font-weight: bold;
    z-index: 99;
    width: 300px;
    top: 0;
    text-align: center;
    padding: 2px;
     display: none; 
    font-size: 12px;
}
.copied p{
      color: #fff;

}
.p_desc{
        white-space: pre-wrap;
}
.description{
    color: #888;
    margin-bottom: 20px;
    margin-top: 20px;
}


      #map_new {
        height: 100%;
        overflow: inherit !important;
        position: unset !important;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      
#big a::after {
  position: absolute;
  right: 15px;
  top: 30px;
  background: transparent;
  width: 35px;
  height: 35px;
  border: 1px solid var(--red);
  content: "\f002";
  font-family: "FontAwesome";
  text-align: center;
  line-height: 30px;
  border-radius: 4px;
  color: var(--red);
}
</style>
<div class="details pad_sec">
  <div class="container">
    <div class="row">
      <div class="col-sm-8">
          <div class="slider_gallery">

<div id="big" class="owl-carousel owl-theme">
  <div class="item" data-src="img/img_1.png">
    <div class="igm_owl">
      <a hef="#"><img src="img/img_1.png"></a>
    </div>
  </div>
  <div class="item" data-src="img/img_1.png">
    <div class="igm_owl">
      <a hef="#"><img src="img/img_1.png"></a>
    </div>
  </div>
  <div class="item" data-src="img/img_1.png">
    <div class="igm_owl">
      <a hef="#"><img src="img/img_1.png"></a>
    </div>
  </div>
  <div class="item" data-src="img/img_1.png">
    <div class="igm_owl">
      <a hef="#"><img src="img/img_1.png"></a>
    </div>
  </div>
  <div class="item" data-src="img/img_1.png">
    <div class="igm_owl">
      <a hef="#"><img src="img/img_1.png"></a>
    </div>
  </div>
  <div class="item" data-src="img/img_1.png">
    <div class="igm_owl">
     <a hef="#"> <img src="img/img_1.png"></a>
    </div>
  </div>
  <div class="item" data-src="img/img_1.png">
    <div class="igm_owl">
      <a hef="#"><img src="img/img_1.png"></a>
    </div>
  </div>
  <div class="item" data-src="img/img_1.png">
    <div class="igm_owl">
      <a hef="#"><img src="img/img_1.png"></a>
    </div>
  </div>
      <div class="item" data-src="img/img_1.png">
    <div class="igm_owl">
      <a hef="#"><img src="img/img_1.png"></a>
    </div>
  </div>
    <div class="item" data-src="img/img_1.png">
    <div class="igm_owl">
      <a hef="#"><img src="img/img_1.png"></a>
    </div>
  </div>
</div>


<div id="thumbs" class="owl-carousel owl-theme">
  <div class="item">
    <div class="igm_owl">
      <a hef="#"><img src="img/img_1.png"></a>
    </div>
  </div>
  <div class="item">
    <div class="igm_owl">
      <img src="img/img_1.png">
    </div>
  </div>
  <div class="item">
    <div class="igm_owl">
      <img src="img/img_1.png">
    </div>
  </div>
  <div class="item">
    <div class="igm_owl">
      <a hef="#"><img src="img/img_1.png"></a>
    </div>
  </div>
  <div class="item">
    <div class="igm_owl">
      <img src="img/img_1.png">
    </div>
  </div>
  <div class="item">
    <div class="igm_owl">
      <img src="img/img_1.png">
    </div>
  </div>
  <div class="item">
    <div class="igm_owl">
      <a hef="#"><img src="img/img_1.png"></a>
    </div>
  </div>
  <div class="item">
    <div class="igm_owl">
      <img src="img/img_1.png">
    </div>
  </div>
    <div class="item">
    <div class="igm_owl">
      <img src="img/img_1.png">
    </div>
  </div>
    <div class="item">
    <div class="igm_owl">
      <a hef="#"><img src="img/img_1.png"></a>
    </div>
  </div>
</div>
          </div>

          <div class="box_white2 details_us">
              <h4>Dummy text of the printing.</h4>
              <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
          </p>
            <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
          </p>
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
          </p>
          </div>


      </div>
      <div class="col-sm-4">
        <div class="box_white2 payment">
            <h4>Education</h4>
            <p>
              Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
            </p>
            <div class="progg_us">
               <b style="left: 50%;">50%</b>
               <div class="progg_us2">

                  <span style="width: 50%;"></span>
               </div>
            </div>
            <div class="don_box2">
                  <h6>
                     $25,270
                     <span>Raised</span> 
                  </h6>
                  <h6>
                     $30,000 
                     <span>Goal</span> 
                  </h6>
               </div>
               <hr>
               <div class="don_box3 form-group">
                 <div class="row">
                   <div class="col-sm-5">
                     <h1>43
                      <span>Donors</span>
                     </h1>
                   </div>
                   <div class="col-sm-7">
                     <h1>$12,040
                      <span>Donated</span>
                     </h1>
                   </div>
                 </div>
               </div>
               <div class="Donated_bttnn">
                  <a href="#" class="btn btn_theme2 btn-lg btn-block" >Donate Now</a> 
               </div>
        </div> 
      </div>
    </div>
  </div>
</div>
<?php include 'include/footer.php'; ?>

<script type="text/javascript" src="js/lightgallery-all.min.js"></script>
<script type="text/javascript">
        $(document).ready(function(){
            $('#big').lightGallery();
        });
        </script>
<script type="text/javascript">
  $(document).ready(function() {
  var bigimage = $("#big");
  var thumbs = $("#thumbs");
  //var totalslides = 10;
  var syncedSecondary = true;

  bigimage
    .owlCarousel({
    items: 1,
    slideSpeed: 2000,
    nav: true,
    autoplay: true,
    dots: false,
    loop: true,
    autoHeight : true,
    responsiveRefreshRate: 200,
    navText: [
      '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
      '<i class="fa fa-chevron-right" aria-hidden="true"></i>'
    ]
  })
    .on("changed.owl.carousel", syncPosition);

  thumbs
    .on("initialized.owl.carousel", function() {
    thumbs
      .find(".owl-item")
      .eq(0)
      .addClass("current");
  })
    .owlCarousel({
    items: 6,
    dots: true,
    nav: true,
    navText: [
      '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
      '<i class="fa fa-chevron-right" aria-hidden="true"></i>'
    ],
    smartSpeed: 200,
    slideSpeed: 500,
    slideBy: 6,
    responsiveRefreshRate: 100
  })
    .on("changed.owl.carousel", syncPosition2);

  function syncPosition(el) {
    //if loop is set to false, then you have to uncomment the next line
    //var current = el.item.index;

    //to disable loop, comment this block
    var count = el.item.count - 1;
    var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

    if (current < 0) {
      current = count;
    }
    if (current > count) {
      current = 0;
    }
    //to this
    thumbs
      .find(".owl-item")
      .removeClass("current")
      .eq(current)
      .addClass("current");
    var onscreen = thumbs.find(".owl-item.active").length - 1;
    var start = thumbs
    .find(".owl-item.active")
    .first()
    .index();
    var end = thumbs
    .find(".owl-item.active")
    .last()
    .index();

    if (current > end) {
      thumbs.data("owl.carousel").to(current, 100, true);
    }
    if (current < start) {
      thumbs.data("owl.carousel").to(current - onscreen, 100, true);
    }
  }

  function syncPosition2(el) {
    if (syncedSecondary) {
      var number = el.item.index;
      bigimage.data("owl.carousel").to(number, 100, true);
    }
  }

  thumbs.on("click", ".owl-item", function(e) {
    e.preventDefault();
    var number = $(this).index();
    bigimage.data("owl.carousel").to(number, 300, true);
  });
});

</script>