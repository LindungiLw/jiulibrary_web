<?php
session_start();
require_once 'config.php';
require_once 'koneksi.php';

$koneksi = getKoneksi();

$query_pengumuman = $koneksi->query("SELECT * FROM pengumuman ORDER BY id DESC LIMIT 5");
$query_berita = $koneksi->query("SELECT * FROM berita ORDER BY id DESC LIMIT 5");

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dream Blue Library - Jakarta International University</title>
  <meta name="description" content="Welcome to Dream Blue Library, the official library of Jakarta International University (JIU). Access various information, news, book collections, and e-journals for students and researchers." />
  <meta property="og:title" content="Dream Blue Library - Jakarta International University" />
  <meta property="og:description" content="Welcome to Dream Blue Library, the official library of Jakarta International University (JIU)." />
  <meta property="og:image" content="assets/images/library-logo.webp" />
  <link rel="icon" type="image/webp" href="assets/images/library-logo.webp" />
  
  <!-- Preload Critical Images for LCP Optimization -->
  <link rel="preload" as="image" href="assets/images/image.webp" fetchpriority="high">
  <link rel="preload" as="image" href="assets/images/library-logo.webp" fetchpriority="high">

  <!-- Preload Critical Fonts -->
  <link rel="preload" href="assets/fonts/Poppins-Bold.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="assets/fonts/Poppins-Regular.woff2" as="font" type="font/woff2" crossorigin>
  
  <link rel="stylesheet" href="assets/css/fonts.css" />
  <link rel="stylesheet" href="assets/css/style/swiper-bundle.min.css" />
  
  <!-- Load FontAwesome Asynchronously (Local) -->
  <link rel="preload" href="assets/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="assets/css/all.min.css"></noscript>
  
  <link rel="preload" href="https://unpkg.com/aos@2.3.1/dist/aos.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css"></noscript>

  <link rel="stylesheet" href="assets/css/style/variable.css?v=1.1" />
  <link rel="stylesheet" href="assets/css/base.css?v=1.2" />

  <link rel="stylesheet" href="assets/css/navbar.css?v=2.3" />
  <link rel="stylesheet" href="assets/css/hero.css?v=1.1" />

  <link rel="stylesheet" href="assets/css/sections.css?v=2.5" />
  <link rel="stylesheet" href="assets/css/responsive.css?v=3.0" />

  <!-- Defer Non-Critical CSS for Mobile Speed -->
  <link rel="preload" href="assets/css/style/modal.css?v=1.1" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <link rel="preload" href="assets/css/style/stats-strip.css?v=1.1" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <link rel="preload" href="assets/css/style/announcements-slider.css?v=2.1" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <link rel="preload" href="assets/css/style/news-slider.css?v=2.7" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <link rel="preload" href="assets/css/footer.css?v=1.1" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link rel="stylesheet" href="assets/css/style/modal.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/style/stats-strip.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/style/announcements-slider.css?v=2.1" />
    <link rel="stylesheet" href="assets/css/style/news-slider.css?v=2.7" />
    <link rel="stylesheet" href="assets/css/footer.css?v=1.1" />
  </noscript>
  
  <!-- Script Google Identity Services untuk SSO -->
  <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>

