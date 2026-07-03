<?php
session_start();
require_once 'config.php';
require 'koneksi.php';
$koneksi = getKoneksi();

$query_semua = $koneksi->query("SELECT * FROM pengumuman ORDER BY id DESC");
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>All Announcements - Dream Blue Library</title>
    <meta name="description" content="Lihat semua pengumuman resmi terbaru dari Dream Blue Library – Jakarta International University." />
    <link rel="icon" type="image/png" href="assets/images/library-logo.webp" />

    <!-- Preload LCP Header Image for Maximum Speed -->
    <link rel="preload" href="assets/images/header all-annoucment.jpg" as="image">

    <!-- Preload Critical Fonts -->
    <link rel="preload" href="assets/fonts/Poppins-Bold.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="assets/fonts/Poppins-Regular.woff2" as="font" type="font/woff2" crossorigin>

    <link rel="stylesheet" href="assets/css/fonts.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <link rel="stylesheet" href="assets/css/style/variable.css" />
    <link rel="stylesheet" href="assets/css/base.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="assets/css/navbar.css?v=2.4" />
    <link rel="stylesheet" href="assets/css/style/modal.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/style/news-slider.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="assets/css/style/section-page.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="assets/css/footer.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="assets/css/responsive.css?v=3.2" />
</head>

<body>

    <?php include 'navbar.php'; ?>

    <header class="page-header header-announcements">
        <div class="page-header-container">
            <h1 class="page-title"><span data-i18n="annTitlePrefix">Library</span> <span style="color: #facc15;" data-i18n="annTitleSuffix">Announcements</span></h1>
            <p class="page-subtitle" data-i18n="annSubtitle">Stay informed with the latest official library updates.</p>
        </div>
    </header>


    <main class="section-page-grid">

        <?php
        if ($query_semua->rowCount() > 0) {
            while ($row = $query_semua->fetch()) {

                $isi_pendek = substr(strip_tags($row['isi']), 0, 50) . '...';
                $tgl = date('d M Y', strtotime($row['tanggal']));

                $gambar_db = $row['gambar'];
                if (empty($gambar_db) || !file_exists($gambar_db)) {
                    $gambar_fix = "https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=600&q=80";
                } else {
                    $gambar_fix = $gambar_db;
                }
        ?>

                <a href="detail-announcement.php?id=<?= $row['id'] ?>" class="jiu-ann-card">
                    <img loading="lazy" src="<?= $gambar_fix ?>" alt="<?= htmlspecialchars($row['judul']) ?>" class="jiu-ann-img" />

                    <div class="jiu-ann-content">
                        <?php if (!empty($row['kategori'])) { ?>
                            <span class="jiu-ann-badge"><?= htmlspecialchars($row['kategori']) ?></span>
                        <?php } ?>

                        <h3 class="jiu-ann-title"><?= htmlspecialchars($row['judul']) ?></h3>

                        <div class="jiu-ann-hidden">
                            <div class="jiu-ann-date"><i class="far fa-calendar-alt"></i> <?= $tgl ?></div>
                            <p class="jiu-ann-desc"><?= $isi_pendek ?></p>
                            <div class="jiu-ann-btn"><span data-i18n="annBtnDetail">View Detail</span> <i class="fas fa-arrow-right"></i></div>
                        </div>
                    </div>
                </a>

        <?php
            }
        } else {
            echo 
            " <div style='grid-column: 1 / -1; text-align: center; padding: 50px; color: #64748b;'>
        <i class='fas fa-box-open' style='font-size: 3rem; margin-bottom: 15px; color:#cbd5e1;'></i>
        <h2 style='color:#475569;' data-i18n='annEmpty'>Belum ada pengumuman</h2>
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
    <script defer src="assets/js/chatbot.js?v=1.8"></script>
</body>

</html>