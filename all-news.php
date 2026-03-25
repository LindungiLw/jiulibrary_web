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

    <style>
        body {
            background-color: #f8fafc;
        }

        .page-header {
            padding: 60px 0 50px 0;
            background-color: var(--clr-blue-1, #0f172a);
            text-align: center;
            color: white;
            position: relative;
        }

        .page-header-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 5%;
            position: relative;
        }

        .btn-back-header {
            position: absolute;
            left: 5%;
            top: 10px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #cbd5e1;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .btn-back-header:hover {
            color: var(--clr-yellow-1, #facc15);
            transform: translateX(-5px);
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 10px;
            font-family: var(--font-primary, 'Poppins', sans-serif);
            margin-top: 15px;
        }

        .page-subtitle {
            color: var(--clr-yellow-1, #facc15);
            font-size: 1.1rem;
        }

        .news-grid-page {
            max-width: 1100px;
            margin: -30px auto 60px auto;
            padding: 0 5%;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 40px 30px;
            position: relative;
            z-index: 5;
        }

        .news-grid-page .jiu-news-card {
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .btn-back-header {
                position: relative;
                left: 0;
                top: 0;
                margin-bottom: 20px;
                justify-content: center;
                display: flex;
            }

            .page-header {
                padding: 40px 0 30px 0;
            }

            .page-title {
                margin-top: 0;
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>

    <header class="site-header" style="background: white; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05)">
        <nav class="main-nav" style="justify-content: center">
            <div class="nav-logo">
                <a href="index.php" class="logo">
                    <img src="assets/images/library-logo.png" alt="JIU Library Logo" style="width: 40px; height: auto; object-fit: contain;" />
                    <div class="logo-text" style="color: #1e3a8a">Dream Blue Library</div>
                </a>
            </div>
        </nav>
    </header>

    <?php // include 'background-grafis.php'; 
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

    <main class="news-grid-page">

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

</body>

</html>