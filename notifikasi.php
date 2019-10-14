<?php
include 'config/koneksi.php';


	$id_karyawan = $_GET['id']; 
	$sql_karyawan = mysqli_query($k,"SELECT * FROM user WHERE Id_User = '$id_karyawan'");
	$data_karyawan = mysqli_fetch_assoc($sql_karyawan);

	if($data_karyawan['Level'] == 1){ //Manager
		$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE level = '1' order by id DESC LIMIT 5"); 
	}elseif($data_karyawan['Level'] == 3 && $data_karyawan['id_divisi'] == 3){ //Kadiv Finance
		$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE divisi = '3' order by id DESC LIMIT 5"); 
		$sql_notifikasi2 = mysqli_query($k,"SELECT * FROM notifikasi WHERE id_penerima = '$id_karyawan' order by id DESC LIMIT 5");
	}elseif($data_karyawan['Level'] == 3 && $data_karyawan['id_divisi'] == 2){ //Kadiv HRD
		$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE divisi = '2' order by id DESC LIMIT 5");
		$sql_notifikasi2 = mysqli_query($k,"SELECT * FROM notifikasi WHERE id_penerima = '$id_karyawan' order by id DESC LIMIT 5");		
	}elseif($data_karyawan['id_divisi'] == 3){ // Finance
		$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE level = '4' AND divisi = '3' LIMIT 5"); 
		$sql_notifikasi2 = mysqli_query($k,"SELECT * FROM notifikasi WHERE id_penerima = '$id_karyawan' LIMIT 5");	
	}elseif($data_karyawan['id_divisi'] == 2){ // HRD
		$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE level = '4' AND divisi = '2' order by id DESC LIMIT 5"); 
		$sql_notifikasi2 = mysqli_query($k,"SELECT * FROM notifikasi WHERE id_penerima = '$id_karyawan' order by id DESC LIMIT 5");	
	}elseif($data_karyawan['Level'] == 2){ //Manager Kacab
		$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE level = '2' order by id DESC LIMIT 5"); 
		$sql_notifikasi2 = mysqli_query($k,"SELECT * FROM notifikasi WHERE id_penerima = '$id_karyawan' LIMIT 5");
	}elseif($data_karyawan['Level'] == 3){
		$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE divisi = '$data_karyawan[id_divisi]' order by id DESC LIMIT 5"); 
		$sql_notifikasi2 = mysqli_query($k,"SELECT * FROM notifikasi WHERE id_penerima = '$id_karyawan' order by id DESC LIMIT 5");
	}else{//Staff
		$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE id_penerima = '$id_karyawan' order by id DESC LIMIT 5");
	}
$i = 0;
echo "<ul>";
while($hasil = mysqli_fetch_assoc($sql_notifikasi1)){
	$i++;
	if($hasil['isRead'] == 'n'){
		$style = "color:blue;";
	}else{
		$style = "color:gray;";
	}
		echo "<li><a style='$style' href='$hasil[lokasi]"."&notif=$hasil[id]"."'>$hasil[isi]</a></li>";
                        
						
}
$j = 0;
if($data_karyawan['Level'] != 4 && $data_karyawan['Level']!=1){
	
		while($hasil2 = mysqli_fetch_array($sql_notifikasi2)){
			$j++;
			if($hasil['isRead'] == 'n'){
				$style = "color:blue;";
			}else{
				$style = "color:gray;";
			}
			echo "<li> <a style='$style' href='$hasil2[lokasi]'>$hasil2[isi]</a></li>";
                        
						
		}
}else{
	if($data_karyawan['id_divisi'] == 2 || $data_karyawan['id_divisi'] == 3){
		
		while($hasil2 = mysqli_fetch_array($sql_notifikasi2)){
			$j++;
			if($hasil['isRead'] == 'n'){
				$style = "color:blue;";
			}else{
				$style = "color:gray;";
			}
			echo "<li><a style='$style' href='$hasil2[lokasi]"."&notif=$hasil2[id]"."'>$hasil2[isi]</a></li>";
                        
						
		}
	}
}

echo "</ul>";

?>
