<?php
		$i=1;
		$query = "SELECT * FROM loan Id_loan";
		$hasil = mysqli_query($k, $query);
		$b = mysqli_fetch_assoc($hasil);
		
?>	
<form method="POST" action="../controller/doEditLoan.php">
ID Karyawan : <input type="text" name="id_karyawan" value="<?php echo $b['id_karyawan'] ?>">
Jumlah Pinjaman : <input type="text" name="jml_pinjaman" value="<?php echo $b['jml_pinjam'] ?>>
<!-- tanggal -->
</form>