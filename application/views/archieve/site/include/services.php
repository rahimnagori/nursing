<section class="pad_top sec1" id="services">
  <div class="container">
    <div class="headding wow fadeInDown"  data-wow-delay="0.5s">
      <h1>Services</h1>
      <p>
        Providing top quality services to our trust worthy customers is our topmost priority.
        <br>
        We at SIMS group believe in the customer satisfaction.
      </p>
    </div>
    <div class="slidder2 wow fadeInLeft"  data-wow-delay="0.7s">
      <div class="owl-carousel owl-theme slider_arrrw" id="slider_galler2">
        <?php
          foreach($services as $service){
        ?>
            <div class="item">
              <div class="box_us3">
                <img src="<?=site_url($service['service_image']);?>">
                <div class="box_us4">
                  <h4><?=$service['service_name'];?></h4>
                  <?=$service['service_description'];?>
                  <div class="red_more2">
                    <a href="<?=site_url('Service/' .$service['id']);?>" class="btn btn_theme">Read More</a>
                  </div>
                </div>
              </div>
            </div>
        <?php
          }
        ?>
      </div>
      <div class="red_more">
        <a href="http://simsgroup.co.in/brochure/SIMS_Services.pdf" class="btn btn_theme btn-lg" download >
        Download Brochure
        </a>
        <a href="http://simsgroup.co.in/brochure/SIMS_Services_2.pdf" class="btn btn_theme btn-lg" download >
        Download Brochure
        </a>
      </div>
      <br/>
    </div>
  </div>
</section>
<section class="sec_pad sec2">
  <div class="container">
    <div class="headding wow fadeInDown" data-wow-delay="0.5s">
      <h1>Interior Services</h1>
      <p>
        We provide all types of Interior Decoration services comprises of : 
        <br>Gypsum False Cealing | Grid | POP | Paint Work etc.
      </p>
    </div>
    <div class="box_us7">
      <ul>
        <li class="wow fadeInLeft"  data-wow-delay="0.7s">
          <a class='normal' href='#'>
          <img src="<?=site_url('assets/site/img/');?>img_6.png">
          </a>
          <div class='info'>
            <h3>Grid false celling</h3>
          </div>
        </li>
        <li class="wow fadeInLeft"  data-wow-delay="0.8s">
          <a class='normal' href='#'>
          <img src="<?=site_url('assets/site/img/');?>img_7.png">
          </a>
          <div class='info'>
            <h3>Gypsum false celling</h3>
          </div>
        </li>
        <li class="wow fadeInLeft"  data-wow-delay="0.9s">
          <a class='normal' href='#'>
          <img src="<?=site_url('assets/site/img/');?>img_8.png">
          </a>
          <div class='info'>
            <h3>POP False celling</h3>
          </div>
        </li>
        <li class="wow fadeInLeft"  data-wow-delay="1.0s">
          <a class='normal' href='#'>
          <img src="<?=site_url('assets/site/img/');?>img_9.png">
          </a>
          <div class='info'>
            <h3>Paints work</h3>
          </div>
        </li>
      </ul>
    </div>
  </div>
</section>
<section class="sec_pad sec4">
  <div class="container">
    <div class="headding wow fadeInDown"  data-wow-delay="0.5s">
      <h1>Cleaning Services</h1>
      <p>
        We provide all types of Clearning services comprises of : 
        <br>Facade Cleaning | Carpet Cleaning | Tank Cleaning etc.
      </p>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <div class="box_us8 wow fadeInLeft"  data-wow-delay="0.5s">
          <a href="#">
            <img src="<?=site_url('assets/site/img/');?>img_10.png">
            <h4>
              Facade cleaning
            </h4>
          </a>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="box_us9 wow fadeInDown"  data-wow-delay="0.7s">
          <a href="#">
            <img src="<?=site_url('assets/site/img/');?>img_11.png">
            <h4>Carpet Cleaning</h4>
          </a>
        </div>
        <div class="box_us10 wow fadeInDown"  data-wow-delay="0.8s">
          <a href="#">
            <img src="<?=site_url('assets/site/img/');?>tank_cleaning.jpg">
            <h4>Tank Cleaning</h4>
          </a>
        </div>
      </div>
    </div>
    <div class="red_more">
      <a href="http://simsgroup.co.in/brochure/Tank_Cleaning_Process.pdf" class="btn btn_theme btn-lg" download >
      Download cleaning brochure
      </a>
    </div>
  </div>
