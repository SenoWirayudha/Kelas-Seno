<?php 

$crcl = "CURRICULUM";
$vt = "VITAE";
$nama = "Muhammad Seno Wirayudha";
$sekolah = "SMKN 2 Buduran";
$identitas = ["TTL","ALAMAT"];
$idens = ["27/01/09","Jl. Gajah RT. 13 RW. 04, Magersari, Sidoarjo"];
$hobis = ["HOBI","Nonton film","Mendengarkan musik"];
$tag = "MY SKILL" ;
$progams = ["HTML Newbie","CSS Newbie","C++ Newbie","PHP Newbie"];
$designs = ["Alight Motion Expert","Capcut Expert","Lighroom Expret","Design Canva Expert"];
?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #ffd7a2;
    }

    .open img{
      height: 600px;
      width: 960px;
      background-color: #ccccc;
      border-radius: 50px;
      border: 2px solid black;
      
    }
    .control {
      width: 955px;
      height: 50px;
      position: absolute;
      background-color: #75a5ed;
      top: 10px;
      border-radius: 25px;
      border: 3px solid black;
    }
    .color1 {
      width: 35px;
      height: 35px;
      position: absolute;
      background-color: #ffdd80;
      border-radius: 50%;
      top: 5px;
      left: 20px;
      border: 2px solid black;
    }
    .color2 {
      width: 35px;
      height: 35px;
      position: absolute;
      background-color: black;
      border-radius: 50%;
      top: 5px;
      left: 70px;
      border: 2px solid black;
    }
    .color3 {
      width: 35px;
      height: 35px;
      position: absolute;
      background-color: #00aae5;
      border-radius: 50%;
      top: 5px;
      left: 120px;
      border: 2px solid black;
    }
    .vt h3 {
      top: 200px;
      left: 430px;
      position: absolute;
      font-size: 40px;
      font-family: "Pixelify Sans", serif!important;
    }
    .crcl h1 {
      top: 30px;
      left: 140px;
      position: absolute;
      font-size: 120px;
      color: #ffdd80;
      text-shadow: 0px 0px 30px black;
      font-family: "Pixelify Sans", serif;
    }
    .card-container img{
      width: 150px;
      height: 150px;
      border-radius: 50%;
      background-color: red;
      left: 405px;
      top: 300px;
      position: absolute;
      border: 1px solid black;
    }
    .container-name {
      width: 950px;
      height: 100px;
      background-color: white;
      border-radius: 50px;
      border: 3px solid black;
      position: relative;
      top: 30px;
    }
    .name h1 {
      position: absolute;
      left: 150px;
      top: -30px;
      font-family: "Pixelify Sans", serif!important;
      font-size: 50px;
      font-style: italic;
      color: #fffd24;
      text-shadow: 0px 0px 10px black;
    }
    .school h2 {
      position: absolute;
      left: 380px;
      top: 40px;
      font-family: "Pixelify Sans", serif!important;
      font-style: italic;
      color: black;
    }
    .container-cardful {
      width: 950px;
      height: 200px;
      display: flex;
      justify-content: space-around;
    }
    .container-iden {
      width: 475px;
      height: 200px;
      background-color: white;
      border-radius: 70px;
      border: 2px solid black;
      position: relative;
      top: 50px;
    }
    .ttl h1{
      top: 5px;
      left: 50px;
      position: absolute;
      font-family: "Pixelify Sans", serif!important;
      font-size: 40px;
      font-style: italic;
      color: #fffd24;
      text-shadow: 0px 0px 10px black;
    }
    .ttl p {
      top: 10px;
      left: 230px;
      position: absolute;
      font-family: "Pixelify Sans", serif!important;
      font-size: 30px;
      font-weight: bold;
    }
    .alamat h1{
      top: 70px;
      left: 50px;
      position: absolute;
      font-family: "Pixelify Sans", serif!important;
      font-size: 40px;
      font-style: italic;
      color: #fffd24;
      text-shadow: 0px 0px 10px black;
    }
    .alamat p {
      top: 80px;
      left: 230px;
      position: absolute;
      font-family: "Pixelify Sans", serif!important;
      font-size: 20px;
      font-weight: bold;
    }
    .container-hobi {
      width: 450px;
      height: 200px;
      background-color: white;
      border-radius: 70px;
      border: 2px solid black;
      position: relative;
      top: 50px;
    }
    .hobi h1{
      left: 170px;
      top: -25px;
      position: absolute;
      font-size: 50px;
      font-family: "Pixelify Sans", serif!important;
      font-style: italic;
      color: #fffd24;
      text-shadow: 0px 0px 10px black;
    }
    .list-hobi {
      position: absolute;
      left: 20px;
      top: 60px;
      font-size: 25px;
      font-family: "Pixelify Sans", serif!important;
      font-weight: bold;
    }
    .container-skil {
      width: 950px;
      height: 700px;
      background-color: white;
      position: relative;
      border: 2px solid black;
      border-radius: 50px;
      top: 70px;
    }
    .tag-skil {
      text-align: center;
      font-size: 30px;
      font-family: "Pixelify Sans", serif!important;
      font-style: italic;
      color: #fffd24;
      text-shadow: 0px 0px 40px black;
    }
    .crc-progam {
      width: 950px;
      height: 200px;
      display: flex;
      justify-content: space-around;
      margin-top: 70px;
      text-align: center;
    }
    .crc img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      border: 2px solid black;
    }
    .crc p {
      margin-left: 5px;
      font-family: "Pixelify Sans", serif!important;
      font-weight: bold;
      color: black;
      font-size: 30px;
    }
    .crc-design {
      width: 950px;
      height: 200px;
      display: flex;
      justify-content: space-around;
      margin-top: 40px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="open">
    <img src="image/mario1.jpg" alt="">
    <div class="control">
      <div class="color1"></div>
      <div class="color2"></div>
      <div class="color3"></div>
    </div>
    <div class="vt"><h3><?php echo $vt; ?></h3></div>
    <div class="crcl"><h1><?php echo $crcl; ?></h1></div>
    <div class="card-container">
      <img src="image/fotoku.jpg" alt="">
    </div>
  </div>
  <div class="container-name">
    <div class="name"><h1><?php echo $nama; ?></h1></div>
    <div class="school"><h2><?php echo $sekolah; ?></h2></div>
  </div>
  <div class="container-cardful">
  <div class="container-iden">
    <div class="ttl">
      <h1><?= $identitas[0] ?></h1>
      <p><?= $idens[0] ?></p>
    </div>
    <div class="alamat">
      <h1><?= $identitas[1] ?></h1>
      <p><?= $idens[1] ?></p>
    </div>
  </div>
  <div class="container-hobi">
      <div class="hobi">
      <h1><?= $hobis[0] ?></h1>
      </div>
      <div class="list-hobi">
      <ul>
        <li><?= $hobis[1] ?></li>
        <li><?= $hobis[2] ?></li>
      </ul>
      </div>
  </div>
  </div>
  <div class="container-skil">
    <div class="tag-skil"><h1><?php echo $tag; ?></h1></div>
    <div class="crc-progam">
      <div class="crc"><img src="image/html.png"/><p><?= $progams[0] ?></p></div>
      <div class="crc"><img src="image/css.png"/><p><?= $progams[1] ?></p></div>
      <div class="crc"><img src="image/c++.png"/><p><?= $progams[2] ?></p></div>
      <div class="crc"><img src="image/php.png"/><p><?= $progams[3] ?></p></div>
    </div>
    <div class="crc-design">
      <div class="crc"><img src="image/am.jpeg"/><p><?= $designs[0] ?></p></div>
      <div class="crc"><img src="image/capcut.jpg"/><p><?= $designs[1] ?></p></div>
      <div class="crc"><img src="image/lightroom.png"/><p><?= $designs[2] ?></p></div>
      <div class="crc"><img src="image/canva.jpeg"/><p><?= $designs[3] ?></p></div>
    </div>
    
    
  </div>
</body>
</html>