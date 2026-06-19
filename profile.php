<?php
session_start();
require 'config.php';
require 'koneksi.php';
$koneksi = getKoneksi();

// Check if user is logged in
if (!isset($_SESSION['user_status']) || $_SESSION['user_status'] !== "login") {
    $_SESSION['error_msg'] = "Silakan login terlebih dahulu untuk mengakses profil.";
    header("Location: index.php");
    exit();
}

$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'User';
$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '-';
$user_picture = isset($_SESSION['user_picture']) ? $_SESSION['user_picture'] : 'assets/images/default-avatar.png';
$user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'Guest';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Dream Blue Library</title>
    <link rel="icon" type="image/png" href="assets/images/library-logo.webp" />

    <!-- Load FontAwesome Asynchronously (Local) -->
    <link rel="preload" href="assets/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="assets/css/all.min.css"></noscript>

    <link rel="stylesheet" href="assets/css/style/variable.css" />
    <link rel="stylesheet" href="assets/css/base.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/navbar.css" />
    <link rel="stylesheet" href="assets/css/style/section-page.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/footer.css?v=1.1" />

    <style>
        .profile-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .profile-header-bg {
            height: 150px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            position: relative;
        }

        .profile-content {
            padding: 0 40px 40px;
            text-align: center;
            position: relative;
        }

        .profile-avatar-wrapper {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 5px solid white;
            background: white;
            margin: -60px auto 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            overflow: hidden;
            position: relative;
            z-index: 2;
        }

        .profile-avatar {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-name {
            font-size: 1.8rem;
            color: var(--text-dark);
            font-weight: 700;
            margin-bottom: 5px;
        }

        .profile-role {
            display: inline-block;
            background: rgba(59, 130, 246, 0.1);
            color: var(--primary);
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .profile-role.member {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .profile-info-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            text-align: left;
            margin-top: 30px;
            border-top: 1px solid #e2e8f0;
            padding-top: 30px;
        }

        .info-item {
            background: #f8fafc;
            padding: 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.2rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .info-text h4 {
            font-size: 0.85rem;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .info-text p {
            font-size: 1.1rem;
            color: var(--text-dark);
            font-weight: 500;
        }

        .btn-logout-profile {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #ef4444;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 30px;
            transition: all 0.3s ease;
        }

        .btn-logout-profile:hover {
            background: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.3);
        }
    </style>
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

    <header class="page-header">
        <div class="page-header-container">
            <a href="index.php" class="btn-back-header">
                <i class="fas fa-arrow-left"></i> Back to Home
            </a>
            <h1 class="page-title">My <span style="color: #facc15;">Profile</span></h1>
        </div>
    </header>

    <main class="section-page-grid" style="display: block; padding: 40px 20px 80px;">
        <div class="profile-container">
            <div class="profile-header-bg"></div>
            <div class="profile-content">
                <div class="profile-avatar-wrapper">
                    <img src="<?php echo htmlspecialchars($user_picture); ?>" alt="Profile" class="profile-avatar" onerror="this.src='https://ui-avatars.com/api/?name=<?php echo urlencode($user_name); ?>&background=random'">
                </div>
                
                <h2 class="profile-name"><?php echo htmlspecialchars($user_name); ?></h2>
                <div class="profile-role <?php echo ($user_role == 'JIU Member') ? 'member' : ''; ?>">
                    <i class="fas <?php echo ($user_role == 'JIU Member') ? 'fa-check-circle' : 'fa-user'; ?>"></i> 
                    <?php echo htmlspecialchars($user_role); ?>
                </div>

                <div class="profile-info-grid">
                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-envelope"></i></div>
                        <div class="info-text">
                            <h4>Email Address</h4>
                            <p><?php echo htmlspecialchars($user_email); ?></p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-id-card"></i></div>
                        <div class="info-text">
                            <h4>Account Status</h4>
                            <p>Active</p>
                        </div>
                    </div>
                </div>

                <a href="<?= BASE_URL ?>/assets/auth/logout.php" class="btn-logout-profile">
                    <i class="fas fa-sign-out-alt"></i> Logout Account
                </a>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

</body>

</html>
