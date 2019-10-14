<?php
include "../config/koneksi.php";


session_start();
	
	$jml_pinjam = $_POST['nominal'];
	$keterangan = htmlspecialchars($_POST['keterangan']);
	
	$kepentingan = $_POST['status_kepentingan'];
	$id_karyawan = $_POST['id'];
	$status = "Menunggu";
	
	$tanggal = date('Y-m-d');
	$level = $_POST['level'];
	$sql_data_karyawan = mysqli_query($k,"SELECT * from user where Id_User = '$id_karyawan'");
	$data_karyawan = mysqli_fetch_array($sql_data_karyawan);

	$id_divisi = $data_karyawan['id_divisi'];
	$cabang = $data_karyawan['cabang'];
	

	$query=mysqli_query($k,"INSERT INTO pinjaman(id_karyawan,tanggal,jml_pinjam,status_request,kepentingan,keterangan,id_divisi,cabang,level) 
	VALUES('$id_karyawan','$tanggal','$jml_pinjam','$status','$kepentingan','$keterangan','$id_divisi','$cabang','$level')");
	
	
	
	if($query){
		$stat = "Berhasil memasukkan ke database";
		$sql_max_pinjaman = mysqli_query($k,"SELECT MAX(id) as maxid from pinjaman");
		$max_id_pinjaman = mysqli_fetch_assoc($sql_max_pinjaman);
		$tanggal_sekarang = date("Y-m-d");
		
		if($data_karyawan['cabang'] != "Jakarta"){
			$level_notifikasi = 2;
		}else{
			$level_notifikasi = 1;
		}
		
		$sql_notifikasi = mysqli_query($k,"INSERT INTO notifikasi(id_pengirim,isi,level,divisi,cabang,isRead,tanggal,nama,lokasi) VALUES('$id_karyawan','$data_karyawan[Nama] melakukan pengajuan pinjaman','$level_notifikasi','0','$cabang','n','$tanggal_sekarang','$data_karyawan[Nama]','?modul=pinjaman&act=detailPinjaman&id=$max_id_pinjaman[maxid]')");
		$_SESSION['stat'] = "sukses";
	}else{
		$stat = "Gagal memasukkan ke database!";
		$_SESSION['stat'] = "gagal";
	}
	$_SESSION['message'] = $stat;

	if($data_karyawan['Level'] == 3){ //Level Kepala Divisi				
					header("Location: ../kadiv/index.php?modul=karyawanPinjaman");		
				}else if($data_karyawan['Level'] == 4){ // Level Staff
					if($data_karyawan['id_divisi'] == 2){ // Divisi HRD
						header("Location: ../hrd/index.php?modul=karyawanPinjaman");
					}elseif($data_karyawan['id_divisi'] == 3){ // Divisi Finance
						header("Location: ../payroll/index.php?modul=karyawanPinjaman");
					}else{
						header("Location: ../employee/index.php?modul=karyawanPinjaman"); // Divisi Lainnya
					}
	
				}

	
?>