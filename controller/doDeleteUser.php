<?php
include "../config/koneksi.php";

	

session_start();
$id = $_GET['id'];
if(!isset($id) || empty($id)){
	
}else{
	if(isset($_SESSION['token'])){
		$token = $_GET['token'];
		if($_SESSION['token'] != $token){
			
		}else{
			$query = mysqli_query($k,"DELETE FROM user WHERE Id_User = '$_GET[id]'");
		}
	}else{
		
	}
	
}
if($query){
		$status = "Berhasil menghapus user";
		
	}else{
		$status = "Gagal menghapus user!";
	}

header("Location: ../hrd/index.php?modul=user");

?>