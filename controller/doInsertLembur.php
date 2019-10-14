<?php
include "../config/koneksi.php";

session_start();

	
	$tanggal = $_POST['tanggal'];
	$pisah_tanggal = explode("-",$tanggal);
	$tipe = $_POST['tipe'];
	$uraian = $_POST['uraian'];
	$id_karyawan = $_POST['id_karyawan'];
	$status = "Menunggu";
	
	$sql_data_karyawan = mysqli_query($k,"SELECT * from user where Id_User = '$id_karyawan'");
	$data_karyawan = mysqli_fetch_array($sql_data_karyawan);

	$id_divisi = $data_karyawan['id_divisi'];
	$cabang = $data_karyawan['cabang'];
	$level = $_POST['level'];
	
	$string_bulan = array(" ","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	
	$bulan_sekarang = $pisah_tanggal[1];
	$tahun_sekarang = $pisah_tanggal[0];
	if($pisah_tanggal[2] > 24){
		$periode = $string_bulan[$bulan_sekarang+1]."_".$tahun_sekarang;
	}else{
		$periode = $string_bulan[$bulan_sekarang]."_".$tahun_sekarang;
	}

	$query=mysqli_query($k,"INSERT INTO lembur(id_karyawan,tanggal,periode,tipe,uraian,status,id_divisi,cabang,level) 
								VALUES('$id_karyawan','$tanggal','$periode','$tipe','$uraian','$status','$id_divisi','$cabang','$level')");
	
	
	
	if($query){
		$stat = "Berhasil memasukkan ke database";
		$_SESSION['stat'] = "sukses";
	}else{
		$stat = "Gagal memasukkan ke database!";
		$_SESSION['stat'] = "gagal";
	}
	$_SESSION['message'] = $stat;

		if($data['Level'] == 3){ //Level Kepala Divisi				
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