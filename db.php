<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'quran';


$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
    die("error". mysql_error_string($conn));

}
?>

<form method="get" action="">
    <input type="text" name="q" value="">
    <input type="submit" value="cari">
</form>

<?php
if(isset($_GET['q'])){
    echo "hasil pencarian:<br><hr>";
    // echo "Mungkin maksud anda adalah ".$katanya['spelling_fix']."<br><hr>";

    $keyword = $_GET["q"];
    $query = $conn->query("SELECT quran_text.aya , quran_text.sura, quran_text.text as arab, id_indonesian.text from quran_text JOIN id_indonesian ON quran_text.aya = id_indonesian.aya where MATCH (id_indonesian.text) AGAINST ('$keyword' IN NATURAL LANGUAGE MODE);");

    }
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            echo "Surah: ".$row['sura']."<br>"; 
            echo "Ayat: ".$row['aya']."<br>";
            echo "Ayat: ".$row['arab']."<br>";
            echo "Arti: ".$row['text']. "<br>";

        }
    }
    else{
        echo "tidak ada data sesuai";
    }


$conn->close();


