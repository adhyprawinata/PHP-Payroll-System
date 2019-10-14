<?php
	include '../config/koneksi.php';
	
	$id_pinjaman = $_GET['id'];
	$query = "SELECT * FROM pinjaman where id ='$id_pinjaman'";
		$hasil = mysqli_query($k, $query);
		$data = mysqli_fetch_array($hasil);
		$sql_data_pengaju = mysqli_query($k,"SELECT * FROM user WHERE Id_User = '$data[id_karyawan]'");
		$data_pengaju = mysqli_fetch_assoc($sql_data_pengaju);
		$id_karyawan = $_SESSION['id_karyawan'];
		$sql_karyawan = mysqli_query($k,"SELECT * FROM user WHERE Id_User = '$id_karyawan'");
	$data_karyawan = mysqli_fetch_array($sql_karyawan);
?>
<div class="form-horizontal">
<div class="form-group"><label class="col-sm-3">ID Karyawan</label> <div class="col-sm-3">: <?php echo $data['id_karyawan']; ?></div></div>
<div class="form-group"><label class="col-sm-3">Nama Karyawan</label> <div class="col-sm-3">: <?php echo $data_pengaju['Nama']; ?></div></div>
<div class="form-group"><label class="col-sm-3">Tanggal</label> <div class="col-sm-3">: <?php echo $data['tanggal']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">Besar Nominal</label> <div class="col-sm-3">: <?php echo $data['jml_pinjam']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">Tingkat Kepentingan</label> <div class="col-sm-3">: <?php echo $data['kepentingan']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">Status</label> <div class="col-sm-3">:
	<?php
	
			echo $data['status_request'];

	?>
	
</div></div>
<div class="form-group"><label class="col-sm-3">Keperluan</label> <div class="col-sm-3">: <?php echo $data['keterangan']; ?>
<input type="hidden" name="id_karyawan" value="<?php echo $data['id_karyawan'];?>"/>
<input type="hidden" name="id_pengirim" value="<?php echo $id_karyawan; ?>"/>
<input type="hidden" name="pengirim" value="atasan"/>
<input type="hidden" name="id" value="<?php echo $id_pinjaman; ?>"/>
</div></div>

<h3>Cicilan</h3>
Belum ada cicilan
<?php
	$sql_cicilan = mysqli_query($k,"SELECT * FROM cicilan WHERE id_pinjaman = '$id_pinjaman'");
	$i =0;
	while($data_cicilan = mysqli_fetch_array($sql_cicilan)){
		$i++;
		echo "<div class='form-group'>
		<div class='col-sm-2'>Cicilan ke-$i</div>:<div class='col-sm-3'>$data_cicilan[nominal]</div><div class='col-sm-2'>Tanggal</div><div class='col-sm-2'>$data_cicilan[tanggal]</div>
		</div>";
		
	}
?>
<br/>
<br/>
<br/>
<input type="button" value="Kembali" class="btn btn-danger" onclick='javascript:history.back()'/>
</div>
