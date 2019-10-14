<?php
include '../../config/koneksi.php';

$id = explode ("-",$_POST['id']);
$sql_gapok = mysqli_query($k,"SELECT gaji_pokok FROM user WHERE Id_User = '$id[0]'");
	$data = mysqli_fetch_assoc($sql_gapok);
	echo $data['gaji_pokok'];
	echo "<input type='hidden' id='gapok-lama' name='gapok' value='$data[gaji_pokok]'>";
	 $sql_kenaikkan = mysqli_query($k,"SELECT presentase FROM kenaikkan WHERE id_karyawan = '$_POST[id]'");
	 $data_kenaikkan = mysqli_fetch_assoc($sql_kenaikkan);
	 if(mysqli_num_rows($sql_kenaikkan) > 0){
		 echo "<div><label>Request Kenaikkan :</label><span id='kenaikkan'>". $data_kenaikkan['presentase']."</span>%</div>
		 <label>Terapkan:</label> <input class='radio-inline' id='yes-button' type='radio' name='terapkan' value='ya'>Ya <input id='no-button' class='radio-inline' type='radio' name='terapkan' value='tidak' selected>Tidak</span>
		 ";
	 }
	 
?>