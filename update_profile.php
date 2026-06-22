<?php
session_start();
require 'config.php';
require 'koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_status']) || $_SESSION['user_status'] !== "login") {
    $_SESSION['error_msg'] = "Unauthorized access.";
    header("Location: profile.php");
    exit();
}

$koneksi = getKoneksi();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF Protection Check
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['error_msg'] = "Invalid CSRF token. Action denied.";
        header("Location: profile.php");
        exit();
    }

    $new_name = trim($_POST['full_name'] ?? '');
    $user_id = $_SESSION['user_id'];

    if (!empty($new_name)) {
        try {
            // Update the user's name in the database
            $stmt = $koneksi->prepare("UPDATE users SET name = ? WHERE id = ?");
            $stmt->execute([$new_name, $user_id]);

            // Update the session variable so UI reflects the new name immediately
            $_SESSION['user_name'] = $new_name;

            // Optional: You can also update the fallback avatar if you want it to reflect the new initials
            $_SESSION['user_picture'] = 'https://ui-avatars.com/api/?name=' . urlencode($new_name) . '&background=f8fafc&color=475569&rounded=true';

            $_SESSION['success_msg'] = "Profile updated successfully!";
        } catch (PDOException $e) {
            $_SESSION['error_msg'] = "Database error: " . $e->getMessage();
        }
    } else {
        $_SESSION['error_msg'] = "Name cannot be empty.";
    }

    header("Location: profile.php");
    exit();
} else {
    // Redirect back to profile if accessed without POST
    header("Location: profile.php");
    exit();
}
?>
