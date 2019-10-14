<?php
	include '../config/koneksi.php';


?>
<script type="text/javascript" src="../libs/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="../libs/select2/select2.min.js"></script>
<link rel="stylesheet" href="../libs/select2/select2.min.css"/>
<script type="text/javascript">
$('document').ready(function(){	
		$('#identitas').change(function(e){
			$('#data_staff').html('<img src="loading.gif">');
			var identitas = $(this).val();
			$.ajax({
				type: "POST",
				url: "mod_salary/getDataSalaryNonReguler.php",
				data: "id="+identitas,
				success: function(data){
					$('#data_staff').html(data);
				}	
			});
			
		});
	
	});
</script>
<form id="" action="../controller/doInsertSalaryNonReguler.php" method="POST">
<div class="form-group">
<select id="identitas" name="identitas" style="width:250px;" class="form-control">
<option value="">Pilih Karyawan</option>
	<?php
		$query_data_karyawan = mysqli_query($k,"SELECT * from user WHERE tipe = 'NonReguler'");
		while($data_karyawan = mysqli_fetch_assoc($query_data_karyawan)){
			$query_data_salary = mysqli_query($k, "SELECT * from salary WHERE id_user = '$data_karyawan[Id_User]' AND bulan_tahun = '$bulan_tahun'");
			if(mysqli_num_rows($query_data_salary) > 0){
				continue;
			}else{
				echo "<div><option value='$data_karyawan[Id_User]-$data_karyawan[Nama]'>$data_karyawan[Nama] -  $data_karyawan[Id_User]</option>";
			}
		}
	?>
</select>
</div>
<div class="form-group">
<select name="periode" class="form-control" style="width:250px;">
	<option value="">Pilih Periode</option>
	<option value="Januari_2017">Januari 2017</option>
	<option value="Februari_2017">Februari 2017</option>
	</select>
</div>
<div class="form-group">
<span id="data_staff"></span>
</div>
<input type="submit" value="Kirim" class="btn btn-primary">  <input type="submit" value="Batal" class="btn btn-danger">
</form>
