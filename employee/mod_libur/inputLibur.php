<?php
	include '../config/datepicker.php';

?>
<form method="POST" action="../controller/doInsertLibur.php">
	<div class="form-group">
	<label>Hari Libur:</label>
	<input type="text" name="hari"/>
	</div>
	<div class="form-group">
	<label>Tipe Hari Libur :</label>
	<input type="text" name="tipe"/>
	</div>
	<div class="form-group">
		<label>Tanggal Mulai Libur</label></br>
		<input style="width:250px;" class="form-control" placeholder="Tanggal" name="tanggal" type="text" id="datepicker" value="" readonly>
		<h1 style="font-size:12px; color:grey;"><strong><i>(ddmmyy)</i></strong></h1>
	</div>  
	<div class="form-group">
	<label>Durasi</label>
	<input type="text" name="durasi"/>
	</div>
	<div class="form-group">
	<label>Ulangi Hari Libur</label>
	<select name="ulangi">
		<option value="off">Off</option>
		<option value="on">On</option>
	</select>
	</div>
	<div class="form-group">
	<label>Keterangan</label>
	<textarea name="keterangan"></textarea>
	</div>
	<input type="submit" value="Kirim">
</form>
