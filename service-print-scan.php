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
    <link rel="stylesheet" href="assets/css/responsive.css?v=3.0" />
    
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
        background: white;
        border-radius: 12px;
        padding: 40px 30px 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        border: 1px solid #e2e8f0;
        position: relative;
      }
      
      .pill-title {
        position: absolute;
        top: 25px;
        left: 30px;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
      }
      .pill-dark { background: #1e293b; color: white; }
      .pill-light { background: #93c5fd; color: white; }
      
      .price-list {
        list-style: none;
        padding: 0;
        margin-top: 30px;
      }
      .price-list li {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px 0;
        border-bottom: 1px dashed #cbd5e1;
        font-size: 0.95rem;
        color: #475569;
      }
      .price-list li:last-child { border-bottom: none; }
      .price-list i {
        color: #3b82f6;
        margin-right: 12px;
        width: 15px;
        text-align: center;
      }
      .price-val { font-weight: 700; color: #1e293b; font-size: 1.1rem; }
      .price-val span { font-size: 0.7rem; font-weight: 500; color: #94a3b8; margin-left: 2px; }
      
      .rules-card {
        background: #f8fafc;
        border-radius: 12px;
        padding: 50px 30px 30px;
        border: 1px solid #e2e8f0;
        position: relative;
        display: flex;
        gap: 30px;
        align-items: flex-start;
        margin-bottom: 60px;
      }
      .rules-card .pill-title {
        top: 20px;
        left: -10px;
        background: #1e293b;
        color: white;
      }
      .rules-card::before {
        content: '';
        position: absolute;
        top: 48px;
        left: -10px;
        border-width: 5px;
        border-style: solid;
        border-color: #0f172a #0f172a transparent transparent;
      }
      
      .fee-box {
        background: white;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.02);
        border: 1px solid #e2e8f0;
        flex: 0 0 30%;
      }
      .fee-box .fee-title {
        font-size: 0.8rem;
        font-weight: 700;
        color: #64748b;
        margin-bottom: 10px;
        text-transform: uppercase;
      }
      .fee-box .fee-title i { margin-right: 5px; }
      .fee-box .fee-amount {
        font-size: 1.6rem;
        font-weight: 700;
        color: #1e293b;
      }
      .fee-box .fee-amount span {
        font-size: 0.75rem;
        color: #94a3b8;
        font-weight: 500;
      }
      
      .policy-list {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 15px;
      }
      .policy-item {
        background: #fee2e2;
        border: 1px solid #fca5a5;
        padding: 18px 20px;
        border-radius: 8px;
        display: flex;
        align-items: flex-start;
        gap: 15px;
      }
      .policy-item i { color: #ef4444; margin-top: 3px; font-size: 1.1rem; }
      .policy-content h4 {
        color: #b91c1c;
        font-size: 0.95rem;
        margin: 0 0 5px 0;
        font-weight: 700;
      }
      .policy-content p {
        color: #991b1b;
        font-size: 0.85rem;
        margin: 0;
      }
      
      .compliance-section {
        display: flex;
        gap: 40px;
        align-items: center;
      }
      .compliance-image {
        flex: 0 0 45%;
        border-radius: 16px;
        overflow: hidden;
        position: relative;
        height: 250px;
      }
      .compliance-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
      .compliance-overlay {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        padding: 30px 20px 20px;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        color: white;
      }
      .compliance-overlay h3 { margin: 0 0 5px 0; font-size: 1.2rem; font-weight: 700; }
      .compliance-overlay p { margin: 0; font-size: 0.85rem; opacity: 0.9; }
      
      .compliance-text { flex: 1; }
      .compliance-text h2 {
        font-size: 1.4rem;
        color: #1e3a8a;
        margin-bottom: 15px;
        font-weight: 700;
      }
      .compliance-text p {
        font-size: 0.9rem;
        color: #475569;
        line-height: 1.6;
        margin-bottom: 25px;
      }
      .compliance-badges { display: flex; gap: 20px; }
      .compliance-badge {
        font-size: 0.75rem;
        font-weight: 700;
        color: #475569;
        display: flex;
        align-items: center;
        gap: 8px;
      }
      .compliance-badge i { color: #1e3a8a; font-size: 1.1rem; }

      @media (max-width: 768px) {
        .price-sections { grid-template-columns: 1fr; }
        .rules-card { flex-direction: column; }
        .fee-box { width: 100%; }
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
              <div class="pill-title pill-dark">USING LIBRARY PAPER</div>
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
              <div class="pill-title pill-light">IF YOU BRING YOUR PAPER</div>
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
          
          <!-- Other Fees & Rules -->
          <div class="rules-card">
            <div class="pill-title">OTHER FEES & RULES</div>
            
            <div class="fee-box">
              <div class="fee-title"><i class="far fa-clock"></i> LATE FEE</div>
              <div class="fee-amount">Rp1,000<span>/day/book</span></div>
            </div>
            
            <div class="policy-list">
              <div class="policy-item">
                <i class="fas fa-exclamation-triangle"></i>
                <div class="policy-content">
                  <h4>Book Loss Policy</h4>
                  <p>If you lose the library book, you have to pay 100% of the original price of the book!</p>
                </div>
              </div>
              <div class="policy-item">
                <i class="fas fa-exclamation-circle"></i>
                <div class="policy-content">
                  <h4>Damage Policy</h4>
                  <p>If you damage a library book, you have to repair it and pay if badly damaged!</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Compliance Section -->
          <div class="compliance-section">
            <div class="compliance-image">
              <img src="assets/images/services-photo/printed.jpg" alt="Library Facilities" />
              <div class="compliance-overlay">
                <h3>World-Class Facilities</h3>
                <p>Empowering your academic journey.</p>
              </div>
            </div>
            <div class="compliance-text">
              <h2>Library Compliance & Excellence</h2>
              <p>Our printing and scanning services are maintained to the highest institutional standards, ensuring your documents are rendered with professional precision. By utilizing our facilities, you contribute to the sustainability of our shared resource ecosystem.</p>
              <div class="compliance-badges">
                <div class="compliance-badge"><i class="far fa-check-circle"></i> CERTIFIED PAPER</div>
                <div class="compliance-badge"><i class="fab fa-envira"></i> ECO-EFFICIENT</div>
              </div>
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
