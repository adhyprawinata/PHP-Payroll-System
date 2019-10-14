<?php
	include '../config/koneksi.php';
	
	$id = $_GET['id'];
	$query = "SELECT * FROM cicilan where id ='$id'";
		$hasil = mysqli_query($k, $query);
		$data = mysqli_fetch_array($hasil);
?>
<div class="form-horizontal">
<div class="form-group"><label class="col-sm-3">ID Pinjaman</label> <div class="col-sm-3">: <?php echo $data['id_pinjaman']; ?></div></div>
<div class="form-group"><label class="col-sm-3">Tanggal</label> <div class="col-sm-3">: <?php echo $data['tanggal']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">Nominal Cicilan</label> <div class="col-sm-3">: <?php echo $data['nominal']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">Bukti</label> <div class="col-sm-3">: <?php echo "<img src='../libs/images/$data[bukti]' width='200px' height='200px'/>"; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">Status</label> <div class="col-sm-3">: <?php echo $data['status']; ?>
</div></div>
 
<input type="button" value="Kembali" class="btn btn-danger" onclick='javascript:history.back()'/>


</div>
