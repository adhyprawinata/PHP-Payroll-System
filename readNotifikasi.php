<?php
if(isset($_GET['notif'])){
		$id_notif = $_GET['notif'];
		$sql_read_notif = mysqli_query($k,"UPDATE notifikasi SET isRead = 'y' WHERE id = '$id_notif'");
}
?>