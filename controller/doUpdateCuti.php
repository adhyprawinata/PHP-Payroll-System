<?php
include "../config/koneksi.php";
session_start();
	$pengirim = $_POST['pengirim'];
	$id = $_POST['id'];
	$id_pengirim = $_POST['id_pengirim'];
	$id_karyawan = $_POST['id_karyawan'];
	$sql_data_karyawan = mysqli_query($k,"SELECT * from user where Id_User = '$id_karyawan'");
	$data_karyawan = mysqli_fetch_array($sql_data_karyawan);

	$id_divisi = $data_karyawan['id_divisi'];
	$cabang = $data_karyawan['cabang'];
	
	$sql_data_pengirim = mysqli_query($k,"SELECT * from user where Id_User = '$id_pengirim'");
	$data_pengirim = mysqli_fetch_array($sql_data_pengirim);
	
	if($pengirim=="staff"){
		$status	= $_POST['status_request'];
		
		$query=mysqli_query($k,"UPDATE cuti SET status = '$status' WHERE id = '$id'");
		
	}else{
		$tgl_mulai = $_POST['tanggal_mulai'];
		$tgl_selesai = $_POST['tanggal_selesai'];
		$kuota_terpakai = (((abs(strtotime ($tgl_selesai)) - strtotime ($tgl_mulai)))/(60*60*24))+1;
		$status	= $_POST['status_request'];
		
		$query=mysqli_query($k,"UPDATE cuti SET tanggal_mulai_diterima = '$tgl_mulai',
														tanggal_akhir_diterima = '$tgl_selesai',
														kuota_terpakai = '$kuota_terpakai',
														status = '$status' WHERE id = '$id'");
	}
	
	
	
	
	
	if($query){
		$tanggal_sekarang = date("Y-m-d");
		if($data_karyawan['Level'] == 3){ //data_karyawan yang di cuti
			$level_notifikasi = 3;
		}else{
			$level_notifikasi = 4;
		}
		
		if($data_pengirim['Level'] == 1 || $data_pengirim['Level'] == 3){
			$sql_notifikasi = mysqli_query($k,"INSERT INTO notifikasi(id_penerima,isi,level,divisi,cabang,isRead,tanggal,nama,lokasi) VALUES('$id_karyawan','Tanggal cuti $status oleh $data_karyawan[Nama]','$level_notifikasi','id_divisi','$cabang','n','$tanggal_sekarang','$data_karyawan[Nama]','?modul=karyawanCuti&act=detailCuti&id=$id')");
		}else{
			$sql_notifikasi = mysqli_query($k,"INSERT INTO notifikasi(id_pengirim,id_penerima,isi,level,divisi,cabang,isRead,tanggal,nama,lokasi) VALUES('$id_pengirim','$id_karyawan','Pengajuan cuti anda $status','$level_notifikasi','','$cabang','n','$tanggal_sekarang','$data_karyawan[Nama]','?modul=karyawanCuti&act=detailCuti&id=$id')");
		}	
		$stat = "Berhasil memasukkan ke database";
		$_SESSION['stat'] = "sukses";
	}else{
		$stat = "Gagal memasukkan ke database!";
		$_SESSION['stat'] = "gagal";
	}
	$_SESSION['message'] = $stat;
	
	if($data_pengirim['Level'] == 3){ //data_karyawan yang punya cuti
			header("Location: ../kadiv/index.php?modul=cuti");
		}else{
			header("Location: ../employee/index.php?modul=karyawanCuti");
		}
	

	
?>