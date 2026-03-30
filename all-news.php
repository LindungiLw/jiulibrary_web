<?php
require 'koneksi.php';

$query_semua_berita = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All News & Articles - Dream Blue Library</title>
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

    <?php
    ?>

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
        if ($query_semua_berita && mysqli_num_rows($query_semua_berita) > 0) {
            while ($row = mysqli_fetch_assoc($query_semua_berita)) {
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
                        <img src="<?= $gambar_fix ?>" alt="<?= htmlspecialchars($row['judul']) ?>" />
                    </div>

                    <div class="jiu-news-content">
                        <h3 class="jiu-news-title"><?= htmlspecialchars($row['judul']) ?></h3>
                        <div class="jiu-news-meta">
                            <span><i class="far fa-calendar-alt"></i> <?= $tgl ?></span>
                            <?php if (!empty($row['kategori'])) { ?>
                                <span><i class="fas fa-file-alt"></i> <?= htmlspecialchars($row['kategori']) ?></span>
                            <?php } else { ?>
                                <span><i class="fas fa-newspaper"></i> Library News</span>
                            <?php } ?>
                        </div>
                        <div class="jiu-news-btn">
                            <i class="fas fa-arrow-circle-right"></i> Read More
                        </div>
                    </div>
                </a>

        <?php
            }
        } else {
            echo "
      <div style='text-align: center; grid-column: 1 / -1; padding: 50px;'>
        <i class='fas fa-folder-open' style='font-size: 3rem; color: #cbd5e1; margin-bottom: 15px;'></i>
        <h3 style='color: #64748b;'>No News Available</h3>
        <p style='color: #94a3b8;'>Belum ada berita yang diterbitkan saat ini.</p>
      </div>";
        }
        ?>

    </main>

    <?php include 'footer.php'; ?>

</body>

</html>