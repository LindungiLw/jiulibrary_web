<?php
require_once '../koneksi.php';

header('Content-Type: application/json');

if (!isset($_GET['q']) || empty(trim($_GET['q']))) {
    echo json_encode(['berita' => [], 'pengumuman' => []]);
    exit;
}

$koneksi = getKoneksi();
$searchQuery = '%' . trim($_GET['q']) . '%';
$results = ['berita' => [], 'pengumuman' => []];

try {
    // Search in Berita
    $stmtBerita = $koneksi->prepare("SELECT id, judul, tanggal FROM berita WHERE judul LIKE ? OR konten LIKE ? ORDER BY tanggal DESC LIMIT 3");
    $stmtBerita->execute([$searchQuery, $searchQuery]);
    while ($row = $stmtBerita->fetch(PDO::FETCH_ASSOC)) {
        $results['berita'][] = [
            'id' => $row['id'],
            'title' => $row['judul'],
            'date' => date('d M Y', strtotime($row['tanggal']))
        ];
    }

    // Search in Pengumuman
    $stmtPengumuman = $koneksi->prepare("SELECT id, judul, tanggal FROM pengumuman WHERE judul LIKE ? OR konten LIKE ? ORDER BY id DESC LIMIT 3");
    $stmtPengumuman->execute([$searchQuery, $searchQuery]);
    while ($row = $stmtPengumuman->fetch(PDO::FETCH_ASSOC)) {
        $results['pengumuman'][] = [
            'id' => $row['id'],
            'title' => $row['judul'],
            'date' => date('d M Y', strtotime($row['tanggal']))
        ];
    }

    echo json_encode($results);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error', 'berita' => [], 'pengumuman' => []]);
}
?>
