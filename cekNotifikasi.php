<?php
include 'config/koneksi.php';
session_start();
	$id_karyawan = $_SESSION['id_karyawan']; 
	$sql_karyawan = mysqli_query($k,"SELECT * FROM user WHERE Id_User = '$id_karyawan'");
	$data_karyawan = mysqli_fetch_assoc($sql_karyawan);
	
	if($data_karyawan['Level'] == 1){ //Manager
		$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE level = '1' AND isRead = 'n'"); 		
	}elseif($data_karyawan['Level'] == 3){		
		if($data_karyawan['id_divisi'] == 3){//Kadiv Finance
			$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE divisi > 2 AND divisi = '3' AND isRead = 'n'"); 
			$sql_notifikasi2 = mysqli_query($k,"SELECT * FROM notifikasi WHERE id_penerima = '$id_karyawan' AND isRead = 'n'");	
		}elseif($data_karyawan['id_divisi'] == 2){ //kadiv HRD
			$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE level > 2 AND divisi = '2' AND isRead = 'n'"); 
			$sql_notifikasi2 = mysqli_query($k,"SELECT * FROM notifikasi WHERE id_penerima = '$id_karyawan' AND isRead = 'n'");	
		}else{
			$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE level > 2 AND divisi = '$data_karyawan[id_divisi]' AND isRead = 'n'"); 
			$sql_notifikasi2 = mysqli_query($k,"SELECT * FROM notifikasi WHERE id_penerima = '$id_karyawan' AND isRead = 'n'");	
		}
	}elseif($data_karyawan['Level'] == 4){
		if($data_karyawan['id_divisi'] == 3){ // Finance
			$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE level = '4' AND divisi = '3' AND isRead = 'n'"); 
			$sql_notifikasi2 = mysqli_query($k,"SELECT * FROM notifikasi WHERE id_penerima = '$id_karyawan' AND isRead = 'n'");	
		}elseif($data_karyawan['id_divisi'] == 2){ // HRD
			$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE level = '4' AND divisi = '2' AND isRead = 'n'");
			$sql_notifikasi2 = mysqli_query($k,"SELECT * FROM notifikasi WHERE id_penerima = '$id_karyawan' AND isRead = 'n'");			
		}else{
			$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE id_penerima = '$id_karyawan' AND isRead = 'n'");	
		}
	}elseif($data_karyawan['Level'] == 2){ //Manager Kacab
		$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE level = '2' AND isRead = 'n'");
	}
	
	if($data_karyawan['Level'] == 4){
		if($data_karyawan['id_divisi'] == 2 || $data_karyawan['id_divisi'] == 3){
			echo mysqli_num_rows($sql_notifikasi1)+mysqli_num_rows($sql_notifikasi2);
		}else{
			echo mysqli_num_rows($sql_notifikasi1);
		}
	}elseif($data_karyawan['Level'] == 1 || $data_karyawan['Level'] == 2){
		echo mysqli_num_rows($sql_notifikasi1);
	}elseif($data_karyawan['Level']==3){
		echo mysqli_num_rows($sql_notifikasi1)+mysqli_num_rows($sql_notifikasi2);
	}
	


?>
