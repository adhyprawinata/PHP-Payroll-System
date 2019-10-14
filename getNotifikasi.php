<?php
include 'config/koneksi.php';

session_start();
	$id_karyawan = $_SESSION['id_karyawan']; 
	$sql_karyawan = mysqli_query($k,"SELECT * FROM user WHERE Id_User = '$id_karyawan'");
	$data_karyawan = mysqli_fetch_assoc($sql_karyawan);

	if($data_karyawan['Level'] == 1){ //Manager
		$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE level = '1' order by id DESC LIMIT 5"); 		
	}elseif($data_karyawan['Level'] == 3){		
		if($data_karyawan['id_divisi'] == 3){//Kadiv Finance
			$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE level > 2 AND divisi = '3' order by id DESC LIMIT 5"); 
			$sql_notifikasi2 = mysqli_query($k,"SELECT * FROM notifikasi WHERE id_penerima = '$id_karyawan' order by id DESC LIMIT 5");	
		}elseif($data_karyawan['id_divisi'] == 2){
			$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE level > 2 AND divisi = '2' order by id DESC LIMIT 5"); 
			$sql_notifikasi2 = mysqli_query($k,"SELECT * FROM notifikasi WHERE id_penerima = '$id_karyawan' order by id DESC LIMIT 5");	
		}else{
			$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE level > 2 AND divisi = '$data_karyawan[id_divisi]' order by id DESC LIMIT 5"); 
			$sql_notifikasi2 = mysqli_query($k,"SELECT * FROM notifikasi WHERE id_penerima = '$id_karyawan' order by id DESC LIMIT 5");	
		}
	}elseif($data_karyawan['Level'] == 4){
		if($data_karyawan['id_divisi'] == 3){ // Finance
			$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE level = '4' AND divisi = '3' order by id DESC LIMIT 5"); 
			$sql_notifikasi2 = mysqli_query($k,"SELECT * FROM notifikasi WHERE id_penerima = '$id_karyawan' order by id DESC LIMIT 5");	
		}elseif($data_karyawan['id_divisi'] == 2){ // HRD
			$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE level = '4' AND divisi = '2' order by id DESC LIMIT 5");
			$sql_notifikasi2 = mysqli_query($k,"SELECT * FROM notifikasi WHERE id_penerima = '$id_karyawan' order by id DESC LIMIT 5");			
		}else{
			$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE id_penerima = '$id_karyawan' order by id DESC LIMIT 5");
		}
	}elseif($data_karyawan['Level'] == 2){ //Manager Kacab
		$sql_notifikasi1 = mysqli_query($k,"SELECT * FROM notifikasi WHERE level = '2' order by id DESC LIMIT 5");
	}
$i = 0;
while($hasil = mysqli_fetch_assoc($sql_notifikasi1)){
	$i++;
	if($hasil['isRead'] == 'n'){
		$style = "color:blue;";
	}else{
		$style = "color:gray;";
	}
		echo "<li><a style='$style' href='$hasil[lokasi]"."&notif=$hasil[id]"."'>$hasil[isi]</a></li>";
                        
						if($i != mysqli_num_rows($sql_notifikasi1)){
							echo "<li class='divider'></li>";
						}
	
}
$j = 0;
if($data_karyawan['Level']==1  || $data_karyawan['Level']== 2){
	
}else{
	if($data_karyawan['Level']==3){
		echo "<li class='divider'></li>";
		while($hasil2 = mysqli_fetch_array($sql_notifikasi2)){
			$j++;
			if($hasil['isRead'] == 'n'){
				$style = "color:blue;";
			}else{
				$style = "color:gray;";
			}
			echo "<li> <a style='$style' href='$hasil2[lokasi]'>$hasil2[isi]</a></li>";
                        
						if($j != mysqli_num_rows($sql_notifikasi2)){
							echo "<li class='divider'></li>";
						}
		}
	}else{
		if($data_karyawan['id_divisi'] == 2 || $data_karyawan['id_divisi'] == 3){
			echo "<li class='divider'></li>";
			while($hasil2 = mysqli_fetch_array($sql_notifikasi2)){
				$j++;
				if($hasil['isRead'] == 'n'){
					$style = "color:blue;";
				}else{
					$style = "color:gray;";
				}
				echo "<li><a style='$style' href='$hasil2[lokasi]"."&notif=$hasil2[id]"."'>$hasil2[isi]</a></li>";
							
							if($j != mysqli_num_rows($sql_notifikasi2)){
								echo "<li class='divider'></li>";
							}
			}
		}
	}
}

echo "<li class='divider'></li>
		<li style='text-align:center;'><a style='color:blue;font-weight:bold;' href='?modul=notifikasi&id=$data_karyawan[Id_User]'>Lihat Semua</a></li>";

?>
