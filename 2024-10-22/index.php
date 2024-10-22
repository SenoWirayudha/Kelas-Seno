<?php

$data = "Saya belajar PHP di SMKN 2 Buduran";
$isi = "Hari ini saya berlajar PHP";
$materi = "Materi belajar PHP";
$list1 = "Variabel";
$list2 = "Array";
$list3 = "Pengujian";
$list4 = "Pengulangan";
$list5 = "function";
$list6 = "class";
$list7 = "object";
$list8 = "framework";
$list9 = "PHP dan MYSql";

$lists = ["Variabel","Array","Pengujian","Pengulangan","Function","Classs","Object","Framework","PHP dan MYSql"];

echo $data;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .kamar {
            text-align: center;
        }
        .list {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="kamar">
    <h1><?php echo $data; ?></h1>
    <p><?php echo $isi; ?></p>
    <h3><?= $materi; ?></h3>
    <div class="list">
    <ol>
        <li> <?= $lists [0] ?>
            <p>Variable adalah wadah atau tempat untuk menyimpan data</p>
            <p>data bisa berupa data atau string, bisa juga berupa angka atau numerik, data juga bisa gabungan antara text, angka, dan simbol</p>
        </li>
        <li><?= $lists [1] ?></li>
        <li><?= $lists [2] ?></li>
        <li><?= $lists [3] ?></li>
        <li><?= $lists [4] ?></li>
        <li><?= $lists [5] ?></li>
        <li><?= $lists [6] ?></li>
        <li><?= $lists [7] ?></li>
        <li><?= $lists [8] ?></li>
    </ol>

    </div>
    </div>
    
</body>
</html>