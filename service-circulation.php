<?php
session_start();
require_once 'config.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Circulation Services - Dream Blue Library</title>
    
    <link rel="preload" href="assets/fonts/Poppins-Bold.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="assets/fonts/Poppins-Regular.woff2" as="font" type="font/woff2" crossorigin>

    <meta property="og:title" content="Circulation Services - Dream Blue Library" />
    <meta property="og:description" content="Borrow, renew, and return physical library materials." />
    <link rel="icon" type="image/webp" href="assets/images/library-logo.webp" />

    <link rel="stylesheet" href="assets/css/fonts.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <link rel="stylesheet" href="assets/css/style/variable.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/base.css?v=1.2" />
    <link rel="stylesheet" href="assets/css/navbar.css?v=2.3" />
    <link rel="stylesheet" href="assets/css/style/modal.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/footer.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/responsive.css?v=3.0" />
    
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <style>
      .service-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        color: white;
        padding: 80px 0 60px;
        text-align: center;
        border-bottom-left-radius: 40px;
        border-bottom-right-radius: 40px;
      }
      .service-header h1 { font-size: 2.5rem; margin-bottom: 15px; }
      .service-header p { font-size: 1.1rem; opacity: 0.9; max-width: 600px; margin: 0 auto; }
      
      .service-content { padding: 60px 0; }
      
      .rules-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 30px;
        background: white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border-radius: 12px;
        overflow: hidden;
      }
      .rules-table th { background: #f8fafc; padding: 15px 20px; text-align: left; color: #1e293b; font-weight: 600; border-bottom: 2px solid #e2e8f0; }
      .rules-table td { padding: 15px 20px; border-bottom: 1px solid #e2e8f0; color: #475569; }
      .rules-table tr:last-child td { border-bottom: none; }
      .rules-table tr:hover { background: #f1f5f9; }
      
      .info-box {
        background: #eff6ff;
        border-left: 4px solid #3b82f6;
        padding: 20px;
        border-radius: 8px;
        margin-top: 40px;
      }
      .info-box h4 { color: #1e3a8a; margin-bottom: 10px; font-size: 1.1rem; }
      .info-box p { color: #334155; font-size: 0.95rem; line-height: 1.6; margin-bottom: 10px; }
    </style>
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <header class="service-header">
      <div class="container">
        <h1>Circulation Services</h1>
        <p>Everything you need to know about borrowing, renewing, and returning library physical materials.</p>
      </div>
    </header>

    <section class="service-content">
      <div class="container">
        <div class="section-title">
          <h2>Borrowing Rules & Policies</h2>
          <p>Please observe the following limits based on your membership type.</p>
        </div>
        
        <table class="rules-table">
          <thead>
            <tr>
              <th>Member Type</th>
              <th>Max Items</th>
              <th>Loan Duration</th>
              <th>Renewals Allowed</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Undergraduate Students</td>
              <td>5 Books</td>
              <td>14 Days</td>
              <td>1 Time (Online/Offline)</td>
            </tr>
            <tr>
              <td>Graduate Students</td>
              <td>7 Books</td>
              <td>21 Days</td>
              <td>2 Times</td>
            </tr>
            <tr>
              <td>Lecturers / Staff</td>
              <td>10 Books</td>
              <td>30 Days</td>
              <td>2 Times</td>
            </tr>
          </tbody>
        </table>

        <div class="info-box">
          <h4><i class="fas fa-exclamation-circle"></i> Fines and Lost Books</h4>
          <p>A fine of <strong>Rp 2,000 per day</strong> applies for overdue items. Please ensure you return or renew your materials on time.</p>
          <p>If a book is lost, the borrower is responsible for replacing the book with the exact same edition or paying the original purchase price plus administrative fees.</p>
        </div>
      </div>
    </section>

    <?php include 'footer.php'; ?>
    
    <?php include 'chatbot-widget.php'; ?>
    <?php include 'a11y-widget.php'; ?>

    <script>
      window.BASE_URL = "<?php echo defined('BASE_URL') ? BASE_URL : ''; ?>";
    </script>
    <script defer src="assets/js/dictionary.js?v=1.3"></script>
    <script defer src="assets/js/main.js?v=2.0"></script>
    <script defer src="assets/js/chatbot.js?v=1.8"></script>
  </body>
</html>
