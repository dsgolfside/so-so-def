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
          
          <!-- About Column -->
          <div class="footer-column">
            <h4 class="footer-heading">About So So Def</h4>
            <p class="footer-text">Founded by Jermaine Dupri, So So Def Recordings has been a cornerstone of hip-hop and R&B music since 1993, launching the careers of countless artists and shaping the sound of Atlanta.</p>
            <div class="footer-social-links">
              <a href="https://www.instagram.com/sosodefuniversity" aria-label="Instagram" class="footer-social-icon" target="_blank" rel="noopener">
                <svg viewBox="0 0 24 24">
                  <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
              </a>
              <a href="https://x.com/sosodef" aria-label="X (Twitter)" class="footer-social-icon" target="_blank" rel="noopener">
                <svg viewBox="0 0 24 24">
                  <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                </svg>
              </a>
            </div>
          </div>

          <!-- Quick Links Column -->
          <div class="footer-column">
            <h4 class="footer-heading">Quick Links</h4>
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

          <!-- Email Signup Column -->
          <div class="footer-column">
            <h4 class="footer-heading">Get on the List</h4>
            <form class="footer-signup-form" action="#" method="post">
              <div class="footer-form-group">
                <input type="email" name="email" placeholder="Enter your email address" class="footer-email-input" required>
                <button type="submit" class="footer-submit-btn">→</button>
              </div>
            </form>
            <div class="footer-logo-section">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/so-so-def-logo-white.png" alt="So So Def" class="footer-logo-large">
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
