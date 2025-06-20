<footer class="site-footer">
  <!-- Newsletter Signup Section -->
  <section class="footer-newsletter">
    <div class="container">
      <div class="newsletter-content">
        <div class="newsletter-section">
          <h3 class="newsletter-eyebrow">JOIN US</h3>
          <h2 class="newsletter-heading">Sign up for the So So Def newsletter</h2>
          <form class="newsletter-form" action="#" method="post">
            <div class="form-group">
              <label for="newsletter-email" class="visually-hidden">Enter Email Address</label>
              <input 
                type="email" 
                id="newsletter-email" 
                name="email" 
                placeholder="ENTER EMAIL ADDRESS" 
                class="newsletter-input"
                required
              >
              <button type="submit" class="newsletter-submit" aria-label="Subscribe">
                <svg viewBox="0 0 24 24" class="submit-icon">
                  <path d="M5 12h14m-7-7l7 7-7 7"/>
                </svg>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Main Footer -->
  <section class="footer-main">
    <div class="container">
      <div class="footer-grid">
        
        <!-- Navigation Links -->
        <div class="footer-column">
          <nav class="footer-nav">
            <ul>
              <li><a href="<?php echo home_url('/music/'); ?>">MUSIC</a></li>
              <li><a href="<?php echo home_url('/about/'); ?>">ABOUT</a></li>
              <li><a href="<?php echo home_url('/category/news/'); ?>">NEWS</a></li>
              <li><a href="<?php echo home_url('/category/philanthropy/'); ?>">PHILANTHROPY</a></li>
              <li><a href="<?php echo wc_get_page_permalink('shop'); ?>">STORE</a></li>
            </ul>
          </nav>
        </div>

        <!-- Contact Info -->
        <div class="footer-column">
          <h4 class="footer-heading">Contact</h4>
          <ul class="contact-list">
            <li>Atlanta</li>
            <li>New York</li>
            <li>Los Angeles</li>
          </ul>
        </div>

        <!-- Social Links -->
        <div class="footer-column">
          <h4 class="footer-heading">Follow Us</h4>
          <div class="social-links">
            <a href="#" aria-label="Instagram" class="social-link">
              <svg viewBox="0 0 24 24" class="social-icon">
                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                <path d="m16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
              </svg>
            </a>
            <a href="#" aria-label="Twitter" class="social-link">
              <svg viewBox="0 0 24 24" class="social-icon">
                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/>
              </svg>
            </a>
            <a href="#" aria-label="TikTok" class="social-link">
              <svg viewBox="0 0 24 24" class="social-icon">
                <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/>
              </svg>
            </a>
            <a href="#" aria-label="Facebook" class="social-link">
              <svg viewBox="0 0 24 24" class="social-icon">
                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
              </svg>
            </a>
            <a href="#" aria-label="YouTube" class="social-link">
              <svg viewBox="0 0 24 24" class="social-icon">
                <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"/>
                <polygon points="9.75,15.02 15.5,11.75 9.75,8.48"/>
              </svg>
            </a>
          </div>
        </div>

        <!-- Legal Links -->
        <div class="footer-column">
          <h4 class="footer-heading">Legal</h4>
          <ul class="legal-list">
            <li><a href="<?php echo home_url('/privacy-policy/'); ?>">Privacy Policy</a></li>
            <li><a href="<?php echo home_url('/terms/'); ?>">Terms</a></li>
            <li><a href="<?php echo home_url('/accessibility/'); ?>">Accessibility Statement</a></li>
          </ul>
        </div>

      </div>
    </div>
  </section>

  <!-- Footer Bottom -->
  <section class="footer-bottom">
    <div class="container">
      <div class="footer-bottom-content">
        <p>&copy; <?php echo date('Y'); ?> So So Def Recordings. All rights reserved.</p>
      </div>
    </div>
  </section>
</footer>

<?php wp_footer(); ?>
</body>
</html>
