<script src="<?php echo baseUrl('js/index.js'); ?>"></script>

<?php
// includes/site-footer.php - Site Footer Component
$siteName = getSetting('site_name', 'MR. DONGPHETS');
?>
    <footer>
      © <span id="year"></span> <?php echo e($siteName); ?> • Crafted with care
    </footer>
    
    <!-- Scroll to top button -->
    <button class="scroll-top" id="scrollTop">↑</button>
  </div>

  <script>
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

    // Theme toggle
    (function(){
      const btn = $('#themeToggle');
      const root = $('body');
      const saved = localStorage.getItem('md-theme') || 'light';
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
  </script>
</body>
</html>