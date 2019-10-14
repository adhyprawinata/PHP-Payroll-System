<?php
include "../config/koneksi.php";
session_start();
	$pengirim = $_POST['pengirim'];
	$id = $_POST['id'];
	$id_pengirim = $_POST['id_pengirim']; //id yang approve
	$id_karyawan = $_POST['id_karyawan']; //id yang punya klaim
	$sql_data_karyawan = mysqli_query($k,"SELECT * from user where Id_User = '$id_karyawan'");
	$data_karyawan = mysqli_fetch_array($sql_data_karyawan);

	$id_divisi = $data_karyawan['id_divisi'];
	$cabang = $data_karyawan['cabang'];
	
	$sql_data_pengirim = mysqli_query($k,"SELECT * from user where Id_User = '$id_pengirim'");
	$data_pengirim = mysqli_fetch_array($sql_data_pengirim);

	$status	= $_POST['status_request'];
		
		$query=mysqli_query($k,"UPDATE klaim SET status = '$status' WHERE id = '$id'");
	
	
	
	
	if($query){
		$tanggal_sekarang = date("Y-m-d");
		if($data_karyawan['Level'] == 3){
			$level_notifikasi = 3;
		}else{
			$level_notifikasi = 4;
		}
			$sql_notifikasi = mysqli_query($k,"INSERT INTO notifikasi(id_pengirim,id_penerima,isi,level,divisi,cabang,isRead,tanggal,nama,lokasi) VALUES('$id_pengirim','$id_karyawan','Pengajuan klaim anda $status','$level_notifikasi','0','$cabang','n','$tanggal_sekarang','$data_karyawan[Nama]','?modul=karyawanKlaim&act=detailKlaim&id=$id')");
		$stat = "Berhasil memasukkan ke database";
		$_SESSION['stat'] = "sukses";
	}else{
		$stat = "Gagal memasukkan ke database!";
		$_SESSION['stat'] = "gagal";
	}
	$_SESSION['message'] = $stat;
	
	if($data_pengirim['level'] == 1){
		header("Location: ../manager/index.php?modul=klaim");	
	}elseif($data_pengirim['Level'] == 3){ //Level Kepala Divisi				
					header("Location: ../kadiv/index.php?modul=klaim");		
				}else if($data_pengirim['Level'] == 4){ // Level Staff
					if($data['id_divisi'] == 2){ // Divisi HRD
						header("Location: ../hrd/index.php?modul=klaim");
					}elseif($data_pengirim['id_divisi'] == 3){ // Divisi Finance
						header("Location: ../payroll/index.php?modul=klaim");
					}else{
						header("Location: ../employee/index.php?modul=klaim"); // Divisi Lainnya
					}
	
				}
?>