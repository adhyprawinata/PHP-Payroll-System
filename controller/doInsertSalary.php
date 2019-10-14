<?php
include "../config/koneksi.php";
session_start();


	$id_karyawan = $_POST['id_karyawan'];
	$id_divisi = $_POST['id_divisi'];
	$cabang = $_POST['cabang'];
	$tll_ket = explode(",",$_POST['tll_ket']);
	$tll_nominal = explode(",",$_POST['tll_nominal']);
	$operasional = $_POST['tunjangan_operasional'];
	$bonus = $_POST['bonus'];
	$nett_salary = $_POST['nett_salary'];
	$gapok = $_POST['gaji_pokok'];
	$level = $_POST['level'];
	$periode = $_POST['periode'];

	$jml_tll = count($tll_ket);
	
	
	
		$query=mysqli_query($k,"INSERT INTO salary(id_user,id_divisi,cabang,status,gaji_pokok,tunjangan_operasional,bonus,level,nett_salary,bulan_tahun) 
									VALUES('$id_karyawan','$id_divisi','$cabang','Menunggu','$gapok','$operasional','$bonus','$level','$nett_salary','$periode')");
	
	
	$sql_tll = mysqli_query($k,"SELECT MAX(id_salary) AS id_tll FROM salary");
	$data_tll = mysqli_fetch_assoc($sql_tll);
	
	$jml_tll = count($tll_ket);
	
	for($i=0;$i<$jml_tll;$i++){
		$sql_insert_tll = mysqli_query($k,"INSERT INTO tll(keterangan,nominal,id_salary) VALUES('$tll_ket[$i]','$tll_nominal[$i]' , '$data_tll[id_tll]')");
	}
	
	if($query){
		$stat = "Berhasil memasukkan ke database";
		$_SESSION['stat'] = "sukses";
	}else{
		$stat = "Gagal memasukkan ke database!";
		$_SESSION['stat'] = "gagal";
	}
	$_SESSION['message'] = $stat;
	
	header("Location: ../payroll/index.php?modul=salary");

	
?>
	