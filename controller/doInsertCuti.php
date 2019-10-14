<?php
include "../config/koneksi.php";
session_start();


	
	$tanggal_mulai = $_POST['tanggal_mulai'];
	$tanggal_selesai = $_POST['tanggal_selesai'];
	$status = "Menunggu";
	$keterangan = strip_tags($_POST['keterangan']);
	$tipe = $_POST['tipe'];
	$pisah_tanggal_akhir = explode("-",$tanggal_selesai);
	$pisah_tanggal_mulai = explode("-",$tanggal_mulai);
	$id_karyawan = $_POST['id_karyawan'];
	$sql_data_karyawan = mysqli_query($k,"SELECT * from user where Id_User = '$id_karyawan'");
	$data_karyawan = mysqli_fetch_array($sql_data_karyawan);

	$id_divisi = $data_karyawan['id_divisi'];
	$cabang = $data_karyawan['cabang'];
	$level = $_POST['level'];
	$string_bulan = array(" ","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	
	$bulan_mulai = $pisah_tanggal_mulai[1]+0;
	$tahun_mulai = $pisah_tanggal_mulai[0];
	
	
	$bulan_akhir = $pisah_tanggal_akhir[1]+0;
	$tahun_akhir = $pisah_tanggal_akhir[0];
	
	if($pisah_tanggal_akhir[2] > 24){	
		$periode = $string_bulan[$bulan_mulai]."_".$tahun_mulai;
		$temp_tanggal = $tahun_akhir."-".$bulan_akhir."-24";
		$query=mysqli_query($k,"INSERT INTO cuti(id_karyawan,tipe,tanggal_mulai,tanggal_selesai,status,keterangan,id_divisi,cabang,level,periode) 
								VALUES('$id_karyawan','$tipe','$tanggal_mulai','$temp_tanggal','$status','$keterangan','$id_divisi','$cabang','$level','$periode')");
		if($bulan_mulai == 12){
			$periode = $string_bulan[1]."_".$tahun_mulai;
		}else{
			$periode = $string_bulan[$bulan_mulai+1]."_".$tahun_mulai;
		}
		$temp_tanggal = $tahun_mulai."-".$bulan_mulai."-25";
		$query=mysqli_query($k,"INSERT INTO cuti(id_karyawan,tipe,tanggal_mulai,tanggal_selesai,status,keterangan,id_divisi,cabang,level,periode) 
								VALUES('$id_karyawan','$tipe','$temp_tanggal','$tanggal_selesai','$status','$keterangan','$id_divisi','$cabang','$level','$periode')");	
	}else{
		$periode = $string_bulan[$bulan_akhir]."_".$tahun_akhir;
		$query=mysqli_query($k,"INSERT INTO cuti(id_karyawan,tipe,tanggal_mulai,tanggal_selesai,status,keterangan,id_divisi,cabang,level,periode) 
								VALUES('$id_karyawan','$tipe','$tanggal_mulai','$tanggal_selesai','$status','$keterangan','$id_divisi','$cabang','$level','$periode')");
	}

	
	
	
	
	if($query){
		$stat = "Berhasil memasukkan ke database";
		$sql_max_cuti = mysqli_query($k,"SELECT MAX(id) as maxid from cuti");
		$max_id_cuti = mysqli_fetch_assoc($sql_max_cuti);
		$tanggal_sekarang = date("Y-m-d");
		
		if($data_karyawan['Level'] > 3 ){ //karyawan
				$level_notifikasi = 3;
		}elseif($data_karyawan['Level'] == 3){ //kadiv
				if($data_karyawan['cabang'] == "Jakarta"){
					$level_notifikasi = 1;					
				}else{
					$level_notifikasi = 2;
				}
		}
		
		$sql_notifikasi = mysqli_query($k,"INSERT INTO notifikasi(id_pengirim,isi,level,divisi,cabang,isRead,tanggal,nama,lokasi) VALUES('$id_karyawan','$data_karyawan[Nama] melakukan pengajuan cuti','$level_notifikasi','$id_divisi','$cabang','n','$tanggal_sekarang','$data_karyawan[Nama]','?modul=cuti&act=detailCuti&id=$max_id_cuti[maxid]')");
		
		$_SESSION['stat'] = "sukses";
	}else{
		$stat = "Gagal memasukkan ke database!";
		$_SESSION['stat'] = "gagal";
	}
	$_SESSION['message'] = $stat;
	
				if($data_karyawan['Level'] == 3){ //Level Kepala Divisi				
					header("Location: ../kadiv/index.php?modul=karyawanCuti");		
				}else if($data_karyawan['Level'] == 4){ // Level Staff
					if($data_karyawan['id_divisi'] == 2){ // Divisi HRD
						header("Location: ../hrd/index.php?modul=karyawanCuti");
					}elseif($data_karyawan['id_divisi'] == 3){ // Divisi Finance
						header("Location: ../payroll/index.php?modul=karyawanCuti");
					}else{
						header("Location: ../employee/index.php?modul=karyawanCuti"); // Divisi Lainnya
					}
	
				}

	
?>