$(document).ready(function() {
  /*scroll*/
 $(window).scroll(function() {
  let height = $(window).scrollTop();
  if(height  <= 700) {
   $('#arrow_up').css('display', 'none');
  }
  if(height  > 700) {
   $('#arrow_up').css('display', 'block');
  }
 });

 $("a").click(function() {
  $("html, body").animate({
   scrollTop: $($(this).attr("href")).offset().top - 60
  }, {
   duration: 1500,
   easing: "swing"
  });
  return false;
 });
 /*slider*/
 var swiper = new Swiper('.comments-slider', {
  observer: true,
  observeParents: true,
  slidesPerView: 1,
  spaceBetween: 15,
  watchOverflow: true,
  autoHeight: true,
  effect: 'fade',
  speed: 800,
  pagination: {
   el: '.comments-pagination',
   clickable: true,
  },
  navigation: {
   nextEl: '.comments-arrow_next',
   prevEl: '.comments-arrow_prev',
  },
 });

 /*open program modal*/
 $('.program-btn').click(function() {
  $program_id = this.value;
  $('#' + $program_id).toggleClass('open');
  $('body').toggleClass('scroll');
  return false;
 });
 $('.program-modal_close').click(function () {
  $('.program-modal').removeClass('open');
  $('body').toggleClass('scroll');
 });
 /*open modal iframe*/
 $('.home-play').click(function() {
  $('.home-iframe').delay(500).fadeIn().append('<iframe src="https://www.youtube.com/embed/UhLtpI1ZCyA?autoplay=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
  $('.home-iframe_bgr').slideDown();
  $('body').addClass('scroll');
  return false;
 });
 $('.home-iframe_close, .home-iframe_bgr').click(function() {
  $('.home-iframe').fadeOut();
  $('.home-iframe_bgr').delay(500).slideUp();
  $('.home-iframe iframe').remove();
  $('body').removeClass('scroll');
  return false;
 });
 /*faq accordion*/
 $('.faq-box_top').click(function() {
  $(this).toggleClass('open').next().slideToggle();
  return false;
 });
 /*open mob menu*/
 $('.header-burger, .header-menu_list a').click(function() {
  $('.header-burger').toggleClass('open');
  if ($(window).width() <= '1200'){
   $('.header-menu').slideToggle();
  }
  return false;
 });
  /*open payment modal*/
 $('.payment-btn, .payment-form_close').click(function() {
  $('.payment-modal').slideToggle();
  $('body').toggleClass('scroll');
  return false;
 });

});