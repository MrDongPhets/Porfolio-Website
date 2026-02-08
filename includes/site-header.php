<?php
// includes/site-header.php - Site Header Component
// Fetch site settings if not already loaded
if (!function_exists('getSetting')) {
    require_once __DIR__ . '/../config/config.php';
}

$siteName = getSetting('site_name', 'MR. DONGPHETS');
$pageTitle = $pageTitle ?? $siteName;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title><?php echo e($pageTitle); ?> — <?php echo e($siteName); ?></title>
  <meta name="description" content="<?php echo e(getSetting('site_description', 'Creative design studio specializing in logos, branding, and web design')); ?>">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="<?php echo baseUrl('css/style.css'); ?>">
  <link rel="stylesheet" href="<?php echo baseUrl('css/portfolio.css'); ?>">
  <link rel="stylesheet" href="<?php echo baseUrl('css/services.css'); ?>">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body data-theme="light">
  <div class="container">
    <header>
      <div class="brand">
        <a href="<?php echo baseUrl(); ?>" style="color: inherit; text-decoration: none;">
          <?php echo e($siteName); ?>
        </a>
      </div>
      <nav id="mainNav">
        <a href="<?php echo baseUrl(); ?>" class="nav-link">Home</a>
        <a href="<?php echo baseUrl(); ?>#about" class="nav-link">About</a>
        <a href="<?php echo baseUrl('services.php'); ?>" class="nav-link">Services</a>
        <a href="<?php echo baseUrl(); ?>#work" class="nav-link">Work</a>
        <a href="<?php echo baseUrl('portfolio.php'); ?>" class="nav-link">Portfolio</a>
        <a href="<?php echo baseUrl(); ?>#reviews" class="nav-link">Reviews</a>
        <a href="<?php echo baseUrl(); ?>#contact" class="nav-link">Contact</a>
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