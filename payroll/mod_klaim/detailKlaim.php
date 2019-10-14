<?php
	include '../config/koneksi.php';
	$id_karyawan = $_SESSION['id_karyawan'];
	$id = $_GET['id'];
	$query = "SELECT * FROM klaim where id ='$id'";
		$hasil = mysqli_query($k, $query);
		$data = mysqli_fetch_array($hasil);
		
		$sql_karyawan = mysqli_query($k,"SELECT * FROM user WHERE Id_User = '$data[id_karyawan]'");
	$data_karyawan = mysqli_fetch_array($sql_karyawan);
?>
<form method="POST" action="../controller/doUpdateKlaim.php" class="form-horizontal">
<div class="form-group"><label class="col-sm-3">
	ID Karyawan</label> <div class="col-sm-3">: <?php echo $data['id_karyawan']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">
	Nama Karyawan</label> <div class="col-sm-3">: <?php echo $data_karyawan['Nama']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">
	Tanggal</label> <div class="col-sm-3">: <?php echo $data['tanggal']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">
	Tipe</label> <div class="col-sm-3">: <?php echo $data['tipe']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">
	Status</label> <div class="col-sm-3"> 
	<?php
		if($data['level'] == 4 && $data_karyawan['id_divisi'] != 3){ // Request dari Karyawan selain finance
			if($data['status'] != "Menunggu"){
				echo ": ".$data['status'];
			}else{
				echo "<select name='status_request' class='form-control'>";
				 if($data['status'] == "diterima"){
					echo "<option value='Menunggu'>Menunggu</option>
					<option value='Diterima' selected>Diterima</option>
					<option value='Ditolak'>Ditolak</option>";
				}else{ 
					echo "<option value='Menunggu' selected>Menunggu</option>
					<option value='Diterima'>Diterima</option>
					<option value='Ditolak'>Ditolak</option>";
				} 
				echo "</select>";
			}
		}else{
			echo ": ".$data['status'];
		}
		
	?>
</div></div>
<input type="hidden" name="id_karyawan" value="<?php echo $data['id_karyawan'];?>"/>
<input type="hidden" name="id_pengirim" value="<?php echo $id_karyawan; ?>"/>
<input type="hidden" name="pengirim" value="atasan"/>
<input type="hidden" name="id" value="<?php echo $id; ?>"/>
<div class="form-group"><label class="col-sm-3">
	Keterangan</label> <div class="col-sm-3">: <?php echo $data['keterangan']; ?>
</div></div>

<?php if($data['level'] == 4){
  echo "<div class='form-group'>
	<div class='col-sm-6'>
		<textarea name='msg' placeholder='Kirim pesan anda' class='form-control' rows='5' style='max-width:100%;'></textarea>
	</div>
 </div>
<div style='text-align:center;' class='col-sm-6'><input type='submit' value='Simpan' class='btn btn-primary'>  <a class='btn btn-danger' onclick='javascript:history.back()'>Kembali</a></div>";
}else{
	echo "<div style='text-align:center;' class='col-sm-6'><a class='btn btn-danger' onclick='javascript:history.back()'>Kembali</a><div>";
}
?>

</form>