<body>

  <?php include 'assets/css/style/background-grafis.php'; ?>

  <?php include 'navbar.php'; ?>

  <section id="hero-modern" class="hero-full-bg">
    <div class="hero-slider-bg">
      <div class="slide-bg active" style="background-image: url('assets/images/image.webp'); background-size: 100% auto; background-position: center 45%;"></div>
      <div class="slide-bg" style="background-image: url('assets/images/picture1.webp')"></div>
      <div class="slide-bg" style="background-image: url('assets/images/picture2.webp')"></div>
    </div>

    <div class="hero-overlay"></div>

    <div class="hero-content" style="position: absolute; top: 45%; left: 50%; transform: translate(-50%, -50%); width: 100%; text-align: center; z-index: 10;">
      <h1 data-aos="fade-up" style="text-align: center; width: 100%;">Dream Blue <span class="highlight-text-yellow">Library</span></h1>
      <p data-aos="fade-up" data-aos-delay="100" style="text-align: center; width: 100%;" data-i18n="heroTagline">Literacy Freely, Legacy Fully</p>
    </div>



    <div id="modalHours" class="modal-hours">
      <div class="modal-content-hours">
        <span class="close-modal" onclick="closeModal('modalHours')">&times;</span>
        <div class="modal-header">
          <i class="fas fa-clock"></i>
          <h3 data-i18n="modHourTitle">Opening Hours</h3>
        </div>
        <div class="schedule-list">
          <div class="day-row">
            <span class="day-name">Mon - Fri</span>
            <span class="day-time">08:00 - 17:00 <br> <small class="mod-hour-break">Break</small> <br> 18:00 - 21:00</span>
          </div>
          <div class="day-row">
            <span class="day-name">Saturday</span>
            <span class="day-time">08:00 - 17:00</span>
          </div>
          <div class="day-row closed">
            <span class="day-name">Sunday</span>
            <span class="day-time" data-i18n="modHourClosed">Closed</span>
          </div>
        </div>
      </div>
    </div>

    <div id="modalCollection" class="modal-hours">
      <div class="modal-content-hours">
        <span class="close-modal" onclick="closeModal('modalCollection')">&times;</span>
        <div class="modal-header">
          <i class="fas fa-book-open"></i>
          <h3 data-i18n="modColTitle">Library Collections</h3>
        </div>
        <div class="collection-stats">
          <p><span id="modColTitlesText">Total Titles:</span> <strong>5642</strong></p>
          <p><span id="modColCopiesText">Total Copies:</span> <strong>6499</strong></p>
        </div>
      </div>
    </div>

    <div id="modalRooms" class="modal-hours">
      <div class="modal-content-hours">
        <span class="close-modal" onclick="closeModal('modalRooms')">&times;</span>
        <div class="modal-header">
          <i class="fas fa-chalkboard-teacher"></i>
          <h3 data-i18n="modRmTitle">Study Rooms Facilities</h3>
          <p style="font-size: 0.8rem; color: #64748b;" data-i18n="modRmSub">Available for JIU Members</p>
        </div>
        <hr>
        <div class="room-list">
          <div class="room-item">
            <div class="room-flex">
              <i class="fas fa-users room-icon"></i>
              <div class="room-info">
                <h4>Study Room 1</h4>
                <p data-i18n="modRmCap1">Capacity: 4-6 People</p>
                <small data-i18n="modRmFac1">Facilities: AC, WiFi, Whiteboard</small>
                <span class="room-tag" data-i18n="modRmTag">On-Site Only</span>
              </div>
            </div>
          </div>
          <div class="room-item">
            <div class="room-flex">
              <i class="fas fa-users room-icon"></i>
              <div class="room-info">
                <h4>Study Room 2</h4>
                <p data-i18n="modRmCap2">Capacity: 4 People</p>
                <small data-i18n="modRmFac2">Facilities: AC, WiFi, Whiteboard</small>
                <span class="room-tag" data-i18n="modRmTag">On-Site Only</span>
              </div>
            </div>
          </div>
          <div class="room-item">
            <div class="room-flex">
              <i class="fas fa-users room-icon"></i>
              <div class="room-info">
                <h4>Study Room 3</h4>
                <p data-i18n="modRmCap2">Capacity: 4 People</p>
                <small data-i18n="modRmFac2">Facilities: AC, WiFi, Whiteboard</small>
                <span class="room-tag" data-i18n="modRmTag">On-Site Only</span>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer-note">
          <p><i class="fas fa-info-circle"></i> <strong data-i18n="modRmNoteInfo">Information:</strong> <span data-i18n="modRmNoteText">Room usage is based on a "First Come, First Served" system.</span></p>
        </div>
      </div>
    </div>

    

    <div class="hero-curve">
      <svg class="animated-wave" viewBox="0 0 1440 320" preserveAspectRatio="none">
        <path fill="#f8fafc" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,261.3C960,256,1056,224,1152,197.3C1248,171,1344,149,1392,138.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
      </svg>
    </div>
  </section>

  <!-- ═══ STATS STRIP ═══════════════════════════════════════════════ -->
  <section class="stats-strip-section">
    <div class="stats-strip-inner" data-aos="fade-up" data-aos-delay="100">

      <div class="p-stat-card" onclick="openModal('modalCollection')" tabindex="0" role="button">
        <h3 class="p-stat-number counter" data-target="5642">0</h3>
        <p class="p-stat-label" data-i18n="statLabelCollection">TOTAL COLLECTION</p>
        <p class="p-stat-desc" data-i18n="statDescCollection">Total books &amp; media collection</p>
      </div>

      <div class="stats-divider"></div>

      <div class="p-stat-card" tabindex="0" role="region">
        <h3 class="p-stat-number counter" data-target="200">0</h3>
        <p class="p-stat-label" data-i18n="statLabelMembers">ACTIVE MEMBERS</p>
        <p class="p-stat-desc" data-i18n="statDescMembers">Registered and active users</p>
      </div>

      <div class="stats-divider"></div>

      <div class="p-stat-card" onclick="openModal('modalRooms')" tabindex="0" role="button">
        <h3 class="p-stat-number counter" data-target="4">0</h3>
        <p class="p-stat-label" data-i18n="statLabelRooms">STUDY ROOMS</p>
        <p class="p-stat-desc" data-i18n="statDescRooms">Available for booking</p>
      </div>

    </div>
  </section>

  <!-- ═══ VIDEO PRESENTATION SECTION ═══════════════════════════════════════════════ -->
  <section class="video-presentation-section">
    
    <!-- Marquee Banner -->
    <div class="video-marquee-container">
      <div class="video-marquee-content">
        <!-- Track 1 -->
        <div class="marquee-track">
          <span><span data-i18n="mqWelcome">Welcome to Dream Blue Library</span></span><span class="separator">✦</span>
          <span><span data-i18n="mqHeart">The Heart of Knowledge</span></span><span class="separator">✦</span>
          <span><span data-i18n="mqExplore">Explore Our Spaces</span></span><span class="separator">✦</span>
          <span><span data-i18n="mqBorrow">Digital & Physical Borrowing</span></span><span class="separator">✦</span>
          <span><span data-i18n="mqWelcome">Welcome to Dream Blue Library</span></span><span class="separator">✦</span>
          <span><span data-i18n="mqHeart">The Heart of Knowledge</span></span><span class="separator">✦</span>
          <span><span data-i18n="mqExplore">Explore Our Spaces</span></span><span class="separator">✦</span>
          <span><span data-i18n="mqBorrow">Digital & Physical Borrowing</span></span><span class="separator">✦</span>
        </div>
        <!-- Track 2 (Seamless clone) -->
        <div class="marquee-track" aria-hidden="true">
          <span><span data-i18n="mqWelcome">Welcome to Dream Blue Library</span></span><span class="separator">✦</span>
          <span><span data-i18n="mqHeart">The Heart of Knowledge</span></span><span class="separator">✦</span>
          <span><span data-i18n="mqExplore">Explore Our Spaces</span></span><span class="separator">✦</span>
          <span><span data-i18n="mqBorrow">Digital & Physical Borrowing</span></span><span class="separator">✦</span>
          <span><span data-i18n="mqWelcome">Welcome to Dream Blue Library</span></span><span class="separator">✦</span>
          <span><span data-i18n="mqHeart">The Heart of Knowledge</span></span><span class="separator">✦</span>
          <span><span data-i18n="mqExplore">Explore Our Spaces</span></span><span class="separator">✦</span>
          <span><span data-i18n="mqBorrow">Digital & Physical Borrowing</span></span><span class="separator">✦</span>
        </div>
      </div>
    </div>

    <div class="video-presentation-container" data-aos="fade-up">
      <div class="video-content-flex">
        
        <!-- Left Side: Text -->
        <div class="video-text-side">
          <h2 class="video-title-main" style="margin-bottom: 15px;">
            The Heart of<br>Knowledge
          </h2>
          <h3 class="video-title-sub" style="margin-bottom: 25px; color: var(--clr-blue-1, #1e3a8a); font-weight: 500;">
            Dream Blue Library
          </h3>
          <p class="video-description" data-i18n="videoDesc" style="margin-bottom: 30px;">
            Join our virtual tour to explore exciting activities at Dream Blue Library from finding books via OPAC and storing your belongings securely, to unwinding in our gaming area.
          </p>
          <ul class="video-feature-list">
            <li>
              <div class="feat-icon-box bg-soft-blue">
                <span class="text-blue" style="font-family: Georgia, serif; font-weight: bold; font-size: 1.4rem;">K</span>
              </div>
              <span data-i18n="videoFeat1">OPAC</span>
            </li>
            <li>
              <div class="feat-icon-box bg-soft-yellow">
                <i class="fas fa-book-reader text-yellow"></i>
              </div>
              <span data-i18n="videoFeat2">Easy Book Borrowing</span>
            </li>
            <li>
              <div class="feat-icon-box bg-soft-blue-dark">
                <i class="fas fa-layer-group text-blue-dark"></i>
              </div>
              <span data-i18n="videoFeat3">Healing Corner (Card Game, Chess, Puzzle etc)</span>
            </li>
          </ul>
        </div>
        
        <!-- Right Side: Video -->
        <div class="video-player-side">
          <div class="video-frame">
            <div class="youtube-wrapper">
              <!-- YouTube Facade: thumbnail ditampilkan dulu, iframe dimuat saat diklik -->
              <!-- Hemat ~500KB+ resource YouTube saat halaman pertama dibuka di mobile -->
              <div class="yt-facade" id="yt-facade-main"
                   data-videoid="6JL5vO379yM"
                   onclick="loadYouTube(this)"
                   role="button" tabindex="0"
                   aria-label="Play video: The Heart Of Knowledge - Dream Blue Library"
                   onkeydown="if(event.key==='Enter'||event.key===' ') loadYouTube(this)">
                <img src="https://i.ytimg.com/vi/6JL5vO379yM/hqdefault.jpg"
                     alt="The Heart Of Knowledge: Dream Blue Library"
                     loading="lazy" width="480" height="360" />
                <button class="yt-play-btn" aria-hidden="true" tabindex="-1">
                  <svg viewBox="0 0 68 48" width="68" height="48"><path d="M66.5 7.7c-.8-2.9-3-5.2-5.8-6C55.8 0 34 0 34 0S12.2 0 7.3 1.7C4.6 2.5 2.3 4.8 1.5 7.7 0 12.8 0 24 0 24s0 11.2 1.5 16.3c.8 2.9 3 5.2 5.8 6C12.2 48 34 48 34 48s21.8 0 26.7-1.7c2.8-.8 5-3.1 5.8-6C68 35.2 68 24 68 24S68 12.8 66.5 7.7z" fill="#ff0000"/><path d="M45 24L27 14v20" fill="#fff"/></svg>
                </button>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section id="announcements" class="announcement-section">
    <div class="ann-container">

      <!-- Header Flex -->
      <div class="ann-header-flex" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
        <div class="ann-header-left">
          <h2 class="section-title" style="margin: 0 !important; font-family: var(--font-primary, 'Poppins', sans-serif); line-height: 1;">
            <span style="color: var(--clr-blue-1, #1e3a8a);">Library</span> <span style="color: var(--clr-yellow-1, #facc15);">Announcements</span>
          </h2>
        </div>
        <div class="ann-header-right">
          <a href="all-announcements.php" class="btn-view-ann-pill">
            View All Announcements <i class="fas fa-arrow-right"></i>
          </a>
        </div>
      </div>

      <div class="ann-grid">
          <?php
          if (isset($query_pengumuman) && $query_pengumuman->rowCount() > 0) {
            $i = 0;
            while ($row = $query_pengumuman->fetch()) {
              if ($i >= 3) break; // Limit to 3 items
              
              $isi_pendek = substr(strip_tags($row['isi']), 0, 90) . '...';
              $kategori = !empty($row['kategori']) ? htmlspecialchars($row['kategori']) : 'Announcement';
              $delay = 100 + ($i * 100);
          ?>
              <a href="detail-announcement.php?id=<?= $row['id'] ?>" class="jiu-ann-card" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                <div class="jiu-ann-img-wrapper">
                  <div class="jiu-ann-img-inner">
                    <img loading="lazy" src="<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['judul']) ?>" class="jiu-ann-img" />
                  </div>
                  <span class="jiu-ann-category-badge"><?= $kategori ?></span>
                </div>
                <div class="jiu-ann-content">
                  <h3 class="jiu-ann-title"><?= htmlspecialchars($row['judul']) ?></h3>
                  <p class="jiu-ann-desc"><?= $isi_pendek ?></p>
                  
                  <!-- Spacer to push Read More to bottom -->
                  <div style="flex-grow: 1;"></div>
                  
                  <div class="jiu-ann-btn">
                    Read More <i class="fas fa-arrow-right"></i>
                  </div>
                </div>
              </a>
          <?php
              $i++;
            }
          } else {
            echo "<div style='grid-column: 1 / -1; text-align: center; color: #cbd5e1; padding: 40px;' data-i18n='annEmpty'>No recent announcements at this time.</div>";
          }
          ?>
      </div>

    </div>
  </section>

  <section id="news" class="bg-blue-section" style="overflow: hidden;">
    <!-- Abstract Background Graphics -->
    <div class="news-bg-graphics">
      <i class="fas fa-book graphic-icon g-icon-1"></i>
      <span class="graphic-icon g-icon-2" style="font-family: Georgia, serif; font-weight: bold; line-height: 1;">K</span>
      <i class="fas fa-laptop graphic-icon g-icon-3"></i>
      <i class="fas fa-search graphic-icon g-icon-4"></i>
      <i class="fas fa-book-open graphic-icon g-icon-5"></i>
      <i class="fas fa-bookmark graphic-icon g-icon-6"></i>
    </div>

    <div class="news-container">
      <div class="news-header-flex">
        <div class="news-header-left">
          <h2 class="section-title" style="color: white; margin-bottom: 0;">
            <span data-i18n="newsTitlePrefix">Library</span> <span class="highlight-text-yellow" style="color: #facc15;" data-i18n="newsTitleSuffix">News & Articles</span>
          </h2>
        </div>
        <div class="news-header-right">
          <a href="all-news.php" class="btn-view-news-pill" data-i18n="newsBtnViewAll">
            View All News <i class="fas fa-arrow-right"></i>
          </a>
        </div>
      </div>

      <div class="news-bento-grid">
          <?php
          if (isset($query_berita) && $query_berita->rowCount() > 0) {
            $i = 1;
            while ($row = $query_berita->fetch()) {
              if ($i > 4) break; // Limit to 4 items for the bento layout
              
              $tgl = date('d F Y', strtotime($row['tanggal']));
              $gambar_db = $row['gambar'];
              if (empty($gambar_db) || !file_exists($gambar_db)) {
                $gambar_fix = "https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=600&q=80";
              } else {
                $gambar_fix = $gambar_db;
              }
              
              $kategori = !empty($row['kategori']) ? htmlspecialchars($row['kategori']) : 'News';
          ?>
              <a href="detail-news.php?id=<?= $row['id'] ?>" class="jiu-news-card bento-item-<?= $i ?>">
                <div class="jiu-news-img-box">
                  <img loading="lazy" src="<?= $gambar_fix ?>" alt="<?= htmlspecialchars($row['judul']) ?>" />
                </div>
                <div class="jiu-news-content">
                  <h3 class="jiu-news-title"><?= htmlspecialchars($row['judul']) ?></h3>
                  
                  <div class="jiu-news-meta">
                    <span class="meta-date"><i class="far fa-calendar-alt"></i> <?= $tgl ?></span>
                    <span class="meta-category"><i class="far fa-folder"></i> <?= $kategori ?></span>
                  </div>
                  
                  <div class="jiu-news-btn" data-i18n="newsBtnRead">
                    Read More <i class="fas fa-chevron-right"></i>
                  </div>
                </div>
              </a>
          <?php
              $i++;
            }
          } else {
            echo "<div style='grid-column: 1 / -1; text-align: center; color: white;'><p data-i18n='newsEmpty'>No news published yet.</p></div>";
          }
          ?>
      </div>
    </div>
  </section>

  <section id="networking" class="networking-section">
    <div class="section-header">
      <h2 class="section-title"><span data-i18n="netTitlePrefix">Our</span> <span class="highlight-text-yellow" data-i18n="netTitleSuffix">Network</span></h2>
    </div>
    <div class="networking-canvas">

      <!-- ROW 1 — scroll kanan ke kiri (JS will auto-clone for seamless loop) -->
      <div class="marquee-track" aria-hidden="true">
        <div class="marquee-inner marquee-left" id="partner-logos-set">
          <div class="partner-logo"><img loading="lazy" src="assets/images/partnership/HGU.webp" alt="HGU" width="150" height="80" /></div>
          <div class="partner-logo"><img loading="lazy" src="assets/images/partnership/Digido.webp" alt="Digido" width="150" height="80" /></div>
          <div class="partner-logo"><img loading="lazy" src="assets/images/partnership/FKIP.webp" alt="FKIP" width="150" height="80" /></div>
          <div class="partner-logo"><img loading="lazy" src="assets/images/partnership/FPPTI.webp" alt="FPPTI" width="150" height="80" /></div>
          <div class="partner-logo"><img loading="lazy" src="assets/images/partnership/Grammedia.webp" alt="Gramedia" width="150" height="80" /></div>
          <div class="partner-logo"><img loading="lazy" src="assets/images/partnership/USK.webp" alt="USK" width="150" height="80" /></div>
          <div class="partner-logo"><img loading="lazy" src="assets/images/partnership/ITSB.webp" alt="ITSB" width="150" height="80" /></div>
          <div class="partner-logo"><img loading="lazy" src="assets/images/partnership/UBP.webp" alt="UBP" width="150" height="80" /></div>
          <div class="partner-logo"><img loading="lazy" src="assets/images/partnership/UINSSC.webp" alt="UINSSC" width="150" height="80" /></div>
        </div>
      </div>

    </div>
  </section>

  <?php include 'footer.php'; ?>


  <script defer src="assets/js/style/swiper-bundle.min.js?v=1.1"></script>
  <script defer src="https://unpkg.com/aos@2.3.1/dist/aos.js?v=1.1"></script>
  <script>
    window.BASE_URL = "<?php echo defined('BASE_URL') ? BASE_URL : ''; ?>";
  </script>
  <script defer src="assets/js/dictionary.js?v=1.3"></script>
  <script defer src="assets/js/news.js?v=1.1"></script>
  <script defer src="assets/js/announcements.js?v=1.1"></script>
  <script defer src="assets/js/search.js?v=2.1"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var swiperAnnouncements = new Swiper(".swiper-announcements", {
        slidesPerView: 1,
        spaceBetween: 20,
        grabCursor: true,
        autoplay: {
          delay: 4000,
          disableOnInteraction: false,
        },
        pagination: {
          el: ".swiper-announcements .swiper-pagination",
          clickable: true,
          dynamicBullets: true,
        },
        breakpoints: {
          640: {
            slidesPerView: 2,
            spaceBetween: 20
          },
          992: {
            slidesPerView: 3,
            spaceBetween: 30
          },
          1200: {
            slidesPerView: 4,
            spaceBetween: 30
          },
        },
      });

      var swiperNews = new Swiper(".swiper-news", {
        slidesPerView: 1,
        spaceBetween: 20,
        grabCursor: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
        },
        pagination: {
          el: ".swiper-news .swiper-pagination",
          clickable: true,
          dynamicBullets: true,
        },
        breakpoints: {
          640: {
            slidesPerView: 2,
            spaceBetween: 20
          },
          992: {
            slidesPerView: 3,
            spaceBetween: 30
          },
        },
      });
    });
  </script>


  <!-- Accessibility Widget -->
  <?php include 'chatbot-widget.php'; ?>
  <?php include 'a11y-widget.php'; ?>
  <script defer src="assets/js/chatbot.js?v=1.8"></script>
  <script defer src="assets/js/main.js?v=2.1"></script>
</body>

</html>