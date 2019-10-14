<?php
include "../config/koneksi.php";
session_start();
	$pengirim = $_POST['pengirim'];
	$id = $_POST['id'];
	$id_pengirim = $_POST['id_pengirim']; //id yang approve
	$id_karyawan = $_POST['id_karyawan']; //id yang punya lembur
	$sql_data_karyawan = mysqli_query($k,"SELECT * from user where Id_User = '$id_pengirim'");
	$data_karyawan = mysqli_fetch_array($sql_data_karyawan);

	$id_divisi = $data_karyawan['id_divisi'];
	$cabang = $data_karyawan['cabang'];
	

	$status	= $_POST['status_request'];
		
		$query=mysqli_query($k,"UPDATE lembur SET status = '$status' WHERE id = '$id'");
	
	
	
	
	if($query){
		$tanggal_sekarang = date("Y-m-d");
		
			$level_notifikasi = 4;
		
			$sql_notifikasi = mysqli_query($k,"INSERT INTO notifikasi(id_pengirim,id_penerima,isi,level,divisi,cabang,isRead,tanggal,nama,lokasi) VALUES('$id_pengirim','$id_karyawan','Perintah lembur untuk anda telah $status','$level_notifikasi','','$cabang','n','$tanggal_sekarang','$data_karyawan[Nama]','?modul=karyawanLembur&act=detailLembur&id=$id')");
	$stat = "Berhasil memasukkan ke database";
		$_SESSION['stat'] = "sukses";
	}else{
		$stat = "Gagal memasukkan ke database!";
		$_SESSION['stat'] = "gagal";
	}
	$_SESSION['message'] = $stat;
	
	if($data_karyawan['level'] == 1){
		header("Location: ../manager/index.php?modul=lembur");	
	}elseif($data_karyawan['Level'] == 3){ //Level Kepala Divisi				
					header("Location: ../kadiv/index.php?modul=lembur");		
	}else if($data_karyawan['Level'] == 4){ // Level Staff
					if($data_karyawan['id_divisi'] == 2){ // Divisi HRD
						header("Location: ../hrd/index.php?modul=lembur");
					}elseif($data_karyawan['id_divisi'] == 3){ // Divisi Finance
						header("Location: ../payroll/index.php?modul=lembur");
					}else{
						header("Location: ../employee/index.php?modul=lembur"); // Divisi Lainnya
					}
	
	}

	
?>