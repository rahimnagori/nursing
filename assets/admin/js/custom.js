 /*slider*/
// $('#slider1').owlCarousel({
    // loop:true,
    // margin:0,
    // nav:true,
    // responsive:{
        // 0:{
            // items:1
        // },
        // 600:{
            // items:1
        // },
        // 1000:{
            // items:1
        // }
    // }
// })
/*slider close*/
/*slider*/
// $('#slider2').owlCarousel({
    // loop:true,
    // margin:30,
    // nav:true,
    // responsive:{
        // 0:{
            // items:1
        // },
        // 600:{
            // items:3
        // },
        // 1000:{
            // items:3
        // }
    // }
// })
/*slider close*/

/*nav*/
$(window).on("scroll", function () {
            if ($(window).scrollTop() > 50) {
                $(".main_nav").addClass("top-nav-collapse");
            } else {
                $(".main_nav").removeClass("top-nav-collapse");
            }
        });
/*nav close*/

/*counter*/
$('.counter').each(function() {
  var $this = $(this),
      countTo = $this.attr('data-count');
  
  $({ countNum: $this.text()}).animate({
    countNum: countTo
  },

  {
    duration: 8000,
    easing:'linear',
    step: function() {
      $this.text(Math.floor(this.countNum));
    },
    complete: function() {
      $this.text(this.countNum);
    }
  });  
  
});
/*counter*/
