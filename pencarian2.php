<?php

//include 'perbaikiText.php;
require_once 'TextMining.php';

error_reporting(0);
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'quran';

$conn = new mysqli($servername, $username, $password, $dbname);
//Inisialisasi objek TextMining
$textMining = new TextMining();

if($conn->connect_error) {
    die("Error connecting to database: " . mysqli_error_string($conn));
}

?>
<form method="get" action="">
    <input type="text" name="q" value="" />
    <input type="submit" value="cari">
</form>

<?php
if(isset($_GET['q'])){
    

    //query untuk pencarian dengan method  NLP fulltext search
    $keyword = $_GET['q'];

    //memisahkan teks menjadi kata-kata
    $words = $textMining->tokenizeText($keyword);
    $filteredWords = $textMining->removeStopWords($words, $stopwords);

    foreach ($filteredWords as $word) {
        $words1 = $words1." ".$word." ";
    }

    $stemmedWords = $textMining->stemWords($filteredWords);
    foreach ($stemmedWords as $word) {
        $words2 = $words2." ".$word." ";
    }

    //query untuk pencarian dengan metode NLP fulltext search
    $query = $conn->query("SELECT quran_text.aya, quran_text.sura, quran_text.text as arab, id_indonesian.text from quran_text JOIN id_indonesian ON quran_text.aya = id_indonesian.aya where MATCH (id_indonesian.text) AGAINST ('$words2' IN NATURAL LANGUAGE MODE);");
    echo "hasil steaming: ".$words2."<hr>";
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            echo "Ayat: ".$row['aya']."<br>";
            echo "Ayat: ".$row['arab']."<br>";
            echo "Arti: ".$row['text']. "<br>";

        }
        

    }else{
        echo "Tidak ada daya sesuai";
    }
}
$conn->close();


