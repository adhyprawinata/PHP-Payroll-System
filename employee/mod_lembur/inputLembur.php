
<?php

include '../config/datepicker.php';
$id_karyawan = $_SESSION['id_karyawan'];

?>
	
	
<form method="POST" action="../controller/doInsertLembur.php">
	<div class="form-group">
		<label>Tanggal Lembur</label>
		<div style="width:250px;">
		<input class="form-control" placeholder="Tanggal" name="tanggal" type="text" id="datepicker" value="" readonly>
		<h1 style="font-size:12px; color:grey;"><strong><i>(yymmdd)</i></strong></h1>
		</div>
	</div>  
	<div class="form-group">
		<label>Uraian</label>
		<div>
		<textarea name="uraian" class="form-control" style="min-width:250px;max-width:250px;" rows="5"></textarea>
		</div>
	</div>
	<input type="hidden" name="tipe" value="pengajuan">
	<input type="hidden" name="level" value="3">
	<input type="hidden" name="id_karyawan" value="<?php echo $id_karyawan; ?>">
	<input type="submit" value="Kirim" class="btn btn-primary">
</form>