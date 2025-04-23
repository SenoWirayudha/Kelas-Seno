<?php

$sekolah = ["TK Dharma Wanita","SDN Magersari","SMPN 2 Sidoarjo","SMKN 2 Buduran"];
$sekolahs = ["TK"=>"TK Dharma Wanita", "SD"=> "SDN Magersari", "SMP"=>"SMPN 2 Sidoarjo", "SMKN"=>"SMKN 2 Buduran","PT"=>"UNESA"];
$skills = [
    "C++"=>"EXPERT",
    "HTML"=>"NEWBIE",
    "CSS"=>"INTERMEDIATE",
    "PHP"=>"INTERMEDIATE",
    "JAVASCRIPT"=>"INTERMEDIATE"
];
$identitas = ["Nama"=>"M. SENO","Alamat"=>"JL.Gajah","Email"=>"-","Tiktok"=>"-","Facebook"=>"-","IG"=>"-"];

$hobi = ["Coding (gak juga)","Musik","Film","Baca"];

// echo $sekolah[0];
// echo "<br>";
// echo $sekolahs["TK"];
// echo "<br>";
// echo $sekolah[1];
// echo "<br>";
// echo $sekolahs["SD"];

// echo "<br>";

// for ($i= 0; $i<4 ; $i++) {
//     echo $sekolah[$i];
//     echo "<br>";
// }

// echo "<br>";

// foreach($sekolah as$key) {
//     echo $key;
//     echo "<br>";
// }

// echo "<br>";

// foreach($sekolahs as$key => $value){
//     echo $key;
//     echo "=";
//     echo $value;
//     echo "<br>";
// }

// echo "<br>";

// foreach ($skills as $key => $value) {
//     echo $key;
//     echo "=";
//     echo $value;
//     echo "<br>";
// }
if (isset($_GET["menu"])) {
    $menu = $_GET["menu"];
    echo $menu;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <hr>
    <ul>
        <li><a href="?menu=home">HOME</a></li>
        <li><a href="?menu=cv">CV</a></li>
        <li><a href="?menu=projek">PROJECT</a></li>
        <li><a href="?menu=kontak">KONTAK</a></li>
    </ul>
    <h2>IDENTITAS</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Identitas</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($identitas as $key => $value) {
                ?>
                <tr>
                    <td><?= $key?></td>
                    <td><?= $value?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

    <h2>RIWAYAT SEKOLAH</h2>
    <table border="1">
        <thead>
            <tr>
                <th>JENJANG</th>
                <th>NAMA SEKOLAH</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($sekolahs as$key => $value) {
                echo "<tr>";
                echo "<td>";
                echo $key;
                echo "</td>";
                echo "<td>";
                echo $value;
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <hr>
    <h2>SKILLS</h2>
    <table border="1">
        <thead>
            <tr>
                <th>SKILL</th>
                <th>LEVEL</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($skills as $key => $value) {
                ?>
                <tr>
                    <td><?= $key?></td>
                    <td><?= $value?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <hr>
    <h2>HOBI</h2>
    <ul>
        <?php
        foreach ($hobi as $key) {
            ?>
            <li><?= $key?></li>
            <?php
        }
        ?>
    </ul>
</body>
</html>