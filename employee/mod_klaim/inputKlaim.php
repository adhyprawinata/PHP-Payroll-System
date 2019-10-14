<?php
	$id_karyawan = $_SESSION['id_karyawan'];
	
	$sql_karyawan = mysqli_query($k,"SELECT * FROM user WHERE Id_User = $id_karyawan");
	$data_karyawan = mysqli_fetch_assoc($sql_karyawan);
?>
		<form method="post" action="../controller/doInsertKlaim.php">	
			<div class="form-group">
			<label>Tipe Klaim</label>
			<div style="width:250px;">
			<select name="tipe" class="form-control">
							<option value="1">Pilih Klaim</option>
							<option value="protes">Protes</option>
							<option value="JHT">Reimburse</option>
						</select><br/>
			</div>
			</div>
			<div class="form-group">
			<label>Keterangan</label> 
			<div>
				<textarea name="keterangan" class="form-control" style="min-width:250px;max-width:250px;" rows="5"></textarea>
			</div>
			</div>
			<div class="form-group">
			<label>Attachment</label> 
			<div>
				<input type="file" name="fileGambar">
			</div>
			</div>
			<input type="hidden" name="id" value="<?php echo $id_karyawan; ?>">
			<?php
				if($data_karyawan['Level'] == 4){ 
					if($data_karyawan['id_divisi'] ==3){ //Jika Staff Finance membuat pengajuan
						echo "<input type='hidden' name='level' value='3'>";
					}else{ //karyawan lain
						echo "<input type='hidden' name='level' value='4'>";
					}
				}elseif($data_karyawan['Level'] == 3){ 
					if($data_karyawan['cabang'] != "Jakarta"){
						echo "<input type='hidden' name='level' value='2'>";
					}else{
						echo "<input type='hidden' name='level' value='1'>";
					}
				}
			?>
			<input type="submit" value="Kirim" class="btn btn-primary">   <input type="button" value="Kembali" class="btn btn-danger" onclick='javascript:history.back()'/>
		</form>
		