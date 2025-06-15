jQuery(document).ready(function($){
  // Initialize AOS once with offset
  AOS.init({
    duration: 800,
    once: true,
    offset: 200
  });

  // Initialize Swiper slider with fade & autoplay
  const heroSwiper = new Swiper('.hero.swiper-container', {
    loop: true,
    effect: 'fade',
    fadeEffect: { crossFade: true },
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });

  // Toggle header color on scroll
  const header = document.querySelector('.site-header');
  $(window).on('scroll', function() {
    header.classList.toggle('is-scrolled', window.scrollY > 50);
  });
});
