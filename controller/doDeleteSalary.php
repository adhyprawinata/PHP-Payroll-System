<?php

$query = mysqli_query($konek,"DELETE FROM salary WHERE Id_Salary = '$_GET[id]'");
	if($query){
		$status = "Berhasil menghapus berita";
		
	}else{
		$status = "Gagal menghapus berita!
			<p><a href='berita.php?module=berita&aksi=tampilberita'>Coba Lagi</a></p>";
	}


echo "<form method='POST' action=''>
		<input type='hidden' value='$status' name='status'>
	</form>";

header("location:../../media.php?module=berita");

?>