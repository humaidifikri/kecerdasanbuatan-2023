<?php
// Mengimpor library TextMining
require_once 'TextMining.php';

// Inisialisasi objek TextMining
$textMining = new TextMining();

// Menentukan teks yang akan diproses
$text = "Ini adalah contoh teks yang akan diproses menggunakan text mining. Teks ini berisi beberapa kata-kata penting seperti 'text mining', 'proses', 'contoh', dan 'kata-kata'.";

// Memisahkan teks menjadi kata-kata
$words = $textMining->tokenizeText($text);

// Menghitung frekuensi kemunculan kata
$wordFrequency = $textMining->calculateWordFrequency($words);

// Menampilkan kata-kata beserta frekuensi kemunculannya
echo "Text Asli : <br>";
echo $text;
echo "Kata-kata yang ditemukan dan frekuensi kemunculannya:\n";
foreach ($wordFrequency as $word => $frequency) {
    echo $word . ": " . $frequency . "<br>";
}

// Melakukan proses stop word removal
$stopWords = $stopwords;
$filteredWords = $textMining->removeStopWords($words, $stopWords);

// Menampilkan kata-kata setelah stop word removal
echo "\nKata-kata setelah stop word removal: <br>";
foreach ($filteredWords as $word) {
    echo $word . "\n";
}

// Melakukan proses stemming
$stemmedWords = $textMining->stemWords($filteredWords);

// Menampilkan kata-kata setelah stemming
echo "<br>Kata-kata setelah stemming:<br>";
foreach ($stemmedWords as $word) {
    echo $word . "\n";
}
?>