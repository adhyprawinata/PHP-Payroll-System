<?php
	include '../config/koneksi.php';
	include '../config/datepicker.php';
	$id = $_GET['id'];
	$query = "SELECT * FROM cuti where id ='$id'";
		$hasil = mysqli_query($k, $query);
		$data = mysqli_fetch_array($hasil);
		
	$sql_karyawan = mysqli_query($k,"SELECT * FROM user WHERE Id_User = '$data[id_karyawan]'");
	$data_karyawan = mysqli_fetch_array($sql_karyawan);
?>
<script>

	</script>
<form method="POST" action="../controller/doUpdateCuti.php" class="form-horizontal">
<div class="form-group"><label class="col-sm-3">
	ID Karyawan</label> <div class="col-sm-3">: <?php echo $data['id_karyawan']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">
	Nama Karyawan</label> <div class="col-sm-3">: <?php echo $data_karyawan['Nama']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">
	Tipe Cuti</label> <div class="col-sm-3">: <?php echo $data['tipe']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">
	Tanggal Diajukan</label> <div class="col-sm-3">: <?php echo date('d M', strtotime($data['tanggal_mulai'])). " - ".date('d M, Y', strtotime($data['tanggal_selesai'])); ?>
</div></div>

<?php
	if($data['tanggal_mulai_diterima'] == "0000-00-00" && $data['tanggal_akhir_diterima'] == "0000-00-00"){
		?>
		<div class="form-group" id="tgl1">
			<label class="col-sm-3">Tanggal Mulai Diterima</label>
			<div class="col-sm-3"><input class="form-control" placeholder="Tanggal" name="tanggal_mulai" type="text" id="datepicker" value="" readonly style="width:250px;">
			<h1 style="font-size:12px; color:grey;"><strong><i>(ddmmyy)</i></strong></h1>
			</div>
		</div>  
		<div class="form-group id="tgl2">
			<label class="col-sm-3">Tanggal Selesai Diterima</label>
			<div class="col-sm-3"><input class="form-control" placeholder="Tanggal" name="tanggal_selesai" type="text" id="datepicker2" value="" readonly style="width:250px;">
			<h1 style="font-size:12px; color:grey;"><strong><i>(ddmmyy)</i></strong></h1>
			</div>
		</div>  
<?php
	}else{?>
		<div class="form-group"><label class="col-sm-3">
			Tanggal Diterima</label> <div class="col-sm-3"> :
			<?php echo date('d M', strtotime($data['tanggal_mulai_diterima']))." - ". date('d M, Y', strtotime($data['tanggal_akhir_diterima']));; ?>
			</div>  
		</div>

		<div class="form-group"><label class="col-sm-3">
			Kuota Terpakai</label> <div class="col-sm-3">: <?php echo $data['kuota_terpakai']; ?>
		</div></div>
		<?php
	}
?>
<div class="form-group"><label class="col-sm-3">
	Status</label> <div class="col-sm-3"> 
	<?php
	
		if($data['level'] == 3 && $data_karyawan['id_divisi'] == $data['id_divisi']){ // Request dari Karyawan di Divisi yang sama
			if($data['status'] != "Menunggu"){
				echo ": ".$data['status'];
			}else{
				echo "<select name='status_request' class='form-control' id='status'>";
				 if($data['status'] == "Diterima"){
					echo "<option value='Menunggu'>Menunggu</option>
					<option value='Diterima' selected>Diterima</option>
					<option value='Ditolak'>Ditolak</option>";
				}else{ 
					echo "<option value='Menunggu' selected>Menunggu</option>
					<option value='Diterima'>Diterima</option>
					<option value='Ditolak'>Ditolak</option>";
				} 
				echo "</select>";
			}
		}else{
			echo ": ".$data['status'];
		}
	?>
		
</div></div>
<input type="hidden" name="id_karyawan" value="<?php echo $data['id_karyawan'];?>"/>
<input type="hidden" name="id_pengirim" value="<?php echo $_SESSION['id_karyawan']; ?>"/>
<input type="hidden" name="pengirim" value="hrd"/>
<input type="hidden" name="id" value="<?php echo $id; ?>"/>
<div class="form-group"><label class="col-sm-3">
	Keterangan</label> <div class="col-sm-3">: <?php echo $data['keterangan']; ?>
</div></div>
<?php if($data['level'] == 3){
  echo "<div class='form-group'>
	<div class='col-sm-6'>
		<textarea name='msg' placeholder='Kirim pesan anda' class='form-control' rows='5' style='max-width:100%;'></textarea>
	</div>
 </div>
 
<div style='text-align:center;' class='col-sm-6'><input type='submit' value='Simpan' class='btn btn-primary'>  <a class='btn btn-danger' onclick='javascript:history.back()'>Kembali</a></div>";
	}else{
		echo "<div style='text-align:center;' class='col-sm-6'><a class='btn btn-danger' onclick='javascript:history.back()'>Kembali</a></div>";
	}
?>
</form>