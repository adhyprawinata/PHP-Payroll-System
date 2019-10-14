<?php
	include '../config/koneksi.php';
	
	$id = $_GET['id'];
	$query = "SELECT * FROM klaim where id ='$id'";
		$hasil = mysqli_query($k, $query);
		$data = mysqli_fetch_array($hasil);
?>
<form method="POST" action="../controller/doInsertSalary.php" class="form-horizontal">
<div class="form-group"><label class="col-sm-3">
	Tanggal</label> <div class="col-sm-3">: <?php echo $data['tanggal']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">
	Tipe</label> <div class="col-sm-3">: <?php echo $data['tipe']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">
	Status</label> <div class="col-sm-3"> 
	<?php echo ": ".$data['status']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">
	Keterangan</label> <div class="col-sm-3">: <span><?php echo $data['keterangan']; ?></span>
</div></div>
	
 
<input type="button" value="Kembali" class="btn btn-danger" onclick='javascript:history.back()'/>

</form>