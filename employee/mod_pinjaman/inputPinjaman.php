<?php
	$id_karyawan = $_SESSION['id_karyawan'];
	$sql_karyawan = mysqli_query($k,"SELECT * FROM user WHERE Id_User = $id_karyawan");
	$data_karyawan = mysqli_fetch_assoc($sql_karyawan);
?>

		<form method="post" action="../controller/doInsertPinjaman.php">
		<div>
			<span style="color:red;"></span>
		</div>
			<div class="form-group">
			<label>Gaji Pokok</label> 
				<div>
					3.000.000<br/>
				</div>
			</div>
			<div class="form-group">
			<label>Besar Nominal</label> 
				<div>
					<input type="text" name="nominal" style="width:250px;"><br/>
				</div>
			</div>
			<div class="form-group">
			<label>Untuk Keperluan</label>
				<div>
					<textarea name="keterangan" class="form-control" style="min-width:250px;max-width:250px;" rows="5"></textarea>
				</div>
			</div>
			<div class="form-group">
			<label>Status</label>
			<div style="width:250px">
				<select name="status_kepentingan" class="form-control">
						<option value="1">Pilih Status</option>
						<option value="Penting">Penting</option>
						<option value="Ditunggu">Dapat Ditunggu</option>
					</select>
					</div>
			</div>
			<input type="hidden" name="id" value="<?php echo $id_karyawan; ?>">
			<?php
				if($data_karyawan['cabang'] != "Jakarta"){ //Jika Staff Cabang membuat pengajuan
					echo "<input type='hidden' name='level' value='2'>";
				}else{
					echo "<input type='hidden' name='level' value='1'>";
				}
			?>
			<input type="submit" value="Kirim" class="btn btn-primary">   <input type="button" value="Kembali" class="btn btn-danger" onclick='javascript:history.back()'/>
		</form>
		