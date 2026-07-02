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
    <link rel="stylesheet" href="assets/css/navbar.css?v=2.3" />
    <link rel="stylesheet" href="assets/css/style/modal.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/footer.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/responsive.css?v=3.0" />
    
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <style>
      .service-header {
        background: linear-gradient(to bottom, rgba(30, 58, 138, 0.95) 0%, rgba(59, 130, 246, 0.2) 100%),
                    url('assets/images/picture1.webp'); /* Fallback image */
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
      
      .service-content { padding: 60px 0; background-color: #f8fafc; min-height: 50vh; }
      
      .hours-wrapper {
        max-width: 700px;
        margin: 0 auto;
      }
      
      .hours-card {
        background: white;
        border-radius: 12px;
        padding: 40px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        border: 1px solid #e2e8f0;
      }
      
      .schedule-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
      }
      
      .day-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 20px;
        border-bottom: 1px dashed #cbd5e1;
      }
      
      .day-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
      }
      
      .day-name {
        font-weight: 700;
        color: #1e293b;
        font-size: 1.1rem;
      }
      
      .day-time {
        text-align: right;
        color: #475569;
        font-weight: 500;
        line-height: 1.5;
      }
      
      .mod-hour-break {
        color: #94a3b8;
        background: #f1f5f9;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 0.8rem;
      }
      
      .closed .day-name { color: #94a3b8; }
      .closed .day-time { color: #ef4444; font-weight: 700; }
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
        <div class="hours-card">
          <div class="schedule-list">
            <?php foreach ($hours_list as $h): ?>
              <div class="day-row <?php echo $h['is_closed'] ? 'closed' : ''; ?>">
                <span class="day-name">
                  <span class="lang-en" style="display:none;"><?php echo htmlspecialchars($h['day_name_en']); ?></span>
                  <span class="lang-id" style="display:none;"><?php echo htmlspecialchars($h['day_name_id']); ?></span>
                </span>
                <span class="day-time">
                  <?php 
                    if ($h['is_closed']) {
                        echo "Closed";
                    } else {
                        $shifts = [];
                        if (!empty(trim($h['time_pagi']))) $shifts[] = htmlspecialchars(trim($h['time_pagi']));
                        if (!empty(trim($h['time_siang']))) $shifts[] = htmlspecialchars(trim($h['time_siang']));
                        if (!empty(trim($h['time_malam']))) $shifts[] = htmlspecialchars(trim($h['time_malam']));
                        
                        echo implode(' <br> <small class="mod-hour-break">Break</small> <br> ', $shifts);
                    }
                  ?>
                </span>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </section>
    
    <?php include 'footer.php'; ?>
    
    <script src="assets/js/dictionary.js"></script>
    <script src="assets/js/navbar.js"></script>
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
