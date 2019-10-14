<?php
	include '../config/koneksi.php';
	
	$id_pinjaman = $_GET['id'];
	$query = "SELECT * FROM pinjaman where id ='$id_pinjaman'";
		$hasil = mysqli_query($k, $query);
		$data = mysqli_fetch_array($hasil);
		$sql_data_pengaju = mysqli_query($k,"SELECT * FROM user WHERE Id_User = '$data[id_karyawan]'");
		$data_pengaju = mysqli_fetch_assoc($sql_data_pengaju);
		$id_karyawan = $_SESSION['id_karyawan'];
		$sql_karyawan = mysqli_query($k,"SELECT * FROM user WHERE Id_User = '$id_karyawan'");
	$data_karyawan = mysqli_fetch_array($sql_karyawan);
	
	$sql_grade = mysqli_query($k,"SELECT * FROM penilaian WHERE id_karyawan = '$data[id_karyawan]'");
	$data_grade = mysqli_fetch_assoc($sql_grade);
?>
<form method="POST" action="../controller/doUpdatePinjaman.php" class="form-horizontal">

<br/>
<div class="form-group"><label class="col-sm-3">Tanggal</label> <div class="col-sm-3">: <?php echo $data['tanggal']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">ID Karyawan</label> <div class="col-sm-3">: <?php echo $data['id_karyawan']; ?></div></div>
<div class="form-group"><label class="col-sm-3">Nama Karyawan</label> <div class="col-sm-3">: <?php echo $data_pengaju['Nama']; ?></div></div>
<div class="form-group"><label class="col-sm-3">
	Tanggal Bergabung</label> <div class="col-sm-3">: <?php echo $data_pengaju['Tgl_Join']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">
	Grade</label> <div class="col-sm-3">: <?php echo $data_grade['grade']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">Besar Nominal</label> <div class="col-sm-3">: <?php echo $data['jml_pinjam']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">Besar Nominal Diterima</label> <div class="col-sm-3"><input name="pinjaman_diterima" type="text" class="form-control" />
</div></div>
<div class="form-group"><label class="col-sm-3">Tingkat Kepentingan</label> <div class="col-sm-3">: <?php echo $data['kepentingan']; ?>
</div></div>
<div class="form-group"><label class="col-sm-3">Status</label> <div class="col-sm-3">
	<?php
	if($data_karyawan['cabang'] != "Jakarta"){
		if($data['level'] == 2){
			echo "<select name='status_request' class='form-control' >";
			 if($data['status_request'] == "Diterima"){
				echo "<option value='Menunggu'>Menunggu</option>
				<option value='Diterima' selected>Diterima</option>
				<option value='Ditolak'>Ditolak</option>";
			}else{ 
				echo "<option value='M' selected>Menunggu</option>
				<option value='Diterima'>Diterima</option>
				<option value='Ditolak'>Ditolak</option>";
			} 
			echo "</select>";
		}else{
			echo ": ".$data['status_request'];
		}
		echo "<input type='hidden' name='level' value='2'/>";
	}else{
		if($data['level'] == 1){
			echo "<select name='status_request' class='form-control' >";
			 if($data['status_request'] == "Diterima"){
				echo "<option value='menunggu'>Menunggu</option>
				<option value='Diterima' selected>Diterima</option>
				<option value='Ditolak'>Ditolak</option>";
			}else{ 
				echo "<option value='Menunggu' selected>Menunggu</option>
				<option value='Diterima'>Diterima</option>
				<option value='Ditolak'>Ditolak</option>";
			} 
			echo "</select>";
		}else{
			echo ": ".$data['status_request'];
		}
		echo "<input type='hidden' name='level' value='1'/>";
	}
	?>
	
</div></div>
<div class="form-group"><label class="col-sm-3">Keperluan</label> <div class="col-sm-3">: <?php echo $data['keterangan']; ?>
<input type="hidden" name="id_karyawan" value="<?php echo $data['id_karyawan'];?>"/>
<input type="hidden" name="id_pengirim" value="<?php echo $id_karyawan; ?>"/>
<input type="hidden" name="pengirim" value="atasan"/>
<input type="hidden" name="id" value="<?php echo $id_pinjaman; ?>"/>
</div></div>

 <?php if($data['level'] == 1){
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
