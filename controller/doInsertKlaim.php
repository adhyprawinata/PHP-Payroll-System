<?php
include "../config/koneksi.php";
	
	session_start();
	$keterangan = htmlentities($_POST['keterangan']);
	$tipe = $_POST['tipe'];
	$id_karyawan = $_POST['id'];
	$status = "Menunggu";
	$tanggal = date('Y-m-d');
	$level = $_POST['level'];
	$sql_data_karyawan = mysqli_query($k,"SELECT * from user where Id_User = '$id_karyawan'");
	$data_karyawan = mysqli_fetch_array($sql_data_karyawan);

	$id_divisi = $data_karyawan['id_divisi'];
	$cabang = $data_karyawan['cabang'];

	$query=mysqli_query($k,"INSERT INTO klaim(id_karyawan,tanggal,tipe,status,keterangan,id_divisi,cabang,level) 
	VALUES('$id_karyawan','$tanggal','$tipe','$status','$keterangan','$id_divisi','$cabang','$level')");
	
	
	
	if($query){
		$stat = "Berhasil memasukkan ke database";
		$sql_max_klaim = mysqli_query($k,"SELECT MAX(id) as maxid from klaim");
		$max_id_klaim = mysqli_fetch_assoc($sql_max_klaim);
		$tanggal_sekarang = date("Y-m-d");
		
		if($data_karyawan['Level'] == 3){ 
				if($data_karyawan['cabang'] == "Jakarta"){
						$level_notifikasi = 1;					
					}else{
						$level_notifikasi = 2;
				}
		}elseif($data_karyawan['Level'] == 4){ 
				if($data_karyawan['id_divisi'] == 3){ 
					$level_notifikasi = 3;
				}else{ 
					$level_notifikasi = 4;
				}
		}
		
		$sql_notifikasi = mysqli_query($k,"INSERT INTO notifikasi(id_pengirim,isi,level,divisi,cabang,isRead,tanggal,nama,lokasi) VALUES('$id_karyawan','$data_karyawan[Nama] melakukan pengajuan klaim','$level_notifikasi','3','$cabang','n','$tanggal_sekarang','$data_karyawan[Nama]','?modul=klaim&act=detailKlaim&id=$max_id_klaim[maxid]')");
		$_SESSION['stat'] = "sukses";
	}else{
		$stat = "Gagal memasukkan ke database!";
		$_SESSION['stat'] = "gagal";
	}
	$_SESSION['message'] = $stat;

	if($data_karyawan['Level'] == 3){ //Level Kepala Divisi				
					header("Location: ../kadiv/index.php?modul=karyawanKlaim");		
				}else if($data_karyawan['Level'] == 4){ // Level Staff
					if($data_karyawan['id_divisi'] == 2){ // Divisi HRD
						header("Location: ../hrd/index.php?modul=karyawanKlaim");
					}elseif($data_karyawan['id_divisi'] == 3){ // Divisi Finance
						header("Location: ../payroll/index.php?modul=karyawanKlaim");
					}else{
						header("Location: ../employee/index.php?modul=karyawanKlaim"); // Divisi Lainnya
					}
	
				}
?>