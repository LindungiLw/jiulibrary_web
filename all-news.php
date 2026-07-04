<?php
session_start();
require_once 'config.php';
require 'koneksi.php';
$koneksi = getKoneksi();

$query_semua_berita = $koneksi->query("SELECT * FROM berita ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All News & Articles - Dream Blue Library</title>
    <link rel="icon" type="image/png" href="assets/images/library-logo.webp" />

    <!-- Preload LCP Header Image for Maximum Speed -->
    <link rel="preload" href="assets/images/header all-news.jpg" as="image">

    <!-- Load FontAwesome Asynchronously (Local) -->
    <link rel="preload" href="assets/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="assets/css/all.min.css"></noscript>

    <link rel="stylesheet" href="assets/css/style/variable.css" />
    <link rel="stylesheet" href="assets/css/base.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="assets/css/navbar.css?v=2.7" />
    <link rel="stylesheet" href="assets/css/style/modal.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="assets/css/style/news-slider.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="assets/css/style/section-page.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="assets/css/footer.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="assets/css/responsive.css?v=3.2" />

</head>

<body>

    <?php include 'navbar.php'; ?>

    <header class="page-header header-news">
        <div class="page-header-container">
            <h1 class="page-title"><span data-i18n="newsTitlePrefix">Library</span> <span style="color: #facc15;" data-i18n="newsTitleSuffix">News & Articles</span></h1>
            <p class="page-subtitle" data-i18n="newsSubtitle">Catch up on the latest updates, events, and resources.</p>
        </div>
    </header>

    <main class="section-page-grid">

        <?php
        if ($query_semua_berita && $query_semua_berita->rowCount() > 0) {
            while ($row = $query_semua_berita->fetch()) {
                $tgl = date('d F Y', strtotime($row['tanggal']));

                $gambar_db = $row['gambar'];
                if (empty($gambar_db) || !file_exists($gambar_db)) {
                    $gambar_fix = "https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=600&q=80";
                } else {
                    $gambar_fix = $gambar_db;
                }
        ?>

                <a href="detail-news.php?id=<?= $row['id'] ?>" class="jiu-news-card">
                    <div class="jiu-news-img-box">
                        <img loading="lazy" src="<?= $gambar_fix ?>" alt="<?= htmlspecialchars($row['judul']) ?>" />
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
                        <div class="jiu-news-btn">
                            <i class="fas fa-arrow-circle-right"></i> <span data-i18n="newsBtnRead">Read More</span>
                        </div>
                    </div>
                </a>

        <?php
            }
        } else {
            echo "
      <div style='text-align: center; grid-column: 1 / -1; padding: 50px;'>
        <i class='fas fa-folder-open' style='font-size: 3rem; color: #cbd5e1; margin-bottom: 15px;'></i>
        <h3 style='color: #64748b;' data-i18n='newsEmpty'>No News Available</h3>
      </div>";
        }
        ?>

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

</body>

</html>