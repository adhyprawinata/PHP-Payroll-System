	<?php
include '../config/koneksi.php';
session_start();

	
	$id = $_POST['id'];
	$id_pengirim = $_POST['id_pengirim']; //id yang approve
	$id_karyawan = $_POST['id_karyawan']; //id yang punya salary
	$sql_data_karyawan = mysqli_query($k,"SELECT * from user where Id_User = '$id_karyawan'");
	$data_karyawan = mysqli_fetch_array($sql_data_karyawan);

	$id_divisi = $data_karyawan['id_divisi'];
	$cabang = $data_karyawan['cabang'];
	

	$status	= $_POST['status_request'];
		
	$query=mysqli_query($k,"UPDATE salary SET status = '$status' WHERE id_salary = '$id'");
	
	
	
	
	if($query){
		$tanggal_sekarang = date("Y-m-d");
		if($data_karyawan['Level'] == 3){
			$level_notifikasi = 3;
		}else{
			$level_notifikasi = 4;
		}
			$sql_notifikasi = mysqli_query($k,"INSERT INTO notifikasi(id_pengirim,id_penerima,isi,level,divisi,cabang,isRead,tanggal,nama,lokasi) VALUES('$id_pengirim','$id_karyawan','Kalkulasi gaji anda telah $status','$level_notifikasi','','$cabang','n','$tanggal_sekarang','$data_karyawan[Nama]','?modul=karyawanSalary&act=detailSalary&id=$id')");
		$stat = "Berhasil memasukkan ke database";
		$_SESSION['stat'] = "sukses";
		echo $stat;
	}else{
		$stat = "Gagal memasukkan ke database!";
		$_SESSION['stat'] = "gagal";
	}
	$_SESSION['message'] = $stat;
	
	header("Location: ../manager/index.php?modul=salary");

?>
	