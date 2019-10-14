<?php
	include "../config/koneksi.php";
session_start();

	$id = $_POST['id_salary'];

	$jml_data = count($id);
	
	for($i=0;$i<$jml_data;$i++){
		$query=mysqli_query($k,"UPDATE salary SET Level = '1' WHERE id_salary = '$id[$i]'");
	}
	
	
	if($query){
		$tanggal_sekarang = date("Y-m-d");
		
		$level_notifikasi = 1;
		
		$sql_notifikasi = mysqli_query($k,"INSERT INTO notifikasi(id_pengirim,isi,level,divisi,cabang,isRead,tanggal,nama,lokasi) VALUES('','Kalkulasi Penggajian telah diajukan','$level_notifikasi','0','Jakarta','n','$tanggal_sekarang','','?modul=salary')");
		$status = "Berhasil memasukkan ke database";
		$_SESSION['stat'] = "sukses";
	}else{
		$stat = "Gagal memasukkan ke database!";
		$_SESSION['stat'] = "gagal";
	}
	$_SESSION['message'] = $stat;
	
	header("Location: ../payroll/index.php?modul=salary");
	
	
	
?>