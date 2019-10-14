<?php
	include '../config/koneksi.php';
	
	$id = $_GET['id'];
	$query = "SELECT * FROM lembur where id ='$id'";
		$hasil = mysqli_query($k, $query);
		$data = mysqli_fetch_array($hasil);
?>
		<form method="POST" action="../controller/doInsertSalary.php" class="form-horizontal">
	<div class="form-group"><label class="col-sm-3">
		Tanggal Lembur</label><div class="col-sm-3">: <?php echo $data['tanggal'] ?>
	</div></div>  
	<div class="form-group"><label class="col-sm-3">
		Tipe</label><div class="col-sm-3">: <?php echo $data['tipe'] ?>
	</div></div>
	<div class="form-group"><label class="col-sm-3">
		Uraian</label> <div class="col-sm-3">: <?php echo $data['uraian'] ?>
		
	</div></div>
	<div class="form-group"><label class="col-sm-3">
	Status</label> <div class="col-sm-3"> 
	<?php
			echo ": ".$data['status'];
	?>
	
	</div></div>
	<?php
 $sql_message = mysqli_query($k,"SELECT * FROM message WHERE id_lembur = '$id'");
 $data_message = mysqli_fetch_array($sql_message);
 if(mysqli_num_rows($sql_message) > 0){	 
	 echo "<div>$data_message[isi]</div>
			<div>$data_message[tanggal]  $data_message[jam]  by $data_message[author]	 
	 ";
 }
  ?>
  <div class='form-group'>
	<div class='col-sm-6'>
		<textarea name='msg' placeholder='Kirim pesan anda' class='form-control' rows='5' style='max-width:100%;'></textarea>
	</div>
 </div>
 
<input type='submit' value='Simpan' class='btn btn-primary'>   <button class="btn btn-danger" onclick="javascript:history.back()"/>Kembali</button>

</form>
