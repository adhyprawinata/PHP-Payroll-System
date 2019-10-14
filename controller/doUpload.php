<?php
require_once '../config/koneksi.php';
include '../libs/excel_reader2.php';
$target_dir = "../uploads/";
$ext = strtolower(end(explode('.', $_FILES['fileToUpload']['name'])));
$acak        = rand(1,99);
$target_file = $target_dir . $acak . "_november2016." . $ext;
$uploadOk = 1;
$bulan_tahun = "";
date_default_timezone_set("Asia/Jakarta");

session_start();


// Check if image file is a actual image or fake image
/*if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}*/
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
/*if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}*/
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$id_karyawan = $_SESSION['id_karyawan'];
$sql_data_karyawan = mysqli_query($k,"SELECT * from user where Id_User = '$id_karyawan'");
	$data_karyawan = mysqli_fetch_array($sql_data_karyawan);

$data = new Spreadsheet_Excel_Reader("$target_file");
$periode = $_POST['periode'];
$string_bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni","Juli","Agustus","September","Oktober","November","Desember");
$pisah_periode = explode("-",$periode);
$periode = $string_bulan[$pisah_periode[0]]."_".$pisah_periode[1];
$baris = $data->rowcount(3);
$tgl_terakhir = $data->val($baris,4,3);
$convert_result = explode ("-",$tgl_terakhir);
$pisah_tgl_terakhir = $convert_result;
$bulan_tahun = $string_bulan[$convert_result[1]-1]. "_" . $convert_result[0];
$baris_stat_absen = $data->rowcount(1);
$tgl_pertama = $data->val(5,4,3);
$pisah_tgl_pertama = explode("-",$tgl_pertama);


$flag = 0;
$error = "";
if($pisah_tgl_pertama[2] == 12){
	if($pisah_tgl_pertama[2] >= 25){
		if($pisah_tgl_terakhir[2] >24 && $pisah_tgl_terakhir[1] >= 1){
			$flag = 0; $error = "Range Tanggal Salah";
		}elseif($pisah_periode[0] != 1){
			$flag = 0; $error = "Periode Salah";	
		}
		else {
			$flag =1;
		}
	}
	else if($pisah_tgl_pertama[2]<25){
		if($pisah_tgl_terakhir[2] > 24 && $pisah_tgl_terakhir[1] == $pisah_tgl_pertama[1]){
			$flag = 0; $error = "Range Tanggal Salah";
		}elseif($pisah_periode[0] != $pisah_tgl_pertama[1]){
			$flag = 0; $error = "Periode Salah";	
		}
		else {
			$flag =1;
		}
	} 
}else{
	if($pisah_tgl_pertama[2] >= 25){
		if($pisah_tgl_terakhir[2] >24 && $pisah_tgl_terakhir[1] >= $pisah_tgl_pertama[1]+1){
			$flag = 0; $error = "Range Tanggal Salah";
		}elseif($pisah_periode[0] != $pisah_tgl_pertama[1]+1){
			$flag = 0; $error = "Periode Salah";	
		}
		else {
			$flag =1;
		}
	}
	else if($pisah_tgl_pertama[2]<25){
		if($pisah_tgl_terakhir[2] > 24 && $pisah_tgl_terakhir[1] == $pisah_tgl_pertama[1]){
			$flag = 0; $error = "Range Tanggal Salah";
		}elseif($pisah_periode[0] != $pisah_tgl_pertama[1]){
			$flag = 0; $error = "Periode Salah";	
		}
		else {
			$flag =1;
		}
	} 
}


