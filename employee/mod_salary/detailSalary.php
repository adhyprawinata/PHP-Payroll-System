<?php
//tentukan nilai variable
$id = $_GET['id'];
	$query = "SELECT * FROM salary where id_salary ='$id'";
		$hasil = mysqli_query($k, $query);
		$data = mysqli_fetch_array($hasil);
		
		$gapok = $data['gaji_pokok'];

$tunjangan_operasional = $data['tunjangan_operasional'];
$bonus = $data['bonus'];


$query_data_karyawan = mysqli_query($k,"SELECT * FROM user WHERE Id_User = '$data[id_user]'");
$data_karyawan = mysqli_fetch_array($query_data_karyawan);

$JHT = (2/100) * $gapok;
$netto_sebulan = $gapok - $JHT;
$netto_setahun = $netto_sebulan * 12;
if($data_karyawan['status'] = 'kawin'){
	$PTKP = 58500000;
}else{
	$PTKP = 54000000;
}
if($PTKP >= $netto_setahun){
	$PKP = 0;
}else{
	$PKP = $netto_setahun - $PTKP;
	if($PKP <= 50000000){
		$pph21_terhutang = (5/100)*$PKP;
	}elseif($PKP > 50000000 && $PKP <= 250000000){
		$pph21_terhutang = (15/100)*$PKP;
	}elseif($PKP > 250000000 && $PKP <= 500000000){
		$pph21_terhutang = (25/100)*$PKP;
	}elseif($PKP > 50000000){
		$pph21_terhutang = (30/100)*$PKP;
	}
}

if($PKP == 0){
	$pph21_bulan = 0;
}else{
	$pph21_bulan = $pph21_terhutang/12;
}

$query_stat_absensi = mysqli_query($k,"SELECT * FROM stat_absensi WHERE id_karyawan = '$data[id_user]'"); // AND PERIODE 
$data_absensi = mysqli_fetch_array($query_stat_absensi);
$lembur = $data_absensi['lembur'];
//dijadiin int terus dikaliin rumus baru
$absen = $data_absensi['absen'];

$query_pinjaman = mysqli_query($k,"SELECT * FROM pinjaman WHERE id_karyawan = '$data[id_user]'"); // AND PERIODE  status aproved
$data_pinjaman = mysqli_fetch_array($query_pinjaman);

$cicilan_pinjaman = $data_pinjaman['presentase_angsuran']/100 * $gapok;


$query_cuti = mysqli_query($k,"SELECT SUM(kuota_terpakai) AS total_cuti FROM cuti WHERE id_karyawan = '$data[id_user]';"); // AND PERIODE  status aproved
$data_cuti = mysqli_fetch_array($query_cuti);

$potongan_absen = ($absen-$data_cuti['total_cuti'])*30000;
$potongan_plg_awal = $data_absensi['pulang_awal']*15000;
$potongan_terlambat = $data_absensi['terlambat']*15000;
$umt = $data_absensi['jml_hari_masuk']*30000;
?>
<form method="POST" action="?modul=karyawanKlaim&act=inputKlaim" class="form-horizontal">
<div class="form-group"><label class="col-sm-3">Nama</label> <div class="col-sm-3">: <?php echo $data_karyawan['Nama']; ?></div></div>
<div class="form-group"><label class="col-sm-3">ID Karyawan</label> <div class="col-sm-3">: <?php echo $data_karyawan['Id_User']; ?></div></div>
<div class="form-group"><label class="col-sm-3">Gaji Pokok</label> <div class="col-sm-3">: <?php echo number_format($gapok, "2", ",", "."); ?></div></div> 
<div class="form-group"><label class="col-sm-3">Iuran Jaminan Hari Tua </label> <div class="col-sm-3">: <?php echo "2% x ".number_format($gapok, "2", ",", ".")." = ".number_format($JHT, "2", ",", "."); ?></div></div> 
<div class="form-group"><label class="col-sm-3">Penghasilan Neto Sebulan </label> <div class="col-sm-3">: <?php echo number_format($gapok, "2", ",", ".")." - ".number_format($JHT, "2", ",", ".")." = ". number_format($netto_sebulan, "2", ",", "."); ?></div></div> 
<div class="form-group"><label class="col-sm-3">Penghasilan Neto Setahun </label> <div class="col-sm-3">: <?php echo number_format($netto_sebulan, "2", ",", ".")." x 12 = ".number_format($netto_setahun, "2", ",", "."); ?></div></div> 
<div class="form-group"><label class="col-sm-3">PTKP </label> <div class="col-sm-3">: <?php echo number_format($PTKP, "2", ",", "."); ?></div></div> 
<?php if($PKP != 0){?>
<div class="form-group"><label class="col-sm-3">PKP </label> <div class="col-sm-3">: <?php echo number_format($netto_setahun, "2", ",", ".")." - ".number_format($PTKP, "2", ",", ".")." = ".number_format($PKP, "2", ",", "."); ?></div></div> 
<div class="form-group"><label class="col-sm-3">PPH21 Terhutang </label> <div class="col-sm-3">: <?php echo "5% x ".number_format($PKP, "2", ",", ".")." = ".number_format($pph21_terhutang, "2", ",", "."); ?></div></div> 
<div class="form-group"><label class="col-sm-3">PPH21 Sebulan </label> <div class="col-sm-3">: <?php echo number_format($pph21_terhutang, "2", ",", ".")." / 12 = ".number_format($pph21_bulan, "2", ",", "."); ?></div></div> 
<?php } ?>
<div class="form-group"><label class="col-sm-3">Jumlah Hari Masuk </label> <div class="col-sm-3">: <?php echo $data_absensi['jml_hari_masuk']+$absen; ?></div></div> 
<div class="form-group"><label class="col-sm-3">Absen </label> <div class="col-sm-3">: <?php echo $absen; ?></div></div> 
<div class="form-group"><label class="col-sm-3">Hari Masuk </label> <div class="col-sm-3">: <?php echo $data_absensi['jml_hari_masuk']; ?></div></div> 


