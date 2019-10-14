<?php
	include '../config/koneksi.php';
	
	$id_karyawan = $_GET['id'];
	$query = "SELECT * FROM libur where id_karyawan ='$id_karyawan'";
		$hasil = mysqli_query($k, $query);
		$data = mysqli_fetch_array($hasil);
?>
<div>
	Hari Libur : <?php echo $data['nama']; ?>
</div>
<div>
	Tanggal Mulai : <?php echo $data['tanggal_mulai']; ?>
</div>
<div>
	Durasi : <?php echo $data['durasi']; ?>
</div>
<div>
	Ulangi : <?php echo $data['ulangi']; ?>
</div>
<div>
	Keterangan : <?php echo $data['keterangan']; ?>
</div>
<input type="button" class="btn btn-danger" onclick='javascript:history.back()'/>
