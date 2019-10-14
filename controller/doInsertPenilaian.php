<?php
include "../config/koneksi.php";
session_start();
	 $kehadiran = $_POST['kehadiran'];
	 $motivasi_kerja = $_POST['motivasi-kerja'];
	 $komunikasi = $_POST['komunikasi'];
	 $pencapaian = $_POST['pencapaian'];
	 $pemahaman = $_POST['pemahaman'];
	 $pengembangan = $_POST['pengembangan'];
	 $penghargaan = $_POST['penghargaan'];
	
	 $id = $_POST['karyawan'];
	$query_data_karyawan = mysqli_query($k,"SELECT * FROM user WHERE Id_User = '$id'");
$data_karyawan = mysqli_fetch_array($query_data_karyawan);
$id_divisi = $data_karyawan['id_divisi'];
$cabang = $data_karyawan['cabang'];
	
	$total_nilai = 0;
	$total_nilai += 2*$kehadiran;
	$total_nilai += 2*$komunikasi;
	$total_nilai += 2*$pencapaian;
	$total_nilai += 2*$motivasi_kerja;
	$total_nilai += 2*$pemahaman;
	$total_nilai += 2*$pengembangan;
	$total_nilai += 2*$penghargaan;
	if($total_nilai / 10 > 3){
		$grade = "A";
	}elseif($total_nilai /10 > 2){
		$grade = "B";
	}elseif($total_nilai / 10 > 1){
		$grade = "C";
	}elseif($total_nilai /10 <= 1){
		$grade = "D";
	}
	
	$periode = 2016;
	
	$query=mysqli_query($k,"INSERT INTO penilaian(id_karyawan,id_divisi,cabang,komunikasi_kerjasama,pemahaman_penguasaan,kehadiran_karyawan,motivasi_kerja,pengembangan_diri,penghargaan_sanksi,pencapaian_target,grade,periode_penilaian) VALUES('$id','$id_divisi','$cabang','$komunikasi','$pemahaman','$kehadiran','$motivasi_kerja','$pengembangan','$penghargaan','$pencapaian','$grade','$periode')");
	
	
	
	if($query){
		$stat = "Berhasil memasukkan data ke database";
		$_SESSION['stat'] = "sukses";
	}else{
		$stat = "Gagal memasukkan ke database!";
		$_SESSION['stat'] = "gagal";
	}
	$_SESSION['message'] = $stat;

	header("Location:../kadiv/?modul=penilaian");

	
?>