<?php
// admin/logout.php - Logout Handler
require_once '../config/config.php';

// Destroy session
session_unset();
session_destroy();

// Clear session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Redirect to admin home (which will show login)
redirect('/admin/index.php');