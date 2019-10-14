<?php
	$id_karyawan = $_SESSION['id_karyawan'];
	$sql_karyawan = mysqli_query($k,"SELECT * FROM user WHERE Id_User = $id_karyawan");
	$data_karyawan = mysqli_fetch_assoc($sql_karyawan);
?>

<form method="post" action="../controller/doInsertKenaikkan.php" class="">
	
	
			
	<div class="form-group">
	<label class="">Presentase Kenaikan</label>
	<div class=""><input type="text" name="presentase" style="width:250px;"></div>
	<div style="width:250px;"><span class="notes" style="font-size:10px;color:red;">Catatan: Isi dengan angka yang dinyatakan dalam %, contoh: 10.</span></div>
	</div>
	<div class="form-group">
	<label class="">Keterangan</label> 
	<div class="">
	<textarea name="keterangan" class="form-control" rows="5" style="min-width:250px;max-width:250px;"></textarea>
	</div>
	</div>
	<input type="hidden" name="id" value="<?php echo $id_karyawan; ?>">
	<?php
				if($data_karyawan['cabang'] != "Jakarta"){ //Jika Staff Cabang membuat pengajuan
					echo "<input type='hidden' name='level' value='2'>";
				}else{
					echo "<input type='hidden' name='level' value='1'>";
				}
	?>
	<input type="submit" value="Kirim" class="btn btn-primary">  <input type="button" value="Kembali" class="btn btn-danger" onclick='javascript:history.back()'/>
</form>
