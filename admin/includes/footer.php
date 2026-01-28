</main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Sidebar toggle
        $(document).ready(function() {
            const sidebar = $('#sidebar');
            const toggleBtn = $('#toggleSidebar');
            const mobileToggle = $('#mobileToggle');
            
            // Desktop toggle
            toggleBtn.on('click', function() {
                sidebar.toggleClass('collapsed');
                localStorage.setItem('sidebarCollapsed', sidebar.hasClass('collapsed'));
            });
            
            // Mobile toggle
            mobileToggle.on('click', function() {
                sidebar.toggleClass('mobile-open');
            });
            
            // Close sidebar when clicking outside on mobile
            $(document).on('click', function(e) {
                if ($(window).width() <= 768) {
                    if (!$(e.target).closest('.sidebar, .mobile-toggle').length) {
                        sidebar.removeClass('mobile-open');
                    }
                }
            });
            
            // Restore sidebar state
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                sidebar.addClass('collapsed');
            }
            
            // Auto-hide flash messages after 5 seconds
            setTimeout(function() {
                $('[style*="padding: 12px 20px"]').fadeOut();
            }, 5000);
        });
    </script>
</body>
</html>