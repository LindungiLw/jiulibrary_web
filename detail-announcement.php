<?php
session_start();
require_once 'config.php';
require 'koneksi.php';
$koneksi = getKoneksi();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $koneksi->prepare("SELECT * FROM pengumuman WHERE id = ?");
$stmt->execute([$id]);
$ann = $stmt->fetch();

$tanggal_cantik = "";
if ($ann) {
  $tanggal_cantik = date('d M Y', strtotime($ann['tanggal']));
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $ann ? $ann['judul'] : 'Not Found' ?> - Dream Blue Library</title>

  <!-- Load FontAwesome Asynchronously (Local) -->
  <link rel="preload" href="assets/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="assets/css/all.min.css"></noscript>
  <link rel="stylesheet" href="assets/css/fonts.css" />
  <link rel="stylesheet" href="assets/css/style/variable.css?v=1.1" />
  <link rel="stylesheet" href="assets/css/base.css?v=1.2" />
  <link rel="stylesheet" href="assets/css/navbar.css?v=2.7" />
  <link rel="stylesheet" href="assets/css/style/modal.css?v=1.1" />
  <link rel="stylesheet" href="assets/css/footer.css?v=1.1" />
  <link rel="stylesheet" href="assets/css/responsive.css?v=3.2" />
  <link rel="icon" type="image/png" href="assets/images/library-logo.webp" />

  <style>
    .detail-container {
      max-width: 1100px;
      margin: 120px auto 50px auto;
      padding: 50px;
      background: #fff;
      border-radius: 24px;
      box-shadow: 0 12px 36px rgba(0, 0, 0, 0.08);
    }

    .back-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: #64748b;
      text-decoration: none;
      font-weight: 500;
      margin-bottom: 30px;
      transition: 0.3s;
    }

    .back-btn:hover {
      color: #1e3a8a;
      transform: translateX(-5px);
    }

    .detail-layout {
      display: flex;
      flex-direction: column;
      gap: 50px;
    }

    @media (min-width: 992px) {
      .detail-layout {
        flex-direction: row;
        align-items: flex-start;
      }
    }

    .detail-image-wrapper {
      flex: 0 0 45%;
      max-width: 480px;
      width: 100%;
      position: sticky;
      top: 100px;
      border-radius: 20px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
      overflow: hidden;
    }

    .detail-image {
      width: 100%;
      height: auto;
      display: block;
      transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .detail-image-wrapper:hover .detail-image {
      transform: scale(1.04);
    }

    .detail-text-wrapper {
      flex: 1;
    }

    .detail-category {
      background: #e0f2fe;
      color: #0369a1;
      padding: 6px 14px;
      border-radius: 6px;
      font-size: 0.85rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      display: inline-block;
      margin-bottom: 20px;
    }

    .detail-title {
      font-family: var(--font-primary, 'Poppins', sans-serif);
      font-size: 2.8rem;
      font-weight: 700;
      color: #0f172a;
      margin-bottom: 15px;
      line-height: 1.25;
      letter-spacing: -0.5px;
    }

    .simple-meta {
      color: #64748b;
      font-size: 0.95rem;
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 30px;
      padding-bottom: 25px;
      border-bottom: 1px solid #f1f5f9;
    }

    .simple-meta i {
      color: #3b82f6;
      font-size: 1.1rem;
    }

    .detail-content {
      font-size: 1.1rem;
      color: #334155;
      line-height: 1.8;
      white-space: pre-wrap;
      text-align: justify;
    }

    /* Reading Progress Bar */
    .progress-container {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: transparent;
      z-index: 9999;
    }
    .progress-bar {
      height: 4px;
      background: linear-gradient(to right, #3b82f6, #0ea5e9);
      width: 0%;
      transition: width 0.1s ease-out;
    }

    .btn-error-back {
      background: #1e3a8a;
      color: white;
      padding: 12px 30px;
      border-radius: 8px;
      text-decoration: none;
      display: inline-block;
      font-weight: 600;
      transition: 0.3s;
    }

    .btn-error-back:hover {
      background: #152c66;
    }

    @media (max-width: 768px) {
      .detail-container {
        padding: 30px 20px;
        margin-top: 100px;
        border-radius: 20px;
      }
      .detail-title {
        font-size: 2.2rem;
      }
      .detail-image-wrapper {
        position: static;
        max-width: 100%;
      }
      .detail-layout {
        gap: 30px;
      }
    }
  </style>
</head>

<body style="background-color: #f8fafc">
  <div class="progress-container">
    <div class="progress-bar" id="readingProgressBar"></div>
  </div>

  <?php include 'navbar.php'; ?>

  <main class="container">
    <div class="detail-container">

      <?php if ($ann):
      ?>

        <a href="index.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Home</a>

        <div class="detail-layout">

          <div class="detail-image-wrapper">
            <img loading="lazy" src="<?= htmlspecialchars($ann['gambar']) ?>" alt="<?= htmlspecialchars($ann['judul']) ?>" class="detail-image">
          </div>

          <div class="detail-text-wrapper">

            <span class="detail-category"><?= htmlspecialchars($ann['kategori']) ?></span>

            <h1 class="detail-title"><?= htmlspecialchars($ann['judul']) ?></h1>

            <div class="simple-meta">
              <i class="far fa-calendar-alt"></i>
              <span>Published on <strong><?= $tanggal_cantik ?></strong></span>
            </div>

            <div class="detail-content"><?= htmlspecialchars($ann['isi']) ?></div>
          </div>

        </div>
      <?php else:
      ?>

        <div style="text-align: center; padding: 40px;">
          <i class="fas fa-exclamation-triangle" style="font-size: 4.5rem; color: #ef4444; margin-bottom: 20px;"></i>
          <h2 style="color: #1e293b; margin-bottom: 10px; font-size: 2.5rem; font-weight:800;">Oops! Announcement Not Found</h2>
          <p style="color: #64748b; margin-bottom: 30px; font-size: 1.1rem;">The announcement you are looking for might have been removed or is temporarily unavailable.</p>
          <a href="index.php" class="btn-error-back">Back to Homepage</a>
        </div>

      <?php endif; ?>

    </div>
  </main>

  <?php include 'footer.php'; ?>

  <!-- BlueBot & A11y Widgets -->
  <?php include 'chatbot-widget.php'; ?>
  <?php include 'a11y-widget.php'; ?>

  <!-- Scripts needed for navbar -->
  <script>
    window.BASE_URL = "<?php echo defined('BASE_URL') ? BASE_URL : ''; ?>";
  </script>
  <script defer src="assets/js/dictionary.js?v=1.4"></script>
  <script defer src="assets/js/main.js?v=2.2"></script>
  <script defer src="assets/js/chatbot.js?v=1.8"></script>

  <script>
    window.addEventListener('scroll', () => {
      const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
      const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
      const progress = (scrollTop / scrollHeight) * 100;
      document.getElementById('readingProgressBar').style.width = progress + '%';
    });
  </script>
</body>

</html>