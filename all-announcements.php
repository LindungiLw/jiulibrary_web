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
    <link rel="stylesheet" href="assets/css/footer.css" />

    <link rel="stylesheet" href="assets/css/style/announcements-slider.css?v=<?php echo time(); ?>" />

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

        .all-announcements-grid {
            max-width: 1100px;
            margin: 40px auto 80px auto;
            padding: 0 5%;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 40px 30px;
            position: relative;
            z-index: 5;
        }

        .all-announcements-grid .jiu-ann-card {
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

    <header class="page-header">
        <div class="page-header-container">

            <a href="index.php" class="btn-back-header">
                <i class="fas fa-arrow-left"></i> Back to Home
            </a>

            <h1 class="page-title">Library <span style="color: #facc15;">Announcements</span></h1>
            <p class="page-subtitle">Stay updated with the latest news, events, and information.</p>
        </div>
    </header>

    <main class="all-announcements-grid">

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

    <footer class="main-footer" style="padding: 20px 0; text-align: center; background: #1e293b; color: #94a3b8;">
        <p>&copy; 2026 Dream Blue Library, JIU. All rights reserved.</p>
    </footer>

</body>

</html>