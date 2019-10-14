<?php
include "../config/koneksi.php";
session_start();
	$id_pengirim = $_POST['id_pengirim'];
	$sql_data_karyawan = mysqli_query($k,"SELECT * from user where Id_User = '$id_pengirim'");
	$data_karyawan = mysqli_fetch_array($sql_data_karyawan);

	
	$tanggal = $_POST['tanggal'];
	$pisah_tanggal = explode("-",$tanggal);
	$tipe = "Perintah";
	$uraian = htmlentities($_POST['uraian']);
	$id_karyawan = $_POST['id_staff'];
	$status = "Menunggu";
	$string_bulan = array(" ","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	
	$bulan_sekarang = $pisah_tanggal[1]+0;
	$tahun_sekarang = $pisah_tanggal[0];
	if($pisah_tanggal[2] > 24){
		$periode = $string_bulan[$bulan_sekarang+1]."_".$tahun_sekarang;
	}else{
		$periode = $string_bulan[$bulan_sekarang]."_".$tahun_sekarang;
	}
	$jml_data = count($id_karyawan);
	$divisi = $_POST['divisi'];
	$cabang = $_POST['cabang'];

	
	for($i=0;$i<$jml_data;$i++){
		$sql_cek_karyawan_lembur = mysqli_query($k,"SELECT * FROM user where Id_User = '$id_karyawan[$i]'");
		$cek_karyawan_lembur = mysqli_fetch_assoc($sql_cek_karyawan_lembur);
			
		if($cek_karyawan_lembur['id_divisi'] == 2){
			$level = 3;
		}else{
			$level = 4;
		}
		
		$query=mysqli_query($k,"INSERT INTO lembur(id_karyawan,tanggal,periode,tipe,uraian,status,id_divisi,cabang,level) 
								VALUES('$id_karyawan[$i]','$tanggal','$periode','$tipe','$uraian','$status','$divisi','$cabang','$level')");
		if($query){
			$stat = "Berhasil memasukkan ke database";
			$sql_max_lembur = mysqli_query($k,"SELECT MAX(id) as maxid from lembur");
			$max_id_lembur = mysqli_fetch_assoc($sql_max_lembur);
			$tanggal_sekarang = date("Y-m-d");
			$level_notifikasi = 4;
			$sql_notifikasi = mysqli_query($k,"INSERT INTO notifikasi(id_penerima,id_pengirim,isi,level,divisi,cabang,isRead,tanggal,nama,lokasi) VALUES('$id_karyawan[$i]','$id_pengirim','Perintah lembur diberikan','$level_notifikasi','2','$cabang','n','$tanggal_sekarang','$data_karyawan[Nama]','?modul=karyawanLembur&act=detailLembur&id=$max_id_lembur[maxid]')");
			
			$_SESSION['stat'] = "sukses";
			}else{
				$stat = "Gagal memasukkan ke database!";
				$_SESSION['stat'] = "gagal";
			}
			$_SESSION['message'] = $stat;

			
	}
	
	header("Location:../kadiv/?modul=lembur");
	
	
	
	
	

	
?>