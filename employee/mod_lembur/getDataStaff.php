<?php
include '../config/koneksi.php';


$sql = mysqli_query($k,"SELECT * FROM user WHERE id_divisi = '$_POST[divisi]'");

while($a=mysqli_fetch_assoc($sql)){
	echo"<option value='$a[Id_User]'>$a[Nama]</option>";
}

?>