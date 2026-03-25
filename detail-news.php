<?php
require 'koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$query = mysqli_query($koneksi, "SELECT * FROM berita WHERE id = $id");
$news = mysqli_fetch_assoc($query);

$tanggal_cantik = "";
if ($news) {
    $tanggal_cantik = date('d M Y', strtotime($news['tanggal']));
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $news ? htmlspecialchars($news['judul']) : 'Not Found' ?> - JIU Library News</title>
    <link rel="icon" type="image/png" href="assets/images/library-logo.png" />

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }

        .detail-container {
            max-width: 1050px;
            margin: 120px auto 50px auto;
            padding: 40px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
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
            gap: 40px;
        }

        @media (min-width: 768px) {
            .detail-layout {
                flex-direction: row;
                align-items: flex-start;
            }
        }

        .detail-image-wrapper {
            flex: 0 0 380px;
            width: 100%;
            position: sticky;
            top: 100px;
        }

        .detail-image {
            width: 100%;
            height: auto;
            max-height: 450px;
            object-fit: cover;
            border-radius: 12px;
            background-color: #f8fafc;
            padding: 5px;
            border: 1px solid #e2e8f0;
        }

        .detail-text-wrapper {
            flex: 1;
        }

        .detail-category {
            background: #eff6ff;
            color: #1e3a8a;
            padding: 6px 16px;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
            margin-bottom: 20px;
        }

        .detail-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 15px;
            line-height: 1.2;
            letter-spacing: -0.5px;
        }

        .simple-meta {
            color: #64748b;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e2e8f0;
        }

        .simple-meta i {
            color: #3b82f6;
            font-size: 1.1rem;
        }

        .detail-content {
            font-size: 1.1rem;
            color: #334155;
            line-height: 1.8;
        }

        .error-state {
            text-align: center;
            padding: 40px;
        }

        .btn-error-back {
            background: #1e3a8a;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <header style="position: fixed; top:0; width:100%; background: white; z-index:1000; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
        <div style="max-width: 1050px; margin: 0 auto; padding: 15px 20px; display: flex; align-items: center; justify-content: center;">
            <a href="index.php" style="text-decoration: none; display: flex; align-items: center; gap: 10px;">
                <img src="assets/images/library-logo.png" alt="JIU Library Logo" style="width: 40px; height: auto; object-fit: contain;" />
                <span style="font-weight: 800; color: #1e3a8a; font-size: 1.2rem;">Dream Blue Library</span>
            </a>
        </div>
    </header>

    <main>
        <div class="detail-container">

            <?php if ($news): ?>
                <a href="index.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to News</a>

                <div class="detail-layout">
                    <div class="detail-image-wrapper">
                        <img src="<?= htmlspecialchars($news['gambar']) ?>" alt="<?= htmlspecialchars($news['judul']) ?>" class="detail-image">
                    </div>

                    <div class="detail-text-wrapper">
                        <span class="detail-category"><?= htmlspecialchars($news['kategori'] ?? 'News') ?></span>
                        <h1 class="detail-title"><?= htmlspecialchars($news['judul']) ?></h1>

                        <div class="simple-meta">
                            <i class="far fa-calendar-alt"></i>
                            <span>Published on <strong><?= $tanggal_cantik ?></strong></span>
                        </div>

                        <div class="detail-content">
                            <?= $news['isi'] ?>
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <div class="error-state">
                    <i class="fas fa-newspaper" style="font-size: 5rem; color: #cbd5e1; margin-bottom: 20px;"></i>
                    <h2 style="color: #1e293b; font-size: 2rem;">Berita Tidak Ditemukan</h2>
                    <p style="color: #64748b;">Maaf, artikel yang Anda cari mungkin telah dihapus atau dipindahkan.</p>
                    <a href="index.php" class="btn-error-back">Kembali ke Beranda</a>
                </div>
            <?php endif; ?>

        </div>
    </main>
</body>

</html>