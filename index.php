<?php
session_start();

require 'koneksi.php';

$query_pengumuman = mysqli_query($koneksi, "SELECT * FROM pengumuman ORDER BY id DESC LIMIT 5");
$query_berita = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY id DESC LIMIT 5");

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dream Blue Library - JIU</title>
  <link rel="icon" type="image/png" href="assets/images/library-logo.png" />

  <link rel="stylesheet" href="assets/css/style/swiper-bundle.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

  <link rel="stylesheet" href="assets/css/style/variable.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" href="assets/css/base.css?v=<?php echo time(); ?>" />

  <link rel="stylesheet" href="assets/css/navbar.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" href="assets/css/style/modal.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" href="assets/css/hero.css?v=<?php echo time(); ?>" />

  <link rel="stylesheet" href="assets/css/style/announcements-slider.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" href="assets/css/style/news-slider.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" href="assets/css/sections.css?v=<?php echo time(); ?>" />

  <link rel="stylesheet" href="assets/css/footer.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" href="assets/css/responsive.css?v=<?php echo time(); ?>" />

</head>

<body>

  <?php include 'assets/css/style/background-grafis.php'; ?>

  <header class="site-header">
    <div class="top-bar">
      <div class="top-bar-left">
        <a href="https://drive.google.com/drive/folders/1MHFJwTNO02nxGyUWP_8EJuEr5PfJuPGN" data-i18n="topGuide">Guidelines</a>
      </div>

      <div class="top-bar-right">
        <div class="dropdown">
          <button class="btn-lang-top" onclick="toggleDropdown(event, 'langMenu')">
            <img src="https://flagcdn.com/w20/us.png" alt="EN" class="real-flag-icon current-flag-img">
            <span class="current-lang-text">EN</span>
            <i class="fas fa-chevron-down" style="font-size: 0.6rem; margin-left: 2px;"></i>
          </button>

          <div class="dropdown-content compact-dropdown" id="langMenu" style="min-width: 140px; right: 0; left: auto; transform: translateY(10px);">
            <div class="services-grid" style="grid-template-columns: 1fr; gap: 0.2rem;">
              <a href="javascript:void(0)" class="service-item lang-option" onclick="changeLanguage('en', event)">
                <img src="https://flagcdn.com/w20/us.png" alt="English" class="real-flag-icon">
                <span class="lang-name">English</span>
              </a>
              <a href="javascript:void(0)" class="service-item lang-option" onclick="changeLanguage('id', event)">
                <img src="https://flagcdn.com/w20/id.png" alt="Indonesia" class="real-flag-icon">
                <span class="lang-name">Indonesia</span>
              </a>
            </div>
          </div>
        </div>

        <?php if (isset($_SESSION['user_status']) && $_SESSION['user_status'] == "login"): ?>
          <div class="dropdown">
            <button class="btn-login-top" onclick="toggleDropdown(event, 'userMenu')" style="background-color: #facc15; color: #0f172a; border: none;">
              <i class="fas fa-user-check"></i> <span data-i18n="<?= ($_SESSION['user_role'] == 'JIU Member') ? 'btnMember' : 'btnGuest'; ?>"><?php echo ($_SESSION['user_role'] == 'JIU Member') ? 'Member' : 'Guest'; ?></span>
              <i class="fas fa-chevron-down" style="font-size: 0.6rem; margin-left: 3px"></i>
            </button>
            <div class="dropdown-content compact-dropdown" id="userMenu" style="min-width: 120px; right: 0; left: auto; transform: translateY(10px);">
              <div class="simple-vertical-menu">
                <a href="assets/auth/logout.php" class="service-item" style="color: #ef4444; font-weight: 600; text-align: center;" data-i18n="btnLogout">
                  <i class="fas fa-sign-out-alt"></i> Logout
                </a>
              </div>
            </div>
          </div>
        <?php else: ?>
          <button class="btn-login-top" onclick="window.location.href = 'assets/auth/login.php'" data-i18n="btnLogin">
            <i class="far fa-user"></i> Login
          </button>
        <?php endif; ?>
      </div>
    </div>

    <nav class="main-nav">
      <div class="nav-logo">
        <a href="index.php" class="logo">
          <img src="assets/images/library-logo.png" alt="JIU Library Logo" />
          <div class="logo-text">
            Dream Blue Library
            <span>NPP 3216202D0000001</span>
          </div>
        </a>
      </div>

      <div class="nav-menu-center" id="nav-links">
        <ul class="nav-links-list">
          <li><a href="index.php" data-i18n="navHome">Home</a></li>

          <li>
            <div class="dropdown">
              <button class="dropbtn" onclick="toggleDropdown(event, 'collectionMenu')">
                <span data-i18n="navCollection">Collection</span> <i class="fas fa-chevron-down" style="font-size: 0.7rem; margin-left: 5px"></i>
              </button>
              <div class="dropdown-content auto-width-dropdown" id="collectionMenu">
                <div class="simple-vertical-menu">
                  <a href="http://lib.jiu.ac/" class="service-item" data-i18n="colOpac">OPAC (Catalog)</a>
                  <a href="https://uijakarta.perpustakaan.co.id/home.ks" class="service-item" data-i18n="colDigital">Digital Library</a>

                  <?php if (isset($_SESSION['user_status']) && $_SESSION['user_status'] == "login"): ?>
                    <a href="https://drive.google.com/drive/folders/1KMCkxdgPSOMMBdWr_BnM8475t3VP6OG4" class="service-item" data-i18n="colJournal">Journal Reference</a>
                    <a href="https://drive.google.com/drive/folders/1Mgq_euWpGEavBQ5dxE6cH8CKX74NfV61" class="service-item" data-i18n="colRepo">Repository</a>
                    <a href="https://docs.google.com/spreadsheets/d/1PppbqbFnpDUUjIkUJUPPEaHwfisXSx-4Ei3fe4j8IUk/edit?gid=427307104#gid=427307104" class="service-item" data-i18n="colDvd">DVD's Collection</a>
                  <?php else: ?>
                    <a href="assets/auth/login.php?redirect=https://drive.google.com/drive/folders/1KMCkxdgPSOMMBdWr_BnM8475t3VP6OG4" class="service-item" data-i18n="colJournal">Journal Reference</a>
                    <a href="assets/auth/login.php?redirect=https://drive.google.com/drive/folders/1Mgq_euWpGEavBQ5dxE6cH8CKX74NfV61" class="service-item" data-i18n="colRepo">Repository</a>
                    <a href="assets/auth/login.php?redirect=https://docs.google.com/spreadsheets/d/1PppbqbFnpDUUjIkUJUPPEaHwfisXSx-4Ei3fe4j8IUk/edit?gid=427307104#gid=427307104" class="service-item" data-i18n="colDvd">DVD's Collection</a>
                  <?php endif; ?>

                  <a href="healingcorner.html" class="service-item" data-i18n="colHealing">Healing Corner</a>
                </div>
              </div>
            </div>
          </li>

          <li>
            <div class="dropdown">
              <button class="dropbtn" onclick="toggleDropdown(event, 'servicesMenu')">
                <span data-i18n="navServices">Services</span> <i class="fas fa-chevron-down" style="font-size: 0.7rem; margin-left: 5px"></i>
              </button>

              <div class="dropdown-content auto-width-dropdown" id="servicesMenu">
                <div class="simple-vertical-menu">
                  <div class="nested-dropdown">
                    <div class="service-item nested-trigger" style="cursor: default;">
                      <span data-i18n="srvType">Type of Services</span>
                      <i class="fas fa-chevron-right" style="font-size: 0.7rem; color: #94a3b8;"></i>
                    </div>

                    <div class="nested-content">
                      <div class="service-item-complex">
                        <i class="fas fa-laptop-code" style="color: #3b82f6;"></i>
                        <div>
                          <strong data-i18n="srvDigital">Digital Collection</strong>
                          <span data-i18n="srvDigitalDesc">Online access to e-books and digital resources</span>
                        </div>
                      </div>
                      <div class="service-item-complex">
                        <i class="fas fa-leaf" style="color: #10b981;"></i>
                        <div>
                          <strong data-i18n="srvHealing">Healing Corner</strong>
                          <span data-i18n="srvHealingDesc">A fun space to relax and refresh your mind</span>
                        </div>
                      </div>
                      <div class="service-item-complex">
                        <i class="fas fa-book-reader" style="color: #6366f1;"></i>
                        <div>
                          <strong data-i18n="srvCirculation">Circulation</strong>
                          <span data-i18n="srvCirculationDesc">Borrow, renew, and return physical library materials</span>
                        </div>
                      </div>
                      <div class="service-item-complex">
                        <i class="fas fa-user-tie" style="color: #f59e0b;"></i>
                        <div>
                          <strong data-i18n="srvConsultation">Consultation</strong>
                          <span data-i18n="srvConsultationDesc">Get expert research assistance from librarians</span>
                        </div>
                      </div>
                      <div class="service-item-complex">
                        <i class="fas fa-check-double" style="color: #ef4444;"></i>
                        <div>
                          <strong data-i18n="srvTurnitin">Turnitin</strong>
                          <span data-i18n="srvTurnitinDesc">Check your work for originality and prevent plagiarism</span>
                        </div>
                      </div>
                      <div class="service-item-complex">
                        <i class="fas fa-print" style="color: #8b5cf6;"></i>
                        <div>
                          <strong data-i18n="srvPrinter">Printer and Scan</strong>
                          <span data-i18n="srvPrinterDesc">Self-service printing, scanning, and copying facilities</span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="dropdown-divider" style="height: 1px; background: #f1f5f9; margin: 5px 15px;"></div>

                  <a href="fqa.html" class="service-item">
                    <span data-i18n="srvFAQ">F&Q</span>
                  </a>
                </div>
              </div>
            </div>
          </li>

          <li>
            <div class="dropdown">
              <button class="dropbtn" onclick="toggleDropdown(event, 'submitMenu')">
                <span data-i18n="navSubmit">Submit</span> <i class="fas fa-chevron-down" style="font-size: 0.7rem; margin-left: 5px"></i>
              </button>
              <div class="dropdown-content auto-width-dropdown" id="submitMenu">
                <div class="simple-vertical-menu">
                  <?php if (isset($_SESSION['user_status']) && $_SESSION['user_status'] == "login"): ?>
                    <a href="https://docs.google.com/forms/d/e/1FAIpQLSfJFjBYd-pllbZrjgzn0vXJFtExG2-81rLLD3DeQNhsHVClpg/viewform" class="service-item" data-i18n="subPaper">Research Paper</a>
                    <a href="https://docs.google.com/forms/d/e/1FAIpQLSc6kRDwAQKxRkBXAt46LdfnuP7wGgRev7D98ihGuQmfABqCzQ/viewform" class="service-item" data-i18n="subThesis">Thesis</a>
                    <a href="https://docs.google.com/forms/d/e/1FAIpQLSdaSY-IB9yl2RKJQUWiILFvLW6E7ra-KhgMzHYtk0u5NUmkUw/viewform" class="service-item" data-i18n="subProject">Final Project</a>
                    <a href="https://docs.google.com/forms/d/e/1FAIpQLSdjSby1jCVrFU_Zr6uqetOG4GdTKeGpKG5Ux5KCR8DckSMrTg/viewform" class="service-item" data-i18n="subIntern">Internship Report</a>
                  <?php else: ?>
                    <a href="assets/auth/login.php?redirect=https://docs.google.com/forms/d/e/1FAIpQLSfJFjBYd-pllbZrjgzn0vXJFtExG2-81rLLD3DeQNhsHVClpg/viewform" class="service-item" data-i18n="subPaper">Research Paper</a>
                    <a href="assets/auth/login.php?redirect=https://docs.google.com/forms/d/e/1FAIpQLSc6kRDwAQKxRkBXAt46LdfnuP7wGgRev7D98ihGuQmfABqCzQ/viewform" class="service-item" data-i18n="subThesis">Thesis</a>
                    <a href="assets/auth/login.php?redirect=https://docs.google.com/forms/d/e/1FAIpQLSdaSY-IB9yl2RKJQUWiILFvLW6E7ra-KhgMzHYtk0u5NUmkUw/viewform" class="service-item" data-i18n="subProject">Final Project</a>
                    <a href="assets/auth/login.php?redirect=https://docs.google.com/forms/d/e/1FAIpQLSdjSby1jCVrFU_Zr6uqetOG4GdTKeGpKG5Ux5KCR8DckSMrTg/viewform" class="service-item" data-i18n="subIntern">Internship Report</a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </li>

          <li>
            <div class="dropdown">
              <button class="dropbtn" onclick="toggleDropdown(event, 'aboutMenu')">
                <span data-i18n="navAbout">About Us</span> <i class="fas fa-chevron-down" style="font-size: 0.7rem; margin-left: 5px"></i>
              </button>
              <div class="dropdown-content auto-width-dropdown" id="aboutMenu">
                <div class="simple-vertical-menu">
                  <a href="about.html" class="service-item" data-i18n="abtHistory">Brief History</a>
                  <a href="vision-mision.html" class="service-item" data-i18n="abtVision">Vision & Mission</a>
                  <a href="organizational-structure.html" class="service-item" data-i18n="abtStructure">Library Staff</a>
                  <a href="library-map.html" class="service-item" data-i18n="abtMap">Library Map</a>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>

      <div class="nav-actions-right">
        <div class="search-wrapper" id="searchWrapper">
          <input type="text"
            id="navSearchInput"
            placeholder="Search menu..."
            onkeyup="liveSearchHomeNav()">
          <button class="btn-search-icon-only" onclick="toggleNavSearch()">
            <i class="fas fa-search"></i>
          </button>
          <div id="navSearchSuggestions" class="nav-search-results"></div>
        </div>

        <div id="mobile-menu" class="menu-toggle" style="display: none">
          <i class="fas fa-bars"></i>
        </div>
      </div>
    </nav>
  </header>

  <section id="hero-modern" class="hero-full-bg">
    <div class="hero-slider-bg">
      <div class="slide-bg active" style="background-image: url('assets/images/image.png'); background-size: 100% auto; background-position: center 45%;"></div>
      <div class="slide-bg" style="background-image: url('assets/images/picture1.jpg')"></div>
      <div class="slide-bg" style="background-image: url('assets/images/picture2.jpg')"></div>
    </div>

    <div class="hero-overlay"></div>

    <div class="hero-content" style="position: absolute; top: 45%; left: 50%; transform: translate(-50%, -50%); width: 100%; text-align: center; z-index: 10;">
      <h1 data-aos="fade-up" style="text-align: center; width: 100%;">Dream Blue <span class="highlight-text-yellow">Library</span></h1>
      <p data-aos="fade-up" data-aos-delay="100" style="text-align: center; width: 100%;" data-i18n="heroTagline">Literacy Freely, Legacy Fully</p>
    </div>

    <div class="hero-bottom-cards" data-aos="fade-up" data-aos-delay="300">
      <div class="h-card" onclick="openModal('modalHours')">
        <i class="fas fa-clock"></i>
        <div class="h-card-text">
          <h4 data-i18n="hcHours">Opening Hours</h4>
        </div>
      </div>

      <div class="h-card" onclick="openModal('modalCollection')">
        <i class="fas fa-book-open"></i>
        <div class="h-card-text">
          <h4 data-i18n="hcTotal">Total Collection</h4>
        </div>
      </div>

      <div class="h-card" onclick="openModal('modalRooms')">
        <i class="fas fa-chalkboard-teacher"></i>
        <div class="h-card-text">
          <h4 data-i18n="hcRooms">Study Rooms</h4>
        </div>
      </div>
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
                <small data-i18n="modRmFac2">Facilities: AC, WiFi</small>
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
                <small data-i18n="modRmFac2">Facilities: AC, WiFi</small>
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
        <path fill="#ffffff" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,261.3C960,256,1056,224,1152,197.3C1248,171,1344,149,1392,138.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
      </svg>
    </div>
  </section>

  <section id="announcements" class="announcement-section">
    <div class="ann-container">
      <div class="ann-header-flex">
        <div class="ann-header-left">
          <h2 class="section-title" style="text-align: left;">
            <span data-i18n="annTitlePrefix">Library</span> <span class="highlight-text-yellow" data-i18n="annTitleSuffix">Announcements</span>
          </h2>
        </div>
        <div class="ann-header-right">
          <a href="all-announcements.php" class="btn-view-ann" data-i18n="annBtnViewAll">
            View All Announcements <i class="fas fa-arrow-right"></i>
          </a>
        </div>
      </div>

      <div class="swiper swiper-announcements" style="padding-bottom: 50px;">
        <div class="swiper-wrapper">
          <?php
          if (isset($query_pengumuman) && mysqli_num_rows($query_pengumuman) > 0) {
            while ($row = mysqli_fetch_assoc($query_pengumuman)) {
              $isi_pendek = substr(strip_tags($row['isi']), 0, 50) . '...';
              $tgl = date('d M Y', strtotime($row['tanggal']));
          ?>
              <div class="swiper-slide">
                <a href="detail-announcement.php?id=<?= $row['id'] ?>" class="jiu-ann-card">
                  <img src="<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['judul']) ?>" class="jiu-ann-img" />
                  <div class="jiu-ann-content">
                    <?php if (!empty($row['kategori'])) { ?>
                      <span class="jiu-ann-badge"><?= htmlspecialchars($row['kategori']) ?></span>
                    <?php } ?>
                    <h3 class="jiu-ann-title"><?= htmlspecialchars($row['judul']) ?></h3>
                    <div class="jiu-ann-hidden">
                      <div class="jiu-ann-date"><i class="far fa-calendar-alt"></i> <?= $tgl ?></div>
                      <p class="jiu-ann-desc"><?= $isi_pendek ?></p>
                      <div class="jiu-ann-btn" data-i18n="annBtnDetail">View Detail <i class="fas fa-arrow-right"></i></div>
                    </div>
                  </div>
                </a>
              </div>
          <?php
            }
          } else {
            echo "<div style='width: 100%; text-align: center; color: #cbd5e1; padding: 40px;' data-i18n='annEmpty'>No recent announcements at this time.</div>";
          }
          ?>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </section>

  <section id="news" class="bg-blue-section">
    <div class="news-container">
      <div class="news-header-flex">
        <div class="news-header-left">
          <h2 class="section-title" style="color: white; margin-bottom: 0;">
            <span data-i18n="newsTitlePrefix">Library</span> <span class="highlight-text-yellow" style="color: #facc15;" data-i18n="newsTitleSuffix">News & Articles</span>
          </h2>
        </div>
        <div class="news-header-right">
          <a href="all-news.php" class="btn-view-all" style="display: inline-flex; align-items: center; gap: 0.5rem; color: #facc15; border: 2px solid #facc15; padding: 8px 20px; border-radius: 50px; text-decoration: none; font-weight: 600; transition: 0.3s;" data-i18n="newsBtnViewAll">
            View All News <i class="fas fa-arrow-right"></i>
          </a>
        </div>
      </div>

      <div class="swiper swiper-news" style="padding-bottom: 50px; padding-top: 10px;">
        <div class="swiper-wrapper">
          <?php
          if (isset($query_berita) && mysqli_num_rows($query_berita) > 0) {
            while ($row = mysqli_fetch_assoc($query_berita)) {
              $tgl = date('d F Y', strtotime($row['tanggal']));
              $gambar_db = $row['gambar'];
              if (empty($gambar_db) || !file_exists($gambar_db)) {
                $gambar_fix = "https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=600&q=80";
              } else {
                $gambar_fix = $gambar_db;
              }
          ?>
              <div class="swiper-slide">
                <a href="detail-news.php?id=<?= $row['id'] ?>" class="jiu-news-card">
                  <div class="jiu-news-img-box">
                    <img src="<?= $gambar_fix ?>" alt="<?= htmlspecialchars($row['judul']) ?>" />
                  </div>
                  <div class="jiu-news-content">
                    <h3 class="jiu-news-title"><?= htmlspecialchars($row['judul']) ?></h3>
                    <div class="jiu-news-meta">
                      <span><i class="far fa-calendar-alt"></i> <?= $tgl ?></span>
                      <?php if (!empty($row['kategori'])) { ?>
                        <span><i class="fas fa-file-alt"></i> <?= htmlspecialchars($row['kategori']) ?></span>
                      <?php } else { ?>
                        <span><i class="fas fa-newspaper"></i> <span data-i18n="newsLibNews">Library News</span></span>
                      <?php } ?>
                    </div>
                    <div class="jiu-news-btn" data-i18n="newsBtnRead">
                      <i class="fas fa-arrow-circle-right"></i> Read More
                    </div>
                  </div>
                </a>
              </div>
          <?php
            }
          } else {
            echo "<div style='width: 100%; text-align: center; color: white;'><p data-i18n='newsEmpty'>No news published yet.</p></div>";
          }
          ?>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </section>

  <section id="networking" class="networking-section">
    <div class="section-header">
      <h2 class="section-title"><span data-i18n="netTitlePrefix">Our</span> <span class="highlight-text-yellow" data-i18n="netTitleSuffix">Network</span></h2>
    </div>
    <div class="networking-canvas">
      <div class="swiper swiper-network-right">
        <div class="swiper-wrapper">
          <div class="swiper-slide partner-logo"><img src="assets/images/partnership/HGU.png" alt="Partner" /></div>
          <div class="swiper-slide partner-logo"><img src="assets/images/partnership/Digido.png" alt="Partner" /></div>
          <div class="swiper-slide partner-logo"><img src="assets/images/partnership/FKIP.png" alt="Partner" /></div>
          <div class="swiper-slide partner-logo"><img src="assets/images/partnership/FPPTI.png" alt="Partner" /></div>
          <div class="swiper-slide partner-logo"><img src="assets/images/partnership/Grammedia.png" alt="Partner" /></div>
          <div class="swiper-slide partner-logo"><img src="assets/images/partnership/USK.png" alt="Partner" /></div>
          <div class="swiper-slide partner-logo"><img src="assets/images/partnership/ITSB.png" alt="Partner" /></div>
          <div class="swiper-slide partner-logo"><img src="assets/images/partnership/UBP.png" alt="Partner" /></div>
          <div class="swiper-slide partner-logo"><img src="assets/images/partnership/UINSSC.png" alt="Partner" /></div>
        </div>
      </div>
    </div>
  </section>

  <footer class="main-footer">
    <div class="footer-container">
      <div class="footer-col" data-aos="fade-up">
        <h3 class="footer-logo">Dream Blue <span>Library</span></h3>
        <p class="footer-subtitle" data-i18n="ftrSubtitle">Digital Library JIU</p>
        <div class="footer-qr-inline">
          <div class="qr-mini-card">
            <img src="assets/images/qr-idream.png" alt="QR iDream JIU">
            <a href="https://uijakarta.perpustakaan.co.id" target="_blank" class="qr-mini-overlay">
              <i class="fas fa-external-link-alt"></i>
            </a>
          </div>
          <div class="qr-mini-info">
            <strong>iDream Library</strong>
            <span data-i18n="ftrScanQR">Scan & Access Digital</span>
          </div>
        </div>
        <p class="footer-desc" data-i18n="ftrDesc">Integrated digital library to support research and learning at JIU.</p>
      </div>

      <div class="footer-col" data-aos="fade-up" data-aos-delay="100">
        <h4 data-i18n="ftrQuickLinks">Quick Links</h4>
        <ul>
          <li><a href="http://lib.jiu.ac/" data-i18n="ftrCatalog">(OPAC)</a></li>
          <li><a href="fqa.html" data-i18n="ftrFAQ">FAQ</a></li>
        </ul>
      </div>

      <div class="footer-col" data-aos="fade-up" data-aos-delay="200">
        <h4 data-i18n="ftrExternalLinks">External Links</h4>
        <ul>
          <li><a href="https://jiu.ac/" data-i18n="ftrMainCampus">JIU Website</a></li>
          <li><a href="https://uijakarta.perpustakaan.co.id/home.ks" data-i18n="ftrELearning">Digital Library</a></li>
        </ul>
      </div>

      <div class="footer-col" data-aos="fade-up" data-aos-delay="300">
        <h4 data-i18n="ftrContact">Contact Us</h4>
        <ul class="contact-info">
          <li><i class="fas fa-map-marker-alt"></i><span data-i18n="ftrAddress">Jl. Ganesha 2, Lot B1, Deltamas, Pasirranji, Central Cikarang, Bekasi Regency, West Java 17530</span></li>
          <li><i class="fas fa-phone-alt"></i> <span>(021) 22157254</span></li>
          <li><i class="fas fa-envelope"></i> <span>library@jiu.ac</span></li>
        </ul>
        <div class="social-links">
          <a href="https://www.instagram.com/jiulibrary" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; 2026 Dream Blue Library, JIU. <span data-i18n="ftrCopyright">All rights reserved.</span></p>
      <div class="legal-links">
        <a href="admin/login.php" class="secret-admin-link"><i class="fas fa-user-shield"></i> Staff Login</a>
      </div>
    </div>
  </footer>

  <div class="floating-actions">
    <button id="backToTopBtn" onclick="scrollToTop()" title="Go to top"><i class="fas fa-arrow-up"></i></button>
    <a href="https://wa.me/6281260173697" target="_blank" class="whatsapp-btn" title="Chat with Librarian"><i class="fab fa-whatsapp"></i></a>
  </div>

  <script src="assets/js/style/swiper-bundle.min.js?v=<?php echo time(); ?>"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js?v=<?php echo time(); ?>"></script>
  <script src="assets/js/dictionary.js?v=<?php echo time(); ?>"></script>
  <script src="assets/js/news.js?v=<?php echo time(); ?>"></script>
  <script src="assets/js/announcements.js?v=<?php echo time(); ?>"></script>
  <script src="assets/js/search.js?v=<?php echo time(); ?>"></script>
  <script src="assets/js/main.js?v=<?php echo time(); ?>"></script>
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
</body>

</html>