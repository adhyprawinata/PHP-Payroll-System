<?php
	include '../config/koneksi.php';
	
	$id = $_GET['id'];
	$query = "SELECT * FROM pinjaman where id ='$id'";
		$hasil = mysqli_query($k, $query);
		$data = mysqli_fetch_array($hasil);
?>
<div class="form-horizontal">
<div class="form-group"><label class="col-sm-3">ID Karyawan</label> <div class="col-sm-3">: <?php echo $data['id_karyawan']; ?></div></div>
<div class="form-group"><label class="col-sm-3">Tanggal</label> <div class="col-sm-3">: <?php echo $data['tanggal']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">Besar Nominal</label> <div class="col-sm-3">: <?php echo $data['jml_pinjam']; ?>
</div></div>
<?php
	if($data['jml_pinjam_diterima'] != 0){
		echo "<div class='form-group'><label class='col-sm-3'>Besar Nominal Diterima</label> <div class='col-sm-3'>: $data[jml_pinjam_diterima]
	</div></div>";
	}else{
		
	}

?>

<div class="form-group"><label class="col-sm-3">Tingkat Kepentingan</label> <div class="col-sm-3">: <?php echo $data['kepentingan']; ?>
</div></div>

<div class="form-group"><label class="col-sm-3">Status</label> <div class="col-sm-3">
	<?php
	echo ": ".$data['status_request']; 
	?>
</div></div>
<div class="form-group"><label class="col-sm-3">Keperluan</label> <div class="col-sm-3">: <?php echo $data['keterangan']; ?>
</div></div>
<?php 
if($data['status_request'] != "Menunggu"){
echo "<h3>Cicilan</h3>
Belum ada cicilan";
?>
<?php
	$sql_cicilan = mysqli_query($k,"SELECT * FROM cicilan WHERE id_pinjaman = '$id'");
	$i =0;
	while($data_cicilan = mysqli_fetch_array($sql_cicilan)){
		$i++;
		echo "<div class='form-group'>
		<div class='col-sm-2'>Cicilan ke-$i</div>:<div class='col-sm-3'>$data_cicilan[nominal]</div><div class=col-sm-2>Tanggal</div><div class='col-sm-2'>$data_cicilan[tanggal]</div>
		</div>";
		
	}
}
?>
<br/>
<br/>
<div class="form-group">
<div class="col-sm-6" style="text-align:center">
<?php
	
		echo "<input type='button' value='Kembali' class='btn btn-danger' onclick='javascript:history.back()'/>";
	
?></div>
</div>
</div>
