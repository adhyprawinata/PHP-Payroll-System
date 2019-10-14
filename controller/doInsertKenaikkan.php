<?php
include "../config/koneksi.php";
session_start();
	$presentase = $_POST['presentase'];
	$keterangan = $_POST['keterangan'];
	$id_karyawan = $_POST['id'];
	$status = "Menunggu";
	$tanggal = date('Y-m-d');
	$isApply = "belum";
	
	$level = $_POST['level'];
	$sql_data_karyawan = mysqli_query($k,"SELECT * from user where Id_User = '$id_karyawan'");
	$data_karyawan = mysqli_fetch_array($sql_data_karyawan);

	$id_divisi = $data_karyawan['id_divisi'];
	$cabang = $data_karyawan['cabang'];

	$query=mysqli_query($k,"INSERT INTO kenaikkan(id_karyawan,tanggal,presentase,status,isApply,alasan,id_divisi,cabang,level) VALUES('$id_karyawan','$tanggal','$presentase','$status','$isApply','$keterangan','$id_divisi','$cabang','$level')");
	
	
	
	if($query){
		$stat = "Berhasil memasukkan ke database";
		$sql_max_kenaikkan = mysqli_query($k,"SELECT MAX(id) as maxid from kenaikkan");
		$max_id_kenaikkan = mysqli_fetch_assoc($sql_max_kenaikkan);
		$tanggal_sekarang = date("Y-m-d");
		
		if($data_karyawan['cabang'] != "Jakarta"){
			$level_notifikasi = 2;
		}else{
			$level_notifikasi = 1;
		}
		
		$sql_notifikasi = mysqli_query($k,"INSERT INTO notifikasi(id_pengirim,isi,level,divisi,cabang,isRead,tanggal,nama,lokasi) VALUES('$id_karyawan','$data_karyawan[Nama] melakukan pengajuan kenaikkan','$level_notifikasi','0','$cabang','n','$tanggal_sekarang','$data_karyawan[Nama]','?modul=kenaikkan&act=detailKenaikkan&id=$max_id_kenaikkan[maxid]')");
		$_SESSION['stat'] = "sukses";
	}else{
		$stat = "Gagal memasukkan ke database!";
		$_SESSION['stat'] = "gagal";
	}
	$_SESSION['message'] = $stat;
	
	if($data['Level'] == 3){ //Level Kepala Divisi				
					header("Location: ../kadiv/index.php?modul=karyawanKenaikkan");		
				}else if($data_karyawan['Level'] == 4){ // Level Staff
					if($data_karyawan['id_divisi'] == 2){ // Divisi HRD
						header("Location: ../hrd/index.php?modul=karyawanKenaikkan");
					}elseif($data_karyawan['id_divisi'] == 3){ // Divisi Finance
						header("Location: ../payroll/index.php?modul=karyawanKenaikkan");
					}else{
						header("Location: ../employee/index.php?modul=karyawanKenaikkan"); // Divisi Lainnya
					}
	
				}

	
?>