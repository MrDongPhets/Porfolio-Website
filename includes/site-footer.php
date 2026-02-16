<script src="<?php echo asset_version('js/index.js'); ?>"></script>

<?php
$siteName = getSetting('site_name', 'MUSTARD DIGITALS');
?>
    <footer>
      © <span id="year"></span> <?php echo e($siteName); ?> • Crafted with care
    </footer>
    
    <!-- Scroll to top button -->
    <button class="scroll-top" id="scrollTop">↑</button>
  </div>

  <!-- AOS Animation Library -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  
  <script>
    // Initialize AOS
    AOS.init({
      duration: 800,
      easing: 'ease-in-out',
      once: false,
      offset: 100
    });

    // Hamburger menu toggle
    (function(){
      const hamburger = $('#hamburger');
      const nav = $('#mainNav');
      
      hamburger.on('click', function(e){
        e.stopPropagation();
        $(this).toggleClass('active');
        nav.toggleClass('active');
      });
      
      $('.nav-link').on('click', function(){
        hamburger.removeClass('active');
        nav.removeClass('active');
      });
      
      $(document).on('click', function(e){
        if(!$(e.target).closest('header').length){
          hamburger.removeClass('active');
          nav.removeClass('active');
        }
      });
    })();

    // Dropdown menu toggle
(function(){
  const dropdownToggle = $('.dropdown-toggle');
  const navDropdown = $('.nav-dropdown');
  
  // Desktop hover
  if ($(window).width() > 768) {
    navDropdown.on('mouseenter', function() {
      $(this).addClass('active');
    });
    
    navDropdown.on('mouseleave', function() {
      $(this).removeClass('active');
    });
  }
  
  // Mobile click
  dropdownToggle.on('click', function(e) {
    if ($(window).width() <= 768) {
      e.preventDefault();
      navDropdown.toggleClass('active');
    }
  });
  
  // Close dropdown when clicking outside
  $(document).on('click', function(e) {
    if (!$(e.target).closest('.nav-dropdown').length) {
      navDropdown.removeClass('active');
    }
  });
})();

    // Theme toggle
    (function(){
      const btn = $('#themeToggle');
      const root = $('body');
      const saved = localStorage.getItem('md-theme') || 'dark';
      root.attr('data-theme', saved);
      btn.html(saved==='light'?'<i class="fa-solid fa-moon"></i>':'<i class="fa-solid fa-sun"></i>');
      btn.on('click', function(){
        const cur = root.attr('data-theme');
        const next = cur === 'light' ? 'dark' : 'light';
        root.attr('data-theme', next);
        btn.html(next==='light'?'<i class="fa-solid fa-moon"></i>':'<i class="fa-solid fa-sun"></i>');
        localStorage.setItem('md-theme', next);
      })
    })();

    // Footer year
    $('#year').text(new Date().getFullYear());

    // Scroll to top button
    (function(){
      const scrollBtn = $('#scrollTop');
      
      $(window).on('scroll', function(){
        if($(window).scrollTop() > 300){
          scrollBtn.addClass('visible');
        } else {
          scrollBtn.removeClass('visible');
        }
      });
      
      scrollBtn.on('click', function(){
        $('html, body').animate({scrollTop: 0}, 400);
      });
    })();

    // Smooth scroll for anchor links
    $('a[href^="#"]').on('click', function(e) {
      const target = $(this.getAttribute('href'));
      if(target.length) {
        e.preventDefault();
        $('html, body').stop().animate({
          scrollTop: target.offset().top - 80
        }, 600);
      }
    });

    // Contact form handler
    $('#contactForm').on('submit', function(e){
      e.preventDefault();
      const name = $('#name').val();
      const email = $('#email').val();
      const message = $('#message').val();
      const submitBtn = $(this).find('button[type="submit"]');
      
      submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Sending...').prop('disabled', true);
      
      $.ajax({
        url: '<?php echo baseUrl("contact-handler.php"); ?>',
        method: 'POST',
        data: { name, email, message },
        success: function(response) {
          alert('Message sent — thank you, ' + name + '!');
          $('#contactForm')[0].reset();
        },
        error: function(xhr, status, error) {
          console.error('Contact form error:', error);
          alert('Failed to send message. Please try again or email directly.');
        },
        complete: function() {
          submitBtn.html('Send Message <i class="fas fa-paper-plane"></i>').prop('disabled', false);
        }
      });
    });
  </script>
</body>
</html>