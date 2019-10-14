<?php
	include '../config/datepicker.php';

?>

<form method="POST" action="../controller/doInsertLibur.php">
	<div class="form-group">
	<label>Hari Libur:</label>
	<div><input type="text" name="hari" style="width:250px;"/></div>
	<div class="form-group">
		<label>Tanggal Mulai Libur</label></br>
		<div>
		<input style="width:250px;" class="form-control" placeholder="Tanggal" name="tanggal" type="text" id="datepicker" value="" readonly>
		<h1 style="font-size:12px; color:grey;"><strong><i>(ddmmyy)</i></strong></h1>
		</div>
	</div>  
	<div class="form-group">
	<label>Durasi</label>
		<div>
		<input type="text" name="durasi" style="width:250px;"/>
		</div>
	</div>
	<div class="form-group">
	<label>Ulangi Hari Libur</label>
	<div style="width:250px;">
		<select name="ulangi" class="form-control">
			<option value="Off">Off</option>
			<option value="On">On</option>
		</select>
	</div>
	</div>
	<div class="form-group">
	<label>Keterangan</label>
	<div>
		<textarea name="keterangan" id="keterangan" class="form-control" rows="5" style="max-width:250px;"></textarea>
	</div>
	</div>
	<input type="submit" value="Kirim" class="btn btn-primary">  <a class='btn btn-danger' onclick='javascript:history.back()'>Kembali</a>
</form>
