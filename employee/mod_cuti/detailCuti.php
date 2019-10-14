<?php
	include '../config/koneksi.php';
	$id_karyawan = $_SESSION['id_karyawan'];
	$id = $_GET['id'];
	$query = "SELECT * FROM cuti where id ='$id'";
		$hasil = mysqli_query($k, $query);
		$data = mysqli_fetch_array($hasil);
?>
<form method="POST" action="../controller/doUpdateCuti.php" class="form-horizontal">
<div class="form-group"><label class="col-sm-3">
	Tipe Cuti</label> <div class="col-sm-3">: <?php echo $data['tipe']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">
	Tanggal Yang Diajukan</label> <div class="col-sm-3">: <?php echo $data['tanggal_mulai']." - ".$data['tanggal_selesai']; ?>
</div></div>
<!-- if -> tanggal yang diterima: -->
<div class="form-group"><label class="col-sm-3">
	Tanggal Yang Diterima</label> <div class="col-sm-3">: <?php 
	if($data['tanggal_mulai_diterima'] != "0000-00-00" && $data['tanggal_akhir_diterima'] != "0000-00-00"){
	echo $data['tanggal_mulai_diterima']." - ".$data['tanggal_akhir_diterima']; }else {
		echo "-";
	}?>
</div></div>
<div class="form-group"><label class="col-sm-3">
<?php
 $selisih = ((abs(strtotime ($data['tanggal_mulai_diterima']) - strtotime ($data['tanggal_akhir_diterima'])))/(60*60*24))+1;
// input type hidden kuota terpakai
?>
	Kuota Terpakai</label> <div class="col-sm-3">: <?php echo $selisih; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">
	Status</label> <div class="col-sm-3"> 
	<?php
			if($data['status'] != "Menunggu"){
				echo ": ".$data['status'];
			}else{
				echo "<select name='status_request' class='form-control'>";
					echo "<option value='Menunggu' selected>Menunggu</option>
					<option value='Diterima' >Diterima</option>
					<option value='Ditolak'>Ditolak</option>";
				
				echo "</select>";
			}
	?>
</div></div>
<div class="form-group"><label class="col-sm-3">
	Keterangan</label> <div class="col-sm-3">: <?php echo $data['keterangan']; ?>
</div></div>
<input type="hidden" name="id_karyawan" value="<?php echo $data['id_karyawan'];?>"/>
<input type="hidden" name="id_pengirim" value="<?php echo $id_karyawan; ?>"/>
<input type="hidden" name="pengirim" value="staff"/>
<input type="hidden" name="id" value="<?php echo $id; ?>"/>
<?php
	if($data['status'] != "Menunggu"){
				echo "<div><a class='btn btn-danger' onclick='javascript:history.back()'>Kembali</a> </div>";
			}else{
				echo "<div class='col-sm-6' style='text-align:center'><input type='submit' value='Simpan' class='btn btn-primary'>   <input type='submit' value='Kembali' class='btn btn-danger' onclick='javascript:history.back()'></div>";
			}
?>

</form>

