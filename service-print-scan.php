<?php
session_start();
require_once 'config.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Printing & Scanning - Dream Blue Library</title>
    
    <link rel="preload" href="assets/fonts/Poppins-Bold.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="assets/fonts/Poppins-Regular.woff2" as="font" type="font/woff2" crossorigin>

    <meta property="og:title" content="Printing & Scanning - Dream Blue Library" />
    <meta property="og:description" content="Self-service printing, scanning, and copying facilities." />
    <link rel="icon" type="image/webp" href="assets/images/library-logo.webp" />

    <link rel="stylesheet" href="assets/css/fonts.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <link rel="stylesheet" href="assets/css/style/variable.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/base.css?v=1.2" />
    <link rel="stylesheet" href="assets/css/navbar.css?v=2.3" />
    <link rel="stylesheet" href="assets/css/style/modal.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/footer.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/responsive.css?v=3.1" />
    
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <style>
      .service-header {
        background: linear-gradient(to bottom, rgba(30, 58, 138, 0.95) 0%, rgba(59, 130, 246, 0.2) 100%),
                    url('assets/images/services-photo/printed.jpg');
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
      
      .pricelist-wrapper {
        padding: 50px 0;
        max-width: 1000px;
        margin: 0 auto;
      }
      .section-title {
        text-align: center;
        font-size: 1.8rem;
        color: #64748b;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 50px;
        letter-spacing: 1px;
      }
      .section-title::after {
        content: '';
        display: block;
        width: 60px;
        height: 3px;
        background: #64748b;
        margin: 15px auto 0;
      }
      
      .price-sections {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 40px;
      }
      
      .price-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 35px 35px 30px;
        box-shadow: 0 12px 35px rgba(15, 23, 42, 0.04);
        border: 1px solid #f1f5f9;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
      }
      
      .price-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
      }
      
      .card-header-title {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f8fafc;
      }
      .card-header-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
      }
      .icon-dark { background: #f1f5f9; color: #1e293b; }
      .icon-blue { background: #eff6ff; color: #3b82f6; }
      .card-header-text h3 {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        font-family: 'Poppins', sans-serif;
      }
      .card-header-text p {
        font-size: 0.82rem;
        color: #64748b;
        margin: 3px 0 0;
      }
      
      .price-list {
        list-style: none;
        padding: 0;
        margin-top: 10px;
      }
      .price-list li {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 0;
        border-bottom: 1px solid #f1f5f9; /* solid soft line instead of stiff dashed line */
        font-size: 0.95rem;
        color: #475569;
      }
      .price-list li:last-child { border-bottom: none; }
      .price-list i {
        color: #3b82f6;
        margin-right: 12px;
        width: 16px;
        text-align: center;
      }
      .price-val { font-weight: 700; color: #1e293b; font-size: 1.1rem; }
      .price-val span { font-size: 0.75rem; font-weight: 500; color: #94a3b8; margin-left: 4px; }
      
      .compliance-section {
        display: flex;
        gap: 40px;
        align-items: center;
      }
      .compliance-image {
        flex: 0 0 45%;
        border-radius: 20px;
        overflow: hidden;
        position: relative;
        height: 280px;
        box-shadow: 0 15px 35px rgba(148, 163, 184, 0.1);
      }
      .compliance-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
      .compliance-overlay {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        padding: 40px 20px 20px;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        color: white;
      }
      .compliance-overlay h3 { margin: 0 0 5px 0; font-size: 1.3rem; font-weight: 700; }
      .compliance-overlay p { margin: 0; font-size: 0.9rem; opacity: 0.9; }
      
      .compliance-text { flex: 1; }
      .compliance-text h2 {
        font-size: 1.5rem;
        color: #1e293b;
        margin-bottom: 15px;
        font-weight: 700;
        font-family: 'Poppins', sans-serif;
      }
      .compliance-text p {
        font-size: 0.95rem;
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 25px;
      }
      .compliance-badges { display: flex; gap: 20px; }
      .compliance-badge {
        font-size: 0.8rem;
        font-weight: 700;
        color: #3b82f6;
        background: #eff6ff;
        padding: 8px 16px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
        border: 1px solid #dbeafe;
      }
      .compliance-badge i { font-size: 1.1rem; }
      
      @media (max-width: 768px) {
        .price-sections { grid-template-columns: 1fr; }
        .compliance-section { flex-direction: column; }
        .compliance-image { height: 200px; width: 100%; }
      }
    </style>
  </head>
  <body>
    <?php include 'navbar.php'; ?>
    
    <header class="service-header">
      <div class="container">
        <h1>Printing & Scanning Facilities</h1>
        <p>Self-service printing, copying, and scanning available at the Library IT Corner.</p>
      </div>
    </header>
    
    <section class="service-content">
      <div class="container">
        <div class="pricelist-wrapper">
          <h2 class="section-title">PRICELIST AT JIU LIBRARY</h2>
          
          <div class="price-sections">
            <!-- Using Library Paper -->
            <div class="price-card">
              <div class="card-header-title">
                <div class="card-header-icon icon-dark"><i class="fas fa-print"></i></div>
                <div class="card-header-text">
                  <h3>Using library paper</h3>
                  <p>Paper provided by JIU Library</p>
                </div>
              </div>
              <ul class="price-list">
                <li>
                  <div><i class="far fa-file-alt"></i> Print/Photo Copy (one side)</div>
                  <div class="price-val">Rp300<span>/paper</span></div>
                </li>
                <li>
                  <div><i class="fas fa-file-import"></i> Print/Photo Copy (both sides)</div>
                  <div class="price-val">Rp500<span>/paper</span></div>
                </li>
                <li>
                  <div><i class="far fa-plus-square"></i> Buy blank paper</div>
                  <div class="price-val">Rp100<span>/paper</span></div>
                </li>
              </ul>
            </div>
            
            <!-- If you bring your paper -->
            <div class="price-card">
              <div class="card-header-title">
                <div class="card-header-icon icon-blue"><i class="far fa-file-alt"></i></div>
                <div class="card-header-text">
                  <h3>If you bring your paper</h3>
                  <p>Using personal blank paper</p>
                </div>
              </div>
              <ul class="price-list">
                <li>
                  <div><i class="far fa-file-alt"></i> Print/Photo Copy (one side)</div>
                  <div class="price-val">Rp200<span>/paper</span></div>
                </li>
                <li>
                  <div><i class="fas fa-file-import"></i> Print/Photo Copy (both sides)</div>
                  <div class="price-val">Rp400<span>/paper</span></div>
                </li>
                <li>
                  <div><i class="far fa-plus-square"></i> Buy blank paper</div>
                  <div class="price-val">Rp100<span>/paper</span></div>
                </li>
              </ul>
            </div>
          </div>
          


          <!-- Facility Section -->
          <div class="compliance-section">
            <div class="compliance-image">
              <img src="assets/images/services-photo/printed.jpg" alt="Library Facilities" />
              <div class="compliance-overlay">
                <h3>Print & Scan Station</h3>
                <p>Ready to help with your documents.</p>
              </div>
            </div>
            <div class="compliance-text">
              <h2>Self-Service Facilities</h2>
              <p>We provide easy-to-use printers and scanners for all your academic needs. Whether you need to print an assignment or copy a page from a library book, our IT Corner is always ready to assist you.</p>
            
            </div>
          </div>

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
