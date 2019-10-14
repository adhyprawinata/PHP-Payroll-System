<?php
	include '../config/koneksi.php';
	
	$id = $_GET['id'];
	$query = "SELECT * FROM penilaian where id ='$id'";
		$hasil = mysqli_query($k, $query);
		$data = mysqli_fetch_array($hasil);
		
		
	$sql_karyawan = mysqli_query($k,"SELECT * FROM user where Id_User = '$data[id_karyawan]'");
	$data_karyawan = mysqli_fetch_array($sql_karyawan);
	$total_nilai = 0;
?>
<div class="form-horizontal">
	<div class="form-group"><label class="col-sm-3">
		ID Karyawan</label><div class="col-sm-3">: <?php echo $data_karyawan['Id_User'] ?>
	</div></div> 
	<div class="form-group"><label class="col-sm-3">
		Nama</label><div class="col-sm-3">: <?php echo $data_karyawan['Nama'] ?>
	</div></div>  
	<div class="form-group"><label class="col-sm-3">
		Periode</label><div class="col-sm-3">: <?php echo $data['periode_penilaian'] ?>
	</div></div> 
	<br/>
		<div class="form-group">
			<div class="col-sm-4"><strong>Aspek Penilaian</strong></div><div class="col-sm-1"><strong>Bobot</strong></div><div class="col-sm-2"><strong>Penilaian</strong></div><div class="col-sm-1"><strong>Nilai</strong></div>
		</div>
		<div class="form-group">
			<h4>A. Disiplin</h4>
		</div>
		<div class="form-group">
			<div class="col-sm-4">Kehadiran Karyawan</div><div class="col-sm-1">2</div><div class="col-sm-2"><?php echo $data['kehadiran_karyawan'] ?></div><div class="col-sm-1"><?php echo 2*$data['kehadiran_karyawan']; 
				$total_nilai += 2*$data['kehadiran_karyawan'];
			?></div>
		</div>	
		<div class="form-group">
			<h4>B. Sikap Kerja</h4>
		</div>
		<div class="form-group">
			<div class="col-sm-4">Motivasi Kerja</div><div class="col-sm-1">1</div><div class="col-sm-2"><?php echo $data['motivasi_kerja'] ?></div><div class="col-sm-1"><?php echo 2*$data['motivasi_kerja'];
			$total_nilai += 2*$data['motivasi_kerja'];
			?></div>
		</div>
		<div class="form-group">
			<div class="col-sm-4">Komunikasi dan Kerjasama</div><div class="col-sm-1">1</div><div class="col-sm-2"><?php echo $data['komunikasi_kerjasama'] ?></div><div class="col-sm-1"><?php echo 2*$data['komunikasi_kerjasama']; 
			$total_nilai += 2*$data['komunikasi_kerjasama'];
			?></div>
		</div>
		<div class="form-group">
			<h4>C. Potensi dan Kemampuan</h4>
		</div>
		<div class="form-group">
			<div class="col-sm-4">Pemahaman dan Penguasaan Pekerjaan</div><div class="col-sm-1">2</div><div class="col-sm-2"><?php echo $data['pemahaman_penguasaan'] ?></div><div class="col-sm-1"><?php echo 2*$data['pemahaman_penguasaan']; 
			$total_nilai += 2*$data['pemahaman_penguasaan'];
			?></div>
		</div>	
		<div class="form-group">
			<div class="col-sm-4">Pengembangan Diri</div><div class="col-sm-1">1</div><div class="col-sm-2"><?php echo $data['pengembangan_diri'] ?></div><div class="col-sm-1"><?php echo 2*$data['pengembangan_diri']; 
			$total_nilai += 2*$data['pengembangan_diri'];
			?></div>
		</div>	
		<div class="form-group">
			<h4>D. Hasil Kerja</h4>
		</div>
		<div class="form-group">
			<div class="col-sm-4">Pencapaian Target Kerja Personal</div><div class="col-sm-1">2</div><div class="col-sm-2"><?php echo $data['pencapaian_target'] ?></div><div class="col-sm-1"><?php echo 2*$data['pencapaian_target']; 
			$total_nilai += 2*$data['pencapaian_target'];
			?></div>
		</div>	
		<div class="form-group">
			<div class="col-sm-4">Penghargaan dan Sanksi</div><div class="col-sm-1">1</div><div class="col-sm-2"><?php echo $data['penghargaan_sanksi'] ?></div><div class="col-sm-1"><?php echo 2*$data['penghargaan_sanksi']; 
			$total_nilai += 2*$data['penghargaan_sanksi'];
			?></div>
		</div>				
			<br/>
		<div class="form-group">
			<div class="col-sm-3"><strong>Total</strong></div><div class="col-sm-1">:</div><div class="col-sm-2"><?php echo $total_nilai; ?></div>	
		</div>
		<div class="form-group">
			<div class="col-sm-3"><strong>Grade</strong></div><div class="col-sm-1">:</div><div class="col-sm-2">
				<strong><?php echo $data['grade']; ?></strong>
			</div>
		</div>
		<br/>
		<div class="col-sm-8" style="text-align:center;"><a class='btn btn-danger' onclick='javascript:history.back()'>Kembali</a></div>
</div>
