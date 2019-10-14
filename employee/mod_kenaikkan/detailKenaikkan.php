<?php
	include '../config/koneksi.php';
	
	$id = $_GET['id'];
	$query = "SELECT * FROM kenaikkan where id ='$id'";
		$hasil = mysqli_query($k, $query);
		$data = mysqli_fetch_array($hasil);
?>
<form method="POST" action="../controller/doInsertSalary.php" class="form-horizontal">
<div class="form-group"><label class="col-sm-3">
	Tanggal</label> <div class="col-sm-3">: <?php echo $data['tanggal']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">
	Presentase Kenaikkan</label> <div class="col-sm-3">: <?php echo $data['presentase']; ?>
</div></div>

	<?php
			if($data['presentase_diterima'] != 0){
			echo "<div class='form-group'><label class='col-sm-3'>
	Presentase Kenaikkan Diterima</label> <div class='col-sm-3'>: $data[presentase_diterima]
</div></div>";
			
			
			}
	?>

<div class="form-group"><label class="col-sm-3">
	Diterapkan</label> <div class="col-sm-3">: <?php echo $data['isApply']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">
	Status</label> <div class="col-sm-3"> 
	<?php echo ": ".$data['status']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">
	Keterangan</label> <div class="col-sm-3">: <?php echo $data['alasan']; ?>
</div></div>


 <div class='form-group'>
	<div class='col-sm-6'>
		<textarea name='msg' placeholder='Kirim pesan anda' class='form-control' rows='5' style='max-width:100%;'></textarea>
	</div>
 </div>
<?php
	
		echo "<input type='button' value='Kembali' class='btn btn-danger' onclick='javascript:history.back()'/>";
	
?>

</form>
