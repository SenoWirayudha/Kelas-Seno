<?php 

    //array dimensi 

    // $nama = array("Joni","Tejo","Budi",'Siti',100,2.5);

    // var_dump($nama);

    // echo '<br>';

    // echo $nama[5];

    // echo '<br>';

    // for ($i=0; $i < 6 ; $i++) { 
    //     // echo $i;
    //     echo $nama[$i].'<br>';

    // }

    // foreach ($nama as $key) {
    //     echo $key.'<br>';
    // }

    //array asosiatif

    // $nama = array (
    //     "joni" => "Surabaya",
    //     "budi" => "Malang",
    //     "tejo" => "Jakarta",
    //     "siti" => "Sidoarjo"
    // );

    $nama["joni"]="Surabaya";
    $nama["budi"]="Malang";
    $nama["tejo"]="Jakarta";
    $nama["siti"]="Sidoarjo";

    var_dump($nama);

    echo '<br>';

    // echo $nama['joni'];

    foreach ($nama as $key => $value) {
        echo $key."=>".$value;

        echo '<br>';
    }

?>