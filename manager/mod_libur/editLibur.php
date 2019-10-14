<?php
	include '../config/koneksi.php';
	include '../config/datepicker.php';
	$id = $_GET['id'];
	$query = "SELECT * FROM libur where id ='$id'";
		$hasil = mysqli_query($k, $query);
		$data = mysqli_fetch_array($hasil);
?>
<style>
	.form-group input{
		width: 100%;
	}
</style>
<form method="POST" action="../controller/doUpdateLibur.php" class="form-horizontal">
<div class="form-group"><label class="col-sm-3">Hari Libur</label><div style="float:left;width:2%;">:</div><div class="col-sm-3"> <input type="text" name="hari" value="<?php echo $data['nama']; ?>"/>
</div></div>
<div class="form-group"><label class="col-sm-3">
	Tanggal Mulai</label><div style="float:left;width:2%;">:</div> <div class="col-sm-3"> <input style="" class="form-control" placeholder="Tanggal" name="tanggal" type="text" id="datepicker" value="<?php echo $data['tanggal_mulai']; ?>" readonly>
</div></div>
<div class="form-group"><label class="col-sm-3">
	Durasi</label> <div style="float:left;width:2%;">:</div><div class="col-sm-3"> <input type="text" name="durasi" value="<?php echo $data['durasi'];?>"/>
</div></div>
<div class="form-group"><label class="col-sm-3">
	Ulangi</label> <div style="float:left;width:2%;">:</div><div class="col-sm-3"> 
	<select name="ulangi" class="form-control">
		<?php 
			if($data['ulangi'] == "On"){
				echo "<option value='$data[ulangi]' selected>$data[ulangi]</option>
						<option value='Off'>Off</option>";		
			}else{
				echo "<option value='$data[ulangi]' selected>$data[ulangi]</option>
						<option value='On'>On</option>";		
			}
		 
		?>
	</select>
</div></div>
<div class="form-group"><label class="col-sm-3">
	Keterangan</label> <div style="float:left;width:2%;">:</div><div class="col-sm-3"> <textarea name="keterangan" id="keterangan" class="form-control" rows="5" style="max-width:100%;"><?php echo $data['keterangan']; ?></textarea>
</div></div>
<div style="text-align:center" class="col-sm-6"><input type="submit" value="Simpan" class="btn btn-primary">   <a class='btn btn-danger' onclick='javascript:history.back()'>Kembali</a></div>
</form>
