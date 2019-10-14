<?php
//tentukan nilai variable
$identitas = explode("-",$_POST['identitas']);
$id = $identitas[0];
$gapok = $_POST['gapok'];
$gapok_baru = $_POST['gapok_baru'];
if(isset($_POST['gaji_kenaikkan'])){
	$gaji_kenaikkan = $_POST['gaji_kenaikkan'];
}

	$tunjangan_operasional = $_POST['operasional'];

	$bonus = $_POST['bonus'];

$tll_ket = $_POST['tll_keterangan'];
$tll_nominal = $_POST['tll_nominal'];
$jml_tll = count($tll_ket);
if($gapok_baru != ""){
	$gapok = $gapok_baru;
}else if(isset($gaji_kenaikkan) && $gapok_baru == ""){
	$gapok = $gaji_kenaikkan;
}
$query_data_karyawan = mysqli_query($k,"SELECT * FROM user WHERE Id_User = '$id'");
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

$query_stat_absensi = mysqli_query($k,"SELECT * FROM stat_absensi WHERE id_karyawan = '$id'"); // AND PERIODE 
$data_absensi = mysqli_fetch_array($query_stat_absensi);
$lembur = $data_absensi['lembur'];
//dijadiin int terus dikaliin rumus baru
$absen = $data_absensi['absen'];

$query_pinjaman = mysqli_query($k,"SELECT * FROM pinjaman WHERE id_karyawan = '$id'"); // AND PERIODE  status aproved
$data_pinjaman = mysqli_fetch_array($query_pinjaman);

$cicilan_pinjaman = $data_pinjaman['presentase_angsuran']/100 * $gapok;


$query_cuti = mysqli_query($k,"SELECT SUM(kuota_terpakai) AS total_cuti FROM cuti WHERE id_karyawan = '$id';"); // AND PERIODE  status aproved
$data_cuti = mysqli_fetch_array($query_cuti);

$potongan_absen = ($absen-$data_cuti['total_cuti'])*30000;
$potongan_plg_awal = $data_absensi['pulang_awal']*15000;
$potongan_terlambat = $data_absensi['terlambat']*15000;
$umt = $data_absensi['jml_hari_masuk']*30000;
?>
<form method="POST" action="../controller/doInsertSalary.php" class="form-horizontal">
<div class="form-group"><label class="col-sm-3">Nama</label> <div class="col-sm-3">: <?php echo $identitas[1]; ?></div></div>
<div class="form-group"><label class="col-sm-3">ID Karyawan</label> <div class="col-sm-3">: <?php echo $identitas[0]; ?></div></div>
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
if($tll_ket[0] !=0){?>
<div><strong>Tunjangan Lain Lain</strong></div>
<?php
	
	for($i=0;$i<$jml_tll;$i++){
		echo "<div class='form-group'><label class='col-sm-3'>$tll_ket[$i]</label> <div class='col-sm-3'>: ".number_format($tll_nominal[$i], "2", ",", ".")." </div></div>";
		$total_tll += $tll_nominal[$i];
	}

?><br/>
<?php }?>
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


<input type="hidden" name="id_karyawan" value="<?php echo $id; ?>"/>
<input type="hidden" name="id_divisi" value="<?php echo $data_karyawan['id_divisi']; ?>"/>
<input type="hidden" name="cabang" value="<?php echo $data_karyawan['cabang']; ?>"/>
<input type="hidden" name="tll_ket" value="<?php echo implode(",",$tll_ket); ?>"/>
<input type="hidden" name="tll_nominal" value="<?php echo implode(",",$tll_nominal); ?>"/>
<input type="hidden" name="gaji_pokok" value="<?php echo $gapok; ?>"/>
<input type="hidden" name="tunjangan_operasional" value="<?php echo $tunjangan_operasional; ?>"/>
<input type="hidden" name="bonus" value="<?php echo $bonus; ?>"/>
<input type="hidden" name="nett_salary" value="<?php echo $nett_salary; ?>"/>
<input type="hidden" name="level" value="4"/>
<input type="hidden" name="terapkan" value="<?php ?>"/>
<input type="hidden" name="periode" value="<?php echo $_POST['periode'] ?>">
<div  class="col-sm-6" style="text-align:center;"><input type="submit" value="Submit" class="btn btn-primary"> <a class='btn btn-danger' onclick='javascript:history.back()'>Kembali</a></div>
</form>
<!-- INSERT DATABASE -->