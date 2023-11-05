<?php

function format_uang  ($angka)
{
    return number_format($angka,0,',','.');
}


function terbilang ($angka)  {
    $angka = abs($angka);
    $baca = array('' 'satu','dua','tiga','empat','lima','enam','tujuh','delapan','sembilan','sepuluh','sebelas');
    $terbilang = '';

    if ($angka < 12) {
        $terbilang =' ' . $baca[$angka];
    }

    return $terbilang;
}
