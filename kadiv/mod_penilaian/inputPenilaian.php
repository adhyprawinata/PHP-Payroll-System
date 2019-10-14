<?php
	include '../config/koneksi.php';	

	$id_karyawan = $_SESSION['id_karyawan'];
	$sql_data_karyawan = mysqli_query($k,"SELECT * from user where Id_User = '$id_karyawan'");
	$data_karyawan = mysqli_fetch_array($sql_data_karyawan);
	
	$divisi = $data_karyawan['id_divisi'];
	$cabang = $data_karyawan['cabang'];
	
	$sql = mysqli_query($k,"SELECT * FROM user WHERE id_divisi = '$divisi' AND cabang = '$cabang'");
	
?>


<form method="POST" action="../controller/doInsertPenilaian.php" class="form-horizontal">
	<div class="form-group">
		<div class="col-sm-3">
			<select name="karyawan" class="form-control">
				<option value="">-Pilih Karyawan-</option>
				<?php
				while($hasil = mysqli_fetch_array($sql)){
					$sql_cek_penilaian = mysqli_query($k,"SELECT * FROM penilaian WHERE id_karyawan = '$hasil[Id_User]'");
					if(mysqli_num_rows($sql_cek_penilaian) > 0){
						
					}else{
						echo "<option value='$hasil[Id_User]'>$hasil[Nama] - $hasil[Id_User]</option>";
					}
				}
				?>
			</select>
		</div>
	</div>

	<h4>A. Disiplin</h4>
	<div class="form-group">
		<label class="col-sm-3">1. Kehadiran Karyawan</label>
		<div class="col-sm-3">
			<label class="radio-inline"><input type="radio" name="kehadiran" value="4">4</label>
			<label class="radio-inline"><input type="radio" name="kehadiran" value="3">3</label>
			<label class="radio-inline"><input type="radio" name="kehadiran" value="2">2</label>
			<label class="radio-inline"><input type="radio" name="kehadiran" value="1">1</label>
			<label class="radio-inline"><input type="radio" name="kehadiran" value="0">0</label>
		</div>	
		<div class="col-sm-6" style="clear:both;content='';display:block;"><div>4: Sangat Baik</div> <div>3: Baik</div> <div>2: Sedang</div> <div>1: Kurang</div> <div>0: Sangat Kurang</div></div>
	</div>
	<br/>
	<h4>B. Sikap Kerja</h4>
	<div class="form-group">
		<label class="col-sm-3">1. Motivasi Kerja</label>
		<div class="col-sm-3">
			<label class="radio-inline"><input type="radio" name="motivasi-kerja" value="4">4</label>
			<label class="radio-inline"><input type="radio" name="motivasi-kerja" value="3">3</label>
			<label class="radio-inline"><input type="radio" name="motivasi-kerja" value="2">2</label>
			<label class="radio-inline"><input type="radio" name="motivasi-kerja" value="1">1</label>
			<label class="radio-inline"><input type="radio" name="motivasi-kerja" value="0">0</label>
		</div>
		<div class="col-sm-6" style="clear:both;content='';display:block;"><div>4: Sangat Baik</div> <div>3: Baik</div> <div>2: Sedang</div> <div>1: Kurang</div> <div>0: Sangat Kurang</div></div>
	</div>
	<div class="form-group">
		<label class="col-sm-3">2. Komunikasi dan Kerjasama</label>
		<div class="col-sm-3">
			<label class="radio-inline"><input type="radio" name="komunikasi" value="4">4</label>
			<label class="radio-inline"><input type="radio" name="komunikasi" value="3">3</label>
			<label class="radio-inline"><input type="radio" name="komunikasi" value="2">2</label>
			<label class="radio-inline"><input type="radio" name="komunikasi" value="1">1</label>
			<label class="radio-inline"><input type="radio" name="komunikasi" value="0">0</label>
		</div>
		<div class="col-sm-6" style="clear:both;content='';display:block;"><div>4: Sangat Baik</div> <div>3: Baik</div> <div>2: Sedang</div> <div>1: Kurang</div> <div>0: Sangat Kurang</div></div>
	</div>
	<br/>
	<h4>C. Potensi dan Kemampuan</h4>
	<div class="form-group">
		<label class="col-sm-3">1. Pemahaman dan Penguasaan Pekerjaan</label>
		<div class="col-sm-3">
			<label class="radio-inline"><input type="radio" name="pemahaman" value="4">4</label>
			<label class="radio-inline"><input type="radio" name="pemahaman" value="3">3</label>
			<label class="radio-inline"><input type="radio" name="pemahaman" value="2">2</label>
			<label class="radio-inline"><input type="radio" name="pemahaman" value="1">1</label>
			<label class="radio-inline"><input type="radio" name="pemahaman" value="0">0</label>
		</div>
		<div class="col-sm-6" style="clear:both;content='';display:block;"><div>4: Sangat Baik</div> <div>3: Baik</div> <div>2: Sedang</div> <div>1: Kurang</div> <div>0: Sangat Kurang</div></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-3">2. Pengembangan Diri</label>
		<div class="col-sm-3">
			<label class="radio-inline"><input type="radio" name="pengembangan" value="4">4</label>
			<label class="radio-inline"><input type="radio" name="pengembangan" value="3">3</label>
			<label class="radio-inline"><input type="radio" name="pengembangan" value="2">2</label>
			<label class="radio-inline"><input type="radio" name="pengembangan" value="1">1</label>
			<label class="radio-inline"><input type="radio" name="pengembangan" value="0">0</label>
		</div>
		<div class="col-sm-6" style="clear:both;content='';display:block;"><div>4: Sangat Baik</div> <div>3: Baik</div> <div>2: Sedang</div> <div>1: Kurang</div> <div>0: Sangat Kurang</div></div>
	</div>
	<br/>
	<h4>D. Hasil Kerja</h4>
	<div class="form-group">
		<label class="col-sm-3">1. Pencapaian Target Kerja Personal</label>
		<div class="col-sm-3">
			<label class="radio-inline"><input type="radio" name="pencapaian" value="4">4</label>
			<label class="radio-inline"><input type="radio" name="pencapaian" value="3">3</label>
			<label class="radio-inline"><input type="radio" name="pencapaian" value="2">2</label>
			<label class="radio-inline"><input type="radio" name="pencapaian" value="1">1</label>
			<label class="radio-inline"><input type="radio" name="pencapaian" value="0">0</label>
		</div>
		<div class="col-sm-6" style="clear:both;content='';display:block;"><div>4: Jauh melebihi target(> 50%)</div> <div>3: Melibihi target(> 25% - 50%)</div> <div>2: Mencapai target</div> <div>1: Dibawah target</div> <div>0: Jauh dibawah target</div></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-3">2. Penghargaan dan Sanksi Yang Diterima</label>
		<div class="col-sm-3">
			<label class="radio-inline"><input type="radio" name="penghargaan" value="4">4</label>
			<label class="radio-inline"><input type="radio" name="penghargaan" value="3">3</label>
			<label class="radio-inline"><input type="radio" name="penghargaan" value="2">2</label>
			<label class="radio-inline"><input type="radio" name="penghargaan" value="1">1</label>
			<label class="radio-inline"><input type="radio" name="penghargaan" value="0">0</label>
		</div>
		<div class="col-sm-6" style="clear:both;content='';display:block;"><div>4: Mendapatkan penghargaan bersifat khusus</div> <div>3: Mendapatkan penghargaan atas prestasi kerja</div> <div>2: Tidak mendapatkan penghargaan dan sanksi</div> <div>1: Mendapatkan teguran lisan, SP1, SP2</div> <div>0: Mendapatkan SP3 atau Skorsing</div></div>
	</div>
		
	<input type="submit" value="Kirim" class="btn btn-primary">   <a class='btn btn-danger' onclick='javascript:history.back()'>Kembali</a>
</form>
