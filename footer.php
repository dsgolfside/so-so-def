<!-- Sticky Social Icons Bar -->
<div class="sticky-footer-bar">
  <div class="social-icons">
    <a href="https://x.com/sosodef" aria-label="X (Twitter)" class="social-icon" target="_blank" rel="noopener">
      <svg viewBox="0 0 24 24">
        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
      </svg>
    </a>
    
    <a href="https://www.instagram.com/sosodefuniversity" aria-label="Instagram" class="social-icon" target="_blank" rel="noopener">
      <svg viewBox="0 0 24 24">
        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
        <path d="m16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
      </svg>
    </a>
    
    <a href="mailto:info@sosodef.com" aria-label="Email" class="social-icon">
      <svg viewBox="0 0 24 24">
        <rect x="2" y="4" width="20" height="16" rx="2"/>
        <path d="m22 7-10 5L2 7"/>
      </svg>
    </a>
    
    <button aria-label="Search" class="social-icon search-trigger">
      <svg viewBox="0 0 24 24">
        <circle cx="11" cy="11" r="8"/>
        <path d="m21 21-4.35-4.35"/>
      </svg>
    </button>
  </div>
</div>

<!-- Main Footer Content -->
<footer class="site-footer" id="footer" role="contentinfo">
  <div class="footer-content">
    <div class="container">
      
      <!-- Footer Navigation & Content -->
      <div class="footer-main">
        <div class="footer-grid">
          
          <!-- Logo Column -->
          <div class="footer-column">
            <div class="footer-logo-section">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/so-so-def-logo-white.png" alt="So So Def" class="footer-logo-large">
            </div>
          </div>

          <!-- Footer Menu Column -->
          <div class="footer-column">
            <nav class="footer-nav">
              <?php
              wp_nav_menu(array(
                'theme_location' => 'footer',
                'menu_class' => 'footer-menu',
                'container' => false,
                'fallback_cb' => false,
              ));
              ?>
            </nav>
          </div>

          <!-- Contact Column -->
          <div class="footer-column">
            <h4 class="footer-heading">Contact</h4>
            <div class="contact-info">
              <p><strong>Atlanta Headquarters</strong><br>
              123 Music Row<br>
              Atlanta, GA 30309</p>
              
              <p><strong>New York Office</strong><br>
              456 Broadway<br>
              New York, NY 10013</p>
              
              <p><strong>Los Angeles Office</strong><br>
              789 Sunset Blvd<br>
              Los Angeles, CA 90028</p>
            </div>
          </div>

        </div>
      </div>

      <!-- Footer Bottom -->
      <div class="footer-bottom">
        <div class="legal-links">
          <a href="<?php echo home_url('/privacy-policy/'); ?>">Privacy Policy</a>
          <span>/</span>
          <a href="<?php echo home_url('/terms-of-use/'); ?>">Terms of Service</a>
          <span>/</span>
          <a href="<?php echo home_url('/cookie-policy/'); ?>">Cookie Policy</a>
        </div>
        <div class="copyright">
          <p>&copy; <?php echo date('Y'); ?> So So Def Recordings. All rights reserved.</p>
        </div>
      </div>

    </div>
  </div>
</footer>

<!-- Search Modal -->
<div id="search-modal" class="search-modal">
  <div class="search-modal-content">
    <button class="search-close" aria-label="Close search">&times;</button>
    <form class="search-form" role="search" action="<?php echo home_url('/'); ?>">
      <input type="search" name="s" placeholder="Enter a Label, Artist, or Business Need..." class="search-input" autofocus>
      <button type="submit" class="search-submit" aria-label="Search">
        <svg viewBox="0 0 24 24">
          <circle cx="11" cy="11" r="8"/>
          <path d="m21 21-4.35-4.35"/>
        </svg>
      </button>
    </form>
  </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
