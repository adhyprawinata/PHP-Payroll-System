<?php
	$bulan_tahun = $_POST['bulan'];
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
				url: "mod_salary/getDataSalary.php",
				data: "id="+identitas,
				success: function(data){
					$('#data_staff').html(data);
					$('#yes-button').click(function(){
						
						var presentase = parseInt($('#kenaikkan').text());
						var gapok_lama = parseInt($('#gapok-lama').val());
						
						var gaji_kenaikkan = (presentase/100*gapok_lama)+gapok_lama;
						$('#gaji-kenaikkan').append('<label>Gaji Pokok Setelah Kenaikkan :</label> <div>'+gaji_kenaikkan+'</div><input type="hidden" name="gaji_kenaikkan" value="'+gaji_kenaikkan+'"/>');
						
						});
						
					$('#no-button').click(function(){
						$("#gaji-kenaikkan").empty();
						});
				}
				
			});
			
		});
		$("#identitas").select2({
                    placeholder: "Pilih Karyawan"
                });
				
		$('#tambah-tll').click(function(){
			$('#tll-form').append('<div class="form-group"><div class="col-sm-3"><input type="text" name="tll_keterangan[]" placeholder="Keterangan" class="form-control"></div><div class="col-sm-3"><input type="text" name="tll_nominal[]" placeholder="Nominal" class="form-control"></div></div>');
			
		});
		
		
	});
</script>

<form id="" action="?modul=salary&act=detailInputSalary" method="POST">
<div class="form-group">
<select id="identitas" name="identitas" style="width:250px;" class="form-control">
<option value="">Pilih Karyawan</option>
	<?php
		$query_data_karyawan = mysqli_query($k,"SELECT * from user WHERE Level != '1' AND Level != '2' AND tipe = 'Reguler' ");
		while($data_karyawan = mysqli_fetch_assoc($query_data_karyawan)){
			$query_data_salary = mysqli_query($k, "SELECT * from salary WHERE id_user = '$data_karyawan[Id_User]' AND bulan_tahun = '$bulan_tahun'");
			if(mysqli_num_rows($query_data_salary) > 0){
				continue;
			}else{
				echo "<div><option value='$data_karyawan[Id_User]-$data_karyawan[Nama]'>$data_karyawan[Nama] -  $data_karyawan[Id_User]</option>";
			}
		}
	?>
</select><br/>
</div>
<div class="form-group">
<label>Gaji Pokok</label> <div><span id="data_staff"></span></div>
<div><span id="gaji-kenaikkan"></span></div>
</div>
<div class="form-group">
	<label>Gaji Pokok Baru</label>
	<div style="width:250px;">
		<input type="text" name="gapok_baru" class="form-control">
	</div>
	<div>
	<span class="notes" style="font-size:10px;color:red;">Catatan: Kosongkan Jika Tidak Perlu</span>
	</div>
</div>
<div class="form-group">
	<label><em>Tunjangan Tidak Tetap</em></label>
</div>
<div class="form-group">
	<label>Tunjangan Operasional</label>
	<div style="width:250px;">
		<input type="text" name="operasional" class="form-control">
		</div>
</div>
<div class="form-group">
	<label>Bonus</label>
	<div style="width:250px;">
		<input type="text" name="bonus" class="form-control">
	</div>
</div>
<div class="form-group">
	<label>Tunjangan Lain-Lain</label>   <span id="tambah-tll" class="tambah_button btn btn-info" style="border-radius:25px;"><strong>+</strong></span>
</div>
<div class="form-horizontal" id="tll-form">
	<div class="form-group">
		<div class="col-sm-3"><input type="text" name="tll_keterangan[]" placeholder="Keterangan" class="form-control"></div> <div class="col-sm-3"><input type="text" name="tll_nominal[]" placeholder="Nominal" class="form-control"></div>
	</div>
</div>
<input type="hidden" name="periode" value="<?php echo $bulan_tahun; ?>">
<input type="submit" value="Kirim" class="btn btn-primary">   <a class='btn btn-danger' onclick='javascript:history.back()'>Kembali</a>
</form>
