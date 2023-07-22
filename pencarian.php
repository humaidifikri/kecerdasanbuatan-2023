<?php
require_once 'TextMining.php';

// error_reporting(0);
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'quran';

$conn = new mysqli($servername, $username, $password, $dbname);
$textMining = new TextMining;

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
    echo "hasil pencarian:<br><hr>";
    
    //query untuk pencarian dengan method  NLP fulltext search
    $keyword = $_GET['q'];
    
    $words = $textMining-> tokenizeText($keyword);
    $filteredWords = $textMining->removeStopWords($words,$stopwords);
    var_dump($filteredWords);


    foreach ($filteredWords as $words){
        $word1 = $word1." ".$words; 
    }

    $stemmedWords = $textMining->stemWords($filteredWords);

    foreach ( $stemmedWords as $word){
        $word2 = $word2." ".$word." ";
    }
    
    
    $query = $conn->query("SELECT quran_text.aya, quran_text.sura, quran_text.text as arab, id_indonesian.text from quran_text JOIN id_indonesian ON quran_text.aya = id_indonesian.aya where MATCH (id_indonesian.text) AGAINST ('$word2' IN NATURAL LANGUAGE MODE);");

    if($query->num_rows > 0){
        while($row = $query2->fetch_assoc()){
            echo "Ayat: ".$row['aya']."<br>";
            echo "Ayat: ".$row['arabic']."<br>";
            echo "Arti: ".$row['text']. "<br>";

        }

    }else{
        echo "Tidak ada daya sesuai";
    }
}
$conn->close();