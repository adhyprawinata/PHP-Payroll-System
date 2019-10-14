<?php
date_default_timezone_set("Asia/Jakarta");

$jam_masuk = "07:00:00";
$jam_keluar = "14:20:00";

list($h,$m,$s) = explode(":",$jam_masuk);
$dtAwal = mktime($h,$m,$s,"1","1","1");
list($h,$m,$s) = explode(":",$jam_keluar);
$dtAkhir = mktime($h,$m,$s,"1","1","1");
$dtSelisih = $dtAkhir-$dtAwal;

$totalmenit = $dtSelisih/60;
$jam = explode(".",$totalmenit/60);
$sisamenit = (($totalmenit/60)-$jam[0])*60;
$selisih_jam = $jam[0].":".$sisamenit;

echo $selisih_jam;
?>