</section>
<section class="sec_pad sec5" style="display:none;">
  <div class="container">
    <div class="headding fadeInDown"  data-wow-delay="0.5s">
      <h1>Sanitization Services</h1>
      <p>
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
        <br> industry's standard dummy text ever since Lorem Ipsum.
      </p>
    </div>
    <div class="box_us11 wow bounceInLeft"  data-wow-delay="0.5s">
      <div class="row">
        <div class="col-sm-6">
          <div class="box_us5">
            <img src="<?=site_url('assets/site/img/');?>img_3.png" class="img_r">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="box_us6">
            <h3>Sanitization services</h3>
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
              industry's standard dummy text ever since Lorem Ipsum.   
            </p>
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
              industry's standard dummy text ever since Lorem Ipsum.   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
              industry's standard dummy text ever since Lorem Ipsum. 
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="box_us11 wow bounceInRight"  data-wow-delay="0.7s">
      <div class="row">
        <div class="col-sm-6 flor1">
          <div class="box_us5">
            <img src="<?=site_url('assets/site/img/');?>img_3.png" class="img_r">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="box_us6">
            <h3>Sanitization services</h3>
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
              industry's standard dummy text ever since Lorem Ipsum.   
            </p>
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
              industry's standard dummy text ever since Lorem Ipsum.   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
              industry's standard dummy text ever since Lorem Ipsum. 
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
  new WOW().init();
</script>

<script type="text/javascript">
  const nodes = [].slice.call(document.querySelectorAll('li'), 0);
  const directions  = { 0: 'top', 1: 'right', 2: 'bottom', 3: 'left' };
  const classNames = ['in', 'out'].map((p) => Object.values(directions).map((d) => `${p}-${d}`)).reduce((a, b) => a.concat(b));

  const getDirectionKey = (ev, node) => {
    const { width, height, top, left } = node.getBoundingClientRect();
    const l = ev.pageX - (left + window.pageXOffset);
    const t = ev.pageY - (top + window.pageYOffset);
    const x = (l - (width/2) * (width > height ? (height/width) : 1));
    const y = (t - (height/2) * (height > width ? (width/height) : 1));
    return Math.round(Math.atan2(y, x) / 1.57079633 + 5) % 4;
  }

  class Item {
    constructor(element) {
      this.element = element;    
      this.element.addEventListener('mouseover', (ev) => this.update(ev, 'in'));
      this.element.addEventListener('mouseout', (ev) => this.update(ev, 'out'));
    }
    
    update(ev, prefix) {
      this.element.classList.remove(...classNames);
      this.element.classList.add(`${prefix}-${directions[getDirectionKey(ev, this.element)]}`);
    }
  }

  nodes.forEach(node => new Item(node));
  /*hover*/
</script>

<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function(){
    Typed.new('.type', {
      strings: ["SIMS Group", "SIMS Group", "SIMS Group", "SIMS Group"],
      stringsElement: null,
      // typing speed
      typeSpeed: 100,
      // time before typing starts
      startDelay: 600,
      // backspacing speed
      backSpeed: 40,
      // time before backspacing
      backDelay: 500,
      // loop
      loop: true,
      // false = infinite
      loopCount: 5,
      // show cursor
      showCursor: false,
      // character for cursor
      cursorChar: "|",
      // attribute to type (null == text)
      attr: null,
      // either html or text
      contentType: 'html',
    });
  });
</script>