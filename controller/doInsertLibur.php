<?php
include "../config/koneksi.php";

session_start();

	
	$tanggal_mulai = $_POST['tanggal'];
	$nama = $_POST['hari'];
	$durasi = $_POST['durasi'];
	$keterangan = $_POST['keterangan'];
	$ulangi = $_POST['ulangi'];
	
	

	$query=mysqli_query($k,"INSERT INTO libur(tanggal_mulai,nama, durasi,ulangi,keterangan) 
								VALUES('$tanggal_mulai','$nama','$durasi','$ulangi','$keterangan')");
	
	
	
	if($query){
		$stat = "Berhasil memasukkan data ke database";
		$_SESSION['stat'] = "sukses";
	}else{
		$stat = "Gagal memasukkan ke database!";
		$_SESSION['stat'] = "gagal";
	}
	$_SESSION['message'] = $stat;

	header("Location:../manager/?modul=libur");

	
?>