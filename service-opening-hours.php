<?php
session_start();
require_once 'config.php';
require_once 'koneksi.php';

$koneksi = getKoneksi();
$hours_list = [];
try {
    $query = $koneksi->query("SELECT * FROM opening_hours ORDER BY id ASC");
    if ($query) {
        $hours_list = $query->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    // If the table doesn't exist yet, it will fail here. We just catch it so the page doesn't crash with 500 error.
}

// Retrieve language selection from cookie or local storage if possible, usually managed by JS, but we can set default.
// In PHP, we just output the data with data-i18n attributes or render both and let JS handle it.
// The dictionary.js already handles translations if we set data-i18n correctly, but for dynamic DB content, it's a bit tricky.
// We'll output English by default, and use a script to toggle to ID based on currentLang.
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Opening Hours - Dream Blue Library</title>
    
    <link rel="preload" href="assets/fonts/Poppins-Bold.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="assets/fonts/Poppins-Regular.woff2" as="font" type="font/woff2" crossorigin>

    <meta property="og:title" content="Opening Hours - Dream Blue Library" />
    <meta property="og:description" content="View the opening hours for Dream Blue Library." />
    <link rel="icon" type="image/webp" href="assets/images/library-logo.webp" />

    <link rel="stylesheet" href="assets/css/fonts.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <link rel="stylesheet" href="assets/css/style/variable.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/base.css?v=1.2" />
    <link rel="stylesheet" href="assets/css/navbar.css?v=2.5" />
    <link rel="stylesheet" href="assets/css/style/modal.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/footer.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/responsive.css?v=3.2" />
    
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <style>
      .service-header {
        background: linear-gradient(to bottom, rgba(30, 58, 138, 0.95) 0%, rgba(59, 130, 246, 0.2) 100%),
                    url('assets/images/picture1.webp'); /* Fallback image */
        background-size: cover;
        background-position: center;
        color: white;
        padding: 140px 0 120px;
        text-align: center;
        border-bottom-left-radius: 40px;
        border-bottom-right-radius: 40px;
      }
      .service-header h1 { font-size: 2.5rem; margin-bottom: 15px; }
      .service-header p { font-size: 1.1rem; opacity: 0.9; max-width: 600px; margin: 0 auto; }
      
      .service-content { background-color: #ffffff; min-height: 50vh; padding-bottom: 80px; }
      
      .hours-wrapper {
        max-width: 1000px;
        margin: -80px auto 0;
        position: relative;
        z-index: 10;
        padding: 0 20px;
      }
      
      .schedule-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
      }

      .day-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 40px 30px;
        box-shadow: 0 15px 35px rgba(148, 163, 184, 0.08); /* Minimalist gray shadow */
        border: 1px solid rgba(226, 232, 240, 0.8);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
      }
      
      .day-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(148, 163, 184, 0.15);
      }
      
      .day-icon {
        width: 60px;
        height: 60px;
        background: #f1f5f9;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #3b82f6;
        margin-bottom: 20px;
      }
      
      .day-card.closed .day-icon {
        background: #f8fafc;
        color: #94a3b8;
      }
      
      .day-name {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 1.4rem;
        color: #1e293b;
        margin-bottom: 25px;
      }
      
      .day-card.closed .day-name {
        color: #94a3b8;
      }
      
      .shift-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
        width: 100%;
      }
      
      .shift-item {
        background: #f8fafc;
        padding: 12px;
        border-radius: 12px;
        color: #475569;
        font-weight: 600;
        font-size: 0.95rem;
        border: 1px solid #f1f5f9;
      }
      
      .closed-badge {
        background: #f1f5f9;
        color: #64748b;
        font-weight: 700;
        padding: 12px 30px;
        border-radius: 12px;
        font-size: 1rem;
        letter-spacing: 1px;
        text-transform: uppercase;
      }
    </style>
  </head>
  <body>
    <?php include 'navbar.php'; ?>
    
    <header class="service-header">
      <div class="container">
        <h1 data-i18n="srvOpeningHours">Opening Hours</h1>
        <p>Visit us during our regular operating hours to access our facilities, study spaces, and collections.</p>
      </div>
    </header>
    
    <section class="service-content">
      <div class="container hours-wrapper">
        <div class="schedule-grid">
          <?php foreach ($hours_list as $h): ?>
            <div class="day-card <?php echo $h['is_closed'] ? 'closed' : ''; ?>">
              <div class="day-icon">
                <i class="far <?php echo $h['is_closed'] ? 'fa-calendar-times' : 'fa-calendar-check'; ?>"></i>
              </div>
              
              <span class="day-name">
                <span class="lang-en" style="display:none;"><?php echo htmlspecialchars($h['day_name_en']); ?></span>
                <span class="lang-id" style="display:none;"><?php echo htmlspecialchars($h['day_name_id']); ?></span>
              </span>
              
              <?php if ($h['is_closed']): ?>
                <span class="closed-badge">Closed</span>
              <?php else: ?>
                <div class="shift-list">
                  <?php if (!empty(trim((string)$h['time_pagi']))): ?>
                    <div class="shift-item"><?php echo htmlspecialchars(trim((string)$h['time_pagi'])); ?></div>
                  <?php endif; ?>
                  <?php if (!empty(trim((string)$h['time_siang']))): ?>
                    <div class="shift-item"><?php echo htmlspecialchars(trim((string)$h['time_siang'])); ?></div>
                  <?php endif; ?>
                  <?php if (!empty(trim((string)$h['time_malam']))): ?>
                    <div class="shift-item"><?php echo htmlspecialchars(trim((string)$h['time_malam'])); ?></div>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
    
    <?php include 'footer.php'; ?>
    
    <script defer src="assets/js/dictionary.js?v=1.4"></script>
    <script defer src="assets/js/main.js?v=2.2"></script>
    <script>
      // Quick inline script to handle dynamic language switching for DB content
      document.addEventListener("DOMContentLoaded", () => {
          const lang = localStorage.getItem('library_lang') || 'en';
          updateDynamicLang(lang);
      });
      
      // We'll hijack the changeLanguage function slightly to also update our dynamic text
      const originalChangeLanguage = window.changeLanguage;
      window.changeLanguage = function(lang, event) {
          if(originalChangeLanguage) originalChangeLanguage(lang, event);
          updateDynamicLang(lang);
      };
      
      function updateDynamicLang(lang) {
          document.querySelectorAll('.lang-en').forEach(el => el.style.display = lang === 'en' ? 'inline' : 'none');
          document.querySelectorAll('.lang-id').forEach(el => el.style.display = lang === 'id' ? 'inline' : 'none');
      }
    </script>
  </body>
</html>
