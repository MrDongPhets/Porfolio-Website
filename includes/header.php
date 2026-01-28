<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Admin Panel'; ?> - <?php echo SITE_NAME; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h2>🟡 MUSTARD</h2>
                <button class="toggle-btn" id="toggleSidebar">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            
            <nav class="sidebar-nav">
                <a href="index.php" class="nav-item <?php echo isActivePage('index'); ?>">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                
                <div class="nav-section">Content Management</div>
                
                <a href="hero.php" class="nav-item <?php echo isActivePage('hero'); ?>">
                    <i class="fas fa-image"></i>
                    <span>Hero Section</span>
                </a>
                
                <a href="about.php" class="nav-item <?php echo isActivePage('about'); ?>">
                    <i class="fas fa-info-circle"></i>
                    <span>About Section</span>
                </a>
                
                <a href="services.php" class="nav-item <?php echo isActivePage('services'); ?>">
                    <i class="fas fa-cog"></i>
                    <span>Services</span>
                </a>
                
                <a href="portfolio.php" class="nav-item <?php echo isActivePage('portfolio'); ?>">
                    <i class="fas fa-briefcase"></i>
                    <span>Portfolio</span>
                </a>
                
                <a href="testimonials.php" class="nav-item <?php echo isActivePage('testimonials'); ?>">
                    <i class="fas fa-star"></i>
                    <span>Testimonials</span>
                </a>
                
                <div class="nav-section">Communication</div>
                
                <a href="messages.php" class="nav-item <?php echo isActivePage('messages'); ?>">
                    <i class="fas fa-envelope"></i>
                    <span>Messages</span>
                    <?php
                    // Show unread count
                    $result = $db->select('contact_messages', 'count', ['is_read' => false]);
                    if ($result['success'] && !empty($result['data'])) {
                        $unreadCount = count($result['data']);
                        if ($unreadCount > 0) {
                            echo '<span class="badge">' . $unreadCount . '</span>';
                        }
                    }
                    ?>
                </a>
                
                <div class="nav-section">Settings</div>
                
                <a href="settings.php" class="nav-item <?php echo isActivePage('settings'); ?>">
                    <i class="fas fa-cog"></i>
                    <span>Site Settings</span>
                </a>
                
                <a href="media.php" class="nav-item <?php echo isActivePage('media'); ?>">
                    <i class="fas fa-folder"></i>
                    <span>Media Library</span>
                </a>
            </nav>
            
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        <?php echo strtoupper(substr($_SESSION['admin_name'], 0, 2)); ?>
                    </div>
                    <div class="user-details">
                        <div class="user-name"><?php echo e($_SESSION['admin_name']); ?></div>
                        <div class="user-email"><?php echo e($_SESSION['admin_email']); ?></div>
                    </div>
                </div>
                <a href="logout.php" class="logout-btn" onclick="return confirm('Are you sure you want to logout?')">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Bar -->
            <header class="topbar">
                <button class="mobile-toggle" id="mobileToggle">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="topbar-right">
                    <a href="<?php echo baseUrl(); ?>" target="_blank" class="btn btn-outline">
                        <i class="fas fa-external-link-alt"></i>
                        View Site
                    </a>
                </div>
            </header>

            <!-- Flash Messages -->
            <?php displayFlash(); ?>

            <!-- Page Content -->