<?php 

    // $hari = 1;

    // switch ($hari) {
    //     case 1:
    //         echo 'minggu';
    //         break;
        
    //     case 2:
    //         echo 'senin';
    //         break;
        
    //     case 3:
    //        echo 'selasa';
    //        break;

    //     default:
    //        echo 'hari belum dibuat';
    //         break;
    
    // }

        $pilihan = 'tambah';

        switch ($pilihan) {
            case 'tambah':
                echo 'Anda memilih tambah';
                break;
            
            case 'ubah':
                echo 'Anda memilih ubah';
                break;
            
            case 'hapus':
                echo 'Anda memilih hapus';
                break;
            default:
                echo 'Pilihan belum ada';
                break;
        }

?>