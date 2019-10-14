<?php 
	include '../config/datepicker.php';
	include '../config/koneksi.php';	

	$id_karyawan = $_SESSION['id_karyawan'];
	$sql_data_karyawan = mysqli_query($k,"SELECT * from user where Id_User = '$id_karyawan'");
	$data_karyawan = mysqli_fetch_array($sql_data_karyawan);
	
	$divisi = $data_karyawan['id_divisi'];
	$cabang = $data_karyawan['cabang'];
	
	$sql = mysqli_query($k,"SELECT * FROM user WHERE id_divisi = '$divisi' AND cabang = '$cabang'");
	
	
?>

<script type="text/javascript" src="../libs/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="../libs/select2/select2.min.js"></script>
<link rel="stylesheet" href="../libs/select2/select2.min.css"/>
<script type="text/javascript" src="../libs/multiple-select/multiple-select.js"></script>
<link rel="stylesheet" href="../libs/multiple-select/multiple-select.css"/>
<script type="text/javascript">
	$('document').ready(function(){	
		
		$('#data_staff').multipleSelect({
							placeholder: "Pilih Staff",
							filter:true
						});
		
		
	});
	
					
</script>
		<form action="../controller/doInsertPerintahLembur.php" method="POST"> 
		
<div class="form-group">
<div>
			<span style="color:red;">Tanggal Lembur diisi minimal satu hari setelah hari ini!</span>
		</div>
<br/>
	<label>Tanggal Lembur</label>
	<div style="width:250px;">
		<input class="form-control" placeholder="Tanggal" name="tanggal" type="text" id="datepicker" value="" readonly>
		<h1 style="font-size:12px; color:grey;"><strong><i>(yymmdd)</i></strong></h1>
	</div>
</div>
<div class="form-group">
	<label>Uraian Tugas Lembur</label>
	<div>
		<textarea class="form-control" name="uraian" class="form-control" style="min-width:250px;max-width:250px;" rows="5"> </textarea>
	</div>
</div>
<div class="form-group">
<label>Karyawan Yang Dipilih:</label>
	<div>
		<select id='data_staff' name='id_staff[]' multiple='multiple' style='width:250px' >
		<?php
		while($a=mysqli_fetch_assoc($sql)){
			if($a['Id_User'] == $id_karyawan){
				continue;
			}else{
				
				
					echo"<option value='$a[Id_User]'>$a[Nama] - $a[Id_User]</option>";
				
			}
		}
		?>
		</select>
	</div>
</div>
<input type="hidden" name="divisi" value="<?php echo $divisi; ?>">
<input type="hidden" name="cabang" value="<?php echo $cabang; ?>">
<input type="hidden" name="id_pengirim" value="<?php echo $id_karyawan; ?>"/>
<input type="submit" value="Kirim" class="btn btn-primary">   <a class='btn btn-danger' onclick='javascript:history.back()'>Kembali</a>
</form>
  
  
  