<div><strong>Penambahan</strong></div>
<?php
	$query_lembur = mysqli_query($k,"SELECT * FROM lembur WHERE id_karyawan = '$id'"); // AND PERIODE and status aproved
	$total_lembur = mysqli_num_rows($query_lembur);
	$lembur_jam_pertama = $total_lembur * 1.5 * (1/173 * $gapok);
	$lembur_jam_kedua = (round($lembur/60)-$total_lembur) * 2 * (1/173 * $gapok);
?>
<div class="form-group"><label class="col-sm-3">Lembur Jam Pertama</label> <div class="col-sm-3">: <?php echo "$total_lembur x 1.5 x 1/173 x ".number_format($gapok, "2", ",", ".") ."= ". number_format(round($lembur_jam_pertama), "2", ",", "."); ?></div></div> 
<div class="form-group"><label class="col-sm-3">Lembur Jam Kedua</label> <div class="col-sm-3">: <?php echo (round($lembur/60)-$total_lembur)." x 2 x 1/173 x ".number_format($gapok, "2", ",", ".")." = ". number_format(round($lembur_jam_kedua), "2", ",", ".");?></div></div> 
<div class="form-group"><label class="col-sm-3">UMT </label> <div class="col-sm-3">: <?php echo "$data_absensi[jml_hari_masuk] x 30.000 = ".$umt; ?></div></div> 
<?php if($tunjangan_operasional != 0){?>
<div class="form-group"><label class="col-sm-3">Tunjangan Operasional </label> <div class="col-sm-3">: <?php echo number_format($tunjangan_operasional, "2", ",", "."); ?></div></div> 
<?php }?>
<?php if($bonus !=0){?>
<div class="form-group"><label class="col-sm-3">Bonus </label> <div class="col-sm-3">: <?php echo number_format($bonus, "2", ",", "."); ?></div></div> 
<?php }?>
<?php 
$total_tll = 0;
//if($tll_ket[0] !=0){?>
<div><strong>Tunjangan Lain Lain</strong></div>
<?php
	$total_tll = 0;
	$sql_tll = mysqli_query($k,"SELECT * FROM tll WHERE id_salary = '$id'");
	while($b = mysqli_fetch_assoc($sql_tll)){
		echo "<div class='form-group'><label class='col-sm-3'>$b[keterangan]</label> <div class='col-sm-3'>: $b[nominal] </div></div>";
		$total_tll += $b['nominal'];
	}

?><br/>
<div><strong>Pengurangan</strong></div>
<div class="form-group"><label class="col-sm-3">Absen</label> <div class="col-sm-3">: <?php echo $absen; ?></div></div> 
<div class="form-group"><label class="col-sm-3">Cuti </label> <div class="col-sm-3">: <?php 
if($data_cuti['total_cuti'] == "" || $data_cuti['total_cuti'] ==0){
	$total_cuti = 0;
	echo $total_cuti;
}else{
	echo $total_cuti = $data_cuti['total_cuti']; 
}?></div></div> 
<div><strong>Potongan UMT</strong></div>
<div class="form-group"><label class="col-sm-3">Absen </label> <div class="col-sm-3">: <?php echo "(".$absen."-".$total_cuti.") x 30.000 = ". number_format($potongan_absen, "2", ",", "."); ?></div></div> 
<div class="form-group"><label class="col-sm-3">Pulang Awal </label> <div class="col-sm-3">: <?php echo "$data_absensi[pulang_awal] x 15.000 = ".number_format($potongan_plg_awal, "2", ",", "."); ?></div></div> 
<div class="form-group"><label class="col-sm-3">Terlambat </label> <div class="col-sm-3">: <?php echo "$data_absensi[terlambat] x 15000 = ".number_format($potongan_terlambat, "2", ",", "."); ?></div></div> 
<div class="form-group"><label class="col-sm-3">Cicilan Pinjaman </label> <div class="col-sm-3">: <?php echo number_format($cicilan_pinjaman, "2", ",", "."); ?></div></div> 
<div class="form-group"><label class="col-sm-3">PPH21</label> <div class="col-sm-3">: <?php echo number_format($pph21_bulan, "2", ",", "."); ?></div></div> 
<?php
$nett_salary = $gapok + $lembur_jam_pertama + $lembur_jam_kedua - $cicilan_pinjaman - $pph21_bulan + $umt +$tunjangan_operasional + $bonus + $total_tll - $potongan_plg_awal - $potongan_terlambat - $potongan_absen;

?>
<div class="form-group"><label class="col-sm-3">Nett Salary </label> <div class="col-sm-3">: <?php echo number_format(round($nett_salary), "2", ",", "."); ?></div></div> 
<div class="form-group"><label class="col-sm-3">Status</label> <div class="col-sm-3">
<?php
	
			echo ": ".$data['status'];
		
		echo "</div></div>";
 $sql_message = mysqli_query($k,"SELECT * FROM message WHERE id_kenaikkan = '$id'");
 $data_message = mysqli_fetch_array($sql_message);
 if(mysqli_num_rows($sql_message) > 0){	 
	 echo "<div>$data_message[isi]</div>
			<div>$data_message[tanggal]  $data_message[jam]  by $data_message[author]	 
	 ";
 }
?>
<div style="text-align:center" class="col-sm-6">
	<a class="btn btn-primary" href="?modul=karyawanKlaim&act=inputKlaim">Protes</a>   <a class="btn btn-danger" onclick='javascript:history.back()'>Kembali</a>
</div>

</form>
<!-- INSERT DATABASE -->