if($flag ==1){

$sql_cek_periode = mysqli_query($k,"SELECT * FROM stat_absensi WHERE periode = '$periode'");

	
for($i=5; $i<=$baris;$i++){
	$id = $data->val($i,1,3);
	$nama = $data->val($i,2,3);
	$dept = $data->val($i,3,3);
	$tgl = $data->val($i,4,3);
	$msk = $data->val($i,5,3);
	$plg = $data->val($i,6,3);
	$msk2 = $data->val($i,7,3);
	$plg2 = $data->val ($i,8,3);
	$tlmbt = $data->val($i,9,3);
	$plg_awal = $data->val($i,10,3);
	$absen = $data->val($i,11,3);
	
		$sql_cek_data = mysqli_query($k,"SELECT * FROM lap_absensi WHERE tanggal = '$tgl' AND id_karyawan = '$id'");
		
		if(mysqli_num_rows($sql_cek_data) > 0){
			continue;
		}else{
	
			$query = mysqli_query($k,"INSERT INTO lap_absensi(id_karyawan, nama, departemen, tanggal, datang_timezone_1, pulang_timezone_1, datang_timezone_2, pulang_timezone_2, terlambat, pulang_awal, absen) VALUES('$id','$nama','$dept','$tgl','$msk','$plg','$msk2','$plg2','$tlmbt','$plg_awal','$absen')");
		}
	
	
}
?><?php

$baris_log_absen = $data->rowcount(2);
$col_log_absen = $data->colcount(2);
$id_karyawan_log = "";
for($i=5;$i<=$baris_log_absen;$i++){
	
	if($i%2 == 1){
			$id_karyawan_log = $data->val($i,3,2);
	}else{
		for($j=1;$j<=$col_log_absen;$j++){
			
				$data_log = $data->val($i,$j,2);
				if($data_log == ""){
					continue;
				}
				$pjg_data = strlen($data_log);
				$jam_masuk = "";
				$jam_keluar = substr($data_log,$pjg_data-5,5).":00";
				for($z=1 ; $z<=$pjg_data/5;$z++){
					$data_jam = explode(":",substr($data_log,$pjg_data-(5*$z),5));
					
					if($data_jam[0] <= 17){
						break;	
					}else{
						$jam_masuk = implode(":",$data_jam).":00";		
					}
				}
				
				//menghitung selisih jam
				list($h,$m,$s) = explode(":",$jam_masuk);
				$dtAwal = mktime($h,$m,$s,"1","1","1");
				list($h,$m,$s) = explode(":",$jam_keluar);
				$dtAkhir = mktime($h,$m,$s,"1","1","1");
				$dtSelisih = $dtAkhir-$dtAwal;
	
				$totalmenit = $dtSelisih/60;
				$tanggal_lembur = $convert_result[0]."-".$convert_result[1]."-".$j;
				echo "<br/>".$totalmenit. $tanggal_lembur."Id Karyawan:". $id_karyawan_log;
				
				$sql_lembur_harian = mysqli_query($k,"UPDATE lap_absensi SET lembur = '$totalmenit' WHERE id_karyawan = '$id_karyawan_log' AND tanggal = '$tanggal_lembur'");
				
		}
	}
	
}



for($i=5 ; $i <= $baris_stat_absen;$i++){
	$id = $data->val($i,1,1);
	$nama = $data->val($i,2,1);
	$dept = $data->val($i,3,1);
	$terlambat = $data->val($i,6,1);
	$pulang_awal = $data->val($i,8,1);
	$lembur = $data->val($i,10,1);
	$absen = $data->val($i,14,1);
	$jml_hari_masuk = $data->val($i,12,1);
	$pisah_jml_hari_masuk = explode("/",$jml_hari_masuk);
	
	$cek_data = mysqli_query($k,"SELECT * FROM stat_absensi WHERE id_karyawan = '$id' AND periode ='$periode'");

			if(mysqli_num_rows($cek_data) > 0){
				$query = mysqli_query($k,"UPDATE stat_absensi SET terlambat = '$terlambat',
																lembur = '$lembur',
																absen = '$absen',
																pulang_awal = '$pulang_awal' WHERE id ='$id' AND periode = '$periode'");
				
			}else{
				$sql_get_cabang = mysqli_query($k,"SELECT * FROM user WHERE Id_User = '$id'");
				$get_cabang = mysqli_fetch_array($sql_get_cabang);
				$cabang = $get_cabang['cabang'];
				$query=mysqli_query($k,"INSERT INTO stat_absensi(id_karyawan,nama,cabang,departemen,terlambat,pulang_awal,lembur,absen,periode,jml_hari_masuk) VALUES('$id','$nama',,$cabang','$dept','$terlambat','$plg_awal','$lembur','$absen','$bulan_tahun','$pisah_jml_hari_masuk[1]')");
				
	
			}		
	if($query){
		echo "Berhasil memasukkan statistik absensi ke database";
	}else{
		echo "Gagal memasukkan statistik absensi ke database!";
			
	}	
}

/*$sql_data_user = mysqli_query($k, "SELECT * from user");

while($b = mysqli_fetch_assoc($sql_data_user)){
	$lembur = 0;
	$sql_data_lembur = mysqli_query($k, "SELECT * from lembur where periode = $periode and id_karyawan = $b[Id_User] AND status = 'diterima'");
	
	while($c = mysqli_fetch_array($sql_data_lembur)){
		$sql_jam_lembur = mysqli_query($k,"SELECT lembur FROM lap_absensi WHERE tanggal = $c[tanggal] AND id_karyawan = $c[id_karyawan]");
		$hasil_jam_lembur = mysqli_fetch_assoc($sql_jam_lembur);
		$lembur += $hasil_jam_lembur;
				
	}
	
	$sql_insert_jam_lembur = mysqli_query($k,"UPDATE stat_absensi SET lembur_terhitung = '$lembur' where periode = $periode and id_karyawan = $b[Id_User]");
	
}*/

	
	$_SESSION['message'] = "Berhasil memasukkan ke database!";
	$_SESSION['stat'] = "sukses";
}else{
	$_SESSION['message'] = $error;
	$_SESSION['stat'] = "gagal";
}

					header("Location: ../kadiv/index.php?modul=uploadAbsensi");		
				
/* compare date
$date1=date('d/m/y');
$tempArr=explode('_', '31_12_11');
$date2 = date("d/m/y", mktime(0, 0, 0, $tempArr[1], $tempArr[0], $tempArr[2]));

if(strtotime($date1) < strtotime($date2)){
	
}*/



?>

