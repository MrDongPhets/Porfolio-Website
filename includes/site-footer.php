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


        $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
            $('#nav').addClass('scrolled');
        } else {
            $('#nav').removeClass('scrolled');
        }
    });

    // Add nav scroll styles
    if (!$('#nav-scroll-styles').length) {
        $('<style id="nav-scroll-styles">')
            .html(`
                #nav.scrolled {
                    width: 80%;
                    margin-top: 1rem;
                     border-radius: 10px;
                    background-color: var(--header-bg);
                    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
                    transition: transform 0.3s ease;
                        transition: all 0.3s ease-in-out
                }
                body.light-mode #nav.scrolled {
                    background: rgba(255, 255, 255, 0.95);
                    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
                }
            `)
            .appendTo('head');
    }

// Hamburger menu toggle
(function(){
  const hamburger = $('#hamburger');
  const nav = $('#mainNav');
  const navDropdown = $('.nav-dropdown');
  
  hamburger.on('click', function(e){
    e.stopPropagation();
    $(this).toggleClass('active');
    nav.toggleClass('active');
    
    // Close dropdown when closing menu
    if (!nav.hasClass('active')) {
      navDropdown.removeClass('active');
    }
  });
  
  // Close menu when clicking regular nav links
  $('.nav-link:not(.dropdown-toggle)').on('click', function(){
    hamburger.removeClass('active');
    nav.removeClass('active');
    navDropdown.removeClass('active');
  });
  
  // Close menu when clicking outside
  $(document).on('click', function(e){
    if(!$(e.target).closest('header').length){
      hamburger.removeClass('active');
      nav.removeClass('active');
      navDropdown.removeClass('active');
    }
  });
})();

    // Dropdown menu toggle
(function(){
  const dropdownToggle = $('.dropdown-toggle');
  const navDropdown = $('.nav-dropdown');
  const mainNav = $('#mainNav');
  const hamburger = $('#hamburger');
  
  // Desktop hover behavior
  if ($(window).width() > 768) {
    navDropdown.on('mouseenter', function() {
      $(this).addClass('active');
    });
    
    navDropdown.on('mouseleave', function() {
      $(this).removeClass('active');
    });
  }
  
  // Mobile click behavior
  dropdownToggle.on('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    
    if ($(window).width() <= 768) {
      navDropdown.toggleClass('active');
    }
  });
  
  // Close dropdown when clicking a dropdown item on mobile
  $('.dropdown-item').on('click', function() {
    if ($(window).width() <= 768) {
      navDropdown.removeClass('active');
      mainNav.removeClass('active');
      hamburger.removeClass('active');
    }
  });
  
  // Close dropdown when clicking outside
  $(document).on('click', function(e) {
    if (!$(e.target).closest('.nav-dropdown').length) {
      navDropdown.removeClass('active');
    }
  });
  
  // Handle window resize - switch between mobile and desktop behavior
  let resizeTimer;
  $(window).on('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() {
      if ($(window).width() > 768) {
        navDropdown.removeClass('active');
        mainNav.removeClass('active');
        hamburger.removeClass('active');
      }
    }, 250);
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