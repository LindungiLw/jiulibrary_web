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
    <link rel="stylesheet" href="assets/css/navbar.css?v=2.7" />
    <link rel="stylesheet" href="assets/css/style/modal.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/footer.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/responsive.css?v=3.2" />
    
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <style>
      .service-header {
        background: linear-gradient(to bottom, rgba(30, 58, 138, 0.95) 0%, rgba(59, 130, 246, 0.2) 100%),
                    url('assets/images/services-photo/circulation.png');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 140px 0 60px;
        text-align: center;
        border-bottom-left-radius: 40px;
        border-bottom-right-radius: 40px;
      }
      .service-header h1 { font-size: 2.5rem; margin-bottom: 15px; }
      .service-header p { font-size: 1.1rem; opacity: 0.9; max-width: 600px; margin: 0 auto; }
      
      .service-content { padding: 60px 0; background-color: #f8fafc; }
      
      .section-title {
        text-align: center;
        margin-bottom: 50px;
      }
      .section-title h2 {
        font-size: 2.2rem;
        color: #1e293b;
        font-weight: 700;
        margin-bottom: 15px;
      }
      .section-title p {
        color: #64748b;
        font-size: 1.1rem;
      }
      
      .circulation-table-wrapper {
        max-width: 800px;
        margin: 0 auto;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        background: white;
      }
      .circulation-table {
        width: 100%;
        border-collapse: collapse;
      }
      .circulation-table th {
        background: #9b7eb5; /* Purple header matching the image */
        color: white;
        font-size: 1.25rem;
        font-weight: 700;
        padding: 20px 25px;
        text-align: left;
        border-right: 1px solid rgba(255,255,255,0.3);
      }
      .circulation-table th:last-child {
        border-right: none;
      }
      .circulation-table td {
        padding: 20px 25px;
        font-size: 1.15rem;
        color: #334155;
        border-bottom: 1px solid #e2e8f0;
      }
      .circulation-table .info-cell {
        background: #b79ecc; /* Lighter purple for left column */
        color: #1e293b;
        font-weight: 600;
        border-right: 1px solid white;
        width: 35%;
      }
      .circulation-table tr:last-child td {
        border-bottom: none;
      }

      .info-box {
        max-width: 800px;
        margin: 40px auto 0;
        background: white;
        border-left: 4px solid #3b82f6;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.03);
      }
      .info-box h4 { color: #1e3a8a; margin-bottom: 10px; font-size: 1.2rem; }
      .info-box p { color: #475569; font-size: 1.05rem; line-height: 1.6; margin-bottom: 0; }
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
          <p>Please observe the following library circulation guidelines.</p>
        </div>
        
        <div class="circulation-table-wrapper">
          <table class="circulation-table">
            <thead>
              <tr>
                <th class="text-center" style="text-align: center;">Information</th>
                <th class="text-center" style="text-align: center;">Details</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="info-cell">Maximum Books</td>
                <td>Up to 5 books per borrowing</td>
              </tr>
              <tr>
                <td class="info-cell">Loan Period</td>
                <td>2 weeks from the borrowing date</td>
              </tr>
              <tr>
                <td class="info-cell">Late Fine</td>
                <td>IDR 1,000/book per day</td>
              </tr>
              <tr>
                <td class="info-cell">Fine Calculation</td>
                <td>Calculated from the day after due date</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="info-box">
          <h4><i class="fas fa-info-circle" style="color: #3b82f6; margin-right: 8px;"></i> Additional Information</h4>
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
    <script defer src="assets/js/dictionary.js?v=1.4"></script>
    <script defer src="assets/js/main.js?v=2.3"></script>
  </body>
</html>
