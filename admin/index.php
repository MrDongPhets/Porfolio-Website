<?php
// admin/index.php - Admin Dashboard / Login Gateway
require_once '../config/config.php';

// If not logged in, show login page
if (!isLoggedIn()) {
    // Handle login form submission
    $error = '';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = clean($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        
        // Validate inputs
        if (empty($email) || empty($password)) {
            $error = 'Please fill in all fields';
        } elseif (!isValidEmail($email)) {
            $error = 'Invalid email format';
        } else {
            // Rate limiting check
            if (!checkRateLimit('login_' . getUserIP(), 5, 300)) {
                $error = 'Too many login attempts. Please try again in 5 minutes.';
            } else {
                // Fetch user from database
                $result = $db->select('users', '*', ['email' => $email, 'is_active' => true]);
                
                if ($result['success'] && !empty($result['data'])) {
                    $user = $result['data'][0];
                    
                    // Verify password
                    if (verifyPassword($password, $user['password_hash'])) {
                        // Set session variables
                        $_SESSION['admin_logged_in'] = true;
                        $_SESSION['admin_id'] = $user['id'];
                        $_SESSION['admin_email'] = $user['email'];
                        $_SESSION['admin_name'] = $user['full_name'];
                        $_SESSION['admin_role'] = $user['role'];
                        
                        // Regenerate session ID for security
                        session_regenerate_id(true);
                        
                        // Redirect to dashboard
                        redirect('/admin/index.php');
                    } else {
                        $error = 'Invalid email or password';
                    }
                } else {
                    $error = 'Invalid email or password';
                }
            }
        }
    }
    
    // Show login form
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login - <?php echo SITE_NAME; ?></title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: 'Inter', sans-serif;
                background: linear-gradient(135deg, #184d37 0%, #2f7f57 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }
            
            .login-container {
                background: white;
                padding: 40px;
                border-radius: 12px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                width: 100%;
                max-width: 420px;
            }
            
            .logo {
                text-align: center;
                margin-bottom: 30px;
            }
            
            .logo h1 {
                font-size: 28px;
                color: #184d37;
                font-weight: 700;
                margin-bottom: 8px;
            }
            
            .logo p {
                color: #6b7280;
                font-size: 14px;
            }
            
            .form-group {
                margin-bottom: 20px;
            }
            
            .form-group label {
                display: block;
                margin-bottom: 8px;
                color: #374151;
                font-weight: 500;
                font-size: 14px;
            }
            
            .form-group input {
                width: 100%;
                padding: 12px 16px;
                border: 1px solid #d1d5db;
                border-radius: 8px;
                font-size: 14px;
                transition: all 0.3s;
            }
            
            .form-group input:focus {
                outline: none;
                border-color: #184d37;
                box-shadow: 0 0 0 3px rgba(24, 77, 55, 0.1);
            }
            
            .error-message {
                background: #fee;
                color: #c00;
                padding: 12px;
                border-radius: 8px;
                margin-bottom: 20px;
                font-size: 14px;
                border: 1px solid #fcc;
            }
            
            .btn-login {
                width: 100%;
                padding: 14px;
                background: #184d37;
                color: white;
                border: none;
                border-radius: 8px;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s;
            }
            
            .btn-login:hover {
                background: #0f3725;
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(24, 77, 55, 0.2);
            }
            
            .btn-login:active {
                transform: translateY(0);
            }
            
            .back-link {
                text-align: center;
                margin-top: 20px;
            }
            
            .back-link a {
                color: #184d37;
                text-decoration: none;
                font-size: 14px;
                transition: color 0.3s;
            }
            
            .back-link a:hover {
                color: #0f3725;
                text-decoration: underline;
            }
            
            @media (max-width: 480px) {
                .login-container {
                    padding: 30px 20px;
                }
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <div class="logo">
                <h1>🟡 MUSTARDDIGITAL</h1>
                <p>Admin Login</p>
            </div>
            
            <?php if ($error): ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="admin@mustarddigital.com"
                        value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                        required
                        autocomplete="email"
                    >
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Enter your password"
                        required
                        autocomplete="current-password"
                    >
                </div>
                
                <button type="submit" class="btn-login">Login</button>
            </form>
            
            <div class="back-link">
                <a href="<?php echo baseUrl(); ?>">← Back to Website</a>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit(); // Stop execution after login form
}

// User is logged in - Show Dashboard

// Get statistics
$stats = [
    'portfolio_items' => 0,
    'testimonials' => 0,
    'services' => 0,
    'messages' => 0,
    'unread_messages' => 0
];

// Fetch portfolio count
$result = $db->select('portfolio_items', 'count', ['is_active' => true]);
if ($result['success'] && !empty($result['data'])) {
    $stats['portfolio_items'] = count($result['data']);
}

// Fetch testimonials count
$result = $db->select('testimonials', 'count', ['is_active' => true]);
if ($result['success'] && !empty($result['data'])) {
    $stats['testimonials'] = count($result['data']);
}

// Fetch services count
$result = $db->select('services', 'count', ['is_active' => true]);
if ($result['success'] && !empty($result['data'])) {
    $stats['services'] = count($result['data']);
}

// Fetch messages count
$result = $db->select('contact_messages', 'count');
if ($result['success'] && !empty($result['data'])) {
    $stats['messages'] = count($result['data']);
}

// Fetch unread messages count
$result = $db->select('contact_messages', 'count', ['is_read' => false]);
if ($result['success'] && !empty($result['data'])) {
    $stats['unread_messages'] = count($result['data']);
}

// Fetch recent messages
$recentMessages = [];
$result = $db->select('contact_messages', '*', [], 'created_at.desc', 5);
if ($result['success'] && !empty($result['data'])) {
    $recentMessages = $result['data'];
}

$pageTitle = 'Dashboard';
include 'includes/header.php';
?>

<div class="dashboard-content">
    <div class="page-header">
        <h1>Dashboard</h1>
        <p>Welcome back, <?php echo e($_SESSION['admin_name']); ?>!</p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: #3b82f6;">
                <i class="fas fa-briefcase"></i>
            </div>
            <div class="stat-info">
                <h3><?php echo $stats['portfolio_items']; ?></h3>
                <p>Portfolio Items</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: #10b981;">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-info">
                <h3><?php echo $stats['testimonials']; ?></h3>
                <p>Testimonials</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: #f59e0b;">
                <i class="fas fa-cog"></i>
            </div>
            <div class="stat-info">
                <h3><?php echo $stats['services']; ?></h3>
                <p>Services</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: #ef4444;">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="stat-info">
                <h3><?php echo $stats['unread_messages']; ?></h3>
                <p>Unread Messages</p>
            </div>
        </div>
    </div>

    <!-- Recent Messages -->
    <div class="card">
        <div class="card-header">
            <h2>Recent Messages</h2>
            <a href="messages.php" class="btn btn-sm">View All</a>
        </div>
        <div class="card-body">
            <?php if (empty($recentMessages)): ?>
                <p class="text-muted">No messages yet.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentMessages as $message): ?>
                                <tr>
                                    <td><?php echo e($message['name']); ?></td>
                                    <td><?php echo e($message['email']); ?></td>
                                    <td><?php echo e(truncate($message['message'], 50)); ?></td>
                                    <td><?php echo timeAgo($message['created_at']); ?></td>
                                    <td>
                                        <?php if ($message['is_read']): ?>
                                            <span class="badge badge-success">Read</span>
                                        <?php else: ?>
                                            <span class="badge badge-warning">Unread</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h2>Quick Actions</h2>
        <div class="actions-grid">
            <a href="hero.php" class="action-card">
                <i class="fas fa-image"></i>
                <span>Edit Hero Section</span>
            </a>
            <a href="about.php" class="action-card">
                <i class="fas fa-info-circle"></i>
                <span>Edit About Section</span>
            </a>
            <a href="portfolio.php" class="action-card">
                <i class="fas fa-folder-plus"></i>
                <span>Add Portfolio Item</span>
            </a>
            <a href="testimonials.php" class="action-card">
                <i class="fas fa-comment-dots"></i>
                <span>Manage Testimonials</span>
            </a>
            <a href="services.php" class="action-card">
                <i class="fas fa-tools"></i>
                <span>Manage Services</span>
            </a>
            <a href="settings.php" class="action-card">
                <i class="fas fa-cog"></i>
                <span>Site Settings</span>
            </a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>