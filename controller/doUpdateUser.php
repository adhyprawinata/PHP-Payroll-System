<?php
include "../config/koneksi.php";
session_start();
	$iduser = $_POST['iduser'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$tanggallahir = $_POST['tanggallahir'];
	$nama = $_POST['nama'];
	$status = $_POST['status'];
	$jabatan = $_POST['jabatan'];
	$iddivisi = $_POST['iddivisi'];
	$norekening = $_POST['norekening'];
	$cabang = $_POST['cabang'];
	$gajipokok = $_POST['gajipokok'];
	$level = 0;
	$tanggungan = $_POST['tanggungan'];
	
	if($jabatan=="Manager"){
		$level = 1;
	}else if($jabatan=="Kepala Cabang"){
		$level = 2;
	}else if($jabatan=="Kepala Divisi"){
		$level = 3;
	}else if($jabatan=="Staff"){
		$level = 4;
	}
	
	$query=mysqli_query($k,"UPDATE salary SET Id_User = '$iduser',
														Email = '$email',
														Password = '$password',
														Tgl_Lahir = '$tanggallahir',
														Nama = '$nama',
														status = '$status',
														Jabatan = '$jabatan',
														id_divisi = '$iddivisi',
														no_rekening = '$norekening',
														cabang = '$cabung',
														Level = '$level',
														gaji_pokok = '$gajipokok',
														tanggungan = '$tanggungan' WHERE Id_User = $_POST[id]");
	
	
	
	if($query){
		$stat = "Berhasil memasukkan ke database";
		$_SESSION['stat'] = "sukses";
	}else{
		$stat = "Gagal memasukkan ke database!";
		$_SESSION['stat'] = "gagal";
	}
	$_SESSION['message'] = $stat;
	
	header("Location: ../hrd/index.php?modul=user");

	
?>