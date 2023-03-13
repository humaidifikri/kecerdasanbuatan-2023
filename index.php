<?php

// variabel fuzzy

$permintaan = ['turun','naik'];
$x = $_GET['x'];
$naik = 5000;
$turun = 1000;

$rumus_naik = ($naik - $x)/($naik - $turun);
$rumus_turun = ($x - $turun)/($naik - $turun);


echo "X= ".$rumus_naik;
echo"<br>";
echo "Y= ".$rumus_turun;







?>