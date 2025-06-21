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

  // Initialize Featured Releases Swiper
  const featuredSwiper = new Swiper('.featured-slider', {
    slidesPerView: 1.2,
    spaceBetween: 0,
    loop: false,
    centeredSlides: false,
    navigation: {
      nextEl: '.products-next',
      prevEl: '.products-prev',
    },
    breakpoints: {
      480: {
        slidesPerView: 2,
        spaceBetween: 0,
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 0,
      },
      1024: {
        slidesPerView: 4,
        spaceBetween: 0,
      },
      1200: {
        slidesPerView: 4,
        spaceBetween: 0,
      },
    },
  });

  // Toggle header color on scroll - works on all devices
  const header = document.querySelector('.site-header');
  if (header) {
    $(window).on('scroll', function() {
      const scrolled = window.scrollY > 30;
      header.classList.toggle('is-scrolled', scrolled);
    });
  }

  // Mobile menu toggle functionality
  const mobileToggle = document.querySelector('.mobile-menu-toggle');
  const mobileOverlay = document.querySelector('.mobile-nav-overlay');
  const body = document.body;

  console.log('Mobile toggle:', mobileToggle);
  console.log('Mobile overlay:', mobileOverlay);

  if (mobileToggle && mobileOverlay) {
    mobileToggle.addEventListener('click', function(e) {
      e.preventDefault();
      console.log('Mobile menu clicked');
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

  // Archive Page Filtering
  const filterTabs = document.querySelectorAll('.filter-tab');
  const archiveItems = document.querySelectorAll('.archive-grid__item');

  if (filterTabs.length > 0 && archiveItems.length > 0) {
    filterTabs.forEach(tab => {
      tab.addEventListener('click', function() {
        const filter = this.getAttribute('data-filter');
        
        // Update active tab
        filterTabs.forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        
        // Filter items
        archiveItems.forEach(item => {
          if (filter === 'all' || item.classList.contains(filter)) {
            item.classList.remove('hidden');
            item.style.display = 'block';
          } else {
            item.classList.add('hidden');
            setTimeout(() => {
              if (item.classList.contains('hidden')) {
                item.style.display = 'none';
              }
            }, 300);
          }
        });
        
        // Refresh AOS animations for visible items
        setTimeout(() => {
          AOS.refresh();
        }, 350);
      });
    });
  }

  // Load More functionality (if using AJAX in the future)
  const loadMoreBtn = document.querySelector('.load-more-btn');
  if (loadMoreBtn) {
    loadMoreBtn.addEventListener('click', function() {
      // Placeholder for future AJAX load more functionality
      console.log('Load more clicked');
    });
  }

  // Sticky Footer Bar Functionality
  const stickyFooterBar = document.querySelector('.sticky-footer-bar');
  const mainFooter = document.querySelector('.site-footer');
  
  if (stickyFooterBar && mainFooter) {
    $(window).on('scroll', function() {
      const scrollY = window.scrollY;
      const windowHeight = window.innerHeight;
      const documentHeight = document.documentElement.offsetHeight;
      const footerTop = mainFooter.offsetTop;
      
      // Show sticky bar when scrolled past 100px
      // Hide it when the main footer is visible
      const shouldShowSticky = scrollY > 100 && (scrollY + windowHeight) < footerTop + 100;
      
      if (shouldShowSticky) {
        stickyFooterBar.classList.add('visible');
      } else {
        stickyFooterBar.classList.remove('visible');
      }
    });
  }

  // Search Modal Functionality
  const searchTrigger = document.querySelector('.search-trigger');
  const searchModal = document.querySelector('#search-modal');
  const searchClose = document.querySelector('.search-close');
  const searchInput = document.querySelector('.search-input');

  if (searchTrigger && searchModal) {
    // Open search modal
    searchTrigger.addEventListener('click', function(e) {
      e.preventDefault();
      searchModal.classList.add('active');
      if (searchInput) {
        setTimeout(() => searchInput.focus(), 100);
      }
    });

    // Close search modal
    if (searchClose) {
      searchClose.addEventListener('click', function() {
        searchModal.classList.remove('active');
      });
    }

    // Close modal when clicking outside
    searchModal.addEventListener('click', function(e) {
      if (e.target === searchModal) {
        searchModal.classList.remove('active');
      }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && searchModal.classList.contains('active')) {
        searchModal.classList.remove('active');
      }
    });
  }
});
