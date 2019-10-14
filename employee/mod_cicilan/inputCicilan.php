<?php
	$id_karyawan = $_SESSION['id_karyawan'];
	$sql_karyawan = mysqli_query($k,"SELECT * FROM user WHERE Id_User = $id_karyawan");
	$data_karyawan = mysqli_fetch_assoc($sql_karyawan);
	$id_pinjaman = $_GET['id'];
?>

		<form method="post" action="../controller/doInsertCicilan.php">
			<div class="form-horizontal">
				<div class="form-group">
				<div class="col-sm-3">ID Pinjaman</div>:
					<div class="col-sm-3">
						<?php echo $id_pinjaman; ?>
					</div>
				</div>
			</div>
			<div class="form-group">
			<label>Nominal Cicilan</label> 
				<div>
					<input type="text" name="nominal" style="width:250px;" class="form-control"><br/>
				</div>
			</div>
			<div class="form-group">
			<label>Upload Bukti</label>
				<div>
					<input type="file" name="bukti" style="width:250px;">
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
			<br/>
			<input type="submit" value="Kirim" class="btn btn-primary">   <input type="button" value="Kembali" class="btn btn-danger" onclick='javascript:history.back()'/>
		</form>
		