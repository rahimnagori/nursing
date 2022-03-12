<?php include_once('include/header.php'); ?>

<div class="top_slder">
  <div class="owl-carousel owl-theme slider_arrrw" id="slider_galler5">
    <div class="item">
      <div class="box_us1" style="background: url(<?=site_url('assets/site/img/');?>img_1.png);">
        <div class="box_us2 wow fadeInDown"  data-wow-delay="0.7s">
          <h1>
            WEl come to <span class="type"></span>
          </h1>
          <p>
            We are providing all type of interior and maintenance work since 2019.
            <br/>
            We promise for quality and better service.
          </p>
          <div class="red_more">
            <a href="#" class="btn btn_theme btn-lg">
            Read More
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="item">
      <div class="box_us1" style="background: url(<?=site_url('assets/site/img/');?>img_1.png);">
        <div class="box_us2 wow fadeInDown"  data-wow-delay="0.7s">
          <h1>
            WEl come to <span class="type">Sims</span>
          </h1>
          <p>
            We are providing all type of interior and maintenance work since 2019.
            <br/>
            We are promise for quality of our service.
          </p>
          <div class="red_more">
            <a href="#" class="btn btn_theme btn-lg">
            Read More
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('include/services.php'); ?>

<section class="sec_pad sec3" id="about_us">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <div class="box_us5">
          <img src="<?=site_url('assets/site/img/');?>logo_sims.png" class="img_r  wow bounceInLeft"  data-wow-delay="0.5s">
        </div>
      </div>
      <div class="col-sm-6 wow bounceInRight"  data-wow-delay="0.7s">
        <div class="box_us6">
          <h3>About Us</h3>
          <p>
            We are working as SIMS Group since 2019 but our proprietor <b>Mrs. Sharma</b> has a huge experience in this field. She is working since 2015 having 5 years of experience.
            <br/>
            Engineer Mr. Sharma, who is the main Electrical consultant to SIMS Group having a vast experience in his stream, is currently serving in Delhi NCR.
            <br/>
            We at SIMS Group provide following services:
            <br/>
            <ul style="color:#ff156e;">
              <li>Covid 19 Products are the latest addition in our sales section</li>
              <li>All type of Gypsum Partition (Office, Cabin, Congerence Room etc.)</li>
              <li>Gypsum False Ceiling</li>
              <li>Wooden Work</li>
              <li>Office Chairs</li>
              <li>Electrical Services</li>
              <li>Sanitization Work</li>
              <li>Project Consultant</li>
              <li>Modular Kitchen Services</li>
              <li>Fire Extinguisher</li>
            </ul>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include_once('include/footer.php'); ?>

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