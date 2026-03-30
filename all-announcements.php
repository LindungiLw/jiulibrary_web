<?php
require 'koneksi.php';

$query_semua = mysqli_query($koneksi, "SELECT * FROM pengumuman ORDER BY id DESC");
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>All Announcements - Dream Blue Library</title>
    <link rel="icon" type="image/png" href="assets/images/library-logo.png" />

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <link rel="stylesheet" href="assets/css/style/variable.css" />
    <link rel="stylesheet" href="assets/css/base.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="assets/css/navbar.css" />
    <link rel="stylesheet" href="assets/css/style/news-slider.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="assets/css/style/section-page.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="assets/css/footer.css?v=<?php echo time(); ?>" />
</head>

<body>

    <header class="site-header glass-nav">
        <nav class="main-nav" style="justify-content: center">
            <div class="nav-logo">
                <a href="index.php" class="logo">
                    <img src="assets/images/library-logo.png" alt="JIU Library Logo" style="width: 40px; height: auto; object-fit: contain;" />
                    <div class="logo-text" style="color: #1e3a8a">Dream Blue Library</div>
                </a>
            </div>
        </nav>
    </header>

    <header class="page-header">
        <div class="page-header-container">
            <a href="index.php" class="btn-back-header">
                <i class="fas fa-arrow-left"></i> Back to Home
            </a>

            <h1 class="page-title">Library <span style="color: #facc15;">News & Articles</span></h1>
            <p class="page-subtitle">Catch up on the latest updates, events, and resources.</p>
        </div>
    </header>

    <main class="section-page-grid">

        <?php
        if (mysqli_num_rows($query_semua) > 0) {
            while ($row = mysqli_fetch_assoc($query_semua)) {

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
                    <img src="<?= $gambar_fix ?>" alt="<?= htmlspecialchars($row['judul']) ?>" class="jiu-ann-img" />

                    <div class="jiu-ann-content">
                        <?php if (!empty($row['kategori'])) { ?>
                            <span class="jiu-ann-badge"><?= htmlspecialchars($row['kategori']) ?></span>
                        <?php } ?>

                        <h3 class="jiu-ann-title"><?= htmlspecialchars($row['judul']) ?></h3>

                        <div class="jiu-ann-hidden">
                            <div class="jiu-ann-date"><i class="far fa-calendar-alt"></i> <?= $tgl ?></div>
                            <p class="jiu-ann-desc"><?= $isi_pendek ?></p>
                            <div class="jiu-ann-btn">View Detail <i class="fas fa-arrow-right"></i></div>
                        </div>
                    </div>
                </a>

        <?php
            }
        } else {
            echo "
      <div style='grid-column: 1 / -1; text-align: center; padding: 50px; color: #64748b;'>
        <i class='fas fa-box-open' style='font-size: 3rem; margin-bottom: 15px; color:#cbd5e1;'></i>
        <h2 style='color:#475569;'>Belum ada pengumuman</h2>
      </div>";
        }
        ?>

    </main>

    <?php include 'footer.php'; ?>

</body>

</html>