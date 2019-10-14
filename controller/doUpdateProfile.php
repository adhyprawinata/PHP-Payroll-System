<?php
include "../config/koneksi.php";
session_start();
	$id = $_GET['id'];
	$password = $_POST['pass'];
	$email = $_POST['email'];
	$jabatan = $_POST['jabatan'];
	$location = "";
	if($jabatan=="Manager"){
		
		$location  = "Location: ../manager/index.php?modul=profile&id=$id";
	}else if($jabatan=="HRD"){
		
		$location  ="Location: ../hrd/index.php?modul=profile&id=$id";
	}else if($jabatan=="Kepala Divisi"){
		
		$location = "Location: ../kadiv/index.php?modul=profile&id=$id";
	}else if($jabatan=="Finance"){
		
		$location  ="Location: ../payroll/index.php?modul=profile&id=$id";
	}else if($jabatan=="Staff"){
		
		$location = "Location: ../employee/index.php?modul=profile&id=$id";
	}
	
	$query=mysqli_query($k,"UPDATE user SET Password = '$password',
														Email = '$email' WHERE Id_User='$id'");
	
	
	
	if($query){
		
		$stat = "Berhasil memasukkan ke database";
		$_SESSION['stat'] = "sukses";
	}else{
		$stat = "Gagal memasukkan ke database!";
		$_SESSION['stat'] = "gagal";
	}
	$_SESSION['message'] = $stat;

	if($jabatan=="Manager"){
			header($location);
		}else if($jabatan=="HRD"){
			header($location);
		}else if($jabatan=="Kepala Divisi"){
			header($location);
		}else if($jabatan=="Finance"){
			header($location);
		}else if($jabatan=="Staff"){
			header($location);
	
?>