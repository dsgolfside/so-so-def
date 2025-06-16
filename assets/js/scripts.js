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

  // Mobile menu toggle functionality
  const mobileToggle = document.querySelector('.mobile-menu-toggle');
  const mobileOverlay = document.querySelector('.mobile-nav-overlay');
  const body = document.body;

  if (mobileToggle && mobileOverlay) {
    mobileToggle.addEventListener('click', function() {
      mobileToggle.classList.toggle('active');
      mobileOverlay.classList.toggle('active');
      body.classList.toggle('mobile-menu-open');
    });

    // Close mobile menu when clicking overlay
    mobileOverlay.addEventListener('click', function(e) {
      if (e.target === mobileOverlay) {
        mobileToggle.classList.remove('active');
        mobileOverlay.classList.remove('active');
        body.classList.remove('mobile-menu-open');
      }
    });

    // Close mobile menu when clicking menu links
    const mobileLinks = mobileOverlay.querySelectorAll('a');
    mobileLinks.forEach(link => {
      link.addEventListener('click', function() {
        mobileToggle.classList.remove('active');
        mobileOverlay.classList.remove('active');
        body.classList.remove('mobile-menu-open');
      });
    });
  }
});
