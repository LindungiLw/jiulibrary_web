<?php
session_start();
require 'config.php';
require 'koneksi.php';
$koneksi = getKoneksi();

// Check if user is logged in
if (!isset($_SESSION['user_status']) || $_SESSION['user_status'] !== "login") {
    $_SESSION['error_msg'] = "Please log in first to access your profile.";
    header("Location: index.php");
    exit();
}

$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'User';
$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '-';
$user_picture = isset($_SESSION['user_picture']) ? $_SESSION['user_picture'] : 'assets/images/default-avatar.png';
$user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'Guest';

// CSRF Token Generation
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Dummy Stats Removed


$success_msg = '';
$error_msg = '';

if (isset($_SESSION['success_msg'])) {
    $success_msg = $_SESSION['success_msg'];
    unset($_SESSION['success_msg']);
}
if (isset($_SESSION['error_msg'])) {
    $error_msg = $_SESSION['error_msg'];
    unset($_SESSION['error_msg']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Dream Blue Library</title>
    <link rel="icon" type="image/png" href="assets/images/library-logo.webp" />

    <!-- Load FontAwesome Asynchronously -->
    <link rel="preload" href="assets/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="assets/css/all.min.css"></noscript>

    <link rel="stylesheet" href="assets/css/style/variable.css" />
    <link rel="stylesheet" href="assets/css/base.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/navbar.css?v=2.7" />
    <link rel="stylesheet" href="assets/css/footer.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/responsive.css?v=3.2" />
    <link rel="stylesheet" href="assets/css/profile.css?v=1.0" />
</head>

<body>

    <header class="site-header glass-nav">
        <nav class="main-nav" style="justify-content: center">
            <div class="nav-logo">
                <a href="index.php" class="logo">
                    <img loading="lazy" src="assets/images/library-logo.webp" alt="JIU Library Logo" style="width: 40px; height: auto; object-fit: contain;" />
                    <div class="logo-text" style="color: #1e3a8a">Dream Blue Library</div>
                </a>
            </div>
        </nav>
    </header>

    <div class="profile-layout">
        <!-- Sidebar -->
        <aside class="profile-sidebar">
            <div class="sidebar-menu-header">
                <i class="fas fa-user-circle"></i> Profile Menu
            </div>
            <nav class="sidebar-nav">
                <a href="#" class="sidebar-item active">
                    <i class="fas fa-id-badge"></i> Profile Info
                </a>
                
                <a href="<?= BASE_URL ?>/assets/auth/logout.php" class="sidebar-item logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </nav>

        </aside>

        <!-- Main Content -->
        <main class="profile-main">
            <!-- Banner -->
            <div class="profile-banner">
                <div class="banner-user-info">
                    <img src="<?php echo htmlspecialchars($user_picture); ?>" alt="Profile" class="banner-avatar" onerror="this.src='https://ui-avatars.com/api/?name=<?php echo urlencode($user_name); ?>&background=random'">
                    <div class="banner-details">
                        <h2><?php echo htmlspecialchars($user_name); ?></h2>
                        <p>Library Member</p>
                        <div class="banner-badges">
                            <span class="badge yellow"><i class="fas fa-star"></i> <?php echo htmlspecialchars($user_role); ?></span>
                            <span class="badge dark-blue">Active</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Messages -->
            <?php if (!empty($success_msg)): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> <?= htmlspecialchars($success_msg) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($error_msg)): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error_msg) ?>
                </div>
            <?php endif; ?>

            <!-- Form Details -->
            <div class="profile-section">
                <form action="update_profile.php" method="POST">
                    <div class="section-header">
                        <h3>Profile Details</h3>
                        <button type="submit" class="btn-primary-sm">
                            <i class="fas fa-save"></i> Save Profile
                        </button>
                    </div>

                    <div class="form-grid">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" id="full_name" name="full_name" class="form-control" value="<?php echo htmlspecialchars($user_name); ?>" required placeholder="Enter your full name">
                        </div>
                        <div class="form-group">
                            <label for="email">Google Account Email</label>
                            <input type="email" id="email" class="form-control" value="<?php echo htmlspecialchars($user_email); ?>" disabled title="Your email is synced with Google SSO and cannot be changed here.">
                        </div>
                        
                        <div class="form-group full-width" style="margin-top: 10px;">
                            <div class="alert" style="background: #f8fafc; border: 1px solid #e2e8f0; color: #475569; margin-bottom: 0;">
                                <i class="fas fa-shield-alt" style="color: #3b82f6;"></i>
                                <span><strong>Data Privacy & Security:</strong> Your personal data is synced with your campus Google Account. Email address changes must be done via Google.</span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <?php include 'footer.php'; ?>

    <?php include 'chatbot-widget.php'; ?>
    <?php include 'a11y-widget.php'; ?>
</body>
</html>
