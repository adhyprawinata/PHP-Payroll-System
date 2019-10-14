
<?php

include '../config/datepicker.php';

$id_karyawan = $_SESSION['id_karyawan'];
$sql_karyawan = mysqli_query($k,"SELECT * FROM user WHERE Id_User = $id_karyawan");
$data_karyawan = mysqli_fetch_assoc($sql_karyawan);
?>

<script type="text/javascript" src="../libs/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="../libs/select2/select2.min.js"></script>
<link rel="stylesheet" href="../libs/select2/select2.min.css"/>


<script type="text/javascript">
		
	</script>     
<form method="POST" action="../controller/doInsertCuti.php">
<div>
			<span style="color:red;"></span>
		</div>
		
<div class="form-group">
	<label>Kuota Cuti</label></br>
    <div>10
	</div>
</div>  
<div class="form-group">
<label>Tipe Cuti</label>
<div>
<select id="tipe-cuti" name="tipe" class="form-control" style="width:250px;">
	<option value="">Pilih Cuti</option>
	<option value="Urusan Pribadi">Urusan Pribadi</option>
	<option value="Kehamilan">Kehamilan</option>
	<option value="Sakit">Sakit</option>
	<option value="Tahunan">Tahunan</option>
	<option value="Ijin">Ijin</option>
</select>
</div>
</div>
<div class="form-group">
	<label>Tanggal Mulai Cuti</label></br>
    <input class="form-control" placeholder="Tanggal" name="tanggal_mulai" type="text" id="datepicker" value="" readonly style="width:250px;">
	<h1 style="font-size:12px; color:grey;"><strong><i>(ddmmyy)</i></strong></h1>
</div>  
<div class="form-group">
	<label>Tanggal Akhir Cuti</label></br>
    <input class="form-control" placeholder="Tanggal" name="tanggal_selesai" type="text" id="datepicker2" value="" readonly style="width:250px;">
	<h1 style="font-size:12px; color:grey;"><strong><i>(ddmmyy)</i></strong></h1>
</div>  
<div class="form-group">
	<label for="keterangan">Keterangan</label><br/>
	<textarea name="keterangan" id="keterangan" class="form-control" rows="5" style="max-width:250px;"></textarea>
</div>
<?php
	if($data_karyawan['Level'] == 4){ //Jika Staff membuat pengajuan
		echo "<input type='hidden' name='level' value='3'>";
	}elseif($data_karyawan['Level'] == 3){ // Jika Kadiv membuat pengajuan
		if($data_karyawan['cabang'] != "Jakarta"){ // Kadiv cabang
			echo "<input type='hidden' name='level' value='2'>";
		}else{ // Kadiv Pusat
			echo "<input type='hidden' name='level' value='1'>";
		}
	}
?>
<input type="hidden" name="id_karyawan" value="<?php echo $id_karyawan; ?>">
<input type="submit" value="Kirim" class="btn btn-primary">   <input type="button" value="Kembali" class="btn btn-danger" onclick='javascript:history.back()'/>
</form>