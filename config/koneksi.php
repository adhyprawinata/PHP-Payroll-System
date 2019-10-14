<?php
	//koneksi.php
	$k = mysqli_connect("localhost","root","","skripsi");
	
	if (!$k) {
    die("Connection failed: " . mysqli_connect_error());
	}
?>