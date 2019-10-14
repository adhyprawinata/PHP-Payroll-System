<?php
include "../config/koneksi.php";
session_start();
$total_gaji = $_POST['total_gaji'];
$id_karyawan = $_POST['id'];

$sql_data_karyawan = mysqli_query($k,"SELECT * FROM user where Id_User = '$id_karyawan'");
$data = mysqli_fetch_array($sql_data_karyawan);
$id_divisi = $data['id_divisi'];
$cabang = $data['cabang'];
$gapok = 0;
$operasional = 0;
$bonus = 0;
$nett_salary = $total_gaji;
$periode = $_POST['periode'];

$sql = mysqli_query($k,"INSERT INTO salary(id_user,id_divisi,cabang,status,gaji_pokok,tunjangan_operasional,bonus,level,nett_salary,bulan_tahun) 
									VALUES('$id_karyawan','$id_divisi','$cabang','Menunggu','$gapok','$operasional','$bonus','4','$nett_salary','$periode')");

									if($sql){
										$stat = "Berhasil memasukkan ke database";
										$_SESSION['stat'] = "sukses";
									}else{
										$stat = "Gagal memasukkan ke database!";
										$_SESSION['stat'] = "gagal";
									}
									$_SESSION['message'] = $stat;
									
									header("Location: ../payroll/index.php?modul=salary");

									
?>