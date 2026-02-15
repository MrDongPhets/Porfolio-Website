<?php
// includes/site-header.php - Site Header Component
if (!function_exists('getSetting')) {
    require_once __DIR__ . '/../config/config.php';
}

$siteName = getSetting('site_name', 'MR. DONGPHETS');
$pageTitle = $pageTitle ?? $siteName;

// Define services for dropdown
$services = [
    [
        'name' => 'Web Design & Development',
        'url' => baseUrl('web-design.php'),
        'icon' => 'fa-laptop-code',
        'description' => 'Custom websites & web applications'
    ],
    [
        'name' => 'Branding & Creative Design',
        'url' => baseUrl('branding.php'),
        'icon' => 'fa-palette',
        'description' => 'Logo design & brand identity'
    ],
    [
        'name' => 'Video Editing & Multimedia',
        'url' => baseUrl('video-editing.php'),
        'icon' => 'fa-video',
        'description' => 'Social videos & content editing'
    ],
        [
        'name' => 'Content Creation & Media',
        'url' => baseUrl('content-creation.php'),
        'icon' => 'fa-images',
        'description' => 'Visual content & marketing graphics'
    ],
        [
        'name' => 'Administrative Support',
        'url' => baseUrl('admin-support.php'),
        'icon' => 'fa-user-cog',
        'description' => 'Virtual assistance & operations'
    ],

];
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title><?php echo e($pageTitle); ?> — <?php echo e($siteName); ?></title>
  <meta name="description" content="<?php echo e(getSetting('site_description', 'Creative design studio specializing in logos, branding, and web design')); ?>">
  
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  
  <!-- AOS Animation Library -->
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
  
  <!-- Stylesheets -->
  <link rel="stylesheet" href="<?php echo baseUrl('css/style.css'); ?>">
  <link rel="stylesheet" href="<?php echo baseUrl('css/style-modern.css'); ?>">
  <link rel="stylesheet" href="<?php echo baseUrl('css/about.css'); ?>">
  <link rel="stylesheet" href="<?php echo baseUrl('css/service-detail.css'); ?>">
  <link rel="stylesheet" href="<?php echo baseUrl('css/portfolio.css'); ?>">
  <link rel="stylesheet" href="<?php echo baseUrl('css/services.css'); ?>">
  <link rel="stylesheet" href="<?php echo baseUrl('css/contact.css'); ?>">
  
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body data-theme="light">
  <div class="container">
    <header>
      <div class="brand">
        <a href="<?php echo baseUrl(); ?>" style="color: inherit; text-decoration: none;">
         <div class="logo-img">
          <img src="../assets/mustard.png" alt="">
         </div>
        </a>
      </div>
      <nav id="mainNav">
        <a href="<?php echo baseUrl(); ?>" class="nav-link">Home</a>
        <a href="<?php echo baseUrl('about.php'); ?>" class="nav-link">About</a>
        
        <!-- Services Dropdown -->
        <div class="nav-dropdown">
          <a href="#" class="nav-link dropdown-toggle">
            Services <i class="fas fa-chevron-down"></i>
          </a>
          <div class="dropdown-menu">
            <div class="dropdown-grid">
              <?php foreach ($services as $service): ?>
                <a href="<?php echo $service['url']; ?>" class="dropdown-item">
                  <div class="dropdown-icon">
                    <i class="fas <?php echo $service['icon']; ?>"></i>
                  </div>
                  <div class="dropdown-content">
                    <h4><?php echo e($service['name']); ?></h4>
                    <p><?php echo e($service['description']); ?></p>
                  </div>
                </a>
              <?php endforeach; ?>
            </div>
            <!-- <div class="dropdown-footer">
              <a href="<?php // echo baseUrl('services.php'); ?>" class="btn-view-all">
                View All Services <i class="fas fa-arrow-right"></i>
              </a>
            </div> -->
          </div>
        </div>
        
        <a href="<?php echo baseUrl('portfolio.php'); ?>" class="nav-link">Portfolio</a>
        <a href="<?php echo baseUrl('contact.php'); ?>" class="nav-link">Contact</a>
      </nav>
      <div class="controls">
        <div class="theme-toggle" id="themeToggle"><i class="fa-solid fa-sun"></i></div>
        <div class="toggle hamburger" id="hamburger">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </header>