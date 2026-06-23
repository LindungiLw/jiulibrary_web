<?php
/**
 * Gemini AI Proxy untuk BlueBot
 * API Key disimpan di server agar tidak terekspos ke publik
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// ============================================================
// GANTI DENGAN API KEY KAMU DARI https://aistudio.google.com/
// ============================================================
define('GEMINI_API_KEY', 'GANTI_DENGAN_API_KEY_KAMU');
// ============================================================

$SYSTEM_PROMPT = "Kamu adalah BlueBot, asisten perpustakaan cerdas dari Dream Blue Library Universitas Internasional Jakarta (JIU). Kamu membantu mahasiswa dan civitas dengan ramah, singkat, dan jelas.

INFORMASI PERPUSTAKAAN:
- Jam buka: Senin-Jumat 08.00-17.00 & 18.00-21.00, Sabtu 08.00-17.00, Hari Besar tutup
- Pinjam: maks 5 buku, 5 DVD, 3 e-book selama 2 minggu
- Denda: Rp1.000/hari/buku. Hilang/rusak parah: ganti 100%
- WiFi: M204 (Library), sandi: HappyCampus!
- Loker: 42 loker, kunci dipinjam di sirkulasi
- Study Room: bisa dipesan di sirkulasi
- Cek Turnitin: gratis, kirim PDF/Word, hasil 1-2 hari kerja
- Print: Rp300/lembar, Scan GRATIS
- Healing Corner: game, earphone, fun card tersedia
- OPAC: http://lib.jiu.ac/
- WhatsApp Pustakawan: 6281260173697
- Bebas Pustaka: untuk wisudawan, pastikan tidak ada tanggungan

GAYA BAHASA:
- Selalu mulai dengan 'Hallo, Buddy! 👋'
- Ramah, kasual, pakai emoji seperlunya
- Jawab singkat dan langsung
- Jika tidak tahu, minta user hubungi Pustakawan via WA
- Bahasa Indonesia campur sedikit Inggris boleh";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$userMessage = isset($input['message']) ? trim($input['message']) : '';

if (empty($userMessage)) {
    echo json_encode(['reply' => 'Pesan tidak boleh kosong.']);
    exit;
}

if (GEMINI_API_KEY === 'GANTI_DENGAN_API_KEY_KAMU') {
    echo json_encode(['reply' => 'AI belum dikonfigurasi. Silakan hubungi Pustakawan via WhatsApp ya, Buddy! 😊', 'ai_unavailable' => true]);
    exit;
}

$apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=' . GEMINI_API_KEY;

$payload = json_encode([
    'contents' => [
        [
            'role' => 'user',
            'parts' => [['text' => $SYSTEM_PROMPT . "\n\nPertanyaan user: " . $userMessage]]
        ]
    ],
    'generationConfig' => [
        'temperature' => 0.7,
        'maxOutputTokens' => 300,
        'topP' => 0.9,
    ]
]);

$ch = curl_init($apiUrl);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $payload,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    CURLOPT_TIMEOUT => 15,
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($response === false || $httpCode !== 200) {
    echo json_encode(['reply' => 'Hallo, Buddy! 👋 Maaf, AI sedang tidak bisa dihubungi. Coba tanya ke Pustakawan ya! 😊', 'ai_unavailable' => true]);
    exit;
}

$data = json_decode($response, true);
$aiReply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, tidak ada jawaban dari AI saat ini.';

echo json_encode(['reply' => $aiReply]);
